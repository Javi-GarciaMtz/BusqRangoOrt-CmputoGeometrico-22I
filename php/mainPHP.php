<?php

require_once 'punto.php';
require_once 'nodo.php';
require_once 'arbol.php';
require_once 'busquedaRango.php';

function getPuntosJson($puntos) {
    $arrayJson = array();
    foreach ($puntos as $punto) {
        array_push($arrayJson, $punto->getJsonArray());
    }
    return $arrayJson;
}

if (
        isset($_POST['x1']) && is_numeric($_POST['x1']) &&
        isset($_POST['y1']) && is_numeric($_POST['y1']) &&
        isset($_POST['x2']) && is_numeric($_POST['x2']) &&
        isset($_POST['y2']) && is_numeric($_POST['y2'])
    ) {

    $puntoA = new Punto($_POST['x1'], $_POST['y1']);
    $puntoB = new Punto($_POST['x2'], $_POST['y2']);

    $busqueda = new BusquedaRango($puntoA, $puntoB);
    $busqueda->generarPuntosAleatorios();
    $busqueda->ejecutar();
    $data = $busqueda->getData();

    echo json_encode( $data );

} else {
    echo json_encode(array('success' => 0));
}

?>
