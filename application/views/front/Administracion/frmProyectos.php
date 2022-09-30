<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>PROYECTOS</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="table-responsive">
						<table id="table-Ejecucion" style="text-align: center;" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
							<thead>
								<tr>
									<td class="col-md-1 col-xs-2">Codigo</td>
									<td class="col-md-5 col-xs-10">Nombre del proyecto</td>
								</tr>
							</thead>
							<tbody>
							<?php foreach($listaEjecucion as $item){ ?>
							  	<tr>
							  		<td>
							  			<a style="width: 100%;" onclick="paginaAjaxDialogo(null, 'Cerrar Proyecto', { idExpedienteTecnico : <?=$item->id_et?> }, base_url+'index.php/Proyectos/fechas', 'GET', null, null, false, true); return false;" class="btn btn-success btn-sm"><span class="fa fa-eye"></span> <?= $item->codigo_unico_pi?></a>
							  		</td>
									
									<td>
										<?= $item->nombre_pi?>
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
