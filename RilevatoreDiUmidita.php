<?php

require __DIR__ . '/Rilevatore.php';

class RilevatoreDiUmidita extends Rilevatore implements JsonSerializable{ 
    public $posizione;

    public function __construct($identificativo, $misurazioni, $unitaDiMisura, $codiceSeriale){
        parent::__construct($identificativo, $misurazioni, $unitaDiMisura, $codiceSeriale);

        $this->posizione = posizione;
    }
}

?>