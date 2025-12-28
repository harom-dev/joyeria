<!-- Vista para editar una distribución existente -->
<div class="card">
    <div class="card-header">
        <h5>Modificar Tienda</h5>
    </div>
    <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data">

            <input type="hidden" class="form-control" value="<?php echo $tiendas->logo; ?>" name="antigua_logo" id="antigua_logo" aria-describedby="helpId""/><!-- almacena y no muestra el iD-->
            
            <div class="mb-3">
                <label for="logo" class="form-label">Logo:</label>
                <td><img src="vistas/images/otros/<?php echo $tiendas->logo; ?>" width="40" alt=""></td>
                <input type="file" class="form-control" name="logo" id="logo" aria-describedby="fileHelpId"/> <!-- required-->
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $tiendas->nombre; ?>" placeholder="Nombre Tienda"/>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección:</label>
                <input Required type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" value="<?php echo $tiendas->direccion; ?>" placeholder="Direccion"/>
            </div>
            <div class="mb-3">
                <label for="departamento" class="form-label">Departamento:</label>
                <input Required type="text" class="form-control" name="departamento" id="departamento" aria-describedby="helpId" value="<?php echo $tiendas->departamento; ?>" readonly placeholder="Departamento"/>
            </div>
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <select name="provincia" id="provincia" class="form-control" required">
                    <option value="">Seleccione Provincia</option>
                    <?php foreach ($provincias as $provincia) { ?>
                        <option value="<?php echo $provincia['id']; ?>"<?php if ($tiendas->nom_provincia == $provincia['nombre']) echo 'selected'; ?>>
                            <?php echo $provincia['nombre']; ?>
                        </option>
                        
                        <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="distrito">Distrito:</label>
                <select name="distrito" id="distrito" class="form-control" required data-selected-distrito="<?php echo htmlspecialchars($tiendas->distrito); ?>">
                    <option value="">Seleccione Distrito</option>
                    <?php foreach ($distritos as $distrito) { ?>
                        <option value="<?php echo $distrito['id']; ?>"<?php if ($tiendas->nom_distrito == $distrito['nombre']) echo ' selected'; ?>>
                            <?php echo htmlspecialchars($distrito['nombre']); ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="?controlador=tiendas&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
        </form>
    </div>
</div>

<!-- list. cascada sxxxxxxxxxxxxo -->
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