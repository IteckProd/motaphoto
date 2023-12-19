<footer id="colophon" class="site-footer">
    <div class="site-info">
        <a href="<?php echo esc_url(home_url('/')); ?>">
            <?php printf(esc_html__('© %d %s. All rights reserved.', 'motaphoto'), date('Y'), get_bloginfo('name')); ?>
        </a>
    </div><!-- .site-info -->
    <nav class="footer-navigation">
        <ul>
            <li><a href="<?php echo esc_url(home_url('/mentions-legales')); ?>"><?php esc_html_e('Mentions légales', 'motaphoto'); ?></a></li>
            <li><a href="<?php echo esc_url(home_url('/vie-privee')); ?>"><?php esc_html_e('Vie privée', 'motaphoto'); ?></a></li>
        </ul>
    </nav><!-- .footer-navigation -->
</footer><!-- #colophon -->

<?php wp_footer(); ?>

</body>
</html>
