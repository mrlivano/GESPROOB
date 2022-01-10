<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>EJECUCIÓN</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="table-Ejecucion" style="text-align: center;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td class="col-md-1 col-xs-12">Detalle</td>
									<td class="col-md-2 col-xs-12">Unidad Ejecutora</td>
									<td class="col-md-5 col-xs-12">Nombre del proyecto</td>
									<td class="col-md-1 col-xs-12">Costo Total del proyecto Preinversion</td>
									<td class="col-md-1 col-xs-12">Costo Total del proyecto Inversion</td>
									<td class="col-md-1 col-xs-12">Tiempo Ejecucion</td>
									<td class="col-md-1 col-xs-12">Numero Beneficiarios</td>
								</tr>
							</thead>
							<tbody>
							<?php foreach($listaEjecucion as $item){ ?>
							  	<tr>
							  		<td>
							  			<a style="width: 100%;" href="<?= site_url('Expediente_Tecnico/verdetalle?id_et='.$item->id_et);?>" role="button" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi?></a>
							  		</td>
									<td>
										<?= $item->nombre_ue?>
									</td>
									<td>
										<?= $item->nombre_pi?>
									</td>
									<td>
										S/. <?=a_number_format($item->costo_total_preinv_et,2,'.',",",3)?>
									</td>
									<td>
										S/. <?=a_number_format($item->costo_total_inv_et,2,'.',",",3)?>
									</td>
									<td>
										<?= $item->tiempo_ejecucion_pi_et?>
									</td>
									<td>
										<?=a_number_format($item->num_beneficiarios,0,'.',",",3) ?>
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
	$('#table-Ejecucion').DataTable(
	{
		"language":idioma_espanol
	});
});

</script>
