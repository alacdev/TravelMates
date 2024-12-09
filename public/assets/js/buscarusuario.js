document.querySelectorAll('.clickable-cell').forEach(function(cell) {
    cell.addEventListener('click', function() {
        window.location = cell.getAttribute('data-href');
    });
});

function manejarSolicitud(boton, accion) {
    var usuarioId = $(boton).data('usuario-id');
    var busqueda = $(boton).data('busqueda');
    var url = accion === 'enviar' ? 'enviar-solicitud/' + usuarioId : 'cancelar-solicitud/' + usuarioId;

    $.ajax({
        url: url,
        type: 'POST',
        data: { busqueda: busqueda },
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                if (accion === 'enviar') {
                    $(boton).removeClass('btn-primary').addClass('btn-success')
                        .html('<i class="fa fa-clock"></i>&nbsp; Pendiente')
                        .attr('onclick', 'manejarSolicitud(this, "cancelar")')
                        .hover(
                            function() {
                                $(this).removeClass('btn-success').addClass('btn-danger')
                                    .html('<i class="fa fa-times"></i>&nbsp; Cancelar');
                            },
                            function() {
                                $(this).removeClass('btn-danger').addClass('btn-success')
                                    .html('<i class="fa fa-clock"></i>&nbsp; Pendiente');
                            }
                        );
                } else {
                    $(boton).removeClass('btn-success').addClass('btn-primary')
                        .html('<i class="fa fa-paper-plane"></i>&nbsp; Enviar solicitud')
                        .attr('onclick', 'manejarSolicitud(this, "enviar")')
                        .off('mouseenter mouseleave');
                }
            } else {
                alert('No se pudo procesar la solicitud.');
            }
        },
        error: function() {
            alert('Error al procesar la solicitud.');
        }
    });
}