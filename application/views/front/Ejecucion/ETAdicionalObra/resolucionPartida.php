<form  id="frmResolucionPartida" >
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">						
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<p><span style="text-transform:uppercase;font-size:12px;font-weight:bold;" class="glyphicon-class">PARTIDA: <?=$partida->desc_partida?></span></p>
						</div>
						<?php if($partida->url!='') { ?>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="bs-glyphicons">
								<ul class="bs-glyphicons-list">
									<a target="_blank" href="<?= base_url();?>uploads/ResolucionAdicional/ResolucionPartida/<?=$partida->id_partida?><?=$partida->url?>"><li style="height:77px;">
										<span class="glyphicon glyphicon-book" aria-hidden="true"></span>
										<span class="glyphicon-class">ver archivo</span>
									</li></a>
								</ul>
							</div>
						</div>
						<?php } ?>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label"><?=($partida->url!='' ? 'Reemplazar' : 'Adjuntar')?> Resolución de Aprobación:</label>
							<div class="col-md-12 col-sm-12 col-xs-12">
								<input type="hidden" id="hdIdPartida" name="hdIdPartida" notValidate value="<?=$partida->id_partida?>">	                            									
								<input accept=".pdf,.doc,.docx" type="file" id="fileResolucionPartida" name="fileResolucionPartida" class="form-control">
								<label style="color:#f0ad4e;">Solo se aceptan archivos en formato pdf,docx</label>
							</div>
						</div>
					</div>	
				</div>				
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button  id="btnResolucionPartida" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
 
	$(function()
	{
		$('#frmResolucionPartida').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileResolucionPartida:
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

    $('#btnResolucionPartida').on('click', function(event)
   	{
        event.preventDefault();
        $('#frmResolucionPartida').data('formValidation').validate();
		if(!($('#frmResolucionPartida').data('formValidation').isValid()))
		{
			return;
		}
        var formData=new FormData($("#frmResolucionPartida")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/ET_AdicionalObra/resolucionPartida",
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
				$('#resolucionPartida').modal('hide');
				$('#divModalCargaAjax').hide();
            },
			error: function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
      	$('#frmResolucionPartida')[0].reset();
    });			  
</script>