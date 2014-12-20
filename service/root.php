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

  /**
   * @sa\routeDescription("Get help of given service.")
   * @sa\routeVariable("service", type="string", desc="name of service")
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
