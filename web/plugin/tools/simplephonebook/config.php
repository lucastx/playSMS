<?php defined('_SECURE_') or die('Forbidden'); ?>
<?php

$simplephonebook_icon_export = "<img src=\"".$http_path['themes']."/".$themes_module."/images/export.gif\" alt=\""._('Export')."\" title=\""._('Export')."\" border=0>";
$simplephonebook_icon_import = "<img src=\"".$http_path['themes']."/".$themes_module."/images/import.gif\" alt=\""._('Import')."\" title=\""._('Import')."\" border=0>";
$simplephonebook_icon_publish = "<img src=\"".$http_path['themes']."/".$themes_module."/images/publicphonebook.gif\" alt=\""._('Publish')."\" title=\""._('Publish')."\" border=0>";
$simplephonebook_icon_unpublish = "<img src=\"".$http_path['themes']."/".$themes_module."/images/unpublicphonebook.gif\" alt=\""._('Unpublish')."\" title=\""._('Unpublish')."\" border=0>";

$menutab_tools = $core_config['menutab']['tools'];
$arr_menu[$menutab_tools][] = array("index.php?app=menu&inc=tools_simplephonebook&op=simplephonebook_list", _('Phonebook'));
?>