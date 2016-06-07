$(function () {
    $('#rut').Rut({
        on_error: function () {
            alert("Rut ingresado no valido")
        }
    });
});
