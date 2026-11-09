<?php
/**
 * Продукция: этикетка на каждый товар из раздела «Продукция» и блок «Скоро в линейке».
 */

defined( 'ABSPATH' ) || exit;

$nf_products = nf_get_items( 'nf_product' );
?>
<section class="section products" id="products" aria-labelledby="products-title">
	<div class="container">
		<div class="section__head reveal">
			<h2 class="section__title" id="products-title"><?php echo esc_html( nf_opt( 'products_title' ) ); ?></h2>
		</div>

		<div class="products__list">
			<?php foreach ( $nf_products as $nf_product ) : ?>
				<?php
				$nf_id     = $nf_product->ID;
				$nf_anchor = 'product-' . nf_anchor( $nf_product );
				$nf_photo  = get_post_thumbnail_id( $nf_id );
				$nf_scents = nf_list( nf_meta( $nf_id, 'scents' ) );
				$nf_packs  = nf_list( nf_meta( $nf_id, 'packs' ) );
				$nf_label  = nf_meta( $nf_id, 'label' );
				?>
				<article class="product<?php echo $nf_photo ? ' product--photo' : ''; ?> reveal reveal--sway" id="<?php echo esc_attr( $nf_anchor ); ?>" aria-labelledby="<?php echo esc_attr( $nf_anchor . '-title' ); ?>">
					<div class="product__inner satin">
						<?php if ( $nf_photo ) : ?>
							<figure class="product__media product__media--photo">
								<?php
								echo wp_get_attachment_image(
									$nf_photo,
									'full',
									false,
									array(
										'class'    => 'product__image' . ( nf_meta( $nf_id, 'photo_top' ) ? ' product__image--top' : '' ),
										'loading'  => 'lazy',
										'decoding' => 'async',
									)
								);
								?>
							</figure>
						<?php else : ?>
							<div class="product__media">
								<p class="product__placeholder">Этикетка в разработке</p>
							</div>
						<?php endif; ?>

						<div class="product__main">
							<h3 class="product__name" id="<?php echo esc_attr( $nf_anchor . '-title' ); ?>"><?php echo esc_html( get_the_title( $nf_product ) ); ?></h3>
							<?php if ( nf_meta( $nf_id, 'intro' ) ) : ?>
								<p class="product__intro"><?php echo esc_html( nf_meta( $nf_id, 'intro' ) ); ?></p>
							<?php endif; ?>
							<?php if ( nf_meta( $nf_id, 'sub' ) ) : ?>
								<p class="product__sub"><?php echo esc_html( nf_meta( $nf_id, 'sub' ) ); ?></p>
							<?php endif; ?>
							<?php nf_tag_list( nf_meta( $nf_id, 'bullets' ) ); ?>
							<?php if ( nf_meta( $nf_id, 'close' ) ) : ?>
								<p class="product__close"><?php echo esc_html( nf_meta( $nf_id, 'close' ) ); ?></p>
							<?php endif; ?>
						</div>

						<?php if ( $nf_scents || $nf_packs || $nf_label ) : ?>
							<dl class="product__aside specs">
								<?php if ( $nf_scents ) : ?>
									<div class="specs__item">
										<dt class="specs__term">Отдушки</dt>
										<dd class="specs__value specs__value--chips"><?php foreach ( $nf_scents as $nf_chip ) { echo '<span class="chip">' . esc_html( $nf_chip ) . '</span>'; } ?></dd>
									</div>
								<?php endif; ?>
								<?php if ( $nf_packs ) : ?>
									<div class="specs__item">
										<dt class="specs__term">Фасовка</dt>
										<dd class="specs__value specs__value--chips"><?php foreach ( $nf_packs as $nf_chip ) { echo '<span class="chip chip--pack">' . esc_html( $nf_chip ) . '</span>'; } ?></dd>
									</div>
								<?php endif; ?>
								<?php if ( $nf_label ) : ?>
									<div class="specs__item">
										<dt class="specs__term">Этикетка</dt>
										<dd class="specs__value"><?php echo esc_html( $nf_label ); ?></dd>
									</div>
								<?php endif; ?>
							</dl>
						<?php endif; ?>
					</div>
				</article>
			<?php endforeach; ?>

			<?php if ( nf_opt( 'soon_title' ) ) : ?>
				<aside class="product product--soon reveal reveal--sway" aria-label="<?php echo esc_attr( nf_opt( 'soon_title' ) ); ?>">
					<div class="product__inner">
						<p class="product__soon-text"><strong class="product__soon-title"><?php echo esc_html( nf_opt( 'soon_title' ) ); ?></strong><?php echo esc_html( nf_opt( 'soon_text' ) ); ?></p>
						<?php if ( nf_opt( 'soon_link' ) ) : ?>
							<a class="product__soon-link" href="#request"><?php echo esc_html( nf_opt( 'soon_link' ) ); ?></a>
						<?php endif; ?>
					</div>
				</aside>
			<?php endif; ?>
		</div>
	</div>
</section>
