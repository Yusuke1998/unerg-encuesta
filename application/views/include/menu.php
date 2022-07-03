<?php if (CheckPermission("user", "own_read")) { ?>
<li class="<?= ($this->router->method === "userTable") ? "active" : "not-active" ?>">
    <a href="<?php echo base_url(); ?>user/userTable"> <i class="fa fa-users"></i> <span>Usuarios</span></a>
</li>
<?php } ?>

<?php if (CheckPermission("user", "own_read")) { ?>
<li class="<?= ($this->router->class === "encuesta") ? "active" : "not-active" ?>">
    <a href="<?php echo base_url("encuesta"); ?>"><i class="fa fa-info-circle"></i> <span>Encuestas</span></a>
</li>
<?php } ?>

<?php if (CheckPermission("user", "own_read")) { ?>
<li class="<?= ($this->router->class === "materia") ? "active" : "not-active" ?>">
    <a href="<?php echo base_url("materia"); ?>"><i class="fa fa-info-circle"></i> <span>Materias</span></a>
</li>
<?php } ?>

<?php if (CheckPermission("user", "own_read")) { ?>
<li class="<?= ($this->router->class === "reporte") ? "active" : "not-active" ?>">
    <a href="<?php echo base_url("reporte"); ?>"><i class="fa fa-info-circle"></i> <span>Reportes</span></a>
</li>
<?php } ?>

<?php if (isset($this->session->userdata('user_details')[0]->user_type) && $this->session->userdata('user_details')[0]->user_type == 'admin') { ?>
<li class="<?= ($this->router->class === "setting") ? "active" : "not-active" ?>">
    <a href="<?php echo base_url("setting"); ?>"><i class="fa fa-cogs"></i> <span>Configuracion General</span></a>
</li>
<?php } ?>