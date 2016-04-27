<?php

function app_content($request, $args){

    global $ES;

    $index  = $args['index'];
    $type   = $args['type'];
    $id     = $args['id'];

    $params = [];
    $params['index']= $index;
    $params['type'] = $type;
    $params['id']   = $id;
    $results = $ES->delete($params);
    
    sleep(1);
    header("location:" . BASE_HREF . "/" . $index . "/" . $type . "?res=success&req=delete");
    exit;
}