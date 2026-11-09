<?php
/**
 * Стили и скрипты сайта.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style( 'nf-main', NF_URI . '/assets/css/index.css', array(), NF_VERSION );
		wp_enqueue_style( 'nf-wp', NF_URI . '/assets/css/wp.css', array( 'nf-main' ), NF_VERSION );

		$scripts = array( 'header', 'burger', 'hero', 'reveal' );
		foreach ( $scripts as $name ) {
			wp_enqueue_script(
				'nf-' . $name,
				NF_URI . '/assets/js/' . $name . '.js',
				array(),
				NF_VERSION,
				array(
					'strategy'  => 'defer',
					'in_footer' => false,
				)
			);
		}
	}
);
