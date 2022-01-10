<form  id="frmInsertarProgramacionActividad">
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
						<div id ="divFormProgramacionActividad">						
							<input type="hidden" id="hdIdPi" name="hdIdPi" autocomplete="off" class="form-control" value="<?=$idPi?>">
							<input type="hidden" id="hiddenIdActividad" name="hiddenIdActividad" autocomplete="off" class="form-control" value="<?=$Actividad->id_actividad?>">
							<input type="hidden" id="txtCostoActividad" name="txtCostoActividad" readonly value="<?=$Actividad->costo_total?>">
							<input type="hidden" id="txtMetaActividad" name="txtMetaActividad" readonly value="<?=$Actividad->meta?>">

							<div class="row">
								<div class="col-md-3 col-sm-6 col-xs-12">
									<label for="control-label">Mes: </label>
									<div>
										<input type="month" id="txtMeses" name="txtMeses" value="<?=date('Y-m')?>" min="<?=date('Y-m',strtotime($Actividad->fecha_inicio))?>"  max="<?=date('Y-m',strtotime($Actividad->fecha_fin))?>" class="form-control notValidate">
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<label for="control-label">Ejec. Fís. Programada: </label>
									<div>
										<input type="text" id="txtFisica" name="txtFisica" autocomplete="off" class="form-control">
										<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta programar <?=$cantidadRestante?> en cantidad
										</label>
									</div>
								</div>
								<div class="col-md-4 col-sm-6 col-xs-12">
									<label for="control-label">Ejec. Fín. Programada: </label>
									<div>
										<input type="text" id="txtFinanc" name="txtFinanc" autocomplete="off" class="form-control moneda">
										<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta programar S/. <?=a_number_format($costoRestante,2,'.',",",3)?> en costo
										</label>
									</div>
								</div>							
							</div>							
						</div>
						<div class="row">
							<br><br>
							<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
								<input type="button" name="" class="btn btn-success" onclick="guardarProgramacionActividad();" value="Guardar">
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

	$("#txtFisica").keyup(function()
    {
    	var costo=$('#txtCostoActividad').val();
    	var meta=$('#txtMetaActividad').val();
		var precioUnitario = costo/meta;
		var calculo = $(this).val()*precioUnitario;
		$('#txtFinanc').val(format(''+calculo+''));
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
		$('#divFormProgramacionActividad').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message:'<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor</b>',
			trigger: null,
			fields:
			{
				txtFisica:
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
				txtFinanc:
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

	function guardarProgramacionActividad()
	{
		event.preventDefault();
		$('#divFormProgramacionActividad').data('formValidation').validate();
		if(!($('#divFormProgramacionActividad').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmInsertarProgramacionActividad")[0]);
		var idActividad=$('#hiddenIdActividad').val();
		var mes=$('#txtMeses').val()+'-01';
		var ejecucionFisica=$('#txtFisica').val();
		var ejecucionFinanciera=$('#txtFinanc').val();
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_Programacion_Actividad/Insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	if(resp.proceso=='Correcto')
	        	{
	        		var htmlTemp = '<tr><td>'+mes+'</td><td>'+ejecucionFisica+'</td><td>'+ejecucionFinanciera+'</td><td><a role="button" class="btn btn-success btn-xs" onclick="paginaAjaxDialogo(\'editarProgramacion\',\'Editar Programación\', {idEjecucion:'+resp.idProgramacion+', idActividad :'+idActividad+'}, base_url+\'index.php/Mo_Programacion_Actividad/editar\',\'GET\', null, null, false, true); return false;" data-toggle="tooltip" data-placement="top" title="Editar Programación"><span class="fa fa-edit"></span></a> <a onclick="eliminarProgramacion('+resp.idProgramacion+',this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Programación" ><span class="fa fa-trash-o"></span></a></td></tr>';

	        		$('#tbodyActividad'+idActividad+'').append(htmlTemp);
	        	}
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));	        		        		        	
	        	$('#frmInsertarProgramacionActividad')[0].reset();
                $('#modalProgramacion').modal('hide');   	
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }	        
    	});
	}
</script>