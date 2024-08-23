<?php
    /**
     * Template Name: Engenharia tributária
     * Template Post Type: page
     *
     * @package UAU
     * @since 1.0.0
     */

    get_header();
	get_template_part('template-parts/banner');
    ?>

    <section class="wrapper contact">
        <div class="contact__content">
            <h2>Informações Gerais:</h2>
        </div>
        <div class="contact__form">
            <?php echo do_shortcode('[contact-form-7 id="'. get_field('formulario')[0] .'"]'); ?>
        </div>
    </section>

<?php get_footer();