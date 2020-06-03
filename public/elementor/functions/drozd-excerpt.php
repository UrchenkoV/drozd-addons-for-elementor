<?php
 // If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Trim text (excerpt). Shortcodes are cut. The minimum value of maxchar can be 22.
 *
 * Author function https://wp-kama.ru/id_31/obrezka-teksta-zamenyaem-the-excerpt.html
 * 
 * @param string/array $args Characteristic.
 *
 * @return string HTML
 *
 * @since 2.6.4
 */
function drozd_excerpt( $args = '' ) {
	global $post;

	if( is_string($args) )
		parse_str( $args, $args );

	$rg = (object) array_merge( array(
		'maxchar'   => 175,   // Max number of characters.
		'text'      => '',    // What is the text to trim (default post_excerpt, if not post_content.
							  // If the text contains `<!--more-->`, then 'maxchar' is ignored and taken all the way to <!--more--> together with HTML.
		'autop'     => true,  // Replace line breaks with <p> and <br> or not?
		'save_tags' => '',    // Tags to leave in the text, for example '<strong><b><a>'.
		'more_text' => 'Read more...', // Link text 'Read more'.
	), $args );

	$rg = apply_filters( 'kama_excerpt_args', $rg );

	if( ! $rg->text )
		$rg->text = $post->post_excerpt ?: $post->post_content;

	$text = $rg->text;
	$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text ); // remove block shortcode: [foo]some data[/foo]. Consider markdown
	$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text ); // remove the shortcode [singlepic id=3]. Considers markdown
	$text = trim( $text );

	// <!--more-->
	if( strpos( $text, '<!--more-->') ){
		preg_match('/(.*)<!--more-->/s', $text, $mm );

		$text = trim( $mm[1] );

		$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
	}
	// text, excerpt, content
	else {
		$text = trim( strip_tags($text, $rg->save_tags) );

		// Обрезаем
		if( mb_strlen($text) > $rg->maxchar ){
			$text = mb_substr( $text, 0, $rg->maxchar );
			$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text ); // remove the last word, it is 99% incomplete
		}
	}

	// Save line breaks. Simplified analog wpautop()
	if( $rg->autop ){
		$text = preg_replace(
			array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
			array('',     '</p><p>',  '<br />', '</p>'),
			$text
		);
	}

	$text = apply_filters( 'kama_excerpt', $text, $rg );

	if( isset($text_append) )
		$text .= $text_append;

	return ( $rg->autop && $text ) ? "<p>$text</p>" : $text;
}
/* Сhangelog:
 * 2.6.4 - Removed the space between the word and the ellipsis
 * 2.6.3 - Refactoring
 * 2.6.2 - Added a regular expression to remove block shortcodes of the form: [foo]some data[/foo]
 * 2.6   - Removed 'save_format' parameter and replaced it with two parameters'autop' и 'save_tags'.
 *       - Slightly changed the logic of the code.
 */