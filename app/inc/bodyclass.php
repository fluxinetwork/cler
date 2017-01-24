<?php 
/**
 * Add custom body class
 */

$bodyclass = '';

/* Detect touch */

global $isMobile;
$isMobile = false;

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

/* Detect filters */

$template_with_filters = ['page-templates/page-tous-emploi.php', 'page-templates/page-tous-events.php', 'page-templates/page-tous-formations.php'];
if (is_page_template($template_with_filters)) {
	$bodyclass .= ' page-has-filters';
}

 /* Auto filter */
$template_with_auto_filters = ['page-templates/page-tous-actualites.php', ];
if (is_page_template($template_with_auto_filters)) {
	$bodyclass .= ' page-has-auto-filters';
}

?>