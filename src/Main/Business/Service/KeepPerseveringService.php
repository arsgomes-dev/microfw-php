<?php

namespace Microfw\Src\Main\Business\Service;

use Microfw\Src\Main\Dao\Factory\FactoryDAO;
use Microfw\Src\Main\Common\Entity\McConfig;

/**
 * Description of KeepPerseveringService
 *
 * @author ARGomes
 */
//TODO: Classe responsável por fornecer as entidades, as funções do banco de dados. 
//Obs.: Não alterar sem ter os conhecimentos necessários

class KeepPerseveringService extends FactoryDAO {

    public function getOne(
            int $parameter = null
    ) {
        if (is_numeric($parameter) && $parameter !== null) {
            $config = new McConfig;
            return $this::one($config->getDb(), $this, $parameter);
        }
    }

    public function getAll(
            int $limit = 0,
            int $offset = 0,
            string $order = '',
            bool $and_or = false
    ) {
        $config = new McConfig;
        return $this::all($config->getDb(), $this, $limit, $offset, $order, $and_or);
    }

    public function setSave() {
        if ($this) {
            $config = new McConfig;
            return $this->save($config->getDb());
        }
    }

    public function setDelete() {
        if ($this) {
            $config = new McConfig;
            return $this::delete($config->getDb());
        }
    }
}
