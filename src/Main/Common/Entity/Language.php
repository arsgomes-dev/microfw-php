<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Common\Settings\General;
  use Microfw\Src\Main\Business\Service\KeepPerseveringService;

  /**
   * Description of Language
   *
   * @author ARGomes
   */
  class Language extends KeepPerseveringService {
      
      use General;

      protected $logTimestamp = false;
      protected $table_db = "language";
      protected $table_columns_like_db = ['language'];
      protected $table_id_db = "id";
      private int $id;
      private string $language;
      private string $code;
      private string $archive;
      private string $status;
      private string $active;

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
       * Get the value of language
       */
      public function getLanguage() {
          if (isset($this->language)) {
              return $this->language;
          } else {
              return null;
          }
      }

      /**
       * Set the value of language
       *
       * @return  self
       */
      public function setLanguage($language) {
          $this->language = $language;

          return $this;
      }

      /**
       * Get the value of code
       */
      public function getCode() {
          if (isset($this->code)) {
              return $this->code;
          } else {
              return null;
          }
      }

      /**
       * Set the value of code
       *
       * @return  self
       */
      public function setCode($code) {
          $this->code = $code;

          return $this;
      }

      /**
       * Get the value of archive
       */
      public function getArchive() {
          if (isset($this->archive)) {
              return $this->archive;
          } else {
              return null;
          }
      }

      /**
       * Set the value of archive
       *
       * @return  self
       */
      public function setArchive($archive) {
          $this->archive = $archive;

          return $this;
      }

      /**
       * Get the value of status
       */
      public function getStatus() {
          if (isset($this->status)) {
              return $this->status;
          } else {
              return null;
          }
      }

      /**
       * Set the value of status
       *
       * @return  self
       */
      public function setStatus($status) {
          $this->status = $status;

          return $this;
      }

      /**
       * Get the value of active
       */
      public function getActive() {
          if (isset($this->active)) {
              return $this->active;
          } else {
              return null;
          }
      }

      /**
       * Set the value of active
       *
       * @return  self
       */
      public function setActive($active) {
          $this->active = $active;

          return $this;
      }
  }
  