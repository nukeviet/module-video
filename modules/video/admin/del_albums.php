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

$result = false;
$id = $nv_Request->get_int('id', 'post,get');

$adb = new albumdb();

if($id > 0)
{
	$result = $adb->deleteAlbumByID($id);
	$result = $adb->deletePicturesByAlbumID($id);
}

$num = $db->sql_numrows($adb->getAllalbums());

$albs = $adb->getAllAlbumOBW();

$i = 1;
while($ab = $db->sql_fetchrow($albs))
{
	$adb->changeABWeightByID($ab['albumid'], $i);

	$i++;
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