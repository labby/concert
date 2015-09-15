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

// Create table for event module settings (per page/section)
$database->query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'mod_concert_settings`');
$mod_concert = 'CREATE TABLE `'.TABLE_PREFIX.'mod_concert_settings` ('
	. ' `page_id` INT NOT NULL DEFAULT \'0\','
	. ' `section_id` INT NOT NULL DEFAULT \'0\','
	. ' `header_data` VARCHAR(128) NOT NULL DEFAULT \'\' ,'
	. ' `footer_data` VARCHAR(128) NOT NULL DEFAULT \'\' ,'
	. ' `ccloop` TEXT NOT NULL DEFAULT \'\' ,'
	. ' `detailed_view` INT NOT NULL DEFAULT \'1\','
	. ' `upcoming_view` INT NOT NULL DEFAULT \'1\','
	. ' `previous_view` INT NOT NULL DEFAULT \'1\','
	. ' `previous_num` INT NOT NULL DEFAULT \'10\','
	. ' `upcoming_num` INT NOT NULL DEFAULT \'10\','
	. ' `dateview` INT NOT NULL DEFAULT \'0\','
	. ' `date_link` INT NOT NULL DEFAULT \'0\','
	. ' `toggle` INT NOT NULL DEFAULT \'1\','
	. ' PRIMARY KEY  (`section_id`)'
	. ' );';
$database->query($mod_concert);

// Create table for events
$database->query('DROP TABLE IF EXISTS `'.TABLE_PREFIX.'mod_concert_dates`');
$mod_concert = 'CREATE TABLE `'.TABLE_PREFIX.'mod_concert_dates` ('
	. '`page_id` INT NOT NULL DEFAULT \'0\','
	. '`section_id` INT NOT NULL DEFAULT \'0\','
	. '`concert_id` INT NOT NULL AUTO_INCREMENT ,'
	. '`concert_date` date NOT NULL,'
	. '`concert_head` varchar(255) NOT NULL DEFAULT \'\' ,'  
	. '`concert_name` varchar(255) NOT NULL DEFAULT \'\' ,'
	. '`concert_desc` TEXT NOT NULL ,'
	. '`concert_place` varchar(255) NOT NULL DEFAULT \'\' ,'
	. '`concert_club` varchar(255) NOT NULL DEFAULT \'\' ,'
	. '`concert_price` varchar(255) NOT NULL DEFAULT \'\' ,'
	. '`concert_time` varchar(255) NOT NULL DEFAULT \'\' ,'
	. 'PRIMARY KEY  (`concert_id`)'
	. ');';
$database->query($mod_concert);

// Insert info into the search table
// Module query info
$field_info = array();
$field_info['page_id'] = 'page_id';
$field_info['title'] = 'page_title';
$field_info['link'] = 'link';
$field_info['description'] = 'description';
$field_info['modified_when'] = 'modified_when';
$field_info['modified_by'] = 'modified_by';
$field_info = serialize($field_info);
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`, `value`, `extra`) VALUES ('module', 'concert', '$field_info')");
// Query start
$query_start_code = "SELECT [TP]pages.page_id, [TP]pages.page_title,	[TP]pages.link, [TP]pages.description, [TP]pages.modified_when, [TP]pages.modified_by	FROM [TP]mod_concert_settings, [TP]mod_concert_dates, [TP]pages WHERE ";
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`, `value`, `extra`) VALUES ('query_start', '$query_start_code', 'concert')");
// Query body
$query_body_code = "
[TP]pages.page_id = [TP]mod_concert_settings.page_id AND [TP]mod_concert_settings.header_data [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
[TP]pages.page_id = [TP]mod_concert_settings.page_id AND [TP]mod_concert_dates.bdesc [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
[TP]pages.page_id = [TP]mod_concert_settings.page_id AND [TP]mod_concert_dates.concert_desc [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
[TP]pages.page_id = [TP]mod_concert_settings.page_id AND [TP]mod_concert_dates.concert_place [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\' OR
[TP]pages.page_id = [TP]mod_concert_settings.page_id AND [TP]mod_concert_dates.concert_club [O] \'[W][STRING][W]\' AND [TP]pages.searching = \'1\'
";
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`, `value`, `extra`) VALUES ('query_body', '$query_body_code', 'concert')");
// Query end
$query_end_code = "";
$database->query("INSERT INTO `".TABLE_PREFIX."search` (`name`, `value`, `extra`) VALUES ('query_end', '$query_end_code', 'concert')");
// Insert blank row (there needs to be at least on row for the search to work
$database->query("INSERT INTO `".TABLE_PREFIX."mod_concert_settings` (`section_id`, `page_id`) VALUES ('0','0')");
$database->query("INSERT INTO `".TABLE_PREFIX."mod_concert_dates` (`section_id`, `page_id`) VALUES ('0','0')");

?>