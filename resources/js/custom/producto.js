document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('form-producto');
    const btnSubmit = document.getElementById('btn-submit');
  
    form.addEventListener('submit', function(e) {
      // Deshabilitar botón para evitar dobles envíos
      btnSubmit.disabled = true;
      btnSubmit.textContent = 'Guardando...';
    });
  
    // Validación sencilla de ejemplo: precio y cantidad > 0
    form.addEventListener('input', function(e) {
      const precio = parseFloat(document.getElementById('precio').value) || 0;
      const cantidad = parseInt(document.getElementById('cantidad').value) || 0;
      if (precio <= 0 || cantidad <= 0) {
        btnSubmit.disabled = true;
      } else {
        btnSubmit.disabled = false;
      }
    });
  });
  