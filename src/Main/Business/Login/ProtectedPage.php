<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Business\Login\Login;
  use Microfw\Src\Main\Business\Login\LoginCheck;
  use Microfw\Src\Main\Business\Login\ExpelsVisitor;
  use Microfw\Src\Main\Business\Login\SecSessionStart;

  /**
   * Description of ProtectedPage
   *
   * @author ARGomes
   */
  class ProtectedPage {

      public static function protectedPage() {
          SecSessionStart::secSessionSart();
          if (!isset($_SESSION['user_id'], $_SESSION['user_username'], $_SESSION['user_login_string'], $_SESSION['user_type'])) {
              ExpelsVisitor::expelsVisitor();
          } else if (LoginCheck::login_check() == false) {
              ExpelsVisitor::expelsVisitor();
          }
      }
  }
  