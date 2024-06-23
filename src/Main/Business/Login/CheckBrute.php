<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\LoginAttempts;

  /**
   * Description of CheckBrute
   *
   * @author ARGomes
   */
  class CheckBrute {

      public static function checkbrute($user) {
          $now = time();
          $valid_attempts = $now - (2 * 60 * 60);
          $attempts = new LoginAttempts();
          $attempts->setUser_Id($user);
          $attempts->setTime($valid_attempts);
          $login_attempts = $attempts->getAll($attempts);
          if (count($login_attempts) >= 5) {
              return true;
          } else {
              return false;
          }
      }
  }
  