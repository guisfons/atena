<?php
$imagem_orcamento = get_field('imagem_orcamento');
$texto_orcamento = get_field('texto_orcamento');
$link_de_orcamento = get_field('link_de_orcamento');
$link_de_orcamento_url = '';
$link_de_orcamento_target = '';

if(empty($link_de_orcamento['url'])) :
    $link_de_orcamento_url = '';
else :
    $link_de_orcamento_url = $link_de_orcamento['url'];
endif;

if(empty($link_de_orcamento['target'])) :
    $link_de_orcamento_target = '';
else :
    $link_de_orcamento_target = $link_de_orcamento['target'];
endif;

if($imagem_orcamento) :
    echo
    '<section animate-fadein class="wrapper orcamento">
        <article>
            '.$texto_orcamento.'

            <div class="orcamento__destaque">
                <span>Pague sempre com</span>
                <span>ATENA</span>
            </div>

            <a href="'.$link_de_orcamento_url.'" title="Faça um orçamento agora" target="'.$link_de_orcamento_target.'">Faça um orçamento agora</a>
        </article>
        <figure><img src="'.$imagem_orcamento.'" alt="Imagem de orçamento"></figure>
    </section>';
endif;
?>

</main>
<footer class="footer">
    <div class="wrapper footer__content">
        <?php
        $cor_destaque = get_field('cor_destaque', 'options');
        $contato = get_field('contato', 'options');
        if ($contato) :
            $titulo = $contato['titulo'];
            $icone = $contato['icone'];
            $texto = $contato['texto'];
            $link = $contato['link'];
        ?>
            <div class="footer__contato">
                <h4 style="color: <?= $cor_destaque; ?>"><?= $titulo; ?></h4>
                <a href="<?= esc_url($link['url']); ?>" title="<?= $link['title']; ?>" target="<?= $link['target']; ?>" style="background-color: <?= $cor_destaque; ?>">
                    <img src="<?= esc_url($icone['url']); ?>" title="<?= $icone['title']; ?>">
                    <?= $texto; ?>
                </a>
            </div>
        <?php
        endif;

        $titulo_redes = get_field('titulo_redes_sociais', 'options');
        if (have_rows('redes_sociais', 'options')) :
            echo '<div class="footer__redes"><h4 style="color: ' . $cor_destaque . '">' . $titulo_redes . '</h4>';
            while (have_rows('redes_sociais', 'options')) : the_row();
                $icone = get_sub_field('icone');
                $link = get_sub_field('link');

                echo '<a href="' . esc_url($link['url']) . '" title="' . $link['title'] . '" target="' . $link['target'] . '"><img src="' . esc_url($icone['url']) . '" alt="' . $icone['title'] . '"></a>';
            endwhile;
            echo '</div>';
        endif;
        ?>

        <figure class="footer__logo"><img src="<?php echo esc_url(get_field('logo', 'option')['url']); ?>" alt="<?php echo get_the_title(); ?>"></figure>
        <span>Copyright © <?php echo date("Y"); ?> Atena ESG. Todos os direitos reservados.</span>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>