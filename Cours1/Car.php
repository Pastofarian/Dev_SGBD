<?php
require_once('Transport.php');
class Car extends Transport {
    private $power;

    public function __construct($make, $model, $power, $color, $maxSpeed, $maxOccupancy) {
        parent::__construct($make, $model, $color, $maxSpeed, $maxOccupancy);
        $this->power = $power;
    }

    public function getPower() {
        return $this->power;
    }

    public function setPower($power) {
        $this->power = $power;
    }

    public function ride() {
        echo "La voiture {$this->make} {$this->model} roule.";
    }

    public function accelerate($mph) {
        if ($mph > $this->maxSpeed) {
            $this->currentSpeed = $this->maxSpeed;
        } else {
            $this->currentSpeed = $mph;
        }
    }
}



// class Car {
//     private $brand;
//     private $model;
//     private $power;
//     private $color;
    
//     public function __construct($brand, $model, $power, $color) {
//         $this->brand = $brand;
//         $this->model = $model;
//         $this->power = $power;
//         $this->color = $color;
//     }
    
//     public function ride () {
//         echo "la voiture {$this->brand} {$this->model} roule.";
//     }
    
//     public function getBrand () {
//         return $this->brand;
//     }
    
//     public function getModel () {
//         return $this->model;
//     }
    
//     public function getPower () {
//         return $this->power;
//     }
    
//     public function getColor () {
//         return $this->color;
//     }
    
//     public function setBrand ($brand) {
//         $this->brand = $brand;
//     }
    
//     public function setModel ($model) {
//         $this->model = $model;
//     }
    
//     public function setPower ($power) {
//         $this->power = $power;
//     }
    
//     public function setColor ($color) {
//         $this->color = $color;
//     }
//  }