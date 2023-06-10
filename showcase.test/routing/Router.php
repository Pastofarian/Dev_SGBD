<?php

class Router {
    private $routes = [];

    public function __construct() {
        // Defini les routes
        $this->addRoute('/', 'StudentController', 'index');
        $this->addRoute('/show/{id}', 'StudentController', 'show');
        $this->addRoute('/edit/{id}', 'StudentController', 'edit');
        $this->addRoute('/create', 'StudentController', 'create');
        $this->addRoute('/delete/{id}', 'StudentController', 'destroy');
        $this->addRoute('/update/{id}', 'StudentController', 'update');
        $this->addRoute('/store', 'StudentController', 'store');

        // Récupère l'URI et dispatch la requête
        $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->dispatch($request_uri);
    }

    public function addRoute($route, $controller, $method) {
        $this->routes[$route] = ['controller' => $controller, 'method' => $method];
    }

    public function getRoute($route) {
        return isset($this->routes[$route]) ? $this->routes[$route] : null;
    }

    // Dispatch la requête avec l'URI en paramètre
    public function dispatch($request_uri) {
        // Récupère les données POST si elles existent
        $post_data = $this->getPostData();

        // Extrait les parties de l'URI
        $uri_parts = $this->getUriParts($request_uri);

        foreach ($this->routes as $route => $params) {
            $route_parts = $this->getRouteParts($route);

            // Continue si route et URI sont différentes
            if (!$this->partsCountMatch($route_parts, $uri_parts)) {
                continue;
            }

            // Récupère les valeurs paramètres dans URI dynamiquement
            $param_values = $this->getParamsValues($route_parts, $uri_parts);

            // Continue si partie statique route est diffèrente de l'URI
            if ($param_values === false) {
                continue;
            }

            // Si on est arrivé ici c'est que les routes matches, donc on appelle la méthode du contrôleur
            if ($this->callControllerMethod($params, $param_values, $post_data)) {
                return;
            }
        }

        // Si aucune route ne correspond, on affiche une erreur 404
        echo "404 Not Found";
    }

    // Récupère les données POST si elles existent
    private function getPostData() {
        return ($_SERVER['REQUEST_METHOD'] == 'POST') ? $_POST : [];
    }

    // Extrait les parties de l'URI
    private function getUriParts($request_uri) {
        return explode('/', $request_uri);
    }

    // Extrait les parties de la route
    private function getRouteParts($route) {
        return explode('/', $route);
    }

    // Vérifie si le nombre de parties dans la route et l'URI correspondent
    private function partsCountMatch($route_parts, $uri_parts) {
        return count($route_parts) == count($uri_parts);
    }

    // Extrait les valeurs dynamiquement de l'URI
    private function getParamsValues($route_parts, $uri_parts) {
        $param_values = [];
        for ($i = 0; $i < count($route_parts); $i++) {
            if ($this->isDynamicPart($route_parts[$i])) {
                $param_values[] = $uri_parts[$i];
            } elseif ($route_parts[$i] != $uri_parts[$i]) {
                return false;
            }
        }

        return $param_values;
    }

    // Vérifie si une partie de la route est dynamique -> {}
    private function isDynamicPart($part) {
        return strpos($part, '{') === 0 && strpos($part, '}') === strlen($part) - 1;
    }

    // Appelle la méthode du contrôleur correspondant à la route
    private function callControllerMethod($params, $param_values, $post_data) {
        $controller = new $params['controller'];
        $method = $params['method'];

        if (!method_exists($controller, $method)) {
            echo "404 Not Found - Method {$method} not found in controller {$params['controller']}";
            return false;
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            call_user_func_array([$controller, $method], array_merge($param_values, [$post_data]));
        } else {
            call_user_func_array([$controller, $method], $param_values);
        }

        return true;
    }
}

// https://www.udemy.com/course/php-mvc-from-scratch/
// https://steampixel.de/simple-and-elegant-url-routing-with-php/
// https://github.com/dannyvankooten/PHP-Router
// https://laracasts.com/series/php-for-beginners/episodes/16
// https://chat.openai.com
