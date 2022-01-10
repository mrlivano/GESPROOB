<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Cronograma Valorización</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Etapa"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b>Cronograma </b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Etapa" aria-labelledby="home-tab">
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar Nuevo Cronograma Valorizacion', null, base_url+'index.php/CronogramaValorizacion/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
												<div class="x_title">                                                              
										
													<div class="clearfix"></div>
												</div>
												<div class="x_content">
													<table id="table-CronogramaValorizacion"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
														<thead>
															<tr>
																<td>Descripción</td>
																<td class="col-md-1 col-md-1 col-xs-12"></td>
															</tr>
														</thead>
														<tbody>
														<?php foreach($CronogramaValorizaciones as $item ){ ?>
															<tr>
																<td>
																<?=$item->desc_cronograma?>
																</td>
																<td>
																	<button title='Edición de Cronograma de Valorización' class='btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Edición de Cronograma de Valorización', { id_valorizacion : '<?=$item->id_valorizacion?>' }, base_url+'index.php/CronogramaValorizacion/editar', 'GET', null, null, false, true);"><i class='ace-icon fa fa-pencil bigger-120'></i></button>
																	<button title='Eliminar presupuesto para formulación y evaluación' class='btn btn-danger btn-xs' onclick="EliminarValorizacion(<?=$item->id_valorizacion?>)"><i class="fa fa-trash-o"></i></button>
		
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
		$('#table-CronogramaValorizacion').DataTable(
		{
			"language":idioma_espanol
		});
	});

	function EliminarValorizacion(datavalorizacion) {

        //var id_dtavaloriza=datavalorizacion;
        swal({
                title: "Desea eliminar el Cronograma Valorización?",
                text: "",
                type: "warning",
                showCancelButton: true,
                cancelButtonText:"Cerrar" ,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "SI,Eliminar",
                closeOnConfirm: false
            },
            function(){
                $.ajax({
                    url:base_url+"index.php/CronogramaValorizacion/Eliminar",
                    type:"POST",
                    data:{id_cronogramavalorizacion:datavalorizacion},
                    success:function(respuesta){
                        //   alert(respuesta);
                        swal("Eliminado!", "Se elimino corectamente el Cronograma Valorización.", "success");
                        window.location.href='<?=base_url();?>index.php/CronogramaValorizacion/index/';
                        renderLoading();

                    }
                });
            });

    }
</script>