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

if ( defined( 'NV_EDITOR' ) )
{
    require_once ( NV_ROOTDIR . '/' . NV_EDITORSDIR . '/' . NV_EDITOR . '/nv.php' );
}

$id = $nv_Request->get_int( 'id', 'get', 0 );

if ( $id == 0 )
{
    $page_title = $lang_module['add_pic'];
}
else
{
    $page_title = $lang_module['edit_pic'];
}

$error = "";

$xtpl = new XTemplate( "upload.tpl", NV_ROOTDIR . "/themes/" . $global_config['module_theme'] . "/modules/" . $module_name );

$adb = new albumdb();

$max_x = 120;
$max_y = 100;
$data = array();
$data['albumid'] = $nv_Request->get_int( 'idb', 'get', 0 );

if ( $id != 0 )
{
    $sql = "SELECT * FROM `" . NV_PREFIXLANG . "_" . $module_data . "_picture` WHERE pictureid = '" . $id . "'";
    $result = $db->sql_query( $sql );
    $data = $db->sql_fetchrow( $result );
    $data['v_path'] = $data['vpath'];
}

if ( $nv_Request->get_int( 'add', 'post' ) == 1 )
{
    $data['name'] = filter_text_input( 'name', 'post', '', 1 );
    $data['alias'] = change_alias( $data['name'] );
    $thumb_name = "";
    $data['albumid'] = $nv_Request->get_int( 'album', 'post' );
    $data['path'] = filter_text_input( 'pic_path', 'post', '', 0 );
    $data['v_path'] = filter_text_input( 'v_path', 'post', '', 0 );
    $data['description'] = filter_text_textarea( 'description', '', NV_ALLOWED_HTML_TAGS );
    
    if ( ! empty( $data['v_path'] ) and file_exists( NV_DOCUMENT_ROOT . $data['v_path'] ) )
    {
        $lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name );
        $data['v_path'] = substr( $data['v_path'], $lu );
    }
    elseif ( ! nv_is_url( $data['v_path'] ) and ! empty( $data['v_path'] ) )
    {
        $data['v_path'] = "";
    }
    
    if ( ! empty( $data['path'] ) and file_exists( NV_DOCUMENT_ROOT . $data['path'] ) )
    {
        $homeimgfile = NV_DOCUMENT_ROOT . $data['path'];
        require_once ( NV_ROOTDIR . "/includes/class/image.class.php" );
        $basename = basename( $homeimgfile );
        $image = new image( $homeimgfile, NV_MAX_WIDTH, NV_MAX_HEIGHT );
        $image->resizeXY( $max_x, $max_y );
        $image->save( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/thumb', $basename );
        $image_info = $image->create_Image_info;
        $image->close();
        $thumb_name = str_replace( NV_UPLOADS_REAL_DIR . '/' . $module_name . '/', '', $image_info['src'] );
        
        $lu = strlen( NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name );
        $data['path'] = substr( $data['path'], $lu );
    }
    elseif ( ! nv_is_url( $data['path'] ) and ! empty( $data['path'] ) )
    {
        $data['path'] = "";
    }
    
    if ( $data['albumid'] > 0 )
    {
        if ( empty( $data['name'] ) )
        {
            $error = $lang_module['err_null_name'];
        }
        else
        {
            if ( empty( $data['v_path'] ) )
            {
                $error = $lang_module['err_null_path'];
            }
            elseif ( empty( $error ) )
            {
                if ( $id == 0 )
                {
                    $num = $db->sql_numrows( $adb->getAlbumImgs( $data['albumid'] ) );
                    
                    if ( empty( $data['name'] ) )
                    {
                        list( $mo, $data['name'] ) = split( '[/.]', $data['path'] ); //
                    }
                    
                    if ( $adb->addNewImg( $data['name'], $data['alias'], $data['path'], nv_editor_nl2br( $data['description'] ), $thumb_name, $data['albumid'], $num + 1, $data['v_path'] ) )
                    {
                        $adb->update_numphoto( $data['albumid'] );
                        $adb->freeResult();
                        Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg&idb=" . $data['albumid'] );
                        die();
                    }
                    else
                    {
                        $error = $lang_module['err_save_img'];
                    }
                }
                else
                {
                    if ( $adb->updateImgInfo( $data['pictureid'], $data['name'], $data['alias'], $data['path'], nv_editor_nl2br( $data['description'] ), $thumb_name, $data['albumid'], $data['v_path'] ) )
                    {
                        $adb->update_numphoto( $data['albumid'] );
                        $adb->freeResult();
                        Header( "Location: " . NV_BASE_ADMINURL . "index.php?" . NV_NAME_VARIABLE . "=" . $module_name . "&" . NV_OP_VARIABLE . "=listimg&idb=" . $data['albumid'] );
                        die();
                    }
                    else
                    {
                        $error = $lang_module['err_save_img'];
                    }
                }
            }
        }
    
    }
    else
    {
        $error = $lang_module['empt_album'];
    }
}

if ( ! empty( $data['path'] ) and file_exists( NV_UPLOADS_REAL_DIR . "/" . $module_name . $data['path'] ) )
{
    $data['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $data['path'];
}
if ( ! empty( $data['v_path'] ) and file_exists( NV_UPLOADS_REAL_DIR . "/" . $module_name . $data['v_path'] ) )
{
    $data['v_path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $data['v_path'];
}

if ( $error != "" )
{
    $xtpl->assign( 'ERR', $error );
    $xtpl->parse( 'main.err' );
}

$xtpl->assign( 'LANG', $lang_module );

if ( ! empty( $data ) )
{
    $xtpl->assign( 'DATA', $data );
}

if ( ! empty( $data['description'] ) )
{
    $xtpl->assign( 'EDITOR', nv_aleditor( 'description', '100%', '300px', $data['description'] ) );
}
else
{
    $xtpl->assign( 'EDITOR', nv_aleditor( 'description', '100%', '300px', "" ) );
}

$xtpl->assign( 'NV_NAME', NV_NAME_VARIABLE );
$xtpl->assign( 'MOD_NAME', $module_name );

$albums = $adb->getAllAlbums();

while ( $album = $db->sql_fetchrow( $albums ) )
{
    $xtpl->assign( 'albumid', $album['albumid'] );
    $xtpl->assign( 'name', $album['name'] );
    $select = ( $data['albumid'] == $album['albumid'] ) ? "selected=\"selected\"" : "";
    $xtpl->assign( 'SELECT', $select );
    $xtpl->parse( 'main.album' );
}

$xtpl->assign( 'PATH', NV_UPLOADS_DIR . '/' . $module_name );
$xtpl->assign( 'PATH_V', NV_UPLOADS_DIR . '/' . $module_name . "/vid" );
$xtpl->assign( 'BROWSER', NV_BASE_ADMINURL . 'index.php?' . NV_NAME_VARIABLE . '=upload&popup=1&area=" + area+"&path="+path+"&type="+type, "NVImg", "850", "400","resizable=no,scrollbars=no,toolbar=no,location=no,status=no' );

$xtpl->parse( 'main' );
$contents = $xtpl->text( 'main' );

include ( NV_ROOTDIR . "/includes/header.php" );
echo nv_admin_theme( $contents );
include ( NV_ROOTDIR . "/includes/footer.php" );
?>