<?php
$con = mysqli_connect("localhost", "root", "", "IHM_Gaber");
// vérifier la connexion
if (mysqli_connect_errno()) {
  echo "Échec de la connexion : " . mysqli_connect_error();
  exit();
}

// Récupération des données du formulaire
$description = $_POST["description"]; 
$ville_depart = $_POST["ville_depart"]; 
$pays_depart = $_POST["pays_depart"]; 
$ville_arrivee = $_POST["ville_arrivee"]; 
$pays_arrivee = $_POST["pays_arrivee"]; 
$date_depart = $_POST["date_depart"]; 
$nb_place = $_POST["nb_place"]; 
$duree = $_POST["duree"]; 
$prix = $_POST["prix"]; 
$id = $_POST["id"]; 

// Préparation de la requête SQL
$sql = "UPDATE Circuit SET Descri = ?, Ville_dep = ?, Pays_dep = ?, Ville_arr = ?, Pays_arr = ?, Date_dep = ?, Nb_PlaceDisp = ?, Duree_Circ = ?, Prix_insc = ? WHERE Id_Circ = ?"; // Requête SQL avec des paramètres
$stmt = $con->prepare($sql); 
$stmt->bind_param("ssssssiiii", $description, $ville_depart, $pays_depart, $ville_arrivee, $pays_arrivee, $date_depart, $nb_place, $duree, $prix, $id); // Liaison des paramètres avec les valeurs

// Exécution de la requête SQL
if ($stmt->execute()) { 
  echo "Le circuit a été modifié avec succès."; 
} else { // Sinon
  echo "Erreur : " . $stmt->error; 
}

// Fermeture de la connexion
$stmt->close(); 
$con->close(); 
