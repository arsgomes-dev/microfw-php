<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Configs\SiteConfigs;

  /**
   * Description of McConfig
   *
   * @author ARGomes
   */
//TODO: Classe responsável por gerir as configurações do site 
//Não alterar sem ter os conhecimentos necessários

  class McConfig extends SiteConfigs{

      //config geral
      public $db = ""; //define o DataBase do sistema (1 = Mysql)    
      public $domain = "";
      public $domainClient = "";
      public $domainAdmin = "";
      public $pageHome = "";
      public $reChaveSecretKey = "";
      public $reChaveSiteKey = "";


      public function __construct() {
          $site_Config = new SiteConfigs();
          $this->db = $site_Config->siteConfig['db'];
          $this->domain = $site_Config->siteConfig['domain'];
          $this->domainClient = $site_Config->siteConfig['domainClient'];
          $this->domainAdmin = $site_Config->siteConfig['domainAdmin'];
          $this->pageHome = $site_Config->siteConfig['pageHome'];
          $this->reChaveSecretKey = $site_Config->siteConfig['reChaveSecretKey'];
          $this->reChaveSiteKey = $site_Config->siteConfig['reChaveSiteKey'];
      }
  }
  