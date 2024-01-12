<?php


  // se connecter à la base de données
  $con = mysqli_connect("localhost", "root", "", "IHM_Gaber");
  // vérifier la connexion
  if (mysqli_connect_errno()) {
    echo "Échec de la connexion : " . mysqli_connect_error();
    exit();
  }

require_once('includes/header.php');

$description = $_POST["description"]; 
$ville_depart = $_POST["ville_depart"]; 
$pays_depart = $_POST["pays_depart"]; 
$ville_arrivee = $_POST["ville_arrivee"]; 
$pays_arrivee = $_POST["pays_arrivee"]; 
$date_depart = $_POST["date_depart"]; 
$nb_place = $_POST["nb_place"]; 
$duree = $_POST["duree"]; 
$prix = $_POST["prix"]; 

// Préparation de la requête SQL
$sql = "INSERT INTO Circuit (Descri, Ville_dep, Pays_dep, Ville_arr, Pays_arr, Date_dep, Nb_PlaceDisp, Duree_Circ, Prix_insc) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"; // Requête SQL avec des paramètres
$stmt = $con->prepare($sql); // Préparation de la requête
$stmt->bind_param("ssssssiii", $description, $ville_depart, $pays_depart, $ville_arrivee, $pays_arrivee, $date_depart, $nb_place, $duree, $prix); // Liaison des paramètres avec les valeurs

// Exécution de la requête SQL
if ($stmt->execute()) {
  header("Location: PageAccueilAdmin.php?circuit=add_success");
} else {
  header("Location: PageAccueilAdmin.php?circuit=add_error");
}

// Fermeture de la connexion
$stmt->close(); 
$con->close(); 

?>
