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

// These are automatically loaded
new \WS\armo($app, '/quote');
new \WS\Weather($app, '/saa');
new \WS\Lotto($app, '/lotto');
new \WS\tekstari($app, '/txt'); 
new \WS\laatulehti($app, '/laatulehti');

// bitbucket webservices bbWS just add dependency to composer.json, and it's all working
new \bbWS\location($app, '/location');

// run slim app
$app->run();

?>
