<?php

namespace WS;

class laatulehti extends service {
  
  public function get() {
    $this->setCT(self::CT_PLAIN);
    $this->app->response->body("Applied Numerical Mathematics\n");
  }

}

?>
