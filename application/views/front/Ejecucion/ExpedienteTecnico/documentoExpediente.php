<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>DOCUMENTO DEL EXPEDIENTE TÉCNICO</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div>
								<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="3" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=$expedienteTecnico->nombre_pi?></textarea>
							</div>
						</div>
					</div>
							<div id="myTabContent" class="tab-content">
			
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											
													<div class="x_content">
														<table  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>Documento</td>
																</tr>
															</thead>
															<tbody>								
																	<tr>
																		<td> Resolución: <a style="font-size: 18px;"  target="_blank" href="<?= base_url();?>uploads/ResolucioExpediente/<?= $id_et?>.<?= $ListarDocumentoExpediente->url_doc_aprobacion_et?>"><i class="fa fa-file-text"></i> </a></td>
																	</tr>
															</tbody>
														</table>
													
											</div>
										</div>
									</div>
										<!-- / fin tabla de sector desde el row -->
							
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
		$('#table-ResponsableExpediente').DataTable(
		{
			"language":idioma_espanol,
			 "paging":   false,
			 "searching": false,
		});
	});

</script>