<?php
class RenderingTest extends WP_UnitTestCase {
	public function setUp() {
		parent::setUp();
		update_option( 'semantic_linkbacks_facepiles_fold_limit', 2 );
		add_filter( 'comment_flood_filter', function() { return false; } );
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
			$comments[] = get_comment( $id );
		}
		return $comments;
	}

	public function test_facepile_markup() {
		$comments = $this->make_comments( 1 );
		$this->assertStringMatchesFormat( '<ul class="mention-list"><li class="single-mention h-cite" id="comment-2">
				<span class="p-author h-card">
					<a class="u-url" title="Person 0 liked this Article on example.com." href="http://example.com/person0"><img alt=\'\' src=\'http://example.com/photo\' srcset=\'http://example.com/photo 2x\' class=\'avatar avatar-64 photo avatar-default u-photo avatar-semantic-linkbacks\' height=\'64\' width=\'64\' /> </a>
					<span class="hide-name p-name">Person 0</span>
				</span>
				<a class="u-url" href=""></a>
			</li></ul>', list_linkbacks( array( 'echo' => false ), $comments ) );
	}

	public function test_facepile_converts_default_gravatar_to_mystery_man() {
		update_option( 'avatar_default', 'blank' );

		$comment = get_comment( wp_new_comment( array(
			'comment_author_url' => 'http://example.com/person',
			'comment_author' => 'Person',
			'comment_type' => 'webmention',
		) ) );
		$this->assertContains( 'gravatar.com/avatar/?s=96&d=blank', get_avatar_url( $comment, array( 'size' => 96 ) ) );

		update_option( 'semantic_linkbacks_facepile_like', 1 );
		add_comment_meta( $comment->comment_ID, 'semantic_linkbacks_type', 'like' );

		$html = list_linkbacks( array( 'echo' => false ), array( $comment ) );
		$this->assertContains( 'gravatar.com/avatar/?s=64&#038;d=mm', $html );
		$this->assertFalse( strpos( $html, 'gravatar.com/avatar/?s=64&#038;d=blank' ) );
	}

	public function test_facepile_fold() {
		$comments = $this->make_comments( 3 );
		$html = list_linkbacks( array( 'echo' => false ), $comments );
		$person_0 = strpos( $html, '<a class="u-url" title="Person 0 liked this Article on example.com."' );
		$person_1 = strpos( $html, '<a class="u-url" title="Person 1 liked this Article on example.com."' );
		$ellipsis = strpos( $html, '<li id="mention-ellipsis-single-mention" class="single-mention mention-ellipsis">' );
		$person_2 = strpos( $html, '<a class="u-url" title="Person 2 liked this Article on example.com."' );
		$this->assertGreaterThan( 0, $person_0 );
		$this->assertGreaterThan( $person_0, $person_1 );
		$this->assertGreaterThan( $person_1, $ellipsis );
		$this->assertGreaterThan( $ellipsis, $person_2 );
	}

	public function test_facepile_no_fold() {
		$comments = $this->make_comments( 3 );
		update_option( 'semantic_linkbacks_facepiles_fold_limit', 0 );
		$html = list_linkbacks( array( 'echo' => false ), $comments );
		$this->assertContains( '<a class="u-url" title="Person 0', $html );
		$this->assertContains( '<a class="u-url" title="Person 1', $html );
		$this->assertContains( '<a class="u-url" title="Person 2', $html );
		$this->assertEquals( false, strpos( '<li class="single-mention mention-ellipsis">', $html ) );
	}

	public function test_reactions() {
		$id = wp_new_comment( array(
			'comment_author_url' => 'http://example.com/person',
			'comment_author' => 'Person',
			'comment_type' => '',
			'comment_content' => '😢',  // 'crying face' emoji
		) );
		add_comment_meta( $id, 'semantic_linkbacks_avatar', 'http://example.com/photo' );
		Semantic_Linkbacks_Walker_Comment::$reactions = array( get_comment( $id ) );

		ob_start();
		load_template( dirname( __FILE__ ) . '/../templates/linkbacks.php', false );
		$html = ob_get_contents();
		ob_end_clean();

		$this->assertStringMatchesFormat( '<div class="reactions">
	<ul class="mention-list"><li class="single-mention p-reply emoji-reaction h-cite" id="comment-%d">
				<span class="p-author h-card">
					<a class="u-url" title="Person 😢 on example.com." href="http://example.com/person"><img alt=\'\' src=\'http://example.com/photo\' srcset=\'http://example.com/photo 2x\' class=\'avatar avatar-64 photo avatar-default u-photo avatar-semantic-linkbacks\' height=\'64\' width=\'64\' /> <span class="emoji-overlay">😢</span></a>
					<span class="hide-name p-name">Person</span>
				</span>
				<a class="u-url" href=""></a>
			</li></ul></div>', trim( $html ) );
	}
}
