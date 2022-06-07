<div id="validarResponsableEjecucion">
	<form class="form-horizontal" id="frmResponsableEjecucion">
		<input id="hdET" name="hdET" value="<?=$id_et?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
			<label class="control-label">Responsable de Ejecución:</label>
	    	<div class="form-group">
		      	<select class="selectpicker form-control" id="comboResponsableEjecucion" name="comboResponsableEjecucion" data-live-search="true">
		        	<option value="">Seleccione una opción</option>
					<?php foreach ($listarPersona as $key => $item) { ?>
						<option value="<?=$item->id_persona?>" ><?=$item->nombreCompleto?></option>
					<?php } ?>
		      	</select>
	    	</div>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
	  		<label class="control-label">Cargo:</label>
	    	<div class="form-group">					      	
				<select class="selectpicker form-control" id="comboCargoEjecucion" name="comboCargoEjecucion" data-live-search="true">
				  	<option value="">Seleccione una opción</option>
					<?php foreach ($listarCargo as $key => $item) { ?>
		      			<option value='<?=$item->id_cargo?>'><?=$item->Desc_cargo?></option>		      								      			
		      		<?php } ?>
		      	</select>
	    	</div>
	  	</div>	
			<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Fecha de Inicio:</label>
					<div>
						<input type="date" max="2050-12-31" class="form-control" name="txtFechaInicio" id="txtFechaInicio">
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-12">
					<label class="control-label">Fecha Fin:</label>
					<div>
						<input type="date" max="2050-12-31" name="txtFechaFin" class="form-control" id="txtFechaFin">
					</div>
					<p style="color: red; display: none;" id="Advertencia">La Fecha de Inicio no puede ser mayor a la Fecha de Fin</p>
				</div>
      <div class="col-md-3 col-sm-6 col-xs-12">
				<label>.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarResponsableEjecucion();" value="Guardar">
				</div>
			</div>				
		</div>
		<br>
		<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="table-responsive">
								<table id="tablaResponsableEjecucion" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
									<thead>
										<tr>
											<th>Responsable</th>
											<th>Cargo</th>
											<th>Inicio</th>
											<th>Fin</th>
											<th>Opción</th>
										</tr>
									</thead>
								</table>
							</div>	
						</div>
					</div>
	</form>				
</div>
<div class="row" style="text-align: right;">
	<button  id="closeModal" name="closeModal" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>

<script>

	$(function()
	{
		$('#validarResponsableEjecucion').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				comboResponsableEjecucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Responsable de ejecución" es requerido.</b>'
						}
					}
				},
        comboCargoEjecucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Cargo" es requerido.</b>'
						}
					}
				},
			
			}
		});
		listaResponsableEjecucion($('#hdET').val())
	})

	$('.selectpicker').selectpicker({
	});


	function guardarResponsableEjecucion()
	{
		event.preventDefault();
        $('#validarResponsableEjecucion').data('formValidation').validate();
		if(!($('#validarResponsableEjecucion').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmResponsableEjecucion")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Expediente_Tecnico/insertarResponsableEjecucion",
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
				$('#tablaResponsableEjecucion').dataTable()._fnAjaxUpdate();
				$('#comboResponsableEjecucion').val('');
        $('#comboCargoEjecucion').val('');
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}

	function listaResponsableEjecucion(id_et) 
	{
		var table=$("#tablaResponsableEjecucion").DataTable({
			"processing": true,
			"serverSide":false,
			destroy:true,
			"ajax":{
				url:base_url+"index.php/Expediente_Tecnico/listarResponsableEjecucion",
				type:"POST",
				data :{id_et:id_et}
			},
			"columns":
			[
				{"data":"nombres",
					render: function(data, type, row)
					{
						var name = data+' '+row.apellido_p+' '+row.apellido_m;
						return name;
					}
				},
				{"data":"desc_cargo"},
				{"data":"fecha_inicio",
					render: function(data, type, row)
					{
						var date = moment(data,'YYYY/MM/DD HH:mm:ss').format('DD/MM/YYYY');
						return date;
					}
				},
				{"data":"fecha_fin",
					render: function(data, type, row)
					{
						var date = moment(data,'YYYY/MM/DD HH:mm:ss').format('DD/MM/YYYY');
						return date;
					}
				},
				{"data":"id_responsable_et",
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarResponsableElaboracion(" + data + ",this)><i class='fa fa-trash-o'></i></button>"; 
					}
				}
			],
			"language":idioma_espanol
		});
	}

	function eliminarResponsableElaboracion(id_responsable_et, element) 
	{
		swal({
			title: "Se eliminará responsable de elaboración. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"id_responsable_et": id_responsable_et
			}, base_url + 'index.php/Expediente_Tecnico/eliminarResponsableElaboracion', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaResponsableEjecucion').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}
</script>






