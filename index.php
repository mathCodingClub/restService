<?php

// RESTful API @ MCC
//

require_once 'config.inc.php';

// Composer auto load (see composer.json) update: composer update
require_once PATH_GITREST . 'vendor/autoload.php';

// init slim app
$app = new \Slim\Slim();

// github includes commont for all services
require_once PATH_GITMCC . 'slimClass/service.php';
require_once PATH_GITMCC . 'slimClass/availableServices.php';
require_once PATH_GITMCC . 'serviceAnnotations/all.php';

// help service, which describes the api
require_once PATH_GITRESTS . 'root/root.php';
new \WS\root($app, '/');

// github webservices
require_once PATH_GITRESTS . 'armo/armo.php';
new \WS\armo($app, '/quote');
require_once PATH_GITRESTS . 'weather/Weather.php';
new \WS\Weather($app, '/saa');

require_once PATH_GITRESTS . 'tekstari/tekstari.php';
new \WS\tekstari($app, '/txt');

require_once PATH_GITRESTS . 'laatulehti/laatulehti.php';
new \WS\laatulehti($app, '/laatulehti');

// bitbucket webservices
require_once PATH_BITRESTS . 'location/location.php';
new \WS\location($app, '/location');

// run slim app
$app->run();

?>
