<style type="text/css">
	.search-form .form-group {
  float: right !important;
  transition: all 0.35s, border-radius 0s;
  width: 32px;
  height: 32px;
  background-color: #fff;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
  border-radius: 25px;
  border: 1px solid #ccc;
}
.search-form .form-group input.form-control {
  padding-right: 20px;
  border: 0 none;
  background: transparent;
  box-shadow: none;
  display:block;
}
.search-form .form-group input.form-control::-webkit-input-placeholder {
  display: none;
}
.search-form .form-group input.form-control:-moz-placeholder {
  /* Firefox 18- */
  display: none;
}
.search-form .form-group input.form-control::-moz-placeholder {
  /* Firefox 19+ */
  display: none;
}
.search-form .form-group input.form-control:-ms-input-placeholder {
  display: none;
}
.search-form .form-group:hover,
.search-form .form-group.hover {
  width: 100%;
  border-radius: 4px 25px 25px 4px;
}
.search-form .form-group span.form-control-feedback {
  position: absolute;
  top: -1px;
  right: -2px;
  z-index: 2;
  display: block;
  width: 34px;
  height: 34px;
  line-height: 34px;
  text-align: center;
  color: #3596e0;
  left: initial;
  font-size: 14px;
}

</style>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>CRITERIOS DE PRIORIZACIÓN</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<div class="row" style="display: none ;">
							<div class="col-md-3 col-xs-12"">
								<div class="form-group">
					                <label class="control-label" for="inputGroup">Buscar Criterio Por Años </label>
					                <div class="input-group">
										<input type="text" class="form-control" placeholder="Ingrese Año" id="textAnio" name="textAnio" value="<?= $anio;?>" data-inputmask="'mask' : '9999'">
					                    <span class="input-group-addon">
					                        <i class="fa fa-search"></i>
					                    </span>
					                </div>
			            		</div>
							</div>

							<div class="form-group">
				                <label class="control-label" for="inputGroup">Reportes </label>
				                <div class="input-group">
									<div class="pull-right tableTools-container ">&nbsp;&nbsp;</div>
				                </div>
			            	</div>
						</div>
						<div class="table-responsive">
							<table id="table-Presupuesto" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td style="width: 1%">Codigo</td>
										<td>Función</td>

										<td style="width: 1%">Opciones</td>
									</tr>
								</thead>
								<tbody>
										<?php foreach($listaCriterioFuncion as $item ){ ?>
								  	<tr>

										<td>
											<?=$item->codigo_funcion?>
								    	</td>
										<td>
											<?=$item->nombre_funcion?>
								    	</td>

								    	<td style="text-align: left;">

											<button type="button" class="btn btn-info btn-xs " data-placement="top" data-toggle="tooltip" data-original-title="Agregar criterios Generales" onclick="paginaAjaxDialogo(null, 'Registro Criterio Generales', { id_funcion:'<?=$item->id_funcion?>', nombre_funcion:'<?=$item->nombre_funcion?>',anio:'<?= $anio;?>' }, base_url+'index.php/PmiCriterioG/insertar', 'GET', null, null, false, true);"><span class="fa fa-th-list"></span>
											</button>
											<button type="button" class="btn btn-success btn-xs " data-placement="top" data-toggle="tooltip" data-original-title="Reporte De Criterios Generales y Especificos" onclick="ReporteCriteriosGenerales(<?=$item->id_funcion?>,<?= $anio;?>);"><i class="fa fa-file-pdf-o"></i>
											</button>
								    	</td>
								  </tr>
								<?php } ?>
								</tbody>

							</table>

						</div>
						<!--<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active"><a href="#tab_etapasFE" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"> <span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Criterio Funcion</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="#tab_etapasFE" aria-labelledby="home-tab">
									<div class="row">
										<div class="col-md-12 col-xs-12">
											<div class="x_panel">
											<div class="row">
												<div class="col-md-3 col-xs-3"  style="margin-left: 300px;">
													<div class="form-group">
										                <label class="control-label" for="inputGroup">Buscar Criterio Por Años </label>
										                <div class="input-group">
															<input type="text" class="form-control" placeholder="Ingrese Año" id="textAnio" name="textAnio" value="<?= $anio;?>" data-inputmask="'mask' : '9999'">
										                    <span class="input-group-addon">
										                        <i class="fa fa-search"></i>
										                    </span>
										                </div>
								            		</div>
												</div>

												<div class="form-group">
										                <label class="control-label" for="inputGroup">Reportes </label>
										                <div class="input-group">
														<div class="pull-left tableTools-container ">&nbsp;&nbsp;</div>

										                </div>
								            	</div>
											</div>
											<div class="x_content">
												<table id="table-Presupuesto" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
													<thead>
														<tr>
															<td style="width: 1%">Codigo</td>
															<td>Función</td>

															<td style="width: 1%">Opciones</td>
														</tr>
													</thead>
													<tbody>
															<?php foreach($listaCriterioFuncion as $item ){ ?>
													  	<tr>

															<td>
																<?=$item->codigo_funcion?>
													    	</td>
															<td>
																<?=$item->nombre_funcion?>
													    	</td>

													    	<td style="text-align: left;">

																<button type="button" class="btn btn-info btn-xs " data-placement="top" data-toggle="tooltip" data-original-title="Agregar criterios Generales" onclick="paginaAjaxDialogo(null, 'Registro Criterio Generales', { id_funcion:'<?=$item->id_funcion?>', nombre_funcion:'<?=$item->nombre_funcion?>',anio:'<?= $anio;?>' }, base_url+'index.php/PmiCriterioG/insertar', 'GET', null, null, false, true);"><span class="fa fa-th-list"></span>
																</button>
																<button type="button" class="btn btn-success btn-xs " data-placement="top" data-toggle="tooltip" data-original-title="Reporte De Criterios Generales y Especificos" onclick="ReporteCriteriosGenerales(<?=$item->id_funcion?>,<?= $anio;?>);"><i class="fa fa-file-pdf-o"></i>
																</button>
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
					</div>-->
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
		var myTable=$('#table-Presupuesto').DataTable(
		{

			"language" : idioma_espanol,


		});

		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

		new $.fn.dataTable.Buttons( myTable, {
			buttons: [
			  {
				"extend": "excel",
				"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='' data-placement='top' data-toggle='tooltip' data-original-title='Exportar a Excel'>Excel</span>",
				"className": "btn btn-white btn-primary btn-bold"
			  },
			  {
				"extend": "pdf",
				"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='' data-placement='top' data-toggle='tooltip' data-original-title='Exportar a PDF'>PDF</span>",
				"className": "btn btn-white btn-primary btn-bold",
				"pageSize": 'LEGAL',
				orientation: 'landscape',
			  },
			  {
				"extend": "print",
				"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='' data-placement='top' data-toggle='tooltip' data-original-title='Imprimir'>Imprimir</span>",
				"className": "btn btn-white btn-primary btn-bold",
				autoPrint: false,
				message: 'This print was produced using the Print button for DataTables'
			  }
			]
		} );
		myTable.buttons().container().appendTo( $('.tableTools-container') );

		$('#textAnio').bind('keyup', function(e)
		{
			if(e.keyCode==13)
			{
				var anio=$("#textAnio").val();
				window.location.href=base_url+"index.php/PmiCriterioG/criterioFuncion/"+anio;
			}
		});




	});

	function ReporteCriteriosGenerales(id_funcion,anio_criterio_gen)
		{

				/*var parametros = {
                "anio_criterio_gen" : anio_criterio_gen,
                "id_funcion" : id_funcion
        		};
				$.ajax({
		                data:  parametros,
		                url:   base_url+"index.php/PmiCriterioG/ReporteCriteriosG/",
		                type:  'post',
		                beforeSend: function () {
		                        //$("#resultado").html("Procesando, espere por favor...");
		                },
		                success:  function (response) {
		                       //alert(response);
		                }
		        });*/
		    	var urll=base_url+"index.php/PmiCriterioG/ReporteCriteriosG?anio="+anio_criterio_gen+'&id_funcion='+id_funcion;
		        ventana=window.open(urll, 'Nombre de la ventana', 'width=1400,height=800');

		}

</script>
