<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Common\Settings\MagicalMethods;
  use Microfw\Src\Main\Common\Settings\EmailConfig;

  /**
   * Description of Mailer
   *
   * @author ARGomes
   */
  class Mailer extends EmailConfig {
      use MagicalMethods;

      private string $host;
      private string $username;
      private string $passwd;
      private int $port;
      private string $name;

      public function __construct() {
          $emailConfig = new EmailConfig();
          $email = $emailConfig->getEmailConfig();
          $this->host = $email['host'];
          $this->username = $email['username'];
          $this->passwd = $email['passwd'];
          $this->port = $email['port'];
          $this->name = $email['name'];
      }

      /**
       * Get the value of host
       */
      public function getHost() {
          if (isset($this->host)) {
              return $this->host;
          } else {
              return null;
          }
      }

      /**
       * Set the value of host
       *
       * @return  self
       */
      public function setHost($host) {
          $this->host = $host;

          return $this;
      }

      /**
       * Get the value of username
       */
      public function getUsername() {
          if (isset($this->username)) {
              return $this->username;
          } else {
              return null;
          }
      }

      /**
       * Set the value of username
       *
       * @return  self
       */
      public function setUsername($username) {
          $this->username = $username;

          return $this;
      }

      /**
       * Get the value of passwd
       */
      public function getPasswd() {
          if (isset($this->passwd)) {
              return $this->passwd;
          } else {
              return null;
          }
      }

      /**
       * Set the value of passwd
       *
       * @return  self
       */
      public function setPasswd($passwd) {
          $this->passwd = $passwd;

          return $this;
      }

      /**
       * Get the value of port
       */
      public function getPort() {
          if (isset($this->port)) {
              return $this->port;
          } else {
              return null;
          }
      }

      /**
       * Set the value of port
       *
       * @return  self
       */
      public function setPort($port) {
          $this->port = $port;

          return $this;
      }

      /**
       * Get the value of name
       */
      public function getName() {
          if (isset($this->name)) {
              return $this->name;
          } else {
              return null;
          }
      }

      /**
       * Set the value of name
       *
       * @return  self
       */
      public function setName($name) {
          $this->name = $name;

          return $this;
      }
  }
  