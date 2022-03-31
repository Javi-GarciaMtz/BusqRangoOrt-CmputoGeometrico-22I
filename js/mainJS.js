
$(document).ready(function() {
    $('#puntosform').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: 'php/mainPHP.php',
            data: $(this).serialize(),
            success: function(response)
            {
                var jsonData = JSON.parse(response);

                if(jsonData.success == 1) {
                    console.log(jsonData);
                    acomodar(jsonData);
                    localStorage.setItem('jsonDatos', JSON.stringify( jsonData ) );
                    window.alert("Ejecucion realizada correctamente. Ya se puede dibujar...");
                } else {
                    window.alert("Error con los Puntos A y B ingresados!");
                }

            }
        });
    });
});

function dibujar() {
    var jsonDatos = JSON.parse( localStorage.getItem('jsonDatos') );
    dibujarTodo(jsonDatos);
}

function limpiarCanvas() {
    var canvas = document.getElementById('canvasHTML');

    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        ctx.clearRect(0, 0, 1000, 1000);
    }
}