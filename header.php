<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header class="header-container">
        <div class="top-row">
            <div class="site-branding">
                <!-- Votre logo ou le nom du site ici -->
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </h1>
            </div>
            
            <div class="menu-burger">
                ☰
            </div>
        </div>

        <!-- Enveloppe spécifique pour le menu -->
        <div class="menu-wrapper">
            <?php get_template_part( 'templates-part/menu-header' ); ?>
        </div>
        
    </header>
    <!-- Reste du contenu -->
</body>
</html>
