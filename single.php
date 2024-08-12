<?php
/**
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package UAU
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner');
while ( have_posts() ) : the_post();
    $post->post_content = apply_filters( 'the_content', $post->post_content );
?>

<section class="wrapper content">
    <div class="content__header">
        <a href="javascript:history.go(-1)" title="Voltar"><img src="<?= esc_url(get_template_directory_uri() . '/assets/img/arrow.svg'); ?>" alt="Voltar"> Voltar</a>
        <time><?= get_the_date('d.m.Y'); ?><img src="<?= esc_url(get_template_directory_uri() . '/assets/img/calendar.svg'); ?>" alt="Data"></time>
    </div>

    <article class="content__content">
        <h1 class="content__title"><?php echo get_the_title(); ?></h1>
        <figure class="content__figure"><img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php echo get_the_title(); ?>"></figure>
        <h2><?php echo get_the_excerpt(); ?></h2>
        <?php echo $post->post_content; ?>
    </article>

    <div class="content__share">
        <?php
        $post_url = urlencode(get_permalink());
        $post_title = urlencode(get_the_title());
        $post_excerpt = urlencode(get_the_excerpt());
    
        $facebook_share_url = "https://www.facebook.com/sharer/sharer.php?u=$post_url";
        $linkedin_share_url = "https://www.linkedin.com/shareArticle?mini=true&url=$post_url&title=$post_title&summary=$post_excerpt&source=" . get_bloginfo('name');
        $twitter_share_url = "https://twitter.com/intent/tweet?text=$post_title&url=$post_url";
        $whatsapp_share_url = "https://api.whatsapp.com/send?text=$post_title%20$post_url";
        $email_share_url = "mailto:?subject=$post_title&body=$post_title%20$post_url";

        ?>
        
        <span>Gostou? Compartilhe:</span>
        <a href="<?php echo $facebook_share_url; ?>" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/facebook_share.webp')?>" alt="Facebook">
        </a>
        <a href="<?php echo $linkedin_share_url; ?>" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/linkedin_share.webp')?>" alt="LinkedIn">
        </a>
        <a href="<?php echo $twitter_share_url; ?>" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/x_share.webp')?>" alt="X (formerly Twitter)">
        </a>
        <a href="<?php echo $whatsapp_share_url; ?>" target="_blank">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/whatsapp_share.webp')?>" alt="WhatsApp">
        </a>
        <a href="<?php echo $email_share_url; ?>">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/email_share.webp')?>" alt="Email">
        </a>
    </div>

    <?php
    $current_post_id = get_the_ID();

    $categories = wp_get_post_categories($current_post_id);
    $tags = wp_get_post_tags($current_post_id);
    
    $category_ids = array();
    foreach ($categories as $category) {
        $category_ids[] = $category;
    }
    
    $tag_ids = array();
    foreach ($tags as $tag) {
        $tag_ids[] = $tag->term_id;
    }
    
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'post__not_in' => array($current_post_id),
        'orderby' => 'rand',
        'tax_query' => array(
            'relation' => 'OR',
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $category_ids,
            ),
            array(
                'taxonomy' => 'post_tag',
                'field' => 'term_id',
                'terms' => $tag_ids,
            ),
        ),
    );
    
    $related_posts_query = new WP_Query($args);
    if ($related_posts_query->have_posts()) {
        echo '<div class="content__related"><span>Relacionadas</span>';
        while ($related_posts_query->have_posts()) {
            $related_posts_query->the_post();
            $post_image = '';
            if(!empty(get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'))) {
                $post_image = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail');
            } else {
                $post_image = get_template_directory_uri() . '/assets/img/no_image.jpg';
            }
            ?>
            <div class="content__related-post">
                <figure><img src="<?php echo $post_image; ?>" alt="<?php echo get_the_title(); ?>"></figure>
                <article>
                    <span><?php echo get_the_title(); ?></span>
                    <a href="<?php echo get_the_permalink(); ?>">Continue lendo <img src="<?= esc_url(get_template_directory_uri() . '/assets/img/arrow.svg'); ?>" alt="Continue lendo - <?php echo get_the_title(); ?>"></a>
                </article>
            </div>
            <?php
        }
        echo '</div>';
        wp_reset_postdata();
    }
    ?>
</section>

<?php
endwhile;
wp_reset_postdata();

get_footer();