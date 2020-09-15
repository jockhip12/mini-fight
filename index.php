<?php 
include 'personnagesManager.php';
include 'personnage.php';
session_start();
$db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

$m = new PersonnagesManager($db);

/* if(isset($_GET['userExist'])) {

		echo 'Ce personnage existe dejà';
	}
	*/


if (isset($_GET['creer'])){
	// traitement creer 

	// test if user exist

	if(isset($_GET['nom'])) {
		$res = $m->exists($_GET['nom']);
		if (!$res) {
			// user not exist -> créer ce personnage
			$perso = new Personnage(["nom" => $_GET['nom']]);
			$m->add($perso);

			// create session
			$_SESSION["nom"] = $_GET['nom'];

			// redirection home

			header('location: home.php');
		} else {
			// user exist -> msg erreur
			echo "<h3 style='color:red'>Ce personnage existe dejà! </h3>";
			// header('location: index?php?userExist=true');
		}

	}

	

	
} elseif (isset($_GET['utiliser']) && isset($_GET['nom'])) {
    // traitement utiliser

    $res = $m->exists($_GET['nom']);

    if($res) {
    	
    	// create session
    	$_SESSION["nom"] = $_GET['nom'];

    	// redirection home.php
    	header('location: home.php');
    } else {
    	// afficher msg erreur user doesn't exixt

    	echo "<h3 style='color:red'>Ce personnage n'existe pas!  </h3>";

    }
}

?>
<p>

	Nombre de personnage crées :  <?= $m->count(); ?>

</p>

<form name="myform" action="" method="get">
	<div>

	Nom : <input type="text" name="nom" value=""> <input type="submit" name="creer" value="Créer"> <input type="submit" name="utiliser" value="utiliser">


</div>	

</form>

