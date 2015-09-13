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

// check if module language file exists for the language set by the user (e.g. DE, EN)
if(!file_exists(LEPTON_PATH .'/modules/concert/languages/'.LANGUAGE .'.php')) {
	// no module language file exists for the language set by the user, include default module language file EN.php
	require_once(LEPTON_PATH .'/modules/concert/languages/EN.php');
} else {
	// a module language file exists for the language defined by the user, load it
	require_once(LEPTON_PATH .'/modules/concert/languages/'.LANGUAGE .'.php');
}

//removes empty events from the table so they will not be displayed
$database->query("DELETE FROM `".TABLE_PREFIX."mod_concert_dates` WHERE `page_id` = '$page_id' and `section_id` = '$section_id' and `concert_desc`=''");

$query_page_content = $database->query("SELECT * FROM `".TABLE_PREFIX."pages` WHERE `page_id` = '$page_id'");
$fetch_page_content = $query_page_content->fetchRow();
$page_created = $fetch_page_content['link'];

$query_page_content = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_concert_settings` WHERE `section_id` = '$section_id'");
$fetch_page_content = $query_page_content->fetchRow();
$dateview = $fetch_page_content['dateview'];

?>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
	<td align="left" width="50%">
		<input type="button" value="<?php echo $MOD_CONCERT['ADDCONCERT']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/concert/add_concert.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
	<td align="right" width="50%">
		<input type="button" value="<?php echo $TEXT['SETTINGS']; ?>" onclick="javascript: window.location = '<?php echo LEPTON_URL; ?>/modules/concert/modify_settings.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>';" style="width: 100%;" />
	</td>
</tr>
</table>

<br />

<h2><?php echo $MOD_CONCERT['CONCERTS'] ?></h2>
<?php

$query_dates = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_concert_dates` WHERE `section_id` = '$section_id' ORDER BY concert_date");
if ($query_dates->numRows() > 0) {
	$row = 'a';
	?>
	<table cellpadding="2" cellspacing="0" border="0" width="100%">
	<?php
	while( $result = $query_dates->fetchRow() ) {
		$alt2date=$result['concert_date'];
		
		list($a2year, $a2month, $a2day) = explode('-', $alt2date);
		
		$ydash="-";
		$ydot=".";
		if ($a2year=="2000"){
			$a2year="";
			$alt2date=substr($alt2date,5,5);
			$ydash="";
			$ydot="";
		}
		if ($dateview == 1 ) { 
			$altdate=$a2day.".".$a2month.$ydot.$a2year;
		} elseif ($dateview == 2 ) { 
			$altdate=$a2month."-".$a2day.$ydash.$a2year;
		} else {
			$altdate=$alt2date;
		}
		?>
		<tr class="row_<?php echo $row; ?>" height="20">
			<td align="left" style="padding-left: 5px;">
				<a href="<?php echo LEPTON_URL; ?>/modules/concert/change_concert.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&concert_id=<?php echo $result['concert_id']; ?>" title="<?php echo $TEXT['MODIFY']; ?>"><img src="<?php echo THEME_URL; ?>/images/modify_16.png" border="0" alt="<?php echo $TEXT['MODIFY']; ?>" /></a>
			</td>	
			<td align="left" style="padding-left: 5px;">
				<?php echo $altdate ?>
			</td>
			<td align="left" style="padding-left: 5px;">	
				<?php echo $result['concert_head']  ?>
			</td>      
			<td align="left" style="padding-left: 5px;">	
				<?php echo $result['concert_name']  ?>
			</td>
			<td align="left" style="padding-left: 5px;">
				<?php echo $result['concert_club'];	?>
			</td>
			<td align="right" style="padding-right: 5px; padding-left: 5px;" >
				<a href="javascript: confirm_link('<?php echo $TEXT['ARE_YOU_SURE']; ?>', '<?php echo LEPTON_URL; ?>/modules/concert/delete_concert.php?page_id=<?php echo $page_id; ?>&section_id=<?php echo $section_id; ?>&concert_id=<?php echo $result['concert_id']; ?>');" title="<?php echo $TEXT['DELETE']; ?>"><img src="<?php echo THEME_URL; ?>/images/delete_16.png" border="0" alt="<?php echo $TEXT['DELETE']; ?>" /></a>
			</td>
		</tr>
		<?php
		// Alternate row color
		if($row == 'a') {
			$row = 'b';
		} else {
			$row = 'a';
		}
	} 
} else {
	echo $TEXT['NONE_FOUND'];
}
?>
</table>