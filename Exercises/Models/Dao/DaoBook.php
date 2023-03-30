<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class DaoBook{
    private $db;

    public function __construct(){
        $this->connect();
    }

    public function connect() {
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }

    public function fetch($id){
        $statement = $this->db->prepare("SELECT * FROM book WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                // echo "<pre>";
                // print_r($result);
                // echo "</pre>";
                return $this->create($result);
            }
            return false;

        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }


    public function create ($data) {
        if(empty($data["id"])){
            return false;
        }
        return new Book(
            $data["id"] ?? false,
            $data["title"] ?? false,
            $data["author"] ?? false,
            $data["genre"] ?? false
        );
    }

    public function fetch_all() {
        $statement = $this->db->prepare("SELECT * FROM book");
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

    public function store($book) {
        $statement = $this->db->prepare("INSERT INTO book (title, author, genre) VALUES (?, ?, ?)");
        try {
            $statement->execute([$book->title, $book->author, $book->genre]);
            $connection_db = $this->db;
            $last_id = $connection_db->lastInsertId();
            $book->id = $last_id;
            return $book;
        } catch (PDOException $exception){
            var_dump($exception);
            return false;
        }
    }

    public function destroy($id){
        $statement = $this->db->prepare("DELETE FROM book WHERE id = ?");
        try {
            $statement->execute([$id]);
            return true;

        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }

    public function where($column, $value){
        $statement = $this->db->prepare("SELECT * FROM book WHERE {$column} = ?");
        try {
            $statement->execute([$value]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if($results){
                $list = array();
                foreach($results as $result){
                    array_push($list,$this->create($result));
                }
                return $list;
            }
            return false;
        } catch (PDOException $exception){
            var_dump($exception);
        }
    }

    public function first ($column, $value){
        $statement = $this->db->prepare("SELECT * FROM book WHERE {$column} = ?");
        try {
            $statement->execute([$value]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);

            if($result){
                return $this->create($result);
            }
            return false;
        } catch (PDOException $exception){
            var_dump($exception);
        }
    }
}


















?>