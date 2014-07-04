<?php

namespace WS;

// use web service annotations as ann
use \WS\annotations as WSann;

// Add API description
require_once PATH_GITMCC . 'slimClass/availableServices.php';

/**
 * @WSann\serviceName("Guide of MCC REST API")
 * @WSann\serviceDescription("Funky services for funky people.");
 */
class root extends service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @WSann\routeDescription("Returns this guide.")
   */
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $ws = new \WS\availableServices();
    $data = $ws->getServicesAsTxt();
    $this->response->body($data);
  }

  /**
   * @WSann\routeDescription("Get help of given service.")
   * @WSann\routeVariable("service", type="string", desc="name of service")
   */
  public function getHelp($servicePath){
    $this->setCT(self::CT_PLAIN);
    $ws = new \WS\availableServices();
    $service = $ws->getServiceNameFromPath($servicePath);
    $data = $ws->getServiceAsTxt($service);
    $this->response->body($data);
  }

}

?>
