<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */

if(!defined('NV_ADMIN') or !defined('NV_MAINFILE') or !defined('NV_IS_MODADMIN'))
{
	die('Stop!!!');
}

$submenu['add_ab'] = $lang_module['add_album'];
$submenu['listimg'] = $lang_module['list_img_tiltle'];
$submenu['add_img'] = $lang_module['add_pic'];
$allow_func = array('main', 'add_ab', 'add_img', 'sort_img', 'del_albums', 'del_lalbums', 'listimg', 'del_imgs', 'del_limgs', 'active', 'sort');

define('NV_IS_ALBUMS_ADMIN', true);

require_once NV_ROOTDIR . "/modules/" . $module_name . '/albumdb.php';
?>