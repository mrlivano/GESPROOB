<style>
	#tableSub3 td, #tableSub3 th
	{
		border: 1px solid #a2a2b1;
		font-size: 11px;
		padding: 3px;
		text-align: center;
		vertical-align: middle;
	}
	table{
		border-collapse: collapse;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>MONITOREO DE INVERSIONES</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="row">
						<input type="hidden" name="idProyecto" id="idProyecto" value="<?=$idPi?>">
						<div class="col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">Mes:</label>
							<div>
								<select id="txtMes" name="txtMes" class="form-control selectpicker" data-live-search="true">
									<?php foreach ($listaMeses as $key => $value) { ?>
										<option value="<?=$value?>" <?php echo (date('m')==$value ? 'selected' : '')?> ><?=$key?></option>
									<?php } ?>
								</select>
							</div>
						</div>
						<div class="col lg-1 col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">Año</label>
							<div>
								<input type="text" id="txtAnio" name="txtAnio" maxlength="4" autocomplete="off" class="form-control" value="<?=date('Y')?>">
							</div>
						</div>
						<div class="col-md-6 col-sm-6 col-xs-12">
							<label for="control-label">.</label>
							<div>
								<button class="btn btn-primary" onclick="mostrarReporteMensual();" ><span class="fa fa-search"></span>  Buscar</button>
							</div>
						</div>
						<div class="col-md-2 col-sm-6 col-xs-12">
							<label for="control-label">.</label>
							<div>
								<a style="width: 100%;" onclick="reportePdf();" target='_blank' role="button" class="btn btn-warning"><span class="fa fa-file-pdf-o"></span> Reporte PDF</a>
							</div>
						</div>									
					</div>
					<br>
					<div class="table-responsive" id="tablaMonitoreoMensual">
						<table id="tableSub3" width="100%" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0">
							<thead >
								<tr>
									<th rowspan="3">Descripción del producto</th>
									<th rowspan="3">Actividades</th>
									<th colspan="7">Ejecución Física</th>
									<th colspan="6">Ejecución Financiera</th>
								</tr>
								<tr>
									<th rowspan="2">Unidad Med.</th>
									<th rowspan="2">Meta</th>
									<th colspan="2">Meta Programada</th>
									<th colspan="2">Meta Ejecutada</th>
									<th rowspan="2">% Avance Acum.</th>
									<th rowspan="2">Monto Total</th>
									<th colspan="2">Monto Programado</th>
									<th colspan="2">Monto Ejecutado</th>
									<th rowspan="2">% Avance Acum.</th>
								</tr>
								<tr>
									<th>Del mes</th>
									<th>Acumulado</th>
									<th>Del mes</th>
									<th>Acumulado</th>
									<th>Del mes</th>
									<th>Acumulado</th>
									<th>Del mes</th>
									<th>Acumulado</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($listaProducto as $key => $value) {?>
									<tr>

										<td style="text-align: left; text-transform: uppercase;"><?=$value->desc_producto?></td>
										<td style="text-align: left;text-transform: uppercase;"><?=$value->desc_actividad?></td>
										<td><?=$value->uni_medida?></td>
										<td><?=$value->meta?></td>
										<td><?=$value->MetaProgdelMes?></td>
										<td><?=$value->MetaAcumulado?></td>
										<td><?=$value->MetaEjecdelMes?></td>
										<td><?=$value->MetaEjecAcumulado?></td>
										<td><?=a_number_format($value->PorcentajeEjecAcumulado, 2, '.',",",0)?> %</td>
										<td><?=a_number_format($value->costo_total, 2, '.',",",3)?></td>
										<td><?=a_number_format($value->MontoProgdelMes , 2, '.',",",3)?></td>
										<td><?=a_number_format($value->MontoAcumulado, 2, '.',",",3)?></td>
										<td><?=a_number_format($value->MontoEjecdelMes , 2, '.',",",3)?></td>
										<td><?=a_number_format($value->MontoEjecAcumulado , 2, '.',",",3)?></td>	
										<td><?=a_number_format($value->PorcentajeProgAcumulado, 2, '.',",",0)?> %</td>						
									</tr>
								<?php } ?>							
							</tbody>						
						</table>

					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<script>

	function mostrarReporteMensual()
	{
		var mes = $('#txtMes').val();
		var anio = $('#txtAnio').val();
		var idPi = $('#idProyecto').val();

		$.ajax({
            url: base_url +"index.php/Mo_MonitoreodeProyectos/FichadeMonitoreo",
            type: 'POST',
            cache: false,
            data:
            {
            	hdIdProyecto:idPi,
            	anio:anio,
            	mes:mes
            },
            beforeSend: function(xhr)
            {
                renderLoading();
            },
            success: function (data)
            {
                $('#divModalCargaAjax').hide();
            	$('#tablaMonitoreoMensual').html(data);
            },
            error: function ()
            {
                $('#divModalCargaAjax').hide();
	        	swal('Error', 'Error no controlado.', 'error');
            }
        });
	}

	function reportePdf()
	{
		var mes = $('#txtMes').val();
		var anio = $('#txtAnio').val();
		var idPi = $('#idProyecto').val();
		window.open(base_url+'index.php/Mo_MonitoreodeProyectos/FichadeMonitoreoPDF?id_pi='+idPi+'&mes='+mes+'&anio='+anio,'_blank');
	}

	$(function()
	{
		$('#divAgregarProducto').formValidation(
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
							regexp: /^[0-9]{4}$/,
							message: '<b style="color: red;">El campo "Año" debe ser un número de cuatro dígitos</b>'
						}
					}
				}
			}
		});		
	});
</script>