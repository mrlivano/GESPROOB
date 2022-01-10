<form  id="frmEditarProgramacionActividad">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content" >		
				<div class="row">
					<div class="col-md-12">
						<div>
							<label style="color: #0073b7; font-size: 14px;" for="control-label">Actividad: <?=$Actividad->desc_actividad?></label><br>
							<label style="color: #0073b7; font-size: 14px;" for="control-label">Meta: <?=$Actividad->meta?><br><br></label>					
						</div>

						<div>
						<label style="color: red; font-size: 13px;">Falta programar <?=$cantidadRestante?> en cantidad y S/. <?=a_number_format($costoRestante,2,'.',",",3)?> en costo<br></label><br><br>
							
						</div>
						<div id ="divFormEditarProgramacionActividad">
							<input type="hidden" id="hdIdActividad" name="hdIdActividad" autocomplete="off" class="form-control" value="<?=$programacion->id_actividad?>">
							<input type="hidden" id="txtCostoActividadEdicion" name="txtCostoActividadEdicion" readonly value="<?=$Actividad->costo_total?>">
							<input type="hidden" id="txtMetaActividadEdicion" name="txtMetaActividadEdicion" readonly value="<?=$Actividad->meta?>">
							<input type="hidden" id="hdIdProgramacion" name="hdIdProgramacion" autocomplete="off" class="form-control" value="<?=$programacion->id_actividad_programacion?>">
							<div class="row">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<label for="control-label">Mes: </label>
									<div>
										<input type="month" id="txtMesesEditar" name="txtMesesEditar" value="<?=date('Y-m',strtotime($programacion->fecha_programacion))?>" class="form-control notValidate" min="<?=date('Y-m',strtotime($Actividad->fecha_inicio))?>" max="<?=date('Y-m',strtotime($Actividad->fecha_fin))?>"> 
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<label for="control-label">Ejec. Fís. Programada: </label>
									<div>
										<input type="text" id="txtFisicaEditar" name="txtFisicaEditar" autocomplete="off" class="form-control" value="<?=$programacion->cantidad_ejecucion_programada?>" >
									</div>
								</div>
								<div class="col-md-3 col-sm-6 col-xs-12">
									<label for="control-label">Ejec. Fín. Programada: </label>
									<div>
										<input type="text" id="txtFinancEditar" name="txtFinancEditar" autocomplete="off" class="form-control moneda" value="<?=a_number_format($programacion->ejec_finan_programada, 2, '.',",",3)?>">
									</div>
								</div>			
							</div>							
						</div>
						<div class="row">
							<br><br>
							<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
								<input type="button" name="" class="btn btn-success" onclick="guardarEdicionProgramacionActividad();" value="Guardar">
								<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar ventana</button>
							</div>	
						</div>
					</div>					
				</div>
			</div>				
		</div>
	</div>
</div>
</form>
<script>

	$("#txtFisicaEditar").keyup(function()
    {
    	var costo=$('#txtCostoActividadEdicion').val();
    	var meta=$('#txtMetaActividadEdicion').val();
		var precioUnitario = costo/meta;
		var calculo = $(this).val()*precioUnitario;
		$('#txtFinancEditar').val(format(''+calculo+''));
    });

	$(".moneda").keyup(function(e)
	{
	    $(this).val(format($(this).val()));
	});

	var format = function(num)
	{
	    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0)
	    {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++)
	    {
	        if(str[j] != ",")
	        {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1))
	            {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

	$('.selectpicker').selectpicker({
	});

	$(function()
	{
		$('#divFormEditarProgramacionActividad').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message:'<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor</b>',
			trigger: null,
			fields:
			{
				txtMesesEditar:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Mes" es requerido.</b>'
						}
					}
				},
				txtFisicaEditar:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Ejec. Fís. Programada" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                        	message: '<b style="color: red;">El campo "Ejec. Fís. Programada" debe ser númerico.</b>'                    
						}
					}
				},
				txtFinancEditar:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Ejec. Fin. Programada" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        	message: '<b style="color: red;">El campo "Ejec. Fin. Programada" debe ser númerico.</b>'                    
						}
					}
				}
			}
		});
	});

	function guardarEdicionProgramacionActividad()
	{
		event.preventDefault();
		$('#divFormEditarProgramacionActividad').data('formValidation').validate();
		if(!($('#divFormEditarProgramacionActividad').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmEditarProgramacionActividad")[0]);
		var idProgramacion=$('#hdIdProgramacion').val();
		var mes=$('#txtMesesEditar').val()+'-01';
		var ejecucionFisica=$('#txtFisicaEditar').val();
		var ejecucionFinanciera=$('#txtFinancEditar').val();
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_Programacion_Actividad/editar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
                resp = JSON.parse(resp);
	        	if(resp.proceso=='Correcto')
	        	{
	        		var currentRow = $("#trProgramacion"+idProgramacion);			
					currentRow.find("td:eq(0)").text(mes);
					currentRow.find("td:eq(1)").text(ejecucionFisica);
					currentRow.find("td:eq(2)").text(ejecucionFinanciera);
	        	}
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));	        		        		        	
	        	$('#frmEditarProgramacionActividad')[0].reset();
                $('#editarProgramacion').modal('hide');     	
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
    	});
	}
</script>