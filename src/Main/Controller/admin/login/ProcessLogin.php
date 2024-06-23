<?php

  use Microfw\Src\Main\Business\Login\Login;
  use Microfw\Src\Main\Functions\Translate;
  use Microfw\Src\Main\Business\Login\SecSessionStart;
  use Microfw\Src\Main\Common\Entity\Language;
  use Microfw\Src\Main\Common\Entity\McConfig;

  function pv($pv_var) {
      $pv_tipo = '=';
      for ($f = 1; $f <= strlen(strval($pv_var)) - 10; $f++) {
          if ($pv_var[$f] == '=') {
              $pv_tipo = '=';
          }
      }
      if ($pv_tipo == '=') {
          return str_replace('=', '', $pv_var);
      }
  }

  $translate = new Translate();
  $lang = new Language;
  $lang->setActive("1");
  $lang = $lang->getAll($lang);
  $lang_count = count($lang);
  $lg = "";
  $lg_code = "";
  $cr = new Language;
  $cr = $lang[0];
  $lg = $cr->getId();
  $lg_code = $cr->getCode();
  /* for ($i = 1; $i < $lang_count; $i++) {
    if (isset($lang[$i])) {
    $cr = new Language;
    $cr = $lang[$i];
    $lg = $cr->getId();
    }
    } */
//defini variáveis de configurações e recaptcha      
  $config = new McConfig;
  $grecaptcha = new Grecaptcha;
  $sitekey = $grecaptcha->getReChaveSiteKey();
  $secretkey = $grecaptcha->getReChaveSecretKey();
//define pagina home do sistema
  $pag = $config->domain . "/" . $config->$domainAdmin . "/" . $config->pageHome;
//inicia session
  $secSessionStart = new SecSessionStart;
//verifica se foi recebido as informações do formulário de login
  if (isset($_POST['email'], $_POST['p'], $_POST['g-recaptcha'])) {
      if (trim($_POST['email']) !== "" && trim($_POST['p']) !== "") {
          $email = $_POST['email'];
          $p = $_POST['p'];
          $grecaptcha = $_POST['g-recaptcha'];
          $language = isset($_POST['language']) ? $_POST['language'] : $lg;
          if (!$grecaptcha) {

              $_SESSION['erro_log'] = $translate->translate('Por Favor Responda a reCAPTCHA!', $lg_code);
              header("Location:" . $config->domain . "/" . $config->$domainAdmin . "/login");
              exit();
          } else {
              //verificação do recaptcha
              $ip = $_SERVER['REMOTE_ADDR'];
              $url = 'https://www.google.com/recaptcha/api/siteverify';
              $data = array('secret' => $secretkey, 'response' => $grecaptcha);
              $options = array(
                  'http' => array(
                      'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                      'method' => 'POST',
                      'content' => http_build_query($data)
                  )
              );
              $context = stream_context_create($options);
              $response = file_get_contents($url, false, $context);
              $responseKeys = json_decode($response, true);
              header('Content-type: application/json');
              //caso o resultado do recaptcha seja positivo    
              if ($responseKeys["success"] == 1 && $responseKeys["score"] >= 0.6) {
                  //verifica o login do usuário    
                  $returnLogin = (Login::login($email, $p, $language));
                  if ($returnLogin == 1) {
                      // Login efetuado com sucesso
                      header('Location:' . $pag);
                      exit();
                  } else if ($returnLogin == 2) {
                      $_SESSION['erro_log'] = $translate->translate('Login e/ou Senha incorreto(s)!', $lg_code);
                      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  } else if ($returnLogin == 3) {
                      $_SESSION['erro_log'] = $translate->translate('Sua conta foi bloqueada! '
                                . 'Foi enviado para o seu e-mail instruções para o desbloqueio!', $lg_code);
                      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  } else if ($returnLogin == 4) {
                      $_SESSION['erro_log'] = $translate->translate('Sua conta foi bloqueada! '
                                . 'Erro ao enviar e-mail de desboqueio, Entre em contato conosco!', $lg_code);
                      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  } else if ($returnLogin == 5) {
                      $_SESSION['erro_log'] = $translate->translate('Sua conta ainda está desativada!'
                                . ' Acesse o e-mail enviado no momento do cadastro para ativá-la.', $lg_code);
                      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  } else {
                      $_SESSION['erro_log'] = $translate->translate('Não foi possível iniciar uma sessão segura!', $lg_code);
                      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  }
              } else {
                  $_SESSION['erro_log'] = $translate->translate('Ocorreu um erro na resposta do reCAPTCHA, tente novamente!', $lg_code);
                  $responseKeys["success"];
                  header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
                  exit();
              }
          }
      } else {
          $_SESSION['erro_log'] = $translate->translate('Existem campos em branco!', $lg_code);
          header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
          exit();
      }
  } else {
      $_SESSION['erro_log'] = $translate->translate('Existem campos em branco!', $lg_code);
      header("Location:" . $config->domain . "/" . $config->domainAdmin . "/login");
      exit();
  }
