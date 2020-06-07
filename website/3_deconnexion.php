<?php
session_start();
$_SESSION = array();
session_destroy();  # on ferme la session actuelle
header("Location: index.php"); # puis on redirige l'utilisateur vers la page d'acceuile
?>
