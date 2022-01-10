<style>
    .panel-title
    {
        font-size: 13px;
        font-weight: bold;
    }
     .table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td{
    padding: 4px;
	}
	button, .buttons, .btn, .modal-footer .btn+.btn {
    margin-bottom: 0px;
	} 
    .labelMsg
    {
        font-size: 13px;

    }
    .label-success {
    background-color: #26b99a;
}

</style>
<div class="form-horizontal">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div>
                <input type="hidden" id="id_pi" value="<?=$proyecto[0]->id_pi?>"><br>
                <textarea style="font-size: 13px;" name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="2" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=html_escape(trim($proyecto[0]->nombre_pi))?></textarea>
            </div>
        </div>
    </div>
    <div class="row" style="height: 300px;overflow-y: scroll; margin-top: 15px;">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="maccordion2" role="tablist" aria-multiselectable="true">
                <?php foreach ($producto as $key => $value) { ?>
                <div class="panel">
                    <div class="panel-heading" style="padding: 6px;">
                        <h4 class="panel-title" style="float:right;">
                            <?php if($this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9 || $this->session->userdata('tipoUsuario')==7) { ?>
                            <a onclick="paginaAjaxDialogo('modalResultadoMonitoreo2', 'Agregar Monitoreo',{ idProyectoMonitoreo:'<?=$proyecto[0]->id_pi?>',idProducto : '<?=$value->id_producto?>', opcion:'producto' , descripcion:'<?=$value->desc_producto?>'}, base_url+'index.php/Mo_MonitoreoResultado/verresultado', 'GET', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Monitoreo de Producto" role="button" class="btn btn-round btn-warning btn-xs"><i class="fa fa-plus"></i> Monitoreo</a><?php } ?>
                        </h4>
                        <a class="panel-title" id="meheading<?=$value->id_producto?>" data-toggle="collapse" data-parent="#maccordion2" href="#mecollapse<?=$value->id_producto?>" aria-expanded="false" aria-controls="mecollapse<?=$value->id_producto?>" style="text-transform: uppercase;"><?=$value->desc_producto?>
                        </a>
                    </div>
                    <?php if(count($value->childActividad)>0) { ?>
                    <div id="mecollapse<?=$value->id_producto?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="meheading<?=$value->id_producto?>">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mitabla">
                                    <thead>
                                        <tr>
                                            <th>Actividad</th>
                                            <th>Meta</th>
                                            <th>U.Medida</th>
                                            <th>Costo Total</th>
                                            <th>Peso</th>
                                            <th>Fecha de Inicio</th>
                                            <th>Fecha de Fin</th>
                                            <th>Estado</th>
                                            <th>Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach($value->childActividad as $key => $actividad){?>
                                        <tr style='background-color:<?php echo ($actividad->culminado==1) ? "#c8ece5" : "#f9f9f9";?>' id="trActividad<?=$actividad->id_actividad?>">
                                            <td><?=$actividad->desc_actividad?></td>
                                            <td><?=$actividad->meta?></td>
                                            <td><?=$actividad->uni_medida?></td>
                                            <td><?=a_number_format($actividad->costo_total , 2, '.',",",3)?></td>
                                            <td><?=$actividad->valoracion_actividad*100?> %</td>
                                            <td><?=$actividad->fecha_inicio?></td>
                                            <td><?=$actividad->fecha_fin?></td>
                                            <td>
                                                <?php if ($actividad->culminado==1) { ?>
                                                <i class="label label-success labelMsg"><i class="fa fa-check-square"></i></i>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a onclick="paginaAjaxDialogo('modalResultadoMonitoreo2', 'Agregar Monitoreo', {idProyectoMonitoreo:'<?=$proyecto[0]->id_pi?>',idActividad:'<?=$actividad->id_actividad?>' , opcion:'actividad', descripcion:'<?=$actividad->desc_actividad?>' }, base_url+'index.php/Mo_MonitoreoResultado/verresultado', 'GET', null, null, false, true);return false;" role="button" class="btn btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Monitoreo de Actividad"><i class="fa fa-plus"></i> Agregar Monitoreo
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>                      
                        </div>
                    </div>
                    <?php }?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="row" style="text-align: right;">
        <button class="btn btn-danger" data-dismiss="modal">
            <span class="glyphicon glyphicon-remove"></span>
            Cerrar ventana
        </button>
    </div>
</div>
