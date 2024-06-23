<?php

  namespace Microfw\Src\Main\Functions\treatName;

  /**
   * Description of TreatText
   *
   * @author ARGomes 
   */
  class TreatText {

      function treatText($var) {
          $var = strtolower($var);
          $var = preg_replace("[áàâãª]", "a", $var);
          $var = preg_replace("[éèê]", "e", $var);
          $var = preg_replace("[óòôõº]", "o", $var);
          $var = preg_replace("[úùû]", "u", $var);
          $var = str_replace("ç", "c", $var);
          $var = str_replace("Š", "s", $var);
          $var = str_replace("?", "", $var);
          return $var;
      }
  }
  