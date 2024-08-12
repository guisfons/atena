<?php
    /**
     * Template Name: Contato
     * Template Post Type: page
     *
     * @package UAU
     * @since 1.0.0
     */

    get_header();
	get_template_part('template-parts/banner');
?>
<section class="wrapper contact">
	<div class="contact__content">
		<?php
		$sessao_superior = get_field('sessao_superior');
		
		if($sessao_superior):
			$titulo = $sessao_superior['titulo'];
			$subtitulo = $sessao_superior['subtitulo'];
			$meios_de_contato = $sessao_superior['meios_de_contato'];

			echo '<h2 animate-fadein>'.$titulo.'</h2>';
			echo '<p animate-fadein>'.$subtitulo.'</p>';

			if($meios_de_contato) :
				foreach ($meios_de_contato as $contato) :
					$titulo = $contato['titulo'];
					$imagem_de_fundo = $contato['imagem_de_fundo'];
					$link = $contato['link'];

					echo
					'<a animate-fadein href="'.$link['url'].'" target="_blank" title="'.$titulo.'" class="contact__card">
						<figure><img src="'.$imagem_de_fundo['url'].'" alt="'.$titulo.'"></figure>
						<span>'.$titulo.'</span>
					</a>';
				endforeach;
			endif;
		endif;

		$sessao_de_contato = get_field('sessao_de_contato');
		
		if($sessao_de_contato):
			$titulo = $sessao_de_contato['titulo'];
			$subtitulo = $sessao_de_contato['subtitulo'];
			$formulario = $sessao_de_contato['formulario'];
			
			echo '<h2>'.$titulo.'</h2>';
			echo '<p>'.$subtitulo.'</p>';

			if($formulario) :
				echo '<div animate-fadein class="contact__form">'.do_shortcode('[contact-form-7 id="'.$formulario[0]->ID.'"]').'</div>';
			endif;
		endif;
		?>
	</div>
</section>
<?php

    get_footer();