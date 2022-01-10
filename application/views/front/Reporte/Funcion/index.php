<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts-all-3.js"></script>
<div class="right_col" role="main">
	<div class="">
		<div class="clearfix"></div>
		<div class="">
			<div class="col-md-12 col-xs-12 col-xs-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>REPORTE DE PIP POR FUNCIÓN</b> </h2>
						<ul class="nav navbar-right panel_toolbox">
						</ul>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
							<ul id="myTab" class="nav nav-tabs" role="tablist">
								<li role="presentation" class="active">
									<a href="#tab_Sector"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">
										<b> Funcion</b>
									</a>
								</li>
							</ul>
							<div id="myTabContent" class="tab-content">
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Sector" aria-labelledby="home-tab">
									<div class="row">  
										<div class="col-md-12 col-sm-12 col-xs-12">
											<div class="x_panel">
													<div class="clearfix">
														<div class="pull-right tableTools-container"></div>
													</div>
													<div class="x_content">
														<table id="dynamic-table"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
															<thead>
																<tr>
																	<td>Función</td>
																	<td >Número de PIP</td>
																	<td >Costo total</td>

																</tr>
															</thead>
															<tbody>
															<?php foreach($listaNumPipFuncion as $item ){ ?>
															  	<tr>
																	<td>
																		<?=$item->nombre_funcion?>
															    	</td>
															    	<td>
																		<?=$item->CantidadPip?>
															    	</td>	
															    	<td style="text-align:right">
																		S/. <?= a_number_format($item->CostoPip , 2, '.',",",3);?>
															    	</td>
															  </tr>
															<?php } ?>
																<tr>
																	<td bgcolor="#D1F2EB"><b></b></td>
																	<td bgcolor="#D1F2EB"><b><?=$listaMontoTotalFuncion->CantidadPip;?></b></td>
																	<td style="text-align:right" bgcolor="#D1F2EB"><b><?= a_number_format($listaMontoTotalFuncion->CostoPip, 2, '.',",",3);?><b></td>											
																</tr>
															</tbody>
														</table>
													</div>

													<div class="col-md-4 col-sm-12 col-xs-12">
														<table id="table-Resumen"  class="table">
																<tr>
																<td colspan="2"><b>CUADRO RESUMEN DE PIP POR FUNCION</b></td>
																</tr>
																<tr>														
																	<td >Costo total</td>
																	<td>TOTAL PIP</td>
																</tr>
																<tr>
																
																	<td bgcolor="#D1F2EB">
																	<?= a_number_format($listaMontoTotalFuncion->CostoPip, 2, '.',",",3);?></td>
																	<td bgcolor="#D1F2EB"><?=$listaMontoTotalFuncion->CantidadPip;?></td>
																</tr>
														</table> 
													</div>
											</div>
										</div>
									</div>
									<row>
										<div class="col-md-12 col-sm-12 col-xs-12">
							                <div class="x_panel">
							                    <div class="x_title">
							                        <h5>Reporte en función al número de PIP</h5>

							                        <div class="clearfix"></div>
							                    </div>
							                    <div class="x_content">
							                        <div id="reporteFuncionNumeroPip" style="height:350px;"></div>
							                    </div>
							                </div>
							            </div>
							            <div class="col-md-12 col-sm-12 col-xs-12">
							                <div class="x_panel">
							                    <div class="x_title">
							                        <h5>Reporte en función al Costo Total</h5>

							                        <div class="clearfix"></div>
							                    </div>
							                    <div class="x_content">
							                        <div id="reporteFuncionCosto" style="height:350px;"></div>
							                    </div>
							                </div>
							            </div>
									</row>
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

$(document).ready(function()
	{
		var myTable=$('#dynamic-table').DataTable(
		{
			"language":idioma_espanol,
            "searching": true,
             "info":     true,
            "paging":   true,
		});
			
				$.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
				
				new $.fn.dataTable.Buttons( myTable, {
					buttons: [
					  {
						"extend": "excel",
						"text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "pdf",
						"text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
						"className": "btn btn-white btn-primary btn-bold"
					  },
					  {
						"extend": "print",
						"text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
						"className": "btn btn-white btn-primary btn-bold",
						autoPrint: false,
						message: 'This print was produced using the Print button for DataTables'
					  }		  
					]
				} );
				myTable.buttons().container().appendTo( $('.tableTools-container') );
				
			
			})

$.ajax({
        url:base_url+"/index.php/PrincipalReportes/FuncionNumeroPip",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            
            var arrayCantidadPip=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayCantidadPip[index]=element.CantidadPip;
            });
            var dom = document.getElementById("reporteFuncionNumeroPip");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title : {
                    text: '',
                    subtext: '',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'horizontal',
                    left: 'left',
                    data: ['Educación','Legislativa','Planeamiento, Gestión y reserva de Contingencia','Relaciones Exteriores','Transporte']
                },

                series : [
                {
                    name: 'Número de PIP',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayCantidadPip[0], name:'Educación'},
                    {value:arrayCantidadPip[1], name:'Legislativa'},
                    {value:arrayCantidadPip[2], name:'Planeamiento, Gestión y reserva de Contingencia'},
                    {value:arrayCantidadPip[3], name:'Relaciones Exteriores'},
                    {value:arrayCantidadPip[4], name:'Transporte'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                ]
            };
            if (option && typeof option === "object") 
            {
                myChart.setOption(option, true);
            }
        }
    });


    /*Reporte de de cadena funcional en funcion al numero de pip*/

    $.ajax({
        url:base_url+"/index.php/PrincipalReportes/FuncionNumeroPip",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayCostoPip = new Array();
            $.each(respuesta,function(index,element)
            {
                arrayCostoPip[index]=element.CostoPip;
            });
            var dom = document.getElementById("reporteFuncionCosto");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title : {
                    text: '',
                    subtext: '',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'horizontal',
                    left: 'left',
                    data: ['Educación','Legislativa','Planeamiento, Gestión y reserva de Contingencia','Relaciones Exteriores','Transporte']
                },
                series : [
                {
                    name: 'Costo de PIP',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayCostoPip[0], name:'Educación'},
                    {value:arrayCostoPip[1], name:'Legislativa'},
                    {value:arrayCostoPip[2], name:'Planeamiento, Gestión y reserva de Contingencia'},
                    {value:arrayCostoPip[3], name:'Relaciones Exteriores'},
                    {value:arrayCostoPip[4], name:'Transporte'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                ]
            };
            if (option && typeof option === "object") 
            {
                myChart.setOption(option, true);
            }
        }
    });

</script>
