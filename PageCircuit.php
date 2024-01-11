<?php 

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

require('server_db.php');
require_once('includes/header.php');




// exécuter la requête SQL pour récupérer les données de la table circuit
$sql = "SELECT * FROM circuit";
$result = mysqli_query($connexion, $sql);
// vérifier la requête
if (!$result) {
  echo "Erreur : " . mysqli_error($con);
  exit();
}
// afficher la liste des circuits
echo "<ul>";
// parcourir les résultats de la requête
while ($row = mysqli_fetch_assoc($result)) {
  // stocker les données du circuit dans des variables
  $id = $row["Id_Circ"];
  $descri = $row["Descri"];
  $villeDep = $row["Ville_Dep"];
  $paysDep = $row["Pays_Dep"];
  $paysArr = $row["Pays_Arr"];
  $villeArr = $row["Ville_Arr"];
  $dateDep = $row["Date_Dep"];
  $nbPlaceDisp = $row["Nb_PlaceDisp"];
  $dureeCirc = $row["Duree_Circ"];
  $prixInsc = $row["Prix_Insc"];
  // convertir l'image en une chaîne de caractères
  //$image_data = base64_encode($image);
  // afficher les données du circuit dans un élément HTML
  echo "<li>";
  echo "<h3>$id</h3>";
  echo "<p>Description : $descri</p>";
  echo "<p>Ville de départ : $villeDep</p>";
  echo "<p>Pays de départ : $paysDep</p>";
  echo "<p>Ville d'arrivée : $villeArr</p>";
  echo "<p>Pays d'arrivée : $villeArr</p>";
  echo "<p>Date de départ : $dateDep</p>";
  echo "<p>Nombre de place disponibles : $nbPlaceDisp</p>";
  echo "<p>Durée du circuit : $dureeCirc minutes</p>";
  echo "<p>Prix d'inscription : $prixInsc €</p>";
  echo "<form action='Circuit$id.php'>
          <button type='submit' class='btn btn-sm btn-outline-secondary'>Voir</button>
        </form>";
  echo "<button>Réserver</button>";
  echo "</li>";
}
echo "</ul>";
// fermer la connexion
mysqli_close($con);
?>


  


<?php require_once('includes/footer.php'); ?>