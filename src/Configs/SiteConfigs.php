<?php

  namespace Microfw\Src\Configs;

  /**
   * Description of SiteConfigs
   *
   * @author ARGomes
   */
//TODO: Classe responsável por armazenar os dados principais de configurações do site
  // Poderá editar as informações de acordo as necessidades
  /*
    db => seleciona o bando de dados utilizado {1 = Mysql},
    domain => domínio padrão do site,
    domainClient => domínio de acesso ao público,
    domainAdmin => domínio de acesso a área administrativa,
   */
  class SiteConfigs {

      public $siteConfig = array(
          'db' => '1',
          'domain' => 'domain',
          'domainClient' => 'domainClient',
          'domainAdmin' => 'domainAdmin',
          'pageHome' => 'pageHome',
          'reChaveSecretKey' => 'reChaveSecretKey',
          'reChaveSiteKey' => 'reChaveSiteKey');
  }
  