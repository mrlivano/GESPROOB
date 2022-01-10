<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>PRE-LIQUIDACIÓN</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_elaboracion" aria-labelledby="home-tab">
								<br>
								<button onclick="BuscarProyectocodigo();" class="btn btn-primary" style="margin-top: 5px;margin-bottom: 15px;"><span class="fa fa-plus"></span>  NUEVO</button>
								<div class="table-responsive">
									<table id="table-ExpedienteTecnico" style="text-align: center;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<td class="col-md-1 col-xs-12">Detalle</td>
												<td class="col-md-2 col-xs-12">Unidad Ejecutora</td>
												<td class="col-md-5 col-xs-12">Nombre del proyecto</td>
												<td class="col-md-1 col-xs-12">Modalidad Ejecutora</td>
												<td class="col-md-2 col-xs-12">Fuente Financiamiento</td>
											</tr>
										</thead>
										<tbody>
										<?php foreach($listaPreliquidacion as $item){ ?>
										  	<tr>
										  		<td>
										  			<a style="width: 100%;" href="<?= site_url('Preliquidacion/verdetalle?id_liq_proyecto='.$item->id_liq_proyecto.'&codigo_unico='.$item->codigo_unico);?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span><?= $item->codigo_unico?>-<?= $item->id_liq_proyecto?></a>
										  		</td>
												<td>
													<?= $item->unidad_ejec?>
												</td>
												<td>
													<?= $item->proyecto?>
												</td>
												<td>
													<?= $item->unidad_ejec?>
												</td>
												<td>
													<?= $item->mod_ejec ?>
												</td>
										  	</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_aprobacion" aria-labelledby="home-tab">
								<br><br>
								<div class="table-responsive">
									<table id="table-ExpedientesAprobados" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>Detalle</th>
												<th>Unidad Ejecutora</th>
												<th>Proyecto</th>
												<th>Costo de Inversion</th>
												<th>Fecha de Aprobación</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
										<?php foreach($listaExpedientesAprobados as $item){ ?>
										  	<tr>
										  		<td style="width: 10%;">
										  			<a style="width: 100%;" href="<?= site_url('Expediente_Tecnico/verdetalle?id_et='.$item->id_et);?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi?></a>

										  		</td>
												<td style="width: 15%;">
													<?= $item->nombre_ue?>
												</td>
												<td style="width: 47%;">
													<?= $item->nombre_pi?>
												</td>
												<td style="width: 13%;">
													S/. <?=a_number_format($item->costo_total_inv_et,2,'.',",",3)?>
												</td>
												<td style="width: 10%;">
													<?=date('d/m/Y',strtotime($item->fecha_aprobacion)) ?>
												</td>
												<td style="width: 5%;">
													<a href='<?php echo base_url()."uploads/ResolucioExpediente/".$item->id_et.".".$item->url_doc_aprobacion_et ;?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
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
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>
	$(document).ready(function()
	{
		swal('','<?=$sessionTempCorrecto?>', "success");
	});
	</script>
<?php }

if($sessionTempError){ ?>
	<script>
	$(document).ready(function()
	{
	swal('','<?=$sessionTempError?>', "error");
	});
	</script>
<?php } ?>
<script>

$(document).ready(function()
{
	$('#table-ExpedienteTecnico').DataTable(
	{
		"language":idioma_espanol
	});

	$('#table-ExpedientesAprobados').DataTable(
	{
		"language":idioma_espanol
	});
});

function BuscarProyectocodigo()
{
	swal({
		title: "Buscar",
		text: "Proyecto: Ingrese Código Único del proyecto",
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		cancelButtonText:"CERRAR" ,
		confirmButtonText: "BUSCAR",
		inputPlaceholder: "Ingrese Codigo Unico",
	}, function (inputValue) 
	{
		if (inputValue === "")
		{
			swal.showInputError("Ingresar codigo!");
			return false
		}
		else
		{
			var buscar="true";
			paginaAjaxDialogo(null, 'Registrar Preliquidación',{CodigoUnico:inputValue,buscar:buscar}, base_url+'index.php/Preliquidacion/insertar', 'GET', null, null, false, true);
			swal("Correcto!", "Se Encontro el Proyecto: " + inputValue, "success");
		}

	});
}
</script>
