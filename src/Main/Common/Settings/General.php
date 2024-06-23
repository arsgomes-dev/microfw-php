<?php

  namespace Microfw\Src\Main\Common\Settings;

  /**
   *
   * @author ARGomes
   */
  trait General {
      use GConfig;

      public function getMethodsName($class) {
          $cl = new $class();
          $methodsClass = get_class_methods($cl);
          $methods = [];
          foreach ($methodsClass as $key) {
              $method_get = trim(substr($key, 0, 3));
              if ($method_get === "get") {
                  if (!strpos(SETTING_MAGICALMETHODS, $key)) {
                      if (!strpos(SETTING_MAGICALVARIABLES, $key)) {
                          $method = str_replace("get", "", $key);
                          array_push($methods, strtolower($method));
                      }
                  }
              }
          }
          if ($methods !== null) {
              return $methods;
          }
      }

      public function getDateTime() {
          date_default_timezone_set(SETTING_TIMEZONE);
          $date2 = date('Y-m-d ');
          $time0 = date('H:i:s', time());
          return $date2 . $time0;
      }
  }
  