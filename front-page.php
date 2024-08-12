<?php
	get_header();

	get_template_part('template-parts/banner');

	$primeira_section = get_field('primeira_sessao');
	if($primeira_section):
		echo '<section class="s-sector">';
		$descricao = $primeira_section['descricao'];
		$titulo_destaque = $primeira_section['titulo_destaque'];
		$conteudo = $primeira_section['conteudo'];
		$setores = $primeira_section['setores'];

		echo
		'<style>
			.s-sector__first span:last-of-type::after, .s-sector__first span:last-of-type::before {content: "'.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.'"}
			.s-sector__first span:last-of-type::before {content: "'.$titulo_destaque.' ";
		</style>
		<div class="s-sector__first">
			<div class="wrapper">
				<span animate-fadein>'.$descricao.'</span>
				<span animate-fadein>'.$titulo_destaque.'</span>

				<article animate-fadein>'.$conteudo.'</article>
			</div>
		</div>';

		if ($setores) :
			echo '<div class="wrapper s-sector__sectors">';
			$x = 1;
			foreach ($setores as $setor) :
				$titulo = $setor['titulo'];
				$icone = $setor['icone'];
				$imagem = $setor['imagem'];
				$conteudo = $setor['conteudo'];
				$link = $setor['link'];
				$cor_de_destaque = $setor['cor_de_destaque'];
				$cor_do_botao = $setor['cor_do_botao'];

				echo
				'<div animate-fadein class="s-sector__card" style="background-color: '.$cor_de_destaque.';">
					<span>
						'.$titulo.'
						<figure><img src="'.esc_url($icone['url']).'" alt="'.esc_attr($icone['alt']).'"></figure>
					</span>
					<figure><img src="'.esc_url($imagem['url']).'" alt="'.esc_attr($imagem['alt']).'"></figure>
					<article>'.$conteudo.'</article>
					<a href="'.esc_url($link).'" title="'.$titulo.'" style="background-color: '.$cor_do_botao.';">Saiba Mais</a>
				</div>';
				$x++;
			endforeach;
			echo '</div>';
		endif;
		echo '</section>';
	endif;

	$segunda_section = get_field('segunda_sessao');
	if($segunda_section) :
		$titulo_destaque = $segunda_section['titulo_destaque'];
		$imagem_de_fundo = $segunda_section['imagem_de_fundo'];
		$chamada = $segunda_section['chamada'];
		$lista = $segunda_section['lista'];
		$imagem = $segunda_section['imagem'];

		echo
		'<section class="wrapper sustentabilidade">
			<div class="sustentabilidade__map">
				<figure class="sustentabilidade__map-effect"><img src="'.$imagem_de_fundo['url'].'" alt="'.esc_html($titulo_destaque).'"></figure>
				<span class="sustentabilidade__texto">
					<span class="sustentabilidade__texto-highlight">'.$titulo_destaque.'</span>
					<span>'.$titulo_destaque.'</span>
				</span>
			</div>

			<div animate-fadein class="sustentabilidade__ajudar">
				<article>
					<h2>'.$chamada.'</h2>
					'.$lista.'
				</article>
				<figure><img src="'.$imagem['url'].'" alt="'.$chamada.'"></figure>
			</div>
		</section>';
	endif;

	$terceira_section = get_field('terceira_sessao');
	if($terceira_section) :
		$titulo_destaque = $terceira_section['titulo_destaque'];
		$descricao = $terceira_section['descricao'];
		$midia = $terceira_section['midia'];
		$imagem = $terceira_section['imagem'];
		$video = $terceira_section['video'];

		echo
		'<style>
			.atuacao__head span:last-of-type::after {content: "'.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.' '.$titulo_destaque.'"}
			.atuacao__head span:last-of-type::before {content: "'.$titulo_destaque.' ";
		</style>
		<section animate-fadein class="atuacao">
			<div class="wrapper">
				<div class="atuacao__head">
					<span>'.$descricao.'</span>
					<span>'.$titulo_destaque.'</span>
				</div>';
			
			if($midia) {
				echo '<figure>Por favor adicione o código</figure>';
			} else {
				echo '<figure><img src="'.$imagem['url'].'" alt="'.$titulo_destaque.'"></figure>';
			}
		echo '</div>
		</section>';
	endif;

	$quarta_section = get_field('quarta_sessao');
	if($quarta_section) :
		$texto = $quarta_section['texto'];
		$link = $quarta_section['link'];
		$link_target = $link['target'];

		if(empty($link_target)) {
			$link_target = '';
		}

		$imagem_de_fundo = $quarta_section['imagem_de_fundo'];
		$sliders = $quarta_section['sliders'];

		echo
		'<section animate-fadein class="wrapper solucoes" style="background-image: url('.$imagem_de_fundo['url'].')">
			<article>'.$texto.' <br><a href="'.$link['url'].'" title="'.$link['title'].'" target="'.$link_target.'">'.$link['title'].'</a></article>
		</section>';

		if ($sliders) :
			foreach ($sliders as $slider) :
				$titulo = $slider['titulo'];
				$images = $slider['imagens'];

				echo
				'<section animate-fadein class="wrapper slider"><h2>'.$titulo.'</h2>';
					if($images) :
						echo '<div class="slider__images">';
						foreach ($images as $image) :
							echo '<figure><img src="'.$image['url'].'" alt="'.$image['alt'].'"></figure>';
						endforeach;
						echo '</div>';
					endif;
				echo '</section>';
			endforeach;
		endif;
	endif;

	$certificacoes = get_field('certificacoes');
	if($certificacoes) :
		$titulo = $certificacoes['titulo'];
		$slider = $certificacoes['imagens'];

		if ($slider) :
			echo
				'<section animate-fadein class="certificacoes">
					<div class="wrapper">
						<h2>'.$titulo.'</h2>';
					if($slider) :
						echo '<div class="slider__images">';
						foreach ($slider as $image) :
							echo '<figure><img src="'.$image['url'].'" alt="'.$image['alt'].'"></figure>';
						endforeach;
						echo '</div>';
					endif;
				echo '</div></section>';
		endif;
	endif;
	
    get_footer();