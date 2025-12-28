document.addEventListener('DOMContentLoaded', function() {
    const provinciaSelect = document.getElementById('provincia');
    if (provinciaSelect) {
        provinciaSelect.addEventListener('change', loadDistritos);
        
        // Cargar distritos si ya hay una provincia seleccionada
        const provinciaId = provinciaSelect.value;
        if (provinciaId) {
            loadDistritos(); 
        }
    }
});

function loadDistritos() {
    const provinciaId = document.getElementById('provincia').value;

    if (provinciaId === "") {
        document.getElementById('distrito').innerHTML = "<option value=''>Seleccione Distrito</option>";
        return;
    }

    const formData = new FormData();
    formData.append('provincia_id', provinciaId);

    fetch('?controlador=distritoPorProvincia&accion=cargarDistritos', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const distritoSelect = document.getElementById('distrito');
        distritoSelect.innerHTML = data;

        // Preseleccionar el distrito si se está editando
        const selectedDistrito = distritoSelect.getAttribute('data-selected-distrito');
        if (selectedDistrito) {
            distritoSelect.value = selectedDistrito;
        }
    })
    .catch(error => console.error('Error:', error));
}
