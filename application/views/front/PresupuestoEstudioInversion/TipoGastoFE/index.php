<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>TIPO GASTO</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Tipo Gasto</b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<!-- /Contenido del sector -->
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<!-- /tabla de sector desde el row -->
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar tipo de gasto', null, base_url+'index.php/Tipo_Gasto_FE/insertar', 'GET', null, null, false, true);">
													NUEVO
												</button>
													<div class="x_title">                                                              
											
														<div class="clearfix"></div>
													</div>
													<div class="x_content">
														<table id="table-Tipo_Gasto_FE"  class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>TIPO DE GASTO</td>
																	<td class="col-md-1 col-md-1 col-xs-12"></td>
																</tr>
															</thead>
															<tbody>
																<?php foreach($ListaTipoGastoFE as $item ){ ?>
																	  <tr>
																		<td>
																			<?=$item->desc_tipo_gasto?>
																	    </td>
																		<td>
																		  	<button type='button' class='editar btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Modificar tipo  de gasto',{id:'<?=$item->id_tipo_gasto?>'}, base_url+'index.php/Tipo_Gasto_FE/editar', 'POST', null, null, false, true)"><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#' onclick="eliminar('<?=$item->id_tipo_gasto?>');"><i class='fa fa-trash-o'></i></button>
																		</td>
																	  </tr>
															     <?php } ?>
															</tbody>
														</table>
													</div>
											</div>
										</div>
									</div>
										<!-- / fin tabla de sector desde el row -->
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
<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>swal('','<?=$sessionTempCorrecto?>', "success");</script>
<?php }

if($sessionTempError){ ?>
	<script>swal('','<?=$sessionTempError?>', "error");</script>
<?php } ?>
<script>
	$(document).ready(function()
	{
		$('#table-Tipo_Gasto_FE').DataTable(
		{
			"language":idioma_espanol
		});
	});
</script>
<script>
	function eliminar(codigo)
	{
		swal(
        {
            title: "Confirmación",
            text: "Realmente desea realizar esta operación",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cerrar",
            closeOnConfirm: false,
        },
        function()
        {
            $.ajax({
                url:base_url+"index.php/Tipo_Gasto_FE/eliminar",
                type:"POST",
                data:{id_codigo:codigo},
                success:function(respuesta)
                {
                    if(respuesta==1)
                    {
                        swal("Elimando.","Tipo Gasto", "success");
                        window.location.href = base_url+'index.php/Tipo_Gasto_FE/';
                    }
                    else
                    {
                        swal("Error.","Tipo Gasto", "error");
                    }
                },
                error:function()
                {
                	swal('Error', 'Usted no tiene permisos para realizar esta acción','error')
                }
            });





        });
	}
</script>