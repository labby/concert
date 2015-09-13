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

$module_description = 'Deze module geeft een eenvoudig overzicht van optredens op de website die gegeven worden of reeds zijn geweest.';


// Other text
$MOD_CONCERT['ARCHIVE'] = 'Archief';
$MOD_CONCERT['BACK'] = 'Terug';
$MOD_CONCERT['ARCHIVE_EMPTY'] = 'Er staan nog geen optredens in het archief';
$MOD_CONCERT['DETAILED_VIEW'] = 'Details voor';
$MOD_CONCERT['BACK_TO_CURRENT'] = 'Terug naar het overzicht';
$MOD_CONCERT['NO_ENTRY'] = 'Geen optredens';
$MOD_CONCERT['UPCOMING_CONCERTS'] = 'Toekomstige optredens';
$MOD_CONCERT['PREVIOUS_CONCERTS'] = 'Gegegeven optredens';
$MOD_CONCERT['NEXTCONCERT'] = 'Volgende optreden';
$MOD_CONCERT['NOTHING_ARRANGED'] = 'Geen optredens';

// Admin
$MOD_CONCERT['CONCERT'] = 'Optreden';
$MOD_CONCERT['INSERTDATE'] = 'Datum optreden';
$MOD_CONCERT['ENTER_NAME'] = 'Naam van het optreden';
$MOD_CONCERT['ENTER_HEAD'] = 'Enter concerthead';
$MOD_CONCERT['ENTER_PLACE'] = 'Plaats';
$MOD_CONCERT['ENTER_CLUB'] = 'Zaal';
$MOD_CONCERT['ENTER_TIME'] = 'Aanvang';
$MOD_CONCERT['ENTER_PRICE'] = 'Toegangsprijs €';
$MOD_CONCERT['DAY'] = 'Dag';
$MOD_CONCERT['MONTH'] = 'Maand';
$MOD_CONCERT['YEAR'] = 'Jaar';
$MOD_CONCERT['CONCERTS'] = 'Optredens';
$MOD_CONCERT['SETTINGS'] = 'Instellingen optredens kalender';
$MOD_CONCERT['CCHEADER'] = 'Header';
$MOD_CONCERT['CCFOOTER'] = 'Footer';
$MOD_CONCERT['CCLOOP'] = 'Loop';
$MOD_CONCERT['TO_USE'] = 'Mogelijke variabelen';
$MOD_CONCERT['DISPDETAILEDVIEW'] = 'Weergeef details van optreden';
$MOD_CONCERT['DISPUPCOMINGVIEW'] = 'Weergeef aankomende optredens';
$MOD_CONCERT['DISPPREVIOUSVIEW'] = 'Weergeef gegeven optredens';
$MOD_CONCERT['UPCOMINGNUM'] = 'Aantal aankomende optredens weergeven';
$MOD_CONCERT['PREVIOUSNUM'] = 'Aantal gegeven optredens weergeven';
$MOD_CONCERT['ENTERCONCERT_LONGDESC'] = 'Voer beschrijving in';
$MOD_CONCERT['ADDCONCERT'] = 'Optreden toevoegen';
$MOD_CONCERT['LINKDATE'] = 'Linkdate';
$MOD_CONCERT['TOGGLE'] = 'Uitklappen';

//----------------------------
?>