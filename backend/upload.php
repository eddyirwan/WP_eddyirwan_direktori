<?php

function my_upload_dir( $dirs ) {
    $dirs['subdir'] = '/'.APPS_NAME;
    $dirs['path'] = $dirs['basedir'] . '/'.APPS_NAME;
    $dirs['url'] = $dirs['baseurl'] . '/'.APPS_NAME;
    return $dirs;
}
function my_filename_convention( $filename ) {   
    return strtolower(APPS_NAME).'.jpg';
}