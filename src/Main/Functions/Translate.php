<?php

  namespace Microfw\Src\Main\Functions;

  use Microfw\Src\Main\Common\Entity\McConfig;

  class Translate {

      public function translate($text, $lang) {
          $lang = ucfirst(strtolower($lang));
          $t = $text;
          $language = "";
          $lang_bool = false;
          if (isset($lang)) {
              switch ($lang) {
                  case 'Pt_br':
                      $language = "";
                      $lang_bool = false;
                      break;
                  case 'En':
                      $language = "en.php";
                      $lang_bool = true;
                      break;
                  default:
                      $language = "";
                      $lang_bool = false;
                      break;
              }
              if ($lang_bool) {
                  require $_SERVER['DOCUMENT_ROOT'] . '/src/main/functions/translate/' . $language;
                  if (array_key_exists($t, $lang_translate)) {
                      $t = $lang_translate[$t];
                  }
              }
          }
          return $t;
      }

      public function translate_script($lang) {
          $lang = ucfirst(strtolower($lang));
          $language = "";
          if (isset($lang)) {
              switch ($lang) {
                  case 'Pt_br':
                      $language = "pt_br.js";
                      break;
                  case 'En':
                      $language = "en.js";
                      break;
                  default:
                      $language = "pt_br.js";
                      break;
              }
              $config = new McConfig;
              return '<script src="' . $config->domainDir . '/layout/language/' . $language . '"></script>';
          }
      }
  }
  