<?php
/**
 * Comment walker subclass that skips facepile webmention comments and stores
 * emoji reactions (https://indieweb.org/reacj).
 *
 * Based on https://codex.wordpress.org/Function_Reference/Walker_Comment
 */
class Semantic_Linkbacks_Walker_Comment extends Walker_Comment {
	public static $reactions = array();

	static function should_facepile( $comment ) {
		if ( self::is_reaction( $comment ) && get_option( 'semantic_linkbacks_facepile_reaction', true ) ) {
			return true;
		}

		if ( 'comment' !== get_comment_type( $comment ) ) {
			$type = 'mention';
		} else {
			$type = Linkbacks_Handler::get_type( $comment );
		}

		$type = explode( ':', $type );

		if ( is_array( $type ) ) {
			$type = $type[0];
		}

		$option = 'semantic_linkbacks_facepile_' . $type;

		return $type && 'reply' != $type && get_option( $option, true );
	}

	static function get_comment_author_link( $comment_ID = 0 ) {
		$comment = get_comment( $comment_ID );
		$url     = get_comment_author_url( $comment );
		$author  = get_comment_author( $comment );

		if ( empty( $url ) || 'http://' == $url ) {
			$return = sprintf( '<span class="p-name">%s</span>', $author );
		} else {
			$return = sprintf( '<a href="%s" rel="external" class="u-url p-name">%s</a>', $url, $author );
		}

		/**
		 * Filters the comment author's link for display.
		 *
		 * @since 1.5.0
		 * @since 4.1.0 The `$author` and `$comment_ID` parameters were added
		 * @param string $return     The HTML-formatted comment author link.
		 *                           Empty for an invalid URL.
		 * @param string $author     The comment author's username.
		 * @param int    $comment_ID The comment ID.
		 */
		return apply_filters( 'get_comment_author_link', $return, $author, $comment->comment_ID );
	}

	static function is_reaction( $comment ) {
		return ( $comment->type == '' &&
				Emoji\is_single_emoji( trim( wp_strip_all_tags( $comment->comment_content ) ) ) );
	}

	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		if ( self::is_reaction( $comment ) ) {
			self::$reactions[] = $comment;
		}

		if ( ! self::should_facepile( $comment ) ) {
			return parent::start_el( $output, $comment, $depth, $args, $id );
		}
	}

	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( ! self::should_facepile( $comment ) ) {
			return parent::end_el( $output, $comment, $depth, $args );
		}
	}

	protected function _html5_comment( $comment, $depth, $args ) {
		$tag  = ( 'div' === $args['style'] ) ? 'div' : 'li';
		$type = Linkbacks_Handler::get_type( $comment );
		$url  = Linkbacks_Handler::get_url( $comment );
		$host = wp_parse_url( $url, PHP_URL_HOST );
		// strip leading www, if any
		$host = preg_replace( '/^www\./', '', $host );

?>
		<<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent' : '', $comment ); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard h-card u-author">
						<?php
						if ( 0 != $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'] );}
?>
						<?php
							/* translators: %s: comment author link */
							printf(
								__( '%s <span class="says">says:</span>' ),
								sprintf( '<b>%s</b>', self::get_comment_author_link( $comment ) )
							);
						if ( $type ) {
							printf( '<small>&nbsp;@&nbsp;<cite><a href="%s">%s</a></cite></small>', $url, $host );
						}
						?>
					</div><!-- .comment-author -->

					<div class="comment-metadata">
						<a class="u-url" href="<?php echo esc_url( get_comment_link( $comment, $args ) ); ?>">
							<time class="dt-published" datetime="<?php comment_time( DATE_W3C ); ?>">
								<?php
									/* translators: 1: comment date, 2: comment time */
									printf( __( '%1$s at %2$s' ), get_comment_date( '', $comment ), get_comment_time() );
								?>
							</time>
						</a>
						<?php edit_comment_link( __( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .comment-metadata -->

					<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ); ?></p>
					<?php endif; ?>
				</footer><!-- .comment-meta -->

				<div class="comment-content e-content p-name">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
				comment_reply_link(
					array_merge(
						$args, array(
							'add_below' => 'div-comment',
							'depth'     => $depth,
							'max_depth' => $args['max_depth'],
							'before'    => '<div class="reply">',
							'after'     => '</div>',
						)
					)
				);
				?>
			</article><!-- .comment-body -->
<?php
	}
}
