<?php
// require('Calcul.php');

interface Calcul {
    public function add($a, $b);
    
    public function substract($a, $b);
    
    public function multiply($a, $b);
    
    public function divide($a, $b);
    
    public function modulo($a, $b);
}



class Calculator implements Calcul {

    private $number1;
    private $number2;

    public function __construct($number1, $number2){
        $this->number1 = $number1;
        $this->number2 = $number2;
    }

    public function add($a, $b){
        return $a + $b;
    }

    public function substract($a, $b){

    }
    
    public function multiply($a, $b){

    }
    
    public function divide($a, $b){

    }
    
    public function modulo($a, $b){

    }


}


/******************Correction********************************* */
require('Calcul.php');
class Calculator implements Calcul {
    private $operation;
    
    public function add($a, $b) {
        $result = $a+$b;
        $this->operation = $a . " + " . $b . " = " . $result;
        return $result;
    }
    
    public function substract($a, $b) {
        $result = $a-$b;
        $this->operation = $a . " - " . $b . " = " . $result;
        return $result;
    }
    
    public function multiply($a, $b) {
        $result = $a*$b;
        $this->operation = $a . " * " . $b . " = " . $result;
        return $result;
    }
    
    public function divide($a, $b) {
        $result = $a/$b;
        $this->operation = $a . " / " . $b . " = " . $result;
        return $result;
    }
    
    public function modulo($a, $b) {
        $result = $a%$b;
        $this->operation = $a . " % " . $b . " = " . $result;
        return $result;
    }
    
    public function __toString () {
        return $this->operation;
    }
}

$calculator = new Calculator();
$calculator->multiply(5, 5);
$calculator->add(5, 5);
echo $calculator;

/*****************Autre façon***************************** */

require('Calcul.php');

class Calculator implements Calcul {
    private $param_a;
    private $param_b;
    private $operation;
    private $result;
    
    private function save($a, $b, $operation) {
        $this->param_a = $a;
        $this->param_b = $b;
        $this->operation = $operation;
    }
    
    public function add($a, $b) {
        $this->result = $a+$b;
        $this->save($a, $b, "+");
        return $this->result;
    }
    
    public function substract($a, $b) {
        $this->result = $a-$b;
        $this->save($a, $b, "-");
        return $this->result;
    }
    
    public function multiply($a, $b) {
        $this->result = $a*$b;
        $this->save($a, $b, "*");
        return $this->result;
    }
    
    public function divide($a, $b) {
        $this->result = $a/$b;
        $this->save($a, $b, "/");
        return $this->result;
    }
    
    public function modulo($a, $b) {
        $this->result = $a%$b;
        $this->save($a, $b, "%");
        return $this->result;
    }
    
    public function __toString () {
        return $this->param_a . " " . $this->operation . " " . $this->param_b . " = " . $this->result;
    }
}

$calculator = new Calculator();
$calculator->add(5, 5);
echo $calculator;

echo "<br>";

$calculator->substract(5, 5);
echo $calculator;

echo "<br>";

$calculator->multiply(5, 5);
echo $calculator;

echo "<br>";

$calculator->divide(5, 5);
echo $calculator;

echo "<br>";

$calculator->modulo(5, 5);
echo $calculator;
/*************************** Benjamin ****************************/

    echo "<br>";
    echo "exercice 2 <br>"; 
    echo "<br>";
    interface ICalcul {
        public function addition();
        public function soustraction();
        public function division();
        public function multiplication();
        public function modulo();
    }

    Class Calculator implements ICalcul {
        private $nb1;
        private $nb2;

        public function __construct($nb1,$nb2) {
            $this->nb1 = $nb1;
            $this->nb2 = $nb2;
        }

        public function __toString()
        {
            return "resultat de ".$this->nb1." et ".$this->nb2."<br> addition: ". $this->addition()."<br>  soustraction : ".$this->soustraction()."<br> division : ".$this->division()."<br> mutliplication : ".$this->multiplication()."<br> modulo : ".$this->modulo()."<br><br>" ;
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

        public function addition(){
            return $this->nb1 + $this->nb2;
        }
        public function soustraction(){
            return $this->nb1 - $this->nb2;
        }
        public function division(){
            if($this->nb2 != 0){
                return $this->nb1/$this->nb2;
            }else{
                return "division impossible par 0";
            }
        }
        public function multiplication(){
            return $this->nb1*$this->nb2;
        }
        public function modulo(){
            if($this->nb2 != 0){
                return $this->nb1%$this->nb2;
            }else{
                return "modulo impossible par 0";
            }
        }
    }
    $calcule1 = new Calculator(4,2);
    echo $calcule1;
    $calcule2 = new Calculator(10,7);
    echo $calcule2;
    $calcule3 = new Calculator(5,0);
    echo $calcule3;
?>