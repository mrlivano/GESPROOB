<style>
	.modal-dialog
	{
		width: 90%;
		margin: 0;
		margin-left: 5%;
		padding: 0;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>

<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_content">
						<div class="row">
							<div class="table-responsive">	
								<table id="table-DatoGen" style="font-size:12px;" cellspacing="0" width="100%">
									<?php if(count($datoExpediente) != 0 ){ ?>
									<tr>
										<th style="width:14%;"><b>Año</b></th>
										<td style="width:86%;"><b>: <?=@$datoExpediente[0]->ano_eje?></td>
									</tr>
									<tr>
										<th><b>Entidad</b></th>
										<td><b>: <?=@$datoExpediente[0]->estado?></td>
									</tr>
									<tr>
										<th><b>Expediente</b></th>
										<td><b>: <?=(int) @$datoExpediente[0]->expediente?></td>
									</tr>
									<tr>
										<th><b>Tipo de operación</b></th>
										<td><b>: <?=@$datoExpediente[0]->operacion?></td>
									</tr>
									<tr>
										<th><b>Modalidad de compra</b></th>
										<td><b>: <?=@$datoExpediente[0]->modalidad?></td>
									</tr>
									<tr>
										<th><b>Tipo de proceso</b></th>
										<td><b>: <?=@$datoExpediente[0]->proceso?></td>
									</tr>
									<?php } ?>
								</table>
							</div>
						</div>
						<br>
						<div class="row">
							<?php if($actualizador) { ?>
							<button id="btnActualizarExpediente" class="btn btn-success btn-sm" onclick="siafExpediente('<?php  echo $anio_up ?>', '<?php  echo $exp_up ?>', '000747')">Actualizar estados de expediente</button>
							<?php } ?>
						</div>
						<br>
						<div class="row">
							<div class="table-responsive">								
								<table id="table-DetalleOrdenExpSiaf"  class="table table-striped table-bordered" cellspacing="0" style="font-size:12px;text-align:center;" width="100%">
									<thead style="font-weight:bold;font-size:13px;">
										<tr>
											<td>Ciclo</td>
											<td>Fase</td>
											<td>Secuencia</td>
											<td>Correlativo</td>
											<td>Doc</td>
											<td>Número</td>
											<td>Fecha</td>
											<td>Moneda</td>
											<td>Monto</td>
										</tr>
									</thead>
									<tbody>
										<?php foreach($expedienteSecuencia as $item )
										{ ?>
											<tr>
												<td>
													<?=$item->ciclo?>
												</td>
												<td>
													<span class="badge"><?=$item->fase?></span>																
												</td>
												<td>
													<?=(int)$item->secuencia?>
												</td>
												<td>
													<?=(int)$item->correlativo?>
												</td>
												<td>
													<?=$item->cod_doc?>
												</td>
												<td>
													<?=$item->num_doc?>
												</td>
												<td>
													<?=($item->fecha_doc!='' ? date('d/m/Y',strtotime($item->fecha_doc)) : '')?>	
												</td>
												<td>
													<?=$item->moneda?>
												</td>
												<td style="text-align:right;">												
													<?=number_format($item->monto, 2, '.', ',')?>
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
	function siafExpediente(anio_expediente, expediente, unidad_ejecutora) {
    	// var anio_expediente=$("#txtAnioExpediente").val();
    	// var expediente=$("#txtExpediente").val();
    	// var unidad_ejecutora=$("#txtUnidadEjecutora").val();

		var start = +new Date();
		var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';
		//alert(ups_url + "/Expediente/estado_expediente/" + anio_expediente + "/" + expediente +"/" +unidad_ejecutora);
    	$.ajax({
				url: ups_url + "/Expediente/estado_expediente/" + anio_expediente + "/" + expediente +"/" +unidad_ejecutora,
				type: "POST",
				cache: false,
		        contentType:false,
		        processData:false,
				beforeSend: function(request) {
					//request.setRequestHeader("Authorization", "Negotiate");
				    renderLoading();
				},
				success:function(data)
				{
					$('#divModalCargaAjax').hide();
					datos=JSON.parse(data);
					var rtt = +new Date() - start;

					if(datos.actualizo)
					{
						swal(
						  'Operacion Completada',
						  datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
						  'success'
						);
					}
					else
					{
						swal(
						  'No se pudo completar la Operacion',
						  datos.mensaje + ' Tiempo: ' + (rtt/1000) +'s',
						  'warning'
						);
					}
					$('#detalleExpSiaf').modal('hide');
					mostrarsiafactualizado(anio_expediente, expediente, unidad_ejecutora);
				},
				error: function (xhr, textStatus, errorMessage) {
			        $('#divModalCargaAjax').hide();
			        swal(
						  'ERROR!',
						  'No se pudo conectar con el servidor de Importacion, error 0x5642418',
						  'error'
						);
			    }
			});
    }

	function  mostrarsiafactualizado(anio, expsiaf, sec_ejec)
	{
		paginaAjaxDialogo('detalleExpSiaf', 'Consulta de Expediente Administrativo',{anio:anio,expsiaf:expsiaf,sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/detalleOrdenExpSiaf', 'GET', null, null, false, true);
	}
</script>