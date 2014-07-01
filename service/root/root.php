<?php

namespace WS;

// use web service annotations as ann
use \WS\annotations as WSann;

class root extends service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @WSann\HelpTxt("Returns guide")
   */
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $this->response->body('This is mcc RESTapi.');
  }

}

?>
