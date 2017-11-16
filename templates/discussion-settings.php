<fieldset id="semantic_linkbacks">
	<?php if ( apply_filters( 'semantic_linkbacks_facepiles', true ) ) { ?>
	<?php _e( 'Automatically embed facepiles <small>(may not work on all themes)</small> for:', 'semantic-linkbacks' ) ?>
    <ul>
    <li><label for="semantic_linkbacks_facepile_mention">
		<input type="checkbox" name="semantic_linkbacks_facepile_mention" id="semantic_linkbacks_facepile_mention" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_mention', true ) ); ?> />
		<?php _e( 'Mentions', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_repost">
		<input type="checkbox" name="semantic_linkbacks_facepile_repost" id="semantic_linkbacks_facepile_repost" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_repost', true ) ); ?> />
		<?php _e( 'Reposts', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_like">
		<input type="checkbox" name="semantic_linkbacks_facepile_like" id="semantic_linkbacks_facepile_like" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_like', true ) ); ?> />
		<?php _e( 'Likes', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_favorite">
		<input type="checkbox" name="semantic_linkbacks_facepile_favorite" id="semantic_linkbacks_facepile_favorite" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_favorite', true ) ); ?> />
		<?php _e( 'Favorites', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_tag">
		<input type="checkbox" name="semantic_linkbacks_facepile_tag" id="semantic_linkbacks_facepile_tag" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_tag', true ) ); ?> />
		<?php _e( 'Tags', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_bookmark">
		<input type="checkbox" name="semantic_linkbacks_facepile_bookmark" id="semantic_linkbacks_facepile_bookmark" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_bookmark', true ) ); ?> />
		<?php _e( 'Bookmarks', 'semantic-linkbacks' ) ?>
	</label></li>
    <li><label for="semantic_linkbacks_facepile_rsvp">
		<input type="checkbox" name="semantic_linkbacks_facepile_rsvp" id="semantic_linkbacks_facepile_rsvp" value="1" <?php echo checked( true, get_option( 'semantic_linkbacks_facepile_rsvp', true ) ); ?> />
		<?php _e( 'RSVPs', 'semantic-linkbacks' ) ?>
	</label></li>
	</ul>

	<label for="semantic_linkbacks_facepiles_fold_limit">
		<input type="number" min="0" step="1" name="semantic_linkbacks_facepiles_fold_limit" id="semantic_linkbacks_facepiles_fold_limit" class="small-text" value="<?php
			echo get_option( 'semantic_linkbacks_facepiles_fold_limit' ); ?>" />
		<?php _e( 'Initial number of faces to show in facepiles <small>(0 for all)</small>', 'semantic-linkbacks' ) ?>
	</label>

	<br />
	<?php } ?>
</fieldset>
