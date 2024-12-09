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

        ctx.drawImage(
          img,
          x,
          y,
          sideLength,
          sideLength,
          0,
          0,
          sideLength,
          sideLength
        );

        previewImage.src = canvas.toDataURL("image/jpeg");
      };
    };
    reader.readAsDataURL(file);
  }
});

/** Residencia */
const input = document.getElementById("residencia");
const suggestionsContainer = document.getElementById("sugerencias");

input.addEventListener("input", async () => {
  const query = input.value.trim();

  if (!query) {
    suggestionsContainer.innerHTML = "";
    return;
  }

  const response = await fetch(
    `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
      query
    )}&addressdetails=1&limit=5`
  );
  const results = await response.json();

  suggestionsContainer.innerHTML = "";

  results.forEach((result) => {
    const div = document.createElement("div");
    div.className = "sugerencias-item";
    div.textContent = result.display_name;
    div.onclick = () => {
      input.value = result.display_name;
      suggestionsContainer.innerHTML = "";
    };
    suggestionsContainer.appendChild(div);
  });
});

document.getElementById("residencia").addEventListener("input", function () {
  const input = this.value.trim();
  const sugerencias = document.getElementById("sugerencias");

  if (input.length > 0) {
    // Simula una lista de resultados
    const resultados = [
      "Ciudad de México",
      "Madrid",
      "Buenos Aires",
      "Nueva York",
    ].filter((ciudad) => ciudad.toLowerCase().includes(input.toLowerCase()));

    sugerencias.innerHTML = resultados
      .map((ciudad) => `<div class="sugerencias-item">${ciudad}</div>`)
      .join("");

    sugerencias.style.display = "block";
  } else {
    sugerencias.style.display = "none";
  }
});

// Agregar funcionalidad al seleccionar una sugerencia
document
  .getElementById("sugerencias")
  .addEventListener("click", function (event) {
    if (event.target.classList.contains("sugerencias-item")) {
      const selectedText = event.target.textContent;
      document.getElementById("residencia").value = selectedText;
      this.style.display = "none";
    }
  });
