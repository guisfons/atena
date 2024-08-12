<section animate-fadein class="wrapper intro">
    <article><?php echo get_field('conteudo'); ?></article>
    <figure><img src="<?php echo esc_url(get_field('ornamento')); ?>" alt="Ornamento"></figure>
</section>

<section animate-fadein class="destaque" style="background-image: url('<?php echo esc_url(get_field('imagem_de_fundo')); ?>');">
    <div class="wrapper">
        <article class="destaque__content">
            <div class="destaque__heading">
                <span><?php echo get_field('titulo'); ?></span>
                <span><?php echo get_field('chamada'); ?></span>
            </div>
            
            <?php echo get_field('conteudo_2'); ?>
        </article>
    </div>
</section>