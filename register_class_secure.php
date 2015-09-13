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

global $lepton_filemanager;
if (!is_object($lepton_filemanager)) require_once( "../../framework/class.lepton.filemanager.php" );

$basename = "/modules/download_gallery/";
$files_to_register = array(
	$basename.'add.php',
	$basename.'add_concert.php',
	$basename.'change_concert.php',
	$basename.'delete.php',
	$basename.'delete_concert.php',	
	$basename.'modify.php',
	$basename.'modify_settings.php',
	$basename.'save_concerts.php',
	$basename.'save_set.php'
);

$lepton_filemanager->register( $files_to_register );

?>