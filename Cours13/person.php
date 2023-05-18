<?php
header('Content-Type: application/json');
$data = [
    ["name"=>"Ben", "age"=>30],
    ["name"=>"Raph", "age"=>32],
    ["name"=>"Gérard", "age"=>58]

];
echo json_encode($data);
