<?php 

// Includes & Requires
require('server_db.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (isset($_POST['id_circuit']) && $_POST['id_client']) {

        $id_circuit = $_POST['id_circuit'];
        $id_client = $_POST['id_client'];

        $sql = "DELETE FROM reservation WHERE Id_Circ = ? AND Id_Client = ?";
        $stmt = $connexion->prepare($sql);
        $stmt->bind_param("ii", $id_circuit, $id_client);

        if ($stmt->execute()) {
            echo "Réservation supprimée avec succès.";
        } else {
            echo "Erreur lors de la suppression de la réservation.";
        }

        $stmt->close();
        $connexion->close();
    } else {
        echo "ID de réservation manquant.";
    }
} else {
    echo "Méthode de requête invalide.";
}

?>