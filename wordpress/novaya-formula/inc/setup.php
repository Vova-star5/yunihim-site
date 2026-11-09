<?php
/**
 * Возможности темы и чистка <head>.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'script', 'style' ) );
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 200,
				'width'       => 600,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);
	}
);

/* Заголовок вкладки: «Название — описание» с длинным тире, как в вёрстке */
add_filter(
	'document_title_separator',
	function () {
		return '—';
	}
);

/* Описание для поисковиков, предзагрузка шрифта и флаг анимации первого экрана (должен сработать до отрисовки) */
add_action(
	'wp_head',
	function () {
		$description = trim( nf_opt( 'meta_description' ) );
		if ( $description ) {
			echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
		}
		echo '<link rel="preload" href="' . esc_url( NF_URI . '/assets/fonts/commissioner-cyrillic.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
		echo "<script>try { if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) document.documentElement.classList.add('page--hero-motion'); } catch (e) {}</script>\n";
	},
	1
);

/* sizes="auto" у ленивых картинок включает size containment: фото с aspect-ratio: auto (на телефоне) теряет пропорции */
add_filter( 'wp_img_tag_add_auto_sizes', '__return_false' );

/* Лишнее в <head>: эмодзи, генератор, стили блочного редактора (на сайте блоков нет) */
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
remove_action( 'wp_footer', 'wp_enqueue_global_styles', 1 );

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'classic-theme-styles' );
		wp_dequeue_style( 'global-styles' );
	},
	100
);
