<style>
	.row
	{
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="frmAgregarControl" action="<?php echo base_url();?>index.php/Control/<?=$accion?>" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<input type="hidden" readonly="true" name="hdIdControlAcceso" id="hdIdControlAcceso" value="<?=@$controlAcceso->id_control_acceso?>">
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Año:</label>
							<div>
								<input type="text" class="form-control" name="txtAnio" id="txtAnio" maxlength="4" autocomplete="off" <?php echo (!empty($controlAcceso->anio) ? 'readonly' : '');?> value="<?php echo (empty($controlAcceso->anio) ? date('Y') : $controlAcceso->anio );?>">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Dia de Inicio:</label>
							<div>
								<input type="text" maxlength="2" name="txtDiaInicio" id="txtDiaInicio" class="form-control" autocomplete="off" value="<?=@$controlAcceso->fecha_inicio?>">
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Dia Final:</label>
							<div>
								<input type="text" maxlength="2" name="txtDiaFin" id="txtDiaFin" class="form-control" autocomplete="off" value="<?=@$controlAcceso->fecha_final?>">
							</div>
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
		$('#frmAgregarControl').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtAnio:
				{
					validators:
					{					
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Año" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^([0-9]){4}$/,
							message: '<b style="color: red;">El campo "Año" debe ser un número de 4 dígitos.</b>'
						}
					}
				},
				txtDiaInicio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Dia de Inicio" es requerido.</b>'
						},
						between: {
                            min: 01,
                            max: 31,
                            message: '<b style="color: red;">El campo "Dia de Inicio" debe estar entre el dia 01 y 31.</b>'
                        },
                        regexp:
						{
							regexp: /^([0-9]){2}$/,
							message: '<b style="color: red;">El campo "Dia de Inicio" debe ser un número de 2 dígitos.</b>'
						}
					}
				},
				txtDiaFin:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Dia de Fin" es requerido.</b>'
						},
						between: {
                            min: 01,
                            max: 31,
                            message: '<b style="color: red;">El campo "Dia de Fin" debe estar entre el dia 01 y 31.</b>'
                        },
                        regexp:
						{
							regexp: /^([0-9]){2}$/,
							message: '<b style="color: red;">El campo "Dia de Inicio" debe ser un número de 2 dígitos.</b>'
						}
					}
				}
			}
		});
	});
    $('#btnEnviarFormulario').on('click', function(event)
   	{
            event.preventDefault();
            $('#frmAgregarControl').data('formValidation').resetField($('#txtAnio'));
            $('#frmAgregarControl').data('formValidation').resetField($('#txtDiaInicio'));
            $('#frmAgregarControl').data('formValidation').resetField($('#txtDiaFin'));
            $('#frmAgregarControl').data('formValidation').validate();
			if(!($('#frmAgregarControl').data('formValidation').isValid()))
			{
				return;
			}
            var formData=new FormData($("#frmAgregarControl")[0]);
            var dataString = $('#frmAgregarControl').serialize();
            $.ajax({
                type:"POST",
                url:base_url+"index.php/Control/<?=$accion?>",
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
                	window.location.href=base_url+'Control/index';
                }, 
                error:function()
                {
                	swal('Error','Ha ocurrido un error Inesperado, comuniquese con el Administrador','error');
                	window.location.href=base_url+'Control/index';
                }
            });
          $('#frmAgregarControl')[0].reset();
    });
	
</script>






