<?php
get_header(); 
// Prépare une requête WP_Query pour récupérer un post 'photo' aléatoire
$args = array(
    'post_type' => 'photo',
    'posts_per_page' => 1,
    'orderby' => 'rand' // Sélection aléatoire
);

$random_photo_query = new WP_Query($args);

// Vérifie si la requête retourne un post
if ($random_photo_query->have_posts()) {
    while ($random_photo_query->have_posts()) {
        $random_photo_query->the_post();
        // Récupère l'URL de l'image mise en avant
        $background_image_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
    }
}
// Réinitialise les données de post global
wp_reset_postdata();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
    <section class="hero-section" style="<?php if (!empty($background_image_url)) echo 'background-image: url(\'' . esc_url($background_image_url) . '\');'; ?>">
        <div class="hero-content">
            <h1 class="centered-text">PHOTOGRAPHE EVENT</h1>
        </div>
    </section>

    <div class="photos-grid">
    <?php
    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1 // -1 pour afficher toutes les photos
    );
    $photos_query = new WP_Query($args);

    if ($photos_query->have_posts()) : while ($photos_query->have_posts()) : $photos_query->the_post();
        // Ici, vous intégrez le bloc d'affichage d'une photo
        ?>
        <div class="photo-item">
            <?php if (has_post_thumbnail()) : ?>
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('full'); ?>
                </a>
            <?php endif; ?>
            <!-- Ajoutez ici d'autres détails si vous le souhaitez -->
        </div>
        <?php
    endwhile; endif;
    wp_reset_postdata();
    ?>
</div>


    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
