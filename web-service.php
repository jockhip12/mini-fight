<?php

include 'personnagesManager.php';
include 'personnage.php';

$db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

$m = new PersonnagesManager($db);

$x = $m->count();


	header('Content-type: application/json');
		echo json_encode(array('posts'=>$x));


?>