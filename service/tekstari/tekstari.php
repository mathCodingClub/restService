<?php

namespace WS;

use \serviceAnnotations as WSann;

require_once PATH_GITHUB . 'stenvala/tekstari/tekstari.php';

/**
 * @WSann\serviceName("YLE Teksti-TV")
 * @WSann\serviceDescription("Service for fetching YLE Teksti-TV pages.");
 */
class tekstari extends \slimClass\service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  /**
   * @WSann\routeDescription("Get page.")
   * @WSann\routeVariable("page", type="int", desc="What page to get", default="201")
   * @WSann\routeVariable("keyword", type="string", desc="Fetch only those lines having this keyword", default="null i.e. get all lines")
   */
  public function get($page = 201, $keyword = null) {
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
