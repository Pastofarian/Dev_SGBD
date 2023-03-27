<!-- 7) Créez une classe mère “Transport” qui sera héritée par Car & Bus, ajoutez-y toutes les
données que vous jugez nécessaire pour éviter un maximum de redondance
Faites en sorte que la classe Transport ne puisse pas être instanciée -->
<?php
abstract class Transport {
    protected $make;
    protected $model;
    protected $color;
    protected $currentSpeed;
    protected $maxSpeed;
    protected $occupancy;
    protected $maxOccupancy;

    public function __construct($make, $model, $color, $maxSpeed, $maxOccupancy) {
        $this->make = $make;
        $this->model = $model;
        $this->color = $color;
        $this->currentSpeed = 0;
        $this->maxSpeed = $maxSpeed;
        $this->occupancy = 0;
        $this->maxOccupancy = $maxOccupancy;
    }

    public function getMake() {
        return $this->make;
    }

    public function getModel() {
        return $this->model;
    }

    public function getColor() {
        return $this->color;
    }

    public function getCurrentSpeed() {
        return $this->currentSpeed;
    }

    public function getMaxSpeed() {
        return $this->maxSpeed;
    }

    public function getOccupancy() {
        return $this->occupancy;
    }

    public function getMaxOccupancy() {
        return $this->maxOccupancy;
    }

    abstract public function accelerate($mph);

    public function brake() {
        $this->currentSpeed = 0;
    }
}
