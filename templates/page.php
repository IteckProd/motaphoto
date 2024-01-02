<?php
get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        while ( have_posts() ) : the_post();

            // Incluez le modèle de page spécifique si existe, sinon contenu standard.
            if ( is_page_template() ) {
                // S'il y a un template de page spécifique, utilisez-le.
                get_template_part( 'template-parts/page/content', get_page_template_slug() );
            } else {
                // Sinon, utilisez le contenu de page standard.
                get_template_part( 'template-parts/content', 'page' );
            }

            // Si les commentaires sont ouverts ou s'il y a au moins un commentaire, chargez le modèle de commentaires.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

        endwhile; // Fin de la boucle.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
