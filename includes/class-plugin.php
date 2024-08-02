<?php
/**
 * @package IndieBlocks\Extra
 */

namespace IndieBlocks\Extra;

class Plugin {
	/**
	 * Plugin version.
	 */
	const PLUGIN_VERSION = '0.1.0';

	/**
	 * This class's single instance.
	 *
	 * @var Plugin $instance Plugin instance.
	 */
	private static $instance;

	/**
	 * Returns the single instance of this class.
	 *
	 * @return Plugin This class's single instance.
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Hooks and such.
	 */
	public function register() {
		// Enable i18n.
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		// Register blocks.
		add_action( 'init', array( Blocks::class, 'register_blocks' ) );
	}

	/**
	 * Enables i18n.
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'indieblocks-extra', false, basename( dirname( __DIR__ ) ) . '/languages' );
	}
}
