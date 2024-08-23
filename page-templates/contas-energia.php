<?php
    /**
     * Template Name: Contas de energia
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
            <h2>Do cliente físico:</h2>
        </div>
        <div class="contact__form">
            <?php echo do_shortcode('[contact-form-7 id="'. get_field('formulario_do_cliente_fisico')[0] .'"]'); ?>
        </div>

        <div class="contact__content">
            <h2>Do cliente jurídico:</h2>
        </div>
        <div class="contact__form">
            <?php echo do_shortcode('[contact-form-7 id="'. get_field('formulario_do_cliente_juridico')[0] .'"]'); ?>
        </div>
    </section>

<?php get_footer();