<?php

/**
 * Template Name: O que é Atena
 * Template Post Type: page
 *
 * @package UAU
 * @since 1.0.0
 */

get_header();
get_template_part('template-parts/banner');

echo '<section class="wrapper oqe-atena">';
$primeira_sessao = get_field('primeira_sessao');
if($primeira_sessao) :
	$imagem = $primeira_sessao['imagem_de_fundo'];
	$conteudo = $primeira_sessao['conteudo'];

	echo
	'<div animate-fadein class="oqe-atena__box" style="background-image: url('.$imagem.');">
		<article>'.$conteudo.'</article>
	</div>';
endif;

$mvv = get_field('missao__visao__valores');
if($mvv) :
	echo '<div animate-fadein class="mvv">';
	if( have_rows('missao__visao__valores') ):
		while( have_rows('missao__visao__valores') ) : the_row();
			$conteudo = get_sub_field('conteudo');
			echo '<article>'.$conteudo.'</article>';
		endwhile;
		echo '</div>';
	endif;
endif;

echo '</section>';

$detalhe = get_field('detalhe');
if($detalhe) :
	echo '<figure class="ornamento"><img src="'.$detalhe['url'].'" alt="Ornamento"></figure>';
endif;

// Sobre o fundador
$titulo = get_field('titulo');
$chamada = get_field('chamada');
$sobre = get_field('sobre');
$imagem = get_field('imagem');

echo
'<section animate-fadein class="s-fundador">
	<div class="wrapper">
		<div class="s-fundador__heading">
			<span>'.$titulo.'</span>
			<span>'.$chamada.'</span>
		</div>

		<article>'.$sobre.'</article>
		<figure><img src="'.$imagem.'" alt="'.$chamada.'"></figure>
	</div>
</section>';

// Conselho administrativo
$conselho_administrativo = get_field('conselho_administrativo');
if($conselho_administrativo) :
	echo '<section animate-fadein class="wrapper c-administrativo"><h2>Conselho adminstrativo</h2>';
	if( have_rows('conselho_administrativo') ):
		while( have_rows('conselho_administrativo') ) : the_row();
			$nome = get_sub_field('nome');
			$linkedin = get_sub_field('linkedin');
			$foto = get_sub_field('foto');
			
			echo
			'<a href="'.$linkedin.'" target="_blank" title="'.$nome.'">
				<figure><img src="'.$foto.'" alt="'.$nome.'"></figure>
				<span>'.$nome.'</span>
			</a>';
		endwhile;
	endif;
	echo '</section>';
endif;

// Ecossistema
$conheca_nosso_ecossistema = get_field('conheca_nosso_ecossistema');

if($conheca_nosso_ecossistema) :
	echo 
	'<section animate-fadein class="wrapper c-ecossistema">
			<h2>Conheça Nosso ecossistema</h2>';
		if($conheca_nosso_ecossistema) :
			foreach ($conheca_nosso_ecossistema as $image) :
				echo '<figure><img src="'.$image['url'].'" alt="'.$image['alt'].'"></figure>';
			endforeach;
		endif;
	echo '</section>';
endif;

get_footer();