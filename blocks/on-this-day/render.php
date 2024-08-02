<?php
/**
 * @package IndieBlocks\Extra
 */

if ( isset( $block->context['postId'] ) ) {
	$post_id = $block->context['postId']; // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
} elseif ( in_the_loop() ) {
	$post_id = get_the_ID(); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
}

if ( empty( $post_id ) ) {
	return;
}

$posts = \IndieBlocks\Extra\get_on_this_day_posts( $post_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
if ( empty( $posts ) ) {
	// Nothing to show. Don't output *anything*.
	return;
}

echo $block->render( array( 'dynamic' => false ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
