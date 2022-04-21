<style>
	.help-block {
        color: indianred;
    }

    .msgError {
        display: none;
        padding-bottom: 0px;
        margin-bottom: 0px;
        font-size: 12px;
    }
</style>
<form class="form-horizontal" id="frmAgregarGeneralidades">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Generalidades:</label></br>
							<input type="hidden" name="hdIdExpediente" id="hdIdExpediente" value="<?=$expedienteTecnico[0]->id_et?>">											
							<input type="hidden" id="hdEspecificacionTecnica" value="<?=htmlspecialchars($expedienteTecnico[0]->generalidad_especificacion_tecnica)?>" type="hidden">
							<p><textarea name="txtGeneralidad" id="txtGeneralidad" rows="10" cols="80"></textarea></p>
							<div class="msgError"><p class="help-block" id="MsgContenido"> Oops!</p></div>                              
						</div>	
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>  
	$(function()
	{
		CKEDITOR.replace('txtGeneralidad', {
			filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
		});

		html=$("#hdEspecificacionTecnica").val();
		
		CKEDITOR.instances.txtGeneralidad.setData(html);
	});

	function valCKEDITOR()
	{
		var cantidad = CKEDITOR.instances.txtGeneralidad.getData().replace(/<[^>]*>/gi, '').length;
		if (!cantidad)
		{
			var mensaje = 'El campo "contenido" es requerido';
			$("#MsgContenido").parent().css("display", "block");
			$("#MsgContenido").text(mensaje);
			return mensaje;
		}
		else
		{
			$("#MsgContenido").parent().css("display", "none");
			return '';
		}	
	}

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();	
		if(valCKEDITOR()!='')
		{
			return;
		}
		for (instance in CKEDITOR.instances) 
		{
			CKEDITOR.instances[instance].updateElement();
		}
		var formData=new FormData($("#frmAgregarGeneralidades")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/ET_EspecificacionTecnica/AgregarGeneralidad",
			data: formData,
			cache: false,
			contentType:false,
			processData:false,
			beforeSend: function() 
			{
				renderLoading();
			},
			success:function(resp)
			{
				objectJSON=JSON.parse(resp);
				swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				$('#modalGeneralidad').modal('hide');
				$('#divModalCargaAjax').hide();			

			},
			error: function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});  
		$('#frmAgregarGeneralidades')[0].reset();
	});

</script>







