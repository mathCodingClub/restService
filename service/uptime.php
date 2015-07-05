<?php

namespace WS;

use \serviceAnnotations as sa;

class uptime extends \slimClass\service {

  public function __construct($app, $path) {
    parent::__construct($app, $path);
  }

  public function get() {
    $uptime = shell_exec('uptime');
    $this->setCT(self::CT_PLAIN);
    $this->response->body($uptime);
  }

}
