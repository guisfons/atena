<?php

/**
 * Template Name: O que faz
 * Template Post Type: page
 *
 * @package UAU
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner');

// Primeira section
get_template_part('template-parts/o-que-como-faz');
?>

<section animate-fadein class="wrapper p-mercado">
	<article><?php echo get_field('potencial_de_mercado'); ?></article>
	<figure><img src="<?php echo esc_url(get_field('ornamento_2')); ?>" alt="Ornamento 2"></figure>

	<?php
	if( have_rows('prejuizos') ):
		echo '<div class="p-mercado__container">';
		while( have_rows('prejuizos') ) : the_row();
			$icone = get_sub_field('icone');
			$cor_de_fundo = get_sub_field('cor_de_fundo');
			$conteudo = get_sub_field('conteudo');

			echo
			'<div animate-fadein class="p-mercado__card" style="background-color: '.$cor_de_fundo.';">
				<figure><img src="'.$icone.'" alt="Ícone"></figure>
				<article>'.$conteudo.'</article>
			</div>';
		endwhile;
		echo '</div>';
	endif;
	?>
</section>

<?php
get_footer();
