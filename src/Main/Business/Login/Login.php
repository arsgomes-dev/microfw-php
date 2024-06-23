<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Business\Login\CheckBrute;
  use Microfw\Src\Main\Business\Login\EmailUnlock;
  use Microfw\Src\Main\Common\Entity\User;
  use Microfw\Src\Main\Common\Entity\Language;
  use Microfw\Src\Main\Common\Entity\LoginAttempts;

/**
   * Description of Login
   *
   * @author ARGomes
   */
  if (!isset($_SESSION)) {
      session_start();
  }

  class Login {

      public static function login($email, $password2, $language) {
          $username = "";
          $db_password = "";
          $salt = "";
          $status = "";
          $user_id = "";
          $lang = "";
          $users = new User;
          $users->setEmail($email);
          $users = $users->getAll($users);
          if (count($users) > 0) {
              for ($i = 0; $i < count($users); $i++) {
                  if ($users[$i]) {
                      $user = $users[$i];
                      $user_id = $user->getId();
                      $user_gcid = $user->getGcid();
                      $username = $user->getName();
                      $db_password = $user->getPasswd();
                      $salt = $user->getSalt();
                      $privilege = $user->getPrivilege_id();
                      $administrativo = $user->getAdministrative();
                      $status = $user->getStatus();
                      $lg = new Language;
                      $lg = $lg->getOne($lg, $user->getLanguage_id());
                      $lang = $lg->getCode();
                      $language = $user->getLanguage_id();
                  }
              }
              //editar aqui           
              $password = hash('sha512', $password2 . $salt);
              if ($status === 1) {
                  if (CheckBrute::checkbrute($user_id) === true) {
                      $unlock_code = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                      if (EmailUnlock::email_unlock($email, $user_id, $username, $unlock_code)) {
                          return 3;
                      } else {
                          return 4;
                      }
                      exit();
                  } else {
                      if ($db_password == $password) {
                          // login correto
                          $user_browser = $_SERVER['HTTP_USER_AGENT'];
                          $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                          $_SESSION['user_id'] = $user_id;
                          $_SESSION['user_gcid'] = $user_gcid;
                          $_SESSION['user_username'] = $username;
                          $_SESSION['user_type'] = $privilege;
                          $_SESSION['user_ad'] = $administrativo;
                          $_SESSION['user_language'] = $language;
                          $_SESSION['user_lang'] = $lang;
                          $_SESSION['user_login_string'] = hash('sha512', $password . $user_browser);
                          //exclui informações de tentativas incorretas anteriores
                          $attempts = new LoginAttempts();
                          $attempts->setUser_Id($user_id);
                          $attempts->setDelete($attempts);
                          return 1;
                      } else {
                          //salva no DB tentativas incorretas de login
                          $now = time();
                          $attempts = new LoginAttempts();
                          $attempts->setUser_Id($user_id);
                          $attempts->setTime($now);
                          $attempts->setSave($attempts);
                          $atts = new LoginAttempts();
                          $atts->setUser_Id($user_id);
                          $valid_attempts = $now - (2 * 60 * 60);
                          $login_attempts = $atts->getAll($atts);
                          if (count($login_attempts) >= 5) {
                              $unlock_code = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                              if (EmailUnlock::email_unlock($email, $user_id, $username, $unlock_code)) {
                                  return 3;
                              } else {
                                  return 4;
                              }
                          } else {
                              return 2;
                          }
                      }
                  }
              } else if ($status === 0) {
                  return 5;
              } else if ($status === 2) {
                  $unlock_code = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
                  if (EmailUnlock::email_unlock($email, $user_id, $username, $unlock_code)) {
                      return 3;
                  } else {
                      return 4;
                  }
              }
              //ate aqui
          } else {
              return 2;
          }
      }
  }
  