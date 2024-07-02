<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Common\Settings\DatabaseConfig;

  /**
   * Description of Mysql
   *
   * @author ARGomes
   */
  class Mysql extends DatabaseConfig{
      

      //TODO: Classe responsável por gerenciar os dados de conexão com o banco de dados MYSQL    
      private $url = '';
      private $dbname = '';
      private $charset = '';
      private $username = '';
      private $passwd = '';
      
      public function __construct() {
          $db = new DatabaseConfig;
          $database = $db->getDatabase();
          $this->url = $database['host'];
          $this->dbname = $database['database'];
          $this->charset = $database['charset'];
          $this->username = $database['username'];
          $this->passwd = $database['passwd'];
      }

      public function getFactoryUrl() {
          return $this->url . $this->dbname . $this->charset;
      }

      public function getUsername() {
          return $this->username;
      }

      public function getPasswd() {
          return $this->passwd;
      }
  }
  