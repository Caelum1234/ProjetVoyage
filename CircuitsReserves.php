<?php 

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}


require_once('includes/header.php');
require('server_db.php');

// Récupération des données à afficher sur la page
$circuitRequete = $connexion->query('SELECT * FROM circuit');
$reservationRequete = $connexion->query("SELECT * FROM reservation WHERE Id_Client = " . $_SESSION['idClient'] );

$circuit = $circuitRequete->num_rows;
$reservationClient = $reservationRequete->num_rows;


?> 

    
<header data-bs-theme="dark">
  <div class="collapse text-bg-dark" id="navbarHeader">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 offset-md-1 py-4">
          <ul class="list-unstyled">
            <li><a href="PageAccueilClient.php" class="text-white">Circuit disponible : <?php echo $circuit ?></a></li>
            <li><a href=" " class="text-white">Mes reservations : <?php echo $reservationClient ?></a></li>
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

<!-- Contenu principal de la page  -->
<div class="main d-flex justify-content-center align-items-center">

    <div class="containerPrincipal">
        <h1>Mes Réservations</h1>

        <?php

        // Requete pour récupérer les réservations de l'utilisateur en cours
        $sql = "SELECT * FROM reservation WHERE Id_Client = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("i", $_SESSION['idClient']);
        $stmt->execute();
        $result = $stmt->get_result();

        // Boucle pour afficher les reservation si il y en a dans la base de donnés
        if ($result->num_rows > 0) {

            while ($row = $result->fetch_assoc()) {
                echo '<div class="card" style="width: 18rem;">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title">Circuit n°' . $row['Id_Circ'] . '</h5>';
                echo "<li class='list-group-item'>Au nom de : ". $_SESSION['nom'] ." " . $_SESSION['prenom'] . "</li>";
                echo "<li class='list-group-item'>Nombre de places : ". $row['Nb_places'] . " personnes</li>";
                echo '</br>';
                echo "<button class='btn-supprimer-reservation btn btn-outline-dark' data-circuit='" . $row['Id_Circ'] . "' data-client='" . $row['Id_Client'] . "'>Annuler la réservation</button>";
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>Pas de réservation.</p>';
        }
        ?>

    </div>

</div>


<script>
    // Attend que le document soit chargé
    document.addEventListener("DOMContentLoaded", function () {
        // Recupere tous les boutons de suppression de reservation
        const btnsSupprimerReservation = document.querySelectorAll('.btn-supprimer-reservation');

        // Pour chaque bouton
        btnsSupprimerReservation.forEach(btn => {
            // Ajoute un écouteur d'événement sur le clic
            btn.addEventListener('click', function () {
                // Récupère l'ID de la réservation depuis l'attribut data-id
                const idCircuit = this.getAttribute('data-circuit');
                const idClient = this.getAttribute('data-client');

                // Envoie une requête POST au serveur pour supprimer la réservation
                fetch('supprimerReservation.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'id_circuit=' + encodeURIComponent(idCircuit) + '&id_client=' + encodeURIComponent(idClient),
                })
                .then(response => {
                    if (response.ok) {
                        // Si la suppression a réussi, actualise la page pour refléter les changements
                        window.location.reload();
                    } else {
                        // Gère les erreurs en fonction de la réponse du serveur
                        console.error('Erreur lors de la suppression de la réservation');
                    }
                })
                .catch(error => {
                    console.error('Erreur lors de la suppression de la réservation', error);
                });
            });
        });
    });
</script>

<?php require_once('includes/footer.php'); ?>