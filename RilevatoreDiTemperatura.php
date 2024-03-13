<?php

require __DIR__ . '/Rilevatore.php';

class RilevatoreDiTemperatura extends Rilevatore implements JsonSerializable{
    public $tipologia;

    public function __construct($identificativo, $misurazioni, $unitaDiMisura, $codiceSeriale){
        parent::__construct($identificativo, $misurazioni, $unitaDiMisura, $codiceSeriale);
        $this->tipologia = tipologia;
    }
}

?>