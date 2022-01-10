<style>
    .panel-title 
    {
        font-size: 13px;
        font-weight: bold;
    }
    .active a span.fa 
    {
    text-align: right !important;
    margin-right: 0px;
    }
</style>  
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
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
                    <div class="accordion" id="accordionVb" role="tablist" aria-multiselectable="true">
                        <?php foreach ($producto as $key => $value) { ?>                
                        <div class="panel">
                            <div class="panel-heading" style="padding: 6px;">
                                <h4 class="panel-title" style="float:right;">
                                    <?php if($this->session->userdata('tipoUsuario')==8 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9 || $this->session->userdata('tipoUsuario')==7) { ?>
                                    <a id="btn<?=$value->id_producto?>" onclick="paginaAjaxDialogo('modalVistoBueno', 'Visto Bueno',{idPi:'<?=$proyecto[0]->id_pi?>', idProducto : '<?=$value->id_producto?>', opcion:'producto' , descripcion:'<?=$value->desc_producto?>'}, base_url+'index.php/Mo_ProActVistoBueno/vistoBueno', 'POST', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Visto Bueno al Producto" role="button" class='btn btn-round <?php echo ($value->visto_bueno==1 ? "btn-success" : "btn-warning");?> btn-xs'><i class="fa fa-check-circle"></i> Visto Bueno</a>
                                    <?php } ?>
                                </h4>
                                <a class="panel-title" id="pheadingVb<?=$value->id_producto?>" data-toggle="collapse" data-parent="#accordionVb" href="#pcollapseVb<?=$value->id_producto?>" aria-expanded="false" aria-controls="pcollapseVb<?=$value->id_producto?>" style="text-transform: uppercase;"><?=$value->desc_producto?> (<?=a_number_format($value->valoracion_producto, 2, '.',",",3)?>) %
                                </a>
                            </div>
                            <?php if(count($value->childActividad)>0) { ?>
                            <div id="pcollapseVb<?=$value->id_producto?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pheadingVb<?=$value->id_producto?>">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <?php foreach ($value->childActividad as $key => $actividad) { ?>

                                        <table class="table table-bordered" id="tablaActividad<?=$actividad->id_actividad?>">
                                            <thead>
                                                <tr style="text-align: center; background-color: #f9f9f9;">
                                                    <th colspan="3" style="color: #ed5565; font-size: 12px; font-weight: bold; width: 80%;">
                                                    <?php if($this->session->userdata('tipoUsuario')==8 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9 || $this->session->userdata('tipoUsuario')==7) { ?>
                                                    <a id="btn<?=$actividad->id_actividad?>" onclick="paginaAjaxDialogo('modalVistoBueno', 'Visto Bueno',{idPi:'<?=$proyecto[0]->id_pi?>', idActividad : '<?=$actividad->id_actividad?>', opcion:'actividad' , descripcion:'<?=$actividad->desc_actividad?>'}, base_url+'index.php/Mo_ProActVistoBueno/vistoBueno', 'POST', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Visto Bueno a la Actividad" role="button" class="btn btn-primary <?php echo ($actividad->visto_bueno==1 ? "btn-success" : "btn-warning");?> btn-xs"><i class="fa fa-check-circle"></i> Visto Bueno</a><?php } ?>

                                                     <?=$actividad->desc_actividad?> (<?=a_number_format($actividad->valoracion_actividad*100, 2, '.',",",3)?>) %</th>
                                                    
                                                </tr>
                                                <tr style="background-color: #f9f9f9;">
                                                    <th style="width: 20%;">Mes</th>
                                                    <th style="width: 30%;">Ejec. Fis. Prog</th>
                                                    <th style="width: 30%;">Ejec. Fin. Prog</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyActividad<?=$actividad->id_actividad?>">
                                            <?php foreach ($actividad->childProgramacion as $key => $programacion) { ?>
                                            <tr style="background-color: #f9f9f9;"" id="trProgramacion<?=$programacion->id_actividad_programacion?>">
                                                <td><?=$programacion->fecha_programacion?></td>
                                                <td><?=$programacion->cantidad_ejecucion_programada?></td>
                                                <td><?=$programacion->ejec_finan_programada?></td>
                                            </tr>

                                            <?php } ?>

                                                
                                            </tbody>
                                        </table> 


                                        <?php } ?>
                                                                   
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
    </div>
</div>
  