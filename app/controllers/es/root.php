<?php

function es_root($request, $args)
{
    global $ESConn;

    $indices = $ESConn->indices()->getAliases();
    $indexes = [];
    $params = [];
    foreach ($indices as $index => $alieses) {
        if (strpos($index, '.') !== 0) {
            $params['index'] = $index;
            $index_data = [];
            $index_data['name'] = $index;
            $index_info = $ESConn->indices()->getMapping($params);
            foreach ($index_info[$index]['mappings'] as $type => $type_info) {
                if ($type == '_default_') {
                    continue;
                }
                $index_data['types'][] = $type;
            }
            $indexes[] = $index_data;
        }
    }

    return ['data' => ['indexes' => $indexes], 'app_title' => 'Indexes'];
}
