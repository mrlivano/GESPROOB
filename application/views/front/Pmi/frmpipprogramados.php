<style>
	#table-ProyectoInversionProgramado > tbody > tr > td
	{
		vertical-align: middle;
	}
	#table_formulacion_evaluacion>tbody>tr>td:nth-child(0n+6)
	{
		text-align: right;
	}
	#table_formulacion_evaluacion>tbody>tr>td:nth-child(0n+7)
	{
		text-align: right;
	}
	#table_formulacion_evaluacion>tbody>tr>td:nth-child(0n+8)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+6)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+7)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+8)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+9)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+10)
	{
		text-align: right;
	}
	#table_ejecucion>tbody>tr>td:nth-child(0n+11)
	{
		text-align: right;
	}
	#table_operacion_mantenimiento>tbody>tr>td:nth-child(0n+7)
	{
		text-align: right;
	}
	#table_operacion_mantenimiento>tbody>tr>td:nth-child(0n+8)
	{
		text-align: right;
	}
	#table_operacion_mantenimiento>tbody>tr>td:nth-child(0n+9)
	{
		text-align: right;
	}
</style>
<div class="right_col" role="main">
    <div class="">
    	<div class="page-title"></div>
        <div class="clearfix"></div>
        <div class="">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>PROYECTOS DE INVERSIÓN PROGRAMADOS<small></small></h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
						<div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                            	<li role="presentation"  class=""><a onclick=$("#Cbx_AnioCartera_").trigger("change");  href="#tab_brecha" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Formulación y Evaluación</a>
                                </li>
                                <li role="presentation" class="active"><a onclick="listar_aniocartera_Ejecucion()";  href="#tab_Ejecución" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Ejecución</a>
                                </li>
                                <li role="presentation" class=""><a onclick="listar_aniocartera_operacion_mant()"; href="#tab_OperacionMantenimiento" role="tab" id="" data-toggle="tab" aria-expanded="false"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Operación y Mantenimiento</a>
                                </li>
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade " id="tab_brecha" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="col-md-4">
													<select  id="Cbx_AnioCartera_" selected name="Cbx_AnioCartera_"  class="selectpicker"></select>
													<input type="hidden" id="Aniocartera" value="<?=(isset($anio) ? $anio : date('Y'))?>">
												</div>
												<br>
                                                <div class="x_content">
                                                    <table id="table_formulacion_evaluacion" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
                                                   		<thead style="background-color: #5A738E;color:#FFFFFF; ">
															<tr style="border:none;">
																<th colspan="6" style="width: 88%"></th>
																<th colspan="3" style="width: 12%; text-align:center;">PROGRAMACION</th>
															</tr>
															<tr>
																<th style="width: 1%">Id</th>
																<th style="width: 5%">Cód único</th>
																<th style="width: 5%">Ciclo de Inversión</th>
																<th style="width: 30%">Inversión</th>
																<th style="width: 4%">Prioridad</th>
																<th style="width: 4%">Brecha</th>
																<th style="width: 4%"><span class="lb_anio1"></span></th>
																<th style="width: 4%"><span class="lb_anio2"></span></th>
																<th style="width: 4%"><span class="lb_anio3"></span></th>
															</tr>
                                                      	</thead>
													</table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<div role="tabpanel" class="tab-pane fade active in" id="tab_Ejecución" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
													<div class="row">
														<div class="col-md-2">
															<select  id="selectAnioCarteraEjecucion" selected name="selectAnioCarteraEjecucion" class="selectpicker">
																<?php
																foreach ($anioProgramado as $value) 
																{?>
																	<option value="<?=$value->anio?>"><?=$value->anio?></option>
																<?php } 
																?>
															</select>
														</div>
													</div>
													<br>
													<div id="contenedorTablaEjecucion">
														<div id="divLoader" style="text-align:center;padding:50px;">
															<img height="50px;" width="50px;" src="http://cdn.shopify.com/s/files/1/1066/9566/t/10/assets/spinner-blue-circle.gif?9381645402975994646"></img>
														</div>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="tab_OperacionMantenimiento" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
												<div class="col-md-4">
													<select  id="Cbx_AnioCartera_operacion_mant" selected name="Cbx_AnioCartera_operacion_mant"  class="selectpicker"></select>
												</div>
												<br>
												<div class="x_content">
                                              		<table id="table_operacion_mantenimiento" class="table table-striped table-bordered table-hover table-responsive display  compact " ellspacing="0" width="100%">
														<thead style="background-color: #5A738E;color:#FFFFFF; ">
															<tr style="border:none;">
																<th colspan="6" style="width: 88%"></th>
																<th colspan="3" style="width: 12%; text-align:center;">OPERACION Y MANTENIMIENTO</th>
															</tr>
															<tr>
																<th style="width: 1%">Id</th>
																<th style="width: 5%">Cód único</th>
																<th style="width: 5%">Ciclo de Inversión</th>
																<th style="width: 30%">Inversión</th>
																<th style="width: 4%">Prioridad</th>
																<th style="width: 4%">Brecha</th>
																<th style="width: 4%"><span class="lb_anio1"></span></th>
																<th style="width: 4%"><span class="lb_anio2"></span></th>
																<th style="width: 4%"><span class="lb_anio3"></span></th>
															</tr>
														</thead>
														<tbody>
														</tbody>
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
		</div>
        <div class="clearfix"></div>
    </div>
</div>
<script>
$(document).on("ready" ,function()
{
	var anio=$('#selectAnioCarteraEjecucion').val();
	proyectoProgramadoEjecucion(anio);
});

function proyectoProgramadoEjecucion(anio)
{
	$.ajax({
        url:base_url +"index.php/PipProgramados/ProyectoProgramadoEjecucion",
		type:"POST",
		data :{anio:anio},		
        success:function(object)
        {
			$('#divLoader').hide();
			$('#contenedorTablaEjecucion').html(object);			
        }
    });
}

$("#selectAnioCarteraEjecucion").change(function() 
{
	var anio=$("#selectAnioCarteraEjecucion").val();
	proyectoProgramadoEjecucion(anio);
}); 
						
function mostrarReporteProgramacion()
{
	var anio=$('#selectAnioCarteraEjecucion').val();
	window.open('<?=base_url();?>PipProgramados/reporteProgramacionPdf?query=ejecucion&anio=2018','_blank');
}

</script>