<?php

// Vérifier si la session est active
if (session_status() == PHP_SESSION_NONE) {
  // Démarrer la session
  session_start();
}

// Includes & Requires 
require('server_db.php');

// Si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Verifie si tous les champs sont présents
  if (
    isset($_POST['email']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['date']) &&
    isset($_POST['password']) && isset($_POST['confirmPassword'])
  ) {

    // Affecte chaque champ du formulaire à une variable 
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $password = $_POST['password'];
    $confirmationPassword = $_POST['confirmPassword'];

    // Si les champs password et confirmationPassword ne correspondent pas : mesage d'erreur
    if ($password !== $confirmationPassword) {
      header("Location: inscription.php?error=password_different");
      exit();
    }

    // Verifie si l'adresse mail n'est pas deja dans la base de données
    $requestMailExist = "SELECT * FROM utilisateur WHERE mail = ?";
    $stmt_verif_mail = $connexion->prepare($requestMailExist);
    $stmt_verif_mail->bind_param("s", $email);
    $stmt_verif_mail->execute();
    $result = $stmt_verif_mail->get_result();

    // Vérifie si des resultats ont ete renvoyé
    if ($result->num_rows > 0) {
      // Le mail existe deja dans la base de donnés
      header("Location: inscription.php?error=user_exist");
      exit();
    }



    // Hachage du mot de passe
    $motDePasseHache = password_hash($password, PASSWORD_DEFAULT);



    // Insertion dans la table utilisateur
    $insert_user = "INSERT INTO utilisateur (mdp, mail) VALUES (?, ?)";
    $stmt_user = $connexion->prepare($insert_user);
    $stmt_user->bind_param("ss", $motDePasseHache, $email);
    $success = $stmt_user->execute();

    if ($success) {

      // Récupéreration de l'ID inséré dans la table utilisateur
      $utilisateur_id = $connexion->insert_id;

      // Insertion dans la table client
      $insert_client = "INSERT INTO client (nom, prenom, Date_Naissance, IdUtilisateur) VALUES (?, ?, ?, ?)";
      $stmt_client = $connexion->prepare($insert_client);
      $stmt_client->bind_param("ssss", $nom, $prenom, $date, $utilisateur_id);
      $success_client = $stmt_client->execute();

      // Recuperer les information transmises par le formulaire d'Inscription. Affectation dans $_SESSION
      $_SESSION['nom'] = $nom;
      $_SESSION['prenom'] = $prenom;
      $_SESSION['email'] = $email;
      $_SESSION['date'] = $date;
      $_SESSION['idUser'] = $utilisateur_id;


      header("Location: PageAccueilClient.php");

    } else {

      // Si echec, annulation de la transaction et redirection avec un message d'erreur
      $connexion->rollback();
      header("Location: inscription.php?error=insert_failure");
      exit();

    }
      
  } else {

    // Tous les champs ne sont pas remplis : redirection avec un message d'erreur
    header("Location: inscription.php?error=empty_fields");
    exit();

  }

}
?>


<?php require_once('includes/header.php'); ?>


<div class="container position-absolute top-50 start-50 translate-middle">
  <div class="row justify-content-center mt-5">
    <div class="col-md-6">
      <div class="card bg-light-subtle">
        <div class="card-header">
          <h4 class="text-center">Inscription</h4>
        </div>
        <div class="card-body">
          <form action="inscription.php" method="POST" >
            <div class="mb-3">
              <label for="email" class="form-label">Renseignez votre adresse e-mail</label>
              <input type="text" class="form-control" id="email" placeholder="Votre adresse e-mail" name="email"required>
            </div>
            <div class="mb-3">
              <label for="nom" class="form-label">Renseignez votre Nom</label>
              <input type="text" class="form-control" id="nom" placeholder="Votre Nom" name="nom"required>
            </div>
            <div class="mb-3">
              <label for="prenom" class="form-label">Renseignez votre Prénom</label>
              <input type="text" class="form-control" id="prenom" placeholder="Votre Prénom" name="prenom"required>
            </div>
            <div class="mb-3">
              <label for="date" class="form-label">Renseignez votre date de naissance</label>
              <input type="date" class="form-control" id="date" placeholder="Votre date de naissance" name="date" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Mot de passe</label>
              <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password" required>
            </div>
            <div class="mb-3">
              <label for="confirmPassword" class="form-label">Confirmation mot de passe</label>
              <input type="password" class="form-control" id="confirmPassword" placeholder="confirmation mot de passe" name="confirmPassword" required>
            </div>
            <div class="d-grid">
              <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </div>
            <?php 
              if(isset($_GET['error']) && $_GET['error'] === 'email_different'){
                echo "<p style='color: red;'>Les adresses email ne correspondent pas.</p>";
              }
              if(isset($_GET['error']) && $_GET['error'] === 'password_different'){
                  echo "<p style='color: red;'>Les mots de passe ne correspondent pas.</p>";
                }
              if(isset($_GET['error']) && $_GET['error'] === 'empty_fields') {
                  echo"<p style='color:red;'>N'oubilez pas de remplir tout les champs</p>";
                }
              if(isset($_GET['error']) && $_GET['error'] === 'user_exist'){
                echo "<p style='color: red;'>Un compte existe deja.<a href='connexion.php'>Connectez-vous</a></p>";
                }
              if(isset($_GET['error']) && $_GET['error'] === 'error_email_send'){
                echo "<p style='color: red;'>'Erreur lors de l\'envoi de l\'e-mail de vérification. Veuillez recommencer'</p>";
                }
              if(isset($_GET['error']) && $_GET['error'] === 'insert_failure'){
                echo "<p style='color: red;'>'Erreur lors de l\'insertion dans la base de donnés.'</p>";
                }
              ?>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once('includes/footer.php'); ?>