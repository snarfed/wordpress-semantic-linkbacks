<?php 

if ( has_linkbacks( 'like' ) ) {
	echo '<div class="likes">';
	echo '<h3>' . __( 'Likes', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-like' )
	), 
	get_linkbacks( 'like' ) ); ?>
	echo '</div>';
}

if ( has_linkbacks( 'favorite' ) ) {
	echo '<div class="favorite">';
	echo '<h3>' . __( 'Favorites', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-favorite' )
	), 
	get_linkbacks( 'favorite' ) ); ?>
	echo '</div>';
}

if ( has_linkbacks( 'bookmark' ) ) {
	echo '<div class="bookmarks">';
	echo '<h3>' . __( 'Bookmarks', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-bookmark' )
	), 
	get_linkbacks( 'bookmark' ) ); ?>
	echo '</div>';
}

if ( has_linkbacks( 'repost' ) ) {
	echo '<div class="reposts">';
	echo '<h3>' . __( 'Reposts', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-repost' )
	), 
	get_linkbacks( 'repost' ) ); ?>
	echo '</div>';
}


if ( has_linkbacks( 'mention' ) ) {
	echo '<div class="mentions">';
	echo '<h3>' . __( 'Mentions', 'semantic-linkbacks' ) . '</h3>';
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-comment' )
	), 
	get_linkbacks( 'mention' ) ); ?>
	echo '</div>';
}


