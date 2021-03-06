<?php
/*! pimpmylog - 0.9.5 - b11d60337506ec7d21d0c0931f7c0aba4436aa6a*/
/*
 * pimpmylog
 * http://pimpmylog.com
 *
 * Copyright (c) 2014 Potsky, contributors
 * Licensed under the GPLv3 license.
 */
?>
<?php
if(function_exists('xdebug_disable')) { xdebug_disable(); }
include_once 'functions.inc.php';


///////////////////////////////////
// Define locale and translation //
///////////////////////////////////
$lang = '';

if ( function_exists( 'bindtextdomain' ) ) {

	$locale = '';

	if ( isset( $_GET['l'] ) ) {
		$locale = $_GET['l'];
	}
	else if ( defined( 'LOCALE' ) ) {
		$locale = LOCALE;
	}
	else if ( isset( $_SERVER['HTTP_ACCEPT_LANGUAGE'] ) ) {
		@list( $locale, $dumb ) = @explode( ',', $_SERVER['HTTP_ACCEPT_LANGUAGE'], 2 );
	}

	$locale         = str_replace( '-', '_', $locale );
	@list( $lang, $b ) = explode( '_', $locale );
	$locale         = strtolower( $lang ).'_'.strtoupper( $b );
	putenv( 'LC_ALL=' . $locale );
	putenv( 'LANGUAGE=' . $locale );

	if ( $lang == 'fr' ) {
		setlocale( LC_ALL , $locale , $locale . '.utf8' , 'fra' );
	}
	else if ( $lang == 'de' ) {
		setlocale( LC_ALL , $locale , $locale . '.utf8' , 'deu_deu' , 'de' , 'ge' );
	}
	else {
		setlocale( LC_ALL , $locale , $locale . '.utf8' );
	}

	bindtextdomain( 'messages' , dirname( __FILE__ ) . '/../lang' );
	bind_textdomain_codeset( 'messages' , 'UTF-8' );
	textdomain( 'messages' );
}

else {

	function gettext( $text ) {
		return $text;
	}

}

