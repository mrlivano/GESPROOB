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
<div class="" role="tabpanel" data-example-id="togglable-tabs">   
    <ul id="myTab" class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#tabproyecto"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Productos</a>
        </li>
        <li role="presentation" class=""><a  href="#tabcronograma" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Programación de Actividades</a>
        </li>
    </ul>
    <div id="myTabContent" class="tab-content">
        <div role="tabpanel" class="tab-pane fade active in" id="tabproyecto" aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="form-horizontal">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div>
                                        <input type="hidden" id="id_pi" value="<?=$proyecto[0]->id_pi?>"><br>
                                        <textarea style="font-size: 13px;" name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="2" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=html_escape(trim($proyecto[0]->nombre_pi))?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                            <div>
                                <label style="color:red;font-size:12px;">Valoración Restante: <span id="hdValoracionRestante"><?=$valorizacionRestante?></span> %</label>
                            </div>
                            <div id="divAgregarProducto" class="row" style="margin-top: 3px;">
                                <div class="col-md-7 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="txtDescripcionProducto" name="txtDescripcionProducto" placeholder="Descripción del producto" style="width: 100%">
                                </div>
                                <div class="col-md-2 col-sm-6 col-xs-12 has-feedback">
                                    <input type="text" class="form-control" id="txtValoracion" name="txtValoracion" placeholder="Valoracion %" maxlength="5">
                                    <span class="form-control-feedback right" aria-hidden="true">%</span>               
                                </div>
                                <div class="col-md-3 col-sm-4 col-xs-12">
                                    <input type="button" class="btn btn-info" value="Agregar producto" onclick="agregarProducto();" style="width: 100%;">
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row" style="height: 300px;overflow-y: scroll; margin-top: 15px;">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                                        <?php foreach ($producto as $key => $value) { ?>                
                                        <div class="panel">
                                            <div class="panel-heading" style="padding: 6px;">
                                                <h4 class="panel-title" style="float:right;">
                                                    <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                    <a onclick="paginaAjaxDialogo('modalEditarProducto', 'Editar Producto',{ idPi: '<?=$value->id_pi?>' , idProducto : '<?=$value->id_producto?>' }, base_url+'index.php/Mo_MonitoreodeProyectos/editarDatosProducto', 'GET', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Editar Producto" role="button" class="btn btn-round btn-success btn-xs"><i class="fa fa-edit"></i></a><a onclick="eliminarProducto('<?=$value->id_producto?>',this);"  role="button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"><i class="fa fa-trash-o"></i></a><a onclick="paginaAjaxDialogo('modal2', 'Agregar Actividad',{ idPi: '<?=$value->id_pi?>' , idProducto : '<?=$value->id_producto?>' }, base_url+'index.php/Mo_Actividad/Insertar', 'GET', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Agregar Actividad" role="button" class="btn btn-round btn-warning btn-xs"><i class="fa fa-plus"></i></a><?php } ?>
                                                </h4>
                                                <a class="panel-title" id="heading<?=$value->id_producto?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$value->id_producto?>" aria-expanded="false" aria-controls="collapse<?=$value->id_producto?>" style="text-transform: uppercase;"><?=$value->desc_producto?> (<?=$value->valoracion_producto?> %)
                                                </a>
                                            </div>
                                            <div id="collapse<?=$value->id_producto?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$value->id_producto?>">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Actividad</th>
                                                                    <th>Meta</th>
                                                                    <th>U. Medida</th>
                                                                    <th>Costo Total</th>
                                                                    <th>Peso</th>
                                                                    <th>Fecha Inicio</th>
                                                                    <th>Fecha Fin</th>
                                                                    <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                                    <th>Opciones</th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($value->childActividad as $key => $actividad) { ?>
                                                                <tr>
                                                                    <td><?=$actividad->desc_actividad?></td>
                                                                    <td><?=$actividad->meta?></td>
                                                                    <td><?=$actividad->uni_medida?></td>
                                                                    <td><?=a_number_format($actividad->costo_total,2, '.',",",3)?></td>
                                                                    <td>
                                                                    <?=$actividad->valoracion_actividad*100?> %
                                                                    </td>
                                                                    <td><?=$actividad->fecha_inicio?></td>
                                                                    <td><?=$actividad->fecha_fin?></td>
                                                                    <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                                    <td>
                                                                        <a onclick="editarActividad('<?=$actividad->id_actividad?>','<?=$value->id_pi?>');" role="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit"></i></a>

                                                                        <a onclick="eliminarActividad('<?=$actividad->id_actividad?>', this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar" ><i class="fa fa-trash-o"></i></a>
                                                                    </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>                            
                                                    </div>                      
                                                </div>
                                            </div>
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
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="tabcronograma" aria-labelledby="home-tab">   
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
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
                                    <div class="accordion" id="accordion1" role="tablist" aria-multiselectable="true">
                                        <?php foreach ($producto as $key => $value) { ?>                
                                        <div class="panel">
                                            <div class="panel-heading" style="padding: 6px;">
                                                <a class="panel-title" id="pheading<?=$value->id_producto?>" data-toggle="collapse" data-parent="#accordion1" href="#pcollapse<?=$value->id_producto?>" aria-expanded="false" aria-controls="pcollapse<?=$value->id_producto?>" style="text-transform: uppercase;"><?=$value->desc_producto?>
                                                </a>
                                            </div>
                                            <?php if(count($value->childActividad)>0) { ?>
                                            <div id="pcollapse<?=$value->id_producto?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="pheading<?=$value->id_producto?>">
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <?php foreach ($value->childActividad as $key => $actividad) { ?>

                                                        <table class="table table-bordered" id="tablaActividad<?=$actividad->id_actividad?>">
                                                            <thead>
                                                                <tr style="text-align: center; background-color: #f9f9f9;">
                                                                    <th colspan="3" style="color: #ed5565; font-size: 12px; font-weight: bold; width: 80%;"> ACTIVIDAD: <?=$actividad->desc_actividad?></th>
                                                                    <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                                    <th style="width: 20%;">
                                                                        <a onclick="paginaAjaxDialogo('modalProgramacion', 'Agregar Programación',{ idPi: '<?=$value->id_pi?>' , idActividad : '<?=$actividad->id_actividad?>' }, base_url+'index.php/Mo_Programacion_Actividad/Insertar', 'GET', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Agregar Programación" role="button" class="btn  btn-warning btn-xs"><i class="fa fa-plus"></i></a>
                                                                    </th>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr style="background-color: #f9f9f9;">
                                                                    <th style="width: 20%;">Mes</th>
                                                                    <th style="width: 30%;">Ejec. Fis. Prog</th>
                                                                    <th style="width: 30%;">Ejec. Fin. Prog</th>
                                                                    <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                                    <th style="width: 20%;">Opciones</th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="tbodyActividad<?=$actividad->id_actividad?>">
                                                            <?php foreach ($actividad->childProgramacion as $key => $programacion) { ?>
                                                            <tr style="background-color: #f9f9f9;"" id="trProgramacion<?=$programacion->id_actividad_programacion?>">
                                                                <td><?=$programacion->fecha_programacion?></td>
                                                                <td><?=$programacion->cantidad_ejecucion_programada?></td>
                                                                <td><?=a_number_format($programacion->ejec_finan_programada , 2, '.',",",3)?></td>
                                                                <?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
                                                                <td>                                                                
                                                                    <a onclick="paginaAjaxDialogo('editarProgramacion', 'Editar Programación',{ idEjecucion: '<?=$programacion->id_actividad_programacion?>' , idActividad: '<?=$actividad->id_actividad?>' }, base_url+'index.php/Mo_Programacion_Actividad/editar', 'GET', null, null, false, true);return false;" role="button" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Programación"><i class="fa fa-edit"></i></a>
                                                                    <a onclick="eliminarProgramacion('<?=$programacion->id_actividad_programacion?>',this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Programación" ><i class="fa fa-trash-o"></i></a>
                                                                </td>
                                                                <?php } ?>
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
            </div>
        </div>
    </div>
</div>
<script>
    function agregarProducto()
    {
        $('#divAgregarProducto').data('formValidation').resetField($('#txtDescripcionProducto'));

        $('#divAgregarProducto').data('formValidation').validate();

        if(!($('#divAgregarProducto').data('formValidation').isValid()))
        {
            return;
        }
        paginaAjaxJSON({ "idPi" : $('#id_pi').val(), "descripcionProducto" : $('#txtDescripcionProducto').val().trim(),"valoracionProducto" : $('#txtValoracion').val().trim() }, base_url+'index.php/Mo_MonitoreodeProyectos/InsertarProducto', 'POST', null, function(objectJSON)
        {
            resp=JSON.parse(objectJSON);

            ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
            
            if(resp.proceso=='Correcto')
            {
                calcularValoracion();
                var htmlTemp= '<div class="panel"><div class="panel-heading" style="padding: 6px;"><h4 class="panel-title" style="float:right;"><a onclick="eliminarProducto('+resp.idProducto+',this);" role = "button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"><i class="fa fa-trash-o"></i></a><a onclick="paginaAjaxDialogo(\'modal2\',\'Agregar Actividad\', {idPi:'+$('#id_pi').val()+', idProducto :'+resp.idProducto+'}, base_url+\'index.php/Mo_Actividad/Insertar\',\'GET\', null, null, false, true);" role="button" class="btn btn-round btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Actividad"><i class="fa fa-plus"></i></a></h4><a class="panel-title" id="heading'+resp.idProducto+'" data-toggle="collapse" data-parent="#accordion" href="#collapse'+resp.idProducto+'" aria-expanded="false" aria-controls="collapse'+resp.idProducto+'" style="text-transform: uppercase;">'+replaceAll(replaceAll($('#txtDescripcionProducto').val().trim(), '<', '&lt;'), '>', '&gt;')+' ('+(parseFloat($('#txtValoracion').val()).toFixed(2))+') %</a></div>';
                
                htmlTemp+='<div id="collapse'+resp.idProducto+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+resp.idProducto+'><div class="panel-body"><div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Actividad</th><th>U. Medida</th><th>Meta</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Opciones</th></tr></thead></table></div></div></div></div>';

                $('#accordion').append(htmlTemp);

                $('#txtDescripcionProducto').val('');
                $('#txtValoracion').val('');
            }
        }, false, true);
    }

    function eliminarProducto(idProducto, element)
    {
        swal({
            title: "Esta seguro que desea eliminar el producto y sus actividades?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idProducto" : idProducto }, base_url+'index.php/Mo_MonitoreodeProyectos/eliminarProducto', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

                if(resp.proceso=='Correcto')
                {
                    calcularValoracion();
                    $(element).parent().parent().parent().remove();
                }               
            }, false, true);
        });
    }

    function editarActividad(idActividad, idPi)
    {
        paginaAjaxDialogo('modal3', 'Editar Actividad',{ idActividad: idActividad, idPi: idPi}, base_url+'index.php/Mo_Actividad/editar', 'GET', null, null, false, true);
    }

    function eliminarActividad(idActividad, element)
    {
        swal({
            title: "Esta seguro que desea eliminar la actividad?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idActividad" : idActividad }, base_url+'index.php/Mo_Actividad/eliminar', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

                if(resp.proceso=='Correcto')
                {
                    $(element).parent().parent().remove();
                }               
            }, false, true);
        });
    }

    function eliminarProgramacion(idProgramacion, element)
    {
        swal({
            title: "Esta seguro que desea eliminar la programacion?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idProgramacion" : idProgramacion }, base_url+'index.php/Mo_Programacion_Actividad/eliminar', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

                if(resp.proceso=='Correcto')
                {
                    $(element).parent().parent().remove();
                }               
            }, false, true);
        });
    }

    function calcularValoracion()
    {
        idPi=$('#id_pi').val().trim();
        $.ajax(
        {
            url: base_url+'index.php/Mo_MonitoreodeProyectos/valoracionRestante',
            type: 'POST',
            cache: false,
            data:{idPi:idPi},
            async: true
        }).done(function(objectJSON)
        {
            objectJSON = JSON.parse(objectJSON);
            $('#hdValoracionRestante').text(objectJSON.valoracionRestante);
        });
    }

    $(function()
    {
        $('#divAgregarProducto').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
                txtDescripcionProducto:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Descripción del producto" es requerido.</b>'
                        }
                    }
                },
                txtValoracion:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Valoración del producto" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                            message: '<b style="color: red;">El campo "Valoración" debe ser un valor en decimales.</b>'
                        },
                        between: {
                            min: 0.1,
                            max: 100,
                            message: '<b style="color: red;">El campo "Valoración" debe estar entre 1 y 100.</b>'
                        }
                    }
                }
            }
        });     
    });
</script>

  