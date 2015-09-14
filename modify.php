<?php

/**
 *  @module         concert calendar
 *  @version        see info.php of this module
 *  @author         Bennie Wijs and others
 *  @copyright      2009-2015 Bennie Wijs and others
 *  @license        GNU General Public License
 *  @license terms  see info.php of this module
 *  @platform       see info.php of this module
 * 
 */
 
// include class.secure.php to protect this file and the whole CMS!
if (defined('LEPTON_PATH')) {	
	include(LEPTON_PATH.'/framework/class.secure.php'); 
} else {
	$oneback = "../";
	$root = $oneback;
	$level = 1;
	while (($level < 10) && (!file_exists($root.'/framework/class.secure.php'))) {
		$root .= $oneback;
		$level += 1;
	}
	if (file_exists($root.'/framework/class.secure.php')) { 
		include($root.'/framework/class.secure.php'); 
	} else {
		trigger_error(sprintf("[ <b>%s</b> ] Can't include class.secure.php!", $_SERVER['SCRIPT_NAME']), E_USER_ERROR);
	}
}
// end include class.secure.php

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(LEPTON_PATH .'/modules/concert/languages/'.LANGUAGE .'.php')) {
	// no module language file exists for the language set by the user, include default module language file EN.php
	require_once(LEPTON_PATH .'/modules/concert/languages/EN.php');
} else {
	// a module language file exists for the language defined by the user, load it
	require_once(LEPTON_PATH .'/modules/concert/languages/'.LANGUAGE .'.php');
}

/** ******************
 *	Load Language file
 */
$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );

/**	*******************************
 *	Try to get the template-engine.
 */
global $parser, $loader;
require( dirname(__FILE__)."/register_parser.php" );

// removes empty events from the table so they will not be displayed
$database->query("DELETE FROM `".TABLE_PREFIX."mod_concert_dates` WHERE `page_id` = '$page_id' and `section_id` = '$section_id' and `concert_desc`=''");

$fetch_page_content = array();

$database->execute_query(
	"SELECT * FROM `".TABLE_PREFIX."mod_concert_settings` WHERE `section_id` = '".$section_id."'",
	true,
	$fetch_page_content,
	false
);

$dateview = $fetch_page_content['dateview'];

$concerts = array();
$database->execute_query(
	"SELECT * FROM `".TABLE_PREFIX."mod_concert_dates` WHERE `section_id` = '".$section_id."' ORDER BY `concert_date`",
	true,
	$concerts

);
$page_values = array(
	'concerts'		=> $concerts, 
	'MOD_CONCERT'	=> $MOD_CONCERT,
	'LEPTON_URL'	=> LEPTON_URL,
	'THEME_URL'		=> THEME_URL,
	'page_id'		=> $page_id,
	'section_id'	=> $section_id,
	'TEXT'			=> $TEXT
);

echo $parser->render(
	$twig_modul_namespace.'modify.lte',
	$page_values
);

?>