<?php
// Get the start time
$start_time = microtime( true );

// Read content from content.html
$content = file_get_contents( 'content.html' );
$loops   = 1;

// Create the processor object.
$processor = new WP_HTML_Tag_Processor( $content );

while ( $loops > 0 ) {
	--$loops;

	while ( $processor->next_tag( 'A' ) ) {
		$processor->set_attribute( 'target', '_blank' );
	}

	$content = $processor->get_updated_html();
}

// Get the end time
$end_time = microtime( true );

// Calculate execution time
$execution_time = $end_time - $start_time;

echo 'Execution time: ' . $execution_time . ' seconds';
