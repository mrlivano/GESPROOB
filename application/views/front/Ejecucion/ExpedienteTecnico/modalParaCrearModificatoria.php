<form  id="frmAprobarExpediente"   action="<?php echo base_url();?>index.php/Expediente_Tecnico/insertar" method="POST" enctype="multipart/form-data" >

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">						
					<div class="row">
						<?php if($fechaAprobacion == '') { ?>
							<div class="col-md-12 col-sm-12 col-xs-12">
	                            <label class="control-label">Descripcion de Modificatoria:</label>
	                            <input class="form-control col-md-4 col-xs-12" type="text" name="txtDescripcionModificatoria" id="txtDescripcionModificatoria" notValidate>
	                        </div>
							<div class="col-md-8 col-sm-12 col-xs-12">
	                            <label class="control-label">Adjuntar Resolución de Aprobacion de Modificatoria:</label>
	                            <div class="col-md-12 col-sm-9 col-xs-12">                            
	                            	<input type="hidden" id="url" name="url" notValidate>
	                            	<input type="hidden" id="idEtapaExpedienteTecnico" name="idEtapaExpedienteTecnico" notValidate value="10">
	                            	<input type="hidden" id="idExpedienteTecnico" name="idExpedienteTecnico" notValidate value="<?=$idExpedienteTecnico?>">	                            	
	                            	<input type="file" id="fileResolucion" name="fileResolucion" notValidate class="form-control">
	                             </div>
	                        </div>
	                        <div class="col-md-4 col-sm-12 col-xs-12">
	                            <label class="control-label">Fecha de Aprobacion de Modificatoria:</label>
	                            <input class="form-control col-md-4 col-xs-12" type="date" name="txtFechaAprobacion" id="txtFechaAprobacion" notValidate>
	                        </div>
	                    <?php } 
	                    else
	                    {?>
	                		<div class="col-md-12 col-sm-12 col-xs-12">
	                			<input type="hidden" id="url" name="url" notValidate>
                            	<input type="hidden" id="idEtapaExpedienteTecnico" name="idEtapaExpedienteTecnico" notValidate value="10">
                            	<input type="hidden" id="idExpedienteTecnico" name="idExpedienteTecnico" notValidate value="<?=$idExpedienteTecnico?>">	
	                            <label class="control-label" style="color: #337ab7; font-size: 14px;">Se adjunto anteriormente la Resolución de Modificatoria con fecha : <?=$fechaAprobacion?></label>
	                        </div>
	                    <?php } ?>
					</div>	
				</div>				
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
	<?php if($fechaAprobacion == '') { ?>
		<button  id="btnEnviarFormulario" class="btn btn-success">Crear Modificatoria</button>
		<?php }?>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>
 <script>
 
$(function()
	{
		$('#frmAprobarExpediente').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileResolucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Resolución de Aprobación" es requerido.</b>'
						}
					}
				},
				txtFechaAprobacion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de Aprobación" es requerido.</b>'
						}
					}
				},
				txtDescripcionModificatoria:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de Aprobación" es requerido.</b>'
						}
					}
				}
			}
		});
	});
    $('#btnEnviarFormulario').on('click', function(event)
   	{
        event.preventDefault();
        $('#frmAprobarExpediente').data('formValidation').validate();
		if(!($('#frmAprobarExpediente').data('formValidation').isValid()))
		{
			return;
		}
		var archivo=$("#fileResolucion").val();
		if(typeof archivo!='undefined')
		{
			var extension = archivo.split('.').pop();
        	$("#url").val(extension);
		}
		else
		{
			$("#url").val("");
		}

        var formData=new FormData($("#frmAprobarExpediente")[0]);
        var dataString = $('#frmAprobarExpediente').serialize();
        $.ajax({
            type:"POST",
            enctype: 'multipart/form-data',
            url:base_url+"index.php/Expediente_Tecnico/clonacionModificatoria",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            beforeSend: function() {
            	renderLoading();
		    },
            success:function(resp)
            {
            	objectJSON=JSON.parse(resp);
				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function()
				{
					$('#divModalCargaAjax').hide();
					if(objectJSON.proceso=='Correcto')
					{
						renderLoading();

						window.location.href=base_url+'Expediente_Tecnico/verdetalle?id_et='+objectJSON.id_et;
					}
				});
            }
			
        });
      	$('#frmAprobarExpediente')[0].reset();
    });			  
</script>