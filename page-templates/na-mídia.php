<?php
/*
Template Name: Na Mídia
*/

get_header();
get_template_part('template-parts/banner');
?>

<section class="wrapper midia">
    <div animate-fadein class="midia__header">
        <span>Mais recentes</span>

        <form method="GET" class="midia__sort">
            <select name="sortby">
                <option value="">Filtrar por</option>
                <option value="recent">Mais recentes</option>
                <option value="oldest">Mais antigos</option>
                <option value="most_viewed">Mais lidos</option>
            </select>
            <button type="submit">Filtrar</button>
        </form>
    </div>

    <?php
    $orderby = isset($_GET['sortby']) ? $_GET['sortby'] : '';

    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 9,
    );

    if ($orderby == 'recent') {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    } elseif ($orderby == 'oldest') {
        $args['orderby'] = 'date';
        $args['order'] = 'ASC';
    } elseif ($orderby == 'most_viewed') {
        $args['meta_key'] = 'wpb_post_views_count';
        $args['orderby'] = 'meta_value_num';
        $args['order'] = 'DESC';
    } else {
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        echo '<div class="midia__posts">';
        while ($query->have_posts()) : $query->the_post();

        $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
        if(empty($image)) {
            $image = get_template_directory_uri() . '/assets/img/no_image.jpg';
        }

        echo
        '<div animate-fadein class="midia__post">
            <figure><img src="'.esc_url($image).'" alt=""></figure>
            <article>
                <time>'.get_the_date('d.m.Y').'</time>
                <h2>'.get_the_title().'</h2>
                <a href="'.get_the_permalink().'">Continue lendo <img src="'.esc_url(get_template_directory_uri() . '/assets/img/arrow.svg').'" alt="Continue lendo - '.get_the_title().'"></a>
            </article>
        </div>';
    
        endwhile;
        wp_reset_postdata();
        echo '</div>';
    endif;
    ?>

    <button animate-fadein class="midia__carregar">Carregar mais postagens</button>
</section>

<?php get_footer(); ?>