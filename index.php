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
  define('PATH_GITHUB', '/Users/stenvala/htdocs/mcc-github-rest/');
  define('PATH_BITBUCKET', '/Users/stenvala/htdocs/mcc-bitbucket-rest/');
} elseif ($_SERVER['SERVER_NAME'] == 'access.localhost') {
  die("Acce's local development");
} else {
  define('PATH_GITHUB', '/var/repos/github/');
  define('PATH_BITBUCKET', '/var/repos/bitbucket/');
}
define('PATH_GITREST', PATH_GITHUB . 'mathCodingClub/restService/');
define('PATH_BITREST', PATH_BITBUCKET . 'mathCodingClub/restservice/');

// Composer auto load (see composer.json)
require_once PATH_GITREST . 'vendor/autoload.php';

// init slim app
$app = new \Slim\Slim();

// github includes
require_once PATH_GITHUB . 'mathCodingClub/slimClass/service.php';
require_once PATH_GITHUB . 'mathCodingClub/serviceAnnotations/index.php';

require_once PATH_GITREST . 'service/sitaatti/armo.php';
new \WS\armo($app, '/quote');
// require_once GIT_REST . '/service/weather/Weather.php';
// new \WS\Weather($app, '/saa');

/*
// REFACTORING IN PROCESS
// bitbucket includes
// github webservices
require_once GITREST . 'txt/tekstari.php';
new \WS\tekstari($app, '/txt');

require_once GITREST . 'laatulehti/laatulehti.php';
new \WS\laatulehti($app, '/laatulehti');

// bitbucket webservices
require_once BITREST . 'location/location.php';
new \WS\location($app, '/location');

*/

// run slim app

$app->run();
?>
