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

//require('../../config.php');
require(LEPTON_PATH.'/modules/admin.php');

// Include admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
error_reporting(E_ALL);
// This code removes any php tags
$header_data = addslashes($_POST['ccheader']);
$footer_data = addslashes($_POST['ccfooter']);
$ccloop = addslashes($_POST['ccloop']);
$detailed_view = $_POST['detailed_view'];
$upcoming_view = $_POST['upcoming_view'];
$previous_view = $_POST['previous_view'];
$previous_num = addslashes($_POST['previous_num']);
$upcoming_num = addslashes($_POST['upcoming_num']);
$dateview = $_POST['dateview_form'];
$date_link = $_POST['date_link'];
$toggle = $_POST['toggle'];


//Write Settings to Database
$database->query("UPDATE `".TABLE_PREFIX."mod_concert_settings`
			SET	`page_id` = '$page_id',
				`header_data` = '$header_data',
				`footer_data` = '$footer_data',
				`ccloop` = '$ccloop',
				`detailed_view` = '$detailed_view',
				`previous_view` = '$previous_view',
				`upcoming_view` = '$upcoming_view',
				`previous_num` = '$previous_num',
				`upcoming_num` = '$upcoming_num',
				`dateview` = '$dateview',
				`date_link` = '$date_link',
				`toggle` = '$toggle'
			WHERE `section_id` = '$section_id'"
			);

// Check if there is a database error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), $js_back);
} else {
	$admin->print_success($MESSAGE['PAGES']['SAVED'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer()

?>