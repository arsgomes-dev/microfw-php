<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\McConfig;
  use Microfw\Src\Main\Business\Login\SecSessionStart;

  /**
   * Description of CloseLogin
   *
   * @author ARGomes
   */
  class CloseLogin {

      public static function closeLogin() {
          $config = new McConfig;
          SecSessionStart::secSessionSart();
          $_SESSION = array();
          $params = session_get_cookie_params();
          setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
          session_destroy();
          header("Location:".$config->getDomain() ."/" . $config->getDomainAdmin() . "/login");
          exit();
      }
  }
  