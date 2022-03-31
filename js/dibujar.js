
function acomodar(jsonData) {
    var arrayPuntos = jsonData['puntos'];
    var puntosDentro = jsonData['puntosDentro'];
    var puntoA = jsonData['puntoA'];
    var puntoB = jsonData['puntoB'];
    var i;

    for(i=0; i<puntosDentro.length; i++)
    puntosDentro[i].yValue = puntosDentro[i].yValue * -1;

    for(i=0; i<arrayPuntos.length; i++)
        arrayPuntos[i].yValue = arrayPuntos[i].yValue * -1;

    puntoA.xValue = parseInt(puntoA.xValue);
    puntoA.yValue = parseInt(puntoA.yValue);

    puntoB.xValue = parseInt(puntoB.xValue);
    puntoB.yValue = parseInt(puntoB.yValue);

    puntoA.yValue = puntoA.yValue * -1;
    puntoB.yValue = puntoB.yValue * -1;

    var min=arrayPuntos[0].yValue;
    for(i=1; i<arrayPuntos.length; i++){
        if( arrayPuntos[i].yValue < min ) {
            min = arrayPuntos[i].yValue;
        }
    }

    if(min<0)
        min = min * -1;

    puntoA.yValue = puntoA.yValue + min;
    puntoB.yValue = puntoB.yValue + min;

    for(i=0; i<puntosDentro.length; i++)
        puntosDentro[i].yValue = puntosDentro[i].yValue + min;

    for(i=0; i<arrayPuntos.length; i++)
        arrayPuntos[i].yValue = arrayPuntos[i].yValue + min;
}

function distanciaEntrePuntos(puntoA, x2, y2) {
    return Math.sqrt( Math.pow(x2-puntoA.xValue, 2) + Math.pow(y2-puntoA.yValue, 2) );
}

function dibujarRectangulo(ctx, puntoA, puntoB) {
    var trasladar = 0;
    var agrandar = 20;

    // Grosor de línea
    ctx.lineWidth = 5;
    // Color de línea
    ctx.strokeStyle = "#0065FF";
    // Dibujamos un rectángulo con la función strokeRect
    ctx.strokeRect(
        (puntoA.xValue+trasladar)*agrandar, (puntoB.yValue+trasladar)*agrandar,
        (distanciaEntrePuntos(puntoA, puntoB.xValue, puntoA.yValue)+trasladar)*agrandar, (distanciaEntrePuntos(puntoB, puntoB.xValue, puntoA.yValue)+trasladar)*agrandar);
}

function dibujarPuntos(ctx, puntos, puntosDentro) {
    var trasladar = 0;
    var agrandar = 20;

    // Dibujamos todos los puntos
    var pointSize = 6; // Cambia el tamaño del punto
    ctx.fillStyle = "#6D8264"; // Color
    for(i=0; i<puntos.length; i++) {
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (puntos[i].xValue + trasladar) * agrandar , (puntos[i].yValue + trasladar) * agrandar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo
    }

    // Dibujamos todos los puntos dentro del rectangulo
    var pointSize = 6; // Cambia el tamaño del punto
    ctx.fillStyle = "#000000"; // Color
    for(i=0; i<puntosDentro.length; i++) {
        ctx.beginPath(); // Iniciar trazo
        ctx.arc( (puntosDentro[i].xValue + trasladar) * agrandar , (puntosDentro[i].yValue + trasladar) * agrandar, pointSize, 0, Math.PI * 2, true); // Dibujar un punto usando la funcion arc
        ctx.fill(); // Terminar trazo
    }

}

function dibujarTodo(jsonData) {

    var canvas = document.getElementById('canvasHTML');
    var puntos = jsonData['puntos'];
    var puntosDentro = jsonData['puntosDentro'];
    var puntoA = jsonData['puntoA'];
    var puntoB = jsonData['puntoB'];

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, 1000, 1000);

        dibujarRectangulo(ctx, puntoA, puntoB);
        dibujarPuntos(ctx, puntos, puntosDentro);

    }

}