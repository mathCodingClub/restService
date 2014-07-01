<?php

namespace WS;

require_once PATH_GITHUB . 'mathCodingClub/weather/Weather.php';

use \WS\annotations as WSann;

class Weather extends service {

  private $weather;

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @WSann\HelpTxt("Returns weather for city, country, state (default location is Tampere)")
   */
  public function get($city = null, $country = null, $state = null) {
    $this->weather = new \Weather();
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->weather->get($city, $country, $state));
  }

}

?>
