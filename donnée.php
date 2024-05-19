<?php
// Requête pour créer une table
$sql = "CREATE TABLE utilisateurs (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    mot_de_passe VARCHAR(50),
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

// Exécution de la requête
if ($conn->query($sql) === TRUE) {
    echo "Table utilisateurs créée avec succès";
} else {
    echo "Erreur lors de la création de la table : " . $conn->error;
}

// Requête pour insérer des données dans la table
$sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES ('John Doe', 'john@example.com', 'motdepasse123')";

// Exécution de la requête
if ($conn->query($sql) === TRUE) {
    echo "Données insérées avec succès";
} else {
    echo "Erreur lors de l'insertion des données : " . $conn->error;
}

// Fermer la connexion
$conn->close();
?>
