<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Common\Settings\General;
  use Microfw\Src\Main\Business\Service\KeepPerseveringService;

  /**
   * Description of Mailer
   *
   * @author ARGomes
   */
  class Mailer extends KeepPerseveringService {
      
      use General;

      protected $logTimestamp = false;
      protected $table_db = "mailer";
      protected $table_id_db = "id";
      private int $id;
      private string $host;
      private string $username;
      private string $passwd;
      private string $name;
      private int $port;

      /**
       * Get the value of logTimestamp
       */
      public function getLogTimestamp() {
          return $this->logTimestamp;
      }

      /**
       * Get the value of table_tb
       */
      public function getTable_db() {
          return $this->table_db;
      }

      /**
       * Get the value of table_id_db
       */
      public function getTable_id_db() {
          return $this->table_id_db;
      }

      /**
       * Get the value of id
       */
      public function getId() {
          if (isset($this->id)) {
              return $this->id;
          } else {
              return null;
          }
      }

      /**
       * Set the value of id
       *
       * @return  self
       */
      public function setId($id) {
          $this->id = $id;

          return $this;
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
  }
  