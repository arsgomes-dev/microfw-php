<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Business\Service\KeepPerseveringService;
  use Microfw\Src\Main\Common\Settings\MagicalMethods;

  /**
   * Description of LoginAttempts
   *
   * @author ARGomes
   */
  class LoginAttempts extends KeepPerseveringService {
      
      use MagicalMethods;

      protected $logTimestamp = false;
      protected $table_db = "loginattempts";
      protected $table_columns_like_db = [];
      protected $table_id_db = "user_id";
      private int $user_id;
      private int $time;

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
       * Get the value of table_columns_like_db
       */
      public function getTable_columns_like_db() {
          return $this->table_columns_like_db;
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
      public function getUser_Id() {
          if (isset($this->user_id)) {
              return $this->user_id;
          } else {
              return null;
          }
      }

      /**
       * Set the value of id
       *
       * @return  self
       */
      public function setUser_Id($user_id) {
          $this->user_id = $user_id;

          return $this;
      }

      /**
       * Get the value of time
       */
      public function getTime() {
          if (isset($this->time)) {
              return $this->time;
          } else {
              return null;
          }
      }

      /**
       * Set the value of time
       *
       * @return  self
       */
      public function setTime($time) {
          $this->time = $time;

          return $this;
      }
  }
  