$(document).ready(function() {
    // Inicializar Select2 con el tema de Bootstrap4
    $('#intereses').select2({
      theme: 'bootstrap4', // Usa el tema de Bootstrap4
      placeholder: "Elige tus hobbies...", // Texto inicial
      allowClear: true // Agrega un botón para limpiar la selección
    });
  });

  const input = document.getElementById('residencia');
        const suggestionsContainer = document.getElementById('sugerencias');

        input.addEventListener('input', async () => {
            const query = input.value.trim();

            if (!query) {
                suggestionsContainer.innerHTML = '';
                return;
            }

            const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&addressdetails=1&limit=5`);
            const results = await response.json();

            suggestionsContainer.innerHTML = '';

            results.forEach(result => {
                const div = document.createElement('div');
                div.className = 'suggestion-item';
                div.textContent = result.display_name;
                div.onclick = () => {
                    input.value = result.display_name;
                    suggestionsContainer.innerHTML = '';
                };
                suggestionsContainer.appendChild(div);
            });
        });