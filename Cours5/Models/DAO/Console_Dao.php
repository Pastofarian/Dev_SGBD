<?php

class Console_Dao {
    private $db;
    
    public function __construct () {
        $this->connect();
    }

    public function connect (){
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
    }

    public function fetch($id) {
        $statement =$this->db->prepare("SELECT * FROM consoles WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if($result) {
                return $this->create($result);
            }
            return false;
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function fetch_all () {
        $statement = $this->db->prepare("SELECT * FROM consoles");
        try {
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    array_push($list, $this->create($result));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function create ($data) {
        if (empty($data["id"])) {
            return false;
        }
        return new Console(
            $data["id"] ?? false,
            $data["name"] ?? false,

// $data["id"] = isset($data["id"]) ? $data["id"] : false;
// $data["name"] = isset($data["name"]) ? $data["name"] : false;
//ou
// if (isset($data["id"])) {
//     $id = $data["id"];
// } else {
//     $id = false;
// }
        );
    }

    public function store ($console) {
        $statement = $this->db->prepare("INSERT INTO consoles (name) VALUES (?)");
        try {
            $statement->execute([$console->name]);
            $connection_db = $this->db;
            $derniere_id = $connection_db->lastInsertId();
            $console->id = $derniere_id;
            return $console;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function destroy ($id) {
        $statement = $this->db->prepare("DELETE FROM consoles WHERE id = ?");
        try {
            $statement->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function where ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM consoles WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    array_push($list, $this->create($result));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

    public function first ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM consoles WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $this->create($result);
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
        public function update($console) {
        $statement = $this->db->prepare("UPDATE games SET name = ? WHERE id = ?");
        try {
            $statement->execute([$console->name, $console->id]);
            $rowsAffected = $statement->rowCount();
            
            if ($rowsAffected > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

}