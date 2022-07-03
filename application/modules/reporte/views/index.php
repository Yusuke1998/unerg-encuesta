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
                        <div class="box-tools">
                            <button type="button" class="btn-sm  btn btn-success modalButtonGeneral" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> General</button>
                            <button type="button" class="btn-sm  btn btn-success modalButtonResumen" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Resumen</button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
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
        $('.modalButtonGeneral').click(function() {
            console.log('modalButtonGeneral')
            // $('#modalGeneral').modal('show');
        });
        $('.modalButtonResumen').click(function() {
            console.log('modalButtonResumen')
            // $('#modalResumen').modal('show');
        });
    });
</script>