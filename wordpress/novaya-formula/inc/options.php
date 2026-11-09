<?php
/**
 * Страница «Настройки сайта»: тексты первого экрана, блок дилерам, заголовки разделов, контакты, подвал.
 * Все значения хранятся в одной опции nf_options.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_menu',
	function () {
		add_menu_page( 'Настройки сайта', 'Настройки сайта', 'edit_theme_options', 'nf-options', 'nf_render_options_page', 'dashicons-admin-customizer', 21 );
	}
);

add_action(
	'admin_init',
	function () {
		register_setting(
			'nf_options_group',
			'nf_options',
			array(
				'type'              => 'array',
				'sanitize_callback' => 'nf_sanitize_options',
			)
		);
	}
);

function nf_sanitize_options( $input ) {
	$clean = array();
	foreach ( nf_option_list() as $key => $field ) {
		$value = isset( $input[ $key ] ) ? $input[ $key ] : '';
		switch ( $field[1] ) {
			case 'textarea':
				$clean[ $key ] = sanitize_textarea_field( $value );
				break;
			case 'email':
				$clean[ $key ] = sanitize_email( $value );
				break;
			case 'image':
				$clean[ $key ] = absint( $value );
				break;
			default:
				$clean[ $key ] = sanitize_text_field( $value );
		}
	}
	return $clean;
}

add_action(
	'admin_enqueue_scripts',
	function ( $hook ) {
		if ( 'toplevel_page_nf-options' !== $hook ) {
			return;
		}
		wp_enqueue_media();
		wp_enqueue_script( 'nf-admin', NF_URI . '/assets/admin/admin.js', array( 'jquery' ), NF_VERSION, true );
		wp_enqueue_style( 'nf-admin', NF_URI . '/assets/admin/admin.css', array(), NF_VERSION );
	}
);

function nf_render_options_page() {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		return;
	}
	?>
	<div class="wrap nf-options">
		<h1>Настройки сайта</h1>
		<p>Тексты главной страницы. Товары, сегменты и условия работы редактируются в своих разделах меню слева. Логотип и значок сайта — в «Внешний вид → Настроить → Свойства сайта».</p>
		<form method="post" action="options.php">
			<?php settings_fields( 'nf_options_group' ); ?>
			<?php foreach ( nf_option_fields() as $section => $fields ) : ?>
				<h2 class="title"><?php echo esc_html( $section ); ?></h2>
				<table class="form-table" role="presentation"><tbody>
					<?php
					foreach ( $fields as $key => $field ) {
						nf_render_option_field( $key, $field );
					}
					?>
				</tbody></table>
			<?php endforeach; ?>
			<?php submit_button( 'Сохранить' ); ?>
		</form>
	</div>
	<?php
}

function nf_render_option_field( $key, $field ) {
	$label = $field[0];
	$type  = $field[1];
	$hint  = isset( $field[3] ) ? $field[3] : '';
	$id    = 'nf_opt_' . $key;
	$name  = 'nf_options[' . $key . ']';
	$value = nf_opt( $key );

	echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $label ) . '</label></th><td>';

	if ( 'textarea' === $type ) {
		$rows = max( 2, min( 6, substr_count( (string) $value, "\n" ) + 2 ) );
		echo '<textarea class="large-text" rows="' . (int) $rows . '" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '">' . esc_textarea( $value ) . '</textarea>';
	} elseif ( 'image' === $type ) {
		$image_id = (int) $value;
		$preview  = $image_id ? wp_get_attachment_image( $image_id, 'medium' ) : '';
		echo '<div class="nf-image" data-nf-image>';
		echo '<input type="hidden" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $image_id ? $image_id : '' ) . '" data-nf-image-input>';
		echo '<div class="nf-image__preview" data-nf-image-preview>' . $preview . '</div>'; // phpcs:ignore WordPress.Security.EscapeOutput -- wp_get_attachment_image output.
		echo '<button type="button" class="button" data-nf-image-choose>Выбрать фото</button> ';
		echo '<button type="button" class="button-link nf-image__remove" data-nf-image-remove' . ( $image_id ? '' : ' hidden' ) . '>Убрать</button>';
		echo '</div>';
	} else {
		$input_type = 'email' === $type ? 'email' : 'text';
		echo '<input type="' . esc_attr( $input_type ) . '" class="large-text" id="' . esc_attr( $id ) . '" name="' . esc_attr( $name ) . '" value="' . esc_attr( $value ) . '">';
	}

	if ( $hint ) {
		echo '<p class="description">' . esc_html( $hint ) . '</p>';
	}
	echo '</td></tr>';
}
