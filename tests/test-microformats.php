<?php
class MicroformatsTest extends WP_UnitTestCase {
	/**
	 * @dataProvider templateProvider
	 */
	public function test_interpreter( $path ) {
		$comment = Linkbacks_MF2_Handler::generate_commentdata(
			array(
				'remote_source_original' => file_get_contents( $path ),
				'comment_author_url'     => 'http://example.com/webmention/target/placeholder',
				'target'                 => 'http://example.com/webmention/target/placeholder',
				'comment_type'           => 'webmention',
				'comment_author'         => basename( $path, '.html' ),
			)
		);

		$subset = json_decode( file_get_contents( substr( $path, 0, -4 ) . 'json' ), true );
		$this->assertArraySubset( $subset, $comment );
	}

	public function templateProvider() {
		return array_map(
			function( $path ) {
					return array( $path ); },
			glob( dirname( __FILE__ ) . '/templates/*.html' )
		);
	}
}
