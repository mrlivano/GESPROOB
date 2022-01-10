<style>
	.row
	{
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="frmCambioContrasenia" action="<?php echo base_url();?>index.php/Expediente_Tecnico/editar" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row" id="validarCambioContrasenia">
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Contraseña Actual:</label>
							<div>
								<input type="password" class="form-control" name="txtContraseniaActual" id="txtContraseniaActual" value="">	
							</div>	
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Nueva Contraseña:</label>
							<div>
								<input type="password" class="form-control" name="txtContraseniaNueva" id="txtContraseniaNueva" value="">	
							</div>	
						</div>
						<div class="col-md-4 col-sm-3 col-xs-12">
							<label class="control-label">Repita Contraseña:</label>
							<div>
								<input type="password" class="form-control" name="txtContraseniaRepite" id="txtContraseniaRepite" value="">	
							</div>	
						</div>						
					</div>
				</div>
			</div>
		</div>
	</div>	
	<br>
	<div class="row" style="float:  right;">
		<div class="col-md-12 col-sm-12 col-xs-12">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			
		</div>
		
	</div>
</form>
<script>
	$(function()
	{
		$('#validarCambioContrasenia').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtContraseniaActual:
				{
					validators:
					{					
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Contarseña Actual" es requerido.</b>'
						}
					}
				},
				txtContraseniaNueva:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Contraseña Nueva" es requerido.</b>'
						}
					}
				},
				txtContraseniaRepite:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Repita Contraseña" es requerido.</b>'
						}
					}
				}
			}
		});
	});
    $('#btnEnviarFormulario').on('click', function(event)
   	{
            event.preventDefault();
            $('#validarCambioContrasenia').data('formValidation').validate();
			if(!($('#validarCambioContrasenia').data('formValidation').isValid()))
			{
				return;
			}
            var formData=new FormData($("#frmCambioContrasenia")[0]);
            var dataString = $('#frmCambioContrasenia').serialize();
            $.ajax({
                type:"POST",
                url:base_url+"index.php/Usuario/cambiarContrasenia",
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
                	resp=JSON.parse(resp);
                	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                    $('#modalCambio').modal('hide');
                    window.location.href=base_url+"index.php/Inicio";
                }
            });
          	$('#frmCambioContrasenia')[0].reset();
    });
	
</script>







