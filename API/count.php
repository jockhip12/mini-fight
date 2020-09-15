<?php

include '../personnagesManager.php';

$db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

$m = new PersonnagesManager($db);

$count = $m->count();


header('Access-Control-Allow-Origin: *');
header('Content-type: application/json');
echo json_encode(array('count'=>$count));


?>