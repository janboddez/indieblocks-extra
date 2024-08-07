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

$count  = count( $posts );
$output = "<ul style='list-style: none;'>\n";

foreach ( $posts as $i => $post ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
	$post_year = get_the_date( 'Y', $post );

	if ( 0 === $i ) {
		$current_year = $post_year;

		/* translators: %d: year */
		$output .= '<li><strong>' . sprintf( esc_html__( '&hellip; in %d', 'indieblocks' ), (int) $post_year ) . "</strong>\n";
		$output .= "<ul style='list-style: none;'>\n";
	} elseif ( $post_year !== $current_year ) {
		$current_year = $post_year;

		$output .= "</ul>\n</li>\n";
		/* translators: %d: year */
		$output .= '<li><strong>' . sprintf( esc_html__( '&hellip; in %d', 'indieblocks' ), (int) $post_year ) . "</strong>\n";
		$output .= "<ul style='list-style: none;'>\n";
	}

	$output .= "<li>\n";
	$output .= '<p class="entry-excerpt">' . get_the_excerpt( $post ) . "</p>\n";
	$output .= '<span class="has-small-font-size"><a href="' . esc_url( get_permalink( $post ) ) . '">' . ( 'post' === get_post_type( $post ) ? get_the_title( $post ) : wp_date( get_option( 'date_format' ), get_post_timestamp( $post ) ) ) . '</a></span>';
	$output .= "</li>\n";

	if ( $i === $count - 1 ) {
		$output .= "\n</ul>\n</li>\n";
	}
}

$output .= "</ul>\n";

$wrapper_attributes = get_block_wrapper_attributes();
?>

<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</div>
