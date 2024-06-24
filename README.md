
# MicroFW

MicroFramework PHP, ajuda você a escrever rapidamente aplicações web de forma simplificada e com acesso a banco de dados MYSQL de forma bem prática.

O que seria melhor do que começar um projeto tendo uma base em vez de começar do absoluto zero?

O MicroFW (será assim chamado inicialmente) foi desenvolvido com o intuito de ser o esqueleto para aplicações e que pode ser personalizado dependendo da necessidade do desenvolvedor.




## Funcionalidades

- Estrutura de organização em padrão de arquitetura MVC.
- Roteamento de chamadas HTTP(s).
- Url amigável.
- Acesso facilitado a funções do banco de dados.
- Reforço na segurança dos dados, devido ao acesso externo ser somente a pasta pública.




## Uso/Exemplos

Primeiro é necessário criar uma classe com os atributos necessários:

```javascript
namespace Microfw\Src\Main\Common\Entity

use Microfw\Src\Main\Business\Service\KeepPerseveringService;

class Book extends KeepPerseveringService{

      protected $logTimestamp = true;
      protected $table_db = "book";
      protected $table_columns_like_db = ['title'];
      protected $table_id_db = "id";
      private int $id;
      private string $title;
      private string $description;

    //TODO: a partir daqui ficará todos os GET/SET relacionados as variáveis criadas a cima
    //exemplo:
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

    }
```
Após veja como é fácil instanciar a classe e execultar funções no banco de dados:

```javascript
use Microfw\Src\Main\Common\Entity\Book;

$book = new Book();

/*TODO:
$book->setId(); usar o setID informará ao mecanismo do MicroFW 
que é para utilizar a função UPDATE, enquanto sem ela irá usar a função INSERT
*/

$book->setTitle("Insira aqui o título"); 
$book->setDescription("Insira aqui a descrição"); 
$book = $book->setSave($book); //insere as informações adicionadas na classe Book para serem amazenadas no banco de dados. 
```

