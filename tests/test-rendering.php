<?php
class RenderingTest extends WP_UnitTestCase {
	public function test_facepile_markup() {
		$id = wp_new_comment( array(
			'comment_author_url' => 'http://example.com/person',
			'comment_author' => 'A Person',
			'comment_type' => 'webmention',
		) );
		add_comment_meta( $id, 'semantic_linkbacks_avatar', 'http://example.com/photo' );
		add_comment_meta( $id, 'semantic_linkbacks_type', 'like' );


		$comment = get_comment( $id );
		$this->assertEquals( '<ul class="mention-list"><li class="single-mention h-cite">
			<a class="u-url" title="A Person" href="http://example.com/person">
			<span class="p-author h-card"><img alt=\'\' src=\'http://example.com/photo\' srcset=\'http://example.com/photo 2x\' class=\'avatar avatar-64 photo avatar-default u-photo avatar-semantic-linkbacks\' height=\'64\' width=\'64\' />
			<span class="hide-name p-name">A Person</span>
			</span>
			</a>
			</li></ul>', list_linkbacks( array( 'echo' => false ), array( $comment ) ) );
	}

	public function test_facepile_ellipsis() {
		add_filter( 'comment_flood_filter', function() { return FALSE; } );

		// Note that FACEPILE_FOLD_LIMIT is overridden and set to 2 in bootstrap.php.
		$comments = [];
		for ( $i = 0; $i < 3; $i++ ) {
			$id = wp_new_comment( array(
				'comment_author_url' => 'http://example.com/person' . $i,
				'comment_author' => 'Person ' . $i,
				'comment_type' => 'webmention',
			) );
			add_comment_meta( $id, 'semantic_linkbacks_type', 'like' );
			add_comment_meta( $id, 'semantic_linkbacks_avatar', 'http://example.com/photo' );
			$comments[]= get_comment( $id );
		}

		$html = list_linkbacks( array( 'echo' => false ), $comments );
		$person_0 = strpos( $html, '<a class="u-url" title="Person 0"' );
		$person_1 = strpos( $html, '<a class="u-url" title="Person 1"' );
		$ellipsis = strpos( $html, '<li class="single-mention mention-ellipsis">' );
		$person_2 = strpos( $html, '<a class="u-url" title="Person 2"' );
		$this->assertGreaterThan( 0, $person_0 );
		$this->assertGreaterThan( $person_0, $person_1 );
		$this->assertGreaterThan( $person_1, $ellipsis );
		$this->assertGreaterThan( $ellipsis, $person_2 );
	}
}
