<?php
$servername = "localhost";
$username = "nom_utilisateur";
$password = "mot_de_passe";
$database = "nom_base_de_donnees";

// Créer une connexion à la base de données
$conn = new mysqli($servername, $username, $password, $database);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion à la base de données : " . $conn->connect_error);
}

// Requête pour récupérer des données de la table utilisateurs
$sql = "SELECT id, nom, email FROM utilisateurs";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Parcourir les données et les afficher
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Nom: " . $row["nom"]. " - Email: " . $row["email"]. "<br>";
    }
} else {
    echo "Aucun résultat trouvé";
}

// Fermer la connexion
$conn->close();
?>
