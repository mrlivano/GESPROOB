<div class="right_col" role="main">
	<div class="">
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>PIP PRIORIZADOS</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<div class="col-md-3 col-xs-12">
								<div class="form-group">
					                <div class="input-group"><br/>
										<label class="control-label">Buscar PIP por Año Priorizado</label>
										<select  id="PipPriorizadoAnio" name="PipPriorizadoAnio" class="form-control col-md-2 col-xs-2" class="selectpicker" data-width="75%" data-live-search="true"></select>
					                </div>
			            		</div>
			            	</div>
			            	<div class="col-md-9 col-xs-12">
				            	<div class="form-group" style="padding-top: 14px;">
				                	<label class="control-label" for="inputGroup">Reportes </label>
				                	<div class="input-group">
										<div class="pull-right tableTools-container ">&nbsp;&nbsp;
										</div>
				                	</div>
			            		</div>			            		
			            	</div>		            		
						</div>
						<div class="table-responsive">
							<table id="table-pippriorizadas" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td style="width:5%">Código</td>
										<td style="width:40%">Proyecto</td>
										<td style="width:5%">Prioridad</td>
										<td style="width:5%">Puntaje</td>
										<td style="width:15%">Función</td>
									</tr>
								</thead>
								<tbody>
								<?php $i=0; foreach($listaPipPriorizadasPorAño as $item ){  ?>
								  	<tr>
								    	<td>
											<?=$item->codigo_unico_pi?>
								    	</td>
								    	<td>
											<?=$item->nombre_pi?>
								    	</td>
								    	<td>
											<?php if($item->puntaje==null){ echo 'na'; }else{$i++; echo $i;} ?>
								    	</td>
								    	<td>
											<?=$item->puntaje?>
								    	</td>
								    	<td>
											<?=$item->nombre_funcion?>
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
		$('#PipPriorizadoAnio').selectpicker('refresh');
		anios();
		var myTable=$('#table-pippriorizadas').DataTable(
		{
			"language":idioma_espanol,
			"searching": true,
			"info":     true,
			"paging":   true,
			"order": [[ 3, "DESC" ]],
		});

		$("#PipPriorizadoAnio").change(function(){
			var anio=$("#PipPriorizadoAnio").val();
			window.location.href=base_url+"index.php/PuntajeCriterioPi/pipPriorizadas?anio="+anio;
		});

		$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span>Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span>PDF</span>",
						"className": "btn btn-white btn-primary btn-bold",
						"title":"Gobierno Regional de Apurímac"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span>Imprimir</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: 'PIP PRIORIZADOS'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );




	
	});

	function anios()
		{
			
			var aniosI=2015;

			var html;
			var itn=1;
			html +='<option value=""> Buscar Años </option>';
			for (var i=2015; i<=2050; i++) {
				
				html +='<option value="'+(parseInt(aniosI)+parseInt(itn))+'"> '+(parseInt(aniosI)+parseInt(itn))+' </option>';
				itn++;
			}
			var anio='<?= $anio;?>';
			$("#PipPriorizadoAnio").append(html);
			$('#PipPriorizadoAnio option[value='+anio+']').prop('selected', true);
			$('#PipPriorizadoAnio').selectpicker('refresh');


		}

	
</script>