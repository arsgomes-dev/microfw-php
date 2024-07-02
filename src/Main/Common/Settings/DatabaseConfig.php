<?php

  namespace Microfw\Src\Main\Common\Settings;

  //TODO: Classe responsável por armazenar os dados de conexão do banco de dados MYSQL
  // Poderá editar as informações  de acordo com sua conexão com o banco de dados
  /*
    db => seleciona o bando de dados utilizado {1 = Mysql},
    host => link de conexão com o banco de dados,
    database => nome do banco de dados,
    charset => especifica a codificação de caracteres utilizado nas tabelas do banco de dados,
    username => nome do usuário com privilégios padrões,
    passwd => senha do usuário com privilégios padrões;
   */

  class DatabaseConfig {

      public function getDatabase() {
          $database = array(
              'host' => 'mysql:host=' . 'localhost' . ';',
              'database' => 'dbname=' . 'NOMEDATABASE' . ';',
              'charset' => 'charset=' . 'utf8',
              'username' => 'USUARIOPUBLICO',
              'passwd' => 'SENHAPUBLICO');
          return $database;
      }
  }
  