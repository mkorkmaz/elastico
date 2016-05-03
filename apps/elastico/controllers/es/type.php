<?php

function app_content($request, $args) {

    global $ES;
    $index  = $args['index'];
    $type   = $args['type'];
    $params = [];
    $from   = $request->getParam('from', 0);
    $sort   = $request->getParam('sort', '');
    $query  = $request->getParam('query', '');
    $size   = 25;
    $documents = [];
    $params['index'] = $index;
    $params['type'] = $type;
    $params['sort'] = $sort;
    $params['from'] = $from;
    $params['size'] = $size;
    if (!empty($query)) {
        $body = json_decode($query);
        if (json_last_error() == JSON_ERROR_NONE) {
            $params['body'] = $body;
        } else {
            $params['q'] = $query;
        }
    }
    $results = $ES->search($params);
    foreach ($results['hits']['hits'] as $doc) {
        $doc['_source']['_id'] = $doc['_id'];
        $documents[] = $doc['_source'];
    }
    $params['search_type'] = 'count';
    $count = $ES->search($params);
    $nof = 0;
    if (isset($count['hits']['total'])) {
        $nof = (int) $count['hits']['total'];
    }
    return ['app_title'=>$index . "/" . $type, 'data'=>['index' => $index, 'type' => $type, 'documents'=> $documents, 'from' => $from, 'nof'=>$nof, 'size' => $size, 'sort'=>$sort, 'query'=>$query]];
}
