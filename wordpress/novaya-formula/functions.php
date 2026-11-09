<?php
/**
 * Тема «Новая Формула».
 *
 * inc/helpers.php     — настройки по умолчанию и вспомогательные функции вывода
 * inc/setup.php       — поддержка возможностей темы, чистка <head>
 * inc/enqueue.php     — подключение стилей и скриптов
 * inc/post-types.php  — «Продукция», «Для кого», «Условия работы»
 * inc/meta-boxes.php  — поля этих записей
 * inc/options.php     — страница «Настройки сайта»
 * inc/demo-content.php — заполнение сайта текущим содержимым при активации темы
 */

defined( 'ABSPATH' ) || exit;

define( 'NF_VERSION', '1.0.0' );
define( 'NF_DIR', get_template_directory() );
define( 'NF_URI', get_template_directory_uri() );

require NF_DIR . '/inc/helpers.php';
require NF_DIR . '/inc/setup.php';
require NF_DIR . '/inc/enqueue.php';
require NF_DIR . '/inc/post-types.php';
require NF_DIR . '/inc/meta-boxes.php';
require NF_DIR . '/inc/options.php';
require NF_DIR . '/inc/demo-content.php';
