<?php

// RESTful API @ MCC
//

date_default_timezone_set('UTC');

define('BASE', __DIR__ . '/');

require_once BASE . 'vendor/mathCodingClub/serviceAnnotations/all.php';
require_once BASE . 'vendor/autoload.php';

$app = new \Slim\Slim(array('debug' => false));

$app->error(function(\Exception $e) use ($app) {
  $app->halt($e->getCode(), $e->getMessage());
});

// These are automatically loaded from service
new \WS\root($app, '/');
new \WS\armo($app, '/quote');
new \WS\Weather($app, '/saa');
new \WS\Lotto($app, '/lotto');
new \WS\tekstari($app, '/txt');
new \WS\laatulehti($app, '/laatulehti');

// bitbucket webservices bbWS
new \bbWS\location($app, '/location');
new \bbWS\preview($app, '/pre', '/home/stenvala/rest-previewer');
//new \bbWS\preview($app, '/pre', '/home/mcc/rest/preview');

// run slim app
$app->run();


