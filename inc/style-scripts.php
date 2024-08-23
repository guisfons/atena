<?php
define('ASSETS_VERSION','1.3.0');

/**
 * Enqueue scripts and styles that are used on every page
 * Dequeue unused scripts and styles
 */
function themeFiles() {

    wp_deregister_script('jquery');
    wp_dequeue_style('wp-block-library');
    
    wp_register_style('style', get_stylesheet_directory_uri() . '/assets/css/main.min.css', array(), ASSETS_VERSION, 'screen');
    wp_enqueue_style('style');

    if(is_front_page() || is_page('o-que-e-atena') || is_page('setor-privado') || is_page('setor-publico') || is_page('terceiro-setor') || is_page('filantropia')) {
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), ASSETS_VERSION, true);
    }

    if(is_front_page() || is_page('o-que-e-atena') || is_page('setor-privado') || is_page('setor-publico') || is_page('terceiro-setor') || is_page('filantropia')) {
        wp_enqueue_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', array(), ASSETS_VERSION, 'screen');
        wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array(), ASSETS_VERSION, true);
    }
    
    if(is_page('na-midia')) {
        wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.min.js', array(), ASSETS_VERSION, true);
        wp_enqueue_script('nice-select', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js', array(), ASSETS_VERSION, true);
        wp_enqueue_style('nice-select', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css', array(), ASSETS_VERSION, 'screen');
    }

    wp_enqueue_script( 'gsap-js', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js', array(), false, true );
    wp_enqueue_script( 'gsap-st', 'https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js', array('gsap-js'), false, true );
    // wp_enqueue_script( 'locomotive', 'https://cdn.jsdelivr.net/npm/locomotive-scroll@beta/bundled/locomotive-scroll.min.js', array(), false, true );
    wp_enqueue_script( 'gsap-js2', get_template_directory_uri() . '/assets/js/app.js', array('gsap-js'), false, true );

    wp_register_script('javascript', get_stylesheet_directory_uri() . '/assets/js/main.js', array(), ASSETS_VERSION, true);
    wp_enqueue_script('javascript');

    if(is_page('na-midia')) {
        wp_localize_script('javascript', 'myAjaxObject', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce'    => wp_create_nonce('load_more_posts_nonce')
        ));
    }

    enqueueTargetAssets(getTargetType());
}
add_action('wp_enqueue_scripts', 'themeFiles');

/**
 * Define pages that don't have template slug
 */
function getTargetType() {
    if ( is_front_page() ) {
        return 'home';
    }

    if ( is_search() ) {
        return 'search';
    }

    if ( is_single() ) {
        return 'single';
    }

    if ( is_page('na-midia') ) {
        return 'na-midia';
    }

    if ( is_page('o-que-e-atena') ) {
        return 'o-que-e-atena';
    }

    if ( is_page('o-que-faz') ) {
        return 'o-que-faz';
    }

    if ( is_page('como-faz') ) {
        return 'como-faz';
    }

    if ( is_page('filantropia') ) {
        return 'filantropia';
    }

    if ( is_page_template('page-templates/para-quem-faz.php') ) {
        return 'para-quem-faz';
    }

    return str_replace(".php", "", basename(get_page_template_slug()));
}

/**
 * Set array of files (CSS & JS) that are used on pages
 */
function enqueueTargetAssets($page) {
    $pageAssetsConfig = (object) array(
        "home" => ["javascripts" => ["home.js"], "css" => ["home.min.css"], "type" => "page", "concat" => true],
        "search" => ["javascripts" => [], "css" => ["search.min.css"], "type" => "page", "concat" => true],
        "single" => ["javascripts" => [], "css" => ["single.min.css"], "type" => "page", "concat" => true],
        "contato" => ["javascripts" => [], "css" => ["contact.min.css"], "type" => "page", "concat" => true],
        "na-midia" => ["javascripts" => [], "css" => ["na-midia.min.css"], "type" => "page", "concat" => true],
        "o-que-e-atena" => ["javascripts" => [], "css" => ["o-que-e-atena.min.css"], "type" => "page", "concat" => true],
        "o-que-faz" => ["javascripts" => [], "css" => ["o-que-faz.min.css"], "type" => "page", "concat" => true],
        "como-faz" => ["javascripts" => [], "css" => ["como-faz.min.css"], "type" => "page", "concat" => true],
        "filantropia" => ["javascripts" => [], "css" => ["filantropia.min.css"], "type" => "page", "concat" => true],
        "para-quem-faz" => ["javascripts" => ["para-quem-faz.js"], "css" => ["para-quem-faz.min.css"], "type" => "page", "concat" => true],
        "contas-energia" => ["javascripts" => [], "css" => ["contact.min.css", "contas-de-energia.min.css"], "type" => "page", "concat" => true],
        "engenharia-tributaria" => ["javascripts" => [], "css" => ["contact.min.css", "engenharia-tributaria.min.css"], "type" => "page", "concat" => true],
    );

    if (property_exists($pageAssetsConfig, $page)) {
        $config = (object) $pageAssetsConfig->{$page};

        for ($i = 0; $i < count($config->javascripts); $i++) {
            if(!empty($config->javascripts)) {
                $handle = "pl-js-{$page}-$i";
                wp_register_script($handle, get_stylesheet_directory_uri() . "/assets/js/pages/{$config->javascripts[$i]}", array(), ASSETS_VERSION, true);
                wp_enqueue_script($handle);
                if ($config->concat === false) {
                    add_filter('js_do_concat', function ($do_concat, $handle) {
                    if ($config->concat === false) {
                        return false;
                    }
                    return $do_concat;
                    }, 10, 2);
                }
            }
        }

        for ($i = 0; $i < count($config->css); $i++) {
            $handle = "pl-css-{$page}-$i";
            wp_register_style($handle, get_stylesheet_directory_uri() . "/assets/css/{$config->css[$i]}", array(), ASSETS_VERSION, "screen");
            wp_enqueue_style($handle);
            if ($config->concat === false) {
                add_filter('css_do_concat', function () {
                    return false;
                });
            }
        }
    }
}

function deleteJsAndCssEnqueueTargetAssetFromConcatenatedBundle($handle) {
    return false;
}

/**
 * Functions that call the files that the modules depend on
 */

function loadLibsScriptsForTemplate($file) {
    wp_register_script($file, get_stylesheet_directory_uri() . '/assets/lib/' . $file, array(), ASSETS_VERSION, true);
    wp_enqueue_script($file);
}

function loadModulesScriptsForTemplate($file) {
    wp_register_script($file, get_stylesheet_directory_uri() . '/assets/js/page-modules/' . $file, array(), ASSETS_VERSION, true);
    wp_enqueue_script($file);
}

function loadModulesCssForTemplate($file) {
    wp_register_style($file, get_stylesheet_directory_uri() . "/assets/css/page-modules/" . $file, array(), ASSETS_VERSION, "screen");
    wp_enqueue_style($file);
}