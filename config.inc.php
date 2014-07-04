<?php

// Configuration file set to
// PATH_GITHUB <- path for local github repos
// PATH_BITBUCKET <- path for local bitbucket repos
// PATH_GITMCC <- path to mathCodingClub at github repos
// PATH_BITMCC <- path to mathCodingClub at bitbucket repos
// PATH_GITREST <- path to github restService repos of mathCodingClub
// PATH_BITREST <- path to bitbucket restService repos of mathCodingClub
// PATH_GITRESTS <- path to github rest service and location of actual services
// PATH_BITRESTS <- path to bitbucket rest service and location of actual services

$serverName = $_SERVER['SERVER_NAME'];

switch ($serverName) {
  case 'stenvala.osx.localhost':
    error_reporting(E_ALL);
    @ini_set('display_errors', '1');
    define('PATH_GITHUB', '/Users/stenvala/github/');
    define('PATH_BITBUCKET', '/Users/stenvala/bitbucket/');
    break;
  case 'acce.localhost':
  case 'acce.mathcodingclub.com':
    error_reporting(E_ALL);
    @ini_set('display_errors', '1');
    define('PATH_GITHUB', '/home/acce/public_html/github/');
    define('PATH_BITBUCKET', '/var/repos/bitbucket/');
    break;

  default:
    @ini_set('display_errors', 0);
    define('PATH_GITHUB', '/var/repos/github/');
    define('PATH_BITBUCKET', '/var/repos/bitbucket/');
}

// Use github naming convention in PATH_GITHUB and PATH_BITBUCKET

define('PATH_GITMCC', PATH_GITHUB . 'mathCodingClub/');
define('PATH_BITMCC', PATH_BITBUCKET . 'mathCodingClub/');

define('PATH_GITREST', PATH_GITMCC . 'restService/');
define('PATH_BITREST', PATH_BITMCC . 'restService/');

define('PATH_GITRESTS', PATH_GITREST . 'service/');
define('PATH_BITRESTS', PATH_BITREST . 'service/');

define('PATH_ANNOTATIONS', PATH_GITMCC . 'serviceAnnotations/')

?>
