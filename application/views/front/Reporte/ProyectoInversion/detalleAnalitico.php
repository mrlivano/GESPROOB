<style>
	.modal-dialog
	{
		width: 90%;
		margin: 0;
		margin-left: 5%;
		padding: 0;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>

<div class="right_col" role="main">
	<div class="col-md-12 col-xs-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content">
				<div class="row">  
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<table id="table-DetalleAnaliticoAvance" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td>Prod/Proy. Cat.Pptal. Act/AI/Obr Fun. Div.Fn. Finalidad Meta A Gen</td>
									</tr>
								</thead>
								<tbody>		
									<?php if(count($listaDetalleAnaliticoAvancFin) == 0){?>
										<tr>
											<td>Prod/Proy. Cat.Pptal. Act/AI/Obr Fun. Div.Fn. Finalidad Meta A Gen</td>
										</tr>
									<?php  } else { ?>
										<tr>
											<td><?= 'Proyecto   : '.$listaDetalleAnaliticoAvancFin[0]->act_proy .' - '.$listaDetalleAnaliticoAvancFin[0]->proyecto;?>  </td>
										</tr>
										<tr>
											<td><?= 'META       : '.$listaDetalleAnaliticoAvancFin[0]->meta.' - '.$listaDetalleAnaliticoAvancFin[0]->proyecto;?></td>
										</tr>
										<tr>
											<td><?= 'Programa   : '.$listaDetalleAnaliticoAvancFin[0]->programa.' - '.$listaDetalleAnaliticoAvancFin[0]->programa_nombre;?>  </td>
										</tr>
										<tr>
											<td><?= 'SubPrograma: '.$listaDetalleAnaliticoAvancFin[0]->sub_programa.' - '.$listaDetalleAnaliticoAvancFin[0]->sub_programa_nombre;?>  </td>
										</tr>
										<tr>
											<td><?= 'Funcion    : '.$listaDetalleAnaliticoAvancFin[0]->funcion.' - '.$listaDetalleAnaliticoAvancFin[0]->funcion_nombre;?>  </td>	
										</tr>
									<?php  } ?>								
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row">  
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">						
							<table id="table-DetalleAnalitico" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td>Finalidad</td>
										<td>Presupuesto</td>
										<td>Modificación</td>
										<td>Pim Acumulado</td>
										<!--<td>Ejecución</td>-->
										<td>Certificado</td>
										<td>Compromiso</td>
										<td>Devengado</td>
										<td>Girado</td>
										<td>Pagado</td>
									</tr>
								</thead>
								<tbody>
									<?php foreach($listaDetalleAnaliticoAvancFin as $item ){ ?>									
										<tr>
											<td>
												<?=$item->finalidad.' '.$item->finalidad_nombre?>
											</td>
											<td><?=a_number_format($item->presupuesto, 2, '.',",",3)?></td>
											<td><?=a_number_format($item->modificacion, 2, '.',",",3)?></td>
											<td><?=a_number_format($item->pim_acumulado, 2, '.',",",3)?></td>
											<!--<td><?=a_number_format($item->ejecucion, 2, '.',",",3)?></td>-->
											<td><?=a_number_format($item->certificado, 2, '.',",",3)?></td>
											<td><?=a_number_format($item->compromiso, 2, '.',",",3)?></td><td><?=a_number_format($item->devengado, 2, '.',",",3)?></td>
											<td><?=a_number_format($item->girado, 2, '.',",",3)?></td>
											<td><?=a_number_format($item->pagado, 2, '.',",",3)?></td>
										</tr>
									<?php } ?>				
								</tbody>						
							</table>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</div>
</div>
