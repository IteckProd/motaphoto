<?php
/**
 * Twenty Twenty-Two functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage motaphoto
 * @since motaphoto 1.0
 */

function mytheme_enqueue_styles() {
  wp_enqueue_style('space-mono-font', 'https://fonts.googleapis.com/css2?family=Space+Mono:ital,wght@0,400;1,400&display=swap');
    wp_enqueue_style( 'mytheme-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

function mytheme_enqueue_scripts() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('mytheme-scripts', get_template_directory_uri() . '/js/scripts.js', array());
    wp_enqueue_script('my_loadmore', get_template_directory_uri() . '/js/infinite-scroll.js', array());

}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');

function mytheme_register_menus() {
    register_nav_menu('header-menu', __('Header Menu'));
    register_nav_menu('footer-menu', __('Footer Menu'));
}
add_action('init', 'mytheme_register_menus');

add_filter('template_include', 'load_custom_template');

function load_custom_template($template) {
  if (is_page()) { // Vérifiez si une page WordPress est affichée
    $custom_template = locate_template(array('templates/page.php'));
    if (!empty($custom_template)) {
      return $custom_template;
    }
  }
  return $template; 
}

function loadmore_ajax_handler(){
  $args = array(
    'post_type' => 'photo',
    'posts_per_page' => 8, 
    'paged' => (isset($_POST['page']) ? $_POST['page'] + 1 : 1), // Commence à la page 1 et incrémente à chaque appel AJAX
    'post_status' => 'publish'
  );

  // effectuez la requête WP_Query
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
        </div>
        <?php
    endwhile; endif;
    wp_reset_postdata();
    wp_die();

}
add_action('wp_ajax_loadmore', 'loadmore_ajax_handler');
add_action('wp_ajax_nopriv_loadmore', 'loadmore_ajax_handler');

function load_photos() {
  $args = array(
      'post_type' => 'photo',
      'posts_per_page' => 8,
      'paged' => (isset($_POST['page']) ? $_POST['page'] : 1), // Commence à la page 1 et incrémente à chaque appel AJAX
      'post_status' => 'publish',
      //chercher dans la taxonomie la catégorie
  );

  
  $photos_query = new WP_Query($args);
  if ($photos_query->have_posts()) : 
      while ($photos_query->have_posts()) : $photos_query->the_post();
          // Ici, génère le HTML pour chaque photo
          ?>
          <div class="photo-item">
              <?php if (has_post_thumbnail()) : ?>
                  <a href="<?php the_permalink(); ?>">
                      <?php the_post_thumbnail('full'); ?>
                  </a>
              <?php endif; ?>
              <!-- Plus de détails ici si nécessaire -->
          </div>
          <?php
      endwhile;
  endif;
  wp_reset_postdata();

  wp_die(); // Termine correctement la requête AJAX
}
add_action('wp_ajax_load_photos', 'load_photos'); // Pour les utilisateurs connectés
add_action('wp_ajax_nopriv_load_photos', 'load_photos'); // Pour les utilisateurs non connectés


function loadmore_scripts() {
  global $wp_query;

  wp_enqueue_script( 'jquery' );
  wp_register_script( 'my_loadmore', get_stylesheet_directory_uri() . '/js/infinite-scroll.js', array('jquery') );
  wp_enqueue_script( 'my_loadmore' );

  $query_vars = $wp_query->query_vars;
  $query_vars['post_type'] = 'photo'; 
  wp_localize_script('my_loadmore', 'loadmore_params', array(
      'ajaxurl' => admin_url('admin-ajax.php'),
      'posts' => json_encode($query_vars),
      'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
      'max_page' => $wp_query->max_num_pages
  ));
}
add_action( 'wp_enqueue_scripts', 'loadmore_scripts' );

add_action('wp_ajax_filter_photos', 'filter_photos_handler');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos_handler');

function filter_photos_handler() {
    // Récupère les paramètres de filtre depuis la requête AJAX
    $category = isset($_POST['category']) ? intval($_POST['category']) : '';
    $format = isset($_POST['format']) ? intval($_POST['format']) : '';
    $order = isset($_POST['order']) && in_array($_POST['order'], ['ASC', 'DESC']) ? $_POST['order'] : 'DESC';

    $args = array(
        'post_type' => 'photo',
        'posts_per_page' => -1, // Ou toute autre limite
        'order' => $order,
        'tax_query' => array('relation' => 'AND')
    );

    if (!empty($category)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categorie', 
            'field' => 'id',
            'terms' => $category
        );
    }
   
    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'format', 
            'field' => 'id',
            'terms' => $format
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            ?>
              <div class="photo-item">
                <?php if (has_post_thumbnail()) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('full'); ?>
                    </a>
                <?php endif; ?>
                <!-- Plus de détails ici si nécessaire -->
            </div>
          <?php
        }
    } else {
        echo '<p>Aucune photo trouvée.</p>';
    }

    wp_reset_postdata();
    wp_die();
}










