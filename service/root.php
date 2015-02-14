<?php

namespace WS;

// use web service annotations as ann
use \serviceAnnotations as sa;

/**
 * @sa\serviceName("Guide of MCC REST API")
 * @sa\serviceDescription("Funky services for funky people.");
 */
class root extends \slimClass\service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @sa\routeDescription("Returns this guide.")
   */
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $ws = new \slimClass\availableServices();
    $data = $ws->getServicesAsTxt();
    $this->response->body($data);
  }
  
  // Private
  

}

?>
