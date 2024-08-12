<?php

/**
 * Template Name: Para quem faz
 * Template Post Type: page
 *
 * @package UAU
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner');

// Inline styles
$cor_de_destaque = get_field('cor_de_destaque');
echo '<style>.solucoes__heading, .objetivos__head-tab--active { background-color: ' . esc_attr($cor_de_destaque) . '; }</style>';

// Solucoes section
$solucoes = get_field('solucoes');
if ($solucoes) :
    $titulo = $solucoes['titulo'];
    $conteudo = $solucoes['conteudo'];
?>
    <section animate-fadein class="wrapper solucoes">
        <div class="solucoes__content">
            <h2 class="solucoes__heading"><?php echo esc_html($titulo); ?></h2>
            <article><?php echo wp_kses_post($conteudo); ?></article>
        </div>
        <figure class="solucoes__figure">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url()); ?>" alt="<?php echo esc_attr($titulo); ?>">
        </figure>
    </section>
<?php endif; ?>

<?php if (get_field('setor_privado')) :
    $objetivos_cnpj = get_field('objetivos_cnpj');
    $objetivos_cpf = get_field('objetivos_cpf');
?>
    <section class="wrapper objetivos">
        <div class="objetivos__selector">
            <div animate-fadein class="objetivos__head">
                <div class="objetivos__head-heading">
                    <?php if ($objetivos_cnpj) : ?>
                        <span class="objetivos__head-tab objetivos__head-tab--active" data-modelo="cnpj"><?php echo esc_html($objetivos_cnpj['titulo']); ?></span>
                    <?php endif; ?>
                    <?php if ($objetivos_cpf) : ?>
                        <span class="objetivos__head-tab" data-modelo="cpf"><?php echo esc_html($objetivos_cpf['titulo']); ?></span>
                    <?php endif; ?>
                </div>
                <div class="objetivos__head-selection">
                    <?php if ($objetivos_cnpj) : ?>
                        <div class="objetivos__head-text objetivos__head-text--active" data-modelo="cnpj">
                            <article><?php echo wp_kses_post($objetivos_cnpj['conteudo']); ?></article>
                            <figure><img src="<?php echo esc_url($objetivos_cnpj['imagem']['url']); ?>" alt="<?php echo esc_attr($objetivos_cnpj['titulo']); ?>"></figure>
                        </div>
                    <?php endif; ?>
                    <?php if ($objetivos_cpf) : ?>
                        <div class="objetivos__head-text" data-modelo="cpf">
                            <article><?php echo wp_kses_post($objetivos_cpf['conteudo']); ?></article>
                            <figure><img src="<?php echo esc_url($objetivos_cpf['imagem']['url']); ?>" alt="<?php echo esc_attr($objetivos_cpf['titulo']); ?>"></figure>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <div class="objetivos__wrapper">
                <?php if ($objetivos_cnpj) :
                    $ods_cnpj = $objetivos_cnpj['objetivos'];
                    $titulo_dos_objetivos_cnpj = $objetivos_cnpj['titulo_dos_objetivos'];
                    render_objetivos_content($ods_cnpj, $titulo_dos_objetivos_cnpj, 'cnpj');
                endif; ?>

                <?php if ($objetivos_cpf) :
                    $ods_cpf = $objetivos_cpf['objetivos'];
                    $titulo_dos_objetivos_cpf = $objetivos_cpf['titulo_dos_objetivos'];
                    render_objetivos_content($ods_cpf, $titulo_dos_objetivos_cpf, 'cpf');
                endif; ?>
            </div>
        </div>
    </section>
<?php else : ?>
	<section class="wrapper objetivos">
        <div class="objetivos__selector">
            <div class="objetivos__wrapper">
				<?php
				$ods = 'objetivos';
				$titulo_objetivos = $objetivos['titulo_objetivos'];
				render_objetivos_single_content($ods, $titulo_dos_objetivos);
				?>
            </div>
        </div>
    </section>
<?php endif;

get_template_part('template-parts/cases-projetos');
get_footer();

function render_objetivos_content($ods, $titulo, $modelo) {
    if ($ods) : ?>
        <div class="objetivos__content objetivos__content--<?php echo $modelo === 'cnpj' ? 'active' : ''; ?>" data-modelo="<?php echo esc_attr($modelo); ?>">
            <h2 animate-fadein class="objetivos__title"><?php echo esc_html($titulo); ?></h2>
            <div class="objetivos__odss">
                <?php
                $ods_number = 1;
                while (have_rows('objetivos_' . $modelo . '_objetivos')) : the_row(); ?>
                    <div class="objetivos__ods<?php echo $ods_number === 1 ? ' objetivos__ods--active' : ''; ?>" data-ods="<?php echo esc_attr($ods_number); ?>">
                        <?php if (have_rows('conteudos')) :
                            $page = 1;
                            while (have_rows('conteudos')) : the_row();
                                $conteudo = get_sub_field('conteudo');
                                $icone = get_field('ods', 'options')[$ods_number - 1]['icone'];
                                $cor = get_field('ods', 'options')[$ods_number - 1]['cor'];
                                $titulo = get_field('ods', 'options')[$ods_number - 1]['titulo'];
                        ?>
                                <article class="objetivos__page<?php echo $page === 1 ? ' objetivos__page--active' : ''; ?>" data-page="<?php echo esc_attr($page); ?>">
                                    <style>.objetivos__ods[data-ods="<?php echo esc_attr($ods_number); ?>"] .objetivos__page strong {color: <?php echo $cor; ?>}</style>
                                    <figure>
                                        <style>.objetivos__ods[data-ods="<?php echo esc_attr($ods_number); ?>"] article figure svg path { fill: <?php echo esc_attr($cor); ?> !important; }</style>
                                        <?php echo file_get_contents($icone); ?>
                                    </figure>
                                    <h3 style="color: <?php echo $cor; ?>"><?php echo esc_html($titulo); ?></h3>
                                    <?php echo wp_kses_post($conteudo); ?>
                                </article>
                        <?php
                                $page++;
                            endwhile;
                            if($page > 2) {
                                echo '<div class="objetivos__nav"><span class="objetivos__pager objetivos__pager--prev"></span><span class="objetivos__pager objetivos__pager--next"></span></div>';
                            }
                        endif; ?>
                    </div>
                <?php
                    $ods_number++;
                endwhile;
                ?>
            </div>
            <div class="objetivos__labels">
                <?php
                $ods_number = 1;
                while (have_rows('ods', 'options')) : the_row();
                    $titulo = get_sub_field('titulo');
                    $cor = get_sub_field('cor');
                    $icone = get_sub_field('icone');
                ?>
                    <div class="objetivos__label<?php echo $ods_number === 1 ? ' objetivos__label--active' : ''; ?>" data-ods="<?php echo esc_attr($ods_number); ?>" style="background-color: <?php echo esc_attr($cor); ?>">
                        ODS <?php echo esc_html($ods_number); ?> <figure><img src="<?php echo esc_url($icone); ?>" alt="Ícone ODS<?php echo esc_attr($ods_number); ?>"></figure>
                    </div>
                <?php
                    $ods_number++;
                endwhile;
                ?>
            </div>
        </div>
    <?php endif;
}

function render_objetivos_single_content($ods, $titulo) {
    if ($ods) : ?>
        <div class="objetivos__content objetivos__content--active" >
            <h2 class="objetivos__title"><?php echo esc_html($titulo); ?></h2>
            <div class="objetivos__odss">
                <?php
                $ods_number = 1;
                while (have_rows($ods)) : the_row(); ?>
                    <div class="objetivos__ods <?php echo $ods_number === 1 ? ' objetivos__ods--active' : ''; ?>" data-ods="<?php echo esc_attr($ods_number); ?>">
                        <?php if (have_rows('conteudos')) :
                            $page = 1;
                            while (have_rows('conteudos')) : the_row();
                                $conteudo = get_sub_field('conteudo');
                                $icone = get_field('ods', 'options')[$ods_number - 1]['icone'];
                                $cor = get_field('ods', 'options')[$ods_number - 1]['cor'];
                                $titulo = get_field('ods', 'options')[$ods_number - 1]['titulo'];
                        ?>
                                <article class="objetivos__page<?php echo $page === 1 ? ' objetivos__page--active' : ''; ?>" data-page="<?php echo esc_attr($page); ?>">
                                    <style>.objetivos__ods[data-ods="<?php echo esc_attr($ods_number); ?>"] .objetivos__page strong {color: <?php echo $cor; ?>}</style>
                                    <figure>
                                        <style>.objetivos__ods[data-ods="<?php echo esc_attr($ods_number); ?>"] article figure svg path { fill: <?php echo esc_attr($cor); ?> !important; }</style>
                                        <?php echo file_get_contents($icone); ?>
                                    </figure>
                                    <h3 style="color: <?php echo $cor; ?>"><?php echo esc_html($titulo); ?></h3>
                                    <?php echo wp_kses_post($conteudo); ?>
                                </article>
                        <?php
                                $page++;
                            endwhile;
                            if($page > 2) {
                                echo '<div class="objetivos__nav"><span class="objetivos__pager objetivos__pager--prev">Página anterior</span><span class="objetivos__pager objetivos__pager--next">Próxima página</span></div>';
                            }
                        endif; ?>
                    </div>
                <?php
                    $ods_number++;
                endwhile;
                ?>
            </div>
            <div class="objetivos__labels">
                <?php
                $ods_number = 1;
                while (have_rows('ods', 'options')) : the_row();
                    $titulo = get_sub_field('titulo');
                    $cor = get_sub_field('cor');
                    $icone = get_sub_field('icone');
                ?>
                    <div class="objetivos__label<?php echo $ods_number === 1 ? ' objetivos__label--active' : ''; ?>" data-ods="<?php echo esc_attr($ods_number); ?>" style="background-color: <?php echo esc_attr($cor); ?>">
                        ODS <?php echo esc_html($ods_number); ?> <figure><img src="<?php echo esc_url($icone); ?>" alt="Ícone ODS<?php echo esc_attr($ods_number); ?>"></figure>
                    </div>
                <?php
                    $ods_number++;
                endwhile;
                ?>
            </div>
        </div>
    <?php endif;
}
?>
