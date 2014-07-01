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

/*
$app->get('/test/', function() use ($app) {
    $routes = $app->router()->getNamedRoutes();
    print 'keke';
    print $routes->count();
    print count($routes);
    foreach ($routes as $route) {
      echo "{$route->getName()} : {$route->getPattern()}";
    }
    exit;
  });
*/

  // bitbucket webservices
  require_once PATH_BITRESTS . 'location/location.php';
  new \WS\location($app, '/location');


/*
  // REFACTORING IN PROCESS
  // bitbucket includes
  // github webservices


  require_once GITREST . 'laatulehti/laatulehti.php';
  new \WS\laatulehti($app, '/laatulehti');



 */

// keep this last and extend it to automatically crawle all the routes of $app
require_once PATH_GITRESTS . 'root/root.php';
new \WS\root($app,'/');

// run slim app

$app->run();
?>
