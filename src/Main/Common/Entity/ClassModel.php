<?php

namespace Microfw\Src\Main\Common\Entity;

use Microfw\Src\Main\Common\Settings\MagicalMethods;
use Microfw\Src\Main\Business\Service\KeepPerseveringService;

/**
 * Description of ClassModel
 *
 * @author Ricardo Gomes
 */
// É necessário realizar o extends KeepPerseveringService para herdar as funções do banco de dados.
class ClassModel extends KeepPerseveringService {
    //Devese importar a classe MagicalMethods pois ela define o que a função do banco de dados deve ou não ignorar.
    use MagicalMethods;
    //essas variáveis a seguir serão ignorados pelo banco de dados
    //essa variável define se a obtenção da datetime para hora do cadastro/atualização será feita de forma automática.
    protected $logTimestamp = true;
    //define o nome da tabela dessa classe no banco de dados.
    protected $table_db = "users";
    //define que colunas no banco de dados deverá ser consultadas com a utilização do LIKE no MYSQL.
    protected $table_columns_like_db = ['name'];
    //define a coluna que será utilizada como identificador único nessa tabela desse banco de dados.
    protected $table_id_db = "id";
    //caso $logTimestamp seja true é necessário acrescentar as variáveis a seguir ($criated_at, $updated_at):    
      private string $criated_at; //armazenará a data de criação da linha na tabela
      private string $updated_at; //armazenará a data de atualização dessa linha na tabela. 
    
    //É necessário adicionar os gets das variáveis anteriores.
    
     /**
       * Get the value of logTimestamp
       */
      public function getLogTimestamp() {
          return $this->logTimestamp;
      }

      /**
       * Get the value of table_tb
       */
      public function getTable_db() {
          return $this->table_db;
      }

      /**
       * Get the value of table_columns_like_db
       */
      public function getTable_columns_like_db() {
          return $this->table_columns_like_db;
      }

      /**
       * Get the value of table_id_db
       */
      public function getTable_id_db() {
          return $this->table_id_db;
      }

      /**
       * Get the value of criated_at
       */
      public function getCriated_at() {
          if (isset($this->criated_at)) {
              return $this->criated_at;
          } else {
              return null;
          }
      }

      /**
       * Set the value of criated_at
       *
       * @return  self
       */
      public function setCriated_at($criated_at) {
          $this->criated_at = $criated_at;

          return $this;
      }

      /**
       * Get the value of updated_at
       */
      public function getUpdated_at() {
          if (isset($this->updated_at)) {
              return $this->updated_at;
          } else {
              return null;
          }
      }

      /**
       * Set the value of updated_at
       *
       * @return  self
       */
      public function setUpdated_at($updated_at) {
          $this->updated_at = $updated_at;

          return $this;
      }
      
    //Toda variável será criada utilizando o identificador private tipoVariavel (string, int, bool) e o nome da variável.
    //exemplo:
    //private int $id; private string $nome;
    
    //É necessário criar os get/set das variáveis criadas anteriormente, segue exemplo:
    
    /*
    public function getId() {
          if (isset($this->id)) {
              return $this->id;
          } else {
              return null;
          }
      }

      public function setId($id) {
          $this->id = $id;

          return $this;
      }
     *      */  
      
    //put your code here
}
