jQuery(function($){
    var canBeLoaded = true, // cette variable est pour éviter plusieurs chargements
        bottomOffset = 3000; // distance du bas de la page pour déclencher le chargement

    $(window).scroll(function(){
        var postsData = loadmore_params.posts;
        var data = {
            'action': 'loadmore',
            'query': postsData,
            'page' : loadmore_params.current_page
        };
        if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canBeLoaded ){
            
            $.ajax({
                url : loadmore_params.ajaxurl,
                data: data,
                type:'POST',
                beforeSend: function( xhr ){
                    canBeLoaded = false; // empêche plusieurs appels
                },
                success: function(data) {
                    if (data) { // Vérifie si des éléments de photo sont présents
                        $('#main').find('.photos-grid').append(data); // Insère de nouveaux posts
                        canBeLoaded = true; // Permet de charger plus de posts lors du prochain défilement
                        loadmore_params.current_page++;
                    }
                }
                
            });
        }
    });
});
