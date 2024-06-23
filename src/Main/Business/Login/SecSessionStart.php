<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\McConfig;

  /**
   * Description of SecSessionStart
   *
   * @author ARGomes
   */
  class SecSessionStart {

      static function secSessionSart() {
          $config = new McConfig;
          $domain_dir = $config->domain;
          if (isset($session)) {
              $session_name = 'sec_session_id';   // Set a custom session name 
              $secure = 'SECURE';
              // This stops JavaScript being able to access the session id.
              $httponly = true;
              // Forces sessions to only use cookies.
              if (ini_set('session.use_only_cookies', 1) === FALSE) {
                  $_SESSION['erro_log'] = "Não foi possível iniciar uma sessão segura!";
                  header("Location:" . $config->domain . "/" . $config->$domainAdmin . "/login");
                  exit();
              }    // Gets current cookies params.
              $cookieParams = session_get_cookie_params();
              session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
              // Sets the session name to the one set above.
              session_name($session_name);
              // Start the PHP session 
              session_regenerate_id();    // regenerated the session, delete the old one. 
          } else {
              if (!isset($_SESSION)) {
                  session_start();
              }
          }
      }
  }
  