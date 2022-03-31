<?php

require_once 'nodo.php';
require_once 'punto.php';

class Arbol {
    private $raiz;
    private $por;
    private $puntosDentro = array();

    public function __construct($por) {
        $this->por = $por;
    }

    public function copyOfRange($array, $de, $hasta) {
        $temp = array();
        for($i=$de; $i<$hasta; $i++) {
            array_push($temp, $array[$i]);
        }
        return $temp;
    }

    public function utilConstruct($puntos) {
        if(count($puntos) == 0) {
            return null;

        } elseif(count($puntos) == 1) {
            return new Nodo($puntos[0], $puntos);

        } else {
            $mitad = intdiv(count($puntos), 2);

            $punto = $puntos[$mitad];
            $p1 = $this->copyOfRange($puntos, 0, $mitad);
            $p2 = $this->copyOfRange($puntos, $mitad+1, count($puntos));

            $u = new Nodo($punto, $puntos);
            $t1 = $this->utilConstruct($p1);
            $t2 = $this->utilConstruct($p2);

            $u->izq = $t1;
            $u->der = $t2;

            return $u;

        }
    }

    public function constructor($puntos) {
        sort($puntos);
        $this->raiz = $this->utilConstruct($puntos);
    }

    public function esHoja($nodo) {
        if(is_null($nodo) || ( is_null($nodo->izq) && is_null($nodo->der) )) {
            return true;
        }
        return false;
    }

    public function getRaiz() {
        return $this->raiz;
    }

    public function imprimirInOrden($nodo) {
        if(is_null($nodo)) {
            return ;
        }

        $this->imprimirInOrden($nodo->izq);

        echo  $nodo->punto->getX()." ";

        $this->imprimirInOrden($nodo->der);
    }

    public function getPuntosDentro() {
        return $this->puntosDentro;
    }

    public function query2D($nodo, $p1, $p2) {
        if(is_null($nodo)) {
            return ;
        }

        if(
            ($nodo->punto->getX() >= $p1->getX() && $nodo->punto->getX() <= $p2->getX()) &&
			($nodo->punto->getY() >= $p1->getY() && $nodo->punto->getY() <= $p2->getY())
        ) {
			array_push($this->puntosDentro, $nodo->punto);
		}

        if ( $nodo->punto->getX() < $p1->getX() ) {
			// Recorre solo los hijos de la derecha
			$this->query2D($nodo->der, $p1, $p2);
		} elseif( $nodo->punto->getX() > $p2->getX() ) {
			// Recorre solo los hijos de la izquierda
			$this->query2D($nodo->izq, $p1, $p2);

		} else {
			// Recorre ambos hijos
			$this->query2D($nodo->izq, $p1, $p2);
			$this->query2D($nodo->der, $p1, $p2);
		}

    }

}

?>