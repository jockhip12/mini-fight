<?php

include 'personnagesManager.php';
include 'personnage.php';
session_start();
$db = new PDO('mysql:host=localhost;dbname=combats', 'root', '');

$m = new PersonnagesManager($db);

$nom = $_SESSION['nom'];

$perso = $m->getByName($nom);

$persos = $m->getList($nom);

?>


<p>

	Nombre de personnage crées :  <?= $m->count(); ?>

</p>

<div>

<h3> Mes informations </h3>

id : <?= $perso->id() ; ?> <br/>

Nom : <?= $perso->nom() ; ?> <br/>

Dégats : <?= $perso->degats() ; ?>

</div>

<br/>
<br/>
<div>

	<label> Qui frapper </label>


	<?php 

	foreach ($persos as $key => $personne) {

		echo "<br>";


	 echo '<a href="frapper.php?idPersoAfrapper=', $personne->id(), '">', $personne->nom(), '</a> (dégâts : ', $personne->degats(), ')<br />';
  	
	}



	?>


</div>