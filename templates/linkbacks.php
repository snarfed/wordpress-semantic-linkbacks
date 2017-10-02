<?php if ( has_linkbacks( 'like' ) ) : ?>
<div class="likes">
	<h3><?php echo __( 'Likes', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-like' ),
		),
		get_linkbacks( 'like' )
	);
	?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'favorite' ) ) : ?>
<div class="favorites">
	<h3><?php echo __( 'Favourites', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-favorite' ),
		),
		get_linkbacks( 'favorite' )
	);
	?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'bookmark' ) ) : ?>
<div class="bookmarks">
	<h3><?php echo __( 'Bookmarks', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-bookmark' ),
		),
		get_linkbacks( 'bookmark' )
	);
	?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'repost' ) ) : ?>
<div class="reposts">
	<h3><?php echo __( 'Reposts', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-repost' ),
		),
		get_linkbacks( 'repost' )
	);
	?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'tag' ) ) : ?>
<div class="tags">
	<h3><?php echo __( 'Tags', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-tag' ),
		),
		get_linkbacks( 'tag' )
	);
	?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'rsvp' ) ) : ?>
<div class="rsvps">
	<h3><?php _e( 'RSVPs', 'semantic-linkbacks' ); ?></h3>

	<?php if ( has_linkbacks( 'rsvp:yes' ) ) : ?>
	<h4><?php _e( 'Yes', 'semantic-linkbacks' ); ?></h4>
	<?php
	list_linkbacks(
		array(
			'li-class' => array(
				'single-mention',
				'p-rsvp',
			)
		),
		get_linkbacks( 'rsvp:yes' )
	);
	?>
	<?php endif; ?>

	<?php if ( has_linkbacks( 'rsvp:invited' ) ) : ?>
	<h4><?php _e( 'Invited', 'semantic-linkbacks' ); ?></h4>
	<?php
	list_linkbacks(
		array(
			'li-class' => array(
				'single-mention',
				'p-rsvp',
			)
		),
		get_linkbacks( 'rsvp:invited' )
	);
	?>
	<?php endif; ?>

	<?php if ( has_linkbacks( 'rsvp:maybe' ) ) : ?>
	<h4><?php _e( 'Maybe', 'semantic-linkbacks' ); ?></h4>
	<?php
	list_linkbacks(
		array(
			'li-class' => array(
				'single-mention',
				'p-rsvp',
			)
		),
		get_linkbacks( 'rsvp:maybe' )
	);
	?>
	<?php endif; ?>

	<?php if ( has_linkbacks( 'rsvp:no' ) ) : ?>
	<h4><?php _e( 'No', 'semantic-linkbacks' ); ?></h4>
	<?php
	list_linkbacks(
		array(
			'li-class' => array(
				'single-mention',
				'p-rsvp',
			)
		),
		get_linkbacks( 'rsvp:no' )
	);
	?>
	<?php endif; ?>

	<?php if ( has_linkbacks( 'rsvp:tracking' ) ) : ?>
	<h4><?php _e( 'Tracking', 'semantic-linkbacks' ); ?></h4>
	<?php
	list_linkbacks(
		array(
			'li-class' => array(
				'single-mention',
				'p-rsvp',
			)
		),
		get_linkbacks( 'rsvp:tracking' )
	);
	?>
	<?php endif; ?>
<?php endif; ?>
</div>

<?php if ( has_linkbacks( 'mention' ) ) : ?>
<div class="mentions">
	<h3><?php echo __( 'Mentions', 'semantic-linkbacks' ); ?></h3>
	<?php
	list_linkbacks(
		array(
			'li-class' => array( 'single-mention', 'p-mention' ),
		),
		get_linkbacks( 'mention' )
	);
	?>
</div>
<?php endif; ?>
