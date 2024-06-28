<?php

  namespace Microfw\Src\Main\Common\Entity;

  use Microfw\Src\Main\Common\Settings\SiteConfigs;

  /**
   * Description of McConfig
   *
   * @author ARGomes
   */
//TODO: Classe responsável por gerir as configurações do site 
//Não alterar sem ter os conhecimentos necessários

  class McConfig extends SiteConfigs {

      //config geral
      private $db = ""; //define o DataBase do sistema (1 = Mysql)    
      private $domain = "";
      private $domainAdmin = "";
      private $siteTitle = "";
      private $pageHome = "";
      private $reChaveSecretKey = "";
      private $reChaveSiteKey = "";

      public function __construct() {
          $site_Config = new SiteConfigs();
          $this->db = $site_Config->siteConfig['db'];
          $this->domain = $site_Config->siteConfig['domain'];
          $this->domainAdmin = $site_Config->siteConfig['domainAdmin'];
          $this->pageHome = $site_Config->siteConfig['pageHome'];
          $this->siteTitle = $site_Config->siteConfig['siteTitle'];
          $this->reChaveSecretKey = $site_Config->siteConfig['reChaveSecretKey'];
          $this->reChaveSiteKey = $site_Config->siteConfig['reChaveSiteKey'];
      }

      public function getDb() {
          return $this->db;
      }

      public function getDomain() {
          return $this->domain;
      }

      public function getDomainAdmin() {
          return $this->domainAdmin;
      }

      public function getPageHome() {
          return $this->pageHome;
      }

      public function getSiteTitle() {
          return $this->siteTitle;
      }

      public function getReChaveSecretKey() {
          return $this->reChaveSecretKey;
      }

      public function getReChaveSiteKey() {
          return $this->reChaveSiteKey;
      }
  }
  