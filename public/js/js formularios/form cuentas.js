$(function () {
    $('#rut').Rut({
        on_error: function () {
            alert("Rut ingresado no valido")
        }
    });
    $('input:radio[name="tipo"]').on('change', function () {
        if ($(this).val() == 'cliente' || $(this).val() == 'ambos') {
            $('#empresas').show();
        }
        else {
            $('#empresas').hide();
        }
    });
});
