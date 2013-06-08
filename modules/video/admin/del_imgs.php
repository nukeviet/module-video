<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-9-2010 14:43
 */
if(!defined('NV_IS_ALBUMS_ADMIN'))
{
	die('Stop!!!');
}

$id = $nv_Request->get_int('id', 'post,get');
$result = false;

$adb = new albumdb();

if($id)
{
	$aID = $adb->getAlbumIDByPicID($id);
	$aid = $db->sql_fetchrow($aID);

	$num = $db->sql_numrows($adb->getAlbumImgsOBW($aid['albumid']));

	$result = $adb->deletePictrueByID($id);

	if($result)
	{
		$result = $adb->updateAlbumPicsNum($aid['albumid'], intval($num - 1));
	}

	$albs = $adb->getAlbumImgsOBW($aid['albumid']);

	$i = 1;
	while($ab = $db->sql_fetchrow($albs))
	{
		$adb->chageImgWByID($ab['pictureid'], $i);

		$i++;
	}
}

if($result)
{
	echo $lang_module['delalbum_success'];
}
else
{
	echo $lang_module['delalbum_error'];
}
?>