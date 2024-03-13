<!-- controller per la classe RilevatoreDiTemperatura -->
<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RDTController{
    function getArrayRDT(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $response->getBody()->write($impianto->toString());
        return $response;
    }

    function getDatiRDT(Request $request, Response $response, $args) {
        $impianto = new Impianto();
        $response->getBody()->write($impianto->getRilevatore($args['nome']));
        return $response;
    }
    
    function getMisRDT($rdu){
        $ident = $args["identificativo"];
        $rilTemp = null;

        foreach($rdu as $rilevatore){
            if($rilevatore->ident == $ident){
                $rilTemp = $rilevatore;
                break;
            }
        }

        if($rilTemp == null){
            $response->getBody()->write(json_encode(["errore" => "rilevatore di temperatura non trovato"]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(404);
        }

        $misurazioni = $rilTemp->getMisurazioni();
        $response->getBody()->write(json_encode($misurazioni))
        return $response->withHeader("Content-Type")->withStatus(200);
    }

    function getValoreMinRDT(Request $request, Response $response, $args){
        $ident = $args["identificativo"];
        $valoreMin = $args["valore_minimo"];
        $rilTemp = getRDU();
        $ril = null;

        foreach($rilTemp as $rilevatore){
            if($rilevatore->identificativo == $ident){
                $ril = $rilevatore;
                break;
            }
        }

        if($rilTemp == null){
            $response->getBody()->write(json_encode(["errore" => "rilevatore di temperatura non trovato"]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(404);
        }

        $misFiltrate = array_filter($rilTemp->getMisurazioni(), function ($misurazione) use ($valore_minimo){
            return $misurazione["valore"] > $valore_minimo;
        });

        $response->getBody()->write(json_encode($misFiltrate));
        return $response->withHeader("Content-Type")->withStatus(200);
    }
}

?>