document.addEventListener("DOMContentLoaded", function() {
    // Sélectionne le bouton et le formulaire
    let btnModifier = document.getElementById("btnModifier");
    let formModifier = document.getElementById("formModifier");

    // Ajoute un événement au clic sur le bouton Modifier
    btnModifier.addEventListener("click", function() {
        formModifier.style.display = "block"; // Affiche le formulaire
    });

    // Ajoute un bouton Annuler pour masquer à nouveau le formulaire
    let btnAnnuler = document.getElementById("btnAnnuler");
    btnAnnuler.addEventListener("click", function() {
        formModifier.style.display = "none"; // Cache le formulaire
    });
});
