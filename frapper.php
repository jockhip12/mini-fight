<?php
include 'personnagesManager.php';
include 'personnage.php';
session_start();

$db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

$m = new PersonnagesManager($db);

// récupérer id user à  frapper

if (isset($_GET['idPersoAfrapper'])) {
	$persoAFrapper = $m->getById($_GET['idPersoAfrapper']);
}

if (isset($_SESSION['nom'])) {
	$perso = $m->getByName($_SESSION['nom']);
}

$retour = $perso->frapper($persoAFrapper);


switch ($retour) {
	case 1:
		echo 'chbi tedhreb fi rou7ek';
		break;

	case 2:
		$m->delete($persoAFrapper);
		header('location: home.php');
		break;

	case 3:
		$m->update($persoAFrapper);
		header('location: home.php');
		break;
	
	default:
		# code...
		break;
}

?>