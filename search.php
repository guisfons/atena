<?php
get_header();
get_template_part('template-parts/banner'); ?>

<section class="wrapper busca">
    <span class="busca__title"><strong>Você buscou por:</strong> <?php echo get_search_query(); ?></span>

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post();
    ?>
    <article class="busca__item">
        <div class="busca__content">
            <h2><?= get_the_title(); ?></h2>
            <p><?= get_the_excerpt(); ?></p>
        </div>
        <a href="<?= get_the_permalink(); ?>">Continue lendo <svg width="29" height="12" viewBox="0 0 29 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.0801 6H1.08008" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M27.0801 6L23.0801 11" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M27.0801 6L23.0801 1" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
    </article>
    <?php
        endwhile;
    else : ?>
        <span class="busca__notfound">Nada encontrado com os termos da pesquisa.</span>
    <?php endif; ?>
</section>

<?php get_footer(); ?>