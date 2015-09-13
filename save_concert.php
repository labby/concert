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

// Get id
if(!isset($_POST['concert_id']) OR !is_numeric($_POST['concert_id'])) {
	header("Location: ".ADMIN_URL."/pages/index.php");
} else {
	$concert_id = $_POST['concert_id'];
}

// Include admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(LEPTON_PATH.'/modules/admin.php');

// Validate all fields
if($admin->get_post('concert_name') == '') {
	$admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], LEPTON_URL.'/modules/concert/change_concert.php?page_id='.$page_id.'&section_id='.$section_id.'&concert_id='.$concert_id);
} else {
	$concert_head = addslashes($admin->get_post('concert_head'));
	$concert_name = addslashes($admin->get_post('concert_name'));  
	$concert_desc = addslashes($admin->get_post('concert_desc'));
	$concert_place = addslashes($admin->get_post('concert_place'));
	$concert_club = addslashes($admin->get_post('concert_club'));
	$concert_price = addslashes($admin->get_post('concert_price'));
	$concert_time = addslashes($admin->get_post('concert_time'));
	$year = $admin->get_post('year');
	$month = $admin->get_post('month');
	$day = $admin->get_post('day');
}
// send the posted date through mktime to get a correct date
$fulldate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));

$date=$fulldate; // ???


// Update row
$database->query("UPDATE `".TABLE_PREFIX."mod_concert_dates` SET `page_id` = '$page_id', `section_id` = '$section_id', `concert_date` = '$date', `concert_desc` = '$concert_desc', `concert_head` = '$concert_head', `concert_name` = '$concert_name', `concert_place` = '$concert_place', `concert_club` = '$concert_club', `concert_price` = '$concert_price', `concert_time` = '$concert_time' WHERE `concert_id` = '$concert_id'");


// Check if there is a db error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), LEPTON_URL.'/modules/concert/change_concert.php?page_id='.$page_id.'&section_id='.$section_id.'&concert_id='.$concert_id);
} else {
	$admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>