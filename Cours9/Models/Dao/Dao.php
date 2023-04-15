<?php

abstract class Dao implements InterfaceDao {
    protected $table;
    
    public function __construct ($table) {
        $this->table = $table;
        $this->connect();
    }
    
    public function connect () {
        $this->db = new PDO('mysql:host=localhost;dbname=games', 'root', 'toto');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    }
    
    public function fetch ($id) {
        $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $this->create($result);
            }
            return false;
            
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function fetch_all () {
        $statement = $this->db->prepare("SELECT * FROM {$this->table}");
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
    
    public function where ($attr, $value) {
        $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$attr} = ?");
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
        $statement = $this->db->prepare("SELECT * FROM {$this->table} WHERE {$attr} = ?");
        try {
            $statement->execute([$value]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            //file_put_contents('/tmp/debug.txt', $exception->getMessage()); 
            if ($result) {
                return $this->create($result);
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
    
    public function destroy ($id) {
        $statement = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ?");
        try {
            $statement->execute([$id]);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return true;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function insert ($statement, $data, $obj) { 
        try {
            $statement->execute($data);
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $obj->id = $this->db->lastInsertId();
            return $obj;
        } catch (PDOException $exception) {
            var_dump($exception);
            return false;
        }
    }
    
    public function intermediate ($table, $key, $value, $foreign) {
        $statement = $this->db->prepare("SELECT {$foreign} FROM {$table} WHERE {$key} = ?");
        try {
            $statement->execute([$value]);
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ($results) {
                $list = array();
                foreach($results as $result) {
                    array_push($list, $this->fetch($result[$foreign]));
                }
                return $list;
            }
            return false; 
        } catch (PDOException $exception) {
            var_dump($exception);
        }
    }
}