<?php

namespace WS;

require_once PATH_GITHUB . 'mathCodingClub/weather/Weather.php';

use \WS\annotations as WSann;

/**
 * @WSann\serviceName("Weather")
 * @WSann\serviceDescription("Service for fetching weather of a given location.");
 */
class Weather extends \slimClass\service {

  private $weather;

  /**
   * @WSann\routeDescription("Get weather.")
   * @WSann\routeVariable("city", type="string", desc="City", default="null")
   * @WSann\routeVariable("country", type="string", desc="Country", default="null")
   * @WSann\routeVariable("state", type="string", desc="State (for USA)", default="null")
   */
  public function get($city = null, $country = null, $state = null) {
    $this->weather = new \Weather();
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->weather->get($city, $country, $state));
  }

}

?>
