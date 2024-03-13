<?php

class Impianto implements JsonSerializable{
    public $nome = "";
    public $longitudine = "";
    public $latitudine = "";
    public $rilevatori = array();

    public function __construct($nome, $longitudine, $latitudine){
        $this->nome = nome;
        $this->longitudine = longitudine;
        $this->latitudine = latitudine;
        $this->rilevatori = array(
            new Rilevatore(1, "%", "a123", 1); //1 = terra, 2 = aria
            new Rilevatore(2, "%", "a456", 2);
            new Rilevatore(3, "°C", "b123", 1); //1 = acqua, 2 = aria
            new Rilevatore(4, "°C", "b456", 2);
        );
    }

    public function jsonSerialize() {
        $elements = [
            "nome"=>$this->nome,
            "longitudine"=>$this->longitudine,
            "latitudine"=>$this->latitudine
        ];
        return $elements;
    }

    function getRilevatore($nome) {
            
        $string = "";

        foreach($this->rilevatori as $e) {
            if($e->getNome() == $nome) {
                $string = $e->toString();
            }
        }

        if($string == "") {
            return "Rilevatore non trovato";
        }

        return $string;
    }

    function toString() {

        $string = "";

        foreach($this->rilevatori as $e) {
            $string = $string . $e->toString();
        }
        return $string;
    }

    function getRDU(){
        $rdu = array();

        foreach($this->rilevatori as $rilevatore){
            if($rilevatore instanceof RilevatoreDiUmidita){
                $rdu[] = $rilevatore;
            }
        }
        return $rdu;
    }

    function getRDT(){
        $rdu = array();

        foreach($this->rilevatori as $rilevatore){
            if($rilevatore instanceof RilevatoreDiTemperatura){
                $rdu[] = $rilevatore;
            }
        }
        return $rdu;
    }
}

?>