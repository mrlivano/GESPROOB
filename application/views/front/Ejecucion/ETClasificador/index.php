<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Clasificador</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Clasificador"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b>Clasificador </b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Clasificador" aria-labelledby="home-tab">
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar Nuevo Clasificador', null, base_url+'index.php/ET_Clasificador/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
												<div class="x_title">                                                              
										
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<table id="table-Clasificador"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
														<thead>
															<tr>
																<td>Número</td>
																<td>Descripción</td>
																<td>Detalle</td>
																<td class="col-md-1 col-md-1 col-xs-12">
																</td>
															</tr>
														</thead>
														<tbody>
														<?php foreach($ETClasificador as $item ){ ?>
															<tr>
																<td>
																<?=$item->num_clasificador?>
																</td>
																<td>
																<?=$item->desc_clasificador?>
																</td>
																<td>
																<?=$item->detalle_clasificador?>
																</td>
																<td>
																	<button title='Edición de clasificador' class='btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Edición de presupuesto para formulación y evaluación', { id_clasificador : '<?=$item->id_clasificador?>' }, base_url+'index.php/ET_Clasificador/editar', 'GET', null, null, false, true);"><i class='ace-icon fa fa-pencil bigger-120'></i></button>
																	<button onclick="Eliminar(<?=$item->id_clasificador?>);" title='Eliminar Clasificador'  class='eliminarClasificador btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button>
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
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>

<script>
	$(document).ready(function()
	{
		$('#table-Clasificador').DataTable(
		{
			"language":idioma_espanol
		});
	});
	function Eliminar(id_clasificador)
		{
			swal({
				title: "Esta seguro que desea eliminar el clasificador?",
				text: "",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				cancelButtonText:"CERRAR" ,
				confirmButtonText: "SI,ELIMINAR",
				closeOnConfirm: false
			},
			function()
			{
				$.ajax({
                        url:base_url+"index.php/ET_Clasificador/eliminar",
                        type:"POST",
                        data:{id_clasificador:id_clasificador},
                        success:function(respuesta)
                        {
							
							swal("ELIMINADO!", "Se elimino correctamente el clasificador.", "success");
							window.location.href='<?=base_url();?>index.php/ET_Clasificador/index/';
							renderLoading();
                        }
                    });
			});
  
		}
</script>