$(document).ready(function() {
    // Inicializar Select2 con el tema de Bootstrap4
    $('#intereses').select2({
      theme: 'bootstrap4', // Usa el tema de Bootstrap4
      placeholder: "Elige tus hobbies...", // Texto inicial
      allowClear: true // Agrega un botón para limpiar la selección
    });
  });