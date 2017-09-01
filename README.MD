# Simples API desenvolvida em PHP

Um simples projeto, que utiliza PHP, PDO, MySQL, Composer e League Router a fim, em seu conjunto fornecer uma simples api para cadastro, listagem e listagem por codigo de determinada tabela.

Este simples projeto foi criado, a fim de sanar algumas duvidas de como seria uma integraçao via API com outras linguagens de programaçao :).

## Dependencias

Tenha um ambiente para Programaçao PHP com Banco de Dados devidamente configurados.

## Instalaçao
 * Clone ou baixe este repositorio;
 * Dentro do projeto baixado, rode o comando **composer** para instalar as devidas dependencias;
 * Configure as configuraçoes de seu banco de acordo com sua estrutura;
 * Rode o projeto a partir de um apache/nginx/caddy ou ate mesmo atraves do CLI do PHP;
 
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
