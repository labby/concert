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

// default header
$header_data = addslashes('<h1>Concerts</h1>');
// default footer
$footer_data = addslashes('Footer');
//default loop
$ccloop = addslashes('[HEAD] In [PLACE] ([CLUB]) at [TIME] for [PRICE].');


$database->query("INSERT INTO `".TABLE_PREFIX."mod_concert_settings` (`page_id`, `section_id`, `header_data`, `footer_data`, `ccloop`, `detailed_view`, `upcoming_view`, `previous_view`, `previous_num`, `upcoming_num`, `dateview`, `date_link`, `toggle`) VALUES ('$page_id','$section_id','$header_data','$footer_data','$ccloop','1','1','1','10','10','0','0','1')");

?>