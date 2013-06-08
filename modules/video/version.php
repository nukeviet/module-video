<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 2-10-2010 20:59
 */

if(!defined('NV_ADMIN') or !defined('NV_MAINFILE'))
{
	die('Stop!!!');
}

$module_version = array("name"=>"Video", //
"modfuncs"=>"main", //
"is_sysmod"=>0, //
"virtual"=>0, //
"version"=>"3.0.01", //
"date"=>"Tue, 13 July 2010 06:03:36 GMT", //
"author"=>"VINADES.,JSC (contact@vinades.vn)", //
"note"=>"", "uploads_dir"=>array($module_name, $module_name . "/vid", $module_name . "/", $module_name . "/thumb", $module_name . "/tmp"));

?>