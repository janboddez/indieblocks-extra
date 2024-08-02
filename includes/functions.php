<?php
/**
 * @package IndieBlocks\Extra
 */

namespace IndieBlocks\Extra;

/**
 * Queries "On This Day" posts.
 *
 * @param  int $post_id Post ID.
 * @return \WP_Post[]   Post objects.
 */
function get_on_this_day_posts( $post_id ) {
	$transient = 'indieblocks:onthisday:' . get_the_date( 'Y-m-d', $post_id );
	$posts     = get_transient( $transient ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

	if ( is_array( $posts ) ) {
		return $posts;
	}

	// Transient not found. Run the query, and store the outcome.
	$args = array(
		'day'                 => get_the_date( 'd', $post_id ),
		'monthnum'            => get_the_date( 'm', $post_id ),
		'numberposts'         => (int) apply_filters( 'indieblocks_on_this_day_num_posts', 4 ),
		'ignore_sticky_posts' => true,
		'date_query'          => array(
			array(
				'year'    => get_the_date( 'Y', $post_id ), // Exclude posts published on the exact same day.
				'compare' => '!=',
			),
		),
		'orderby'             => 'date',
		'order'               => 'DESC',
		'post_type'           => (array) apply_filters( 'indieblocks_on_this_day_post_types', array( 'post', 'indieblocks_note' ) ),
	);

	$posts = get_posts( $args ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

	$posts = is_array( $posts )
		? $posts
		: array();

	// Cache for (up to) one month.
	/** @todo: Prevent this from totally breaking if in the future the post date is changed. */
	set_transient( $transient, $posts, MONTH_IN_SECONDS );

	return $posts;
}
