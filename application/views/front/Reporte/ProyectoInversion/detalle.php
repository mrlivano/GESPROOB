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
						<div class="" role="tabpanel" data-example-id="togglable-tabs">					
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<input type="hidden" name="hdSecEjec" id="hdSecEjec" value="<?=$sec_ejec?>">
									<div class="row">
						                <div class="col-md-12 col-sm-12 col-xs-12">																			
					                        <div class="table-responsive">
					                        	<table id="table-DatoGen"  class="table-hover" cellspacing="0" width="100%">
													<tbody>
														<?php if($listaDetalleMensualizadoEst ==false)
														{?>
														<tr><td>AÑO:</td></tr>
														<tr><td>CORRELATIVO META:</td></tr>
														<?php }
														else 
														{ ?>
															<tr><td>AÑO: <?=$listaDetalleMensualizadoEst->ano_eje ;?></td></tr>
															<tr><td>CORRELATIVO META: <?=$listaDetalleMensualizadoEst->meta;?></td></tr>																
														<?php
														} ?>														
													</tbody>
												</table>
					                        </div>
											<b>REPORTE MENSUALIZADO:  </b>		
						                </div>
						        	</div>
									<br>	
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="table-responsive">				
											<table id="table-DetalleMensualizado"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<td>Nombre</td>
														<td>Mes</td>
														<td style="text-align:right">Ejecución</td>
														<td style="text-align:right">Certificado</td>
														<td style="text-align:right">Compromiso</td>
														<td style="text-align:right">Devengado</td>
														<td style="text-align:right">Girado</td>
														<td style="text-align:right">Pagado</td>
													</tr>
												</thead>
												<tbody>
													<?php foreach($listaDetalleMensualizado as $item ){ ?>
													  	<tr>
															<td>
																<?=$item->nombre?>
													    	</td>
													    	<td>
																<?=$item->mes_eje?>
													    	</td>
													    	<td style="text-align:right">
																<?= number_format($item->ejecucion,2)?>
													    	</td>
													    	<td style="text-align:right">
																<?= number_format($item->certificado,2)?>
													    	</td>
													    	<td style="text-align:right">
																<?= number_format($item->compromiso,2)?>
													    	</td>
													    	<td style="text-align:right">
																<?= number_format($item->devengado,2)?>
													    	</td>
													    	<td style="text-align:right">
																<?= number_format($item->girado,2)?>
													    	</td>
													    	<td style="text-align:right">
																<?=number_format($item->pagado,2)?>
													    	</td>
													  </tr>
													<?php } ?>
												</tbody>
												<input type="hidden" id="txtcorrelativo" name="txtcorrelativo" value="<?php echo $correlativoMeta ?>">
												<input type="hidden" id="txtanioMeta" name="txtanioMeta" value="<?php echo $anioMeta ?>">
											</table>
											</div>
										</div>
									
									</div>
									<div class="row">
						                <div class="col-md-12 col-sm-12 col-xs-12">
											<b>REPORTE ACUMULADO MENSUALIZADO:  </b>
						                </div>
						        	</div>
									<br>	
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="table-responsive">
											<table id="table-DetalleMensualizado"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
												<thead>
													<tr>
														<td>Nombre</td>
														<td>Mes</td>
														<td style="text-align:right">Ejecución</td>
														<td style="text-align:right">Certificado</td>
														<td style="text-align:right">Compromiso</td>
														<td style="text-align:right">Devengado</td>
														<td style="text-align:right">Girado</td>
														<td style="text-align:right">Pagado</td>
													</tr>
												</thead>
												<tbody>
													<?php $a_ejecución=0; 
													 $a_compromiso=0; 
													 $a_certificado=0; 
													 $a_devengado=0; 
													 $a_girado=0; 
													 $a_pagado=0; ?>


													<?php foreach($listaDetalleMensualizado as $item ){ ?>
													  	<tr>
															<td>
																<?=$item->nombre?>
													    	</td>
													    	<td>
																<?=$item->mes_eje?>
													    	</td>
													    	<td style="text-align:right">

													    		<?php $a_ejecución=$a_ejecución+$item->ejecucion; ?>
																<?= number_format($a_ejecución,2)?>
													    	</td>
													    	<td style="text-align:right">
													    		<?php $a_certificado=$a_certificado+$item->certificado; ?>
																<?= number_format($a_certificado,2)?>
													    	</td>
													    	<td style="text-align:right">
													    		<?php $a_compromiso=$a_compromiso+$item->compromiso; ?>
																<?= number_format($a_compromiso,2)?>
													    	</td>
													    	<td style="text-align:right">
													    		<?php $a_devengado=$a_devengado+$item->devengado; ?>
																<?= number_format($a_devengado,2)?>
													    	</td>
													    	<td style="text-align:right">
													    		<?php $a_girado=$a_girado+$item->girado; ?>
																<?= number_format($a_girado,2)?>
													    	</td>
													    	<td style="text-align:right">
													    		<?php $a_pagado=$a_pagado+$item->pagado; ?>
																<?=number_format($a_pagado,2)?>
													    	</td>
													  </tr>
													<?php } ?>
												</tbody>
												<input type="hidden" id="txtcorrelativo" name="txtcorrelativo" value="<?php echo $correlativoMeta ?>">
												<input type="hidden" id="txtanioMeta" name="txtanioMeta" value="<?php echo $anioMeta ?>">
											</table>
											</div>
										</div>
									
									</div>

									<div class="row" style="margin-left: 10px; margin:10px; ">
										<div class="table-responsive">
											<div class="panel panel-default">
												<div class="panel-heading">GRÁFICO ESTADÍSTICO DE DETALLE MENSUALIZADO</div>
												<div id="contenedorGrafico">
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




<script>
window.setTimeout(function()
{
	var meta=document.getElementById("txtcorrelativo").value;
	var anio=document.getElementById("txtanioMeta").value;

	$("#contenedorGrafico").css({"height":"450"});
	
	$.ajax({
		"url":base_url+"index.php/PrincipalReportes/GrafDetalleMensualizado",
		type:"GET", 
		data:{meta:meta,anio:anio,sec_ejec:$('#hdSecEjec').val()},
		cache:false,
		success:function(resp)
		{
			var pip=JSON.parse(resp);
			var echartLine = echarts.init(document.getElementById('contenedorGrafico'));
			console.log(pip)
      echartLine.setOption({
        title: {
          text: '',
          subtext: ''
        },
        tooltip: {
          trigger: 'axis'
        },
        legend: {
          x: 220,
          y: 40,
          data: ['Ejecutado', 'Comprometido', 'Certificado','Devengado', 'Girado', 'Pagado']
        },
        
        toolbox: {
          show: true,
          feature: {
            magicType: {
              show: true,
              title: {
                line: 'Linea',
                bar: 'Barra',
                stack: 'Stack',
                tiled: 'Tiled'
              },
              type: ['line', 'bar', 'stack', 'tiled']
            },
            restore: {
              show: true,
              title: "Actualizar"
            },
            saveAsImage: {
              show: true,
              title: "Descargar"
            }
          }
        },
        calculable: true,
        xAxis: [{
          type: 'category',
          boundaryGap: false,
          data: pip[0]
        }], 
        yAxis: [{
          type: 'value'
        }],
        series: [{
          name: 'Ejecutado',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[1]
        }, {
          name: 'Comprometido',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[2]
        },
        {
          name: 'Certificado',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[3]
        },
        {
          name: 'Devengado',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[4]
        },{
          name: 'Girado',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[5]
        },{
          name: 'Pagado',
          type: 'line',
          smooth: true,
          itemStyle: {
            normal: {
              areaStyle: {
                type: 'default'
              }
            }
          },
          data: pip[6]
        },]
      });


			/*var dom = document.getElementById("contenedorGrafico");
			
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
			        show: true,
			        position: app.config.position,
			        distance: app.config.distance,
			        align: app.config.align,
			        verticalAlign: app.config.verticalAlign,
			        rotate: app.config.rotate,
			        formatter: '{c}  {name|{a}}',
			        fontSize: 10,
			        rich: {
			            name: {
			                textBorderColor: '#fff'
			            }
			        }
			    }
			};

			option = {
			    color: ['#003366', '#16A085', '#4cabce', '#e5323e','#D35400','#8E44AD'],
			    tooltip: {
			        trigger: 'axis',
			        axisPointer: {
			            type: 'shadow'
			        }
			    },
			    legend: {
			        data: ['Ejecucion', 'Compromiso','Certificado','Devengado', 'Girado','Pagado']
			    },
			    toolbox: {
			        show: true,
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
			            name: 'Ejecucion',
			            type: 'bar',
			            barGap: 0,
			            label: labelOption,
			            data: 
			            

			            pip[1]
			        },
			        {
			            name: 'Compromiso',
			            type: 'bar',
			            label: labelOption,
			            data: pip[2]
			        },
			          {
			            name: 'Certificado',
			            type: 'bar',
			            label: labelOption,
			            data: pip[3]
			        },
			        {
			            name: 'Devengado',
			            type: 'bar',
			            label: labelOption,
			            data: pip[4]
			        },
			        {
			            name: 'Girado',
			            type: 'bar',
			            label: labelOption,
			            data: pip[5]
			        },
			        {
			            name: 'Pagado',
			            type: 'bar',
			            label: labelOption,
			            data: pip[6]
			        }
			    ]
			};

			if (option && typeof option === "object") {
			    myChart.setOption(option, true);
			}*/
		}
	});
}, 5000);
</script>