<?php

/**
 * Get a Count of Linkbacks by Type
 *
 * @param string $type the comment type
 * @param int $post_id the id of the post
 *
 * @return the number of matching linkbacks
 */
function get_linkbacks_number( $type = null, $post_id = null ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$args = array(
		'post_id'	=> $post_id,
		'count'	 	=> true,
		'status'	=> 'approve',
	);

	if ( $type ) { // use type if set
		if ( 'mention' == $type ) {
 			$args['type__not_in'] = 'comment';
			$args['meta_query'] = array(
 				'relation' => 'OR',
				array( 'key' => 'semantic_linkbacks_type', 'value' => '' ),
				array( 'key' => 'semantic_linkbacks_type', 'compare' => 'NOT EXISTS' ),
				array( 'key' => 'semantic_linkbacks_type', 'value' => 'mention' ),
			);
		} elseif ( 'rsvp' == $type ) {
			$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'value' => 'rsvp', 'compare' => 'LIKE' ) );
		} else {
			$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'value' => $type ) );
		}
	} else { // check only if type exists
		$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'compare' => 'EXISTS' ) );
	}

	$comments = get_comments( $args );
	if ( $comments ) {
		return $comments;
	} else {
		return 0;
	}
}

/**
 * Returns comments of linkback type
 *
 * @param string $type the comment type
 * @param int $post_id the id of the post
 * @param string $order the order of the retrieved comments, ASC or DESC (default)
 *
 * @return the matching linkback "comments"
 */
function get_linkbacks( $type = null, $post_id = null, $order = 'DESC' ) {
	if ( null === $post_id ) {
		$post_id = get_the_ID();
	}
	$args = array(
		'post_id'	=> $post_id,
		'status'	=> 'approve',
		'order'		=> $order,
	);

	if ( $type ) { // use type if set
		if ( 'mention' == $type ) {
 			$args['type__not_in'] = 'comment';
			$args['meta_query'] = array(
 				'relation' => 'OR',
				array( 'key' => 'semantic_linkbacks_type', 'value' => '' ),
				array( 'key' => 'semantic_linkbacks_type', 'compare' => 'NOT EXISTS' ),
				array( 'key' => 'semantic_linkbacks_type', 'value' => 'mention' ),
			);
		} elseif ( 'rsvp' == $type ) {
			$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'value' => 'rsvp', 'compare' => 'LIKE' ) );
		} else {
			$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'value' => $type ) );
		}
	} else { // check only if type exists
		$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'compare' => 'EXISTS' ) );
	}

	return get_comments( $args );
}


function has_linkbacks( $type = null, $post_ID = null ) {
	if ( get_linkbacks( $type, $post_ID ) ) {
		return true;
	}
	return false;
}

/**
 * Return marked up linkbacks
 * Based on wp_list_comments()
 */
function list_linkbacks( $args, $comments ) {
	$defaults = array(
		'avatar_size' => 64,
		'style' => 'ul', // What HTML type to wrap it in. Accepts 'ul', 'ol'.
		'style-class' => 'mention-list', // What class to assign to the wrapper
		'li-class' => 'single-mention', // What class to assign to the list elements
		'echo' => true // Whether to echo the output or return
	);

	$r = wp_parse_args( $args, $defaults );
	/**
	 * Filters the arguments used in retrieving the linkbacks list
	 *
	 *
	 * @param array $r An array of arguments for displaying linkbacks
	 */
	$r = apply_filters( 'list_linkbacks_args', $r );
	if ( ! is_array( $comments ) ) {
		return;
	}
	if ( is_string( $r['li-class'] ) ) {
		$classes = explode( ' ', $r['li-class'] );
	}
	else {
		$classes = $r['li-class'];
	}
	$classes[] = 'h-cite';
	$classes = join( ' ', $classes );
	$return = sprintf( '<%1$s class="%2$s">', $r['style'], $r['style-class'] );
	foreach ( $comments as $comment ) {
		$return .= sprintf( '<li class="%1$s" id="%2$s">
			<data class="p-name p-summary" value="%7$s" />
			<data class="u-url" value="%3$s" />
			<a class="p-author h-card" href="%5$s">
				<img class="u-photo" src="%4$s" alt="%6$s" />
			</a>
			</li>',
			esc_attr( $classes ),
			esc_attr( 'comment-' . $comment->ID ),
			esc_url_raw( Linkbacks_Handler::get_canonical_url( $comment ) ),
			esc_url_raw( get_avatar( $comment, $r['avatar_size'] ) ),
			esc_url_raw( get_comment_author_url( $comment ) ),
			esc_attr( get_comment_author( $comment ) ),
			esc_attr( Linkbacks_Handler::comment_text_excerpt( '', $comment ) ) );
	}
	$return .= sprintf( '</%1$s>', $r['style'] );
	if ( $r['echo'] ) {
		echo $return;
	}
	return $return;
}
