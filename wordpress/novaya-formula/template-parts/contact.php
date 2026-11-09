<?php
/**
 * Свяжитесь с нами: текст и карточка с почтой, телефонами и самовывозом.
 */

defined( 'ABSPATH' ) || exit;

$nf_email  = nf_opt( 'email' );
$nf_phones = nf_phones();
$nf_pickup = nf_opt( 'pickup' );
?>
<section class="section section--tint" id="request" aria-labelledby="request-title">
	<div class="container contact">
		<div class="contact__intro reveal">
			<h2 class="section__title" id="request-title"><?php echo esc_html( nf_opt( 'contact_title' ) ); ?></h2>
			<?php if ( nf_opt( 'contact_text' ) ) : ?>
				<p class="contact__text"><?php echo esc_html( nf_opt( 'contact_text' ) ); ?></p>
			<?php endif; ?>
		</div>

		<div class="contact-card reveal reveal--drop">
			<div class="contact-card__inner satin selvage">
				<div class="contact-card__fold fold" aria-hidden="true"></div>
				<address>
					<dl class="contact-card__list">
						<?php if ( $nf_email ) : ?>
							<div class="contact-card__item">
								<dt class="contact-card__term">Почта</dt>
								<dd class="contact-card__value"><a class="contact-card__mail" href="<?php echo esc_attr( 'mailto:' . $nf_email ); ?>"><?php echo esc_html( $nf_email ); ?></a></dd>
							</div>
						<?php endif; ?>
						<?php if ( $nf_phones ) : ?>
							<div class="contact-card__item">
								<dt class="contact-card__term">Телефоны</dt>
								<dd class="contact-card__value">
									<?php
									$nf_links = array();
									foreach ( $nf_phones as $nf_phone ) {
										$nf_links[] = '<a class="contact-card__phone phone" href="' . esc_attr( nf_tel( $nf_phone ) ) . '">' . esc_html( $nf_phone ) . '</a>';
									}
									echo implode( '<br>', $nf_links ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped above.
									?>
								</dd>
							</div>
						<?php endif; ?>
						<?php if ( $nf_pickup ) : ?>
							<div class="contact-card__item">
								<dt class="contact-card__term">Самовывоз</dt>
								<dd class="contact-card__value"><?php echo esc_html( $nf_pickup ); ?></dd>
							</div>
						<?php endif; ?>
					</dl>
				</address>
			</div>
		</div>
	</div>
</section>
