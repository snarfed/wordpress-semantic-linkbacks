<fieldset id="semantic_linkbacks">
	<?php if ( apply_filters( 'semantic_linkbacks_facepiles', true ) ) { ?>
	<label for="semantic_linkbacks_facepiles">
		<input type="checkbox" name="semantic_linkbacks_facepiles" id="semantic_linkbacks_facepiles" value="1" <?php
			echo checked( true, get_option( 'semantic_linkbacks_facepiles' ) );  ?> />
		<?php _e( 'Automatically embed facepile <small>(May not work on all themes)</small>', 'semantic-linkbacks' ) ?>
	</label>

	<br />
	<?php } ?>
</fieldset>
