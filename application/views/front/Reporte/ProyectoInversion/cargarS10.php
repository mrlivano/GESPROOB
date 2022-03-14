<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts-all-3.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>

<script>
	function solonumeros(e)
	{
		key=e.keyCode || e.which;
		teclado=String.fromCharCode(key);
		numeros="0123456789";
		especiales="8-37-38-46";
		teclado_especial=false;

		for(var i in especiales)
		{
			if(key==especiales[i])
			{
				teclado_especial=true;
			}
		}
		if(numeros.indexOf(teclado)==-1 && !teclado_especial)
		{
			return false;


		}
	}
</script>

<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>CARGAR PROYECTO DE INVERSIÓN - S10</b> </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						CARGAR POR CÓDIGO (Ingrese un código válido)
						<div class="row">
							<div class="col-lg-6">
								<div class="input-group">
						      		<input type="text" id="BuscarPip" onkeypress="return solonumeros(event)" class="form-control" placeholder="Ingrese código Unico:" value="<?=$codigo?>" onkeyup="mostrarVentanaReporte(event);">
						      		<span class="input-group-btn">
						        		<button id="CodigoUnico" class="btn btn-default" type="button" ><span class="glyphicon glyphicon-search"> Aceptar</span></button>
						     		</span>
						    	</div>
						 	</div>
                         	<div class="col-lg-6">
                            	<div class="input-group">
                              		<span class="input-group-btn">
										<a href="javascript:siafActualizador()"><button id="BtnAcatualizar" class="btn btn-success" type="button"><i class="fa fa-spinner"></i> Cargar (Importar S10)</button></a>
                              		</span>
                            	</div>
                          	</div>
						</div>
						<div class="row">
							<div class="row" style="margin-left: 10px; margin:10px; ">
								<div class="panel panel-default">
									<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#tab_datosproyecto"  id="home-tab" role="tab" data-toggle="tab" >Datos del Proyecto de Inversion</a>
							</li>
							<li role="presentation">
								<a href="#tab_ejecucionpresupuestal"  id="profile-tab" role="tab" data-toggle="tab" aria-expanded="false">Ejecucion Presupuestal por Año</a>
							</li>
							<li role="presentation">
								<a href="#tab_informacionfinanciera"  id="profile-tab" role="tab" data-toggle="tab" >Detalle de Informacion Financiera por Año</a>
							</li>
							<li role="presentation">
								<a href="#tab_grafico" name='-' id="profile-tab" role="tab" data-toggle="tab" >GRAFICOS</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_datosproyecto" aria-labelledby="home-tab">
							<br>
							<div class="row" style="margin-left: 10px; margin:10px; ">
								<div class="panel panel-default">
												
									<div id="EjecucionAnual">
										<table class="table" STYLE="table-layout:fixed">
											<tr>
												<td style="width: 20%" class="blue"><b>NOMBRE</b></td>
												<td style="width: 80%">
													<label  id="txtnombre" name="txtnombre"></label>
												</td>
											</tr>
											<tr>
												<td class="blue" ><b>MONTO DE INVERSIÓN (Expediente Técnico)</b></td>
												<td>S/. <label id="txtbeneficiario" name="txtbeneficiario"></label></td>
											</tr>
											<tr>
												<td class="blue" ><b>COSTO DE VIABLIDAD (Pre-Inversión)</b></td>
												<td> S/. <label id="txtPIA" name="txtPIA"></label> </td>
											</tr>
											<tr>
												<td class="blue" ><b>MONTO DE EJECUCIÓN (Actual)</b></td>
												<td> S/. <label id="txtPIN" name="txtPIN"></label> </td>
											</tr>
										</table>
									</div>
								</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_ejecucionpresupuestal" aria-labelledby="home-tab">
								<br>
								<div class="row" style="margin-left: 10px; margin:10px; ">
									<div class="panel panel-default">
										<div id="actproynombre" class="table-responsive">
										
										<table id="table-EjecucionPresupuestal" class="table  table-striped jambo_table bulk_action" style="text-align: left;">
										</table>
									</div>
								</div>
							</div>
								
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_informacionfinanciera" aria-labelledby="home-tab">
								<br>
										<div class="row" style="margin-left: 10px; margin:10px; ">
											<div id="metaAcumulada" class="table-responsive">
												<table id="table-MetaAcumulada" class="table table-striped jambo_table bulk_action" style="text-align: left;" width="100%">
										 		</table>
								    		</div>
										</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_grafico" name='-' aria-labelledby="home-tab">
								<br>
									<div class="row" style="margin-left: 10px; margin:10px; ">
				                <div class="panel panel-default">
								 <div class="panel-heading">GRÁFICO ESTADÍSTICO: INFORMACIÓN FINANCIERA POR AÑO</div>

										<div id="GrafmetaAcumulada" class="table-responsive">
											<br>
											<table id="tableGraf" class="table  table-striped jambo_table bulk_action table-responsive" style="text-align: left;">
											 	 <div id="MetaPimPiaPorCadaAño"></div>
										  </table>
									    </div>

				                </div>
					        </div>
					        <div class="row" style="margin-left: 10px; margin:10px; ">
				                <div class="panel panel-default">
								 <div class="panel-heading">GRÁFICO ESTADÍSTICO: EVOLUCIÓN DE LA EJECUCIÓN FINANCIERA POR FASE</div>

										<div id="Grafinformacionfinanciera" class="table-responsive">
											<br>
											<table id="tableGrafinfFinanciera" class="table  table-striped jambo_table bulk_action table-responsive" style="text-align: left;">
											 	 <div id="AvanceInfFinanciera"></div>
										  </table>
									    </div>

				                </div>
					        </div>
							<div class="row" style="margin-left: 10px; margin:10px; ">
				                <div class="panel panel-default">
								 	<div class="panel-heading">GRÁFICO ESTADÍSTICO: EJECUCIÓN FINANCIERA ACUMULADA</div>
									<div id="panelEjecucionFinanciera" class="table-responsive">
										<br>
										<table id="tableEjecucionFinanciera" class="table  table-striped jambo_table bulk_action table-responsive" style="text-align: left;">
										</table>
										<table id="tableGraEjecFinanciera" class="table  table-striped jambo_table bulk_action table-responsive" style="text-align: left;">
											<div id="graficoEjecucionFinanciera"></div>
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
		<div class="clearfix"></div>
	</div>
</div>
</div>
<script>

	$(document).on('hidden.bs.modal', '.modal', function ()
	{
		if ($('body').find('.modal.in').length > 0)
		{
			$('body').addClass('modal-open');
		}
	});

	$(document).on("ready" ,function()
	{
	//	$("#EjecucionAnual").hide();
		
	});


	function siafActualizador()
	{
    	var codigounico=$("#BuscarPip").val();
		var start = +new Date();
		var name="1235";
    	$.ajax({
			var url="E:\\borrar data";
			url: base_url + "index.php/PrincipalReportes/RestoreDB",
			type: "POST",
			data:{nameBD:name, urlBD:url},
			beforeSend: function(request)
			{
				renderLoading();
			},
			success:function(data)
			{
				$('#divModalCargaAjax').hide();
				
				datos=data.slice(data.indexOf('RESTORE'));

				if(datos.indexOf('successfully')!==-1)
				{
					swal(
						'Operacion Completada',
						datos,
						'success'
					);
				}
				else
				{
					swal(
						'No se pudo completar la Operacion',
						datos,
						'error'
					);
				}
			},
			error: function (xhr, textStatus, errorMessage) 
			{
				$('#divModalCargaAjax').hide();
				swal(
					'ERROR!',
					'No se pudo conectar con el servidor para restaurar BD',
					'error'
				);
			}
		});
    }


</script>
