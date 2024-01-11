<?php

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

require('server_db.php');

$error = '';
if (isset($_POST['submit'])) {

  extract($_POST);

  // Variables 
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Vérification de la connexion
  if ($connexion->connect_error) {
    die("Connexion échouée : " . $connexion->connect_error);
  }

  // Requête pour vérifier les identifiants dans la base de données
  $sql = "SELECT mail, mdp FROM utilisateur WHERE mail = ? LIMIT 1";
  $stmt = $connexion->prepare($sql);

  if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
      $user = $result->fetch_assoc();
      if (password_verify($password, $user['mdp'])) {

        // Requête pour récupérer toutes les informations de l'utilisateur  
        $info_client = "SELECT * FROM utilisateur WHERE mail = ? LIMIT 1 ";
        $stmt = $connexion->prepare($info_client);

        if ($stmt) {
          $stmt->bind_param("s", $email);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows === 1) {
            // Mettre les informations récupérées dans la $_SESSION et variables 
            $row = $result->fetch_assoc();
            $_SESSION['idUser'] = $row['IdUtilisateur'];
            $idUser = $_SESSION['idUser'];
            $_SESSION['idRole'] = $row['IdRole'];
            $idRole = $_SESSION['idRole'];
          }
        }

        // Requête pour récupérer toutes les informations de la table client  
        $info_client = "SELECT * FROM client WHERE IdUtilisateur = ? LIMIT 1 ";
        $stmt = $connexion->prepare($info_client);

        if ($stmt) {
          $stmt->bind_param("s", $idUser);
          $stmt->execute();
          $result = $stmt->get_result();

          if ($result->num_rows === 1) {
            // Mettre les informations récupérées dans $_SESSION et variables 
            $row = $result->fetch_assoc();
            $_SESSION['nom'] = $row['nom'];
            $nom = $_SESSION['nom'];
            $_SESSION['prenom'] = $row['prenom'];
            $prenom = $_SESSION['prenom'];
          }
        }

        $_SESSION['email'] = $_POST['email'];

        
        if($roleUtilisateur == '0'){
          header("Location: pageAccueilClient.php");
          exit();
        } elseif($roleUtilisateur == '1'){
          header("Location: pageAccueilAdmin.php");
          exit();
        }
        

        // Redirection vers la page d'accueil
        
      } else {
        $error = "incorrect";
      }
    } else {
      // Si l'utilisateur n'existe pas dans la base de données 
      $error = "inexistant";
    }
    $stmt->close();
  } else {
      echo "Erreur lors de la préparation de la requête : " . $connexion->error;
  }
  $connexion->close();
}



?>

<?php require_once('includes/header.php'); ?>

  <div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card bg-light-subtle">
          <div class="card-header">
            <h4 class="text-center">Connexion</h4>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="text" class="form-control" id="email" placeholder="Votre adresse e-mail" name="email"required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password" required>
              </div>
              <div class="d-grid">
                <button type="submit" name="submit" class="btn btn-primary">Se connecter</button>
              </div>
              <?php
                if($error === 'incorrect'){
                  echo "<p style='color: red;'>Le nom d'utilisateur ou le mot de passe est incorrect.</p>";
                }
                if($error === 'inexistant'){
                  echo "<p style='color: red;'>Utilisateur introuvable.<a href='formInscription.php'>inscrivez-vous</a></p>";
                }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php require_once('includes/footer.php'); ?>