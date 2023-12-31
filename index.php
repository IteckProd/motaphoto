<?php
get_header(); 
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php if ( have_posts() ) : ?>

            <?php
            // Début de la boucle.
            while ( have_posts() ) : the_post();

                get_template_part( 'template-parts/content', get_post_format() );

            endwhile;

            // Navigation des articles (précédent / suivant).
            the_posts_navigation();

        else :

            // Aucun post trouvé - incluez le template de contenu 'aucun post trouvé'.
            get_template_part( 'template-parts/content', 'none' );

        endif; 
        ?>

    </main><!-- #main -->
</div><!-- #primary -->


<?php
    get_footer();
?>
