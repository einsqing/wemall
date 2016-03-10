<?php
$config = R("Api/api/gettheme");
$theme = $config ["theme"];

return array(
    //'配置项'=>'配置值'
    'VIEW_PATH' => './Theme/',
    'DEFAULT_THEME' => $theme,
    'TMPL_PARSE_STRING' => array(
        '__IMG__' => __ROOT__ . '/Theme/' . $theme . '/Public/images',
        '__CSS__' => __ROOT__ . '/Theme/' . $theme . '/Public/css',
        '__JS__' => __ROOT__ . '/Theme/' . $theme . '/Public/js',
    )
);