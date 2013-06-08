<?php

/**
 * @Project
 * @Author VINADES
 * @Email: hungtmit@gmail.com | tmh@xwebgate.com
 * @Copyright (c) 2010 TMH. All rights reserved
 * @Createdate Jul 13, 2010
 */

if ( ! defined( 'NV_IS_MOD_ALBUMS' ) ) die( 'Stop!!!' );

function main ( $albums )
{
    global $module_info, $global_config, $module_file, $db, $lang_module, $lang_global, $module_name, $my_head;
    
    $xtpl = new XTemplate( "main.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    
    $xtpl->assign( 'IMGP', NV_BASE_SITEURL . "themes/" . $module_info['template'] . "/images/" . $module_file . "/" );
    
    $xtpl->assign( 'LANG', $lang_module );
    
    foreach ( $albums as $album )
    {
        $xtpl->assign( 'TITLE_ALBUM', $album['name'] );
        $xtpl->assign( 'NUM_PHOTO', $album['num_photo'] );
        $xtpl->assign( 'NUM_VIEW', $album['num_view'] );
        $url_link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $album['alias'];
        $xtpl->assign( 'URL_AB', $url_link );
        $xtpl->assign( 'AB_DES', $album['description'] );
        
        if ( ! empty( $album['listimg'] ) )
        {
            foreach ( $album['listimg'] as $listimg )
            {
                if ( ! nv_is_url( $listimg['thumb_name'] ) && $listimg['thumb_name'] != "" )
                {
                    $listimg['thumb_name'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . "/" . $listimg['thumb_name'];
                    $listimg['path'] = NV_BASE_SITEURL . NV_UPLOADS_DIR . "/" . $module_name . $listimg['path'];
                }
                else
                {
                    $listimg['thumb_name'] = NV_BASE_SITEURL . "themes/" . $global_config['site_theme'] . "/images/" . $module_name . "/no_image.gif";
                }
                $xtpl->assign( 'NAME', $listimg['name'] );
                $xtpl->assign( 'URL_VID', NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $album['alias'] . "/" . $listimg['alias'] . "/" . $listimg['pictureid'] . "" );
                $xtpl->assign( 'VID_VIEW', $listimg['num_view'] );
                $xtpl->assign( 'DES', $listimg['description'] );
                $xtpl->parse( 'main.alb.vid' );
            
            }
        }
        else
        {
            $xtpl->assign( 'NONE', "no image" );
        }
        $xtpl->parse( 'main.alb' );
    }
    
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}

function view ( $rs, $rVid, $numRVid, $rAbL, $numRAbL )
{
    global $module_info, $global_config, $module_file, $db, $lang_module, $lang_global, $module_name, $catalias;
    $xtpl = new XTemplate( "view.tpl", NV_ROOTDIR . "/themes/" . $module_info['template'] . "/modules/" . $module_file );
    $xtpl->assign( 'LANG', $lang_module );
    $xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
    $xtpl->assign( 'URL_PP', $rs['path'] );
    $xtpl->assign( 'URL_V', $rs['vpath'] );
    $xtpl->assign( 'VID_NAME', $rs['name'] );
    $xtpl->assign( 'VID_DES', $rs['description'] );
    $xtpl->assign( 'NUM_VVIEW', $rs['num_view'] );
    $xtpl->assign( 'URL_VV', NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $catalias . "/" . $rs['alias'] . "/" . $rs['pictureid'] . "" );
    $xtpl->assign( 'IMGP', NV_BASE_SITEURL . "themes/" . $module_info['template'] . "/images/" . $module_file . "/" );
    
    if ( $numRVid > 0 )
    {
        while ( $listimg = $db->sql_fetchrow( $rVid ) )
        {
            $xtpl->assign( 'NAME', $listimg['name'] );
            $xtpl->assign( 'URL_VID', NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $catalias . "/" . $listimg['alias'] . "/" . $listimg['pictureid'] . "" );
            $xtpl->assign( 'VID_VIEW', $listimg['num_view'] );
            $xtpl->assign( 'DES', $listimg['description'] );
            $xtpl->parse( 'main.rvid.vid' );
        }
        $xtpl->parse( 'main.rvid' );
    }
    
    if ( $numRAbL > 0 )
    {
        while ( $album = $db->sql_fetchrow( $rAbL ) )
        {
            $xtpl->assign( 'TITLE_ALBUM', $album['name'] );
            $xtpl->assign( 'NUM_PHOTO', $album['num_photo'] );
            $xtpl->assign( 'NUM_VIEW', $album['num_view'] );
            $url_link = NV_BASE_SITEURL . "?" . NV_LANG_VARIABLE . "=" . NV_LANG_DATA . "&" . NV_NAME_VARIABLE . "=" . $module_name . "&amp;" . NV_OP_VARIABLE . "=" . $album['albumid'] . "/" . $album['alias'];
            $xtpl->assign( 'URL_AB', $url_link );
            $xtpl->assign( 'AB_DES', $album['description'] );
            
            $xtpl->parse( 'main.rabl.abl' );
        }
        $xtpl->parse( 'main.rabl' );
    }
    
    $xtpl->parse( 'main' );
    return $xtpl->text( 'main' );
}
?>