<ul id="myTab" class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#tab_tipo_estudioFE" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Fuentes de presupuesto</a>
	</li>
	<li role="presentation" class=""><a href="#tab_nivelInversio"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span>Detalle de presupuesto</a>
	</li>
</ul>

<div id="myTabContent" class="tab-content">
	<div role="tabpanel" class="tab-pane fade active in" id="tab_tipo_estudioFE" aria-labelledby="profile-tab">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<label>Estudio de Inversión</label>
								<input type="text" class="form-control" name="txtEstudioInv" value="<?= $nombreProyectoInver->nombre_est_inv?>" id="txtEstudioInv" autocomplete="off" disabled="disabled">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Sector</label>
								<input type="text" class="form-control" name="txtSector"  value="<?= $SectorPliego->nombre_sector?>"  id="txtSector" autocomplete="off" disabled="disabled">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<label>Pliego</label>
								<input type="text" class="form-control" name="txtPliego" value="<?= $SectorPliego->pliego?>"  id="txtPliego" autocomplete="off" disabled="disabled">
							</div>
						</div>
						<hr>
						<table id="table-fePresupuestoFuente" class="table table-striped  table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td>FUENTE DE FINANCIAMIENTO</td>
									<td>CORRELATIVO META</td>
									<td>AÑO</td>
								</tr>
							</thead>
							<tbody>
								<?php foreach($listaFEPresupuestoFuente as $item ){ ?>
								<tr>
									<td>
										<?=$item->nombre_fuente_finan?>
									</td>
									<td>
										<?=$item->correlativo_meta?>
									</td>
									<td>
										<?=$item->anio_pres_fuen?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="clearfix"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div role="tabpanel" class="tab-pane fade" id="tab_nivelInversio" aria-labelledby="profile-tab">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">
					<h5>DATOS GENERALES</h5>
					<hr>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label>Estudio de Inversión</label>
							<input type="text" class="form-control" name="txtEstudioInv" value="<?= $nombreProyectoInver->nombre_est_inv?>" id="txtEstudioInv" autocomplete="off" disabled="disabled">
						</div>
					</div>
					<hr>
					<div class="row">
						<div class="col-xs-3">
							<ul class="nav nav-tabs tabs-left">
								<?php foreach($listaFEDetallePresupuestoT as $value ){ ?>				
								<li id="pestaniaTabPaneDetalleGasto<?=$value->id_tipo_gasto?>">
									<a href="#tabPaneDetalleGasto<?=$value->id_tipo_gasto?>" data-toggle="tab"><?=$value->desc_tipo_gasto?></a>
								</li>
								<?php } ?>	
							</ul>
						</div>
						<br>
						<div class="col-xs-9" style="border-left: 1px solid #999999;">
							<div class="tab-content">
								<?php foreach($listaFEDetallePresupuestoT as $key => $value ){ ?>	
								<div class="tab-pane <?=($key==0 ? 'active' : '')?>" id="tabPaneDetalleGasto<?=$value->id_tipo_gasto?>">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<h5><?=$value->desc_tipo_gasto?></h5>
										</div>
									</div>
									<table id="tableDetalleGasto<?=$value->id_tipo_gasto?>" class="table table-striped " cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Descripción</th>
												<th>Unidad</th>
												<th>C.</th>
												<th>C. U.</th>
												<th>Total</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($value->childFEDetalleGasto as $item){ ?>
											<tr>
												<td><input type="hidden"  value="<?=$item->desc_detalle_gasto?>"><?=$item->desc_detalle_gasto?></td>
												<td><input type="hidden"  value="<?=$item->id_unidad?>"><?=$item->descripcionUnidadMedida?></td>
												<td><input type="hidden"  value="<?=$item->cantidad_detalle_gasto?>"><?=$item->cantidad_detalle_gasto?></td>
												<td><input type="hidden"  value="<?=$item->costo_uni_detalle_gasto?>"><?=$item->costo_uni_detalle_gasto?></td>
												<td><input type="hidden"  value="<?=$item->sub_total_detalle_gasto?>"><?=$item->sub_total_detalle_gasto?></td>

											</tr>
											<?php } ?>
										</tbody>
									</table>
								</div>
								<?php } ?>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





