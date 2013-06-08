<?php

/**
 * @Project NUKEVIET 3.0
 * @Author VINADES.,JSC (contact@vinades.vn)
 * @Copyright (C) 2010 VINADES.,JSC. All rights reserved
 * @Createdate 7-17-2010 14:43
 */

if ( ! defined( 'NV_IS_ALBUMS_ADMIN' ) )
{
    die( 'Stop!!!' );
}

$id = $nv_Request->get_int( 'id', 'get', 0 );

if ( $id == 0 ) $page_title = $lang_module['add_album'];
else $page_title = $lang_module['edit_album'];

$xtpl = new XTemplate( "add.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_name );

$add = 0;
$error = "";
$data = array();
$data['active'] = "1";

$adb = new albumdb();

if ( $id != 0 )
{
    $result = $adb->getAllAlbumCotent( $id );
    $data = $db->sql_fetchrow( $result );
    
    if ( ! empty( $data['path_img'] ) and file_exists( NV_UPLOADS_REAL_DIR . "/" . $module_name . $data['path_img'] ) )
    {
        $data['path_img'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $data['path_img'];
    }
}
if ( $nv_Request->get_int( 'add', 'post' ) == 1 )
{
    $data['name'] = filter_text_input( 'name', 'post', '', 1 );
    $alias = change_alias( $data['name'] );
    $data['description'] = filter_text_textarea( 'description', '', NV_ALLOWED_HTML_TAGS );
    $data['path_img'] = filter_text_input( 'pic_path', 'post', '', 0 );
    $data['active'] = filter_text_input( 'active', 'post', '0', 0 );
    
    if ( ! nv_is_url( $data['path_img'] ) and is_file( NV_DOCUMENT_ROOT . $data['path_img'] ) )
    {
        $lu = nv_strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name );
        $data['path_img'] = substr( $data['path_img'], $lu );
    }
    elseif ( ! empty( $data['path_img'] ) and ! nv_is_url( $data['path_img'] ) )
    {
        $data['path_img'] = "";
        $error = $lang_module['wrong_path'];
    }
    
    if ( empty( $data['name'] ) )
    {
        $error = $lang_module['err_null_name'];
    }
    elseif ( empty( $error ) )
    {
        if ( $id == 0 )
        {
            $num_ab = $db->sql_numrows( $adb->getAllalbums() );
            
            if ( $adb->addNewAlbum( $num_ab + 1, $data['name'], $data['description'], $data['path_img'], $alias, $data['active'] ) )
            {
                $adb->freeResult();
                Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "" );
                die();
            }
            else
            {
                $error = $lang_module['err_save'];
            }
        }
        else
        {
            if ( $adb->updatealbum( $id, $data['name'], $data['description'], $data['path_img'], $alias, $data['active'] ) )
            {
                $adb->freeResult();
                Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "" );
                die();
            }
            else
            {
                $error = $lang_module['err_save'];
            }
        }
    }
}

if ( $error != "" )
{
    $xtpl->assign( 'ERR', $error );
    $xtpl->parse( 'main.err' );
}
$xtpl->assign( 'PATH', NV_UPLOADS_DIR . '/' . $module_name );
$xtpl->assign( 'BROWSER', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=upload&popup=1&area=" + area+"&path="+path+"&type="+type, "NVImg", "850", "400","resizable=no,scrollbars=no,toolbar=no,location=no,status=no' );
$xtpl->assign( 'LANG', $lang_module );
$xtpl->assign( 'NV_NAME', NV_NAME_VARIABLE );
$xtpl->assign( 'NV_OP', NV_OP_VARIABLE );
$xtpl->assign( 'MOD_NAME', $module_name );
$xtpl->assign( 'OP', $op );
$xtpl->assign( 'DATA', $data );
$check = ( $data['active'] == "1" ) ? "checked=\"checked\"" : "";
$xtpl->assign( 'CKECK', $check );
$xtpl->assign( 'DATA', $data );

if ( ! empty( $data['path_img'] ) )
{
    $xtpl->assign( 'IMGS', $data['path_img'] );
    $xtpl->parse( 'main.img' );
}
$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
?>