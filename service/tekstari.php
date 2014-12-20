<?php

namespace WS;

use \serviceAnnotations as sa;

/**
 * @sa\serviceName("YLE Teksti-TV")
 * @sa\serviceDescription("Service for fetching YLE Teksti-TV pages.");
 */
class tekstari extends \slimClass\service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @sa\routeDescription("Get page.")
   * @sa\routeVariable("page", type="int", desc="What page to get", default="201")
   * @sa\routeVariable("keyword", type="string", desc="Fetch only those lines having this keyword", default="null i.e. get all lines")
   */
  
  public function get($page = 201, $keyword = null) {
    $this->setCT(self::CT_PLAIN);
    $t = new \tekstari\tekstari($page);
    $p = $t->getPage(\tekstari\tekstari::GET_PLAIN);
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
  }
}

?>
