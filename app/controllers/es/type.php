<?php

function es_type($request, $args)
{
    global $ESConn;
    $index = $args['index'];
    $type = $args['type'];
    $size = 25;
    $params = es_type_query($request, $index, $type, $size);
    $results = $ESConn->search($params);
    foreach ($results['hits']['hits'] as $doc) {
        $doc['_source']['_id'] = $doc['_id'];
        $documents[] = $doc['_source'];
    }
    $params['search_type'] = 'count';
    $count = $ESConn->search($params);
    $nof = 0;
    if (isset($count['hits']['total'])) {
        $nof = (int) $count['hits']['total'];
    }

    return ['app_title' => $index . '/' . $type, 'data' => ['index' => $index, 'type' => $type, 'documents' => $documents, 'from' => $from, 'nof' => $nof, 'size' => $size, 'sort' => $sort, 'query' => $query]];
}

function es_type_query($request, $index, $type, $size){
    $params = [];
    $from = $request->getParam('from', 0);
    $sort = $request->getParam('sort', '');
    $query = $request->getParam('query', '');
    $documents = [];
    $params['index'] = $index;
    $params['type'] = $type;
    $params['sort'] = $sort;
    $params['from'] = $from;
    $params['size'] = $size;
    if (!empty($query)) {
        $params['q'] = $query;
        $body = json_decode($query);
        if (json_last_error() == JSON_ERROR_NONE) {
            $params['body'] = $body;
            unset($params['q']);
        }
    }
    return $params;
}
