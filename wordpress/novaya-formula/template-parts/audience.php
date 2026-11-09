<?php
/**
 * Для кого: сегменты из раздела «Для кого».
 */

defined( 'ABSPATH' ) || exit;

$nf_items = nf_get_items( 'nf_audience' );
if ( ! $nf_items ) {
	return;
}
?>
<section class="section section--satin" id="clients" aria-labelledby="clients-title">
	<div class="container">
		<div class="section__head reveal">
			<h2 class="section__title" id="clients-title"><?php echo esc_html( nf_opt( 'clients_title' ) ); ?></h2>
		</div>
		<ul class="audience">
			<?php foreach ( $nf_items as $nf_item ) : ?>
				<li class="audience__item reveal">
					<div class="audience__head">
						<?php
						if ( has_post_thumbnail( $nf_item ) ) {
							echo wp_get_attachment_image(
								get_post_thumbnail_id( $nf_item ),
								'medium_large',
								false,
								array(
									'class'   => 'audience__photo',
									'alt'     => '',
									'loading' => 'lazy',
								)
							);
						}
						?>
						<h3 class="audience__title"><?php echo esc_html( get_the_title( $nf_item ) ); ?></h3>
					</div>
					<div class="audience__body">
						<?php if ( nf_meta( $nf_item->ID, 'intro' ) ) : ?>
							<p class="audience__text"><?php echo esc_html( nf_meta( $nf_item->ID, 'intro' ) ); ?></p>
						<?php endif; ?>
						<?php if ( nf_meta( $nf_item->ID, 'sub' ) ) : ?>
							<p class="audience__sub"><?php echo esc_html( nf_meta( $nf_item->ID, 'sub' ) ); ?></p>
						<?php endif; ?>
						<?php nf_tag_list( nf_meta( $nf_item->ID, 'bullets' ), 'columns' ); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php if ( nf_opt( 'clients_note' ) ) : ?>
			<p class="audience__note reveal"><?php echo esc_html( nf_opt( 'clients_note' ) ); ?></p>
		<?php endif; ?>
	</div>
</section>
