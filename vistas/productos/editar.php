<!-- formulario de crear -->
<div class="card">
    <div class="card-header">Modificar Producto</div>
    <div class="card-body">
    
        <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" class="form-control" value="<?php echo $Productos->foto; ?>" name="antigua_foto" id="antigua_foto" aria-describedby="helpId""/><!-- almacena y no muestra el iD-->
            <div class="mb-3">
                <label for="foto" class="form-label">Foto:</label>
                <td><img src="vistas/images/producto/<?php echo $Productos->foto; ?>" width="40" alt=""></td>
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="fileHelpId"/> <!-- required-->
            </div>

            <div class="form-group">
                <label for="id_material">Material:</label>
                <select name="id_material" id="id_material" class="form-control" required>
                    <option value="">Seleccionar Material</option>
                    <?php foreach ($materiales as $material) { ?>
                        <option value="<?php echo $material['id']; ?>"<?php if ($Productos->nom_material == $material['nombre']) echo 'selected'; ?>>
                            <?php echo $material['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_categoria">Categoria:</label>
                <select name="id_categoria" id="id_categoria" class="form-control" required>
                    <option value="">Seleccionar Categoria</option>
                    <?php foreach ($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria['id']; ?>"<?php if ($Productos->nom_categoria == $categoria['nombre']) echo 'selected'; ?>>
                            <?php echo $categoria['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Producto:</label>
                    <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $Productos->nombre; ?>"/>
            </div>

            <div class="mb-3">
            <label for="descripcion" class="form-label">Descripcion:</label>
            <input Required type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" value="<?php echo $Productos->descripcion; ?>"/>
            </div>

            <div class="mb-3">
            <label for="medida" class="form-label">Medida:</label>
            <input Required type="number" class="form-control" name="medida" id="medida" aria-describedby="helpId" value="<?php echo $Productos->medida; ?>"/>
            </div>

            <div class="mb-3">
            <label for="p_ma" class="form-label">Precio al por Mayor:</label>
            <input Required type="number" class="form-control" name="p_ma" id="p_ma" aria-describedby="helpId" value="<?php echo $Productos->p_ma; ?>"/>
            </div>

            <div class="mb-3">
            <label for="peso" class="form-label">Peso:</label>
            <input Required type="number" class="form-control" name="peso" id="peso" aria-describedby="helpId" value="<?php echo $Productos->peso; ?>"/>
            </div>

            <div class="mb-3">
                <input name="" id="" class="btn btn-success" type="submit" value="Modificar Productos" />
                <a href="?controlador=productos&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
            </div>   
        </form>
    
    
    </div>
    <div class="card-footer text-muted"></div>
</div>