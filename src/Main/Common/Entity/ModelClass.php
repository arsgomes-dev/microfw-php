<?php

namespace Microfw\Src\Main\Common\Entity;

use Microfw\Src\Main\Business\Service\KeepPerseveringService;
use Microfw\Src\Main\Common\Settings\MagicalMethods;

/**
 *
 * @author Ricardo Gomes
 */
class ModelClass extends KeepPerseveringService{

    //Devesse importar a classe MagicalMethods pois ela define o que a função do banco de dados deve ou não ignorar.
    use MagicalMethods;
    
    public function __construct() {
        $this->getDefineSettings();
    }

        //essas variáveis a seguir serão ignorados pelo banco de dados
    //essa variável define se a obtenção da datetime para hora do cadastro/atualização será feita de forma automática.
    protected $logTimestamp = true;
    //define o nome da tabela dessa classe no banco de dados.
    protected $table_db = "";
    //define que colunas no banco de dados deverá ser consultadas com a utilização do LIKE no MYSQL.
    protected $table_db_like = [];
    //define a coluna que será utilizada como identificador único nessa tabela desse banco de dados.
    protected $table_db_primaryKey = "";
    //caso $logTimestamp seja true é necessário acrescentar as variáveis a seguir ($criated_at, $updated_at):    
    private string $created_at; //armazenará a data de criação da linha na tabela
    private string $updated_at; //armazenará a data de atualização dessa linha na tabela. 

    //É necessário adicionar os gets das variáveis anteriores.

    public function getLogTimestamp() {
        return $this->logTimestamp;
    }

    public function getTable_db() {
        return $this->table_db;
    }

    public function getTable_db_like() {
        return $this->table_db_like;
    }

    public function getTable_db_primaryKey() {
        return $this->table_db_primaryKey;
    }

    public function getCreated_at() { 
        if (isset($this->id)) {
              return this->created_at;
          } else {
              return null;
          }
    }

    public function getUpdated_at() {
         if (isset($this->id)) {
              return $this->updated_at;;
          } else {
              return null;
          }
    }

    public function setCreated_at($criated_at) {
        $this->criated_at = $criated_at;
    }

    public function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }
}
