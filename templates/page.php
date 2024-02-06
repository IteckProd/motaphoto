<?php
get_header(); 
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php
        // Commencer la boucle
        if (have_posts()) :
            while (have_posts()) : the_post();
                // Afficher le contenu de la page
                the_content();
            endwhile;
        endif;
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
