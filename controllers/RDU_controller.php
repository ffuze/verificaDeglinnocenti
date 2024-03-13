<!-- controller per la classe RilevatoreDiUmidita -->
<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RDUController{
    function getArrayRDU(Request $request, Response $response, $args){
        $impianto = new Impianto();
        $response->getBody()->write($impianto->toString());
        return $response;
    }

    function getDatiRDU(Request $request, Response $response, $args) {
        $impianto = new Impianto();
        $response->getBody()->write($impianto->getRilevatore($args['nome']));
        return $response;
    }

    function getMisRDU(Request $request, Response $response, $args, $rdu){

        $ident = $args["identificativo"];
        $rilUm = null;

        foreach($rdu as $rilevatore){
            if($rilevatore->identificativo == $ident){
                $rilUm = $rilevatore;
                break;
            }
        }

        if($rilUm == null){
            $response->getBody()->write(json_encode(["errore" => "rilevatore di umidita non trovato"]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(404);
        }

        $misurazioni = $rilUm->getMisurazioni();
        $response->getBody()->write(json_encode($misurazioni))
        return $response->withHeader("Content-Type")->withStatus(200);
    }

    function getValoreMinRDU(Request $request, Response $response, $args){
        $ident = $args["identificativo"];
        $valoreMin = $args["valore_minimo"];
        $rilUm = getRDM();
        $ril = null;

        foreach($rilUm as $rilevatore){
            if($rilevatore->identificativo == $ident){
                $ril = $rilevatore;
                break;
            }
        }

        if($rilUm == null){
            $response->getBody()->write(json_encode(["errore" => "rilevatore di umidita non trovato"]));
            return $response->withHeader("Content-Type", "application/json")->withStatus(404);
        }

        $misFiltrate = array_filter($rilUm->getMisurazioni(), function ($misurazione) use ($valore_minimo){
            return $misurazione["valore"] > $valore_minimo;
        });

        $response->getBody()->write(json_encode($misFiltrate));
        return $response->withHeader("Content-Type")->withStatus(200);
    }
}

?>