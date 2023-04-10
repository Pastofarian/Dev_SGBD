<?php

abstract class BaseDAO implements InterfaceDAO {

    protected $db;
    protected $tableName; 
    
    public function __construct ($tableName) {
        $this->connect();
        $this->tableName = $tableName;
    }
    
    public function connect () {
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    

    abstract protected function createEntity($data);

    public function insertStore ($statement, $data, $obj) { 
        try {
            $statement->execute($data);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $obj->id = $this->db->lastInsertId();
            return $obj;
        } catch (PDOException $exception) {
            echo "Error in insertStore: " . $exception->getMessage();
            return false;
        }
    }
    
    public function insertUpdate($statement, $data, $obj) {
        try {
            $statement->execute($data);
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
