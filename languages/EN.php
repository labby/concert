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

$module_description = 'This module allows you to integrate a simple calender for concerts into your site.';


// Other text
$MOD_CONCERT['ARCHIVE'] = 'Archive';
$MOD_CONCERT['BACK'] = 'Back';
$MOD_CONCERT['ARCHIVE_EMPTY'] = 'no entries in the archive available';
$MOD_CONCERT['DETAILED_VIEW'] = 'Details on';
$MOD_CONCERT['BACK_TO_CURRENT'] = 'Next upcoming concert';
$MOD_CONCERT['LINKS'] = 'Permalinks in the article:';
$MOD_CONCERT['NO_ENTRY'] = 'No entry';
$MOD_CONCERT['UPCOMING_CONCERTS'] = 'Upcoming concerts';
$MOD_CONCERT['PREVIOUS_CONCERTS'] = 'previous concerts';
$MOD_CONCERT['NEXTCONCERT'] = 'Next concert is on';
$MOD_CONCERT['NOTHING_ARRANGED'] = 'Nothing arranged';

// Admin
$MOD_CONCERT['CONCERT'] = 'Concerts in';
$MOD_CONCERT['INSERTDATE'] = 'Enter date';
$MOD_CONCERT['ENTER_HEAD'] = 'Enter concerthead';
$MOD_CONCERT['ENTER_NAME'] = 'Enter concertname';
$MOD_CONCERT['ENTER_PLACE'] = 'Place';
$MOD_CONCERT['ENTER_CLUB'] = 'Club';
$MOD_CONCERT['ENTER_TIME'] = 'Time';
$MOD_CONCERT['ENTER_PRICE'] = 'Price';
$MOD_CONCERT['DAY'] = 'Day';
$MOD_CONCERT['MONTH'] = 'Month';
$MOD_CONCERT['YEAR'] = 'Year';
$MOD_CONCERT['CONCERTS'] = 'Concerts';
$MOD_CONCERT['SETTINGS'] = 'Concert calendar settings';
$MOD_CONCERT['CCHEADER'] = 'Header';
$MOD_CONCERT['CCFOOTER'] = 'Footer';
$MOD_CONCERT['CCLOOP'] = 'Content-loop';
$MOD_CONCERT['TO_USE'] = 'possible placeholder';
$MOD_CONCERT['DISPDETAILEDVIEW'] = 'Show detailed view of concerts';
$MOD_CONCERT['DISPUPCOMINGVIEW'] = 'Show upcoming concerts';
$MOD_CONCERT['DISPPREVIOUSVIEW'] = 'Show previous concerts';
$MOD_CONCERT['UPCOMINGNUM'] = 'Number of upcoming events';
$MOD_CONCERT['PREVIOUSNUM'] = 'Number of previous events';
$MOD_CONCERT['ENTERCONCERT_LONGDESC'] = 'Enter description';
$MOD_CONCERT['ADDCONCERT'] = 'Add concert';
$MOD_CONCERT['LINKDATE'] = 'Link date';
$MOD_CONCERT['TOGGLE'] = '"Toggle-function';
//----------------------------
?>