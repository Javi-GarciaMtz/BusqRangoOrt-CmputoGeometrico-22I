<?php

require_once 'punto.php';

class Nodo {

    public $izq;
    public $der;
    public $subArbol = null;
    public $punto;
    public $puntos;

    public function __construct($punto, $puntos) {
        $this->punto = $punto;
        $this->puntos = $puntos;
    }

}

?>