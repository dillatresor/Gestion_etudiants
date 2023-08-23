<?php 
function bd()
{
try {
$bdd= new PDO('mysql:host=localhost;dbname=bd_gestus','root','');

} catch (Exception $e) {
	$e->getMessage();
}
 return $bdd;
}
?>
