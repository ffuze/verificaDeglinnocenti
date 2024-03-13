<?php

class Rilevatore implements JsonSerializable{
    public $identificativo;
    public $unitaDiMisura;
    public $codiceSeriale;
    public $misurazioni = array();

    public function __construct($identificativo, $misurazioni, $unitaDiMisura, $codiceSeriale){
        $this->identificativo = identificativo;
        $this->unitaDiMisura = unitaDiMisura;
        $this->codiceSeriale = codiceSeriale;
        $this->misurazioni = array(
            "27/07/2005" => "32",
            "28/12/1999" => "12"
        );
    }

    public function jsonSerialize() {
        $elements = [
            "identificativo"=>$this->identificativo,
            "unitaDiMisura"=>$this->unitaDiMisura,
            "codiceSeriale"=>$this->codiceSeriale
        ];
        return $elements;
    }

    function getNome(){
        return $this->nome;
    }

    function getMisurazioni(){
        return $this->misurazioni;
    }
}

?>