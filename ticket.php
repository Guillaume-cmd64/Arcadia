<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les données sont présentes et non vides
    if (isset($_POST['ticket_type']) && isset($_POST['quantite']) && isset($_POST['payment_method'])) {
        // Nettoyer les données entrées
        $ticket_type = htmlspecialchars($_POST['ticket_type']);
        $quantite = intval($_POST['quantite']); // Assurez-vous que la quantité est un entier
        $payment_method = htmlspecialchars($_POST['payment_method']);

        // Calculer le prix en fonction du type de ticket
        switch ($ticket_type) {
            case 'adulte':
                $prix_total = $quantite * 10; // Prix pour un adulte
                break;
            case 'enfant':
                $prix_total = 0; // Les enfants de moins de 12 ans sont gratuits
                break;
            case 'senior':
                $prix_total = $quantite * 5; // Moitié prix pour les seniors
                break;
            default:
                $prix_total = 0;
                break;
        }

        // Enregistrer les données dans la base de données ou effectuer d'autres traitements en fonction du mode de paiement
        // Ici, nous n'effectuons qu'une simple validation
        if ($payment_method === 'stripe' || $payment_method === 'paypal') {
            // Traitement du paiement sécurisé avec Stripe ou PayPal
            // Vous devez implémenter la logique de paiement avec Stripe ou PayPal ici
            // Assurez-vous de sécuriser correctement vos clés d'API et de valider les paiements côté serveur
            // Pour Stripe, vous pouvez utiliser la bibliothèque Stripe PHP
            // Pour PayPal, vous pouvez utiliser l'API REST de PayPal
            // N'oubliez pas de gérer les erreurs et de renvoyer une réponse appropriée
            // Pour cet exemple, nous affichons simplement les détails de l'achat
            echo "<p>Merci pour votre achat ! Vous avez sélectionné $quantite ticket(s) de type $ticket_type. Le prix total est de $prix_total EUR.</p>";
        } else {
            echo "Méthode de paiement non valide.";
        }
    } else {
        echo "Veuillez remplir tous les champs du formulaire.";
    }
} else {
    echo "Erreur : méthode de requête non autorisée.";
}
?>
