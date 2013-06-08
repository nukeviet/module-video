<?php

/**
* @Project NUKEVIET 3.0
* @Author VINADES., JSC (contact@vinades.vn)
* @Copyright (c) 2010 VINADES ., JSC. All rights reserved
* @Createdate Aug 9, 2010 2:09:19 PM
*/


$new = $nv_Request->get_int('new', 'post', 0);
$old = $nv_Request->get_int('old', 'post', 0);
$aid = $nv_Request->get_int('aid', 'post', 0);

$adb = new albumdb();

if($old != $new)
{
	$adb->changeImgW($old, 0, $aid);

	if($old < $new)
	{
		for($i = $old; $i < $new; $i++)
		{
			$adb->changeImgW($i + 1, $i, $aid);
		}
	}
	else
	{
		for($i = $old; $i > $new; $i--)
		{
			$adb->changeImgW($i - 1, $i, $aid);
		}
	}

	$adb->changeImgW(0, $new, $aid);
}

echo $lang_module['update_success'];
?>