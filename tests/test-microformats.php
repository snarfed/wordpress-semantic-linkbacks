<?php
class MicroformatsTest extends WP_UnitTestCase {
	/**
	 * @dataProvider templateProvider
	 */
	public function test_interpreter( $file_name ) {
		$comment = Linkbacks_MF2_Handler::generate_commentdata(
			array(
				'remote_source_original' => file_get_contents( dirname( __FILE__ ) . '/templates/' . $file_name . '.html' ),
				'comment_author_url' => 'http://example.com/webmention/source/placeholder',
				'target' => 'http://example.com/webmention/target/placeholder',
				'comment_type' => 'webmention',
				'comment_author' => $file_name,
			)
		);

		$subset = json_decode( file_get_contents( dirname( __FILE__ ) . '/templates/' . $file_name . '.json' ), true );

		$this->assertArraySubset( $subset, $comment );
	}

	public function templateProvider() {
		return array(
			array( 'aaronparecki-com' ),
			array( 'adactio-com' ),
			array( 'basic-like' ),
			array( 'basic-multi' ),
			array( 'basic-reply' ),
			array( 'basic-with-comments' ),
			array( 'brid-gy-emoji' ),
			array( 'brid-gy' ),
			array( 'checkmention-hcardxss' ),
			array( 'checkmention-xss' ),
			array( 'notizblog-org' ),
			array( 'sandeep-io' ),
			array( 'tantek-com' ),
			array( 'voxpelli-com' ),
		);
	}
}
