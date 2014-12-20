<?php

namespace WS;

use \serviceAnnotations as sa;

/**
 * @sa\serviceName("Laatulehti")
 * @sa\serviceDescription("Service for fetching quality journals.");
 */
class laatulehti extends \slimClass\service {

  public function __construct(\Slim\Slim $app,$path) {
    parent::__construct($app, $path);
    $this->bindApiHelp('/help');
  }

  /**
   * @sa\routeDescription("Get name of a quality journal.")
   */
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $this->app->response->body("Applied Numerical Mathematics\n");
  }

}

?>
