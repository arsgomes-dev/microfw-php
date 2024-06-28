<?php

  namespace Microfw\Src\Main\Common\Settings;

  /**
   * Description of EmailConfig
   *
   * @author ARGomes
   */
   //TODO: Classe responsável por armazenar os dados de conexão com o servidor de Email
  // Poderá editar as informações  de acordo com os dados de seu servidor
  /*
    host => link de conexão com o servidor de email,
    username => nome do usuário,
    passwd => senha do usuário;
    port => porta de conexão,
    name => nome que ficará disponível para quem receber o email, exemplo 'Não Responder';
   */
  
  class EmailConfig {
       public function getEmailConfig() {
          $email = array(
              'host' => 'HOST',
              'username' => 'USERNAME',
              'passwd' => 'PASSWORD',
              'port' => 'PORT',
              'name' => 'NAME'
              );
          return $email;
      }
  }
  