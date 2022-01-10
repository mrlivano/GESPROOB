<form  id="frmImpactoAmbiental" enctype="multipart/form-data">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">						
					<div class="row">						
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="bs-glyphicons">
								<ul class="bs-glyphicons-list">
								<?php if($expedienteTecnico->url_impacto_ambiental!='') { ?>
									<a target="_blank" href="<?= base_url();?>uploads/ImpactoAmbiental/<?=$expedienteTecnico->id_et?><?=$expedienteTecnico->url_impacto_ambiental?>"><li style="height:77px;">
										<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
										<span class="glyphicon-class">Ver FE-03</span>
									</li></a>
								<?php } if($expedienteTecnico->url_categoria_impacto!='') {?>
									<a target="_blank" href="<?= base_url();?>uploads/ImpactoAmbiental/<?='CR'.$expedienteTecnico->id_et?><?=$expedienteTecnico->url_categoria_impacto?>"><li style="height:77px;">
										<span class="glyphicon glyphicon-picture" aria-hidden="true"></span>
										<span class="glyphicon-class">Ver Resolución</span>
									</li></a>
								<?php } ?>
								</ul>
							</div>
						</div>		
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label"><?=($expedienteTecnico->url_impacto_ambiental!='' ? 'Reemplazar' : 'Adjuntar')?> Impacto Ambiental (FE-03):</label>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" id="hdIdExpedienteTecnico" name="hdIdExpedienteTecnico" notValidate value="<?=$expedienteTecnico->id_et?>">	                            									
								<input accept=".pdf,.doc,.docx" type="file" id="fileImpactoAmbiental" name="fileImpactoAmbiental" class="form-control">
								<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
							</div>							
						</div>
					</div>	
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<input type="checkbox" id="radioseia">
							<label style="color:#31708f;padding-bottom:10px;" class="control-label" for="radioseia">Seia?</label>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12" id="contenedorCategorizacion" style="display:none;">
							<label class="control-label">Resolución:</label>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<input accept=".pdf,.doc,.docx" type="file" id="fileResolucion" name="fileResolucion" class="form-control">
								<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	<div class="row" style="text-align: right;">
		<button  id="btnGuardarImpactoAmbiental" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
 
	$(function()
	{
		$('#frmImpactoAmbiental').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileImpactoAmbiental:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Impacto Ambiental" es requerido.</b>'
						}
					}
				}
			}
		});
	});

	$("#radioseia").on('change', function()
	{
		if( $(this).is(':checked'))
		{
			$('#contenedorCategorizacion').show(1000);
		} 
		else
		{
			$('#contenedorCategorizacion').hide(1000);			
		}
	});

    $('#btnGuardarImpactoAmbiental').on('click', function(event)
   	{
        event.preventDefault();
        $('#frmImpactoAmbiental').data('formValidation').validate();
		if(!($('#frmImpactoAmbiental').data('formValidation').isValid()))
		{
			return;
		}
        var formData=new FormData($("#frmImpactoAmbiental")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/Expediente_Tecnico/ImpactoAmbiental",
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
      	$('#frmImpactoAmbiental')[0].reset();
    });			  
</script>