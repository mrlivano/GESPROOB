<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Etapa de ejecución</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Etapa"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b>Etapa </b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Etapa" aria-labelledby="home-tab">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar Nuevo Etapa de Ejecucion', null, base_url+'index.php/ET_Etapa_Ejecucion/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
												<div class="x_title">

													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<table id="table-EtapaEjecucion"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
														<thead>
															<tr>
																<td>Descripcion</td>
																<td class="col-md-1 col-md-1 col-xs-12"></td>
															</tr>
														</thead>
														<tbody>
															<?php foreach($ETEtapaEjecucion as $item ){ ?>
																<tr>
																	<td>
																	<?=$item->desc_etapa_et?>
																	</td>
																	<td>
																		<button title='Edición Etapa Ejecución' class='btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Edición Etapa Ejecución', { id_etapa_et  : '<?=$item->id_etapa_et ?>' }, base_url+'index.php/ET_Etapa_Ejecucion/editar', 'GET', null, null, false, true);"><i class='ace-icon fa fa-pencil bigger-120'></i></button>
																		<button type='button' class='eliminar btn btn-danger btn-xs' onclick="Eliminar(<?= $item->id_etapa_et ?>)"><i class='fa fa-trash-o'></i></button>
																	</td>
																</tr>
															<?php } ?>
														</tbody>
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
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>
	$(document).ready(function()
	{
		$('#table-EtapaEjecucion').DataTable(
		{
			"language":idioma_espanol
		});
	});

	function Eliminar(id_etapa_et)
	{
		swal({
				title: "Esta seguro que desea eliminar?",
				text: "",
				type: "warning",
				showCancelButton: true,
				cancelButtonText:"CERRAR" ,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "SI,Eliminar",
				closeOnConfirm: false
			},
			function()
			{
				$.ajax({
												url:base_url+"index.php/ET_Etapa_Ejecucion/eliminar",
												type:"POST",
												data:{id_etapa_et:id_etapa_et},
												success:function(respuesta)
												{

							swal("ELIMINADO!", "Se elimino correctamente.", "success");
							window.location.href='<?=base_url();?>index.php/ET_Etapa_Ejecucion/index';
							renderLoading();
												}
										});
			});
	}

</script>
