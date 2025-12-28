<div class="card">
    <div class="card-header">Modificar Material</div>
    <div class="card-body">
    
        <form action="" method="post">
        <input type="hidden" class="form-control" value="<?php echo $materiales->id; ?>" name="id" id="id" aria-describedby="helpId" placeholder="Escriba el ID"/><!-- almacena y no muestra el iD-->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input Required type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" value="<?php echo $materiales->nombre; ?>"/>
            </div>
            <div class="mb-3">
                <input name="" id="" class="btn btn-success" type="submit" value="Modificar Material" />
                <a href="?controlador=materiales&accion=inicio" class="btn btn-outline-danger">Cancelar</a>
 
            </div>
            
        </form>
    
    
    </div>
    <div class="card-footer text-muted"></div>
</div>