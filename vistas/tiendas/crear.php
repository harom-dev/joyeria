<!-- formulario de crear -->
<div class="card">
    <div class="card-header">Agregar Tiendas</div>
    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="logo" class="form-label">Logo:</label>
                <input type="file" class="form-control" name="logo" id="logo" aria-describedby="fileHelpId"/>
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre de la Tienda"/>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input Required type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion del la Tienda"/>
            </div>
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento:</label>
                <input readonly type="text" class="form-control" name="departamento" id="departamento" aria-describedby="helpId" value="Arequipa"/>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="provincia" class="form-control" required onchange="loadDistritos(this.value)">
                    <option value="">Seleccione Provincia</option>
                    <?php foreach ($provincias as $provincia) { ?>
                        <option value="<?php echo $provincia['id']; ?>">
                            <?php echo $provincia['nombre']; ?>
                        </option>
                        
                        <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="distrito">Distrito:</label>
                <select name="distrito" id="distrito" class="form-control" required>
                    <option value="">Seleccione Distrito</option>
                </select>
            </div>
            <br>
            <div class="mb-3">
                <input name="" id="" class="btn btn-success" type="submit" value="Agregar Tiendas" />
                <a href="?controlador=tiendas&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
            </div>   
        </form>
    
    
    </div>
    <div class="card-footer text-muted"></div>
</div>

<!-- list. cascada distrito -->
<script>
function loadDistritos() {
    // Obtener el ID de la provincia seleccionada
    const provinciaId = document.getElementById('provincia').value;

    // Si no se ha seleccionado ninguna provincia, limpiar los distritos
    if (provinciaId === "") {
        document.getElementById('distrito').innerHTML = "<option value=''>Seleccione Distrito</option>";
        return;
    }

    // Preparar los datos a enviar en el POST
    const formData = new FormData();
    formData.append('provincia_id', provinciaId);

    // Realizar la solicitud POST utilizando fetch
    fetch('?controlador=distritoPorProvincia&accion=cargarDistritos', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        // Insertar las opciones de distrito en el select correspondiente
        document.getElementById('distrito').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}
</script>
