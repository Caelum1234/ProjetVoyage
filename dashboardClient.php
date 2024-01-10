<?php

require('server_db.php');

// Récupération des données à afficher sur le dashboard
$circuitRequete = $connexion->query('SELECT * FROM circuit');
$utilisateurRequete = $connexion->query('SELECT * FROM utilisateur');
$circuit = $circuitRequete->num_rows;
$utilisateur = $utilisateurRequete->num_rows;

require('includes/header.php');

?>
    
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li><a href="edit/editCircuit.php" class="text-white">Circuit : <?php echo $circuit ?></a></li>
            <li><a href="edit/editUser.php" class="text-white">Utilisateur : <?php echo $utilisateur ?></a></li>
            <li><a href="#" class="text-white">Se déconnecter</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="navbar navbar-dark bg-dark shadow-sm">
    <div class="container">
      <a href="#" class="navbar-brand d-flex align-items-center">
      <img src= img/logoBDD.png width="40" height="40" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle>
        <strong>EPSI Travel</strong> 
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
  </div>
</header>

<?php require('includes/footer.php'); ?>