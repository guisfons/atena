<?php

/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package itmidia
 * @since 1.0.0
 */

if (in_array(session_status(), [PHP_SESSION_NONE, 1])) {
    session_start();
}

/**
 * Composer autoload
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
}

/**
 * @todo improve to use namespaces and Helpers be a class
 */
require_once(__DIR__ . '/src/Helpers.php');
require_once(__DIR__ . '/inc/post-types.php');
#require_once(__DIR__ . '/inc/shortcodes/galleries.php');
#require_once(__DIR__ . '/inc/shortcodes/special-posts-videos.php');

/**
 * @info Security Tip
 * Remove version info from head and feeds
 */
add_filter('the_generator', 'wp_version_removal');

function wp_version_removal()
{
    return false;
}

/**
 * @info Security Tip
 * Disable oEmbed Discovery Links and wp-embed.min.js
 */
remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

/**
 * @bugfix Yoast fix wrong canonical url in production
 *
 * Set canonical URLs on non-production sites to the production URL
 */
#add_filter( 'wpseo_canonical', function( $canonical ) {
#	$canonical = preg_replace('#//[^/]*/#U', '//itmorum365.com.br/', trailingslashit( $canonical ) );
#	return $canonical;
#});

/**
 * Filter except length to 35 words.
 *
 * @param integer $length
 * @return integer
 */
function custom_excerpt_length($length)
{
    return 40;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

/**
 * Add excerpt support for pages
 */
add_post_type_support('page', 'excerpt');

/**
 * Remove Admin Bar from front-end
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Disables block editor "Gutenberg"
 */
add_filter("use_block_editor_for_post_type", "use_gutenberg_editor");
function use_gutenberg_editor()
{
    return false;
}

/**
 * Add support to thumbnails
 */
add_theme_support('post-thumbnails');

/**
 * @info this theme doesn't have custom thumbnails dimensions
 *
 * define the size of thumbnails
 * To enable featured images, the current theme must include
 * add_theme_support( 'post-thumbnails' ) and they will show the metabox 'featured image'
 */
add_image_size('company-size', 162, 81, false);
add_image_size('event-gallery', 490, 568, false);
/*add_image_size('slide-large', 1366, 400, true );
add_image_size('slide-extra-large', 2560, 749, true );*/


/**
 * Páginas Especiais
 */

if (function_exists('acf_add_options_page')) {

    /* @info disabled by unused*/
    acf_add_options_page(array(
        'page_title' => 'Opções Gerais',
        'menu_title' => 'Opções Gerais',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 2

    ));

    acf_add_options_page(array(
        'page_title' => 'Destaques',
        'menu_title' => 'Destaques',
        'menu_slug'  => 'uau-slides',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-excerpt-view',
        'position'   => 3
    ));
}


/**
 * Registering Locations of Navigation Menus
 */

function navigation_menus()
{
    /* this function register a array of locations */
    register_nav_menus(
        array(
            'header-menu' => 'Menu Header',
        )
    );
}

add_action('init', 'navigation_menus');

/**
 * ACF Improvements
 * Order results by descendent date in relational fields
 *
 * @param array $args
 * @param array $field
 * @param integer $post_id
 * @return array
 */
function relational_fields_order($args, $field, $post_id)
{
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    return $args;
}
add_filter('acf/fields/relationship/query', 'relational_fields_order', 10, 3);

/**
 * ACF Improvements
 * Order results by descendent date in post object fields
 *
 * @param array $args
 * @param array $field
 * @param integer $post_id
 * @return array
 */
function post_objects_fields_order($args, $field, $post_id)
{
    $args['orderby'] = 'date';
    $args['order'] = 'DESC';
    return $args;
}
add_filter('acf/fields/post_object/query', 'post_objects_fields_order', 10, 3);

/**
 * Declaring the JS files for the site
 */

function scripts()
{
    wp_deregister_script("jquery");
}
add_action('wp_enqueue_scripts', 'scripts', 10); // priority 10


/**
 * Applying custom logo at WP login form
 */
function login_logo()
{
?>
    <style type="text/css">
        #login h1 a,
        .login h1 a {
            background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg");
            width: 260px;
            height: 55px;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
<?php
}
add_action('login_enqueue_scripts', 'login_logo');

function login_logo_url()
{
    return home_url();
}

add_filter('login_headerurl', 'login_logo_url');

function login_logo_url_title()
{
    return 'IT Mídia';
}

add_filter('login_headertext', 'login_logo_url_title');


/**
 * Declaring the JS files for the site
 */
add_action('wp_enqueue_scripts', 'scripts', 10); // priority 10

require_once('inc/style-scripts.php');


/**
 * Pagination of posts in pages
 */
function pagination($pages = '', $range = 4)
{
    $showitems = ($range * 2) + 1;

    global $paged;
    if (empty($paged)) $paged = 1;

    if ($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        echo "<div class=\"pagination__arrow\">";
        if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'><svg width=\"10\" height=\"17\"><use xlink:href=\"" . get_template_directory_uri() . "/assets/img/SVG/sprite.svg#p-arrow-left\"></use></svg>Anterior</a>";
        echo "</div>";

        echo '<div class="pagination__numbers">';
        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                echo ($paged == $i) ? "<a href=\"\" class=\"active\">" . $i . "</a>" : "<a href='" . get_pagenum_link($i) . "'>" . $i . "</a>";
            } elseif ($i == $paged) {
                echo '<a href=\"\" class=\"active\">' . $i . '</a>';
            }
        }
        echo '</div>';

        echo "<div class=\"pagination__arrow pagination__arrow--right\">";
        if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1) . "'>Próxima<svg width=\"10\" height=\"17\"><use xlink:href=\"" . get_template_directory_uri() .  "/assets/img/SVG/sprite.svg#p-arrow-right\"></use></svg></a>";
        echo "</div>";
    }
}

// Allow SVG
add_filter('wp_check_filetype_and_ext', function ($data, $file, $filename, $mimes) {
    global $wp_version;
    if ($wp_version !== '4.7.1') {
        return $data;
    }

    $filetype = wp_check_filetype($filename, $mimes);
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4);

function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

function fix_svg()
{
    echo '<style type="text/css">
            .attachment-266x266, .thumbnail img {
                width: 100% !important;
                height: auto !important;
            }
        </style>';
}
add_action('admin_head', 'fix_svg');

// Menus
function output_menu($parent_id, $menu)
{
    if (isset($menu[$parent_id])) {
        foreach ($menu[$parent_id] as $menu_item) {
            echo '<span>';
            echo '<a title="' . str_replace('*', '', $menu_item->title) . '" href="' . $menu_item->url . '" class="header__item ' . $menu_item->classes[0] . (get_the_ID() == $menu_item->object_id ? ' header__item--active' : '') . '" target="' . $menu_item->target . '">';
            $menu_title = str_replace('*', '', $menu_item->title);
            echo $menu_title;
            echo '</a>';

            // If this item has children, output them
            if (isset($menu[$menu_item->ID])) {
                echo '<ul class="header__submenu">';
                output_menu($menu_item->ID, $menu);
                echo '</ul>';
            }

            echo '</span>';
        }
    }
}

// Custom language switcher shortcode
add_shortcode('custom-language-switcher', 'trpc_custom_language_switcher', 10);
function trpc_custom_language_switcher()
{
    if (apply_filters('trp_allow_tp_to_run', true)) {
        $languages = trp_custom_language_switcher();
        foreach ($languages as $name => $item) {
            if($item['language_code'] == get_locale()) {
                echo '<span><img src="'.$item['flag_link'].'" alt="'.$item['language_name'].'"></span>';
            }
        }
        $html = '<div class="header__language-container" data-no-translation>';
        foreach ($languages as $name => $item) {
            $html .= '<a href="'.$item['current_page_url'].'" data-locale="'. $item['language_code'].'"><img src="'.$item['flag_link'].'" alt="'.$item['language_name'].'"></a>';
        }
        $html .= '</div>';
        return $html;
    }
}

function wpb_set_post_views($postID) {
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function wpb_track_post_views ($post_id) {
    if ( !is_single() ) return;
    if ( empty ( $post_id ) ) {
        global $post;
        $post_id = $post->ID;    
    }
    wpb_set_post_views($post_id);
}
add_action( 'wp_head', 'wpb_track_post_views');

function wpb_get_post_views($postID){
    $count_key = 'wpb_post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count == ''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Views';
}

add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts() {
    check_ajax_referer('load_more_posts_nonce', 'nonce');
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = isset($_POST['per_page']) ? intval($_POST['per_page']) : 5;

    $args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'posts_per_page' => $posts_per_page,
    );
    $query = new WP_Query($args);

    $posts_html = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            if (empty($image)) {
                $image = get_template_directory_uri() . '/assets/img/no_image.jpg';
            }

            $posts_html .=
            '<div animate-fadein class="midia__post">
                <figure><img src="'.esc_url($image).'" alt=""></figure>
                <article>
                    <time>'.get_the_date('d.m.Y').'</time>
                    <h2>'.get_the_title().'</h2>
                    <a href="'.esc_url(get_permalink()).'">Continue lendo <img src="'.esc_url(get_template_directory_uri() . '/assets/img/arrow.svg').'" alt="Continue lendo - '.get_the_title().'"></a>
                </article>
            </div>';
        }
        wp_reset_postdata();
    }

    $has_more = $query->max_num_pages > $paged;

    wp_send_json(array(
        'has_more' => $has_more,
        'posts' => $posts_html
    ));
}