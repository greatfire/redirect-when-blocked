<?php

function rwb_appcache_comment()
{
    header('Cache-Control: max-age=0');
    header('Content-type: text/cache-manifest');
    $hash = rwb_appcache_get_hash();
    if(!isset($_GET['hash']) || $_GET['hash'] != $hash) {
        print time();
    } else {
        print $hash;
    }
}

function rwb_appcache_get_hash()
{
    $str = '';
    foreach (array(
        __DIR__,
        __DIR__ . '/conf'
    ) as $dir) {
        foreach (scandir($dir) as $file) {
            $str .= md5_file($dir . '/' . $file);
        }
    }
    return md5($str);
}