<?php
/**
 * Разделы в админке: «Продукция», «Для кого», «Условия работы».
 * Это не отдельные страницы сайта, а блоки главной: записи выводятся по полю «Порядок».
 */

defined( 'ABSPATH' ) || exit;

function nf_post_types() {
	return array(
		'nf_product'  => array(
			'menu'     => 'Продукция',
			'one'      => 'Товар',
			'add'      => 'Добавить товар',
			'icon'     => 'dashicons-products',
			'position' => 22,
			'photo'    => true,
		),
		'nf_audience' => array(
			'menu'     => 'Для кого',
			'one'      => 'Сегмент',
			'add'      => 'Добавить сегмент',
			'icon'     => 'dashicons-groups',
			'position' => 23,
			'photo'    => true,
		),
		'nf_term'     => array(
			'menu'     => 'Условия работы',
			'one'      => 'Условие',
			'add'      => 'Добавить условие',
			'icon'     => 'dashicons-clipboard',
			'position' => 24,
			'photo'    => false,
		),
	);
}

add_action(
	'init',
	function () {
		foreach ( nf_post_types() as $type => $t ) {
			$supports = array( 'title', 'page-attributes' );
			if ( $t['photo'] ) {
				$supports[] = 'thumbnail';
			}

			register_post_type(
				$type,
				array(
					'labels'              => array(
						'name'                  => $t['menu'],
						'singular_name'         => $t['one'],
						'menu_name'             => $t['menu'],
						'all_items'             => $t['menu'],
						'add_new'               => $t['add'],
						'add_new_item'          => $t['add'],
						'edit_item'             => 'Редактировать',
						'new_item'              => $t['add'],
						'search_items'          => 'Найти',
						'not_found'             => 'Пока пусто',
						'not_found_in_trash'    => 'В корзине пусто',
						'featured_image'        => 'Фото',
						'set_featured_image'    => 'Выбрать фото',
						'remove_featured_image' => 'Убрать фото',
						'use_featured_image'    => 'Использовать как фото',
						'attributes'            => 'Порядок на сайте',
					),
					'public'              => false,
					'show_ui'             => true,
					'show_in_menu'        => true,
					'show_in_nav_menus'   => false,
					'show_in_rest'        => false,
					'exclude_from_search' => true,
					'publicly_queryable'  => false,
					'has_archive'         => false,
					'rewrite'             => false,
					'hierarchical'        => false,
					'menu_icon'           => $t['icon'],
					'menu_position'       => $t['position'],
					'supports'            => $supports,
				)
			);
		}
	}
);

/* В списках записей — колонка «Порядок» и сортировка по ней */
foreach ( array_keys( nf_post_types() ) as $nf_type ) {
	add_filter(
		"manage_{$nf_type}_posts_columns",
		function ( $columns ) {
			$columns['nf_order'] = 'Порядок';
			unset( $columns['date'] );
			return $columns;
		}
	);
	add_action(
		"manage_{$nf_type}_posts_custom_column",
		function ( $column, $post_id ) {
			if ( 'nf_order' === $column ) {
				echo (int) get_post_field( 'menu_order', $post_id );
			}
		},
		10,
		2
	);
}

add_action(
	'pre_get_posts',
	function ( $query ) {
		if ( is_admin() && $query->is_main_query() && array_key_exists( (string) $query->get( 'post_type' ), nf_post_types() ) && ! $query->get( 'orderby' ) ) {
			$query->set( 'orderby', 'menu_order' );
			$query->set( 'order', 'ASC' );
		}
	}
);

/* Подсказка про порядок в поле «Порядок на сайте» */
add_filter(
	'enter_title_here',
	function ( $text, $post ) {
		$hints = array(
			'nf_product'  => 'Название товара, например: Жидкое мыло «Новая формула»',
			'nf_audience' => 'Кому: например, Прачечные',
			'nf_term'     => 'Название условия, например: Оплата',
		);
		return isset( $hints[ $post->post_type ] ) ? $hints[ $post->post_type ] : $text;
	},
	10,
	2
);

/* Записи и комментарии на этом сайте не используются — убираем из меню, чтобы не путали */
add_action(
	'admin_menu',
	function () {
		remove_menu_page( 'edit.php' );
		remove_menu_page( 'edit-comments.php' );
	}
);
