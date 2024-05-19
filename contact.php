<?php
// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST-METHOD"] == "POST") {
    // Récupère les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Adresse email de destination
    $to = "arcadia@contact.zoo.com";

    //Sujet 
    $subject = "Nouveau message depuis le formulaire";

    // Corp du message 
    $body = "Nom: $name\n";
    $body .= "E-mail: $email\n";
    $body .= "Titre: $title\n";
    $body .= "Message: \n$message";

    // En-tête du message
    $headers = "From: $name <$email>";
    
    //Envoi de l'email
    if(mail($to, $subject, $body, $headers)) {
        echo "Votre message a bien été envoyé" {
    } else {
        echo "Une erreur s'est produite lors de l'envoi"
    }
}