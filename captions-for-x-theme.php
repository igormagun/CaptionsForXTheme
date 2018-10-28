<?php
/*
Plugin Name: Captions for X Theme
Description: Adds captions to featured images in X Theme
Version:     1.0.0
Author:      Igor Magun
Author URI:  https://igormagun.com
License:     GPL 3.0
License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
*/
?>

<?php

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

function xcaption($content) {
if( is_single() ) {
	if( has_post_thumbnail() && ! has_post_format('video') && ! has_post_format('audio') && ! has_post_format('gallery') ) {

	$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");
    $dom = new DOMDocument();
    @$dom->loadHTML($content);

	$customFieldCaption = get_post_custom_values("caption");
	$after = $customFieldCaption[0];

	$newHTML = preg_replace('^<div class="entry-featured">+(.*?)</div>$^', "$1<p>$after</p>", $dom->saveHTML());

return $newHTML;

}
}
}

add_filter ( 'the_content', 'xcaption' );
?>
