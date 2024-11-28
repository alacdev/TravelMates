const inputFile = document.getElementById("foto-perfil");
const previewImage = document.getElementById("foto-preview");

inputFile.addEventListener("change", function (event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const img = new Image();
            img.src = e.target.result;

            img.onload = function () {
                const canvas = document.createElement("canvas");
                const ctx = canvas.getContext("2d");

                const sideLength = Math.min(img.width, img.height);
                const x = (img.width - sideLength) / 2;
                const y = (img.height - sideLength) / 2;

                canvas.width = sideLength;
                canvas.height = sideLength;

                ctx.drawImage(img, x, y, sideLength, sideLength, 0, 0, sideLength, sideLength);

                previewImage.src = canvas.toDataURL("image/jpeg");
            };
        };
        reader.readAsDataURL(file);
    }
});
