<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPTrait.php to edit this template
 */

namespace Microfw\Src\Main\Common\Settings;

/**
 *
 * @author Ricardo Gomes
 */
trait MagicalMethods {
    public function getDefineSettings() {
          if (!defined('SETTING_TIMEZONE')) {
              //SETTING_TIMEZONE = Fuso horário da aplicação 
              define('SETTING_TIMEZONE', 'America/Sao_Paulo');
              //Diretório das entidades 
              define('SETTING_DIR_ENTITY', 'Microfw\\Src\\Main\\Common\\Entity\\');
              //Métodos e variáveis que irão ser ignorado das classes pela aplicação durante o tratamento das querys do banco de dados
              define('SETTING_MAGICALMETHODS', ' getOne , getAll , getCount , getDefineSettings , getMethodsName , getDateTime ');
              define('SETTING_MAGICALVARIABLES', ' getLogTimestamp, getTable_db , getTable_db_primaryKey , getTable_idField_db , getTable_columns_db , getTable_db_like, getGcid_generation ');
              //prefixo das tabelas do banco de dados
              define('SETTING_DB_TABLE_PREFIX', 'tbsys_');
              //campo de identificação única do banco de dados
              define('SETTING_DB_FIELD_PRIMARYKEY', 'id');
          }
      }
       public function getMethodsName() {
          $cl = new $this;
          $cl->getDefineSettings();
          $methodsClass = get_class_methods($cl);
          $methods = [];
          foreach ($methodsClass as $key) {
              $method_get = trim(substr($key, 0, 3));
              if ($method_get === "get") {
                  if (!strpos(SETTING_MAGICALMETHODS, $key)) {
                      if (!strpos(SETTING_MAGICALVARIABLES, $key)) {
                          $method = str_replace("get", "", $key);
                          array_push($methods, strtolower($method));
                      }
                  }
              }
          }
          if ($methods !== null) {
              return $methods;
          }
      }

      public function getDateTime() {
          date_default_timezone_set(SETTING_TIMEZONE);
          $date2 = date('Y-m-d ');
          $time0 = date('H:i:s', time());
          return $date2 . $time0;
      }
}
