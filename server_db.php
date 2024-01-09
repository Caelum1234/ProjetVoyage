<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ihm_gaber";

$connexion = mysqli_connect($servername, $username, $password, $dbname);

// verification de la connexion
if (!$connexion) {
    die ("La connexion a echoué : " . mysqli_connect_error());
}

?>