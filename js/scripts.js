// js/scripts.js
document.addEventListener('DOMContentLoaded', function() {
    var contactUsButton = document.getElementById('contactUsButton');
    if (contactUsButton) {
        contactUsButton.addEventListener('click', function() {
            // Affiche la modale
            showModal();

            // Récupère la référence de la photo depuis l'attribut data-ref du bouton
            var photoRef = contactUsButton.getAttribute('data-ref');

            // Trouve le champ du formulaire à préremplir.
            var refField = document.querySelector('input[name="your-subject"]');
            if (refField) {
                refField.value = photoRef;
            }
        });
    }

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

document.addEventListener('DOMContentLoaded', function() {
    var previewContainer = document.getElementById('photo-preview-container'); 
    let img_white = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/B8AAwAB/DEpij8AAAAASUVORK5CYII="
    // Fonction pour mettre à jour la prévisualisation
    function updatePreview(imageUrl) {
        if (previewContainer) {
            previewContainer.innerHTML = imageUrl ? `<img src="${imageUrl}" height="83" alt="Aperçu de la photo">` : '';
        }
    }

    // Ajoutez des écouteurs d'événements aux flèches
    document.querySelectorAll('.arrow').forEach(function(arrow) {
        arrow.addEventListener('mouseover', function() {
            var imageUrl = arrow.getAttribute('data-preview-url');
            updatePreview(imageUrl);
        });

        arrow.addEventListener('mouseleave', function() {
            updatePreview(img_white); // Efface la prévisualisation
        });
    });
});
