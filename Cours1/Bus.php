<!-- 5) En vous inspirant de la classe Car fournie, réalisez une classe Bus, qui contient
plusieurs attributs (brand, model, power, color, occupancy et max_occupancy), des
getters & setters pour ses attributs ainsi que la méthode open_doors , la méthode
take_passengers et la méthode drop_passengers . 
6) Faites en sorte de gérer la quantité de personnes présente dans le bus et affichez un
message d’erreur lorsque celle ci essaye de dépasser sa limite
$myBus->getOccupancy()
=> 58/60
$myBus->take_passengers(5)
=> Le bus ne peut prendre que 2 passagers
$myBus->drop_passengers(10)
$myBus->take_passengers(5)
$myBus->getOccupancy()
=> 53/60
-->

<!DOCTYPE html>
<html>
<head>
    <title>Bus example</title>
</head>
<body>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('Transport.php');

class Bus extends Transport {
    protected $occupancy;
    protected $maxOccupancy;
    protected $passengerCount;

    public function __construct($make, $model, $color, $maxSpeed, $maxOccupancy) {
        parent::__construct($make, $model, $color, $maxSpeed, $maxOccupancy);
        $this->occupancy = 0;
        $this->maxOccupancy = $maxOccupancy;
        $this->passengerCount = 0;
    }

    public function getOccupancy() {
        return $this->occupancy;
    }

    public function getMaxOccupancy() {
        return $this->maxOccupancy;
    }

    public function getPassengerCount() {
        return $this->passengerCount;
    }

    public function take_passenger($num_passengers) {
        $remaining = $this->maxOccupancy - $this->occupancy;
        $num_passengers_taken = min($num_passengers, $remaining);
        $this->occupancy += $num_passengers_taken;
        $this->passengerCount += $num_passengers_taken;
        return $num_passengers_taken;
    }

    public function drop_passenger($num_passengers) {
        $num_passengers_dropped = min($num_passengers, $this->occupancy);
        $this->occupancy -= $num_passengers_dropped;
        $this->passengerCount -= $num_passengers_dropped;
        return $num_passengers_dropped;
    }

    public function accelerate($mph) {
        $this->currentSpeed += $mph;
        if ($this->currentSpeed > $this->maxSpeed) {
            $this->currentSpeed = $this->maxSpeed;
        }
    }

    public function brake() {
        $this->currentSpeed = 0;
    }

    public function open_doors() {
        echo "<p>Les portes du bus sont ouvertes.</p>";
    }
}


// Create a new bus
$bus = new Bus("Ford", "bibibus", "red", 120, 4);

// Accelerate the bus
$bus->accelerate(70);

// Take a passenger
$passenger_taken = $bus->take_passenger(1);

// Drop a passenger
$passenger_dropped = $bus->drop_passenger(1);

// Display the bus's properties in the browser
echo "<h1>".$bus->getMake()." ".$bus->getModel()."</h1>";
echo "<p>Couleur: ".$bus->getColor()."</p>";
echo "<p>Vitesse actuelle: ".$bus->getCurrentSpeed()." km/h</p>";
echo "<p>Vitesse maximum: ".$bus->getMaxSpeed()." km/h</p>";
echo "<p>Place prise: ".$bus->getOccupancy()."/".$bus->getMaxOccupancy()."</p>";
echo "<p>Passager pris: ".$passenger_taken."</p>";
echo "<p>Passager descendu: ".$passenger_dropped."</p>";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bus = new Bus("Mercedes-Benz", "Sprinter", "blanc", 60, 16);

    if (isset($_POST["accelerate"])) {
        $bus->accelerate(30);
        echo "<p>Le bus accélère à ".$bus->getCurrentSpeed()." km/h.</p>";
    } elseif (isset($_POST["stop"])) {
        $bus->brake();
        echo "<p>Le bus est arrêté.</p>";
    } elseif (isset($_POST["take_passenger"])) {
        $num_passengers_taken = intval($_POST["num_passengers_taken"]);
        if ($num_passengers_taken > 0) {
            $num_passengers_taken = $bus->take_passenger($num_passengers_taken);
            if ($num_passengers_taken > 0) {
                echo "<p>".$num_passengers_taken." passager(s) ont été pris. Nombre de passagers ".$bus->getOccupancy()."/".$bus->getMaxOccupancy()."</p>";
            } else {
                echo "<p>Le bus est plein. Aucun passager pris.</p>";
            }
        }
    } elseif (isset($_POST["drop_passenger"])) {
        $num_passengers_dropped = intval($_POST["num_passengers_dropped"]);
        if ($num_passengers_dropped > 0) {
            $num_passengers_dropped = $bus->drop_passenger($num_passengers_dropped);
            if ($num_passengers_dropped > 0) {
                echo "<p>".$num_passengers_dropped." passager(s) ont été descendu(s). Nombre de passagers ".$bus->getOccupancy()."/".$bus->getMaxOccupancy()."</p>";
            } else {
                echo "<p>Le bus est vide. Aucun passager descendu.</p>";
            }
        }
    }
}
?>

<form method="post">
    <h2>Contrôles du bus</h2>
    <label>
        <input type="submit" name="accelerate" value="Accélérer">
    </label>
    <label>
        <input type="submit" name="stop" value="Stop">
    </label>
    <h2>Contrôles des passagers</h2>
    <label>
        Prendre des passagers:
        <input type="number" name="num_passengers_taken" min="1" max="16" value="1">
        <input type="submit" name="take_passenger" value="Prendre">
    </label>
    <label>
        Déposer des passagers:
        <input type="number" name="num_passengers_dropped" min="1" max="16" value="1">
        <input type="submit" name="drop_passenger" value="Déposer">
    </label>
</form>
</body>
</html>
