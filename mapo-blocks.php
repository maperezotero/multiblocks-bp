<?php
/**
 * Plugin Name:       Mapo Blocks
 * Plugin URI:        https://maperez.es/
 * Description:       Mapo blocks kit
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            maperezotero
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mapo-blocks
 * Domain Path:       mapo
 *
 * @package           mapo
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function mapo_blocks_block_init() {
	// Registers blocks one by one.
	// register_block_type( __DIR__ . '/build/test-block' );//.

	// Registers all blocks in build directory.
	$block_directories = glob( __DIR__ . '/build/*', GLOB_ONLYDIR );
	foreach ( $block_directories as $block ) {
		register_block_type( $block );
	}
}
add_action( 'init', 'mapo_blocks_block_init' );

add_filter(
	'block_categories_all',
	function ( $categories ) {
		array_unshift(
			$categories,
			array(
				'slug'  => 'mapo-blocks',
				'title' => 'Mapo Blocks',
				'icon'  => 'schedule',
			)
		);
		return $categories;
	},
	10,
	1
);
