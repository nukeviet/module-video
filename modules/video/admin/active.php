<?php
/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if (! defined ( 'NV_IS_ALBUMS_ADMIN' )) {
	die ( 'Stop!!!' );
}
$id = $nv_Request->get_int ( 'id', 'get', 0 );
$adb = new albumdb ();
$ac = $adb->ActiveAlbum($id);
$str = ($ac == 1) ? $lang_module['active_yes'] : $lang_module['active_no'];
echo $lang_module['album_active_succer']. " \"". $str . " \"";
?>