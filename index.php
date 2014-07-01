<?php

// RESTful API
// (c) Antti Stenvall
// antti@stenvall.fi
//
error_reporting(E_ALL);
@ini_set('display_errors', '1');

if ($_SERVER['SERVER_NAME'] == 'dev.localhost') {
  // local development services
  error_reporting(E_ALL);
  @ini_set('display_errors', '1');
  define('PATH_GITHUB', '/Users/stenvala/htdocs/github/');
  define('PATH_BITBUCKET', '/Users/stenvala/htdocs/bitbucket/');
} elseif ($_SERVER['SERVER_NAME'] == 'access.localhost') {
  die("Acce's local development");
} else {
  define('PATH_GITHUB', '/var/repos/github/');
  define('PATH_BITBUCKET', '/var/repos/bitbucket/');
}
define('PATH_GITMCC', PATH_GITHUB . 'mathCodingClub/');
define('PATH_BITMCC', PATH_BITBUCKET . 'mathCodingClub/');

define('PATH_GITREST', PATH_GITMCC . 'restService/');
define('PATH_BITREST', PATH_BITMCC . 'restService/');

// Composer auto load (see composer.json)
require_once PATH_GITREST . 'vendor/autoload.php';

// init slim app
$app = new \Slim\Slim();

// github includes
require_once PATH_GITMCC . 'slimClass/service.php';
require_once PATH_GITMCC . 'serviceAnnotations/index.php';

require_once PATH_GITREST . 'service/armo/armo.php';
new \WS\armo($app, '/quote');
require_once PATH_GITREST . 'service/weather/Weather.php';
new \WS\Weather($app, '/saa');

require_once PATH_GITREST . 'service/tekstari/tekstari.php';
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
  require_once PATH_BITREST . 'service/location/location.php';
  new \WS\location($app, '/location');


/*
  // REFACTORING IN PROCESS
  // bitbucket includes
  // github webservices


  require_once GITREST . 'laatulehti/laatulehti.php';
  new \WS\laatulehti($app, '/laatulehti');



 */

// run slim app

$app->run();
?>
