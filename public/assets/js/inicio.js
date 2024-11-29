function toggleLike(publicacionId, like) {
    $.ajax({
        url: like ? 'me-gusta/' + publicacionId : 'no-me-gusta/' + publicacionId,
        type: 'POST',
        success: function(response) {
            var result = JSON.parse(response);
            if (result.success) {
                var heartIcon = $('#heart-' + publicacionId);
                if (like) {
                    heartIcon.css('color', 'red');
                    heartIcon.parent().attr('onclick', 'toggleLike(' + publicacionId + ', false)');
                } else {
                    heartIcon.css('color', '');
                    heartIcon.parent().attr('onclick', 'toggleLike(' + publicacionId + ', true)');
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