<?php
/**
 * @package IndieBlocks\Extra
 */

namespace IndieBlocks\Extra;

class Blocks {
	/**
	 * This plugin's blocks.
	 */
	const BLOCKS = array(
		'on-this-day',
		'on-this-day-content',
	);

	/**
	 * Registers the different blocks.
	 */
	public static function register_blocks() {
		foreach ( self::BLOCKS as $block ) {
			register_block_type( dirname( __DIR__ ) . "/blocks/$block" );

			wp_set_script_translations(
				generate_block_asset_handle( "indieblocks/$block", 'editorScript' ),
				'indieblocks-extra',
				dirname( __DIR__ ) . '/languages'
			);
		}
	}
}
