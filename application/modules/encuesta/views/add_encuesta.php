<form role="form bor-rad" enctype="multipart/form-data" action="<?php echo base_url() . 'encuesta/add_edit' ?>" method="post">
  <div class="box-body">
    <div class="row">
      <div class="col-sm-4">
        <div class="form-group">
          <label for="periodo">Periodo</label>
          <input 
            id="periodo" 
            name="periodo" 
            type="number" 
            class="form-control" 
            placeholder="Periodo"
            value="<?php echo isset($encuestaData->periodo) ? $encuestaData->periodo : '';?>"
          >
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="carrera">Carrera</label>
          <select class="form-control" id="carrera" name="carrera">
            <option value="">Seleccione</option>
            <?php foreach ($carreras as $carrera) { ?>
              <option 
                value="<?php echo $carrera->codigo ?>" <?php echo (isset($encuestaData->carrera) && $encuestaData->carrera == $carrera->codigo) ? 'selected' : ''; ?> >
                <?php echo $carrera->carrera ?>
              </option>
            <?php } ?>
          </select>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="form-group">
          <label for="sede">Sede</label>
          <select class="form-control" id="sede" name="sede">
            <option value="">Seleccione</option>
          </select>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="desde">Desde</label>
          <input 
            type="date" 
            class="form-control" 
            id="desde" 
            name="desde" 
            placeholder="Desde"
            value="<?php echo isset($encuestaData->desde) ? $encuestaData->desde : '';?>"
          >
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="hasta">Hasta</label>
          <input 
            type="date" 
            class="form-control" 
            id="hasta" 
            name="hasta" 
            placeholder="Hasta"
            value="<?php echo isset($encuestaData->hasta) ? $encuestaData->hasta : '';?>"
          >
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group">
          <label for="materias">Materias</label>
          <select class="form-control chosen-select" id="materias" name="materias[]" multiple>
            <option value="">Seleccione</option>
          </select>
        </div>
      </div>
      <?php if (!empty($encuestaData->id)) {?>
        <input type="hidden"  name="id" value="<?php echo isset($encuestaData->id)?$encuestaData->id:'';?>">
        <div class="box-footer sub-btn-wdt">
          <button type="submit" name="edit" value="edit" class="btn btn-success wdt-bg">Actualizar</button>
        </div>
        <!-- /.box-body -->
        <?php } else {?>
        <div class="box-footer sub-btn-wdt">
          <button type="submit" name="submit" value="add" class="btn btn-success wdt-bg">Guardar</button>
        </div>
        <?php } ?>
    </div>
  </div>
</form>