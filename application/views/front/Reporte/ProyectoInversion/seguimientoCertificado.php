<style>
	.table-consolidadoAvance{
		width: 100%;
	}
	.alineacionDerecha
	{
		text-align: right;
	}
	.tablaRelevante td
	{
		background-color:#f0f4f5;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h5><b>REPORTE GENERAL DE AVANCE FISICO Y FINANCIERO</b></h5>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">

<?php if( $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9 ) { ?>
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
					    	<label>Año Meta</label>
							<input type="text" id="BuscarPipAnio" name="BuscarPipAnio" value="<?=$anio?>" placeholder="Año" class="form-control">
						</div>
					</div>
					<div class="col-md-4 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Unidad Ejecutora</label>
							<select id="opcion_ue" class="form-control">
								<?php foreach ($lista_ue as $row) {
									if ($row->codigo_ue=='747' || $row->codigo_ue=='748' || $row->codigo_ue=='1546' || $row->codigo_ue=='1359' ) { ?>
										<option value="<?=trim($row->sec_ejec)?>" <?php echo (trim($unidadEjecutora)==trim($row->sec_ejec) ? 'selected' : ''); ?>><?=$row->unidad_ejec?></option>
								<?php } } ?>
							</select>
						</div>						
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<div class="form-group">
							<label>Tipo Proyecto</label>
							<select id="opcion_tipo_proyecto" class="form-control" required="">
									<?php foreach ($lista_tipos as $row) {?>
										<option value="<?=trim($row->tipo_proyecto)?>" <?php if (trim($row->tipo_proyecto)==$tipoProyecto) {
											echo 'selected="selected"';
										} ?> > <?php echo (empty(trim($row->tipo_proyecto)) ? 'TODOS' : $row->tipo_proyecto);?></option>
									<?php } ?>
							</select>
						</div>						
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<label>.</label>
					    <span class="input-group-btn">
							<button id="AnioPip" class="btn btn-default " type="button"><span class="glyphicon glyphicon-search"> Buscar</span></button>									
						</span>
					</div>					
				</div>
													
				<div class="row">
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-success btn-xs" type="button" onclick="ImportarGasto();">Gasto </button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-info btn-xs" type="button" onclick="ImportarExpedienteMeta();">Meta Expediente </button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12">
						<button style="width: 100%;" class="btn btn-warning btn-xs" type="button" onclick="ImportarExpedientes();">Expedientes</button>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<a href="javascript:siafActualizadorCertificado()">
							<button style="width: 100%;" id="BtnAcatualizar" class="btn btn-primary btn-xs" type="button"><i class="glyphicon glyphicon-refresh"></i> SIAF</button>
						</a>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<a href="javascript:siafActualizadorDatosGenerales()">
							<button style="width: 100%;" id="BtnAcatualizarDatosGenerales" class="btn btn-success btn-xs" type="button"><i class="glyphicon glyphicon-refresh"></i> Datos Año</button>
						</a>
					</div>
					<div class="col-md-2 col-sm-12 col-xs-12 form-group">
						<a href="javascript:siafActualizadorCertificado()">
							<button style="width: 100%;" id="BtnAcatualizarCertificado" class="btn btn-info btn-xs" type="button"><i class="glyphicon glyphicon-refresh"></i> Certificados</button>
						</a>
					</div>
				</div>
				<?php } ?>	

					<div class="table-responsive">
					<br>
						<table class="table table-striped table-bordered tablaGenerica tablaRelevante" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Costo Total</th>
									<th>PIM Total</th>
									<th>Certificado Total</th>
									<th>Avance PIM Certificado Total</th>
									<th>Devengado Total</th>
									<th>Avance PIM Devengado Total</th>
									<th>Seguimiento Total</th>
									<th>Por Gastar Total</th>
								</tr>
							</thead>
							<tbody>
							  	<tr>
							    	<td>
							    		S/.<?=a_number_format($costo_total, 2, '.', ",", 3)?>
							    	</td>
									<td>
										S/.<?=a_number_format($PIM_Acumulado_Total, 2, '.', ",", 3)?>
									</td>
									<td>
										S/.<?=a_number_format($Certificado_Total, 2, '.', ",", 3)?>
									</td>
									<td>
										<?=a_number_format($Avance_PIM_Certificado_Total, 2, '.', ",", 3)?> %
									</td>
									<td>
										S/.<?=a_number_format($Devengado_Total, 2, '.', ",", 3)?>
									</td>
									<td>
										<?=a_number_format($Avance_PIM_Devengado_Total, 2, '.', ",", 3)?> %
									</td>
									<td>
										S/.<?=a_number_format($Seguimiento_Total, 2, '.', ",", 3)?>
									</td>
									<td>
										S/.<?=a_number_format($Por_Gastar_Total, 2, '.', ",", 3)?>
									</td>
							  	</tr>
							</tbody>
						</table>
						<br>
					</div>
					
					
					<div class="table-responsive">
					
					<div class="pull-right tableTools-container-consolidadoAvance"></div>
					<hr>
						<table id="table-consolidadoAvance" class="table table-striped table-bordered table-hover table-responsive display  compact  dataTable no-footer"  cellspacing="0" width="112%">
						 	<thead style="background-color: #728B9B;color:#FFFFFF; ">
							 	<tr>
								 	<th style="c;">SNIP</th>
								 	<th style="width: 5%;">Meta</th>
								 	<th style="width: 5%;">SIAF</th>
								 	<th style="width: 45%;">Proyecto</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Costo (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">PIA (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Modif (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">PIM (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Certificado (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Avance Cert. (%)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Devengado (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Avance Dev. (%)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Seguimiento (S/.)</th>
								 	<th class="alineacionDerecha" style="width: 5%;">Por Gastar (S/.)</th>
							 	</tr>
						 	</thead>
						 	<tbody>
								<?php foreach ($Consolidado as $item) {?>
								  	<tr>
										<td style="width:3%;">
											<?=(int)$item->proyecto_snip?>
								    	</td>
								    	<td style="width:2%;">
											<?=(int)$item->sec_func?>
								    	</td>
								    	<td style="width:3%;">
											<a type="button" class="DetalleOrdenExpeSiaf btn btn-success btn-xs" href="<?php echo site_url('ProyectoInversion/ReporteBuscadorPorPip?codigo=' . $item->act_proy); ?>"><?=$item->act_proy?> <i class='ace-icon bigger-120'></i></a>
								    	</td>
								    	<td style="width:31%;">
											<?=$item->nombre?>
								    	</td>
								    	<td style="width:7%;" class="alineacionDerecha">
											<?=a_number_format(($item->costo_actual != null)? $item->costo_actual+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:7%;" class="alineacionDerecha">
											<?=a_number_format(($item->pim_acumulado != null) ? $item->pim_acumulado+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:7%;" class="alineacionDerecha">
								    		<?=a_number_format(($item->modificacion != null)? $item->modificacion+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:8%;" class="alineacionDerecha">
								    		<?=a_number_format($item->modificacion+$item->pim_acumulado, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:8%;" class="alineacionDerecha">
											<?=a_number_format(($item->monto_certificado != null) ? $item->monto_certificado+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:6%;" class="alineacionDerecha">
											<?=($item->avance_pim_cert != null)? $item->avance_pim_cert+0:null?>
								    	</td>
								    	<td style="width:8%;" class="alineacionDerecha">
											<?=a_number_format(($item->devengado != null)? $item->devengado+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:6%;" class="alineacionDerecha">
											<?=($item->avance_pim_deven != null)? $item->avance_pim_deven+0:null?>
								    	</td>
								    	<td style="width:8%;" class="alineacionDerecha">
											<?=a_number_format(($item->para_seguimiento != null)? $item->para_seguimiento+0:null, 2, '.', ",", 3)?>
								    	</td>
								    	<td style="width:8%;" class="alineacionDerecha">
											<?=a_number_format(($item->saldo_por_gastar != null)? $item->saldo_por_gastar+0:null, 2, '.', ",", 3)?>
								    	</td>
								  </tr>
								<?php }?>
							</tbody>
					  	</table>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>
<script>

$(document).on("ready" ,function()
{
	$("#AnioPip").on( "click", function()
	{
		avanceFisico();
	});

});

function avanceFisico()
{
	$("#avancefisicoFinan").show(2000);

	var anio=$("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var	tipo_proyecto = $("#opcion_tipo_proyecto").val();
	window.location.href=base_url+"index.php/ProyectoInversion/ReporteBuscadorPorAnio?anio="+anio+"&sec_ejec="+sec_ejec+"&tipo_proyecto="+tipo_proyecto;
}

function siafActualizadorCertificado()
{
    var anio = $("#BuscarPipAnio").val();
    var sec_ejec = $("#opcion_ue").val();
	var start = +new Date();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/Importacion/anio/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
		contentType:false,
		processData:false,
		beforeSend: function(request) {
			renderLoading();
		},
		success:function(data){
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
					'error'
				);
			}
		},
		error: function (xhr, textStatus, errorMessage) 
		{
			$('#divModalCargaAjax').hide();
			swal(
					'ERROR!',
					'Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419',
					'error'
				);
		}
	});
}

function siafActualizadorDatosGenerales()
{
    var anio = $("#BuscarPipAnio").val();
	var start = +new Date();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/DatosGenerales/importar/"+anio,
		type: "POST",
		cache: false,
		contentType:false,
		processData:false,
		beforeSend: function(request) 
		{
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
					'error'
				);
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
			$('#divModalCargaAjax').hide();
			swal(
				'ERROR!',
				'Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419',
				'error'
			);
		}
	});
}


function ImportarExpedienteMeta()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/Expediente/expediente_meta/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error'
				);
	    }
	});
}

function siafActualizadorCertificado()
{
	 var anio = $("#BuscarPipAnio").val();
    var sec_ejec = $("#opcion_ue").val();
	var start = +new Date();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url: ups_url + "/Certificado/certificado_meta/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
		contentType:false,
		processData:false,
		beforeSend: function(request) 
		{
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
					'error'
				);
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
			$('#divModalCargaAjax').hide();
			swal(
				'ERROR!',
				'Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419',
				'error'
			);
		}
	});
}

function ImportarExpedientes()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	$.ajax({
		url:ups_url+"/Expediente/expedienteGeneral/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error'
				);
	    }
	});
}

function ImportarGasto()
{
	var anio = $("#BuscarPipAnio").val();
	var sec_ejec = $("#opcion_ue").val();
	var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';

	// alert("HOLA");

	$.ajax({
		url:ups_url+"/Expediente/gastoGeneral/"+anio+"/"+sec_ejec,
		type: "POST",
		cache: false,
        contentType:false,
        processData:false,
		beforeSend: function(request)
		{
		    renderLoading();
		},
		success:function(data)
		{
			$('#divModalCargaAjax').hide();
			datos=JSON.parse(data);

			if(datos.actualizo)
			{
				swal('Operacion Completada',datos.mensaje,'success');
			}
			else
			{
				swal('No se pudo completar la Operacion',datos.mensaje,'error');
			}
		},
		error: function (xhr, textStatus, errorMessage)
		{
	        $('#divModalCargaAjax').hide();
	        swal('ERROR!','Ocurrio un problema durante la importacion, consulte con el administrador, error 0x5642419','error');
	    }
	});
}
</script>
