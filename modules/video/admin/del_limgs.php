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

$listall = $nv_Request->get_string('listall', 'post,get');
$array_id = explode(',', $listall);
$array_id = array_map("intval", $array_id);
$result = false;

$adb = new albumdb();

foreach($array_id as $id)
{
	if($id > 0)
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