$.ajax({
    url: "../salas/fila.php",
    success: function(result) {
        $(".usuarios").html(result);
    },
    error: function() {
        $(".usuarios").html("Error");
    }
});