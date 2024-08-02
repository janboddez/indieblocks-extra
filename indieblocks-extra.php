<?php
/**
 * Plugin Name:       IndieBlocks Extra
 * Description:       Additional "IndieBlocks" blocks.
 * Plugin URI:        https://indieblocks.xyz/
 * Author:            Jan Boddez
 * Author URI:        https://jan.boddez.net/
 * License:           GNU General Public License v3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain:       indieblocks-extra
 * Version:           0.1.0
 * Requires at least: 6.2
 * Requires PHP:      7.2
 * GitHub Plugin URI: https://github.com/janboddez/indieblocks-extra
 * Primary Branch:    main
 *
 * @author  Jan Boddez <jan@janboddez.be>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 * @package IndieBlocks\Extra
 */

namespace IndieBlocks\Extra;

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require __DIR__ . '/includes/class-blocks.php';
require __DIR__ . '/includes/class-plugin.php';
require __DIR__ . '/includes/functions.php';

$indieblocks_extra = Plugin::get_instance();
$indieblocks_extra->register();
