<?php
/**
 * Условия работы: строки из раздела «Условия работы».
 */

defined( 'ABSPATH' ) || exit;

$nf_items = nf_get_items( 'nf_term' );
if ( ! $nf_items ) {
	return;
}
?>
<section class="section" id="usloviya" aria-labelledby="usloviya-title">
	<div class="container">
		<div class="section__head reveal">
			<h2 class="section__title" id="usloviya-title"><?php echo esc_html( nf_opt( 'terms_title' ) ); ?></h2>
		</div>
		<div class="terms reveal reveal--inner">
			<dl class="terms__list">
				<?php foreach ( $nf_items as $nf_item ) : ?>
					<div class="terms__item"><dt class="terms__name"><?php echo esc_html( get_the_title( $nf_item ) ); ?></dt><dd class="terms__value"><?php echo esc_html( nf_meta( $nf_item->ID, 'text' ) ); ?></dd></div>
				<?php endforeach; ?>
			</dl>
		</div>
	</div>
</section>
