<?php

if ( has_linkbacks( 'like' ) ) { 
	echo '<div class="likes">';
	echo '<h3>' . __( 'Likes', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-like' ),
		),
	get_linkbacks( 'like' ) );
	echo '</div>';
}

if ( has_linkbacks( 'favorite' ) ) {
	echo '<div class="favorite">';
	echo '<h3>' . __( 'Favorites', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-favorite' )
	), 
	get_linkbacks( 'favorite' ) );
	echo '</div>';
}

if ( has_linkbacks( 'bookmark' ) ) {
	echo '<div class="bookmarks">';
	echo '<h3>' . __( 'Bookmarks', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-bookmark' )
	), 
	get_linkbacks( 'bookmark' ) );
	echo '</div>';
}

if ( has_linkbacks( 'repost' ) ) {
	echo '<div class="reposts">';
	echo '<h3>' . __( 'Reposts', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-repost' )
	), 
	get_linkbacks( 'repost' ) );
	echo '</div>';
}

if ( has_linkbacks( 'tag' ) ) {
	echo '<div class="tags">';
	echo '<h3>' . __( 'Tags', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-tag' )
	), 
	get_linkbacks( 'tags' ) );
	echo '</div>';
}

if ( has_linkbacks( 'rsvp:yes' ) || has_linkbacks( 'rsvp:no' ) || has_linkbacks( 'rsvp:maybe' ) || has_linkbacks( 'rsvp:invited' ) || has_linkbacks( 'rsvp:tracking' ) ) {
	echo '<div class="rsvps">';
	echo '<h3>' . __( 'RSVPs', 'semantic-linkbacks' ) . '</h3>';
	if ( has_linkbacks( 'rsvp:yes' ) ) {
		echo '<h4>' . __( 'Yes', 'semantic-linkbacks' ) . '</h4>';
		list_linkbacks( array(
			'li-class' => array( 'single-mention', 'p-rsvp' )
		), 
		get_linkbacks( 'rsvp:yes' ) );
		echo '</div>';
	}
	if ( has_linkbacks( 'rsvp:no' ) ) {
		echo '<h4>' . __( 'No', 'semantic-linkbacks' ) . '</h4>';
		list_linkbacks( array(
			'li-class' => array( 'single-mention', 'p-rsvp' )
		), 
		get_linkbacks( 'rsvp:no' ) );
		echo '</div>';
	}
	if ( has_linkbacks( 'rsvp:maybe' ) ) {
		echo '<h4>' . __( 'Maybe', 'semantic-linkbacks' ) . '</h4>';
		list_linkbacks( array(
			'li-class' => array( 'single-mention', 'p-rsvp' )
		), 
		get_linkbacks( 'rsvp:maybe' ) );
		echo '</div>';
	}
	if ( has_linkbacks( 'rsvp:invited' ) ) {
		echo '<h4>' . __( 'Invited', 'semantic-linkbacks' ) . '</h4>';
		list_linkbacks( array(
			'li-class' => array( 'single-mention', 'p-rsvp' )
		), 
		get_linkbacks( 'rsvp:invited' ) );
		echo '</div>';
	}
	if ( has_linkbacks( 'rsvp:tracking' ) ) {
		echo '<h4>' . __( 'Tracking', 'semantic-linkbacks' ) . '</h4>';
		list_linkbacks( array(
			'li-class' => array( 'single-mention', 'p-rsvp' )
		), 
		get_linkbacks( 'rsvp:tracking' ) );
		echo '</div>';
	}

	echo '</div>';
}


if ( has_linkbacks( 'mention' ) ) {
	echo '<div class="mentions">';
	echo '<h3>' . __( 'Mentions', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-comment' )
	), 
	get_linkbacks( 'mention' ) );
	echo '</div>';
}
