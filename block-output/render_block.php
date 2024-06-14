<?php

/**
 * The following is taken from the WordPress.org developer blog.
 *
 * @see https://developer.wordpress.org/news/2024/06/13/how-to-create-an-animated-timeline-plugin/#html-tag-processor-and-block-filters
 */

/**
* Modify the core Group block.
*
* @param string $block_content The block content about to be rendered.
*
* @return string               The maybe modified block content.
*/
function animated_timeline_filter_group_content( $block_content ) {
	$processor = new WP_HTML_Tag_Processor( $block_content );
	$counter   = 0;

	// Check for the presence of the animated-timeline class.
	if ( ! $processor->next_tag( array( 'class_name' => 'animated-timeline' ) ) ) {
		return $block_content;
	}

	// Loop through each child block with the class name 'wp-block-column'.
	while ( $processor->next_tag( array( 'class_name' => 'wp-block-column' ) ) ) {
		$processor->add_class( 'animated__item' );
		++$counter;

		switch ( $counter ) {
			case 1:
				$processor->add_class( 'animated__item--first' );
				break;
			case 2:
				$processor->add_class( 'animated__item--line' );
				break;
			case 3:
				$processor->add_class( 'animated__item--last' );
				$counter = 0;
				break;
		}
	}

	$block_content = $processor->get_updated_html();

	// Enqueue the custom script and style.
	wp_enqueue_script( 'animated-timeline-script' );
	wp_enqueue_style( 'animated-timeline-style' );

	// Return the maybe modified block content.
	return $block_content;
}
add_filter( 'render_block_core/group', 'animated_timeline_filter_group_content', 10 );
