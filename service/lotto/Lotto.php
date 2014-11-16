<?php

namespace WS;

require_once PATH_GITHUB . 'mathCodingClub/lotto/Lotto.php';

use \serviceAnnotations as WSann;

class Lotto extends \slimClass\service {

  private $lotto;

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @WSann\HelpTxt("Returns latest lotto numbers")
   */
  public function get() {
    $this->lotto = new \Lotto();
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->lotto->get());
  }

  /**
   * @WSann\HelpTxt("takes 7 numbers and tells how many match latest numbers")
   */
  public function getLatestMatch($nro1,$nro2,$nro3,$nro4,$nro5,$nro6,$nro7) {
    $this->lotto = new \Lotto();
    $this->setCT(self::CT_PLAIN);
    $this->response->body($this->lotto->getLatestMatch($nro1,$nro2,$nro3,$nro4,$nro5,$nro6,$nro7));
  }

}

?>
