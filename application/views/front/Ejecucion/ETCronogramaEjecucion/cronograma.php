<?php
$totalPresupuesto=0;
?>
<?php
function mostrarMetaAnidada($meta, $expedienteTecnico, &$listaMesesPeriodo, $anio ,&$totalPresupuesto)
{
	$htmlTemp='';

	$htmlTemp.='<tr class="elementoBuscar">'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;"><b><i>'.html_escape($meta->desc_meta).'</i></b></td>'.
		'<td>---</td>'.
		'<td>---</td>'.
		'<td>---</td>'.
		'<td>---</td>'.
		'<td>---</td>';

		foreach($listaMesesPeriodo as $i => $mes)
		{
			$htmlTemp.='<td>---</td>';
		}

	$htmlTemp.='</tr>';

	if(count($meta->childMeta)==0)
	{

		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr class="elementoBuscar " id="fila'.$value->id_partida.'">'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td>'.number_format($value->cantidad, 4, '.', '').'</td>'.
				'<td>S/.'.number_format($value->precio_unitario,2).'</td>'.
				'<td>S/.'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>'.
				'<td><span style="color:#d9534f;font-weight:bold" id="saldo'.$value->id_partida.'">'.number_format($value->saldo, 2).'</span></td>';

			$ValorizacionporPartida = 0;
			$totalPresupuesto += $value->cantidad*$value->precio_unitario;

			foreach($listaMesesPeriodo as $i => $mes)
			{
				$precioTotalMesValorizacionTemp=0;
				$cantidadMesValorizacionTemp=0;

				foreach($value->childDetallePartida->childMesValorizacion as $index => $item)
				{
					if($item->id_detalle_partida==$value->childDetallePartida->id_detalle_partida && $item->numero_mes==($mes->num))
					{

						$precioTotalMesValorizacionTemp=$item->precio;

						$ValorizacionporPartida+=$item->cantidad;

						$cantidadMesValorizacionTemp=$item->cantidad;

						break;
					}
				}
				$htmlTemp.='<td '.($precioTotalMesValorizacionTemp==0 ? 'style="background-color: #f5f5f5;"' : 'style="background-color: #fff1b0;"').'><div><input type="text" style="display: none;padding: 0px;width: 40px;" value="'.$cantidadMesValorizacionTemp.'" onkeyup="onKeyUpCalcularPrecio('.$value->cantidad.', '.$value->precio_unitario.', '.$value->childDetallePartida->id_detalle_partida.', '.$mes->num.','.$anio.', this, event,'.$value->id_partida.');"></div><span class="spanMontoValorizacion">S/.'.number_format($precioTotalMesValorizacionTemp, 2).'</span><input value="'.$precioTotalMesValorizacionTemp.'" hidden></input></td>';
				$mes->total = $mes->total + $precioTotalMesValorizacionTemp;
			}

			if($ValorizacionporPartida==$value->cantidad)
			{
				$htmlTemp.='</tr><script>$("#fila'.$value->id_partida.'").css("background-color", "#baf9c4")</script>';
			}
			else
			{
				$htmlTemp.='</tr>';
			}

		}

	}

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value, $expedienteTecnico, $listaMesesPeriodo, $anio, $totalPresupuesto);
	}

	return $htmlTemp;
}
?>
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
		text-transform:uppercase;
	}	

	table.dataTable tr{
		background-color: white;
	}

	table.dataTable td, table.dataTable th {
		border: 1px solid #999999;
		font-size: 10px;
		padding: 4px;
		text-align: center;
		vertical-align: middle;
		color: #123c67;
	}

	table.dataTable {
     margin-top: 0px !important; 
     margin-bottom: 0px !important;

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
	.espacio{
		height: 20px;
	}
</style>

<!-- <div class="row">
	<div class="col-md-12 col-xs-12">
		<input type="text" class="form-control" placeholder="Buscar partidas por su descripción" autocomplete="off" style="margin-bottom: 15px;" onkeyup="filtrarHtml('tableValorizacion', this.value, true, 0, event);">
	</div>
</div> -->
<div id="divContenedorGeneral" style="overflow-y: scroll;overflow-x: scroll;">
	<table id="tableValorizacion">
		<thead>
			<tr>
				<th>PROY:</th>
				<th colspan="6"><?=html_escape($expedienteTecnico->nombre_pi)?></th>
				<th colspan="<?=count($listaMesesPeriodo)?>">CRONOGRAMA VALORIZADO DE EJECUCIÓN DEL PROYECTO <?=$anio?></th>
			</tr>
			<tr>
				<th>ÍTEM</th>
				<th>DESCRIPCIÓN</th>
				<th>UND.</th>
				<th>CANT.</th>
				<th>P.U.</th>
				<th>TOTAL</th>
				<th>SALDO</th>
				<?php foreach($listaMesesPeriodo as $key => $value)
				{ ?>
				<th><?=substr($value->mes, 0, 3)?></th>
				<?php 
					$value->total = 0;
				} ?>
			</tr>
		</thead>
		<tbody>
		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
			<?php foreach($expedienteTecnico->childComponente as $key => $value)
			{ ?>
				<tr class="elementoBuscar">
					<td><b><i><?=$value->numeracion?></i></b></td>
					<td style="text-align: left;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
					<td>---</td>
					<td>---</td>
					<td>---</td>
					<td>---</td>
					<td>---</td>
					<?php foreach($listaMesesPeriodo as $i => $mes)
					{ ?>
					<td>---</td>
					<?php } ?>
				</tr>
				<?php foreach($value->childMeta as $index => $item)
				{ ?>
					<?= mostrarMetaAnidada($item, $expedienteTecnico, $listaMesesPeriodo, $anio, $totalPresupuesto)?>
				<?php } }?>
			<?php } ?>
		</tbody>
	</table>
	<br>
	<table id="tableValorizacionTotal" width="100%">
		<thead>
			<tr>
				<th>DESCRIPCIÓN</th>
				<th>TOTAL</th>
				<?php foreach($listaMesesPeriodo as $key => $value)
				{ ?>
				<th><?=substr($value->mes, 0, 3)?></th>
				<?php 
				} ?>
			</tr>
		</thead>
		<tbody>
		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
				<tr  class="elementoBuscar">
					<td style="text-align: left;"><b><i>TOTAL</i></b></td>
					<td><?=number_format($totalPresupuesto,2)?></td>
					<?php foreach($listaMesesPeriodo as $i => $mes)
					{ ?>
					<td><span id="mesS<?=$mes->id?>">S/.<?=number_format($mes->total,2)?></span><input id="mes<?=$mes->id?>" value="<?=$mes->total?>" hidden></td>
					<?php } ?>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script>

	$(function()
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

		var table = $('#tableValorizacion').DataTable({
        scrollX:        true,
        scrollCollapse: true,
        searching:      true,
        ordering:       false,
				autoWidth: false,
        fixedColumns:   {
            leftColumns:  7
        }
    });
		var table = $('#tableValorizacionTotal').DataTable({
        scrollX:        true,
        scrollCollapse: true,
				paging:   false,
        searching:      false,
        ordering:       false,
				autoWidth: false,
        fixedColumns:   {
            leftColumns:  2
        }
    });

		$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
         .columns.adjust()
         .fixedColumns().relayout();
   });  
	});

	// $(document).on('ready', function()
	// {
	// 	var table = $('#tableValorizacion').DataTable({
  //       scrollX:        true,
  //       scrollCollapse: true,
  //       searching:      true,
  //       ordering:       false,
	// 			autoWidth: false,
  //       fixedColumns:   {
  //           leftColumns:  7
  //       }
  //   });

	// 	$('a[data-toggle="tab"]').on('shown.bs.tab', function(e){
  //     $($.fn.dataTable.tables(true)).DataTable()
  //        .columns.adjust()
  //        .fixedColumns().relayout();
  //  });  

	// });

	function onKeyUpCalcularPrecio(cantidad, precioUnitario, idDetallePartida, numeroMes, anio, element, event, id_partida)
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

			paginaAjaxJSON({ idDetallePartida : idDetallePartida, numeroMes : numeroMes, anio : anio, cantidad : cantidadTemp, precio : monto.toFixed(2) }, '<?=base_url()?>index.php/ET_Cronograma_Ejecucion/insertar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				if(objectJSON.proceso=='Error')
				{
					swal(
					{
						title: '',
						text: objectJSON.mensaje,
						type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
					},
					function(){});

					return false;
				}
				const montoAnterior = $($(element).parent().parent().find('input')[1]).val();
				const montoMes = $('#mes'+numeroMes).val();
				const montoActual = montoMes - montoAnterior + monto;

				$('#mes'+numeroMes).val(montoActual);
				$('#mesS'+numeroMes).text('S/.'+montoActual.toFixed(2));

				$($(element).parent().parent().find('input')[1]).val(monto);
				$($(element).parent().parent().find('span')[0]).text('S/.'+monto.toFixed(2));
				$($(element).parent().parent().css('background-color', '#fff1b0'));

				$('#saldo'+id_partida).text(objectJSON.saldo);
				$('.DTFC_Cloned #saldo'+id_partida).text(objectJSON.saldo);
				if(objectJSON.proceso=='Completo')
				{
					$($(element).parent().parent().parent().css('background-color', '#baf9c4'));
					$($('.DTFC_Cloned #saldo'+id_partida).parent().parent().css('background-color', '#baf9c4'));
				}
				else
				{
					$($(element).parent().parent().parent().css('background-color', 'white'));
					$($('.DTFC_Cloned #saldo'+id_partida).parent().parent().css('background-color', 'white'));
				}

			}, false, true);
		}
	}

	function onKeyUpGuardarCronograma(idComponente, numeroMes, anio, element, event, montoComponente)
	{
		var evt=event || window.event;

		var code=0;

		if(evt!='noEventHandle')
		{
			code=evt.charCode || evt.keyCode || evt.which;
		}

		if(code==13)
		{
			var monto=$(element).val();			

			if(isNaN(monto) || monto.trim()=='')
			{
				return;
			}
			if(isNaN(monto) || monto.trim()=='')
			{
				return;
			}

			paginaAjaxJSON({ idComponente : idComponente, numeroMes : numeroMes, anio : anio, monto : monto,montoComponente }, '<?=base_url()?>index.php/ET_Cronograma_Componente/insertar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				if(objectJSON.proceso=='Error')
				{
					swal(
					{
						title: '',
						text: objectJSON.mensaje,
						type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
					},
					function(){});

					return false;
				}

				$($(element).parent().parent().css('background-color', '#fff1b0'));
				
				$($(element).parent().parent().find('span')[0]).text('S/.'+(parseFloat(monto).toFixed(2)));
				
			}, false, true);
		}
	}
</script>
