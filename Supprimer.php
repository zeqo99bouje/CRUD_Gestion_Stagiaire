<?php
$id = $_GET['id'];
include_once 'database.php';
$sqlstate = $pdo->prepare('DELETE FROM stagiaire WHERE idStagiaire=?');
$sqlstate->execute([$id]);
header('Location: spaceprivee.php'); 
?>
