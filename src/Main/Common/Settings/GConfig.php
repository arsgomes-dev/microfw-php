<?php

  namespace Microfw\Src\Main\Common\Settings;

  /**
   * Description of GConfig
   *
   * @author ARGomes
   */
  trait GConfig {

      public function getDefineSettings() {
          if (!defined('SETTING_TIMEZONE')) {
              define('SETTING_TIMEZONE', 'America/Bahia');
              define('SETTING_MAGICALMETHODS', ' getOne , getAll , getCount , getDefineSettings , getMethodsName , getDateTime ');
              define('SETTING_MAGICALVARIABLES', ' getLogTimestamp, getTable_db , getTable_id_db , getTable_idField_db , getTable_columns_db , getTable_columns_like_db, getGcid_generation ');
              //prefixo das tabelas do database
              define('SETTING_DB_TABLE_PREFIX', 'tbsys_');

              define('SETTING_DB_FIELD_ID', 'id');

              define('SETTING_DB_FIELD_CRIATED_AT', 'criated_at');

              define('SETTING_DB_FIELD_UPDATED_AT', 'updated_at');
          }
      }
  }
  