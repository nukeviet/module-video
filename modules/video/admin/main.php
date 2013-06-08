<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if(!defined('NV_IS_ALBUMS_ADMIN'))
{
	die('Stop!!!');
}

$page_title = $lang_module['main'];

$xtpl = new XTemplate("main.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_name);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('LINK_ADD', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=add_ab");
$xtpl->assign('URL_DEL_BACK', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name);
$xtpl->assign('URL_DEL', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=del_lalbums");

$abd = new albumdb();

$result = $abd->getAllAlbumOBW();
$num = $db->sql_numrows($result);

$link_del_one = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=del_albums";
$link_edit = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=add_ab";
$link_active = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=active&id=";
$link_album = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg&idb=";

$i = 0;
while($rs = $db->sql_fetchrow($result))
{
	$xtpl->assign('id', $rs['albumid']);
	$xtpl->assign('name', $rs['name']);

	$class = ($i % 2) ? " class=\"second\"" : "";
	$xtpl->assign('class', $class);
	$xtpl->assign('URL_DEL_ONE', $link_del_one . "&id=" . $rs['albumid']);
	$xtpl->assign('URL_EDIT', $link_edit . "&id=" . $rs['albumid']);
	$str_ac = ($rs['active'] == 1) ? $lang_module['active_yes'] : $lang_module['active_no'];
	$xtpl->assign('active', $str_ac);
	$xtpl->assign('URL_ACTIVE', $link_active . $rs['albumid']);
	$xtpl->assign('LINK_ALBUM', $link_album . $rs['albumid']);

	for($j = 0; $j < $num; $j++)
	{
		$xtpl->assign('VAL', $j + 1);

		if($j == $i)
		{
			$xtpl->assign('SELECT', 'selected="selected"');
		}
		else
		{
			$xtpl->assign('SELECT', '');
		}

		$xtpl->parse('main.row.sel.sel_op');
	}

	$xtpl->assign('SEL_W', $rs['weight']);
	$xtpl->parse('main.row.sel');
	$xtpl->parse('main.row');

	$i++;
}

$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");

?>