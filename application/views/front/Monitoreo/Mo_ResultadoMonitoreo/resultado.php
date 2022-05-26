<style>
	li
	{
		list-style:none;
		padding-top:5px;
	}
	ul
	{
		list-style-type: none;
    	margin: 0;
    	padding: 0;

	}
	b
	{
		padding-left: 5px;
	}
	.btnli
	{
		width: 30px;
	}
</style>
<form  id="frmInsertarMonitoreo">
<div class="form-horizontal">
	<div>
		<label style="color: #0073b7; font-size: 14px;" for="control-label"><?php echo ($hdIdProducto!='' ? 'Producto: ' : 'Actividad: ');?><?=$descripcion?></label><br>
	<br></label>					
	</div>
	<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>											
	<div id="divAgregarMonitoreo">
		<div class="row">
			<input type="hidden" name="hdIdProducto" id="hdIdProducto" value="<?=$hdIdProducto?>">
			<input type="hidden" name="hdIdActividad" id="hdIdActividad" value="<?=$hdIdActividad?>">
			<input type="hidden" name="hdIdProyectoMonitoreo" id="hdIdProyectoMonitoreo" value="<?=$hdIdProyecto?>">
			<input type="hidden" name="hdDescripcionMonitoreo" id="hdDescripcionMonitoreo" value="<?=$descripcion?>">
			<div class="col-md-7 col-sm-6 col-xs-12">
				<label for="control-label">Resultado:</label>
				<input type="text" class="form-control" id="txtResultado" name="txtResultado" autocomplete="off" >
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label for="control-label">Fecha:</label>
				<input type="date" max="2050-12-31" class="form-control" id="txtFechaRegistro" name="txtFechaRegistro" value="<?=date('Y-m-d')?>">
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				<label for="control-label">.</label>
				<input type="button" class="btn btn-info" value="Guardar" onclick="agregarResultado();" style="width: 100%;">
			</div>
		</div>
	</div>
	<?php } ?>		
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div style=" height: 340px;overflow-y: scroll; margin-top: 15px;">
				<div class="accordion" id="accordionMonitoreo" role="tablist" aria-multiselectable="true">
                <?php foreach ($monitoreo as $key => $value) { ?>                
                <div class="panel">
                    <div class="panel-heading" style="padding: 6px;">
                        <h4 class="panel-title" style="float:right;">
							<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
							<a onclick="editarResultadoMonitoreo('<?=$value->id_monitoreo?>');" role="button" class="btn btn-round btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Monitoreo"><i  class="fa fa-edit"></i></a><a onclick="eliminarResultadoMonitoreo('<?=$value->id_monitoreo?>', this);" role="button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Monitoreo"><i class="fa fa-trash-o"></i></a><a onclick="paginaAjaxDialogo('agregarObservacion', 'Agregar Observacion',{ idMonitoreo: '<?=$value->id_monitoreo?>'}, base_url+'index.php/Mo_Observacion/insertar', 'GET', null, null, false, true);return false;"  role="button" class="btn btn-round btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Observación"><i style="color: white;" class="fa fa-align-justify"></i></a><a onclick="paginaAjaxDialogo('agregarCompromiso', 'Agregar Compromiso',{ idMonitoreo: '<?=$value->id_monitoreo?>'}, base_url+'index.php/Mo_Compromiso/insertar', 'GET', null, null, false, true);return false;" data-toggle="tooltip" data-placement="top" title="Agregar Compromiso" role="button" class="btn btn-round btn-warning btn-xs"><i class="fa fa-clone"></i></a><a onclick="paginaAjaxDialogo('agregarDocumentos', 'Adjuntar Documento',{ idMonitoreo: '<?=$value->id_monitoreo?>'}, base_url+'index.php/Mo_MonitoreoResultado/adjuntarDocumento', 'GET', null, null, false, true);return false;" role="button" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Adjuntar  Documentos"><i class="fa fa-folder-open"></i></a>
							<?php } ?>
						</h4>
                        <a class="panel-title" id="headingMonitoreo<?=$value->id_monitoreo?>" data-toggle="collapse" data-parent="#accordionMonitoreo" href="#collapseMonitoreo<?=$value->id_monitoreo?>" aria-expanded="false" aria-controls="collapse<?=$value->id_monitoreo?>" style="text-transform: uppercase;"><span id="txtDescripcionResultado<?=$value->id_monitoreo?>"><?=$value->desc_monitoreo?></span> - <?=date('d/m/Y',strtotime($value->fecha_registro))?>
                        </a>
                    </div>
                    <div id="collapseMonitoreo<?=$value->id_monitoreo?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMonitoreo<?=$value->id_monitoreo?>">
                        <div class="panel-body"> 
                        	<ul id="myTab<?=$value->id_monitoreo?>" class="nav nav-tabs" role="tablist">
						        <li role="presentation" class="active"><a href="#tabObservaciones<?=$value->id_monitoreo?>"  role="tab" id="profile-tabObservacion" data-toggle="tab" aria-expanded="false">Observaciones</a>
						        </li>
						        <li role="presentation" class=""><a  href="#tabCompromisos<?=$value->id_monitoreo?>" role="tab" id="profile-tabCompromiso" data-toggle="tab" aria-expanded="false">Compromisos</a>
						        </li>
						        <li role="presentation" class=""><a  href="#tabDocumentos<?=$value->id_monitoreo?>" role="tab" id="profile-tabDocumento" data-toggle="tab" aria-expanded="false">Documentos</a>
						        </li>
						    </ul>
						    <div id="myTabContent<?=$value->id_monitoreo?>" class="tab-content">
        						<div role="tabpanel" class="tab-pane fade active in" id="tabObservaciones<?=$value->id_monitoreo?>" aria-labelledby="profile-tabObservacion">
	        						<div class="table-responsive"><br>
		        						<table id="tablaObservacion<?=$value->id_monitoreo?>" class="table table-sm table-bordered" style="background-color:#ffffff;">
										  	<thead>
										    	<tr>
												    <th style="width: 10%;">Fecha</th>
												    <th style="width: 85%;">Observación</th>
												    <?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<th style="width: 5%;">Opciones</th>
													<?php } ?>
										    	</tr>
										  	</thead>
										  	<tbody id="tBodyObservacion<?=$value->id_monitoreo?>">
										  	<?php foreach ($value->childObservacion as $key => $obs) {?>
											  	<tr>
											  		<td><?=$obs->fecha_registro?></td>
											  		<td><?=$obs->desc_observacion?></td>
													<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<td>
											  			<a onclick="eliminarObservacion('<?=$obs->id_observacion?>',this);"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Observación"><i class="fa fa-trash-o"></i></a>
											  		</td>
													<?php } ?>
											  	</tr>									  		
										  	<?php } ?>
										  	</tbody>
										</table>        							
	        						</div>
        						</div>
        						<div role="tabpanel" class="tab-pane fade" id="tabCompromisos<?=$value->id_monitoreo?>" aria-labelledby="profile-tabCompromiso">
        							<div class="table-responsive"><br>
		        						<table id="tablaCompromiso<?=$value->id_monitoreo?>" class="table table-sm table-bordered" style="background-color:#ffffff;">
										  	<thead>
										    	<tr>
												    <th style="width: 10%;">Fecha</th>
												    <th style="width: 70%;">Compromiso</th>
												    <th style="width: 15%;">Responsable</th>
												    <?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<th style="width: 5%;">Opciones</th>
													<?php } ?>
										    	</tr>
										  	</thead>
										  	<tbody id="tBodyCompromiso<?=$value->id_monitoreo?>">
										  	<?php foreach ($value->childCompromiso as $key => $com) {?>
											  	<tr>
											  		<td><?=$com->fecha_registro?></td>
											  		<td><?=$com->desc_compromiso?></td>
											  		<td><?=$com->resp_compromiso?></td>
											  		<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<td><a onclick="eliminarCompromiso('<?=$com->id_compromiso?>',this);"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Compromiso"><i class="fa fa-trash-o"></i></a></td>
													<?php } ?>
												</tr>									  		
										  	<?php } ?>
										  	</tbody>
										</table>        							
	        						</div>
        						</div>
        						<div role="tabpanel" class="tab-pane fade" id="tabDocumentos<?=$value->id_monitoreo?>" aria-labelledby="profile-tabDocumento">
        							<div class="table-responsive"><br>
		        						<table id="tablaDocumentos<?=$value->id_monitoreo?>" class="table table-sm table-bordered" style="background-color:#ffffff;">
										  	<thead>
										    	<tr>
												    <th style="width: 70%;">Documento</th>
												    <?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<th style="width: 5%;">Opciones</th>
													<?php } ?>
										    	</tr>
										  	</thead>
										  	<tbody id="tBodyDocumentos<?=$value->id_monitoreo?>">
										  	<?php if($value->archivos!='') {
										  	foreach ($value->archivos as $key => $archivo){ 
										  		if ($archivo!='') { ?>
											  	<tr>
											  		<td>
											  			<a href='<?php echo base_url()."uploads/DocumentoMonitoreo/".$archivo;?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
											  		</td>
											  		<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==5 || $this->session->userdata('tipoUsuario')==9) {?>
													<td><a onclick="eliminarDocumento('<?=$value->id_monitoreo?>',this,'<?=$archivo?>');"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Compromiso"><i class="fa fa-trash-o"></i></a></td>
													<?php } ?>
												</tr>									  		
										  	<?php  } } } ?>
										  	</tbody>

										</table>        							
	        						</div>
        						</div>
        					</div>
                        </div>
                    </div>
                </div> 
                <?php } ?>              
            </div>
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
</form>
<script>
	$(function()
	{
		$('#divAgregarMonitoreo').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtResultado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Resultado" es requerido.</b>'
						}
					}
				}
			}
		});		
	});

	function agregarResultado()
	{
		event.preventDefault();
		$('#divAgregarMonitoreo').data('formValidation').validate();
		if(!($('#divAgregarMonitoreo').data('formValidation').isValid()))
		{
			return;
		}

		var formData=new FormData($("#frmInsertarMonitoreo")[0]);
		var resultado=$('#txtResultado').val().trim();
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_MonitoreoResultado/insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));	   
	        	if(resp.proceso=='Correcto')
	        	{
	        		var htmlTemp= '<div class="panel"><div class="panel-heading" style="padding: 6px;"><h4 class="panel-title" style="float:right;"><a onclick="editarResultadoMonitoreo('+resp.idMonitoreo+');" role="button" class="btn btn-round btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Editar Monitoreo"><i  class="fa fa-edit"></i></a><a onclick="eliminarResultadoMonitoreo('+resp.idMonitoreo+', this);" role="button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Monitoreo"><i class="fa fa-trash-o"></i></a><a onclick="paginaAjaxDialogo(\'agregarObservacion\',\'Agregar Observación\', {idMonitoreo:'+resp.idMonitoreo+'}, base_url+\'index.php/Mo_Observacion/insertar\',\'GET\', null, null, false, true);" role = "button" class="btn btn-round btn-info btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Observación"><i style="color:white;" class="fa fa-align-justify"></i></a><a onclick="paginaAjaxDialogo(\'agregarCompromiso\',\'Agregar Compromiso\', {idMonitoreo:'+resp.idMonitoreo+'}, base_url+\'index.php/Mo_Compromiso/insertar\',\'GET\', null, null, false, true);" role="button" class="btn btn-round btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Compromiso"><i class="fa fa-clone"></i></a><a onclick="paginaAjaxDialogo(\'agregarDocumentos\',\'Adjuntar Documento\', {idMonitoreo:'+resp.idMonitoreo+'}, base_url+\'index.php/Mo_MonitoreoResultado/adjuntarDocumento\',\'GET\', null, null, false, true);" role="button" class="btn btn-round btn-primary btn-xs" data-toggle="tooltip" data-placement="top" title="Adjuntar  Documentos"><i class="fa fa-folder-open"></i></a></h4><a class="panel-title" id="headingMonitoreo'+resp.idMonitoreo+'" data-toggle="collapse" data-parent="#accordionMonitoreo" href="#collapseMonitoreo'+resp.idMonitoreo+'" aria-expanded="false" aria-controls="collapse'+resp.idMonitoreo+'" style="text-transform: uppercase;"><span id="txtDescripcionResultado'+resp.idMonitoreo+'">'+replaceAll(replaceAll($('#txtResultado').val().trim(), '<', '&lt;'), '>', '&gt;')+'</span> - '+resp.fecha+'</a></div>';

	                htmlTemp+='<div id="collapseMonitoreo'+resp.idMonitoreo+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingMonitoreo'+resp.idMonitoreo+'><div class="panel-body"><ul id="myTab'+resp.idMonitoreo+'" class="nav nav-tabs" role="tablist"><li role="presentation" class="active"><a href="#tabObservaciones'+resp.idMonitoreo+'"  role="tab" id="profile-tabObservacion" data-toggle="tab" aria-expanded="false">Observaciones</a></li><li role="presentation" class=""><a  href="#tabCompromisos'+resp.idMonitoreo+'" role="tab" id="profile-tabCompromiso" data-toggle="tab" aria-expanded="false">Compromisos</a></li><li role="presentation" class=""><a  href="#tabDocumentos'+resp.idMonitoreo+'" role="tab" id="profile-tabDocumento" data-toggle="tab" aria-expanded="false">Documentos</a></li></ul><div id="myTabContent'+resp.idMonitoreo+'" class="tab-content"><div role="tabpanel" class="tab-pane fade active in" id="tabObservaciones'+resp.idMonitoreo+'" aria-labelledby="profile-tabObservacion"><div class="table-responsive"><br>';
	                htmlTemp+='<table id="tablaObservacion'+resp.idMonitoreo+'" class="table table-sm table-bordered" style="background-color: #ffffff;"><thead><tr><th style="width: 10%;">Fecha</th><th style="width: 85%;">Observación</th><th style="width: 5%;">Opciones</th></tr></thead><tbody id="tBodyObservacion'+resp.idMonitoreo+'"></tbody></table></div></div><div role="tabpanel" class="tab-pane fade" id="tabCompromisos'+resp.idMonitoreo+'" aria-labelledby="profile-tabCompromiso"><div class="table-responsive"><br><table id="tablaCompromiso'+resp.idMonitoreo+'" class="table table-sm table-bordered" style="background-color:#ffffff;"><thead><tr><th style="width: 10%;">Fecha</th><th style="width: 70%;">Compromiso</th><th style="width: 15%;">Responsable</th><th style="width: 5%;">Opciones</th></tr></thead><tbody id="tBodyCompromiso'+resp.idMonitoreo+'"></tbody></table></div></div><div role="tabpanel" class="tab-pane" id="tabDocumentos'+resp.idMonitoreo+'" aria-labelledby="profile-tabDocumento"><div class="table-responsive"><br><table id="tablaDocumentos'+resp.idMonitoreo+'" class="table table-sm table-bordered" style="background-color:#ffffff;"><thead><tr><th style="width: 70%;">Documentos</th><th style="width: 5%;">Opciones</th></tr></thead><tbody id="tBodyDocumentos'+resp.idMonitoreo+'"></tbody></table></div></div></div></div></div></div>';

	                $('#accordionMonitoreo').append(htmlTemp);
	                $('#txtResultado').val('');          
	        	}    		        		        	
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
    	});
	}

	function editarResultadoMonitoreo(codigoMonitoreo)
	{
		var descripcion=$('#txtDescripcionResultado'+codigoMonitoreo).text();
		swal({
			title: "",
			text: "Editar Resultado",
			type: "input",
			showCancelButton: true,
			cancelButtonText:"CERRAR",
			confirmButtonText: "ACEPTAR",
			closeOnConfirm: false,
		 	inputPlaceholder: "",
		 	inputValue:descripcion,
		}, function (inputValue)
		{
		  	if (inputValue === false) return false;
		  	if (inputValue === "") 
		  	{
		    	swal.showInputError("Observación es un campo requerido");
		    	return false
		  	}

			paginaAjaxJSON({ "idMonitoreo" : codigoMonitoreo, "descripcionMonitoreo" : inputValue}, base_url+'index.php/Mo_MonitoreoResultado/editar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Error')
				{
					return false;
				}
				$('#txtDescripcionResultado'+codigoMonitoreo).text(inputValue);
			}, false, true);
		});
	}

	function eliminarResultadoMonitoreo(codigo, element)
	{
		swal({
            title: "¿Realmente desea eliminar este resultado con compromisos, observaciones y documentos?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idMonitoreo" : codigo }, base_url+'index.php/Mo_MonitoreoResultado/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Correcto')
				{
					$(element).parent().parent().parent().remove();
				}

			}, false, true);
        });
	}

	function eliminarObservacion(codigo,element)
	{
		swal({
            title: "¿Realmente desea eliminar esta observación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idObservacion" : codigo }, base_url+'index.php/Mo_Observacion/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Correcto')
				{
					$(element).parent().parent().remove();
				}

			}, false, true);
        });

	}

	function eliminarCompromiso(codigo,element)
	{
		swal({
            title: "¿Realmente desea eliminar este compromiso?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idCompromiso" : codigo }, base_url+'index.php/Mo_Compromiso/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Correcto')
				{
					$(element).parent().parent().remove();
				}

			}, false, true);
        });

	}

	function eliminarDocumento(codigo,element,nombreArchivo)
	{
		swal({
            title: "¿Realmente desea eliminar este archivo?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idMonitoreo" : codigo, 'nombreArchivo':nombreArchivo }, base_url+'index.php/Mo_MonitoreoResultado/eliminarArchivo', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				if(objectJSON.proceso=='Correcto')
				{
					$(element).parent().parent().remove();
				}

			}, false, true);
        });

	}


</script>