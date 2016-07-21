/**
 * Created by Nicolas on 0017, 17-06-2016.
 */

$(function () {
    var direccionRecogida = $('#direccion_recogida');
    var direccionDestino = $('#direccion_destino');

    direccionRecogida.geocomplete();
    direccionDestino.geocomplete();

    $('.datepicker').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "es",
        todayHighlight: true
    });
});