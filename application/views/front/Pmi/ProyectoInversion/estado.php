<div id="validarEstado">
	<form class="form-horizontal" id="frmEstadoPi">
		<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label">Proyecto*</label>
				<div>
					<textarea rows="3" class="form-control" readonly style="resize: none;resize: vertical;"><?=html_escape(trim(@$proyectoInversion[0]->nombre_pi))?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-3 col-xs-12">
				<label class="control-label">Estado*</label>
				<div class="form-group">
					<select class="selectpicker form-control" id="selectEstado" name="selectEstado" data-live-search="true">
						<option value="">Seleccione una opción</option>
						<?php foreach ($ciclo as $key => $value) { ?>
							<option value='<?=$value->id_estado_ciclo?>' >
							<?=$value->nombre_estado_ciclo?></option>		      								      			
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Fecha:</label>
				<div>
					<input type="date" id="txtFecha" name="txtFecha" class="form-control">
				</div>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarEstadoPi();" value="Guardar">
				</div>
			</div>						
		</div>
	</form>
	<div class="ln_solid"></div>
	<div class="table-responsive">
		<table id="tablaEstadoPi" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
			<thead>
				<tr>
					<th>Fecha</th>
					<th>Estado</th>
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
		listarEstadoPi($('#hdIdPI').val());
		
		$('#validarEstado').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectEstado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Rubro" es requerido.</b>'
						}
					}
				},
				txtFecha:
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

	function listarEstadoPi(id_pi) 
	{
		var table = $("#tablaEstadoPi").DataTable({
			"processing": true,
			"serverSide": false,
			destroy: true,
			"ajax": 
			{
				url: base_url + "index.php/PMI_EstadoPi/ListaEstadoProyecto",
				type: "POST",
				data: 
				{
					id_pi: id_pi
				}
			},
			"columns": 
			[
				{"data": "fecha_estado_ciclo_pi"},
				{"data": "nombre_estado_ciclo"},
				{"data": "id_estado_ciclo_pi",
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarEstadoPi(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
					}
				}
			],
			"language": idioma_espanol
		});
	}

	function eliminarEstadoPi(idEstado, element) 
	{
		swal({
			title: "Se eliminará el Rubro. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"idEstado": idEstado
			}, base_url + 'index.php/PMI_EstadoPi/eliminar', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaEstadoPi').dataTable()._fnAjaxUpdate();
				$('#table_proyectos_inversion').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}

	function guardarEstadoPi()
	{
		event.preventDefault();
        $('#validarEstado').data('formValidation').validate();
		if(!($('#validarEstado').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmEstadoPi")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_EstadoPi/insertar",
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
				$('#divModalCargaAjax').hide();	
				$('#tablaEstadoPi').dataTable()._fnAjaxUpdate();
				$('#table_proyectos_inversion').dataTable()._fnAjaxUpdate();
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






