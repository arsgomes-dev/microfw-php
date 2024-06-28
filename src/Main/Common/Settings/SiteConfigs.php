<?php

  namespace Microfw\Src\Main\Common\Settings;

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
    domainAdmin => domínio de acesso a área administrativa,
    pageHome => página de redirecionamento após login,
    siteTitle => Titulo do site,
    reChaveSecretKey => chave secreta do recaptcha,
    reChaveSiteKey => chave publica do recaptcha,
   */
  class SiteConfigs {

      public $siteConfig = array(
          'db' => '1',
          'domain' => 'domain',
          'domainAdmin' => 'domainAdmin',
          'pageHome' => 'pageHome',
          'siteTitle' => 'siteTitle',
          'reChaveSecretKey' => 'reChaveSecretKey',
          'reChaveSiteKey' => 'reChaveSiteKey');
  }
  