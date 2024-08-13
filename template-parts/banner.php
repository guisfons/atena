<?php
if (!empty(get_field('cor_de_destaque'))) {
    echo '<section class="banner banner--colorido" style="background-color: ' . get_field('cor_de_destaque') . '">';
} else {
    echo '<section class="banner' . (is_front_page() ? ' banner--home' : '') . '">';
}

if (is_front_page()) {
    if (have_rows('titulos')) :
        echo '<article class="banner__text">';
        $x = 1;
        while (have_rows('titulos')) : the_row();
            $titulo = get_sub_field('titulo');
            echo '<span data-id="' . $x . '">' . $titulo . '</span>';
            $x++;
        endwhile;
        echo '</article>';
    endif;
    echo '<article>para</article><article>todos</article>';
    $images = get_field('banner');
    if ($images) :
        $x = 1;
        shuffle($images);
        foreach ($images as $image) :
            if ($x <= 42) {
                echo '<figure data-id="' . $x . '"><img src data-src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '"></figure>';
            }
            $x++;
        endforeach;
    endif;
} elseif (is_search()) {
    echo
    '<figure><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/search_banner.webp" alt="Tela de pesquisa"></figure>
        <article class="wrapper"><h1>Resultados de busca</h1><span>Veja abaixo seu resultado de busca</span></article>';
} elseif (is_single() || is_page('na-midia')) {
    echo
    '<figure><img src="' . esc_url(get_template_directory_uri()) . '/assets/img/single_banner.webp" alt="Tela de pesquisa"></figure>
        <article class="wrapper">' . (is_page('na-midia') ? '<h1>NA MÍDIA</h1>' : '<span>NA MÍDIA</span>') . '<span>Acompanhe por aqui notícias, artigos e editais</span></article>';
} elseif (!empty(get_field('cor_de_destaque'))) {
    echo
    '<div class="wrapper">
        <h1>Como atuamos no ' . get_the_title() . '</h1>
        <figure><img src="' . get_field('icone')['url'] . '" alt="'.get_the_title().'"></figure>
    </div>';
} else {
    echo
    '<figure><img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' . get_the_title() . '"></figure>
    <article class="wrapper"><h1>' . get_the_title() . '</h1><span>' . get_the_content() . '</span></article>';
}
?>
</section>