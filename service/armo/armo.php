<?php

namespace WS;

require_once PATH_GITHUB . 'mathCodingClub/armo/armo.php';
require_once PATH_ANNOTATIONS . 'serviceDescription.php';
require_once PATH_ANNOTATIONS . 'serviceName.php';
require_once PATH_ANNOTATIONS . 'routeDescription.php';
require_once PATH_ANNOTATIONS . 'routeVariable.php';

use \serviceAnnotations as WSann;

/**
 * @WSann\serviceName("Armo")
 * @WSann\serviceDescription("Get quotes of famous Finnish People.");
 */
class armo extends \slimClass\service {

  private $armo;

  public function __construct($app, $path) {
    // true in last parameter automatically maps public methods to rest
    parent::__construct($app, $path, true, '/help');
  }

  /**
   * @WSann\routeDescription("Get quote to cheer your day.")
   * @WSann\routeVariable("user", type="string", desc="Who's quote to get", default="armo")
   * @WSann\routeVariable("ind", type="int", desc="Get quote from specific index", default="null i.e. random")
   */
  public function get($user = 'armo', $ind = null) {
    try {
      $this->armo = new \armo($user);
      $this->setCT(self::CT_PLAIN);
      $this->response->body($this->armo->get($ind));
    } catch (\Exception $e) {
      $this->sendError($e);
    }
  }

  /**
   * @WSann\routeDescription("Get available celebrities.")
   * @WSann\routeVariable("getAmounts", type="bool", desc="Get also amount of quotes", default="false")
   */
  public function getHelp($getAmounts = null) {
    $this->setCT(self::CT_PLAIN);
    $available = \armo::available(!is_null($getAmounts));
    $this->response->body('Persons available: ' . implode(', ', $available));
  }

  /**
   * @WSann\routeDescription("Save new quote.")
   */
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

  /* ADD THIS FOR POST
   * @WSann\postAccepts("application/json")
   * @WSann\postStructure({
   *  @WSann\postScalar("user", type="string", desc="Name of user", optional=false),
   *  @WSann\postScalar("quote", type="string", desc="Quote to be saved", optional=false)
   * })
   */


}

?>
