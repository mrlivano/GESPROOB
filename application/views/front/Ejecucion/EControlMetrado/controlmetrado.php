<?php
function mostrarAnidado($meta, $expedienteTecnico,$countValorizacionDiaria)
{
	$htmlTemp='';

	$htmlTemp.='<tr class="elementoBuscar">'.
		'<td><b><i>'.$meta->numeracion.'</i></b></td>'.
		'<td style="text-align: left;"><b><i>'.html_escape($meta->desc_meta).'</i></b></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>'.
		'<td></td>';		
	$htmlTemp.='</tr>';
	if(count($meta->childMeta)==0)
	{		
		foreach($meta->childPartida as $key => $value)
		{
			$valorSuperado = 'ninguno';
			foreach ($countValorizacionDiaria as $key => $item) 
			{				
				if($item->id_detalle_partida == $value->childDetallePartida->id_detalle_partida)
				{
					if($item->cantidad==$value->childDetallePartida->cantidad)
						$valorSuperado = 'completo';
					if($item->cantidad<$value->childDetallePartida->cantidad)
						$valorSuperado = 'incompleto';
					if($item->cantidad>$value->childDetallePartida->cantidad)
						$valorSuperado = 'mayormetrado';
				}
			}

			switch ($valorSuperado) 
			{
			    case 'ninguno':
			        $clase='btn btn-danger btn-xs';
			        break;
			    case 'incompleto':
			        $clase='btn btn-warning btn-xs';
					break;
				case 'completo':
			        $clase='btn btn-success btn-xs';
			        break;
				case 'mayormetrado':
					$clase='btn btn-info btn-xs';
					break;			    
			}

			$htmlTemp.='<tr class="elementoBuscar">'.
				'<td>'.$value->numeracion.'</td>'.
				'<td style="text-align: left;">'.html_escape($value->desc_partida).'</td>'.
				'<td>'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;">'.$value->cantidad.'</td>'.
				'<td style="text-align: right;">S/.'.$value->precio_unitario.'</td>'.
				'<td style="text-align: right;">S/.'.number_format($value->cantidad*$value->precio_unitario, 2).'</td>'.
				'<td style="text-align: center;"><a id="btnOpcion'.$value->childDetallePartida->id_detalle_partida.'" class="'.$clase.'" onclick="valorizar('.$expedienteTecnico->id_et.','.$value->childDetallePartida->id_detalle_partida.');"><i class="fa fa-plus"></i> Registrar</a></td>'.
				'</tr>';
		}		
	}
	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarAnidado($value, $expedienteTecnico,$countValorizacionDiaria);
	}
	return $htmlTemp;
}
?>
<style>
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th 
	{
		padding:6px;
	}
	.btn, .buttons, .modal-footer .btn+.btn, button 
	{
	    margin-bottom: 0px;
	    margin-right: 5px;
	}

	table
	{
		text-transform:uppercase;
	}

	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 3px 6px ;
}
</style>
<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_title">
			<h2><b>Ejecución diaria de Metrados: <?=trim($expedienteTecnico->descripcion_modificatoria)?></b></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">                    
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<label class="control-label"> Nombre del Proyecto:</label>
					<div>
						<textarea rows="2" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=trim($expedienteTecnico->nombre_pi)?></textarea>
						<br>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-sm-6 col-xs-12">
					<select id="selectTipoEstado" name="selectTipoEstado" class="form-control">
						<option value="Programado">Expediente Técnico</option>
					</select>
				</div>
			</div>
			<br>
			<div id="tablaExpedienteTecnico" style="display:block;">
				<div class="table-responsive">
					<table id="tableValorizacion" class="table table-striped table-bordered table-sm" >
						<thead>
							<tr>
								<th>ÍTEM</th>
								<th>DESCRIPCIÓN</th>
								<th>UND.</th>
								<th style="text-align: right;">CANT.</th>
								<th style="text-align: right;">P.U.</th>
								<th style="text-align: right;">TOTAL</th>
								<th style="text-align: center;"> OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($expedienteTecnico->childComponente as $key => $value){ ?>
								<tr class="elementoBuscar">
									<td><b><i><?=$value->numeracion?></i></b></td>
									<td style="text-align: left;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php foreach($value->childMeta as $index => $item){ ?>
									<?= mostrarAnidado($item, $expedienteTecnico, $countValorizacionDiaria)?>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div id="tablaAdicional" style="display:none;">
				<div class="table-responsive">
					<table id="tableValorizacionAdicional" class="table table-striped table-bordered table-sm" >
						<thead>
							<tr>
								<th>ÍTEM</th>
								<th>DESCRIPCIÓN</th>
								<th>UND.</th>
								<th style="text-align: right;">CANT.</th>
								<th style="text-align: right;">P.U.</th>
								<th style="text-align: right;">TOTAL</th>
								<th style="text-align: center;"> OPCIONES</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($expedienteTecnico->childComponenteAdicional as $key => $value){ ?>
								<tr class="elementoBuscar">
									<td><b><i><?=$value->numeracion?></i></b></td>
									<td style="text-align: left;"><b><i><?=html_escape($value->descripcion)?></i></b></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
								<?php foreach($value->childMeta as $index => $item){ ?>
									<?= mostrarAnidado($item, $expedienteTecnico, $countValorizacionDiaria)?>
								<?php } ?>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>				
		</div>
	</div>
</div>
<script>

	$(document).ready(function()
	{
		$('#tableValorizacion').DataTable(
		{
			"language":idioma_espanol,
			"pageLength": 25,
			"ordering":  false
		});

		$('#tableValorizacionAdicional').DataTable(
		{
			"language":idioma_espanol,
			"pageLength": 25,
			"ordering":  false
		});
	});

	function valorizar(idEt, codigo)
	{
		paginaAjaxDialogo(null, 'Valorizacion de Partida',{ idExpediente: idEt, id_DetallePartida: codigo }, base_url+'index.php/Expediente_Tecnico/AsignarValorizacion', 'GET', null, null, false, true);
	}

	$('#selectTipoEstado').on('change', function()
	{
		var selected=$(this).find("option:selected").val();
		if(selected=="Adicional")
		{
			$('#tablaExpedienteTecnico').hide();
			$('#tablaAdicional').show();			
		}
		else
		{
			$('#tablaAdicional').hide();
			$('#tablaExpedienteTecnico').show();			
		}		
    });
</script>
