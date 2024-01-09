<?php
  session_unset();
  
  include('utilisateur.php');

  if($_SERVER['REQUEST_METHOD'] === 'POST') {
      if(isset($_POST['email']) && isset($_POST['password'])){
        $utilisateurId = $_POST['email'];
        $utilisateurPassword = $_POST['password'];
        $utilisateur = new Utilisateur (null, $utilisateurId, $utilisateurPassword, null);
        $utilisateur->checkUser();
        if(!empty($utilisateur->getId_Utilisateur())){
          $goodMessage = "Good credentials";
          echo '<div class="alert alert-success">' . $goodMessage . '</div>';
        }
        else {
          $errorMessage = "An error occurred. Please try again.";
      
          // Output the Bootstrap alert component
          echo '<div class="alert alert-danger">' . $errorMessage . '</div>';
        }
        if(isset($_SESSION['role'])){
          $roleUtilisateur = $_SESSION['role'];
          
          if($roleUtilisateur == '1'){
            header('Location: dashboardAdmin.php');
            exit();
          } elseif($roleUtilisateur == '2'){
            header('Location: dashboardClient.php');
            exit();
          } else {
          }
        } 
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page de Connexion</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
  <div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card bg-light-subtle">
          <div class="card-header">
            <h4 class="text-center">Connexion</h4>
          </div>
          <div class="card-body">
            <form method="post" >
              <div class="mb-3">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input type="text" class="form-control" id="email" placeholder="Votre adresse e-mail" name="email"required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password" required>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>