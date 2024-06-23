<?php

  namespace Microfw\Src\Main\Dao\Factory;

  use Microfw\Src\Main\Dao\Database\MysqlDAO;

  class FactoryDAO {

      public static function one($db, int $parameter = null) {
          switch ($db) {
              case 1:
                  $class = get_called_class();
                  $obj = new MysqlDAO();
                  return $obj::daoOne($class, $parameter);
                  break;
          }
      }

      public static function all(
                $db,
                $class,
                int $limit = 0,
                int $offset = 0,
                string $order = '',
                int $and_or = 0
      ) {
          switch ($db) {
              case 1:
                  $obj = new MysqlDAO();
                  return $obj::daoAll($class, $limit, $offset, $order, $and_or);
                  break;
          }
      }

      public function save($db) {
          switch ($db) {
              case 1:
                  $obj = new MysqlDAO();
                  return $obj::daoSave($this);
                  break;
          }
      }

      public function delete($db) {
          switch ($db) {
              case 1:
                  $obj = new MysqlDAO();
                  return $obj::daoDelete($this);
                  break;
          }
      }

      public static function count($db, $class, string $filter = '', string $search = '', int $and_or = 0, int $where_or = 0) {
          switch ($db) {
              case 1:
                  $obj = new MysqlDAO();
                  return $obj::daoCount($class, $filter, $search, $and_or, $where_or);
                  break;
          }
      }
  }
  