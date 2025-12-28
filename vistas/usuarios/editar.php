<!-- formulario de crear -->
<div class="card">
    <div class="card-header">Modificar Usuario</div>
    <div class="card-body">
    
        <form action="" method="post">
        <input type="hidden" class="form-control" value="<?php echo $usuarios->id; ?>" name="id" id="id" aria-describedby="helpId" placeholder="Escriba el ID"/><!-- almacena y no muestra el iD-->
            <div class="form-group">
                <label for="id_tienda">Tiendas:</label>
                <select name="id_tienda" id="id_tienda" class="form-control" required>
                    <option value="">Seleccione Tienda</option>
                    <?php foreach ($tiendas as $tienda) { ?>
                        <option value="<?php echo $tienda['id']; ?>"<?php if ($usuarios->nom_tienda == $tienda['nombre']) echo 'selected'; ?>>
                            <?php echo $tienda['nombre']; ?>
                        </option>
                        <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" value="<?php echo $usuarios->nombre; ?>"/>
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular:</label>
                <input Required type="text" class="form-control" name="celular" id="celular" aria-describedby="helpId" placeholder="Celular" value="<?php echo $usuarios->celular; ?>"/>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input Required type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="correo" value="<?php echo $usuarios->correo; ?>"/>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" value="<?php echo $usuarios->usuario; ?>"/>
            <div class="mb-3">
                <label for="clave" class="form-label">Clave:</label>
                <input Required type="password" class="form-control" name="clave" id="clave" aria-describedby="helpId" placeholder="Clave" value="<?php echo $usuarios->clave; ?>"/>
            </div>
            <div class="form-group">
                <label for="id_cargo">Cargo:</label>
                <select name="id_cargo" id="id_cargo" class="form-control" required>
                    <option value="">Seleccione Cargo</option>
                    <?php foreach ($cargos as $cargo) { ?>
                        <option value="<?php echo $cargo['id']; ?>" <?php if ($usuarios->nom_cargo == $cargo['nombre']) echo 'selected'; ?>>
                            <?php echo $cargo['nombre']; ?>
                        </option>
                        
                        <?php } ?>
                </select>
            </div>
         <br>
            <div class="mb-3">
                <input name="" id="" class="btn btn-success" type="submit" value="Modificar Usuario" />
                <a href="?controlador=usuarios&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
            </div>   
        </form>
    
    
    </div>
    <div class="card-footer text-muted"></div>
</div>
