document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne le bouton et le formulaire
    let gestion = document.getElementById("gestion");
    let containerForm = document.getElementById("container-form");

    // Ajoute un événement au clic sur le bouton Modifier
    gestion.addEventListener("click", function() {
        containerForm.style.display = "block"; // Affiche le formulaire
    });

    // Ajoute un bouton Annuler pour masquer à nouveau le formulaire
    let btnAnnuler = document.getElementById("btnAnnuler");
    btnAnnuler.addEventListener("click", function() {
        containerForm.style.display = "none"; // Cache le formulaire
    });
});