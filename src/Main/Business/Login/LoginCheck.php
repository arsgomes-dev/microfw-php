<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\User;

  /**
   * Description of LoginCheck
   *
   * @author ARGomes
   */
  class LoginCheck {

      static function login_check() {
          if (isset($_SESSION['user_id'], $_SESSION['user_username'], $_SESSION['user_login_string'])) {
              $user_id = $_SESSION['user_id'];
              $login_string = $_SESSION['user_login_string'];
              $user_browser = $_SERVER['HTTP_USER_AGENT'];
              $usr = new User;
              $us = $usr->getOne($usr, $user_id);
              if ($us) {
                  if ($us->getId() === $user_id) {
                      $db_password = $us->getPasswd();
                      $login_check = hash('sha512', $db_password . $user_browser);
                      if ($login_check === $login_string) {
                          // Usuário logado!!!! 
                          date_default_timezone_set('America/Bahia');
                          $Data2 = date('Y-m-d ');
                          $hora0 = date('H:i:s', time());
                          $dataI = $Data2 . $hora0;
                          $userSession = new User();
                          $userSession->setId($user_id);
                          $userSession->setSession_date($dataI);
                          $userSession->setSession_date_last($dataI);
                          $userSession->setSave($userSession);
                          return 1;
                      } else {
                          return 2;
                      }
                  } else {
                      return 2;
                  }
              } else {
                  return 6;
              }
          } else {
              return 2;
          }
      }
  }
  