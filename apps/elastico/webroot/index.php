<?php

require_once dirname(__DIR__) . '/app_config.php';
require_once $config['base_dir'] . '/lib/vendor/autoload.php';

define('BASE_HREF', $config['base_url']);

session_start();

if(isset($_GET['ES_SERVER'])) {
    $_SESSION['ES_SERVER'] = $_GET['ES_SERVER'];
}
if(isset($_SESSION['ES_SERVER'])) {
    $config['es_server'] = $_SESSION['ES_SERVER'];
}

$ES = \Elasticsearch\ClientBuilder::create()->setHosts([$config['es_server']])->build();

$RSlim = new \RSlim\RSlim($config);
$RSlim->register("get", '/', 'es/root');
$RSlim->register("get", "/{index}/{type}", "es/type");
$RSlim->register("get", "/delete/{index}/{type}/{id}", "es/doc.delete",'json');
$RSlim->run();