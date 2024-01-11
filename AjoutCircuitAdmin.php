<?php

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}


require('server_db.php');

// Récupération des données à afficher sur le dashboard
$circuitRequete = $connexion->query('SELECT * FROM circuit');
$etapeRequete = $connexion->query('SELECT * FROM etape');
$lieuxVisiteRequete = $connexion->query('SELECT * FROM lieux_a_visiter');
$utilisateurRequete = $connexion->query('SELECT * FROM utilisateur');
$reservationRequete = $connexion->query('SELECT * FROM reservation');

$circuit = $circuitRequete->num_rows;
$etape = $etapeRequete->num_rows;
$lieuxVisiste = $lieuxVisiteRequete->num_rows;
$utilisateur = $utilisateurRequete->num_rows;
$reservation = $reservationRequete->num_rows;

require('includes/header.php');

?>
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li><a href="edit/editCircuit.php" class="text-white">Circuits : <?php echo $circuit ?></a></li>
            <li><a href="edit/editEtape.php" class="text-white">Etapes : <?php echo $etape ?></a></li>
            <li><a href="edit/editLieuxVisite.php" class="text-white">Lieux de visite : <?php echo $lieuxVisiste ?></a></li>
            <li><a href="edit/editUser.php" class="text-white">Utilisateurs : <?php echo $utilisateur ?></a></li>
            <li><a href="edit/editReservataion.php" class="text-white">Réservations : <?php echo $reservation ?></a></li>
            <li><a href="connexion.php" class="text-white">Se déconnecter</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="" class="navbar-brand d-flex align-items-center">
      <img src= img/logoBDD.png width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle>
        <strong>EPSI Travel</strong> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<main>

  <section class="py-5 text-center container">
    <div class="row py-lg-5">
      <div class="col-lg-6 col-md-8 mx-auto">
        <h1 class="fw-light">Page admin</h1>
        <h2 class="fw-light">Création de Circuits</h2>
      </div>
    </div>
  </section>
  
  <form action="editCircuit.php" method="post">
  <p>Description du circuit :</p>
  <input type="text" name="description" required>
  <p>Ville de départ :</p>
  <input type="text" name="ville_depart" required>
  <p>Pays de départ :</p>
  <input type="text" name="pays_depart" required>
  <p>Ville d'arrivée :</p>
  <input type="text" name="ville_arrivee" required>
  <p>Pays d'arrivée :</p>
  <input type="text" name="pays_arrivee" required>
  <p>Date de départ :</p>
  <input type="date" name="date_depart" required>
  <p>Nombre de place disponible :</p>
  <input type="number" name="nb_place" required>
  <p>Durée du circuit :</p>
  <input type="number" name="duree" required>
  <p>Prix d'inscription :</p>
  <input type="number" name="prix" required>
  <input type="submit" name="insert" value="Ajouter le circuit">
</form>


</main>


<?php require_once('includes/footer.php'); ?>