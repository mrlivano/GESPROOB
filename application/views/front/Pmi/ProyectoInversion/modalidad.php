<div>
	<form class="form-horizontal" id="frmModalidadPi" enctype="multipart/form-data">
		<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label">Proyecto*</label>
				<div>
					<textarea rows="3" class="form-control" readonly style="resize: none;resize: vertical;"><?=html_escape(trim(@$proyectoInversion[0]->nombre_pi))?></textarea>
				</div>
			</div>
		</div>
		<div class="row" id="validarModalidadPi">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Modalidad*</label>
				<div class="form-group">
					<select class="selectpicker form-control" id="selectModalidad" name="selectModalidad" data-live-search="true">
						<option value="">Seleccione una opción</option>
						<?php foreach ($modalidad as $key => $value) { ?>
							<option value='<?=$value->id_modalidad_ejec?>' >
							<?=$value->nombre_modalidad_ejec?></option>		      								      			
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label class="control-label">Resolución:</label>
				<div>
					<input type="file" class="form-control" name="fileResolucionModalidad" id="fileResolucionModalidad" accept=".pdf">
					<p style="color: red; display: block;" id="Advertencia">Solo se aceptan archivos en formato PDF (max 10Mb)</p>
				</div>				
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Fecha:</label>
				<div>
					<input type="date" id="txtFechaModalidad" name="txtFechaModalidad" class="form-control">
				</div>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarModalidad();" value="Guardar">
				</div>
			</div>						
		</div>
	</form>
	<div class="ln_solid"></div>
	<div class="table-responsive">
		<table id="tablaModalidad" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
			<thead>
				<tr>
					<th>Modalidad</th>
					<th>Resolución</th>
					<th>Fecha</th>
					<th>Opción</th>
				</tr>
			</thead>
		</table>
	</div>				
</div>
<div class="row" style="text-align: right;">
	<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>

<script>
	$(function()
	{
		listarModalidadPI($('#hdIdPI').val());
		
		$('#validarModalidadPi').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectModalidad:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Modalidad" es requerido.</b>'
						}
					}
				},
				txtFechaModalidad:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
						}
					}
				}
			}
		});	
	})

	$('.selectpicker').selectpicker({
	});

	function listarModalidadPI(id_pi) 
	{
		var table = $("#tablaModalidad").DataTable({
			"processing": true,
			"serverSide": false,
			destroy: true,
			"ajax": 
			{
				url: base_url + "index.php/PMI_ModalidadPi/ListaModalidadProyecto",
				type: "POST",
				data: 
				{
					id_pi: id_pi
				}
			},
			"columns": 
			[
				{
					"data": "nombre_modalidad_ejec"
				},
				{
					"data": "url_resolucion",
					render: function(data, type, row) 
					{
						if (data == null || data=='') 
						{
							return '<p>No se subio Resolución</p>';
						} 
						else 
						{
							url = base_url + "uploads/ResolucionModalidadEjecucion/"+row.id_modalidad_ejec_pi + data;
							
							return '<a href="'+url+'" target="_blank"><i class="fa fa-file fa-lg"></i></a>';
						}
					}
				},
				{
					"data": "fecha_modalidad_ejec_pi"
				},
				{
					"data": "id_modalidad_ejec_pi",
					render: function(data, type, row) 
					{
						return "<button type='button' data-toggle='tooltip' class='btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarModalidadPI(" + data + ",this)><i class='ace-icon fa fa-trash-o bigger-120'></i></button>";
					}
				}   
			],
			"language": idioma_espanol
		});
	}

	function eliminarModalidadPI(idModalidad, element) 
	{
		swal({
			title: "Se eliminará la modalidad ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"idModalidad": idModalidad
			}, base_url + 'index.php/PMI_ModalidadPi/eliminar', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaModalidad').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}

	function guardarModalidad()
	{
		var codigo=$('#hdIdPI').val();
		event.preventDefault();
        $('#validarModalidadPi').data('formValidation').validate();
		if(!($('#validarModalidadPi').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmModalidadPi")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_ModalidadPi/insertar",
			data: formData,
			cache: false,
			contentType:false,
			processData:false,
			beforeSend: function() 
			{
            	renderLoading();
		    },
			success:function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);
				swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				paginaAjaxDialogo(null, 'Modalidad de Ejecución', {codigo:codigo}, base_url+'index.php/PMI_ModalidadPi/insertar', 'GET', null, null, false, true);
				$('#divModalCargaAjax').hide();	
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});		
	}
</script>






