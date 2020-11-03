$.ajax({
    url: "../funcionalidades/fila-assincrona.php",
    success: function(result) {
        $(".usuarios").html(result);
    },
    error: function() {
        $(".usuarios").html("Error");
    }
});