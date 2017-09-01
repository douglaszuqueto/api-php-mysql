<?php
// AUTOLOAD
require_once('./vendor/autoload.php');

// IMPORTS
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

// DATABASE
function getConn()
{
  $DB_HOST = '172.17.0.1';
  $DB_DATABASE = 'rfid';
  $DB_USERNAME = 'docker';
  $DB_PASSWORD = null;

  try {
    $pdo = new PDO("mysql:host={$DB_HOST};dbname={$DB_DATABASE}", $DB_USERNAME, $DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
  } catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();

    return false;
  }
}

// DB FUNCTIONS

function getSensors()
{
  $result = getConn()->query("SELECT * FROM tags;");

  return $result->fetchAll(PDO::FETCH_ASSOC);
}

function getSensor($id)
{
  $result = getConn()->prepare("SELECT * FROM tags WHERE id = :id;");
  $result->bindValue(':id', $id);
  $result->execute();

  return $result->fetch(PDO::FETCH_ASSOC);
}

function createSensor($data)
{
  $result = getConn()->prepare("INSERT INTO tags (id_user, tag) VALUES (:id_user, :tag)");
  $result->bindParam(':id_user', $data['id_user']);
  $result->bindParam(':tag', $data['tag']);

  return $result->execute();
}

// FUNCTIONS

$getSensors = function (ServerRequestInterface $request, ResponseInterface $response) {
  $response->getBody()->write(json_encode(getSensors()));

  return $response->withAddedHeader('content-type', 'application/json');
};

$getSensor = function (ServerRequestInterface $request, ResponseInterface $response, $args) {
  $response->getBody()->write(json_encode(getSensor($args['id'])));

  return $response->withAddedHeader('content-type', 'application/json');
};

$createSensors = function (ServerRequestInterface $request, ResponseInterface $response) {
  $body = $request->getParsedBody();
  $data = [
      'id_user' => $body['id_user'],
      'tag' => $body['tag']
  ];
  createSensor($data);
  $response->getBody()->write(json_encode($data));

  return $response->withAddedHeader('content-type', 'application/json');
};

// ROUTER

$container = new League\Container\Container;
$container->share('response', Zend\Diactoros\Response::class);
$container->share('request', function () {
  return Zend\Diactoros\ServerRequestFactory::fromGlobals(
      $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
  );
});

$container->share('emitter', Zend\Diactoros\Response\SapiEmitter::class);
$route = new League\Route\RouteCollection($container);

// ROUTES
$route->map('GET', '/sensors', $getSensors);
$route->map('GET', '/sensors/{id}', $getSensor);
$route->map('POST', '/sensors', $createSensors);
// END ROUTES

$response = $route->dispatch($container->get('request'), $container->get('response'));
$container->get('emitter')->emit($response);
