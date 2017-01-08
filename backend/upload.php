<?php

function my_upload_dir( $dirs ) {
    $dirs['subdir'] = '/'.EIDIR_APPS_NAME;
    $dirs['path'] = $dirs['basedir'] . '/'.EIDIR_APPS_NAME;
    $dirs['url'] = $dirs['baseurl'] . '/'.EIDIR_APPS_NAME;
    return $dirs;
}
function my_filename_convention( $filename ) {   
    return strtolower(EIDIR_APPS_NAME).'.jpg';
}