<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ImpiantoController{
    function stampaImpianto(Request $request, Response $response, $args){
        $impianto = new Impianto("Nome1", 45.21, 34.1234);
        $response->getBody()->write(json_encode($impianto));
        return $response->withHeader("Content-Type", "application/json")->withStatus(200);
    }
}

?>