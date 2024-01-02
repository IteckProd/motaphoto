<?php
// menu-header.php
if ( has_nav_menu( 'header-menu' ) ) {
    wp_nav_menu( array(
        'theme_location' => 'header-menu',
        'menu_class'     => 'header-menu', // Ajoutez cette classe pour cibler le menu avec du CSS
        'container'      => 'nav', // Envelopper le menu dans une balise <nav>
        'container_class'=> 'site-navigation', // Classe pour le conteneur <nav>
    ) );
}
?>
