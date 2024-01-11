<?php echo 'page pour le CRUD des Circuits' ?>

<div class="container">
       <h1>Ajout d'un circuit</h1>
       <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
           <div class="form-group">
               <label for="descriptif">Descriptif :</label>
               <input type="text" class="form-control" name="descriptif" id="descriptif" required>
           </div>
           <div class="form-group">
               <label for="villeDepart">Ville de départ :</label>
               <input type="text" class="form-control" name="villeDepart" id="villeDepart" required>
           </div>
           <div class="form-group">
               <label for="paysDepart">Pays de départ :</label>
               <input type="text" class="form-control" name="paysDepart" id="paysDepart" required>
           </div>
           <div class="form-group">
               <label for="villeArrivee">Ville d'arrivée :</label>
               <input type="text" class="form-control" name="villeArrivee" id="villeArrivee" required>
           </div>
           <div class="form-group">
               <label for="paysArrivee">Pays d'arrivée :</label>
               <input type="text" class="form-control" name="paysArrivee" id="paysArrivee" required>
           </div>
           <div class="form-group">
               <label for="dateDepart">Date de départ :</label>
               <input type="datetime-local" class="form-control" name="dateDepart" id="dateDepart" required>
           </div>
           <div class="form-group">
               <label for="nbrPlaceDisponible">Nombre de places disponibles :</label>
               <input type="number" class="form-control" name="nbrPlaceDisponible" id="nbrPlaceDisponible" min="1" required>
           </div>
           <div class="form-group">
               <label for="duree">Durée :</label>
               <input type="number" class="form-control" name="duree" id="duree" min="1" required>
           </div>
           <div class="form-group">
               <label for="prixInscription">Prix d'inscription :</label>
               <input type="number" class="form-control" name="prixInscription" id="prixInscription" step="0.01" min="0" required>
           </div>
           <button type="submit" class="btn btn-primary">Ajouter</button>
       </form>
   </div>


