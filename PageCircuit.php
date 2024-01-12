

<?php 

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

require('server_db.php');
require_once('includes/header.php');
?>

<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li><a href="PageCircuit.php" class="text-white">Circuit disponible : <?php echo $circuit ?></a></li>
            <li><a href="CircuitsReserves.php" class="text-white">Mes reservations : <?php echo $reservationClient ?></a></li>
            <li><a href="connexion.php" class="text-white">Se déconnecter</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="PageAccueilClient.php" class="navbar-brand d-flex align-items-center">
      <img src= img/logoBDD.png width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle>
        <strong>EPSI Travel</strong>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<?php
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
  echo "<p>Pays d'arrivée : $paysArr</p>";
  echo "<p>Date de départ : $dateDep</p>";
  echo "<p>Nombre de place disponibles : $nbPlaceDisp</p>";
  echo "<p>Durée du circuit : $dureeCirc minutes</p>";
  echo "<p>Prix d'inscription : $prixInsc €</p>";
  echo "<form action='Circuit$id.php'>
          <button type='submit' class='btn btn-sm btn-outline-secondary'>Voir</button>
        </form>";
  echo "</li>";
}
echo "</ul>";
// fermer la connexion
mysqli_close($con);
?>


  


<?php require_once('includes/footer.php'); ?>