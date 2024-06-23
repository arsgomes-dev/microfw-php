<?php

  namespace Microfw\Src\Routing\Router;

  /**
   * Description of ValidateRoutes
   *
   * @author ARGomes
   */
  class ValidateRoutes {

      public function getRoutes($dir, $notfound, $gets = null) {
          ob_start();
          if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/src/Main/View/" . $dir . ".php")) {
              require $_SERVER['DOCUMENT_ROOT'] . "/src/Main/View/" . $dir . ".php";
          } else {
              require $_SERVER['DOCUMENT_ROOT'] . "/src/Main/View/" . $notfound . ".php";
          }
          $html = ob_get_contents();
          ob_end_clean();
          print_r($html);
      }
  }
  