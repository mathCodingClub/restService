<?php

namespace WS;

require_once PATH_ANNOTATIONS . 'serviceDescription.php';
require_once PATH_ANNOTATIONS . 'serviceName.php';
require_once PATH_ANNOTATIONS . 'routeDescription.php';

use \WS\annotations as WSann;

/**
 * @WSann\serviceName("Laatulehti")
 * @WSann\serviceDescription("Service for fetching quality journals.");
 */
class laatulehti extends \slimClass\service {

  public function __construct(\Slim\Slim $app,$path) {
    parent::__construct($app, $path);
    $this->bindApiHelp('/help');
  }

  /**
   * @WSann\routeDescription("Get name of a quality journal.")
   */
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $this->app->response->body("Applied Numerical Mathematics\n");
  }

}

?>
