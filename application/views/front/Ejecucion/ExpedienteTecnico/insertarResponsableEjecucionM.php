

		<div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTabPie" class="nav nav-tabs" role="tablist">
			<li style="width:15%;" role="presentation" class="active">
				<a href="#tabAdmDirecta" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Persona Natural</b></a>
			</li>
			<li style="width:15%;" role="presentation" class="">
				<a href="#tabAdmIndirecta" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Persona Juridica</b></a>
			</li>
		</ul>
		<br>
			<div id="myTabPieContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="tabAdmDirecta" aria-labelledby="home-tab">
				<div id="validarResponsableEjecucion">
				<form class="form-horizontal" id="frmResponsableEjecucion">
				<input id="hdET" name="hdET" value="<?=$id_et?>" readonly="readonly" autocomplete="off"  type="hidden">
				<input id="modalidad" name="modalidad" value="<?=$modalidad?>" readonly="readonly" autocomplete="off"  type="hidden">	
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
							<label>.</label>
							<div>
								<input style="width:100%" type="button" class="btn btn-success" onclick="guardarResponsableEjecucion();" value="Guardar">
							</div>
						</div>				
					</div>
					</form>	
					</div>
				</div>
				<!-- Persona Juridica -->
				<div role="tabpanel" class="tab-pane fade" id="tabAdmIndirecta" aria-labelledby="profile-tab">
				<div id="validarResponsableEjecucionJuridica">
				<form class="form-horizontal" id="frmResponsableEjecucionJuridica">
				<input id="hdETJuridica" name="hdETJuridica" value="<?=$id_et?>" readonly="readonly" autocomplete="off"  type="hidden">	
				<input id="modalidadJuridica" name="modalidadJuridica" value="<?=$modalidad?>" readonly="readonly" autocomplete="off"  type="hidden">	
						<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<label class="control-label">Responsable de Ejecución:</label>
										<div class="form-group">
												<select class="selectpicker form-control" id="comboResponsableEjecucionJuridica" name="comboResponsableEjecucionJuridica" data-live-search="true">
													<option value="">Seleccione una opción</option>
											<?php foreach ($listarPersonaJuridica as $key => $item) { ?>
												<option value="<?=$item->id_persona_juridica?>" ><?=$item->razon_social?></option>
											<?php } ?>
												</select>
										</div>
								</div>
								<div class="col-md-12 col-sm-12 col-xs-12">
										<label class="control-label">Cargo:</label>
										<div class="form-group">					      	
										<select class="selectpicker form-control" id="comboCargoEjecucionJuridica" name="comboCargoEjecucionJuridica" data-live-search="true">
												<option value="">Seleccione una opción</option>
											<?php foreach ($listarCargo as $key => $item) { ?>
														<option value='<?=$item->id_cargo?>'><?=$item->Desc_cargo?></option>		      								      			
													<?php } ?>
												</select>
										</div>
									</div>	
									<div class="col-md-3 col-sm-6 col-xs-12">
										<label>.</label>
										<div>
											<input style="width:100%" type="button" class="btn btn-success" onclick="guardarResponsableEjecucionJuridica();" value="Guardar">
										</div>
									</div>				
								</div>
							</form>	
						</div>
				</div>
			</div>
	</div>
			
<div class="row" style="text-align: right;">
	<button  id="closeModalJuridica" name="closeModalJuridica" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
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

		$('#validarResponsableEjecucionJuridica').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				comboResponsableEjecucionJuridica:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Responsable de ejecución" es requerido.</b>'
						}
					}
				},
        comboCargoEjecucionJuridica:
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
				// $('#comboResponsableEjecucion').val('');
        // $('#comboCargoEjecucion').val('');
        $('#closeModal').trigger('click');
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}

	function guardarResponsableEjecucionJuridica()
	{
		event.preventDefault();
        $('#validarResponsableEjecucionJuridica').data('formValidation').validate();
		if(!($('#validarResponsableEjecucionJuridica').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmResponsableEjecucionJuridica")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Expediente_Tecnico/insertarResponsableEjecucionJuridica",
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
				// $('#comboResponsableEjecucionJuridica').val('');
        // $('#comboCargoEjecucionJuridica').val('');
        $('#closeModalJuridica').trigger('click');
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






