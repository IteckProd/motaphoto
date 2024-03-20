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

jQuery(function($){
    // Chargement des catégories de photos
    $.get('/wp-json/wp/v2/categorie').done(function(categories) {
        categories.forEach(function(category) {
            $('#photo-category').append(`<option value="${category.id}">${category.name}</option>`);
        });
    });

    $.get('/wp-json/wp/v2/format').done(function(formats) {
        formats.forEach(function(format) {
            $('#photo-format').append(`<option value="${format.id}">${format.name}</option>`);
        });
    });
});



jQuery(document).ready(function($) {
    function loadPhotos() {
        var data = {
            'action': 'load_photos',
            'query': loadmore_params.posts,
            'page': loadmore_params.current_page,
            'category': $('#photo-category :selected').text(), 
            'format': $('#photo-format').val(), 
            'order': $('#photo-order').val() 
        };
        $.ajax({
            url: loadmore_params.ajaxurl,
            data: data,
            type: 'POST',
            beforeSend: function(xhr) {
                $('#loadMore').text('Chargement...');
            },
            success: function(data) {
                if (data) {
                    $('#main').find('.photos-grid').append(data);
                    $('#loadMore').text('Charger plus');
                } else {
                    $('#loadMore').hide(); // Cache le bouton s'il n'y a plus d'articles à charger
                }
            }
        });
    }

    loadPhotos();



    // Écouteurs d'événements pour les changements de filtres
    $('#photo-category, #photo-format, #photo-order').change(function() {
        loadmore_params.current_page = 1;
        $('#main').find('.photos-grid').empty()
        loadPhotos();
    });
});



