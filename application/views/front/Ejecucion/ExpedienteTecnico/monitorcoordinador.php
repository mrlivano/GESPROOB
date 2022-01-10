<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>MONITOR DE EXPEDIENTE TÉCNICO (COORDINADOR)</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<table id="tableExpedienteTecnico" class="table table-striped">
						<thead>
							<th style="text-align: center;">Código único</th>
							<th>Nombre PI</th>
							<th style="text-align: center;">Inicio/Fin</th>
							<th></th>
						</thead>
						<tbody>
							<?php foreach($listaETExpedienteTecnico as $key => $value){ ?>
								<tr>
									<td style="text-align: center;"><?=$value->codigo_unico_pi?></td>
									<td><?=html_escape($value->nombre_pi)?></td>
									<td style="text-align: center;width: 150px;"><?=($value->existeGantt ? substr($value->primeraETTarea->fecha_inicio_tarea, 0, 10).'/'.substr($value->ultimaETTarea->fecha_final_tarea, 0, 10) : '')?></td>
									<td>
										<?php if($value->existeGantt){ ?>
											<?php if(substr($value->primeraETTarea->fecha_inicio_tarea, 0, 10)<=date('Y-m-d') && substr($value->ultimaETTarea->fecha_final_tarea, 0, 10)>=date('Y-m-d')){ ?>
												<div style="background-color: #58aaff;border-radius: 20px;display: inline-block;height: 20px;width: 20px;" title="En proceso"></div>
											<?php } ?>
											<?php if(substr($value->primeraETTarea->fecha_inicio_tarea, 0, 10)>date('Y-m-d')){ ?>
												<div style="background-color: #12b112;border-radius: 20px;display: inline-block;height: 20px;width: 20px;" title="En espera"></div>
											<?php } ?>
											<?php if(substr($value->ultimaETTarea->fecha_final_tarea, 0, 10)<date('Y-m-d')){ ?>
												<div style="background-color: #bdbdc4;border-radius: 20px;display: inline-block;height: 20px;width: 20px;" title="Fuera de fecha"></div>
											<?php } ?>
										<?php } else{ ?>
											<div style="background-color: #12b112;border-radius: 20px;display: inline-block;height: 20px;width: 20px;" title="Sin cronograma"></div>
										<?php } ?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('ready', function()
	{
		$('#tableExpedienteTecnico').DataTable(
		{
			"language":idioma_espanol
		});
	});
</script>