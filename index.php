<?php

// RESTful API @ MCC
//

require_once 'config.inc.php';

// Composer auto load (see composer.json) update: composer update
require_once PATH_GITREST . 'vendor/autoload.php';

// init slim app
$app = new \Slim\Slim();

// github includes
require_once PATH_GITMCC . 'slimClass/service.php';
require_once PATH_GITMCC . 'serviceAnnotations/index.php';

require_once PATH_GITRESTS . 'armo/armo.php';
new \WS\armo($app, '/quote');
require_once PATH_GITRESTS . 'weather/Weather.php';
new \WS\Weather($app, '/saa');

require_once PATH_GITRESTS . 'tekstari/tekstari.php';
new \WS\tekstari($app, '/txt');

$app->get('/test', function() use ($app) {  
  $app->response()->headers->set('Content-Type', 'text/plain');  
  $routes = $app->router()->getNamedRoutes();    
  $cont = '';
  foreach ($routes as $route) {    
    $cont .= $route->getName() . ': ' . $route->getPattern() . PHP_EOL;
  }
  echo $cont;
  $app->response()->body($cont);
  exit;
});


require_once PATH_GITRESTS . 'laatulehti/laatulehti.php';
new \WS\laatulehti($app, '/laatulehti');


// bitbucket webservices
require_once PATH_BITRESTS . 'location/location.php';
new \WS\location($app, '/location');

// keep this last and extend it to automatically crawle all the routes of $app
require_once PATH_GITRESTS . 'root/root.php';
new \WS\root($app, '/');

// run slim app

$app->run();
?>
