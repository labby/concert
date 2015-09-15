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

// Include admin wrapper script
require(LEPTON_PATH.'/modules/admin.php');

// include core functions to edit the optional module CSS files (frontend.css, backend.css)
include_once(LEPTON_PATH .'/framework/summary.module_edit_css.php');

/** ******************
 *	Load Language file
 */
$lang = (dirname(__FILE__))."/languages/". LANGUAGE .".php";
require_once ( !file_exists($lang) ? (dirname(__FILE__))."/languages/EN.php" : $lang );

$query_page_content = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_concert_settings` WHERE `section_id` = '$section_id'");
$fetch_page_content = $query_page_content->fetchRow( MYSQL_ASSOC );

$ccheader = stripslashes($fetch_page_content['header_data']);
$ccfooter = stripslashes($fetch_page_content['footer_data']);
$ccloop = stripslashes($fetch_page_content['ccloop']);

?>

<h2><?php echo $MOD_CONCERT['SETTINGS']; ?></h2>
<?php
// include the button to edit the optional module CSS files
// Note: CSS styles for the button are defined in backend.css (div class="mod_moduledirectory_edit_css")
// Place this call outside of any <form></form> construct!!!
if(function_exists('edit_module_css')) {
	edit_module_css('concert');
}
?>

<form id="cal_edit" name="edit" action="<?php echo LEPTON_URL; ?>/modules/concert/save_set.php" method="post">
	<input type="hidden" name="page_id" value="<?php echo $page_id; ?>">
	<input type="hidden" name="section_id" value="<?php echo $section_id; ?>">

<table class="cal">
	<tr>
		<td class="cal_left">
		
		</td>
		<td class="cal_right">
			<input type="hidden" name="detailed_view" value="0" />
			<input type="checkbox" name="detailed_view" id="detailed_view1" value="1" <?php if($fetch_page_content['detailed_view'] == "1") { echo "checked"; } ?> />
			&nbsp;<label for="detailed_view1"><?php echo $MOD_CONCERT['DISPDETAILEDVIEW']; ?><label>
		</td>
	</tr>
	<tr>
		<td class="cal_left">
			
		</td>
		<td class="cal_right">
			<input type="hidden" name="upcoming_view" value="0" />
			<input type="checkbox" name="upcoming_view" id="upcoming_view1" value="1" <?php if($fetch_page_content['upcoming_view'] == "1") { echo "checked"; } ?> />
			&nbsp;<label for="upcoming_view1"><?php echo $MOD_CONCERT['DISPUPCOMINGVIEW']; ?><label>
		</td>
	</tr>
    <tr>
		<td class="cal_left">
			<?php echo $MOD_CONCERT['UPCOMINGNUM']; ?> :
		</td>
		<td class="cal_right">
			<input type="text" name="upcoming_num" id="upcoming_num" value="<?php echo $fetch_page_content['upcoming_num']; ?>" />
		</td>
	</tr>
	<tr>
		<td class="cal_left">
			
		</td>
        <td class="cal_right">
			<input type="hidden" name="previous_view" value="0" />
			<input type="checkbox" name="previous_view" id="previous_view1" value="1" <?php if($fetch_page_content['previous_view'] == "1") { echo "checked"; } ?> />
			&nbsp;<label for="previous_view1"><?php echo $MOD_CONCERT['DISPPREVIOUSVIEW']; ?><label>
		</td>
	</tr>
    <tr>
		<td class="cal_left">
			<?php echo $MOD_CONCERT['PREVIOUSNUM']; ?> :
		</td>
		<td class="cal_right">
			<input type="text" name="previous_num" id="previous_num" value="<?php echo $fetch_page_content['previous_num']; ?>" />
		</td>
	</tr>
	<tr>
		<td class="cal_left">
			<?php echo $TEXT['DATE_FORMAT']; ?> :
		</td>
		<td class="cal_right">
			<select name="dateview_form">
			<option value ="0" <?php if ($fetch_page_content['dateview'] == 0) { echo "selected"; } ?> ><?php echo $MOD_CONCERT['YEAR']."-".$MOD_CONCERT['MONTH']."-".$MOD_CONCERT['DAY']; ?></option>
			<option value ="1" <?php if ($fetch_page_content['dateview'] == 1) { echo "selected"; } ?> ><?php echo $MOD_CONCERT['DAY'].".".$MOD_CONCERT['MONTH'].".".$MOD_CONCERT['YEAR']; ?></option>
			<option value ="2" <?php if ($fetch_page_content['dateview'] == 2) { echo "selected"; } ?> ><?php echo $MOD_CONCERT['MONTH']."-".$MOD_CONCERT['DAY']."-".$MOD_CONCERT['YEAR']; ?></option>
			</select>            
		</td>
	</tr>
    <tr>
    	<td class="cal_left">
    	
    	</td>
        <td class="cal_right">
			<input type="hidden" name="date_link" value="0" />
			<input type="checkbox" name="date_link" id="date_link1" value="1" <?php if($fetch_page_content['date_link'] == "1") { echo "checked"; } ?> />
			&nbsp;<label for="date_link1"><?php echo $MOD_CONCERT['LINKDATE']; ?><label>
        </td>
    </tr>
    <tr>
    	<td class="cal_left">
    	
    	</td>
        <td class="cal_right">
			<input type="hidden" name="toggle" value="0" />
			<input type="checkbox" name="toggle" id="toggle1" value="1" <?php if($fetch_page_content['toggle'] == "1") { echo "checked"; } ?> />
			&nbsp;<label for="toggle1"><?php echo $MOD_CONCERT['TOGGLE']; ?><label>
			
        </td>
    </tr>
	<tr>
		<td class="cal_left">
			<?php echo $MOD_CONCERT['CCHEADER']; ?> :
		</td>
		<td class="cal_right">
			<textarea name="ccheader" style="width: 98%; height: 40px;"><?php echo $ccheader; ?></textarea>
		</td>
	</tr>
    <tr>
		<td class="cal_left">
			<?php echo $MOD_CONCERT['CCLOOP']; ?> :
		</td>
		<td class="cal_right">
			<textarea name="ccloop" style="width: 98%; height: 40px;"><?php echo $ccloop; ?></textarea>
			<?php echo $MOD_CONCERT['TO_USE']; ?>: [NAME], [DATE], [HEAD], [PLACE], [CLUB], [TIME], [PRICE], [INFO]
		</td>
	</tr>
	<tr>
		<td class="cal_left">
			<?php echo $MOD_CONCERT['CCFOOTER']; ?> :
		</td>
		<td class="cal_right">
			<textarea name="ccfooter" style="width: 98%; height: 40px;"><?php echo $ccfooter; ?></textarea>
		</td>
	</tr>
</table>

<table cellpadding="0" cellspacing="0" border="0" width="100%">
	<tr>
		<td align="left">
			<input name="save" type="submit" value="<?php echo $TEXT['SAVE']; ?>" style="width: 100px; margin-top: 5px;">
		</td>
		<td align="right">
			<input type="button" class="cancel" value="<?php echo $TEXT['CANCEL']; ?>" onclick="javascript: window.location = '<?php echo ADMIN_URL; ?>/pages/modify.php?page_id=<?php echo $page_id; ?>';" style="width: 100px; margin-top: 5px;" />
		</td>
	</tr>
</table>
</form>

<?php

// Print admin footer
$admin->print_footer();

?>