<?php

/**
 * An example of how the tag processor API can handle broken or tricky markup.
 *
 * @see https://make.wordpress.org/core/2023/03/07/introducing-the-html-api-in-wordpress-6-2/
 */

$ugly_html = <<<HTML
<textarea title='<div> elements are semantically void'>
    <div><!--<div attr-->="</div>"></div>">
</textarea>
<div></div>
HTML;

$p = new WP_HTML_Tag_Processor( $ugly_html );
if ( $p->next_tag( 'div' ) ) {
	$p->add_class( 'bold' );
}

echo $p->get_updated_html();
// Output:
// <textarea title='<div> elements are semantically void'>
//     <div><!--<div attr-->="</div>"></div>">
// </textarea>
// <div class="bold"></div>
