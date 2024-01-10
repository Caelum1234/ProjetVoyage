<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Page d'Inscription</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
  <div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center mt-5">
      <div class="col-md-6">
        <div class="card bg-light-subtle">
          <div class="card-header">
            <h4 class="text-center">Inscription</h4>
          </div>
          <div class="card-body">
            <form method="post" >
              <div class="mb-3">
                <label for="email" class="form-label">Renseignez votre adresse e-mail</label>
                <input type="text" class="form-control" id="email" placeholder="Votre adresse e-mail" name="email"required>
              </div>
              <div class="mb-3">
                <label for="Nom" class="form-label">Renseignez votre Nom</label>
                <input type="text" class="form-control" id="Nom" placeholder="Votre Nom" name="Nom"required>
              </div>
              <div class="mb-3">
                <label for="Prenom" class="form-label">Renseignez votre Prénom</label>
                <input type="text" class="form-control" id="Prenom" placeholder="Votre Prénom" name="Prenom"required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" placeholder="Votre mot de passe" name="password" required>
              </div>
              <div class="d-grid">
                <button type="submit" class="btn btn-primary">Créer mon compte</button>
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