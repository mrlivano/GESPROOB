<div class="right_col" role="main">
	<div class="">
		<div class="">
			<div class="col-md-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2>PIP PRIORIZADO POR FUNCIÓN</h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="row">
							<input type="hidden" name="Aniao" id="Aniao" value="<?=$anioActual?>">
							<div class="col-md-2 col-xs-12">
								<div class="form-group">
					                <div class="input-group"><br/>
										<label class="control-label">AÑO</label>
										<select  id="comboanio" name="comboanio" class="form-control col-md-3 col-xs-12">
										</select>
					                </div>
			            		</div>
							</div>
							<div class="col-md-3 col-xs-12">
								<div class="form-group">
					                <div class="input-group"><br/>
										<label class="control-label">FUNCIÓN</label>
										<select  id="combofuncion" name="combofuncion" class="form-control col-md-3 col-xs-12">
											<option value="1"> Buscar Función</option>
												<?php foreach($PipFuncion as $item){ ?>
													<option value="<?=$item->id_funcion; ?>"  <?=($item->id_funcion==$id_funcion ? 'selected' : '')?>    ><?= $item->nombre_funcion;?></option>
												<?php } ?>
										</select>
					                </div>
			            		</div>
							</div>
							<div class="col-md-3 col-xs-12">
								<div class="form-group"></br>
					                <label class="control-label" for="inputGroup">REPORTES</label>
					                <div class="input-group">
										<div class="pull-left tableTools-container ">&nbsp;&nbsp;</div>
					                </div>
					            </div>
							</div>
						</div>
						<div class="table-responsive">
							<table id="table-pippriorizadasporfuncion" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
								<thead>
									<tr>
										<td style="width:5%">Código</td>
										<td style="width:50%">Proyecto</td>
										<td style="width:5%">Prioridad</td>
										<td style="width:5%">Puntaje</td>
										<td style="width:10%">Función</td>
									</tr>
								</thead>
								<tbody>
								<?php $i=0; foreach($listarPipPriorizadaPorCadaFuncion as $item ){  ?>
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
		anios();
		var valor=$("#Aniao").val();
		$("#comboanio option[value="+valor+"]").attr("selected", true);


		var myTable=$('#table-pippriorizadasporfuncion').DataTable(
		{
			"language":idioma_espanol,
            "searching": true,
             "info":     true,
            "paging":   true,
			"order": [[ 3, "DESC" ]],
		});


			$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span >Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span >PDF</span>",
						"className": "btn btn-white btn-primary btn-bold",
						"title":"UNIVERSIDAD NACIONAL INTERCULTURAL DE QUILLABAMBA"
					  },
					  {
						"extend": "print",
						"text": "<span>Imprimir</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: true,
						message: 'PIP Priorizados'
					  }
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );


		$('#combofuncion').change('click', function(e)
		{
			//alert('hola');
				var anioPriorizacion=$("#comboanio").val();
				var funcion=$("#combofuncion").val();
				window.location.href=base_url+"index.php/PuntajeCriterioPi/pipPriorizadasPorFuncion?funcion="+funcion+'&anioPriorizacion='+anioPriorizacion;
				anios();
		});
		$('#comboanio').change('click', function(e)
		{
				var anioPriorizacion=$("#comboanio").val();
				var funcion=$("#combofuncion").val();
				window.location.href=base_url+"index.php/PuntajeCriterioPi/pipPriorizadasPorFuncion?funcion="+funcion+'&anioPriorizacion='+anioPriorizacion;
				anios();
		});


	});
	function anios()
	{
		var aniosI=2016;
		var html;
		for (var i =0; i <=2100; i++) {
			html +='<option value="'+(parseInt(aniosI)+parseInt(i))+'">'+(parseInt(aniosI)+parseInt(i))+'</option>';
		}
		$("#comboanio").append(html);

	}

</script>
