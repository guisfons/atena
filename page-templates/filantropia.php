<?php
    /**
     * Template Name: Filantropia
     * Template Post Type: page
     *
     * @package UAU
     * @since 1.0.0
     */

    get_header();
	get_template_part('template-parts/banner');
?>
<section animate-fadein class="wrapper intro">
    <article><?php echo get_field('conteudo'); ?></article>
    <figure><img src="<?php echo esc_url(get_field('icone')); ?>" alt="Ornamento"></figure>
</section>

<?php
get_template_part('template-parts/cases-projetos');

$titulo_comunidades = get_field('titulo_comunidades');
$subtitulo_comunidades = get_field('subtitulo_comunidades');

if( have_rows('comunidades') ):
    echo
    '<section class="wrapper comunidades">
        <div animate-fadein class="comunidades__heading">
            <span>
                <h2>'.$titulo_comunidades.'</h2>
                <span>'.$subtitulo_comunidades.'</span>
            </span>
            <div class="comunidades__nav">
                <span class="comunidades__arrow comunidades__arrow--prev"></span>
                <span class="comunidades__arrow comunidades__arrow--next"></span>
            </div>
        </div>
        <div animate-fadein class="comunidades__slider">';
    while( have_rows('comunidades') ) : the_row();
        $imagem = get_sub_field('imagem');
        $titulo = get_sub_field('titulo');
        $descricao = get_sub_field('descricao');
        $link = get_sub_field('link');

        echo
        '<div class="comunidades__slide">
            <figure><img src="'.$imagem.'" alt=" '.$$titulo.'"></figure>
            <article><h3>'.$titulo.'</h3><p>'.$descricao.'</p><a href="'.$link.'" target="_blank" title="'.$titulo.'">Conheça mais</a></article>
        </div>';
    endwhile;
    echo '</div></section>';
endif;

$galeria = get_field('galeria');
if( $galeria ):
    $x = 0;
    echo
    '<section class="wrapper galeria">
        <div animate-fadein class="galeria__heading">
            <h2>Galeria de fotos</h2>
            <div class="galeria__nav">
                <span class="galeria__arrow galeria__arrow--prev"></span>
                <span class="galeria__arrow galeria__arrow--next"></span>
            </div>
        </div>
        <div class="galeria__slider">';
    foreach( $galeria as $imagem ):
        $imagem_url = $imagem['url'];
        $imagem_legenda = $imagem['caption'];

        if(empty($imagem_legenda)) {
            $imagem_legenda = $imagem['title'];
        }

        echo
        '<figure animate-fadein data-slide="'.$x.'" class="galeria__slide"><img src="'.$imagem_url.'" alt="'.$imagem_legenda.'"><span>'.$imagem_legenda.'</span></figure>';
        $x++;
    endforeach;
    echo
        '</div>
        <div class="galeria__modal">
        <span class="galeria__modal-close"><span></span><span></span></span>
        <div class="galeria__modal-slider">';
        foreach( $galeria as $imagem ):
            $imagem_url = $imagem['url'];
            $imagem_legenda = $imagem['caption'];
    
            if(empty($imagem_legenda)) {
                $imagem_legenda = $imagem['title'];
            }
    
            echo
            '<figure><img src="'.$imagem_url.'" alt="'.$imagem_legenda.'"><span>'.$imagem_legenda.'</span></figure>';
    
        endforeach;

    echo '</div></div>
    </section>';
endif;
?>


<?php get_footer();