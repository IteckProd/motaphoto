<footer id="colophon" class="site-footer">
<?php get_template_part('templates-part/contact-modal'); ?>
    <div class="footer-container">
        <?php
            // Vous pouvez soit utiliser un menu WordPress pour ces liens, soit les écrire en dur comme ci-dessous
            wp_nav_menu( array(
                'theme_location' => 'footer-menu', // Assurez-vous que cette location est enregistrée dans votre functions.php
                'menu_class'     => 'footer-navigation', // Classe CSS pour la liste <ul> du menu
                'container'      => false, // Pas de conteneur div autour du menu
            ) );
        ?>
    </div>
</footer>
