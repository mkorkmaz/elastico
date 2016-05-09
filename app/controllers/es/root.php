<?php

function es_root($request, $args)
{
    global $ESConn;

    $indices = array_keys($ESConn->indices()->getAliases());
    $indexes = [];
    $params = [];
    foreach ($indices as $index) {
        if (strpos($index, '.') !== 0) {
            $params['index'] = $index;
            $index_data = [];
            $index_data['name'] = $index;
            $index_info = $ESConn->indices()->getMapping($params);
            $index_data['types'] = array_keys($index_info[$index]['mappings']);
            $indexes[] = $index_data;
        }
    }

    return ['data' => ['indexes' => $indexes], 'app_title' => 'Indices'];
}
