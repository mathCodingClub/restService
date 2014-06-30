<?php

namespace WS;

// use web service annotations as ann
use \WS\annotations as WSann;

require_once PATH_GITHUB . 'mathCodingClub/armo/armo.php';

class armo extends service {

  private $armo;

  public function __construct($app, $path) {
    // true in last parameter automatically maps public methods to rest
    parent::__construct($app, $path, true);
  }

  // maps to path/temp/set/dummy/:a/:b/:c(/:d(/:e))
  public function getTempSetDummy($a, $b, $c, $d = null, $e = 1) {

  }

  /**
   * @WSann\HelpTxt("Returns random citation, provide ind to get specific")
   */
  public function get($user, $ind = null) {
    try {
      $this->armo = new \armo($user);
      $this->setCT(self::CT_PLAIN);
      $this->response->body($this->armo->get($ind));
    } catch (\Exception $e) {
      $this->sendError($e);
    }
  }

  /**
   * @WSann\HelpTxt("Returns available persons, getAmounts also gives amounts of their citations")
   */
  public function getHelp($getAmounts = null) {
    $this->setCT(self::CT_PLAIN);
    $available = \armo::available(!is_null($getAmounts));
    $this->response->body('Persons available: ' . implode(', ', $available));
  }

  public function post() {
    $data = $this->getBodyAsJSON();
    try {
      \armo::save($data['user'], $data['quote']);
      $this->setCT(self::CT_PLAIN);
      $this->response->body("New quote saved for {$data['user']}.");
    } catch (\Exception $e) {
      $this->sendError($e);
    }
  }

  // other methods
}

?>
