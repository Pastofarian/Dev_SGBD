<?php
header('Content-Type: application/json');

$name = $_GET['name'];

$people = [
    "Ben" => ["name"=>"Ben", "age"=>30, "job"=>"informaticien", "city"=>"Wavre"],
    "Raph" => ["name"=>"Raph", "age"=>32, "job"=>"informaticien", "city"=>"Wavre"],
    "Gérard" => ["name"=>"Gérard", "age"=>58, "job"=>"Prof", "city"=>"Wavre"]
];

if(isset($people[$name])){
    echo json_encode($people[$name]);
}else{
    echo json_encode(["error" => "Person not found"]);
}
