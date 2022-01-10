<form  id="frmInsertarEjecucionActividad">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="row">
			<div class="col-md-12">
				<div>
					<label style="color: #0073b7; font-size: 14px;" for="control-label">Actividad: <?=$Actividad->desc_actividad?></label><br>
					<label style="color: #0073b7; font-size: 14px;" for="control-label">Meta: <?=$Actividad->meta?><br><br></label>					
				</div>
				<?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) { ?>
				<div id ="divFormEjecucionActividad">
					<input type="hidden" id="hdIdPi" name="hdIdPi" autocomplete="off" class="form-control" value="<?=$idPi?>">
					<input type="hidden" id="hdIdActividad" name="hdIdActividad" autocomplete="off" class="form-control" value="<?=$Actividad->id_actividad?>">
					<input type="hidden" id="txtCosto" name="txtCosto" readonly value="<?=$Actividad->costo_total?>">
					<input type="hidden" id="txtMeta" name="txtMeta" readonly value="<?=$Actividad->meta?>">

					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">Fecha: </label>
							<div>
								<input type="date" id="txtFecha" name="txtFecha" value="<?=date('Y-m-d')?>" class="form-control">
							</div>
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">Cantidad Ejecutada: </label>
							<div>
								<input type="text" id="txtCantidadEjecutada" name="txtCantidadEjecutada" autocomplete="off" class="form-control">
								<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta ejecutar <span id="txtCantidadRestante"><?=$cantidadRestante?></span> en cantidad
								</label>
							</div>
						</div>	
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">Monto Ejecutado: </label>
							<div>
								<input type="text" id="txtMontoEjecutado" name="txtMontoEjecutado" autocomplete="off" class="form-control moneda">
								<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta ejecutar S/. <span id="txtCostoRestante"><?=a_number_format($costoRestante,2,'.',",",3)?></span> en costo
								</label>
							</div>
						</div>	
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label for="control-label">.</label>
							<div>
								<input type="button" name="" class="btn btn-success" onclick="guardarEjecucionActividad();" class="notValidate" value="Guardar">
							</div>
						</div>						
					</div>
				</div>
				<?php } ?>
				<br>						
				<div class="row" style="background-color: #f2f5f7; text-align: center;">
					<br>
					<div class="table-responsive">
						<table id="tablaActividadesEjecutadas" class="table table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td>Fecha</td>
									<td>Cantidad Ejecutada</td>
									<td>Monto Ejecutada</td>
									<?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1) { ?>
									<td>Opciones</td>
									<?php } ?>
								</tr>
							</thead>
							<tbody>
							<?php foreach ($ejecucionActividad as $key => $value) { ?>
								<tr>
									<td><?=$value->fecha_ejec?></td>
									<td><?=$value->ejec_fisic_real?></td>
									<td>
										<?=a_number_format($value->ejec_finan_real,2,'.',",",3)?>
									</td>
									<?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1) { ?>
									<td>
										<a onclick="eliminarEjecucion('<?=$value->id_ejecucion?>',this);"  role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Ejecución"><span class="fa fa-trash-o"></span></a>
									</td>
									<?php } ?>
								</tr>
							<?php } ?>
							</tbody>
						</table>
					</div>
				</div>						
				<div class="row">
					<br><br>
					<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
						<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar ventana</button>
					</div>	
				</div>
			</div>					
		</div>
	</div>
</div>
</form>
<script>

	$(document).ready(function()
	{
		$('#tablaActividadesEjecutadas').DataTable(
		{
			"language":idioma_espanol
		});
	});

	$("#txtCantidadEjecutada").keyup(function()
    {
		var precioUnitario = $('#txtCosto').val()/$('#txtMeta').val();
		var calculo = $(this).val()*precioUnitario;
		$('#txtMontoEjecutado').val(format(''+calculo+''));
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

	$(function()
	{
		$('#divFormEjecucionActividad').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message:'<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor</b>',
			trigger: null,
			fields:
			{
				txtFecha:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
						}
					}
				},
				txtCantidadEjecutada:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Cantidad Ejecutada " es requerido.</b>'
						},
						regexp:
						{
							regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                        	message: '<b style="color: red;">El campo "Cantidad Ejecutada" debe ser númerico.</b>'                    
						}
					}
				},
				txtMontoEjecutado:
				{
					validators:
					{				
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Monto Ejecutada " es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
                        	message: '<b style="color: red;">El campo "Monto Ejecutada" debe ser númerico.</b>'                    
						}
					}
				}
			}
		});
	});

	function guardarEjecucionActividad()
	{
		event.preventDefault();
		$('#divFormEjecucionActividad').data('formValidation').validate();
		if(!($('#divFormEjecucionActividad').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmInsertarEjecucionActividad")[0]);
		var idActividad=$('#hdIdActividad').val();
		var mes=$('#txtFecha').val();
		var ejecucionFisica=$('#txtCantidadEjecutada').val();
		var ejecucionFinanciera=$('#txtMontoEjecutado').val();
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_Ejecucion_Actividad/Insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
	        	$('#txtCantidadEjecutada').val('');
	        	$('#txtMontoEjecutado').val('');
	        	if (resp.proceso=='Correcto')
	        	{
	        		$(".dataTables_empty").parent().remove();
	        		$('#tablaActividadesEjecutadas').append('<tr><td>'+mes+'</td><td>'+ejecucionFisica+'</td><td>'+ejecucionFinanciera+'</td><td><a onclick="eliminarEjecucion('+resp.idEjecucion+',this);" role="button" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Ejecución"><span class="fa fa-trash-o"></span></a></td></tr>')
	        		$('#txtCantidadRestante').text(resp.cantidadRestante);
	        		$('#txtCostoRestante').text(resp.costoRestante);
	        		if(resp.completo)
	        		{
	        			var currentRow = $("#trActividad"+idActividad);			
						currentRow.find("td:eq(7)").html('<span class="label label-success labelMsg"><span class="fa fa-check-square"></span></span>');
	        			$('#trActividad'+idActividad).css('background-color', '#c8ece5');
	        		}
	        	}
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
    	});
	}

	function eliminarEjecucion(idEjecucion, element)
    {
    	var idActividad=$('#hdIdActividad').val();
        swal({
            title: "Esta seguro que desea eliminar la ejecución de esta actividad?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({"hdIdActividad":idActividad, "idEjecucion" : idEjecucion }, base_url+'index.php/Mo_Ejecucion_Actividad/eliminar', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

                if(resp.proceso=='Correcto')
                {
                    $(element).parent().parent().remove();
                    var currentRow = $("#trActividad"+idActividad);			
					currentRow.find("td:eq(7)").html('');
	        		$('#trActividad'+idActividad).css('background-color', '#f9f9f9');

                }               
            }, false, true);
        });
    }

</script>