<?php

namespace WS;

// use web service annotations as ann
use \WS\annotations as WSann;

require_once PATH_GITHUB . 'stenvala/tekstari/tekstari.php';

class tekstari extends service {

  public function __construct($app, $path) {
    parent::__construct($app, $path, true);
  }

  /**
   * @WSann\HelpTxt("Returns requested page, provide keyword if you want to get only lines matching it from the page")
   */
  public function get($page, $keyword = null) {
    $this->setCT(self::CT_PLAIN);
    try {
      $t = new \tekstari($page);
      $p = $t->getPage(\tekstari::GET_PLAIN);
      if (is_null($keyword)) {
        $this->response->body($p);
      } else {
        $res = array();
        $data = explode(PHP_EOL, $p);
        foreach ($data as $value) {
          if (strlen($value) > 0 && !(strpos($value, $keyword) === false)) {
            array_push($res, $value);
          }
        }
        if (count($res) == 0) {
          throw new \Exception("Hakusanaa '$keyword' ei löydy sivulta '$page'", 410);
        }
        $this->response->body(implode(PHP_EOL, $res));
      }
    } catch (\Exception $e) {
      $this->sendError($e);
    }
  }

}

?>
