<style>
	#tableValorizacion td input[type="text"]
	{
		text-align: center;
	}

	#tableValorizacion td, #tableValorizacion th
	{
		border: 1px solid #999999;
		font-size: 10px;
		padding: 4px;
		text-align: center;
		vertical-align: middle;
		color: #123c67;
	}
	#tableValorizacionResumen td, #tableValorizacionResumen th
	{
		border: 1px solid #999999;
		font-size: 10px;
		padding: 4px;
		text-align: left;
		vertical-align: middle;
	}

	.spanMontoValorizacion
	{
		cursor: pointer;
	}

	.spanMontoValorizacion:hover
	{
		text-decoration: underline;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-10 col-xs-12">
							<input type="text" class="form-control" placeholder="Buscar recurso por su descripción" autocomplete="off" style="margin-bottom: 15px;" onkeyup="filtrarHtml('tableValorizacion', this.value, true, 0, event);">
						</div>
						<div class="col-md-2 col-xs-12">
							<a href="<?=base_url();?>index.php/ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et=<?=$expedienteTecnico->id_et?>&id_recurso=<?=$recurso[0]->id_recurso?>" role=button class="btn btn-primary" target="_blank"><i class="fa fa-file-pdf-o"></i> Exportar a PDF</a>
						</div>
						<br>
					</div>
					<div id="divContenedorGeneral" style="overflow-x: scroll;">
						<table id="tableValorizacion">
							<thead>
								<tr>
									<th colspan="6"><?=html_escape($expedienteTecnico->nombre_pi)?></th>
									<?php if($expedienteTecnico->num_meses!=null){ ?>
										<th style="text-transform:uppercase;" colspan="<?=$expedienteTecnico->num_meses?>">CRONOGRAMA DE REQUERIMIENTO DE <?=$recurso[0]->desc_recurso?> (S/.)</th>
									<?php } ?>
								</tr>
								<tr>
									<th>DESCRIPCIÓN</th>
									<th>UND.</th>
									<th>CANT.</th>
									<th>P.U. (S/.)</th>
									<th>TOTAL (S/.)</th>
									<th>SALDO</th>
									<?php if($expedienteTecnico->num_meses!=null)
									{
										for($i=0; $i<$expedienteTecnico->num_meses; $i++)
										{ ?>
											<th>M<?=($i+1)?></th>
										<?php }
									} ?>
								</tr>
							</thead>
							<tbody>
								<?php foreach($recurso as $key => $value) { ?>
									<?php foreach($value->childInsumo as $key => $item) { ?>								
									<tr class="elementoBuscar" <?=(number_format($item->saldo, 4, '.', '')=='0.0000' ? 'style="background-color:#baf9c4;"' : 'style="background-color:#ffffff;"')?>>
										<td style="text-align: left;width:25%"><?=$item->desc_insumo?></td>
										<td style="width:7%;"><?=$item->descripcion?></td>
										<td style="text-align: right;width:7%;"><?=$item->cantidad?></td>
										<td style="text-align: right;width:7%;"><?=a_number_format($item->precio_unitario , 2, '.',",",3)?></td>
										<td style="text-align: right;width:7%;"><?=a_number_format($item->parcial , 2, '.',",",3)?></td>
										<td style="text-align: right;width:7%;"><span style="color:#d9534f;font-weight:bold" id="saldo<?=$item->id_relacion_insumo?>"><?=number_format($item->saldo, 4, '.', '')?></span></td>
										<?php if($expedienteTecnico->num_meses!=null) {
											for($i=0; $i<$expedienteTecnico->num_meses; $i++) { 
												$cantidadPorMes=0;
												$costoPorMes=0;
												foreach($item->childInsumoValorizacion as $key => $child) { 
													if($child->numero_mes==($i+1))
													{
														$cantidadPorMes+=$child->cantidad;
														$costoPorMes+=$child->parcial;
													}
												}
												?>
												<td <?=($cantidadPorMes==0 ? 'style="background-color:#f5f5f5;"' : 'style="background-color:#fff1b0;"')?> ><div><input type="text" style="display: none;padding: 0px;width: 40px;" value="<?=$cantidadPorMes?>" onkeyup="onKeyUpCalcularPrecio('<?=$item->precio_unitario?>', '<?=$item->cantidad?>', '<?=$item->id_relacion_insumo?>', <?=($i+1)?>, this, event);"></div><span class="spanMontoValorizacion">S/.<?=a_number_format($costoPorMes , 2, '.',",",3)?></span></td>
											<?php }
										} ?>
									</tr>
									<?php } ?>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<script>
	$(document).on('ready', function()
	{
		$('.spanMontoValorizacion').on('click', function()
		{
			if($(this).parent().find('input[type="text"]').is(':visible'))
			{
				$(this).parent().find('input[type="text"]').hide();
			}
			else
			{
				$('.spanMontoValorizacion').parent().find('input[type="text"]').hide();
				$(this).parent().find('input[type="text"]').show();
			}
		});
	});

	function onKeyUpCalcularPrecio(precioUnitario, cantidadInsumo, idRelacionInsumo, numeroMes, element, event)
	{
		var evt=event || window.event;

		var code=0;

		if(evt!='noEventHandle')
		{
			code=evt.charCode || evt.keyCode || evt.which;
		}

		if(code==13)
		{
			var cantidadTemp=$(element).val();

			if(isNaN(cantidadTemp) || cantidadTemp.trim()=='')
			{
				return;
			}

			var monto=cantidadTemp*precioUnitario;

			paginaAjaxJSON({ idRelacionInsumo : idRelacionInsumo, numeroMes : numeroMes, cantidad : cantidadTemp, precio : monto.toFixed(2) }, '<?=base_url()?>index.php/ET_RelacionInsumo/insertar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));

				if(objectJSON.proceso=='Error')
				{
					return;
				}

				$($(element).parent().parent().find('span')[0]).text('S/.'+monto.toFixed(2));

				$($(element).parent().parent().css('background-color', '#fff1b0'));

				$('#saldo'+idRelacionInsumo).text(objectJSON.saldo);				

				if(objectJSON.estado==1)
				{
					$($(element).parent().parent().parent().css('background-color', '#baf9c4'));
				}
				else
				{
					$($(element).parent().parent().parent().css('background-color', 'white'));
				}

			}, false, true);
		}
	}
</script>
