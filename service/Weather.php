<?php

namespace WS;

use \serviceAnnotations as sa;

/**
 * @sa\serviceName("Weather")
 * @sa\serviceDescription("Service for fetching weather of a given location.");
 */
class Weather extends \slimClass\service {

  private $weather;

  /**
   * @sa\routeDescription("Get weather.")
   * @sa\routeVariable("city", type="string", desc="City", default="null")
   * @sa\routeVariable("country", type="string", desc="Country", default="null")
   * @sa\routeVariable("state", type="string", desc="State (for USA)", default="null")
   */
  public function get($city = null, $country = null, $state = null) {
    $this->weather = new \Weather\Weather();
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->weather->get($city, $country, $state));
  }

}

?>
