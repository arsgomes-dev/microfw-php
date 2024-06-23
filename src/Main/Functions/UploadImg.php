<?php

  namespace Microfw\Src\Main\Functions;

  use Microfw\Src\Main\Functions\Translate;
  use Microfw\Src\Main\Common\Entity\Returning;
  use Microfw\Src\Main\Functions\TreatName\TreatImageName;

  /**
   * Description of UploadImg
   *
   * @author ARGomes
   */
  class UploadImg {

      public function update($input_name, $dir_base, $rEFileTypes, $MAXIMUM_FILESIZE, $filtro) {
          $returning = new Returning;
          $treatImageName = new TreatImageName();
          $img = $_FILES[$input_name];
          if ($img["name"] != null) {
              $size = $img["size"];
              if ($size <= $MAXIMUM_FILESIZE) {
                  $name = $treatImageName->return_file_name($img['name']);
                  if ($treatImageName->strposa($name, $filtro)) {
                      if (file_exists($dir_base . $name)) {
                          $arquivo_n = explode('.', $name);
                          $extensao = $arquivo_n[1];
                          $nomeTemp = $arquivo_n[0];
                          for ($i2 = 1; $i2 < 9999999999999; $i2++) {
                              $nome = $nomeTemp . "-" . $i2 . "." . $extensao;
                              if (!file_exists($dir_base . $nome)) {
                                  $update = new UploadImg();
                                  $returning = $update->move($img, $dir_base, $nome, $MAXIMUM_FILESIZE, $rEFileTypes);
                                  break;
                              }
                          }
                      } else {
                          $update = new UploadImg();
                          $returning = $update->move($img, $dir_base, $name, $MAXIMUM_FILESIZE, $rEFileTypes);
                      }
                  } else {
                      $returning->setValue(4);
                  }
              } else {
                  $returning->setValue(3);
              }
          }
          return $returning;
      }

      function move($img, $dir_base, $nome, $MAXIMUM_FILESIZE, $rEFileTypes) {
          $translate = new Translate();
          $returning = new Returning;
          $isFile = is_uploaded_file($img['tmp_name']);
          if ($img['error'] === 0) {
              if ($isFile) {
                  $safe_filename = $nome;
                  if ($img['size'] <= $MAXIMUM_FILESIZE && preg_match($rEFileTypes, strrchr($safe_filename, '.'))) {
                      $isMove = move_uploaded_file($img['tmp_name'], $dir_base . $safe_filename);
                      if ($isMove) {
                          $returning->setValue(1);
                          $returning->setDescription($safe_filename);
                      } else {
                          $returning->setValue(2);
                          $returning->setDescription(ucfirst($translate->translate('Erro ao fazer upload da imagem!', $_SESSION['user_lang'])));
                      }
                  } else {
                      $returning->setValue(3);
                      $returning->setDescription(ucfirst($translate->translate('O tamanho da imagem excede o tamanho permitido de 5mb!', $_SESSION['user_lang'])));
                  }
              }
          } else {
              $returning->setValue(3);
              $returning->setDescription(ucfirst($translate->translate('Ocorreu um erro no upload da imagem!', $_SESSION['user_lang'])));
          }
          return $returning;
      }

      public function upload($dir_base, $input_name, $img) {
          $translate = new Translate();
          $returning = new Returning();
          $treatImageName = new TreatImageName();
          $filtro = array('jpg', 'jpeg', 'gif', 'png', 'JPG', 'JPEG', 'GIF', 'PNG');
          $MAXIMUM_FILESIZE = 5 * 1024 * 1024;
          $rEFileTypes = "/^\.(jpg|jpeg|gif|png|JPG|JPEG|GIF|PNG){1}$/i";
          if (!file_exists($dir_base)) {
              mkdir($dir_base, 0777, true);
          }
          $ok = 0;
          $erro = 0;
          $size = $img["size"];
          $name = $treatImageName->return_file_name($img['name']);
          if ($treatImageName->strposa($name, $filtro)) {
              if ($size <= $MAXIMUM_FILESIZE) {
                  $update = new UploadImg();
                  $returning = $update->update($input_name, $dir_base, $rEFileTypes, $MAXIMUM_FILESIZE, $filtro);
                  return $returning;
              } else {
                  $returning->setValue(3);
                  $returning->setDescription(ucfirst($translate->translate('O tamanho da imagem excede o tamanho permitido de 5mb!', $_SESSION['user_lang'])));
                  return $returning;
              }
          } else {
              $returning->setValue(4);
              $returning->setDescription(ucfirst($translate->translate('O formato da imagem é inválido! Formatos aceitos: Gif, Jpeg, Jpg e Png!', $_SESSION['user_lang'])));
              return $returning;
          }
      }

      public function delete($dir_base, $file) {
          $translate = new Translate();
          $returning = new Returning();
          if (file_exists($dir_base . $file)) {
              unlink($dir_base . $file);
              //excluido com sucesso
              $returning->setValue(1);
              $returning->setDescription(ucfirst($translate->translate('Imagem excluída com sucesso!', $_SESSION['user_lang'])));
              return $returning;
          } else {
              //erro ao excluir
              $returning->setValue(2);
              $returning->setDescription(ucfirst($translate->translate('Erro ao excluir imagem!', $_SESSION['user_lang'])));
              return $returning;
          }
      }
  }
  