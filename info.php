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

$module_directory	= 'concert';
$module_name		= 'Concert Calendar';
$module_function	= 'page';
$module_version		= '2.2.3.0';
$module_platform	= '2.x';
$module_author		= 'Bennie Wijs and others';
$module_license		= 'GNU General Public License';
$module_guid		= '1A06B0CA-05E2-4811-AC64-4BF17DB164FC';
$module_home		= '<a href="http://cms-lab.com" target="_blank">CMS-LAB</a>';
$module_description	= 'This module is a concert calendar.';

?>