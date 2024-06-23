<?php

  namespace Microfw\Src\Main\Business\Login;

  use Microfw\Src\Main\Common\Entity\Mailer;
  use Microfw\Src\Main\Common\Entity\User;
  use Microfw\Src\Main\Common\Entity\McConfig;
  use Microfw\Src\Main\Common\Entity\StConfig;
  use Microfw\Src\Main\Common\Entity\MessageMailer;

  /**
   * Description of EmailUnlock
   *
   * @author ARGomes
   */
  class EmailUnlock {

      public static function email_unlock($email, $user_id, $username, $unlock_code) {
          $config = new McConfig;
          $endereco_http = $config->domain;
          $st = new StConfig;
          $stConfig = $st->getOne($st, 1);
          $title_website = $stConfig->getTitle();

          $notificationSearch = new Notification;
          $notificationSearch->getDescription_type("sys_blocked_account");
          $notifications = $notificationSearch->getAll($notificationSearch);

          $notification = new Notification;
          if (count($notifications) > 0) {
              for ($i = 0; $i < count($notifications); $i++) {
                  if ($notifications[$i]) {
                      $notification = $notifications[$i];
                  }
              }
          }

          $domain_dir = $config->domainDir;
          $endereco_http = $config->domain;
          //email a ser enviado
          $datetime = explode(" ", $notification->getDateTime());
          $pattern = array('{{ticket.dateSend}}', '{{ticket.hourSend}}', '{{website.title}}', '{{website.http}}');
          $replacement = array($datetime[0], $datetime[0], $title_website, $endereco_http);
          $subject = $notification->getTitle();
          $messageSend = $notification->getDescription();
          for ($i = 0; $i < count($pattern); $i++) {
              $subject = preg_replace($pattern[$i], $replacement[$i], $subject);
              $messageSend = preg_replace($pattern[$i], $replacement[$i], $messageSend);
          }
          $em = [];
          $nm = [];
          array_push($em, $email);
          array_push($nm, $username);
          $msg = new MessageMailer();
          $msg->email = $em;
          $msg->name = $nm;
          $msg->subject = $subject;
          $msg->body = $messageSend;

          if ($msg->send() == 1) {
              //altera status do usuário para bloqueado
              $user = new User;
              $user->setId($user_id);
              $user->setStatus("2");
              $user->setSave($user);
              return TRUE;
          } else {
              return FALSE;
          }
      }
  }
  