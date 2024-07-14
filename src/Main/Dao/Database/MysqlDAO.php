<?php

namespace Microfw\Src\Main\Dao\Database;

use PDO;
use Exception;
use Microfw\Src\Main\Common\Entity\Mysql;

/**
 * Description of MysqlDAO
 *
 * @author ARGomes
 */
//TODO: Classe responsável por gerir as conexões com o banco de dados MYSQL com comandos como SELECT, INSERT, UPDATE e DELETE 
//Não alterar sem ter os conhecimentos necessários

class MysqlDAO {

    //função utilizada para consultar dados em uma única linha no DB de acordo com determinados parametros
    public static function daoOne($class, int $parameter = null) {
        if (is_numeric($parameter) && $parameter !== null && $parameter !== "") {
            $mysql = new Mysql();
            $table_name = SETTING_DB_TABLE_PREFIX . (($class->getTable_db() !== "") ? $class->getTable_db() : strtolower(explode(SETTING_DIR_ENTITY, get_class($class))[1]) . "s");
            $class_tb_id_db = (($class->getTable_db_primaryKey() !== "") ? $class->getTable_db_primaryKey() : SETTING_DB_FIELD_PRIMARYKEY);
            try {
                $pdo = new \PDO($mysql->getFactoryUrl(), $mysql->getUsername(), $mysql->getPasswd());
                $sql_temp = 'SELECT * FROM ' . (is_null($table_name) ? strtolower($class) : $table_name);
                $sql_temp .= ' WHERE ' . $class_tb_id_db . " = :id ";
                $sql_temp .= ";";
                $sql = $pdo->prepare($sql_temp);
                $sql->bindValue(":id", $parameter, PDO::PARAM_INT);
                $result = $sql->execute();
                if ($result && isset($sql) && $sql !== null) {
                    $newObject = $sql->fetchObject(get_called_class());
                    if (isset($newObject)) {
                        $array = (array) $newObject;
                        $entity = new $class;
                        foreach ((array) $array as $key => $value) {
                            if (is_scalar($value)) {
                                if (isset($key, $value)) {
                                    if ($key !== "" && $key !== 0 && $value !== "") {
                                        $description = "set" . ucfirst($key);
                                        $entity->$description($value);
                                    }
                                }
                            }
                        }
                        return $entity;
                    } else {
                        return null;
                    }
                } else {
                    return null;
                }
            } catch (Exception $ex) {
                throw new Exception("Não há conexão com Banco de dados!");
            }
        } else {
            return null;
        }
    }

    //função utilizada para consultar dados no DB com filtros, limite, offset e ordenação.
    public static function daoAll(
            $class,
            int $limit = 0,
            int $offset = 0,
            string $order = '',
            int $and_or = 0
    ) {
        $mysql = new Mysql();
        $class_tb_columns_db = $class->getMethodsName();
        $class_tb_columns_like_db = $class->getTable_db_like();
        $class_tb_columns_db_count = count($class_tb_columns_db);
        $table_name = SETTING_DB_TABLE_PREFIX . (($class->getTable_db() !== "") ? $class->getTable_db() : strtolower(explode(SETTING_DIR_ENTITY, get_class($class))[1]) . "s");
        $where = [];
        $where_boolean = false;
        try {
            $pdo = new \PDO($mysql->getFactoryUrl(), $mysql->getUsername(), $mysql->getPasswd());
            $sql_temp = 'SELECT * FROM ' . (is_null($table_name) ? strtolower($class) : $table_name);
            for ($i = 0; $i < $class_tb_columns_db_count; $i++) {
                $method = "get" . ucfirst($class_tb_columns_db[$i]);
                if (!empty($class->$method())) {
                    if ($class->$method() !== null && $class->$method() !== "") {
                        $where[$class_tb_columns_db[$i]] = $class->$method();
                        $like_equal = (in_array($class_tb_columns_db[$i], $class_tb_columns_like_db)) ? " like " : " = ";
                        $sql_temp .= ($where_boolean === false) ? ' WHERE ' : (($and_or === 0) ? ' AND ' : ' OR ');
                        $sql_temp .= trim($class_tb_columns_db[$i], " ") . ' ' . $like_equal . ' :' . trim($class_tb_columns_db[$i]);
                        $where_boolean = true;
                    }
                }
            }
            $sql_temp .= ($order !== '') ? " ORDER BY {$order}" : "";
            $sql_temp .= ($limit > 0) ? " LIMIT {$limit}" : "";
            $sql_temp .= ($offset > 0) ? " OFFSET {$offset}" : "";
            $sql_temp .= ';';
            $sql = $pdo->prepare($sql_temp);
            if (is_iterable($where)) {
                foreach ($where as $key => $value) {
                    if (isset($key, $value)) {
                        if ($key !== "" && $key !== 0 && $value !== "") {
                            (in_array($key, $class_tb_columns_like_db)) ? $sql->bindValue(":" . trim($key), "%" . $value . "%") : $sql->bindValue(":" . trim($key), $value);
                        }
                    }
                }
            }
            $fetch_class = [];
            $result = $sql->execute();
            if ($result && isset($sql) && $sql !== null) {
                $newObject = $sql->fetchAll(\PDO::FETCH_CLASS, get_called_class());
                if (isset($newObject)) {
                    $countObject = count($newObject);
                    for ($i = 0; $i < $countObject; $i++) {
                        $objectSql = $newObject[$i];
                        if (isset($objectSql)) {
                            $arraySql = [];
                            $arraySql = (array) $objectSql;
                            $entity = new $class;
                            if (is_iterable($arraySql)) {
                                foreach ((array) $arraySql as $key => $value) {
                                    if (isset($key, $value)) {
                                        if ($key !== "" && $key !== 0 && $value !== "") {
                                            $description = "set" . ucfirst($key);
                                            $entity->$description($value);
                                        }
                                    }
                                }
                            }
                            array_push($fetch_class, $entity);
                        }
                    }
                    return $fetch_class;
                } else {
                    return "";
                }
            } else {
                return null;
            }
        } catch (Exception $ex) {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    //função utilizada para salvar dados no DB, as informações são passadas através de uma classe com as variáveis do objeto.
    //caso o objeto possua a variável ID o código entenderá como solicitação de atualização, caso não possua, será inserido no banco
    public static function daoSave($class) {
        $mysql = new Mysql();
        $class_tb_columns_db = $class->getMethodsName();
        $table_name = SETTING_DB_TABLE_PREFIX . (($class->getTable_db() !== "") ? $class->getTable_db() : strtolower(explode(SETTING_DIR_ENTITY, get_class($class))[1]) . "s");
        $class_tb_id_db = (($class->getTable_db_primaryKey() !== "") ? $class->getTable_db_primaryKey() : SETTING_DB_FIELD_PRIMARYKEY);
        $class_tb_columns_db_count = count($class_tb_columns_db);
        $sets = array();
        try {
            $pdo = new \PDO($mysql->getFactoryUrl(), $mysql->getUsername(), $mysql->getPasswd());
            for ($i = 0; $i < $class_tb_columns_db_count; $i++) {
                $method = "get" . ucfirst($class_tb_columns_db[$i]);
                if ($class_tb_columns_db[$i] !== $class_tb_id_db && $class->$method() !== null && $class->$method() !== "") {
                    $sets[$class_tb_columns_db[$i]] = $class->$method();
                }
            }
            $sql_construct = "";
            $id = null;
            $id_get = "get" . ucfirst($class_tb_id_db);
            if (!method_exists($class, $id_get)) {
                $sql_insert_values = "";
                $sql_construct .= "INSERT INTO " . $table_name . " (";
                if ($class->getLogTimestamp() === true) {
                    $sql_construct .= "created_at";
                }
                $sql_i = 0;
                foreach ((array) $sets as $key => $value) {
                    if (isset($key, $value)) {
                        if ($key !== "" && $key !== 0 && $value !== "" && $key !== "updated_at" && $key !== "created_at") {
                            if ($class->getLogTimestamp() === true && $sql_i >= 0) {
                                $sql_construct .= ", ";
                            } else if ($class->getLogTimestamp() === false && $sql_i > 0) {
                                $sql_construct .= ", ";
                            }
                            $sql_construct .= $key;
                            if ($class->getLogTimestamp() === true && $sql_i >= 0) {
                                $sql_insert_values .= ", ";
                            } else if ($class->getLogTimestamp() === false && $sql_i > 0) {
                                $sql_insert_values .= ", ";
                            }

                            $sql_insert_values .= " :" . $key;
                            $sql_i++;
                        }
                    }
                }
                $sql_construct .= ") VALUES (";
                if ($class->getLogTimestamp() === true) {
                    $sql_construct .= ":created_at";
                }
                $sql_construct .= $sql_insert_values;
                $sql_construct .= ");";
            } else if ($class->$id_get() !== null) {
                $id = $class->$id_get();
                $sql_construct .= "UPDATE $table_name SET ";
                if ($class->getLogTimestamp() === true) {
                    $sql_construct .= "updated_at = :updated_at";
                }
                $sql_i = 0;
                foreach ((array) $sets as $key => $value) {
                    if (isset($key, $value)) {
                        if ($key !== "" && $key !== 0 && $value !== "" && $key !== "updated_at" && $key !== "created_at") {
                            if ($class->getLogTimestamp() === true && $sql_i >= 0) {
                                $sql_construct .= ", ";
                            } else if ($class->getLogTimestamp() === false && $sql_i > 0) {
                                $sql_construct .= ", ";
                            }
                            $sql_construct .= $key . " = :" . $key;
                            $sql_i++;
                        }
                    }
                }

                $sql_construct .= " WHERE $class_tb_id_db = :" . $class_tb_id_db . ";";
            } else {
                $sql_insert_values = "";
                $sql_construct .= "INSERT INTO " . $table_name . " (";
                if ($class->getLogTimestamp() === true) {
                    $sql_construct .= "created_at";
                }
                $sql_i = 0;
                foreach ((array) $sets as $key => $value) {
                    if (isset($key, $value)) {
                        if ($key !== "" && $key !== 0 && $value !== "" && $key !== "updated_at" && $key !== "created_at") {
                            if ($class->getLogTimestamp() === true && $sql_i >= 0) {
                                $sql_construct .= ", ";
                            } else if ($class->getLogTimestamp() === false && $sql_i > 0) {
                                $sql_construct .= ", ";
                            }
                            $sql_construct .= $key;
                            if ($class->getLogTimestamp() === true && $sql_i >= 0) {
                                $sql_insert_values .= ", ";
                            } else if ($class->getLogTimestamp() === false && $sql_i > 0) {
                                $sql_insert_values .= ", ";
                            }

                            $sql_insert_values .= " :" . $key;
                            $sql_i++;
                        }
                    }
                }
                $sql_construct .= ") VALUES (";
                if ($class->getLogTimestamp() === true) {
                    $sql_construct .= ":created_at";
                }
                $sql_construct .= $sql_insert_values;
                $sql_construct .= ");";
            }
            $sql = $pdo->prepare($sql_construct);
            if (is_iterable($sets)) {
                foreach ((array) $sets as $key => $value) {
                    if (isset($key, $value)) {
                        if (trim($key) !== "" && $key !== 0 && $value !== "") {
                            $sql->bindValue(":" . trim($key), $value);
                        }
                    }
                }
            }
            if (isset($id) && $id > 0) {
                if ($class->getLogTimestamp() === true) {
                    $sql->bindValue(":updated_at", $class->getDateTime(), PDO::PARAM_STR);
                }
                $sql->bindValue(":" . trim($class_tb_id_db), $id, PDO::PARAM_INT);
            } else {
                if ($class->getLogTimestamp() === true) {
                    $sql->bindValue(":created_at", $class->getDateTime(), PDO::PARAM_STR);
                }
            }
            $result = $sql->execute();
            if ($result) {
                if (isset($class_tb_id_db)) {
                    //echo "Atualizado com sucesso!";
                    return 1;
                } else {
                    //echo "Cadastrado com sucesso!";
                    return 2;
                }
            } else {
                return 3;
            }
        } catch (Exception $ex) {
            throw new Exception("Não há conexão com Banco de dados!");
        }
    }

    //função utilizada para deletar dados pelo ID no DB
    public static function daoDelete($class) {
        $mysql = new Mysql();
        $table_name = SETTING_DB_TABLE_PREFIX . (($class->getTable_db() !== "") ? $class->getTable_db() : strtolower(explode(SETTING_DIR_ENTITY, get_class($class))[1]) . "s");
        $id_get = "";
        if ($class->getTable_db_primaryKey() == SETTING_DB_FIELD_PRIMARYKEY) {
            $class_tb_id_db = (($class->getTable_db_primaryKey() !== "") ? $class->getTable_db_primaryKey() : SETTING_DB_FIELD_PRIMARYKEY);
            $id_get = "get" . ucfirst($class_tb_id_db);
        } else {
            $class_tb_id_db = (($class->getTable_db_primaryKey() !== "") ? $class->getTable_db_primaryKey() : SETTING_DB_FIELD_PRIMARYKEY);
            $id_get = "get" . ucfirst($class_tb_id_db);
        }
        $value_id = $class->$id_get();
        if (isset($value_id)) {
            try {
                $pdo = new \PDO($mysql->getFactoryUrl(), $mysql->getUsername(), $mysql->getPasswd());
                $sql_construct = "DELETE FROM " . $table_name . " WHERE " . $class_tb_id_db . " = :" . $class_tb_id_db . ";";
                $sql = $pdo->prepare($sql_construct);
                $sql->bindValue(":" . ($class_tb_id_db), $value_id, PDO::PARAM_INT);
                $result = $sql->execute();
                if ($result) {
                    return 1;
                } else {
                    return 2;
                }
            } catch (Exception $ex) {
                throw new Exception("Não há conexão com Banco de dados!");
            }
        }
    }
}
