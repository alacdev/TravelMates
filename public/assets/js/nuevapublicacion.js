$(document).ready(function() {
    $('#imagen').change(function(e) {
        var file = e.target.files[0];
        var reader = new FileReader();
        reader.onload = function(event) {
            var img = new Image();
            img.onload = function() {
                var canvasSize = 575;
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');
                canvas.width = canvas.height = canvasSize;

                var offsetX = (img.width - canvasSize) / 2;
                var offsetY = (img.height - canvasSize) / 2;

                ctx.drawImage(img, offsetX, offsetY, canvasSize, canvasSize, 0, 0, canvasSize, canvasSize);

                $('#imagen-preview').html(canvas);
            };
            img.src = event.target.result;
        };
        reader.readAsDataURL(file);
    });
});