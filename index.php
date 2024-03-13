<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/RilevatoreDiTemperatura.php';
require __DIR__ . '/RilevatoreDiUmidita.php';
require __DIR__ . '/Impianto.php';

$app = AppFactory::create();

$app->get("/impianto", 'ImpiantoController:stampaImpianto'); //Dati dell'impianto (senza i rilevatori)

$app->get("/rilevatori_di_umidita", "RDU_controller:getArrayRDU"); //Array di tutti i rilevatori di umidità
$app->get("/rilevatori_di_umidita/{identificativo}", "RDU_controller:getDatiRDU"); //Dati completi del dispositivo di umidità
$app->get("/rilevatori_di_umidita/{identificativo}/misurazioni", "RDU_controller:getMisRDU"); //Array di tutte le misurazioni del dispositivo
$app->get("/rilevatori_di_umidita/{identificativo}/misurazioni/maggiore_di/{valore_minimo}", "RDU_controller:getValoreMinRDU"); //Array di tutte le misurazioni  del dispositivo il cui valore misurato è maggiore di valore_minimo
$app->post("/rilevatori_di_umidita", "RDU_controller:"); //Creazione di un nuovo rilevatore di umidita
$app->put("/rilevatori_di_umidita/{identificativo}", "RDU_controller:"); //Aggiornamento dati del rilevatore di umidita

$app->get("/rilevatori_di_temperatura", "RDT_controller:getArrayRDT"); //Array di tutti i rilevatori di temperatura
$app->get("/rilevatori_di_temperatura/{identificativo}", "RDT_controller:getDatiRDT"); //Dati completi del dispositivo di temperatura
$app->get("/rilevatori_di_temperatura/{identificativo}/misurazioni", "RDT_controller:getMisRDT"); //Array di tutte le misurazioni del dispositivo
$app->get("/rilevatori_di_temperatura/{identificativo}/misurazioni/maggiore_di/{valore_minimo} ", "RDT_controller:getValoreMinRDT"); //Array di tutte le misurazioni  del dispositivo il cui valore misurato è maggiore di valore_minimo
$app->post("/rilevatori_di_temperatura", "RDT_controller:"); //Creazione di un nuovo rilevatore di temperatura
$app->put("/rilevatori_di_temperatura/{identificativo}", "RDT_controller:"); //Aggiornamento dati del rilevatore di temperatura

$app->run();
?>