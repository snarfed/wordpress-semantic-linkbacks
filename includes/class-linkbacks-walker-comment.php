<?php

require_once 'emoji-detector-php/Emoji.php';

/**
 * Comment walker subclass that skips facepile webmention comments and stores
 * emoji reactions (https://indieweb.org/reacj).
 *
 * Based on https://codex.wordpress.org/Function_Reference/Walker_Comment
 */
class Semantic_Linkbacks_Walker_Comment extends Walker_Comment {
	public static $reactions = array();

	static function should_facepile( $comment ) {
		// Detect single-emoji reactions
		if ( $comment->type == '' ) {
			$emoji = Emoji\is_single_emoji( trim( wp_strip_all_tags( $comment->comment_content ) ) );
			if ( $emoji ) {
				if ( ! array_key_exists( $emoji['emoji'], self::$reactions ) ) {
					self::$reactions[$emoji['emoji']] = array();
				}
				self::$reactions[$emoji['emoji']][] = $comment;
				return;
			}
		}

		if ( $comment->type && 'comment' != $comment_type ) {
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

	function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
		if ( ! self::should_facepile( $comment ) ) {
			return parent::start_el( $output, $comment, $depth, $args, $id );
		}
	}

	function end_el( &$output, $comment, $depth = 0, $args = array() ) {
		if ( ! self::should_facepile( $comment ) ) {
			return parent::end_el( $output, $comment, $depth, $args, $id );
		}
	}
}
