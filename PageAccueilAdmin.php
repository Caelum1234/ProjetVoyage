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
        <p>
          <a href="#" class="btn btn-primary my-2">Créer un Circuit</a>
        </p>
      </div>
    </div>
  </section>

  <div class="album py-5 bg-body-tertiary">
    <div class="container">

      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Circuit 1" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Circuit 1</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 1</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 1 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 2</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 2 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 3</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 3 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 4</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 4 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 5</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 5 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 6</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 6 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Modifier</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Supprimer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>


<?php require_once('includes/footer.php'); ?>