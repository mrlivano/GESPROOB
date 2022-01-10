<div class="right_col" role="main">
	<div class="">
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>ESTABLECER PRIORIDAD</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-3 col-xs-12">
								<div class="form-group">
					                <div class="input-group"><br/>
										<label class="control-label">FUNCIÓN</label>
										<select  id="combofuncion" name="combofuncion" class="form-control col-md-2 col-xs-2">
											<?php foreach($listarFuncion as $item){ ?>
												<option value="<?=$item->id_funcion; ?>" <?=($item->id_funcion==$id_funcion ? 'selected' : '')?>><?= $item->nombre_funcion;?></option>
											<?php } ?>
										</select>
					                </div>
			            		</div>
							</div>
							<div class="form-group"></br>
				                <label class="control-label" for="inputGroup">Reportes </label>
				                <div class="input-group">
									<div class="pull-left tableTools-container ">&nbsp;&nbsp;</div>
				                </div>
				            </div>
						</div>
						<div class="table-responsive">
							<table id="table-pip" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td style="width:5%">Código</td>
										<td style="width:40%">Proyecto</td>
										<td style="width:15%">Función</td>
										<td style="width:5%">Opciones</td>
									</tr>
								</thead>
								<tbody>
								<?php $i=0; foreach($listaPipPriorizar as $item ){  ?>
								  	<tr>
								    	<td>
											<?=$item->codigo_unico_pi?>
								    	</td>
								    	<td>
											<?=$item->nombre_pi?>
								    	</td>
								    	<td>
											<?=$item->nombre_funcion?>
								    	</td>
								    	<td>
										<button type="button" class="btn btn-success btn-xs " onclick="paginaAjaxDialogo(null, 'Asignar Prioridad', {id_pi:<?=$item->id_pi?>,id_funcion:<?=$item->id_funcion?>}, base_url+'index.php/PuntajeCriterioPi/insertar', 'GET', null, null, false, true);"><span class="fa fa-bars"></span>
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
	<div class="clearfix"></div>
</div>
</div>
<script>
	$(document).ready(function()
	{

		var myTable=$('#table-pip').DataTable(
		{

			"language" : idioma_espanol,

		});

		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

		new $.fn.dataTable.Buttons( myTable, {
			buttons: [
			  {
				"extend": "excel",
				"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>Excel</span>",
				"className": "btn btn-white btn-primary btn-bold",
                  "exportOptions":  {
                      columns: [ 0, 1, 2 ]
                  }
			  },
			  {
				"extend": "pdf",
				"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span>PDF</span>",
				"className": "btn btn-white btn-primary btn-bold",
                  "exportOptions":  {
                      columns: [ 0, 1, 2]
                  },
				"pageSize": 'A4',
				"title":"Gobierno Regional de Apurímac"
			  },
			  {
				"extend": "print",
				"text": "<i class='fa fa-print bigger-110 grey'></i> <span>Imprimir</span>",
				"className": "btn btn-white btn-primary btn-bold",
                  "exportOptions":  {
                      columns: [ 0, 1, 2 ]
                  },
				autoPrint: true,
				message: 'PIP Priodidad',
			  }
			]
		} );
		myTable.buttons().container().appendTo( $('.tableTools-container') );
		$('#combofuncion').change('click', function(e)
		{
			//alert('hola');
				var funcion=$("#combofuncion").val();
				window.location.href=base_url+"index.php/PuntajeCriterioPi/index?id="+funcion;
		});

	});

	function ReporteCriteriosPorPip()
	{
		var dirurl=base_url+"index.php/PuntajeCriterioPi/reporteCriteriosPorCadaPi/"+id_funcion+'.'+anio_criterio_gen;
		        ventana=window.open(dirurl, 'Nombre de la ventana', 'width=1400,height=800');
	}
</script>
