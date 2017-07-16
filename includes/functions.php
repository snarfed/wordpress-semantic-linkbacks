<?php

/**
 * Get a Count of Linkbacks by Type
 *
 * @param string $type the comment type
 * @param int $post_id the id of the post
 *
 * @return the number of matching linkbacks
 */
function get_linkbacks_number( $type = null, $post_id = 0 ) {
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
function get_linkbacks( $type = null, $post_id = 0, $order = 'DESC' ) {
	$args = array(
		'post_id'	=> $post_id,
		'status'	=> 'approve',
		'order'		=> $order,
	);

	if ( $type ) { // use type if set
		$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'value' => $type ) );
	} else { // check only if type exists
		$args['meta_query'] = array( array( 'key' => 'semantic_linkbacks_type', 'compare' => 'EXISTS' ) );
	}

	return get_comments( $args );
}


function has_linkbacks( $type = null, $post_ID = 0 ) {
	if ( get_linkbacks( $type, $post_ID ) ) {
		return true;
	}
	return false;
}
