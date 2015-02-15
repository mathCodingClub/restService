<?php

namespace WS;

use \serviceAnnotations as sa;

/**
 * @sa\serviceName("Armo")
 * @sa\serviceDescription("Get quotes of famous Finnish People.");
 */
class armo extends \slimClass\service {

  private $armo;

  public function __construct($app, $path) {
    // true in last parameter automatically maps public methods to rest
    parent::__construct($app, $path, true, '/help');
  }

  /**
   * @sa\routeDescription("Get quote to cheer your day.")
   * @sa\routeVariable("user", type="string", desc="Who's quote to get", default="armo")
   * @sa\routeVariable("ind", type="int", desc="Get quote from specific index", default="null i.e. random")
   */
  public function get($user = 'armo', $ind = null) {
    if ($user == 'who'){
      $this->getHelp();    
      return;
    }
    $this->armo = new \armo\armo($user);
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->armo->get($ind));
  }
  
  private function getHelp() {
    $this->setCT(self::CT_PLAIN);
    $available = \armo\armo::available(true);
    $this->response->body('Quotes available: ' . implode(', ', $available));
  }

  /**
   * @sa\routeDescription("Save new quote.")
   */
  public function post() {
    $data = $this->getBodyAsJSON();
    \armo\armo::save($data['user'], $data['quote']);
    $this->setCT(self::CT_PLAIN);    
    $this->response->body("New quote saved for {$data['user']}.");   
  }

  /* ADD THIS FOR POST
   * @sa\postAccepts("application/json")
   * @sa\postStructure({
   *  @sa\postScalar("user", type="string", desc="Name of user", optional=false),
   *  @sa\postScalar("quote", type="string", desc="Quote to be saved", optional=false)
   * })
   */
}

?>
