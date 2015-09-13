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

$base = "/modules/concert/";
$files_to_register = array(
	$base.'add.php',
	$base.'add_concert.php',
	$base.'change_concert.php',
	$base.'delete.php',
	$base.'delete_concert.php',	
	$base.'modify.php',
	$base.'modify_settings.php',
	$base.'save_concert.php',
	$base.'save_set.php'
);

$lepton_filemanager->register( $files_to_register );

?>