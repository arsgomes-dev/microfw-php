<?php

  namespace Microfw\Src\Main\Functions\treatName;

  /**
   * Description of TreatImageName
   *
   * @author ARGomes 
   */
  class TreatImageName extends TreatText {

      //put your code here
      function treatImageName($var) {
          $var_1 = strtolower(preg_replace(
                              array("/\s+/", "/[^-\.\w]+/"),
                              array("_", ""),
                              trim(iconv('UTF-8', 'ISO-8859-1//IGNORE', $var))
          ));
          $var_1 = $this->treatText($var_1);
          $array = array('.');
          foreach ($array as $letra) {
              $letras[$letra] = substr_count($var_1, $letra);
          }
          $local_var = array();
          $n_var_1 = strlen($var_1);  //conta caracteres
          for ($i = 0; $i < $n_var_1; $i++) { //loop
              if ($var_1[$i] == $array[0]) { //loop na letra a
                  $local_var[] = $i;
              }
          }
          $n_local_var = (is_array($local_var) ? count($local_var) : 0) - 1;
          for ($i = 0; $i < $n_var_1; $i++) {
              for ($i2 = 0; $i2 < $n_local_var; $i2++) {
                  if ($i == $local_var[$i2]) {
                      $var_1[$i] = 0;
                  }
              }
          }
          $var_1 = str_replace("-", "", $var_1);
          return $var_1;
      }

      function strposa($haystack, $needles = array(), $offset = 0) {
          $chr = array();
          foreach ($needles as $needle) {
              $res = strpos($haystack, $needle, $offset);
              if ($res !== false)
                  $chr[$needle] = $res;
          }
          if (empty($chr))
              return false;
          return min($chr);
      }

      function return_file_name($string) {
          $string = $this->treatImageName($string);
          $string = $this->treatText(mb_strtolower(html_entity_decode($string, ENT_COMPAT | ENT_HTML401, 'UTF-8'), 'UTF-8'));
          $string = strtolower(trim(trim($string), "\n"));
          return $string;
      }
  }
  