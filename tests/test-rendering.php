<?php
class RenderingTest extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
		update_option( 'semantic_linkbacks_facepiles_fold_limit', 2 );
		add_filter( 'comment_flood_filter', function() { return FALSE; } );
	}

	public function make_comments( $num, $semantic_linkbacks_type = 'like' ) {
		$comments = [];
		for ( $i = 0; $i < $num; $i++ ) {
			$id = wp_new_comment( array(
				'comment_author_url' => 'http://example.com/person' . $i,
				'comment_author' => 'Person ' . $i,
				'comment_type' => 'webmention',
			) );
			add_comment_meta( $id, 'semantic_linkbacks_type', $semantic_linkbacks_type );
			add_comment_meta( $id, 'semantic_linkbacks_avatar', 'http://example.com/photo' );
			$comments[]= get_comment( $id );
		}
		return $comments;
	}

	public function test_facepile_markup() {
		$comments = $this->make_comments(1);
		$this->assertEquals( '<ul class="mention-list"><li class="single-mention h-cite" id="comment-6">
				<span class="p-author h-card">
					<a class="u-url" title="Person 0 liked this Article on example.com." href="http://example.com/person0"><img alt=\'\' src=\'http://example.com/photo\' srcset=\'http://example.com/photo 2x\' class=\'avatar avatar-64 photo avatar-default u-photo avatar-semantic-linkbacks\' height=\'64\' width=\'64\' /></a>
					<span class="hide-name p-name">Person 0</span>
				</span>
				<a class="u-url" href=""></a>
			</li>', list_linkbacks( array( 'echo' => false ), $comments ) );
	}

	public function test_facepile_fold() {
		$comments = $this->make_comments(3);
		$html = list_linkbacks( array( 'echo' => false ), $comments );
		$person_0 = strpos( $html, '<a class="u-url" title="Person 0 liked this Article on example.com."' );
		$person_1 = strpos( $html, '<a class="u-url" title="Person 1 liked this Article on example.com."' );
		$ellipsis = strpos( $html, '<li class="single-mention mention-ellipsis">' );
		$person_2 = strpos( $html, '<a class="u-url" title="Person 2 liked this Article on example.com."' );
		$this->assertGreaterThan( 0, $person_0 );
		$this->assertGreaterThan( $person_0, $person_1 );
		$this->assertGreaterThan( $person_1, $ellipsis );
		$this->assertGreaterThan( $ellipsis, $person_2 );
	}

	public function test_facepile_no_fold() {
		$comments = $this->make_comments(3);
		update_option( 'semantic_linkbacks_facepiles_fold_limit', 0 );
		$html = list_linkbacks( array( 'echo' => false ), $comments );
		$this->assertContains( '<a class="u-url" title="Person 0', $html );
		$this->assertContains( '<a class="u-url" title="Person 1', $html );
		$this->assertContains( '<a class="u-url" title="Person 2', $html );
		$this->assertEquals( FALSE, strpos( '<li class="single-mention mention-ellipsis">', $html ) );
	}
}
