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

$module_description = 'Mit diesem Modul k&ouml;nnen Sie einen einfachen Konzertkalender in ihre Seite integrieren.';


// Other text
$MOD_CONCERT['ARCHIVE'] = '&nbsp Archiv &nbsp';
$MOD_CONCERT['BACK'] = 'Zur&uuml;ck';
$MOD_CONCERT['ARCHIVE_EMPTY'] = 'Keine Eintr&auml;ge im Archiv';
$MOD_CONCERT['DETAILED_VIEW'] = 'Spiel-Details vom';
$MOD_CONCERT['BACK_TO_CURRENT'] = '&nbsp Zum n&auml;chsten anstehenden Spiel &nbsp';
$MOD_CONCERT['NO_ENTRY'] = 'Kein Eintrag';
$MOD_CONCERT['UPCOMING_CONCERTS'] = 'Anstehende Spiele';
$MOD_CONCERT['PREVIOUS_CONCERTS'] = 'Fr&uuml;here Spiele';
$MOD_CONCERT['NEXTCONCERT'] = 'N&auml;chster Termin ist am';
$MOD_CONCERT['NOTHING_ARRANGED'] = 'Nichts ist geplant';

// Admin
$MOD_CONCERT['CONCERT'] = 'Termin im';
$MOD_CONCERT['INSERTDATE'] = 'Datum eingeben';
$MOD_CONCERT['ENTER_NAME'] = 'Spiel eingeben';
$MOD_CONCERT['ENTER_HEAD'] = 'Liga eingeben';
$MOD_CONCERT['ENTER_PLACE'] = 'Ort';
$MOD_CONCERT['ENTER_CLUB'] = 'Halle';
$MOD_CONCERT['ENTER_TIME'] = 'Uhrzeit';
$MOD_CONCERT['ENTER_PRICE'] = 'Eintritt';
$MOD_CONCERT['DAY'] = 'Tag';
$MOD_CONCERT['MONTH'] = 'Monat';
$MOD_CONCERT['YEAR'] = 'Jahr';
$MOD_CONCERT['CONCERTS'] = 'Spiele';
$MOD_CONCERT['SETTINGS'] = 'Spielkalender Einstellungen';
$MOD_CONCERT['CCHEADER'] = 'Kopfzeile';
$MOD_CONCERT['CCFOOTER'] = 'Fu&szlig;zeile';
$MOD_CONCERT['CCLOOP'] = 'Inhalt-Schleife';
$MOD_CONCERT['TO_USE'] = 'M&ouml;gliche Platzhalter';
$MOD_CONCERT['DISPDETAILEDVIEW'] = 'Spiele detailiert anzeigen';
$MOD_CONCERT['DISPUPCOMINGVIEW'] = 'Anstehende Spiele anzeigen';
$MOD_CONCERT['DISPPREVIOUSVIEW'] = 'Fr&uuml;here Spiele anzeigen';
$MOD_CONCERT['UPCOMINGNUM'] = 'Anzahl anstehender Spiele zeigen';
$MOD_CONCERT['PREVIOUSNUM'] = 'Anzahl fr&uuml;here Spiele zeigen';
$MOD_CONCERT['ENTERCONCERT_LONGDESC'] = 'Beschreibung eingeben';
$MOD_CONCERT['ADDCONCERT'] = 'Spiel hinzuf&uuml;gen';
$MOD_CONCERT['LINKDATE'] = 'Datum verlinken';
$MOD_CONCERT['TOGGLE'] = '"Ausklapp"-funktion';
//----------------------------
?>