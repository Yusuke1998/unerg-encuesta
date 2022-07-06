<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <?php if ($this->session->flashdata("messagePr")) { ?>
            <div class="alert alert-info">
                <?php echo $this->session->flashdata("messagePr") ?>
            </div>
        <?php } ?>
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Reportes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form role="form bor-rad" action="<?php echo base_url() . 'reporte/make' ?>" method="post">
                            <div class="row">
                                <div class="col-sm-2 col-sm-offset-1">
                                    <div class="form-group">
                                        <label for="anio">Año</label>
                                        <select class="form-control" id="anio" name="anio">
                                            <option value="">Seleccione</option>
                                            <?php for ($anio = date('Y'); $anio >= 2020; $anio--) { ?>
                                                <option value="<?php echo $anio ?>" <?php echo isset($data['anio']) && $data['anio'] == $anio ? 'selected' : '' ?>><?php echo $anio ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="carrera">Carrera</label>
                                        <select class="form-control" id="carrera" name="carrera">
                                            <option value="">Seleccione</option>
                                            <?php foreach ($carreras as $carrera) { ?>
                                                <option value="<?php echo $carrera->codigo ?>" <?php echo (isset($data['carrera']) && $data['carrera'] == $carrera->codigo) ? 'selected' : ''; ?> >
                                                    <?php echo $carrera->carrera ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="sede">Sede</label>
                                        <select class="form-control" id="sede" name="sede">
                                            <option value="">Seleccione</option>
                                            <?php foreach ($sedes as $sede) { ?>
                                                <option value="<?php echo $sede->codigo ?>" <?php echo (isset($data['sede']) && $data['sede'] == $sede->codigo) ? 'selected' : ''; ?> >
                                                    <?php echo $sede->sede ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="tipo_reporte">Tipo de reporte</label>
                                        <select class="form-control" id="tipo_reporte" name="tipo_reporte">
                                            <option value="general" <?php echo isset($data['tipo_reporte']) && $data['tipo_reporte'] == 'general' ? 'selected' : '' ?>>General</option>
                                            <option value="resumen" <?php echo isset($data['tipo_reporte']) && $data['tipo_reporte'] == 'resumen' ? 'selected' : '' ?>>Resumen</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label>
                                        <button type="submit" class="btn btn-success btn-block">Buscar</button>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <?php
                                        if (isset($data['table'])) {
                                            echo $data['table'];
                                        }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        var url = '<?php echo base_url(); ?>';
        var table = $('#example1').DataTable({
            dom: 'lfBrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ],
            // "processing": true,
            // "serverSide": true,
            // "ajax": url + "reporte/dataTable",
            // "sPaginationType": "full_numbers",
            "language": {
                "search": "_INPUT_",
                "searchPlaceholder": "Search",
                "paginate": {
                    "next": '<i class="fa fa-angle-right"></i>',
                    "previous": '<i class="fa fa-angle-left"></i>',
                    "first": '<i class="fa fa-angle-double-left"></i>',
                    "last": '<i class="fa fa-angle-double-right"></i>'
                }
            },
            "iDisplayLength": 10,
            "aLengthMenu": [
                [10, 25, 50, 100, 500, -1],
                [10, 25, 50, 100, 500, "All"]
            ]
        });
    });
</script>