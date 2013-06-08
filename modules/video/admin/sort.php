<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES., JSC (contact@vinades.vn)
 * @Copyright (c) 2010 VINADES ., JSC. All rights reserved
 * @Createdate Aug 6, 2010 4:12:19 PM
 */

$new = $nv_Request->get_int('new', 'post', 0);
$old = $nv_Request->get_int('old', 'post', 0);

$adb = new albumdb();

if($old != $new)
{
	$adb->changeABWeight($old, 0);

	if($old < $new)
	{
		for($i = $old; $i < $new; $i++)
		{
			$adb->changeABWeight($i + 1, $i);
		}
	}
	else
	{
		for($i = $old; $i > $new; $i--)
		{
			$adb->changeABWeight($i - 1, $i);
		}
	}

	$adb->changeABWeight(0, $new);
}

echo $lang_module['update_success'];
?>