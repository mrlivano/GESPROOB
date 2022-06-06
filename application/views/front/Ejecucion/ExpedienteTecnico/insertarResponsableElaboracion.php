<div id="validarResponsableElaboracion">
	<form class="form-horizontal" id="frmResponsableElaboracion">
		<input id="hdET" name="hdET" value="<?=$id_et?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
			<label class="control-label">Responsable de Elaboración:</label>
	    	<div class="form-group">
		      	<select class="selectpicker form-control" id="comboResponsableElaboracion" name="comboResponsableElaboracion" data-live-search="true">
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
				<select class="selectpicker form-control" id="comboCargoElaboracion" name="comboCargoElaboracion" data-live-search="true">
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
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarResponsableElaboracion();" value="Guardar">
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
		$('#validarResponsableElaboracion').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				comboResponsableElaboracion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Responsable de elaboración" es requerido.</b>'
						}
					}
				},
        comboCargoElaboracion:
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


	function guardarResponsableElaboracion()
	{
		event.preventDefault();
        $('#validarResponsableElaboracion').data('formValidation').validate();
		if(!($('#validarResponsableElaboracion').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmResponsableElaboracion")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Expediente_Tecnico/insertarResponsableElaboracion",
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
				$('#tablaResponsableElaboracion').dataTable()._fnAjaxUpdate();
				$('#comboResponsableElaboracion').val('');
        $('#comboCargoElaboracion').val('');
        $('#closeModal').trigger('click');
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






