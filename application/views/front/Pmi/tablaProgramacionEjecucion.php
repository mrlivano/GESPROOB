<div class="table-responsive">
	<div class="row">
		<div class="col-md-4">
			<a class="btn btn-primary" href="<?= site_url('PipProgramados/reporteProgramacionPdf?anio='.$anio.'&opcion=ejecucion');?>" target="_blank"><span><i class='fa fa-file-pdf-o red'></i> PDF</span></a>
		</div>
	</div>
	<br>
	<table id="tablaProgramacionEjecucion" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead style="background-color: #5A738E;color:#FFFFFF; border-collapse: collapse;">
			<tr>
				<th rowspan="2">Orden de Prioridad</th>
				<th rowspan="2">Código Unico</th>
				<th rowspan="2">Inversión</th>
				<th style="text-align:right;" rowspan="2">Costo</th>						
				<th style="text-align:right;" rowspan="2">PIM <?=$anio?></th>
				<th style="text-align:right;" rowspan="2">Dev. Acum.</th>
				<th style="text-align:right;" rowspan="2">Saldo</th>
				<th colspan="3" style="text-align:center;">PROGRAMACIÓN</th>				
				<th rowspan="2">Fase</th>	
			</tr>
			<tr>			
				<th style="text-align:right;"><?=$anio+1?></th>
				<th style="text-align:right;"><?=$anio+2?></th>
				<th style="text-align:right;"><?=$anio+3?></th>			
			</tr>
		</thead>
		<tbody>
			<?php foreach ($ProyectoProgramado as $key => $value) {
			$inv1='Inv_'.($anio+1);
			$inv2='Inv_'.($anio+2);
			$inv3='Inv_'.($anio+3);
			?>
			<tr>
				<td><?=$value->prioridad_prog?></td>
				<td><?=$value->codigo_unico_pi?></td>
				<td><?=$value->nombre_pi?></td>
				<td style="text-align:right;"><?=number_format(@$value->costo_pi, 2, '.', ',')?></td>				
				<td style="text-align:right;"><?=number_format(@$value->pim, 2, '.', ',')?></td>
				<td style="text-align:right;"><?=number_format(@$value->devengado_acumulado, 2, '.', ',')?></td>
				<td style="text-align:right;"><?=number_format(@$value->saldo, 2, '.', ',')?></td>
				<td style="text-align:right;"><?=number_format(@$value->$inv1, 2, '.', ',')?></td>
				<td style="text-align:right;"><?=number_format(@$value->$inv2, 2, '.', ',')?></td>
				<td style="text-align:right;"><?=number_format(@$value->$inv3, 2, '.', ',')?></td>
				<td><?=$value->nombre_estado_ciclo?></td>				
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<script>
	var table=$("#tablaProgramacionEjecucion").DataTable({
        "language": idioma_espanol,
        "ordering":false,
    });


</script>