<?php

require_once 'arbol.php';
require_once 'nodo.php';
require_once 'punto.php';

class BusquedaRango {

    private $puntoA;
    private $puntoB;
    private $arrayPuntos = array();
    private $data = array();

    public function __construct($puntoA, $puntoB) {
        $this->puntoA = $puntoA;
        $this->puntoB = $puntoB;
    }

    public function generarPuntosAleatorios() {
        $minDec = 0;
        $maxDec = 99;
        $min = 0;
        $max = 40;

        for($i=0; $i<1000; $i++) {
            $randomDec = random_int( $minDec, $maxDec ) * .01;
            $random = random_int( $min, $max );
            $x = $random + $randomDec;

            $randomDec = random_int( $minDec, $maxDec ) * .01;
            $random = random_int( $min, $max );
            $y = $random + $randomDec;

            array_push($this->arrayPuntos, new Punto($x,  $y));
        }

        // $point1 = new Punto(0.0, 0.0);
        // $point2 = new Punto(1.0, 1.0);
        // $point3 = new Punto(2.0, 2.0);
        // $point4 = new Punto(3.0, 3.0);
        // $point5 = new Punto(4.0, 4.0);
        // $point6 = new Punto(5.0, 5.0);
        // $point7 = new Punto(6.0, 6.0);
        // $this->arrayPuntos = array($point5, $point2, $point1, $point4, $point3, $point6, $point7);
    }

    public function ejecutar() {
        $arbolKD = new Arbol("x");
        $arbolKD->constructor($this->arrayPuntos);

        $arbolKD->query2D($arbolKD->getRaiz(), $this->puntoA, $this->puntoB);
        $puntosDentro = $arbolKD->getPuntosDentro();

        $this->data = array(
            'success' => 1,
            'code' => 200,
            'status' => 'success',
            'puntos' => getPuntosJson($this->arrayPuntos),
            'puntosDentro' => getPuntosJson($puntosDentro),
            'puntoA' => $this->puntoA->getJsonArray(),
            'puntoB' => $this->puntoB->getJsonArray()
        );
    }

    public function getData() {
        return $this->data;
    }

}

?>