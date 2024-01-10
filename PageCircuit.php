<?php 

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

require('server_db.php');
require_once('includes/header.php');

if(isset($_SESSION['idRole'])){
  $roleUtilisateur = $_SESSION['idRole'];
  
  if($roleUtilisateur == '1'){
    include('dashboardAdmin.php');
    exit();
  } elseif($roleUtilisateur == '0'){
    include('dashboardClient.php');
    exit();
  } else {

  }
} 

?> 

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
  <symbol id="check2" viewBox="0 0 16 16">
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"></path>
  </symbol>
  <symbol id="circle-half" viewBox="0 0 16 16">
    <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
  </symbol>
  <symbol id="moon-stars-fill" viewBox="0 0 16 16">
    <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path>
    <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path>
  </symbol>
  <symbol id="sun-fill" viewBox="0 0 16 16">
    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"></path>
  </symbol>
</svg> 

<? 



?>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Bienvenue chez EPSI Travel !</h1>
        <p class="lead text-body-secondary">Voici tous les circuits touristiques proposés par notre agence.</p>
        <p>
          <a href="#" class="btn btn-primary my-2">Voir mes circuits réservés</a>
        </p>
      </div>
    </div>
  </section>

<?php 

// require('circuit.php');
 require_once('includes/header.php');
  // se connecter à la base de données
  $con = mysqli_connect("localhost", "root", "", "IHM_Gaber");
  // vérifier la connexion
  if (mysqli_connect_errno()) {
    echo "Échec de la connexion : " . mysqli_connect_error();
    exit();
  }

  // exécuter la requête SQL pour récupérer les données de la table circuit
$sql = "SELECT * FROM circuit";
$result = mysqli_query($con, $sql);
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