<?php get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">

        <?php
        /* Boucle WordPress pour afficher le contenu de l'article */
        while ( have_posts() ) : the_post();

            get_template_part( 'template-parts/content', 'single' );

            // Si les commentaires sont ouverts ou s'il y a au moins un commentaire, chargez le modèle de commentaires.
            if ( comments_open() || get_comments_number() ) :
                comments_template();
            endif;

            // Navigation vers l'article suivant/précédent.
            the_post_navigation(array(
                'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'motaphoto' ) . '</span> <span class="nav-title">%title</span>',
                'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'motaphoto' ) . '</span> <span class="nav-title">%title</span>',
            ));

        endwhile; // Fin de la boucle.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_sidebar(); // Optionnel: inclure la barre latérale si nécessaire ?>
<?php get_footer(); ?>
