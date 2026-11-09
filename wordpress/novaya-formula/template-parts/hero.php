<?php
/**
 * Первый экран: заголовок и предложение, этикетка с логотипом и блоком «Дилерам», быстрые ссылки на продукцию.
 */

defined( 'ABSPATH' ) || exit;

$nf_sprite   = NF_URI . '/assets/icons/sprite.svg';
$nf_products = nf_get_items( 'nf_product' );
$nf_offer    = nf_lines( nf_opt( 'offer_items' ) );
?>
<section class="hero" aria-labelledby="hero-title">
	<svg class="hero__pattern" aria-hidden="true" focusable="false">
		<defs>
			<pattern id="care-pattern" width="520" height="440" patternUnits="userSpaceOnUse">
				<use href="<?php echo esc_url( $nf_sprite . '#s-t40' ); ?>" x="24" y="28" width="168" height="168"/>
				<use href="<?php echo esc_url( $nf_sprite . '#s-tumble' ); ?>" x="300" y="44" width="150" height="150"/>
				<use href="<?php echo esc_url( $nf_sprite . '#s-iron2' ); ?>" x="150" y="250" width="168" height="168"/>
				<use href="<?php echo esc_url( $nf_sprite . '#s-w' ); ?>" x="390" y="268" width="120" height="120"/>
			</pattern>
			<filter id="care-pattern-ink" x="0" y="0" width="100%" height="100%"><feMorphology operator="dilate" radius="1.2"/></filter>
		</defs>
		<rect width="100%" height="100%" fill="url(#care-pattern)" filter="url(#care-pattern-ink)"/>
	</svg>

	<div class="hero__intro">
		<h1 class="hero__title" id="hero-title"><?php echo esc_html( nf_opt( 'hero_title' ) ); ?></h1>
		<?php if ( nf_lines( nf_opt( 'hero_text' ) ) ) : ?>
			<div class="hero__lead">
				<?php foreach ( nf_lines( nf_opt( 'hero_text' ) ) as $nf_line ) : ?>
					<p class="hero__text"><?php echo esc_html( $nf_line ); ?></p>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
		<?php if ( $nf_offer ) : ?>
			<div class="hero__offer">
				<?php if ( nf_opt( 'offer_title' ) ) : ?>
					<p class="hero__offer-title"><?php echo esc_html( nf_opt( 'offer_title' ) ); ?></p>
				<?php endif; ?>
				<ul class="offer-list">
					<?php
					foreach ( $nf_offer as $nf_line ) {
						list( $nf_lead, $nf_rest ) = nf_split_lead( $nf_line, 'colon' );
						echo '<li class="offer-list__item">' . ( '' !== $nf_lead ? '<b>' . esc_html( $nf_lead ) . '</b> ' : '' ) . esc_html( $nf_rest ) . "</li>\n";
					}
					?>
				</ul>
			</div>
		<?php endif; ?>
		<?php if ( nf_opt( 'hero_close' ) ) : ?>
			<p class="hero__close"><?php echo esc_html( nf_opt( 'hero_close' ) ); ?></p>
		<?php endif; ?>
	</div>

	<div class="hero__label">
		<div class="care-label satin selvage">
			<div class="care-label__fold fold" aria-hidden="true"></div>
			<div class="care-label__body">
				<?php nf_logo( 'large' ); ?>
				<section class="dealer" id="dileram" aria-labelledby="dealer-title">
					<h2 class="dealer__title" id="dealer-title"><?php echo esc_html( nf_opt( 'dealer_title' ) ); ?></h2>
					<?php if ( nf_opt( 'dealer_lead' ) ) : ?>
						<p class="dealer__lead"><?php echo esc_html( nf_opt( 'dealer_lead' ) ); ?></p>
					<?php endif; ?>
					<?php foreach ( nf_lines( nf_opt( 'dealer_text' ) ) as $nf_line ) : ?>
						<p class="dealer__text"><?php echo esc_html( $nf_line ); ?></p>
					<?php endforeach; ?>
					<?php if ( nf_opt( 'dealer_button' ) ) : ?>
						<a class="dealer__btn btn" href="#request"><?php echo esc_html( nf_opt( 'dealer_button' ) ); ?></a>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</div>

	<?php if ( $nf_products ) : ?>
		<nav class="hero__minis" aria-label="Продукция">
			<ul class="quick-links">
				<?php foreach ( $nf_products as $nf_product ) : ?>
					<?php $nf_short = nf_meta( $nf_product->ID, 'short_name' ); ?>
					<li class="quick-links__item"><a class="quick-links__link satin" href="#product-<?php echo esc_attr( nf_anchor( $nf_product ) ); ?>"><span class="quick-links__name"><?php echo esc_html( $nf_short ? $nf_short : get_the_title( $nf_product ) ); ?></span></a></li>
				<?php endforeach; ?>
			</ul>
		</nav>
	<?php endif; ?>
</section>
