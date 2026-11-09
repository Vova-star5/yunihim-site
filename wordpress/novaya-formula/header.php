<?php
/**
 * Шапка: <head>, ссылка «к контактам», навигация, мобильное меню.
 */

defined( 'ABSPATH' ) || exit;

$nf_phones = nf_phones();
?><!doctype html>
<html <?php language_attributes(); ?> class="page">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#request">Перейти к контактам</a>

<header class="site-header" id="top">
	<a class="site-header__brand" href="#top" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) . ', на главную' ); ?>">
		<?php nf_logo( 'header' ); ?>
	</a>
	<nav class="site-nav" id="site-nav" aria-label="Разделы">
		<div class="site-nav__panel satin">
			<div class="site-nav__fold fold" aria-hidden="true"></div>
			<ul class="site-nav__list">
				<li class="site-nav__item"><a class="site-nav__link" href="#dileram">Дилерам</a></li>
				<li class="site-nav__item"><a class="site-nav__link" href="#products">Продукция</a></li>
				<li class="site-nav__item"><a class="site-nav__link" href="#clients">Для кого</a></li>
				<li class="site-nav__item site-nav__item--extra"><a class="site-nav__link" href="#usloviya">Условия работы</a></li>
				<li class="site-nav__item"><a class="site-nav__link" href="#contacts">Контакты</a></li>
			</ul>
			<div class="site-nav__footer">
				<span class="site-nav__label">Отдел продаж</span>
				<?php foreach ( $nf_phones as $nf_phone ) : ?>
					<a class="site-nav__phone" href="<?php echo esc_attr( nf_tel( $nf_phone ) ); ?>"><?php echo esc_html( $nf_phone ); ?></a>
				<?php endforeach; ?>
				<a class="site-nav__cta btn" href="#request">Связаться с нами</a>
			</div>
		</div>
	</nav>
	<div class="site-header__backdrop" aria-hidden="true"></div>
	<div class="site-header__actions">
		<?php if ( $nf_phones ) : ?>
			<a class="site-header__phone phone" href="<?php echo esc_attr( nf_tel( $nf_phones[0] ) ); ?>"><?php echo esc_html( $nf_phones[0] ); ?></a>
		<?php endif; ?>
		<button class="burger" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Меню">
			<span class="burger__lines" aria-hidden="true"><span class="burger__line"></span><span class="burger__line"></span><span class="burger__line"></span></span>
		</button>
	</div>
</header>
