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
$reservationRequete = $connexion->query("SELECT * FROM reservation WHERE id_Client = {$_SESSION['idUser']}");

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
            <li><a href=" " class="text-white">Circuit disponible : <?php echo $circuit ?></a></li>
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

    // Si les donnés du formulaire ont ete soumis
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Affectation des donnés du formulaire a 
        $circuit_a_reserver = $_POST['circuit'];
        $placeDemander = $_POST['place_demander'];
    
        // Requete pour recuperer l'ID de la seance sportive
        $stmt = $connexion->prepare("SELECT Id_Circ, Prix_Insc FROM circuit WHERE Id_Circ = ?");
        $stmt->bind_param("i", $circuit_a_reserver);
        $stmt->execute();
        $stmt->bind_result($circuit_info, $prix);
        $stmt->fetch();
        $stmt->close();

        // verifie si pas deja reserver 
        $stmt = $connexion->prepare("SELECT Id_Circ, Id_Client FROM reservation WHERE Id_Circ = ? and Id_Client = ? ");
        $stmt->bind_param("ss", $circuit_a_reserver, $_SESSION['idUser']);
        $utilisateurExistant = $stmt->execute();

        if (!$utilisateurExistant) {
            // Requete d'insertion dans la table reservation
            $stmt = $connexion->prepare("INSERT INTO reservation (Id_Circ, Id_Client, Prix_tot, NB_places) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $circuit_a_reserver, $_SESSION['idUser'], $prix, $placeDemander);
            $stmt->execute();

            // Si l'insertion s'est bien déroulé
            if ($stmt->affected_rows > 0) {
                        
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Votre réservation a été enregistrée avec succès !
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

                $stmt->close();
                $connexion->close();

            } else {
                // Si echec de l'insertion
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Erreur lors de l\'enregistrement de la réservation.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                        
                $stmt->close();
                $connexion->close();
            }

        } else {

            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Vous avez deja reserver ce circuit.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
        }
    
        
        
    }

?>
    


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
              <p class="card-text">Circuit 1 de "" à ""</p>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Réserver 
                </button>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Réserver 
                </button>
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
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Réserver 
                </button>
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

  <?php 



  ?>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Réservation</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <label class="text-dark" for="date">Circuit voulu : </label>
                        <select name="circuit" id="circuit" require>
                            <option value="">------</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>
                        <br>
                        <label for="place_demander">Combien de personnes :</label>
                        <input type="number" id="place_demander" name="place_demander" min="1" max="10" require/>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</main>


<?php require_once('includes/footer.php'); ?>