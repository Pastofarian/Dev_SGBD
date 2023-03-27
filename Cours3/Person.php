<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Person{

    private $firstname;
    private $lastname;
    private $age;

    public function __construct($firstname, $lastname, $age){
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->age = $age;
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

    public function __toString()
    {
        return $this->firstname . " " . $this->lastname . " à " . $this->age . ".";
    }

}

$johnDoe = new Person("John", "Doe", "41");

echo $johnDoe;


// echo $johnDoe->firstname;



?>