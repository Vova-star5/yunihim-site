<?php
/**
 * Широкое фото после продукции.
 */

defined( 'ABSPATH' ) || exit;

$nf_image   = (int) nf_opt( 'band_image' );
$nf_alt     = nf_opt( 'band_alt' );
$nf_caption = nf_opt( 'band_caption' );
$nf_attrs   = array(
	'class'    => 'photo-band__image reveal reveal--zoom',
	'alt'      => $nf_alt,
	'loading'  => 'lazy',
	'decoding' => 'async',
);
?>
<figure class="photo-band">
	<?php if ( $nf_image && wp_attachment_is_image( $nf_image ) ) : ?>
		<?php echo wp_get_attachment_image( $nf_image, 'full', false, $nf_attrs ); ?>
	<?php else : ?>
		<img class="photo-band__image reveal reveal--zoom" src="<?php echo esc_url( NF_URI . '/assets/images/lab-production.webp' ); ?>" alt="<?php echo esc_attr( $nf_alt ); ?>" width="1920" height="1080" loading="lazy" decoding="async">
	<?php endif; ?>
	<?php if ( $nf_caption ) : ?>
		<figcaption class="photo-band__caption container reveal"><?php echo esc_html( $nf_caption ); ?></figcaption>
	<?php endif; ?>
</figure>
