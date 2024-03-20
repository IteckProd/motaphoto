jQuery(function($) {
    $('#loadMore').on('click', function() {
        console.log('Avant l\'appel AJAX, page courante : ', loadmore_params.current_page);
        var data = {
            'action': 'loadmore',
            'query': loadmore_params.posts,
            'page': loadmore_params.current_page
        };
        console.log(data);
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
                    loadmore_params.current_page++;
                    $('#loadMore').text('Charger plus');
                } else {
                    $('#loadMore').hide(); // Cache le bouton s'il n'y a plus d'articles à charger
                }
            }
        });
    });
});
