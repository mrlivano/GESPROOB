<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>IMPORTACIÓN DE PROYECTOS S10</b></h2>
					
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_elaboracion" aria-labelledby="home-tab">
								<br>
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ventana_restaurar_bd" style="margin-top: 5px;margin-bottom: 15px;"><span class="fa fa-plus-circle"></span> IMPORTAR</button>
								<div class="table-responsive">
									<table id="table-ExpedienteTecnico" style="text-align: center;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td class="col-md-2 col-xs-12">Codigo Unico</td>
												<td class="col-md-9 col-xs-12">Proyecto</td>
												<td class="col-md-3 col-xs-12">Fecha Importación</td>
												<td class="col-md-3 col-xs-12">Opción</td>
											</tr>
										</thead>
										<tbody>
										<?php foreach($listaBD as $item){ ?>
										  	<tr>
										  		<td style="width: 15%;">
										  			<a style="width: 100%;" href="<?= site_url('Expediente_Tecnico/reporteS10?codigo='.$item->CodigoUnico);?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->CodigoUnico?></a>

										  		</td>
												<td style="width: 70%;">
													<?= $item->Proyecto?>
												</td>
												<td style="width: 15%;">
													<?=date('d/m/Y',strtotime($item->FechaSubida)) ?>
												</td>
												<td style="width: 15%;">
												<a style="width: 100%;" role="button" onclick="eliminarBD(<?= $item->CodigoUnico?>)" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> ELiminar</a>
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
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<!-- /.ventana para restaurar bd-->
<div class="modal fade" id="ventana_restaurar_bd" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Importar BD S10</h4>
        </div>
        <div class="modal-body">
         <div class="row">
                <div class="col-xs-12">
                 <!-- FORMULARIO PARA REGISTRA meta prespuestal-->
                <form class="form-horizontal form-label-left"  id="form_ImportarS10" action="javascript:ImportarBD()" method="POST" >
                    <div id="validarImportarS10">
					<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Código Unico <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="txt_codigo_unico" name="txt_codigo_unico" autocomplete="off" value="" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="Código Unico del Proyecto" required="required" type="text">
                        </div>
						<button type="button" name="buscar" class="col-md-2 col-sm-2 col-xs-12 btn btn-secondary" onclick="cargarDatos()">Buscar</button>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="textarea">Proyecto*
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea style="height: 200px;" id="txt_proyecto" name="txt_proyecto" autocomplete="off" text="" placeholder="Descripción del Proyecto" class="form-control col-md-7 col-xs-12" required="required"></textarea>
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Archivo (File.bak) <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" ></br>
                             <input id="txt_file" name="txt_file" type="file" class="form-control col-md-7 col-xs-12" name="faviconSector" required="required">
                        </div> 
                      </div>

					  <div class="item form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fecha <span class="required"></span></label>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="date" max="2050-12-31" id="txt_fecha" name="txt_fecha" class="form-control" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" class="notValidate" disabled="true">
						</div>					
					</div>

                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <button id="send" type="submit" class="btn btn-success">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Importar
                          </button>
                          <button type="submit" class="btn btn-danger" data-dismiss="modal">
                             <span class="glyphicon glyphicon-remove"></span>
                            Cerrar
                          </button>

                        </div>
                      </div>
                </form><!-- FORMULARIO FIN PARA REGISTRA META PRESUPUESTAL -->
            </div><!-- /.span -->
        </div><!-- /.row -->
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
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
	$('#table-ExpedienteTecnico').DataTable(
	{
		"language":idioma_espanol
	});

	$('#table-ExpedientesAprobados').DataTable(
	{
		"language":idioma_espanol
	});
});
function eliminarBD(codigoProyecto)
{
	console.log(codigoProyecto);
	swal({
			title: "Esta seguro que desea eliminar el Registro?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText:"CERRAR" ,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		},
		function()
		{
			$.ajax({
					url: base_url + "index.php/PrincipalReportes/DeleteDB",
					type: "POST",
					data:{codigoProyecto:codigoProyecto},
					beforeSend: function(request)
					{
						$('#ventana_restaurar_bd').modal('hide')
						renderLoading();
					},
					success:function(data)
					{
						$('#divModalCargaAjax').hide();
						

						if(data)
						{
							swal(
								'Operacion Completada',
								'Se eleminó correctamente',
								'success'
							);
							window.location.reload();
						}
						else
						{
							swal(
								'No se pudo completar la Operacion',
								'Error al eliminar',
								'error'
							);
						}
					},
					error: function (xhr, textStatus, errorMessage) 
					{
						$('#divModalCargaAjax').hide();
						swal(
							'ERROR!',
							'No se pudo eliminar la BD',
							'error'
						);
					}
					
				});
	})
		
}
function ImportarBD()
{
	
		var codigo=$("#txt_codigo_unico").val();
		var proyecto=$("#txt_proyecto").val();
		console.log(proyecto);
		var fecha=$("#txt_fecha").val();
		var file = document.getElementById('txt_file').files[0];
		let data = new FormData();
		data.append('file',file);
		data.append('codigo',codigo);
		data.append('proyecto',proyecto);
		data.append('fecha',fecha);
    	$.ajax({
			url: base_url + "index.php/PrincipalReportes/RestoreDB",
			type: "POST",
			data:data,
			processData: false,
            contentType: false,
			beforeSend: function(request)
			{
				$('#ventana_restaurar_bd').modal('hide')
				renderLoading();
			},
			success:function(data)
			{
				
				
				datos=data.slice(data.indexOf('RESTORE'));

				if(datos.indexOf('successfully')!==-1)
				{
					//importar tablas 
					console.log(codigo)
					$.ajax({
						type:"POST",
						url:base_url+'index.php/PrincipalReportes/ImportarTableS10',
						data:{codigo:codigo},
						cache: false,
						success:function(resp)
						{
							$('#divModalCargaAjax').hide();
							swal(
								'Operacion Completada',
								datos,
								'success'
							);
					
							window.location.reload();
						},
						error: function (xhr, textStatus, errorMessage) 
						{
							$('#divModalCargaAjax').hide();
							swal(
								'ERROR!',
								'No se pudo conectar con el servidor para Importar BD',
								'error'
							);
						}
					});
				}
				else
				{
					swal(
						'No se pudo completar la Operacion',
						datos,
						'error'
					);
				}
			},
			error: function (xhr, textStatus, errorMessage) 
			{
				$('#divModalCargaAjax').hide();
				swal(
					'ERROR!',
					'No se pudo conectar con el servidor para restaurar BD',
					'error'
				);
			}
			
		});
}

$('.modal').on('hidden.bs.modal', function(){ 
    $(this).find('form')[0].reset(); //para borrar todos los datos que tenga los input, textareas, select.
    $("label.error").remove();  //lo utilice para borrar la etiqueta de error del jquery validate
  });

$(function()
{
    $('#validarImportarS10').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            txt_codigo_unico:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Codigo Unico" es requerido.</b>'
                    },
                    stringLength:
                    {
                        max: 10,
                        message: '<b style="color: red;">El campo "Codigo Unico" no puede exceder los 10 cáracteres.</b>'
                    }
                }
            },
            txt_proyecto:
            {
                validators:
                {               
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Proyecto" es requerido.</b>'
                    },
                    stringLength:
                    {
                        max: 200,
                        message: '<b style="color: red;">El campo "Proyecto" no puede exceder los 200 cáracteres.</b>'
                    }
                }
            },
            txt_file:
            {
                validators:
                {               
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Archivo" es requerido.</b>'
                    },
                    stringLength:
                    {
                        max: 200,
                        message: '<b style="color: red;">El campo "Archivo" no puede exceder los 200 cáracteres.</b>'
                    }
                }
            }
        }
    });
});
function cargarDatos() {
      let codigoProyecto=$('#txt_codigo_unico').val();
      $.ajax(
            {
				url:base_url+'index.php/ProyectoInversion/listarProyecto',
                type: 'POST',
				data:{CodigoProyecto:codigoProyecto},
                beforeSend: function(request)
                {
                    renderLoading();
                }               
                              
            }).done(
              function(request)
                {
					objectJSON=JSON.parse(request);
                  $('#divModalCargaAjax').hide();
                  if(objectJSON[0])
                  {
                    $('#txt_proyecto').val(objectJSON[0].nombre_pi);
					
                    swal('Operacion Completada','Se encontro el proyecto','success');
                  }
                  else
                  {
                    swal('No se pudo completar la Operacion','No se encontro el Proyecto','error');
                  }
                }).fail(
                   function ( )
                {
					$('#divModalCargaAjax').hide();
                      swal('ERROR!','No se encontró este Proyecto','error');

                  });
    }
</script>
