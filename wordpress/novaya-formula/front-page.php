<?php
/**
 * Главная — весь лендинг. Разделы собраны из template-parts.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main>
	<?php
	get_template_part( 'template-parts/hero' );
	get_template_part( 'template-parts/products' );
	get_template_part( 'template-parts/photo-band' );
	get_template_part( 'template-parts/audience' );
	get_template_part( 'template-parts/terms' );
	get_template_part( 'template-parts/contact' );
	?>
</main>

<?php
get_footer();
