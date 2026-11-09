<?php
/**
 * Запасной шаблон. Сайт — одна страница (front-page.php), поэтому любые другие адреса ведут на главную.
 */

defined( 'ABSPATH' ) || exit;

wp_safe_redirect( home_url( '/' ), 301 );
exit;
