<?php

function es_doc_delete($request, $args) {

    global $ES;

    $index  = $args['index'];
    $type   = $args['type'];
    $id     = $args['id'];
    $params = [];
    $params['index'] = $index;
    $params['type'] = $type;
    $params['id'] = $id;
    try {
        $result = $ES->delete($params);
    } catch (Exception $e) {
        /*
        If you try to delete a document with an _id that does not exist, $ES->delete throws an Exception.
        B/c of default behaviour of reformo/rslim, it bypasses all Exceptions and it returns Exception message.
        In this case it returns this message as a plain text json that elasticsearch-php returns.
        */
        $result = json_decode($e->getMessage(), true);
    }
    $found = ($result['found'] === true) ? 1 : 0;
    sleep(1);
    header("location:" . BASE_HREF . "/" . $index . "/" . $type . "?res=success&req=delete&f=".$found);
    exit;
}