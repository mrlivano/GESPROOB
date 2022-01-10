<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">		
					<div id="myTabContent" class="tab-content">
						<div class="row">  
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="x_content">
									<?php if($etapa==1) { ?>
									<table id="table-ResponsableExpediente"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td>Tipo de responsable</td>
												<td>Responsable</td>
												<td>Grado Académico</td>
												<td>Especialidad</td>
												
											</tr>
										</thead>
										<tbody>
										<?php foreach($listaResponsableExpediente as $item ){ ?>
										  	<tr>
												<td>
													<?=$item->desc_tipo_responsable_et?>
										    	</td>
										    	<td>
													<?=$item->Responsable?>
										    	</td>
												<td>
													<?=$item->grado_academico?>
										    	</td>
										    	<td>
													<?=$item->especialidad?>
										    	</td>
										  </tr>
										<?php } ?>
										</tbody>
									</table>
									<?php } if($etapa==3) { ?>	
									<table id="table-ResponsableExpediente"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td>Cargo</td>
												<td>Responsable</td>
												<td>Fecha de Asignación</td>												
											</tr>
										</thead>
										<tbody>
										<?php foreach($listaResponsableExpediente as $item ){ ?>
										  	<tr>
												<td>
													<?=$item->desc_cargo?>
										    	</td>
										    	<td>
													<?=$item->nombres?> <?=$item->apellido_p?> <?=$item->apellido_m?>
										    	</td>
												<td>
													<?=date('d/m/Y',strtotime($item->fecha_asignacion_resp_et)) ?>
										    	</td>
										  </tr>
										<?php } ?>
										</tbody>
									</table>
									<?php } ?>									
								</div>
							</div>
						</div>					
					</div>				
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
