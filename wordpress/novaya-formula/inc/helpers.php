<?php
/**
 * Настройки сайта по умолчанию и функции вывода.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Поля страницы «Настройки сайта»: раздел => [ ключ => [подпись, тип, значение по умолчанию, подсказка] ].
 * Типы: text, textarea, email, image.
 */
function nf_option_fields() {
	$nbsp = "\u{00A0}";

	return array(
		'Первый экран' => array(
			'hero_title'  => array( 'Заголовок', 'textarea', 'Добро пожаловать на сайт завода-производителя профессиональной химии!' ),
			'hero_text'   => array( 'Текст под заголовком', 'textarea', "Мы специализируемся на разработке и производстве высокоэффективных моющих средств для индустрии гостеприимства (HoReCa), профессиональных прачечных и химчисток, а также для использования в быту.\nНаш производственный комплекс расположен в г.{$nbsp}Тучково Московской области, что позволяет нам оперативно отгружать заказы любого объёма.", 'Каждая строка — отдельный абзац.' ),
			'offer_title' => array( 'Заголовок списка', 'text', 'Мы предлагаем гибкие условия сотрудничества для B2B-партнеров:' ),
			'offer_items' => array( 'Пункты списка', 'textarea', "Прямой опт: качественная химия без наценок посредников.\nСобственная торговая марка «Новая Формула».\nРазработаем рецептуру и упакуем продукт под вашим товарным знаком.\nСырьевой сектор: поставляем высококачественные основы для дальнейшего производства бытовой химии.", 'Каждая строка — пункт. Текст до двоеточия выделяется жирным.' ),
			'hero_close'  => array( 'Фраза под списком', 'textarea', 'Выбирая нас, вы получаете надёжного партнера, гибкий подход к рецептурам и строгий контроль качества каждой партии.' ),
		),
		'Дилерам' => array(
			'dealer_title'  => array( 'Заголовок', 'text', 'Дилерам и дистрибьюторам' ),
			'dealer_lead'   => array( 'Первый абзац (жирный)', 'textarea', 'Развивайте бизнес вместе с нами: ищем дилеров и дистрибьюторов в регионах России и СНГ!' ),
			'dealer_text'   => array( 'Текст', 'textarea', "Приглашаем к долгосрочному партнёрству торговые компании, региональных оптовиков и дистрибьюторов бытовой и профессиональной химии.\nМы предлагаем востребованный продукт напрямую от завода в Московской области, эксклюзивные права на закреплённой территории.", 'Каждая строка — отдельный абзац.' ),
			'dealer_button' => array( 'Текст кнопки', 'text', 'Стать дилером' ),
		),
		'Продукция' => array(
			'products_title' => array( 'Заголовок раздела', 'text', 'Продукция' ),
			'soon_title'     => array( 'Блок «Скоро»: заголовок', 'text', 'Скоро в линейке', 'Оставьте пустым, чтобы скрыть блок.' ),
			'soon_text'      => array( 'Блок «Скоро»: текст', 'text', 'Гели для душа, шампуни и другие средства.' ),
			'soon_link'      => array( 'Блок «Скоро»: ссылка', 'text', 'Спросить о новинках' ),
		),
		'Фото после продукции' => array(
			'band_image'   => array( 'Фото', 'image', 0, 'Широкое фото во всю ширину экрана. Если не выбрано — стоит фото из темы.' ),
			'band_alt'     => array( 'Описание фото', 'text', 'Белые канистры на линии розлива', 'Для поисковиков и незрячих посетителей.' ),
			'band_caption' => array( 'Подпись', 'text', 'Фото условное' ),
		),
		'Для кого' => array(
			'clients_title' => array( 'Заголовок раздела', 'text', 'Для кого' ),
			'clients_note'  => array( 'Подпись под разделом', 'text', 'Фото в разделе условные' ),
		),
		'Условия работы' => array(
			'terms_title' => array( 'Заголовок раздела', 'text', 'Условия работы' ),
		),
		'Контакты' => array(
			'contact_title' => array( 'Заголовок', 'text', 'Свяжитесь с нами' ),
			'contact_text'  => array( 'Текст', 'textarea', 'Напишите нам на почту или позвоните — подберём продукцию под ваш объект.' ),
			'email'         => array( 'Почта', 'email', 'unichimpro@gmail.com' ),
			'phone_1'       => array( 'Телефон 1', 'text', '+7 495 968-47-45', 'Показывается и в шапке сайта.' ),
			'phone_2'       => array( 'Телефон 2', 'text', '+7 495 968-47-43' ),
			'pickup'        => array( 'Самовывоз (в карточке контактов)', 'textarea', "Пос. Тучково, ул.{$nbsp}Партизан, д.{$nbsp}41, стр.{$nbsp}8. Понедельник — пятница, с{$nbsp}8:00 до{$nbsp}15:30" ),
			'address'       => array( 'Адрес производства (в подвале)', 'textarea', "143132, Московская обл., Рузский р-н, пос. Тучково, ул.{$nbsp}Партизан, д.{$nbsp}41, стр.{$nbsp}8" ),
		),
		'Подвал и SEO' => array(
			'footer_about'     => array( 'Текст под логотипом', 'textarea', 'Профессиональная химия для HoReCa, прачечных, химчисток и дома.' ),
			'company'          => array( 'Название компании', 'text', 'ООО «ЮниХим-Про»' ),
			'meta_description' => array( 'Описание для поисковиков', 'textarea', 'Завод-производитель профессиональной химии в Тучково, Московская область. Моющие средства «Новая Формула»: прямой опт, производство под вашим брендом, основы для бытовой химии.' ),
		),
	);
}

/** Плоский список полей: ключ => описание. */
function nf_option_list() {
	$list = array();
	foreach ( nf_option_fields() as $fields ) {
		$list += $fields;
	}
	return $list;
}

/** Значение настройки: сохранённое (даже пустое) или значение по умолчанию. */
function nf_opt( $key ) {
	$saved = get_option( 'nf_options' );
	if ( is_array( $saved ) && array_key_exists( $key, $saved ) ) {
		return $saved[ $key ];
	}
	$list = nf_option_list();
	return isset( $list[ $key ] ) ? $list[ $key ][2] : '';
}

/** Непустые строки текста. */
function nf_lines( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}

/** Значения через запятую с пробелом (или с новой строки). Дробные числа вроде «0,5 л» не разбиваются. */
function nf_list( $text ) {
	$items = preg_split( '/,\s+|\r\n|\r|\n/u', trim( (string) $text ) );
	return array_values( array_filter( array_map( 'trim', $items ), 'strlen' ) );
}

/**
 * Делит пункт на жирное начало и остальной текст.
 * $mode 'sentence' — жирное первое предложение (до точки), 'colon' — текст до двоеточия.
 *
 * @return array [ начало, остальное ]
 */
function nf_split_lead( $line, $mode = 'sentence' ) {
	if ( 'colon' === $mode ) {
		$pos = mb_strpos( $line, ': ' );
		return false === $pos ? array( '', $line ) : array( mb_substr( $line, 0, $pos + 1 ), mb_substr( $line, $pos + 2 ) );
	}
	$pos = mb_strpos( $line, '. ' );
	if ( false !== $pos ) {
		return array( mb_substr( $line, 0, $pos + 1 ), mb_substr( $line, $pos + 2 ) );
	}
	return '.' === mb_substr( $line, -1 ) ? array( $line, '' ) : array( '', $line );
}

/** Пункты списка с жирным началом (блок tag-list). */
function nf_tag_list( $text, $modifier = '' ) {
	$lines = nf_lines( $text );
	if ( ! $lines ) {
		return;
	}
	$class = 'tag-list' . ( $modifier ? ' tag-list--' . $modifier : '' );
	echo '<ul class="' . esc_attr( $class ) . '">' . "\n";
	foreach ( $lines as $line ) {
		list( $lead, $rest ) = nf_split_lead( $line );
		echo '<li class="tag-list__item">';
		if ( '' !== $lead ) {
			echo '<b class="tag-list__lead">' . esc_html( $lead ) . '</b>' . ( '' !== $rest ? ' ' : '' );
		}
		echo esc_html( $rest ) . "</li>\n";
	}
	echo "</ul>\n";
}

/** Ссылка tel: из номера в любом виде. */
function nf_tel( $phone ) {
	$digits = preg_replace( '/\D+/', '', (string) $phone );
	if ( 11 === strlen( $digits ) && '8' === $digits[0] ) {
		$digits = '7' . substr( $digits, 1 );
	}
	return 'tel:+' . $digits;
}

/** Непустые телефоны из настроек. */
function nf_phones() {
	return array_values( array_filter( array( trim( nf_opt( 'phone_1' ) ), trim( nf_opt( 'phone_2' ) ) ), 'strlen' ) );
}

/** Якорь записи: латинский ярлык или номер записи. */
function nf_anchor( $post ) {
	return preg_match( '/^[a-z0-9-]+$/', $post->post_name ) ? $post->post_name : (string) $post->ID;
}

/** Записи раздела по порядку из поля «Порядок». */
function nf_get_items( $post_type ) {
	return get_posts(
		array(
			'post_type'      => $post_type,
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
		)
	);
}

/** Поле записи. */
function nf_meta( $post_id, $key ) {
	return (string) get_post_meta( $post_id, '_nf_' . $key, true );
}

/**
 * Логотип: загруженный в «Внешний вид → Настроить → Свойства сайта» или текстовая заглушка.
 *
 * @param string $place large (этикетка на первом экране), footer или header.
 */
function nf_logo( $place ) {
	$logo_id = (int) get_theme_mod( 'custom_logo' );
	$name    = get_bloginfo( 'name' );

	if ( $logo_id ) {
		echo wp_get_attachment_image( $logo_id, 'full', false, array( 'class' => 'brand-logo brand-logo--' . $place, 'alt' => $name, 'loading' => false ) );
		return;
	}

	if ( 'header' === $place ) {
		echo '<b class="site-header__brand-name">' . esc_html( $name ) . '</b><span class="site-header__badge todo">логотип в разработке</span>';
		return;
	}

	$modifier = 'large' === $place ? 'logo-slot--large' : 'logo-slot--on-ink';
	$words    = preg_split( '/\s+/u', trim( $name ) );

	echo '<div class="logo-slot ' . esc_attr( $modifier ) . '" role="img" aria-label="' . esc_attr( $name . ' — логотип в разработке' ) . '">';
	echo '<span class="logo-slot__name" aria-hidden="true">';
	if ( 'large' === $place ) {
		$spans = array_map(
			function ( $word ) {
				return '<span class="logo-slot__word">' . esc_html( $word ) . '</span>';
			},
			$words
		);
		echo implode( ' ', $spans ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above.
	} else {
		echo esc_html( $name );
	}
	echo '</span>';
	echo '<span class="logo-slot__badge todo" aria-hidden="true">логотип в разработке</span>';
	echo '</div>';
}
