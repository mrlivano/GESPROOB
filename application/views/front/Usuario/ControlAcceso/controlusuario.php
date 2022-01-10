<style>
	.row
	{
		margin-top: 4px;
	}
</style>

<form class="form-horizontal" id="frmEditarControlUsuario">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">							
							<label class="control-label" style="color: #223140;">Nombres y Apellidos: <?=$controlUsuario->nombres?></label>
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">							
							<label class="control-label" style="color: #223140;">Usuario: <?=$controlUsuario->usuario?></label>
						</div>						
					</div>
					<div class="row">
						<input type="hidden" readonly="true" name="hdIdPersona" id="hdIdPersona" value="<?=$controlUsuario->id_persona?>">
						<div class="col-md-3 col-sm-3 col-xs-12">							
							<label class="control-label">Dia de Inicio:</label>
							<div>
								<input type="text" maxlength="2" name="txtDiaInicio" id="txtDiaInicio" class="form-control" autocomplete="off" value="<?=$controlUsuario->desde?>">
							</div>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-12">
							<label class="control-label">Dia Final:</label>
							<div>
								<input type="text" maxlength="2" name="txtDiaFin" id="txtDiaFin" class="form-control" autocomplete="off" value="<?=$controlUsuario->hasta?>">
							</div>
						</div>
						<div class="col-md-2 col-sm-3 col-xs-12">
							<label class="control-label">Hora:</label>
							<div>
								<input type="time" name="txtHoraAcceso" id="txtHoraAcceso" class="form-control" value="<?=$controlUsuario->hora_acceso?>">
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
		$('#frmEditarControlUsuario').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
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
            $('#frmEditarControlUsuario').data('formValidation').resetField($('#txtAnio'));
            $('#frmEditarControlUsuario').data('formValidation').resetField($('#txtDiaInicio'));
            $('#frmEditarControlUsuario').data('formValidation').resetField($('#txtDiaFin'));
            $('#frmEditarControlUsuario').data('formValidation').validate();
			if(!($('#frmEditarControlUsuario').data('formValidation').isValid()))
			{
				return;
			}
            var formData=new FormData($("#frmEditarControlUsuario")[0]);
            var dataString = $('#frmEditarControlUsuario').serialize();
            var idPersona=$('#hdIdPersona').val();
            var desde =$('#txtDiaInicio').val();
            var hasta =$('#txtDiaFin').val();
            $.ajax({
                type:"POST",
                url:base_url+"index.php/Control/editarControlUsuario",
                data: formData,
                cache: false,
                method:'POST',
                contentType:false,
                processData:false,
                success:function(resp)
                {
                	resp=JSON.parse(resp);
                	swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                	var currentRow = $("#tr"+idPersona);	
                	if(resp.proceso=='Correcto')
                	{
                		currentRow.find("td:eq(2)").html(''+desde);
                		currentRow.find("td:eq(3)").html(''+hasta);
                	}                	
                }, 
                error:function()
                {
                	swal('Error','Ha ocurrido un error Inesperado, comuniquese con el Administrador','error');
                	window.location.href=base_url+'Control/index';
                }
            });
          	$('#frmEditarControlUsuario')[0].reset();
          	$('#modalEditarControlUsuario').modal('hide');
    });
	
</script>






