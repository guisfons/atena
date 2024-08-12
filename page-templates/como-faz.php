<?php

/**
 * Template Name: Como faz
 * Template Post Type: page
 *
 * @package UAU
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner');

// Primeira section
get_template_part('template-parts/o-que-como-faz');

$diferenciais_conteudo = get_field('diferenciais_conteudo');

if($diferenciais_conteudo) :
	echo '<section animate-fadein class="wrapper diferenciais"><article>'.$diferenciais_conteudo.'</article>';
	if(have_rows('diferenciais')) :
		echo '<div class="diferenciais__box">';
		$x = 0;
		while (have_rows('diferenciais')) : the_row();
			$diferencas = get_sub_field('diferencas');
			$cor = get_sub_field('cor');
			echo '<style>.diferenciais__box article[data-index="'.$x.'"] span:last-of-type::after {background-color: '.$cor.';}</style>';
			echo '<article data-index="'.$x.'" style="background-color: '.$cor.';"><span>'.$diferencas.'</span><span></span></article>';

			$x++;
		endwhile;
		echo '</div>';
	endif;
	echo '</section>';
endif;

get_footer();
