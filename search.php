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

function concert_search($func_vars) {
	extract($func_vars, EXTR_PREFIX_ALL, 'func');

	// how many lines of excerpt we want to have at most
	$max_excerpt_num = $func_default_max_excerpt;
	$divider = ".";
	$result = false;
	
	// fetch all concert-items from this section
	$table = TABLE_PREFIX."mod_concert_dates";
	$query = $func_database->query("
		SELECT concert_date, concert_desc, concert_name
		FROM $table
		WHERE section_id='$func_section_id'
		ORDER BY concert_date DESC
	");

	if($query->numRows() > 0) {
		while($res = $query->fetchRow()) {
			// the target have to be e.g. &monthno=5&year=2007
			list($year, $month, $day) = explode("-", $res['concert_date']);
			// $year==2000 means _every_ year
			if($year==2000) {
				$year=date("Y");
			}
			//convert date-format
			$timestamp = strtotime("$year-$month-$day");
			if($timestamp>0) { // just to be sure
				$date = date(DATE_FORMAT, $timestamp);
			} else {
				$date = $res['concert_date'];
			}
			$mod_vars = array(
				'page_link' => $func_page_link,
				'page_link_target' => "&monthno=".$month."&year=".$year,
				'page_title' => $func_page_title,
				'page_description' => "{$res['concert_desc']} ($date)", // use concert-title and date as description
				'page_modified_when' => $func_page_modified_when,
				'page_modified_by' => $func_page_modified_by,
				'text' => $res['concert_name'].$divider.$res['concert_desc'].$divider.$res['concert_date'].$divider,
				'max_excerpt_num' => $max_excerpt_num
			);
			if(print_excerpt2($mod_vars, $func_vars)) {
				$result = true;
			}
		}
	}
	return $result;
}

?>