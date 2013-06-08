<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if ( ! defined( 'NV_IS_MOD_ALBUMS' ) )
{
    die( 'Stop!!!' );
}

$page_title = $lang_module['album'];

if ( $aID > 0 and $vID > 0 )
{
    $time_set = $nv_Request->get_int( $module_name . '_view_' . $vID, 'session' );
    if ( empty( $time_set ) )
    {
        $nv_Request->set_Session( $module_name . '_view_' . $vID, NV_CURRENTTIME );
        $nv_Request->set_Session( $module_name . '_viewcat_' . $aID, NV_CURRENTTIME );
        $adb->updateVideoNumView( $vID );
        $adb->updateAlbumNumView( $aID );
    }
    $res = $adb->getVideo( $vID );
    if ( $db->sql_numrows( $res ) > 0 )
    {
        $rs = $db->sql_fetchrow( $res );
        $aID = $adb->getAlbumIDByPicID( $rs['pictureid'] );
        $aid = $db->sql_fetchrow( $aID );
        $rAbL = $adb->getAlbumsOBWExclAid( $aid['albumid'] );
        $numRAbL = $db->sql_numrows( $rAbL );
        
        $rVid = $adb->getAlbumImgsOBWExclvID( $aid['albumid'], $rs['pictureid'] );
        $numRVid = $db->sql_numrows( $rVid );
        
        if ( ! empty( $rs['path'] ) and file_exists( NV_UPLOADS_REAL_DIR . "/" . $module_name . $rs['path'] ) )
        {
            $rs['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $rs['path'];
        }
        if ( ! empty( $rs['vpath'] ) and file_exists( NV_UPLOADS_REAL_DIR . "/" . $module_name . $rs['vpath'] ) )
        {
            $rs['vpath'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $rs['vpath'];
        }
        
        $contents = call_user_func( "view", $rs, $rVid, $numRVid, $rAbL, $numRAbL );
    }
    else
    {
        nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );
    }
}
else
{
    if ( $aID > 0 )
    {
        $time_set = $nv_Request->get_int( $module_name . '_viewcat_' . $aID, 'session' );
        if ( empty( $time_set ) )
        {
            $nv_Request->set_Session( $module_name . '_viewcat_' . $aID, NV_CURRENTTIME );
            $adb->updateAlbumNumView( $aID );
        }
        $result = $adb->getAllActiveAlbumOBWByID( $aID );
    }
    else
    {
        $result = $adb->getAllActiveAlbumOBW();
    }
    
    if ( $db->sql_numrows( $result ) > 0 )
    {
        $albums = array();
        
        while ( $rs = $db->sql_fetchrow( $result ) )
        {
            $re = $adb->getAlbumImgsOBW( $rs['albumid'] );
            $listimg = array();
            
            while ( $rsp = $db->sql_fetchrow( $re ) )
            {
                $listimg[] = array( 
                    'pictureid' => $rsp['pictureid'], 'name' => $rsp['name'], 'alias' => $rsp['alias'], 'path' => $rsp['path'], 'description' => $rsp['description'], 'num_view' => $rsp['num_view'], 'thumb_name' => $rsp['thumb_name'] 
                );
            }
            
            $albums[] = array( 
                'albumid' => $rs['albumid'], 'name' => $rs['name'], 'description' => $rs['description'], 'createddate' => $rs['createddate'], 'num_photo' => $rs['num_photo'], 'path_img' => $rs['path_img'], 'num_view' => $rs['num_view'], 'alias' => $rs['alias'], 'listimg' => $listimg 
            );
        }
        
        $contents = call_user_func( "main", $albums );
    
    }
    else
    {
        nv_info_die( $lang_global['error_404_title'], $lang_global['error_404_title'], $lang_global['error_404_content'] );
    }
}
include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_site_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
?>