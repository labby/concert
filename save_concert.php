<?php

/*

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2008, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

require('../../config.php');

// Get id
if(!isset($_POST['concert_id']) OR !is_numeric($_POST['concert_id'])) {
	header("Location: ".ADMIN_URL."/pages/index.php");
} else {
	$concert_id = $_POST['concert_id'];
}

// Include WB admin wrapper script
$update_when_modified = true; // Tells script to update when this page was last updated
require(WB_PATH.'/modules/admin.php');

// Validate all fields
if($admin->get_post('concert_name') == '') {
	$admin->print_error($MESSAGE['GENERIC']['FILL_IN_ALL'], WB_URL.'/modules/concert/change_concert.php?page_id='.$page_id.'&section_id='.$section_id.'&concert_id='.$concert_id);
} else {
	$concert_head = $admin->add_slashes($admin->get_post('concert_head'));
	$concert_name = $admin->add_slashes($admin->get_post('concert_name'));  
	$concert_desc = $admin->add_slashes($admin->get_post('concert_desc'));
	$concert_place = $admin->add_slashes($admin->get_post('concert_place'));
	$concert_club = $admin->add_slashes($admin->get_post('concert_club'));
	$concert_price = $admin->add_slashes($admin->get_post('concert_price'));
	$concert_time = $admin->add_slashes($admin->get_post('concert_time'));
	$year = $admin->get_post('year');
	$month = $admin->get_post('month');
	$day = $admin->get_post('day');
}
// send the posted date through mktime to get a correct date
$fulldate = date('Y-m-d', mktime(0, 0, 0, $month, $day, $year));
if ($concert_date == $fulldate) {
	$date=$concert_date;
} else {
	$date=$fulldate;
}


// Update row
$database->query("UPDATE `".TABLE_PREFIX."mod_concert_dates` SET `page_id` = '$page_id', `section_id` = '$section_id', `concert_date` = '$date', `concert_desc` = '$concert_desc', `concert_head` = '$concert_head', `concert_name` = '$concert_name', `concert_place` = '$concert_place', `concert_club` = '$concert_club', `concert_price` = '$concert_price', `concert_time` = '$concert_time' WHERE `concert_id` = '$concert_id'");


// Check if there is a db error, otherwise say successful
if($database->is_error()) {
	$admin->print_error($database->get_error(), WB_URL.'/modules/concert/change_concert.php?page_id='.$page_id.'&section_id='.$section_id.'&concert_id='.$concert_id);
} else {
	$admin->print_success($TEXT['SUCCESS'], ADMIN_URL.'/pages/modify.php?page_id='.$page_id);
}

// Print admin footer
$admin->print_footer();

?>