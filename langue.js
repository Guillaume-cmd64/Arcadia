// Récupérer les éléments des liens de langue
const langLinks = document.querySelectorAll('.lang-link');

// Ajouter un écouteur d'événements à chaque lien
langLinks.forEach(link => {
    link.addEventListener('click', () => {
        // Récupérer la langue à partir de l'attribut "data-lang" du lien
        const lang = link.dataset.lang;
        
        // Changer la langue du contenu de la page en fonction de la langue sélectionnée
        changeLanguage(lang);
    });
});

// Fonction pour changer la langue du contenu de la page
function changeLanguage(lang) {
    // Logique pour changer la langue du contenu ici
    console.log(`La langue a été changée en ${lang}`);
    // Exemple : charger un fichier de traduction correspondant à la langue sélectionnée et mettre à jour le contenu de la page
}
