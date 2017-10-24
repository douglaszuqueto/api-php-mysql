# Simples API desenvolvida em PHP

Um simples projeto, que utiliza PHP, PDO, MySQL, Composer, League Router e Docker a fim, em seu conjunto fornecer uma simples api para cadastro, listagem e listagem por codigo de determinada tabela.

Este simples projeto foi criado, a fim de sanar algumas duvidas de como seria uma integraçao via API com outras linguagens de programaçao :).

## Dependencias
* [Composer](https://getcomposer.org/doc/00-intro.md)
* [Docker](https://docs.docker.com/engine/installation/).
* [Docker-Compose](https://docs.docker.com/compose/install/)

## Instalaçao
 * Clone ou baixe este repositorio;
 * Dentro do projeto baixado, rode o comando **composer** para instalar as devidas dependencias;
 * Configure as configuraçoes de seu banco de acordo com sua estrutura;
 * Rode o projeto com `docker-compose up -d` na raiz do projeto;
 
## Rotas
 * [GET] /sensors
    * Retorna todos os registros do banco;
 * [GET] /sensors/id
    * Retorna um registro em especifico do banco;
 * [POST] /sensors
    * Cadastra um novo item no banco de dados
    
## Referencias
 * [League Route](route.thephpleague.com)
 * [Fast Route](https://github.com/nikic/FastRoute)
 * [PHP PDO](http://php.net/manual/en/book.pdo.php)
 * [Docker](https://www.docker.com/)
