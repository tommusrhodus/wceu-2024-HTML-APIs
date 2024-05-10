<?php
// Get the start time
$start_time = microtime( true );

// Read content from content.html
$content = file_get_contents( 'content.html' );
$loops   = 1;

// Regex pattern to find all <a> tags
$pattern = '/<a\s+(?:[^>]*?\s+)?href=(["\'])(.*?)\1/';

while ( $loops > 0 ) {
	--$loops;

	// Replace <a> tags with target="_blank"
	$content = preg_replace_callback(
		$pattern,
		function ( $match ) {
			$href = $match[2];
			return '<a target="_blank" href="' . $href . '"';
		},
		$content
	);
}

// Get the end time
$end_time = microtime( true );

// Calculate execution time
$execution_time = $end_time - $start_time;

echo 'Execution time: ' . $execution_time . ' seconds';
