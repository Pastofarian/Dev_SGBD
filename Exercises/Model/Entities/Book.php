<?php

class Book {

    private $id;
    private $title;
    private $author;
    private $genre;

    public function __construct ($id, $title, $author, $genre){
        $this->id = $id;
        $this->title = $title;
        $this->author = $author; 
        $this->genre = $genre; 
    }

    public function __get ($prop) {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
    }
    
    public function __set ($prop, $value) {
        if (property_exists($this, $prop)) {
            $this->$prop = $value;
        }
    }

    public function __toString () {
        return "{$this->id} : {$this->name} ({$this->type})";
    }

}





















?>
