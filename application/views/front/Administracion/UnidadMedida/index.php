<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>UNIDAD  DE MEDIDA</b></h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab_etapasFE" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <b>Etapas</b></a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="#tab_etapasFE" aria-labelledby="home-tab">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<div class="x_panel">
												<button type="button" class="btn btn-primary " onclick="paginaAjaxDialogo(null, 'Registrar Unidad de Medida', null, base_url+'index.php/Unidad_Medida/insertar', 'GET', null, null, false, true)" >
													<span class="fa fa-plus-circle"></span>
													Nuevo
												</button>
											</button>
											<div class="x_title">
												<div class="clearfix"></div>
											</div>
											<div class="x_content">
												<table id="table-UnidadaMedida" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
													<thead>
														<tr>
															<td>DESCRIPCIÓN</td>
															<td>ABREVIATURA</td>
															<td class="col-md-1 col-md-1 col-xs-12">ACCIONES</td>
														</tr>
													</thead>
													<?php foreach($listaUnidadMedida as $item){ ?>
														  <tr>
															  <td>
															  	<?= $item->descripcion;?>
															  </td>
																<td>
																	<?= $item->abreviatura; ?>
																</td>
															  <td>
															  	<button type='button' class='editar btn btn-primary btn-xs' onclick="paginaAjaxDialogo(null, 'Modificar Unidad de Medida', { id: '<?=$item->id_unidad?>' }, base_url+'index.php/Unidad_Medida/editar', 'POST', null, null, false, true)" ><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' onclick='eliminar(<?= $item->id_unidad;?>)' data-target='#'><i class='fa fa-trash-o'></i></button>
															  </td>
														  </tr>
												     <?php } ?>
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
		$('#table-UnidadaMedida').DataTable(
		{
			"language":idioma_espanol
		});
	});


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
                    url:base_url+"index.php/Unidad_Medida/eliminar",
                    type:"POST",
                    data:{id_codigo:codigo},
                    success:function(respuesta){
                        //var registros=jQuery.parseJSON(respuesta);
                        if(respuesta==1){
                            swal("Elimando.","Unidad de Medida", "success");
                            //$('#table-Tipo_Gasto_FE').dataTable()._fnAjaxUpdate();
                            window.location.href = base_url+'index.php/Unidad_Medida/';
                        }
                        else{
                            swal("Error.","Unidad de Medida", "error");
                            //$('#table-Tipo_Gasto_FE').dataTable()._fnAjaxUpdate();
                        }
                    },
                    error:function()
                    {
                    	swal("Error","Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                    }
                });


            });
    }

</script>
