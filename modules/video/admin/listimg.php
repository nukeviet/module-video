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

$page_title = $lang_module['list_img_title'];
$idb = $nv_Request->get_int('idb', 'get', 0);

$adb = new albumdb();

$xtpl = new XTemplate("listimg.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_name);
$xtpl->assign('LANG', $lang_module);
$xtpl->assign('LINK_ADD', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=add_img&idb=" . $idb);
$xtpl->assign('URL_DEL_BACK', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg");
$xtpl->assign('URL_DEL', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=del_limgs");
$xtpl->assign('URL_RE', "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg&idb=");

$result = $adb->getAllalbums();

$i = 0;
while($rs = $db->sql_fetchrow($result))
{
	if($i == 0 && $idb == 0)
	{
		$idb = $rs['albumid'];
	}

	$xtpl->assign('id', $rs['albumid']);
	$xtpl->assign('name', $rs['name']);
	$select = ($idb == $rs['albumid']) ? "selected=\"selected\"" : "";
	$xtpl->assign('SELECT', $select);

	$xtpl->parse('main.albums');

	$i++;
}

$link_del_one = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=del_imgs";
$link_edit = "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=add_img";
$per_page = 20;
$page = $nv_Request->get_int('page', 'get', 0);

$result = $adb->getAlbumImgsOBW($idb);
$numcat = $db->sql_numrows($result);

$all_page = ($numcat > 1) ? $numcat : 1;
$base_url = NV_BASE_ADMINURL . "?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg&bid=" . $idb;

$albumimg = array();

$num = $numcat;

$xtpl->assign('NV_BASE_SITE', NV_BASE_SITEURL);

$i = 0;
while($rs = $db->sql_fetchrow($result))
{
	$xtpl->assign('id', $rs['pictureid']);
	$xtpl->assign('name', $rs['name']);
	$class = ($i % 2) ? " class=\"second\"" : "";
	$xtpl->assign('class', $class);

	if(!nv_is_url($rs['thumb_name']) && $rs['thumb_name'] != "")
	{
		$rs['thumb_name'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $rs['thumb_name'];
		$rs['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $rs['path'];
	}
	else
	{
		$rs['thumb_name'] = NV_BASE_SITEURL . "themes/" . $global_config['site_theme'] . "/images/" . $module_name . "/no_image.gif";
	}

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

	$xtpl->assign('SRC', $rs['thumb_name']);
	$xtpl->assign('SRC_LAGE', $rs['path']);
	$xtpl->assign('URL_DEL_ONE', $link_del_one . "&id=" . $rs['pictureid']);
	$xtpl->assign('URL_EDIT', $link_edit . "&id=" . $rs['pictureid']);
	$xtpl->parse('main.row');
	$i++;
}

$list_pages = nv_generate_page($base_url, $all_page, $per_page, $page);
$xtpl->assign('PAGES', $list_pages);
$xtpl->parse('main');
$contents = $xtpl->text('main');

include (NV_ROOTDIR . "/includes/header.php");
echo nv_admin_theme($contents);
include (NV_ROOTDIR . "/includes/footer.php");

?>