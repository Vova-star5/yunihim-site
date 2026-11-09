<?php
/**
 * Подвал: логотип, телефоны, почта, адрес производства.
 */

defined( 'ABSPATH' ) || exit;

$nf_email   = nf_opt( 'email' );
$nf_address = trim( nf_opt( 'address' ) );
?>
<footer class="site-footer reveal reveal--inner" id="contacts">
	<div class="container">
		<div class="site-footer__grid">
			<div class="site-footer__brand">
				<?php nf_logo( 'footer' ); ?>
				<?php if ( nf_opt( 'footer_about' ) ) : ?>
					<p class="site-footer__about"><?php echo esc_html( nf_opt( 'footer_about' ) ); ?></p>
				<?php endif; ?>
			</div>
			<?php if ( nf_phones() ) : ?>
				<div class="site-footer__col">
					<h2 class="site-footer__title">Телефоны</h2>
					<ul class="site-footer__list">
						<?php foreach ( nf_phones() as $nf_phone ) : ?>
							<li class="site-footer__item"><a class="site-footer__phone phone" href="<?php echo esc_attr( nf_tel( $nf_phone ) ); ?>"><?php echo esc_html( $nf_phone ); ?></a></li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php if ( $nf_email ) : ?>
				<div class="site-footer__col">
					<h2 class="site-footer__title">Почта</h2>
					<p class="site-footer__text"><a class="site-footer__link" href="<?php echo esc_attr( 'mailto:' . $nf_email ); ?>"><?php echo esc_html( $nf_email ); ?></a></p>
				</div>
			<?php endif; ?>
			<?php if ( $nf_address ) : ?>
				<div class="site-footer__col">
					<h2 class="site-footer__title">Производство</h2>
					<address class="site-footer__text"><?php echo preg_replace( '/^(\d+)/', '<span class="site-footer__num">$1</span>', esc_html( $nf_address ) ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped before wrapping the index. ?></address>
				</div>
			<?php endif; ?>
		</div>
		<div class="site-footer__bottom">
			<small class="site-footer__copy">© <span class="site-footer__num"><?php echo esc_html( wp_date( 'Y' ) ); ?></span> <?php echo esc_html( nf_opt( 'company' ) ); ?></small>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
