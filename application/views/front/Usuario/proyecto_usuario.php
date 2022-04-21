<script src="https://kendo.cdn.telerik.com/2017.3.1026/js/kendo.all.min.js"></script>
<div class="right_col" role="main">
    <div>
        <div class="clearfix"></div>
        <div class="col-md-12 col-xs-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><b>ASIGNAR PROYECTOS A USUARIOS</b></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <!--<button onclick="paginaAjaxDialogo(null,'Registrar Usuario',null,base_url+'index.php/Usuario/itemUsuario','GET',null,null,false,true);" class="btn btn-primary"><span class="fa fa-plus"></span>  NUEVO</button>-->
                    <div class="table-responsive">
                        <table id="table_usuario_proyecto"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td class="col-md-1 col-xs-12">Usuario</td>
                                    <td class="col-md-3 col-xs-12">Nombres</td>
                                    <td class="col-md-1 col-xs-12">Opción</td>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($listaUsuario as $item){ ?>
                                  <tr>
                                    <td><?= $item->usuario ?></td>
                                    <td><?= $item->nombres." ".$item->apellido_p ?></td>
                                    <td>
                                      <button onclick="paginaAjaxDialogo(null,'Asignar Proyecto',{id_persona:<?=$item->id_persona?>},base_url+'index.php/Usuario/asignarProyecto','GET',null,null,false,true)"; class="btn btn-primary btn-xs"><span class="fa fa-edit"></span> Asignar</button>
                                    </td>
                                  </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
    <script>
    $(document).ready(function()
    {
        swal('','<?=$sessionTempCorrecto?>', "success");
    });
    </script>
<?php }

if($sessionTempError){ ?>
    <script>
    $(document).ready(function()
    {
    swal('','<?=$sessionTempError?>', "error");
    });
    </script>
<?php } ?>

<script>

$(document).ready(function()
{
    $('#table_usuario_proyecto').DataTable(
    {
        "language":idioma_espanol
    });
});

</script>
