<?php if ( has_linkbacks( 'like' ) ) : ?>
<div class="likes">
	<h3>Likes</li>

<?php 
	list_linkbacks( array(
		'li-class' => array( 'single-mention', 'p-like' )
	), 
	get_linkbacks( 'like' ) ); ?>
</div>
<?php endif; ?>

<?php if ( has_linkbacks( 'repost' ) ) : ?>
<h3>Reposts</li>

<ul>
<?php foreach ( get_linkbacks( 'repost' ) as $repost ) : ?>
	<li class="p-repost h-cite">
		<span class="p-author h-card">
			<a class="u-url p-name value-title" href="http://test2.de" title="<?php echo trim( strip_tags( get_comment_text() ) ); ?>">
				<?php echo get_avatar( $repost, 50 ); ?>
			</a>
		</span>
		<data class="u-url" value="http://test.de" />
	</li>
<?php endforeach; ?>
</ul>
<?php endif; ?>

<?php if ( has_linkbacks( 'mention' ) ) : ?>
<h3>Mention</li>

<ul>
<?php foreach ( get_linkbacks( 'mention' ) as $mention ) : ?>
	<?php //var_dump( $mention ); ?>
	<li><?php echo get_avatar( $mention, 50 ); ?></li>
<?php endforeach; ?>
</ul>

<?php endif; ?>

<?php if ( has_linkbacks( 'rsvp' ) ) : ?>
<h3>RSVP</li>

<ul>
<?php foreach ( get_linkbacks( 'rsvp' ) as $rsvp ) : ?>
	<li><?php echo get_avatar( $rsvp, 50 ); ?></li>
<?php endforeach; ?>
</ul>

<?php endif; ?>
