<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\McConfig;

  /**
   * Description of ExpelsVisitor
   *
   * @author ARGomes
   */
  class ExpelsVisitor {

      public static function expelsVisitor() {
          $config = new McConfig;
          unset($_SESSION['user_id'], $_SESSION['user_username'], $_SESSION['user_login_string'], $_SESSION['user_type']);
          header("Location:".$config->getDomain()."/" . $config->getDomainAdmin() . "/login");
      }
  }
  