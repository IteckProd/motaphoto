// js/scripts.js
document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour afficher la modale
    function showModal() {
        var modal = document.getElementById('contact-modal');
        if (modal) {
            modal.style.display = 'flex';  
        }
    }

    // Fonction pour cacher la modale
    function hideModal() {
        var modal = document.getElementById('contact-modal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Gestionnaire d'événements pour les liens d'ouverture de la modale
    var openModalLinks = document.querySelectorAll('a[href="#open-modal-link"]');
    openModalLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le lien de suivre son URL
            showModal();
        });
    });

    // Gestionnaire d'événements pour détecter les clics en dehors de la modale
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('contact-modal');
        if (event.target === modal) {
            hideModal();
        }
    });
});
