<?php 
/**
 * Add custom body class
 */

$bodyclass = '';

global $isMobile;
$isMobile = false;

/*
 * If no browser detection plugin do basic mobile detection
 * Browser detection plugin : https://fr.wordpress.org/plugins/php-browser-detection/
 */

if ( function_exists('is_mobile') ) {
	is_mobile() ? $bodyclass .= ' touch' : $bodyclass .= ' no-touch';
} else {
	$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
	$ipad = strpos($_SERVER['HTTP_USER_AGENT'],"iPad");
	$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
	$windowsphone = strpos($_SERVER['HTTP_USER_AGENT'],"Windows Phone");

	if ($iphone == true || $ipad == true || $android == true || $windowsphone == true) { 
		$bodyclass .= ' touch';
		$isMobile = true;
	} else {
		$bodyclass .= ' no-touch';
	}

	if ($iphone == true || $ipad == true) { 
		$bodyclass .= ' ios';
	}
}
?>