<?php

function es_doc_delete($request, $args)
{
    global $ESConn;
    
    $params = [
        'index'=>$args['index'],
        'type'=>$args['type'],
        'id'=>$args['id'],
    ];
    try {
        $result = $ESConn->delete($params);
    } catch (Exception $e) {
        /*
        If you try to delete a document with an _id that does not exist, $ES->delete throws an Exception.
        B/c of default behaviour of reformo/rslim, it bypasses all Exceptions and it returns Exception message.
        In this case it returns this message as a plain text json that elasticsearch-php returns.
        */
        $result = json_decode($e->getMessage(), true);
    }
    $found = (int) $result['found'];
    sleep(1);
    return ['redirect'=>BASE_HREF . '/' . $args['index'] . '/' . $args['type'] . '?res=success&req=delete&f=' . $found];
}
