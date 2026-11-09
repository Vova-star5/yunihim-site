<?php
/**
 * Поля записей «Продукция», «Для кого», «Условия работы».
 * Хранятся в post meta с префиксом _nf_ (скрытые поля, в «Произвольных полях» не видны).
 */

defined( 'ABSPATH' ) || exit;

/** Поля по типам записей: ключ => [подпись, тип, подсказка]. Типы: text, textarea, checkbox. */
function nf_meta_fields() {
	$bullets_hint = 'Каждый пункт с новой строки. Первое предложение пункта (до точки) выделится жирным.';

	return array(
		'nf_product'  => array(
			'short_name' => array( 'Короткое название', 'text', 'Для кнопки на первом экране, например: Жидкое мыло. Если пусто — берётся название товара.' ),
			'intro'      => array( 'Описание', 'textarea', '' ),
			'sub'        => array( 'Заголовок над пунктами', 'text', 'Например: Что даёт «Новая формула»:' ),
			'bullets'    => array( 'Пункты', 'textarea', $bullets_hint ),
			'close'      => array( 'Итоговая фраза', 'textarea', 'Под пунктами, отделяется строчкой.' ),
			'scents'     => array( 'Отдушки', 'textarea', 'Через запятую с пробелом.' ),
			'packs'      => array( 'Фасовка', 'textarea', 'Через запятую с пробелом, например: 0,5 л, канистра 5 л. В дробных числах пробел после запятой не ставьте.' ),
			'label'      => array( 'Этикетка', 'text', 'Например: готова или в разработке.' ),
			'photo_top'  => array( 'Кадрировать фото по верхнему краю', 'checkbox', 'Если на фото обрезаются крышки флаконов.' ),
		),
		'nf_audience' => array(
			'intro'   => array( 'Вступление', 'textarea', '' ),
			'sub'     => array( 'Заголовок над пунктами', 'text', 'Необязательно, например: Почему с нами выгодно работать:' ),
			'bullets' => array( 'Пункты', 'textarea', $bullets_hint ),
		),
		'nf_term'     => array(
			'text' => array( 'Текст', 'textarea', '' ),
		),
	);
}

add_action(
	'add_meta_boxes',
	function () {
		foreach ( nf_meta_fields() as $type => $fields ) {
			add_meta_box( 'nf_fields', 'Содержимое', 'nf_render_meta_box', $type, 'normal', 'high' );
		}
	}
);

/* Подсказка про фото и порядок рядом с полем «Фото» */
add_filter(
	'admin_post_thumbnail_html',
	function ( $html, $post_id ) {
		$type = get_post_type( $post_id );
		if ( 'nf_product' === $type ) {
			$html .= '<p class="description">Без фото на сайте показывается заглушка «Этикетка в разработке».</p>';
		} elseif ( 'nf_audience' === $type ) {
			$html .= '<p class="description">Квадратное или горизонтальное, на сайте обрезается в квадрат.</p>';
		}
		return $html;
	},
	10,
	2
);

function nf_render_meta_box( $post ) {
	$fields = nf_meta_fields()[ $post->post_type ];
	wp_nonce_field( 'nf_save_meta', 'nf_meta_nonce' );

	echo '<table class="form-table" role="presentation"><tbody>';
	foreach ( $fields as $key => $field ) {
		list( $label, $type, $hint ) = $field;
		$id    = 'nf_' . $key;
		$value = nf_meta( $post->ID, $key );

		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label></th><td>';
		if ( 'textarea' === $type ) {
			$rows = 'bullets' === $key ? 8 : 3;
			echo '<textarea class="large-text" rows="' . (int) $rows . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '">' . esc_textarea( $value ) . '</textarea>';
		} elseif ( 'checkbox' === $type ) {
			echo '<input type="checkbox" value="1" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '"' . checked( $value, '1', false ) . '>';
		} else {
			echo '<input type="text" class="large-text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" value="' . esc_attr( $value ) . '">';
		}
		if ( $hint ) {
			echo '<p class="description">' . esc_html( $hint ) . '</p>';
		}
		echo '</td></tr>';
	}
	echo '</tbody></table>';
	echo '<p class="description">Порядок на сайте задаётся числом в блоке «Порядок на сайте» справа: меньше — выше.</p>';
}

add_action(
	'save_post',
	function ( $post_id, $post ) {
		$all = nf_meta_fields();
		if ( ! isset( $all[ $post->post_type ] ) ) {
			return;
		}
		if ( ! isset( $_POST['nf_meta_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nf_meta_nonce'] ) ), 'nf_save_meta' ) ) {
			return;
		}
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		foreach ( $all[ $post->post_type ] as $key => $field ) {
			$name = 'nf_' . $key;
			if ( 'checkbox' === $field[1] ) {
				$value = empty( $_POST[ $name ] ) ? '' : '1';
			} elseif ( 'textarea' === $field[1] ) {
				$value = isset( $_POST[ $name ] ) ? sanitize_textarea_field( wp_unslash( $_POST[ $name ] ) ) : '';
			} else {
				$value = isset( $_POST[ $name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $name ] ) ) : '';
			}
			update_post_meta( $post_id, '_nf_' . $key, $value );
		}
	},
	10,
	2
);
