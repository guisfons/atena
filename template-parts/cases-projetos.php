<?php
if(is_page('filantropia')) :
    $titulo = get_field('titulo');
    
    if( have_rows('projetos') ):
        echo '<section animate-fadein class="cases"><div class="wrapper"><div class="cases__heading">'.$titulo.'</div><div class="cases__slider">';
        $x = 1;
        while( have_rows('projetos') ) : the_row();
            $descricao = get_sub_field('descricao');
            $imagem = get_sub_field('imagem');

            echo '<div class="cases__slide"><article>'.$descricao.'</article><figure><img src="'.$imagem.'" alt="Projeto '.$x.'"></figure></div>';
            $x++;
        endwhile;
        echo '</div><div class="cases__nav"><span class="cases__arrow cases__arrow--prev"></span><span class="cases__arrow cases__arrow--next"></span></div></div></section>';
    endif;
endif;
if ( is_page_template('page-templates/para-quem-faz.php') ) :
    $cases = get_field('cases');
    if($cases) :
        $titulo = $cases['titulo'];
        $cases = $cases['cases'];
    ?>
    <section animate-fadein class="cases">
        <div class="wrapper">
            <div class="cases__heading"><?php echo $titulo; ?></div>
            <div class="cases__slider">
                <?php
                $x = 1;
                foreach($cases as $case) :
                    $descricao = $case['descricao'];
                    $imagem = $case['imagem'];
                    echo '<div class="cases__slide"><article>'.$descricao.'</article><figure><img src="'.$imagem['url'].'" alt="Projeto '.$x.'"></figure></div>';
                    $x++;
                endforeach;
                ?>
            </div>
            <div class="cases__nav">
                <span class="cases__arrow cases__arrow--prev"></span>
                <span class="cases__arrow cases__arrow--next"></span>
            </div>
        </div>
    </section>
<?php
    endif;
endif;
?>