<?php 
function bd()
{
try {
$bdd= new PDO('mysql:host=localhost;dbname=gestion_etudiant','root','');

} catch (Exception $e) {
	$e->getMessage();
}
 return $bdd;
}
?>
