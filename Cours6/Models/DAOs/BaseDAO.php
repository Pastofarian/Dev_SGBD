<?php

abstract class BaseDAO {

    protected $db;
    protected $tableName; //protected permets aux enfant de modifier la variable
    
    public function __construct ($tableName) {
        $this->connect();
        $this->tableName = $tableName;
    }
    
    public function connect () {
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    
    // 
    abstract protected function createEntity($data);

    
    public function fetch ($id) {
        $statement = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $this->createEntity($result);
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function fetch_all () {
        $statement = $this->db->prepare("SELECT * FROM {$this->tableName}");
        try {
            $statement->execute();
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    array_push($list, $this->createEntity($result));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function destroy ($id) {
        $statement = $this->db->prepare("DELETE FROM {$this->tableName} WHERE id = ?");
        try {
            $statement->execute([$id]);
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function where ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    array_push($list, $this->createEntity($result));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function first ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM {$this->tableName} WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $this->createEntity($result);
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }

}

    // public function save(array $columns, array $values) {
    //     $columnNames = implode(', ', $columns);
    //     $placeholders = implode(', ', array_fill(0, count($values), '?'));
    
    //     $statement = $this->db->prepare("INSERT INTO {$this->tableName} ({$columnNames}) VALUES ({$placeholders})");
    //     try {
    //         $statement->execute($values);
    //         $lastInsertId = $this->db->lastInsertId();
    //         return $lastInsertId;
    //     } catch (PDOException $exception) {
    //         var_dump($exception);
    //         return false;
    //     }
    // }
    
    
