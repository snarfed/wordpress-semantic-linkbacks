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
}
