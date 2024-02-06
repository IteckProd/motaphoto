<?php get_header(); ?>

<!-- Conteneur principal pour la mise en page -->
<div class="container">
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="photo-content">
            <div class="photo-info">
                <!-- Titre de la photo -->
            <h1><?php the_title(); ?></h1>
                <!-- Informations sur la photo -->
                <p>Référence: <?php echo esc_html(get_post_meta(get_the_ID(), 'reference', true)); ?></p>
                <p>Catégorie: <?php the_terms(get_the_ID(), 'categorie'); ?></p>
                <p>Format: <?php the_terms(get_the_ID(), 'format'); ?></p>
                <p>Type: <?php echo esc_html(get_post_meta(get_the_ID(), 'type', true)); ?></p>
                <p>Année: <?php echo esc_html(get_the_date('Y')); ?></p>
            </div>

            <!-- Image Principale de la photo -->
            <div class="photo-image">
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail('full'); ?>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="photo-navigation-section">
            <div class="top-line"></div>
            
            <div class="content-section">
                <div class="interest-button-section">
                    <p>Cette photo vous intéresse ?</p>
                    <button class="contact-button">Contact</button>
                </div>

                <div class="arrow-preview">
                    <span class="arrow left-arrow">←</span>
                    <img src="path-to-next-photo-thumbnail.jpg" alt="Aperçu" class="photo-preview">
                    <span class="arrow right-arrow">→</span>
                </div>
            </div>
            
            <div class="bottom-line"></div>
        </div>

    <?php endwhile; endif; ?>

    <!-- Zone pour les photos apparentées -->
    <div class="related-photos">
        <h2>Vous aimerez aussi</h2>
        <?php
            // WP_Query pour les photos apparentées
            $related_photos = new WP_Query(array(
                'post_type' => 'photo', // Remplacez 'photo' par le vrai nom de votre CPT
                'posts_per_page' => 4,
                'category__in' => wp_get_post_categories($post->ID),
                'post__not_in' => array($post->ID)
            ));

            if ( $related_photos->have_posts() ) :
                while ( $related_photos->have_posts() ) : $related_photos->the_post();
                    // Ici, vous intégrerez le markup HTML pour chaque photo apparentée
                    // Par exemple, l'image de la photo avec un lien vers celle-ci
                    the_post_thumbnail('thumbnail');
                    the_title();
                endwhile;
                wp_reset_postdata(); // Important : remettre à zéro postdata
            endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>
