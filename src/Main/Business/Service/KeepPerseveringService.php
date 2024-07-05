<?php

namespace Microfw\Src\Main\Business\Service;

use Microfw\Src\Main\Dao\Factory\FactoryDAO;
use Microfw\Src\Main\Common\Entity\McConfig;
use Microfw\Src\Main\Common\Entity\ModelClass;

/**
 * Description of KeepPerseveringService
 *
 * @author ARGomes
 */
//TODO: Classe responsável por fornecer as entidades, as funções do banco de dados. 
//Obs.: Não alterar sem ter os conhecimentos necessários

class KeepPerseveringService extends FactoryDAO {

    use ModelClass;

    public function getOne(
            $class,
            int $parameter = null
    ) {
        if (is_numeric($parameter) && $parameter !== null) {
            $config = new McConfig;
            return $class::one($config->getDb(), $parameter);
        }
    }

    public function getAll(
            $class,
            int $limit = 0,
            int $offset = 0,
            string $order = '',
            int $and_or = 0
    ) {
        $config = new McConfig;
        return $class::all($config->getDb(), $class, $limit, $offset, $order, $and_or);
    }

    public function setSave($class) {
        if ($this) {
            $config = new McConfig;
            return $class->save($config->getDb());
        }
    }

    public function setDelete($class) {
        if ($this) {
            $config = new McConfig;
            return $class::delete($config->getDb());
        }
    }
}
