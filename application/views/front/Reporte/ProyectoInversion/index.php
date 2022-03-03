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
						<h2><b>REPORTE POR PROYECTO DE INVERSIÓN</b> </h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						BÚSQUEDA POR CÓDIGO (Ingrese un código válido SIAF)
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
										<a href="javascript:siafActualizador()"><button id="BtnAcatualizar" class="btn btn-success" type="button"><i class="fa fa-spinner"></i> Actualizar (Importar de SIAF)</button></a>
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
		$("#EjecucionAnual").hide();
		
	    $("#CodigoUnico").on( "click", function()
		{
			$('#myTab a[href="#tab_grafico"]').attr('name','-');
			mostrarDatos();
		});
	});





	function mostrarVentanaReporte(event)
	{
		var evt=event || window.event;

		var code=0;

		if(evt!='noEventHandle')
		{
			code=evt.charCode || evt.keyCode || evt.which;
		}

		if(code==13)
		{
			mostrarDatos();
		}
	}


	$('#myTab a[href="#tab_grafico"]').on('shown.bs.tab', function(event){
		var valor=$(this).attr('name');
	  if(valor=='-'){
	  	mostrarGraficos();
	  	$(this).attr('name','+');
	  }
	  });





	function mostrarDatos()

	{
		$('#myTab a[href="#tab_datosproyecto"]').click();
		

		var codigounico=$("#BuscarPip").val();
		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/DatosParaEstadisticaAnualProyecto",
			type:"POST",
			data:{codigounico:codigounico},
			success: function(data)
			{
				var cantidadpipprovincias=JSON.parse(data);
				$("#txtnombre").html(cantidadpipprovincias.nombre);
				$("#txtbeneficiario").html(cantidadpipprovincias.costo_actual);
				$("#txtmontoInversion").html(cantidadpipprovincias.costo_expediente);
				$("#txtPIA").html(cantidadpipprovincias.costo_viabilidad);
				$("#txtPIN").html(cantidadpipprovincias.ejecucion_ano_anterior);
				$("#EjecucionAnual").show(2000);
			}
		});

		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/DatosEjecucionPresupuestal",
			type:"POST",
			data:{codigounico:codigounico},
			success: function(data)
			{
				var ejecucionPresupuestal=JSON.parse(data);
				var html;
				html+="<thead><tr><th>AÑO EJECUCIÓN</th><th style='text-align:right'>COSTO ACTUAL</th><th style='text-align:right'>COSTO DE EXPEDIENTE</th><th style='text-align:right'>COSTO DE VIABILIDAD</th><th style='text-align:right'>COSTO DE EJECUCIÓN FINAL</th></tr></thead>"
				$.each( ejecucionPresupuestal, function( key, value ) {
				html +="<tbody> <tr><td><button type='button' class='editar btn btn-success btn-xs' onclick='detalleAnalitico("+value.ano_eje+","+codigounico+");'>"+value.ano_eje+"<i class='ace-icon bigger-120'></i></button><button type='button' class='clasificador btn btn-primary btn-xs' onclick='detalleClasificadorPip("+value.ano_eje+","+codigounico+");'>Por Clasificador<i class='ace-icon bigger-120'></i></button></td><td style='text-align:right'> S/. "+(value.costo_actual)+"</td><td style='text-align:right'>S/. "+value.costo_expediente+"</td><td style='text-align:right'>S/. "+value.costo_viabilidad+"</td><td style='text-align:right'>S/. "+value.ejecucion_ano_anterior+"</td></tr>";
						html +="</tbody>";
				});

				$("#table-EjecucionPresupuestal").html(html);
				$("#actproynombre").show(2000);
			}
		});

		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/DatosCorrelativoMeta",
			type:"POST",
			data:{codigounico:codigounico},
			success: function(data)
			{
				var meta1=JSON.parse(data);
				var html;
				html+="<thead><tr><th>Unidad Ejecutora</th><th>Año Ejec</th><th>Meta</th><th></th><th></th><th style='text-align:right'>PIA (S/.)</th><th style='text-align:right'>Modif (S/.)</th><th style='text-align:right'>PIM (S/.)</th><!--<th style='text-align:right'>Ejecución (S/.)</th>--><th style='text-align:right'>Certificado (S/.)</th><th style='text-align:right'>Compromiso (S/.)</th><th style='text-align:right'>Devengado (S/.)</th><th style='text-align:right'>Girado (S/.)</th><th style='text-align:right'>Pagado (S/.)</th><th style='text-align:right'>Saldo por certificar (S/.)</th><th style='text-align:right'>Saldo por devengar (S/.)</th><th style='text-align:right'>Avan Fin.</th></tr></thead><tbody>"
				$.each( meta1, function( key, value )
				{
					html +="<tr>";
							html +="<th  colspan='16'>"+value.nombre_finalidad+"</th></tr>";
					html +=" <tr><th style='width:5%;'><button type='button' class='btn btn-warning btn-xs'>"+value.sec_ejec+" <i class='ace-icon'></i></button></th><th style='width:4%;'><button type='button' class='btn btn-info btn-xs' onclick='detalladoMensualizado("+value.ano_eje+",\""+value.meta+"\", \""+value.sec_ejec+"\");'>"+parseInt(value.ano_eje)+" <i class='ace-icon'></i></button></th><th style='width:3%;'><button type='button' class='btn btn-primary btn-xs' onclick='detalladoMensualizadoFuenteFinan("+value.ano_eje+",\""+value.meta+"\", \""+value.sec_ejec+"\");'>"+parseInt(value.meta)+"<i class='ace-icon bigger-120'></i></button></th>";

					if(value.sec_ejec=='300251' || value.sec_ejec=='001549')
					{
						html+= "<th style='width:4%;'><button type='button' class='btn btn-success btn-xs' onclick='detalladoMensualizadoConceptoClasificador("+value.ano_eje+",\""+value.meta+"\", \""+value.sec_ejec+"\");'>Orden <i class='ace-icon'></i></button></th><th style='width:4%;'> <button type='button' class='btn btn-success btn-xs' onclick='detallePedidoCompraMeta("+value.ano_eje+",\""+value.meta+"\", \""+value.sec_ejec+"\");'>Pedido <i class='ace-icon'></i></button>  </th>";
					}
					else
					{
						html+="<th colspan='2' style='width:20%;'><button type='button' onclick='siafExpedienteUE("+value.ano_eje+",\""+codigounico+"\",\""+value.sec_ejec+"\")' class='btn btn-success btn-xs'>Expediente</button></th>";
					}
					html+="<th style='text-align:right; width:5%;'>"+value.pia+"</th><th style='text-align:right; width:5%;'>"+value.pim+"</th><th style='text-align:right; width:7%;'>"+value.pim_acumulado+"</th><!--<th style='text-align:right; width:5%;'>"+value.ejecucion+"</th>--><th style='text-align:right; width:7%;'>"+value.monto_certificado+"</th><th style='text-align:right; width:7%;'>"+value.compromiso+"</th><th style='text-align:right; width:7%;'>"+value.devengado+"</th><th style='text-align:right; width:5%;'>"+value.girado+"</th><th style='text-align:right; width:7%;'>"+value.pagado+"</th><th style='text-align:right; width:7%;'>"+value.saldo_certificado+"</th><th style='text-align:right; width:7%;'>"+value.saldo_devengado+"</th><th style='text-align:right; width:4%;'>"+value.avance_financiero+'%'+"</th></tr>";
						
				});
				html +="</tbody>";
				$("#table-MetaAcumulada").html(html);
				$("#metaAcumulada").show(2000);
			}
		});

	}
function mostrarGraficos()
	{
		var codigounico=$("#BuscarPip").val();
		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/GrafEstInfFinanciera",
			type:"GET",
			data:{codigounico:codigounico},
			cache:false,
			success:function(resp)
			{
				$("#MetaPimPiaPorCadaAño").css({"height":"420"});
				var pip=JSON.parse(resp);
				var dom = document.getElementById("MetaPimPiaPorCadaAño");
				var myChart = echarts.init(dom);
				var app = {};
				option = null;
					var posList = [
					'left', 'right', 'top', 'bottom',
					'inside',
					'insideTop', 'insideLeft', 'insideRight', 'insideBottom',
					'insideTopLeft', 'insideTopRight', 'insideBottomLeft', 'insideBottomRight'
				];

				app.configParameters = {
					rotate: {
						min: -90,
						max: 90
					},
					align: {
						options: {
							left: 'left',
							center: 'center',
							right: 'right'
						}
					},
					verticalAlign: {
						options: {
							top: 'top',
							middle: 'middle',
							bottom: 'bottom'
						}
					},
					position: {
						options: echarts.util.reduce(posList, function (map, pos) {
							map[pos] = pos;
							return map;
						}, {})
					},
					distance: {
						min: 0,
						max: 100
					}
				};

				app.config = {
					rotate: 90,
					align: 'left',
					verticalAlign: 'middle',
					position: 'insideBottom',
					distance: 15,
					onChange: function () {
						var labelOption = {
							normal: {
								rotate: app.config.rotate,
								align: app.config.align,
								verticalAlign: app.config.verticalAlign,
								position: app.config.position,
								distance: app.config.distance
							}
						};
						myChart.setOption({
							series: [{
								label: labelOption
							}, {
								label: labelOption
							}, {
								label: labelOption
							}, {
								label: labelOption
							}]
						});
					}
				};

				var labelOption = {
					normal: {
						show: false,
						position: app.config.position,
						distance: app.config.distance,
						align: app.config.align,
						verticalAlign: app.config.verticalAlign,
						rotate: app.config.rotate,
						formatter: '{c}  {name|{a}}',
						fontSize: 14,
						rich: {
							name: {
								textBorderColor: '#fff'
							}
						}
					}
				};

				option = {
					color: ['#c23531', '#2f4554', '#61a0a8', '#d48265', '#91c7ae', '#749f83'],
					tooltip: {
						trigger: 'axis',
						axisPointer: {
							type: 'shadow'
						}
					},
					legend: {
						data: ['PIM', 'CERTIFICADO','COMPROMISO','DEVENGADO','GIRADO','PAGADO']
					},
					toolbox: {
						show: false,
						orient: 'vertical',
						left: 'right',
						top: 'center',
						feature: {
							mark: {show: true},
							dataView: {show: true, readOnly: false},
							magicType: {show: true, type: ['line', 'bar', 'stack', 'tiled']},
							restore: {show: true},
							saveAsImage: {show: true}
						}
					},
					calculable: true,
					xAxis: [
						{
							type: 'category',
							axisTick: {show: false},
							data: pip[0]
						}
					],
					yAxis: [
						{
							type: 'value'
						}
					],
					series: [
						{
							name: 'PIM',
							type: 'bar',
							barGap: 0,
							label: labelOption,
							data: pip[1]
						},
						{
							name: 'CERTIFICADO',
							type: 'bar',
							label: labelOption,
							data: pip[2]
						},
						{
							name: 'COMPROMISO',
							type: 'bar',
							label: labelOption,
							data: pip[3]
						},
						{
							name: 'DEVENGADO',
							type: 'bar',
							label: labelOption,
							data: pip[4]
						},
						{
							name: 'GIRADO',
							type: 'bar',
							label: labelOption,
							data: pip[5]
						},
						{
							name: 'PAGADO',
							type: 'bar',
							label: labelOption,
							data: pip[6]
						}
					]
				};

				if (option && typeof option === "object")
				{
					myChart.setOption(option, true);
				}
			}
		});

		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/GrafAvanceFinanciero",
			type:"GET",
			data:{codigounico:codigounico},
			cache:false,
			success:function(resp)
			{
				var pip=JSON.parse(resp);
				if(!pip.mensaje)
				{
					$("#AvanceInfFinanciera").css({"height":"420"});			
					var dom = document.getElementById("AvanceInfFinanciera");
					var myChart = echarts.init(dom);
					var app = {};
					option = null;
					option =
					{
						tooltip: {
							trigger: 'axis'
						},
						legend: {
							data:['Certificado','Compromiso','Devengado','Girado','Pagado']
						},
						grid: {
							left: '3%',
							right: '4%',
							bottom: '3%',
							containLabel: true
						},
						xAxis: {
							type: 'category',
							boundaryGap: false,
							data: pip[0]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'Certificado',
								type:'line',
								stack: '总量',
								areaStyle: {normal: {}},
								data:pip[1]
							},
							{
								name:'Compromiso',
								type:'line',
								stack: '总量',
								areaStyle: {normal: {}},
								data:pip[2]
							},
							{
								name:'Devengado',
								type:'line',
								stack: '总量',
								areaStyle: {normal: {}},
								data:pip[3]
							},
							{
								name:'Girado',
								type:'line',
								stack: '总量',
								areaStyle: {normal: {}},
								data:pip[4]
							},
							{
								name:'Pagado',
								type:'line',
								stack: '总量',
								areaStyle: {normal: {}},
								data:pip[5]
							}
						]
					};
					if (option && typeof option === "object")
					{
						myChart.setOption(option, true);
					}
				}
			}
		});

		$.ajax({
			"url":base_url+"index.php/PrincipalReportes/ReporteEjecucionFinanciera",
			type:"GET",
			data:{codigounico:codigounico},
			cache:false,
			success:function(resp)
			{				
				var pip=JSON.parse(resp);
				if(!resp.mensaje)
				{
					$("#graficoEjecucionFinanciera").css({"height":"420"});
					var dom = document.getElementById("graficoEjecucionFinanciera");
					var myChart = echarts.init(dom);
					var app = {};
					option = null;
					option =
					{
						tooltip: {
							trigger: 'axis'
						},
						legend: {
							data:['PIM','EJECUCIÓN FINANCIERA POR AÑO','EJECUCIÓN FINANCIERA ACUMULADA']
						},
						grid: {
							left: '3%',
							right: '4%',
							bottom: '3%',
							containLabel: true
						},
						xAxis: {
							type: 'category',
							boundaryGap: false,
							data: pip[0]
						},
						yAxis: {
							type: 'value'
						},
						series: [
							{
								name:'PIM',
								type:'line',
								smooth: true,
								data:pip[1]
							},
							{
								name:'EJECUCIÓN FINANCIERA POR AÑO',
								type:'line',
								smooth: true,
								data:pip[2]
							},
							{
								name:'EJECUCIÓN FINANCIERA ACUMULADA',
								type:'line',
								smooth: true,
								data:pip[3]
							}
						]
					};
					if (option && typeof option === "object")
					{
						myChart.setOption(option, true);
					}
				}
			}
		});

	}

	function detalleAnalitico(anio,codigounico)
	{
		paginaAjaxDialogo(null, 'Analítico del Avance Financiero del Proyecto por año',{anio: anio,codigounico:codigounico}, base_url+'index.php/PrincipalReportes/DetalleAnalitico', 'GET', null, null, false, true);
	}

	function detalleClasificadorPip(anio,codigounico)
	{
		paginaAjaxDialogo(null, 'Detalle de Clasificador por PIP',{anio: anio,codigounico:codigounico}, base_url+'index.php/PrincipalReportes/DetalleClasificador', 'GET', null, null, false, true);
	}

	function detalladoMensualizado(anio,meta,sec_ejec)
	{
		paginaAjaxDialogo(null, 'Gasto Mensualizado por Meta',{ anio: anio, meta:meta,sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/DetalleMensualizado', 'GET', null, null, false, true);
	}

	function detalladoMensualizadoFuenteFinan(anio,meta,sec_ejec)
	{
		paginaAjaxDialogo(null, 'Fuente de Financiamiento por Meta',{ anio: anio, meta:meta,sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/DetalleMensualizadoFuenteFinan', 'GET', null, null, false, true);
	}

	function siafActualizador()
	{
    	var codigounico=$("#BuscarPip").val();
		var start = +new Date();
		var ups_url = '<?php $ups_url = $this->config->item('ups_url');echo $ups_url;?>';
    	$.ajax({
			url: ups_url + "/Importacion/codigo/" + codigounico,
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
					'No se pudo conectar con el servidor de Importacion, error 0x5642418',
					'error'
				);
			}
		});
    }

	function detalladoMensualizadoConceptoClasificador(anio,meta,sec_ejec)
	{
		paginaAjaxDialogo(null, 'Datos Generales y Detalle por Orden de Pedidos',{ anio: anio, meta:meta, sec_ejec:sec_ejec }, base_url+'index.php/PrincipalReportes/detalladoMensualizadoConceptoClasificador', 'GET', null, null, false, true);
	}
	
	function detallePedidoCompraMeta(anio,meta,sec_ejec)
	{
		paginaAjaxDialogo(null, 'Detalle de Pedidos',{ anio: anio, meta:meta, sec_ejec:sec_ejec }, base_url+'index.php/PrincipalReportes/detallePedidoCompraMeta', 'GET', null, null, false, true);
	}

	function siafExpedienteUE(anio,codigounico,sec_ejec)
	{
		paginaAjaxDialogo('ListaExpediente', 'Lista de Expedientes',{ anio: anio, codigounico:codigounico, sec_ejec:sec_ejec}, base_url+'index.php/PrincipalReportes/listaExpedientes', 'GET', null, null, false, true);
	}

</script>
