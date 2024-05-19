// Tout accepter.
function acceptAll() {
   
    closePopup();
}

// Modification des préferences 
function modifyPreferences() {
    
    window.location.href = "preferences.html";
}

// Affichage du popup
function showPopup() {
    document.getElementById("popup").style.display = "block";
}


function closePopup() {
    document.getElementById("popup").style.display = "none";
}


window.onload = function() {
    showPopup();
};
