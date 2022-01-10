
<div class="form-horizontal">
	<form  id="frmMemoriaDescriptiva" >					
		<div class="row">
			<?php if($expedienteTecnico->url_memoria_descriptiva!='') { ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="bs-glyphicons">
					<ul class="bs-glyphicons-list">
						<a target="_blank" href="<?= base_url();?>uploads/MemoriaDescriptiva/<?=$expedienteTecnico->id_et?><?=$expedienteTecnico->url_memoria_descriptiva?>"><li style="height:77px;">
							<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
							<span class="glyphicon-class">ver archivo</span>
						</li></a>
					</ul>
				</div>
			</div>
			<?php } ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label"><?=($expedienteTecnico->url_memoria_descriptiva!='' ? 'Reemplazar' : 'Adjuntar')?> Memoria Descriptiva:</label>
				<div class="col-md-12 col-sm-12 col-xs-12">
					<input type="hidden" id="hdIdExpedienteTecnico" name="hdIdExpedienteTecnico" notValidate value="<?=$expedienteTecnico->id_et?>">	                            									
					<input accept=".pdf,.doc,.docx" type="file" id="fileMemoriaDescriptiva" name="fileMemoriaDescriptiva" class="form-control">
					<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
				</div>
			</div>
		</div>
		<div class="row" style="text-align: right;">
			<button  id="btnGuardarMemoriaDescriptiva" class="btn btn-success">Guardar</button>
			<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
	</form>
<div class="form-horizontal">

<script>
 
	$(function()
	{
		$('#frmMemoriaDescriptiva').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileMemoriaDescriptiva:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Memoria Descriptiva" es requerido.</b>'
						}
					}
				}
			}
		});
	});

    $('#btnGuardarMemoriaDescriptiva').on('click', function(event)
   	{
        event.preventDefault();
        $('#frmMemoriaDescriptiva').data('formValidation').validate();
		if(!($('#frmMemoriaDescriptiva').data('formValidation').isValid()))
		{
			return;
		}
        var formData=new FormData($("#frmMemoriaDescriptiva")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/Expediente_Tecnico/MemoriaDescriptiva",
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
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();				
				window.location.href=base_url+"index.php/Expediente_Tecnico/verdetalle?id_et="+$('#hdIdExpedienteTecnico').val();
            },
			error: function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
      	$('#frmMemoriaDescriptiva')[0].reset();
    });			  
</script>