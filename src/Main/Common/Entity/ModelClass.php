<?php

namespace Microfw\Src\Main\Common\Entity;

use Microfw\Src\Main\Common\Settings\MagicalMethods;

/**
 *
 * @author Ricardo Gomes
 */
trait ModelClass {

    //Devesse importar a classe MagicalMethods pois ela define o que a função do banco de dados deve ou não ignorar.
    use MagicalMethods;

    //essas variáveis a seguir serão ignorados pelo banco de dados
    //essa variável define se a obtenção da datetime para hora do cadastro/atualização será feita de forma automática.
    protected $logTimestamp = true;
    //define o nome da tabela dessa classe no banco de dados.
    protected $table_db = "";
    //define que colunas no banco de dados deverá ser consultadas com a utilização do LIKE no MYSQL.
    protected $table_columns_like_db = [];
    //define a coluna que será utilizada como identificador único nessa tabela desse banco de dados.
    protected $table_id_db = "id";
    //caso $logTimestamp seja true é necessário acrescentar as variáveis a seguir ($criated_at, $updated_at):    
    private string $criated_at; //armazenará a data de criação da linha na tabela
    private string $updated_at; //armazenará a data de atualização dessa linha na tabela. 

    //É necessário adicionar os gets das variáveis anteriores.

    public function getLogTimestamp() {
        return $this->logTimestamp;
    }

    public function getTable_db() {
        return $this->table_db;
    }

    public function getTable_columns_like_db() {
        return $this->table_columns_like_db;
    }

    public function getTable_id_db() {
        return $this->table_id_db;
    }

    public function getCriated_at() {
        return $this->criated_at;
    }

    public function getUpdated_at() {
        return $this->updated_at;
    }

    public function setCriated_at($criated_at) {
        $this->criated_at = $criated_at;
    }

    public function setUpdated_at($updated_at) {
        $this->updated_at = $updated_at;
    }
}
