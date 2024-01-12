<?php

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

require('server_db.php');

// Requête pour récupérer toutes les informations du client  
$info_client = "SELECT * FROM client WHERE IdUtilisateur = ? LIMIT 1 ";
$stmt = $connexion->prepare($info_client);

$idClient = $_SESSION['idUser'];

if ($stmt) {
$stmt->bind_param("i", $_SESSION['idUser']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    // Mettre les informations récupérées dans $_SESSION et variables 
    $row = $result->fetch_assoc();
    $_SESSION['nom'] = $row['Nom'];
    $nom = $_SESSION['nom'];
    $_SESSION['prenom'] = $row['Prenom'];
    $prenom = $_SESSION['prenom'];
}
}


// Récupération des données à afficher sur la page
$circuitRequete = $connexion->query('SELECT * FROM circuit');
$reservationRequete = $connexion->query("SELECT * FROM reservation WHERE id_Client = {$idClient}");

$circuit = $circuitRequete->num_rows;
$reservationClient = $reservationRequete->num_rows;

require('includes/header.php');

?>
    
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li><a href="edit/editCircuit.php" class="text-white">Circuit disponible : <?php echo $circuit ?></a></li>
            <li><a href="CircuitsReserves.php" class="text-white">Mes reservations : <?php echo $reservationClient ?></a></li>
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
        <h1 class="fw-light">Page Client</h1>
        <h2>Bienvenue <?php echo $prenom ?></h2>
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
              <p class="card-text">Circuit 1 de Créteil à Lovran</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 2</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 2 de Khuean à Postira</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 3</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 3 de Zhishan à Long Hồ</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
                 
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 4</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 4 de Majayjay à Bourges</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 5</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 5 de Estarreja à Yuza</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card shadow-sm">
            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Circuit 6</text></svg>
            <div class="card-body">
              <p class="card-text">Circuit 6 de Tamamura à Yueyahe</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary">Voir</button>
                  <button type="button" class="btn btn-sm btn-outline-secondary">Réserver</button>
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