
<link href="<?php echo base_url(); ?>assets/li/css/layout.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>assets/li/css/menu.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/li/js/script.js"></script>
<style>
	.btn.btn-app.btn-box
	{
		background-color: #f2f5f7;
		color:white;
		box-shadow: 0px 5px 5px 0px rgba(0,0,0,0.2);
		border: none;
		-webkit-transition: transform 0.3s;
        -moz-transition: transform 0.3s;
        -ms-transition: transform 0.3s;
        -o-transition: transform 0.3s;
        transition: transform 0.4s;
        user-select : none;
		font-size : 11px;
	}
	.btn.btn-app.btn-box:hover
	{
		background-color: #f2f5f7;
		color:white;
		transform: scale(1.125);
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
	}
	.menuPrincipal
	{
		background-color: #35495d;
		color: #73879c;
		font-size: 13px;
	}
	.menuGeneral>a
	{
		color: white;
	}
	.nav .open>a, .nav .open>a:focus, .nav .open>a:hover
	{
    	background-color: #26576f;
    	color: white;
	}
	.menuPrincipal>li>a:hover
	{
    	padding: 13px 15px 12px;
    	background-color: #5c94a0;
    	color: white;
	}
	.dropdown:hover
	{
		background-color: #35495d;
	}
	.subMenu >li>a:hover
	{
		background-color: #35495d;
		color:white;
	}
	.subMenu >li>a
	{
		padding: 5px 5px;
		color:#35495d;
		font-size: 13px;
	}
	.modal
	{
	   overflow:auto !important;
	}
	.dropdown:hover .dropdown-menu
	{
		display: block;
	}
	.dropdown-menu
	{
		box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		margin: 0px 0 0;
	}
	address
	{
		font-size: 13px;
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					
						<?php
						if($ExpedienteTecnicoElaboracion[0]->id_etapa_et == 1)
						{ ?>
							<h2><b>Expediente Técnico</b></h2>
						<?php } ?>
						<?php
						if($ExpedienteTecnicoElaboracion[0]->id_etapa_et == 3)
						{ ?>
							<h2><b>Proyecto en Ejecución: Expediente Contractual</b></h2>
						<?php } ?>
						<?php
						if($ExpedienteTecnicoElaboracion[0]->id_etapa_et == 10)
						{ ?>
							<h2><b>Proyecto en Ejecución: <?=$ExpedienteTecnicoElaboracion[0]->descripcion_modificatoria?></b></h2>
						<?php } ?>
					
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<p style="font-size:12px;font-weight:bold;color:#777bad;padding-bottom:10px; padding-top:5px;"><?=$ExpedienteTecnicoElaboracion[0]->codigo_unico_pi?> - <?=trim($ExpedienteTecnicoElaboracion[0]->nombre_pi);?></p>
					<?php if($ExpedienteTecnicoElaboracion[0]->id_etapa_et==1) { ?>
					<?php if($aprobado!=1) { ?>
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
                    	<ul id="myTab" class="nav nav-tabs" role="tablist">
                        	<li style="width:15%;"  role="presentation" class="active">
								<a href="#tabSeguimiento"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b> Plan de Trabajo</b></a>
                            </li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabExpedienteTecnico" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Expediente Tecnico</b></a>
							</li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabAprobacion" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Aprobación de E.T</b></a>
							</li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabDatosGenerales" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Datos Generales</b></a>
							</li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tabSeguimiento" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;" class="tag">
																	<span>Actividades</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">1.- Gestión y Asignación de Actividades</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro del Plan de Trabajo del Expediente Técnico a ser elaborado,
																	Asignar responsables a la actividades y registrar el avance de estas según lo programado.
																	El CRAET es responsable del registro de observaciones</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabExpedienteTecnico" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Modificar Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Ficha Tecnica</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Modificar Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;">1.- Ficha Técnica del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro de la Ficha Técnica del proyecto, responsables del Expediente técnico.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Memoria Descriptiva',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/MemoriaDescriptiva', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Memoria Descriptiva</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Memoria Descriptiva',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/MemoriaDescriptiva', 'GET', null, null, false, true);return false;">2.- Memoria Descriptiva del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">Se debe subir el archivo de la Memoria Descriptiva en formato PDF.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Impacto Ambiental',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ImpactoAmbiental', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Impacto Ambiental</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Impacto Ambiental',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ImpactoAmbiental', 'GET', null, null, false, true);return false;">3.- Impacto Ambiental</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">Se debe subir el archivo de Impacto Ambiental en formato PDF.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Presupuesto Analítico</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;">4.- Asignación de Clasificador a costos del proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"> Se debe asignar el clasificador presupuestal al costo que se esta realizando.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>ver C,M,P</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;">5.- Registro del Analítico del Presupuesto General </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detallara el presupuesto general del proyecto a nivel de Componentes, Metas y Partidas en Costos Directos e Indirectos. Tambien se podra definir el Analisis de los costos unitarios de cada partida.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de Especificaciones Técnicas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_EspecificacionTecnica/Insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Especificaciones Técnicas</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de Especificaciones Técnicas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_EspecificacionTecnica/Insertar', 'GET', null, null, false, true); return false;">6.- Registro de Especificaciones Técnicas </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detallara las especificaciones Técnicas del Expediente Técnico.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/Expediente_Tecnico/valorizacionEjecucionProyecto?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;"  class="tag">
																	<span>Cronogramación</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/Expediente_Tecnico/valorizacionEjecucionProyecto?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">7.- Cronograma Valorizado de Ejecución del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detallara el cronograma valorizado de ejecucion a nivel de costos directos e indirectos.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Cronograma de Requerimiento', null, base_url+'index.php/Expediente_Tecnico/CronogramacionRecurso?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Cronogramación</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Cronograma de Requerimiento', null, base_url+'index.php/Expediente_Tecnico/CronogramacionRecurso?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', 'GET', null, null, false, true); return false;">8.- Cronogramación de Requerimiento de Insumo </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se realiza la Cronogramación de Requerimiento de Recursos.</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
												<div class="row"  style="margin-right:-15px;margin-left:-15px;">
													<div class="col-md-12" style="text-align: center; display: inline-block;">
														<div>
															<h6><span>Formatos de Expediente Técnico</span></h6>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ficha Técnica del Proyectos" href="<?= site_url('Expediente_Tecnico/reportePdfExpedienteTecnico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																<i class="fa fa-file-pdf-o"></i> Formato FF-01
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Memoria Descriptiva del Proyecto" onclick="mostrarMemoriaDescritiva('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>','<?=@$ExpedienteTecnicoElaboracion[0]->url_memoria_descriptiva?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-02
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box" data-toggle="tooltip" title="Evaluación del Impacto Ambiental" onclick="mostrarImpactoAmbiental('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>','<?=@$ExpedienteTecnicoElaboracion[0]->url_impacto_ambiental?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-03
															</a>
															<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Especificaciones Técnicas" onclick="listaComponente('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-04
															</a>
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Presupuesto Resumen"  href="<?= site_url('Expediente_Tecnico/reportePdfPresupuestoFF05?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-05
															</a>
															<a style="background-color: #f3632e;" class="btn btn-app btn-box" data-toggle="tooltip" title="Cuadro de Presupuesto Analítico General" href="<?= site_url('Expediente_Tecnico/reportePdfPresupuestoAnalitico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-06
															</a>
															<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Presupuesto General" href="<?= site_url('Expediente_Tecnico/reportePdfEjecucion007?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-07
															</a>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos Generales" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosGenerales?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-08
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos de Supervisión" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosSupervision?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-09
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos de Liquidación" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosLiquidacion?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FF-09B</span>
															</a>
															<!-- <a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Sustentación de Metrados" href="<?= site_url('Expediente_Tecnico/reportePdfMetrado?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-10
															</a> -->
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Análisis de Costos Unitarios" onclick="listaComponenteAnalisis('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-11
															</a>
															<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Relación de Insumos del Costo Directo" href="<?= site_url('Expediente_Tecnico/reporteListaInsumos?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-12
															</a>
															<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Herramientas" href="<?= site_url('Expediente_Tecnico/reporteDesagHerramientas?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-13
															</a>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Ejecución" href="<?= site_url('Expediente_Tecnico/cronogramaEjecucionProyecto?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-14
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma Valorizado de Ejecución del Proyecto" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionEjecucion?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-15
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Materiales" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=1');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-16
															</a>
															<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Maquinaria y Equipo" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=3');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-17
															</a>
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Mano de Obra" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=2');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-18
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabAprobacion" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Visto Bueno del E.T.', { id_ExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/Expediente_Tecnico/vistoBueno','GET', null, null, false, true); return false;"  class="tag">
																	<span>Visto Bueno</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Visto Bueno del E.T.', { id_ExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/Expediente_Tecnico/vistoBueno','GET', null, null, false, true); return false;" >1.- Dar Visto Bueno al Expediente Técnico</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">CRAET es encargado de dar visto bueno al Expediente técnico </p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Aprobar Expediente Técnico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/Expediente_Tecnico/clonar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Aprobar E.T</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Aprobar Expediente Técnico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/Expediente_Tecnico/clonar', 'GET', null, null, false, true); return false;">2.- Aprobar Expediente Técnico</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe registrar la fecha de resolución y adjuntar el acta de aprobación de Expediente Técnico</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabDatosGenerales" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="text-align: center;padding-top:28px;">
													<div>
														<a class="btn btn-app" data-toggle="tooltip" title="Detalle del Expediente" onclick="paginaAjaxDialogo(null, 'Detalle de expediente técnico',{id_et:'<?=$ExpedienteTecnicoElaboracion[0]->id_et?>'}, base_url+'index.php/Expediente_Tecnico/DetalleExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-list-ul"></i> Detalle
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Responsables" onclick="paginaAjaxDialogo(null, 'Listar Responsables del Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ResponsableExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-users"></i> Responsable
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Documentos" onclick="paginaAjaxDialogo(null, 'Listar Documentos',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/DocumentoExpediente', 'GET', null, null, false, true);" >
															<i class="fa fa-file-pdf-o"></i> Documento
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Reporte Estadístico" href="<?= site_url('Expediente_Tecnico/ReporteEstadistico?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>
															<i class="fa fa-area-chart"></i> Reporte
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Repositorio"  href="<?= site_url('elfiles/elfinder_files?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et.'&mod=ET');?>" target='_blank'>
															<i class="fa fa-hdd-o"></i> Repositorio
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<?php }
					if($aprobado=='1') { ?>

					<div class="" role="tabpanel" data-example-id="togglable-tabs">
                    	<ul id="myTab" class="nav nav-tabs" role="tablist">
                        	<li style="width:15%;"  role="presentation" class="active">
								<a href="#tabFormatos"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b> Expediente Técnico</b></a>
                            </li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabDetalles" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Datos Generales</b></a>
							</li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tabFormatos" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div class="row"  style="margin-right:-15px;margin-left:-15px;">
													<div class="col-md-12" style="text-align: center; display: inline-block;">
														<div>
															<h6><span>Formatos de Expediente Técnico</span></h6>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ficha Técnica del Proyectos" href="<?= site_url('Expediente_Tecnico/reportePdfExpedienteTecnico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																<i class="fa fa-file-pdf-o"></i> Formato FF-01
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Memoria Descriptiva del Proyecto" onclick="mostrarMemoriaDescritiva('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>','<?=@$ExpedienteTecnicoElaboracion[0]->url_memoria_descriptiva?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-02
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box" data-toggle="tooltip" title="Evaluación del Impacto Ambiental" onclick="mostrarImpactoAmbiental('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>','<?=@$ExpedienteTecnicoElaboracion[0]->url_impacto_ambiental?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-03
															</a>
															<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Especificaciones Técnicas" onclick="listaComponente('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-04
															</a>
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Presupuesto Resumen"  href="<?= site_url('Expediente_Tecnico/reportePdfPresupuestoFF05?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-05
															</a>
															<a style="background-color: #f3632e;" class="btn btn-app btn-box" data-toggle="tooltip" title="Cuadro de Presupuesto Analítico General" href="<?= site_url('Expediente_Tecnico/reportePdfPresupuestoAnalitico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-06
															</a>
															<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Presupuesto General" href="<?= site_url('Expediente_Tecnico/reportePdfEjecucion007?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-07
															</a>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos Generales" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosGenerales?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-08
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos de Supervisión" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosSupervision?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-09
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Gastos de Liquidación" href="<?= site_url('Expediente_Tecnico/reporteDesagGastosLiquidacion?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FF-09B</span>
															</a>
															<!-- <a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Sustentación de Metrados" href="<?= site_url('Expediente_Tecnico/reportePdfMetrado?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-10
															</a> -->
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Análisis de Costos Unitarios" onclick="listaComponenteAnalisis('<?=@$ExpedienteTecnicoElaboracion[0]->id_et?>')">
																<i class="fa fa-file-pdf-o"></i> Formato FF-11
															</a>
															<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Relación de Insumos del Costo Directo" href="<?= site_url('Expediente_Tecnico/reporteListaInsumos?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-12
															</a>
															<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Desagregado de Herramientas" href="<?= site_url('Expediente_Tecnico/reporteDesagHerramientas?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-13
															</a>
															<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Ejecución" href="<?= site_url('Expediente_Tecnico/cronogramaEjecucionProyecto?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-14
															</a>
															<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma Valorizado de Ejecución del Proyecto" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionEjecucion?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-15
															</a>
															<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Materiales" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=1');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-16
															</a>
															<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Maquinaria y Equipo" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=3');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-17
															</a>
															<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cronograma de Requerimiento de Mano de Obra" href="<?= site_url('ET_RelacionInsumo/ReportePdfCronogramaRequerimiento?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et.'&id_recurso=2');?>" target="_blank">
																<i class="fa fa-file-pdf-o"></i> Formato FF-18
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabDetalles" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
											<div class="x_content">
												<div style="text-align: center;padding-top:28px;padding-bottom:10px;">
													<div>
														<a class="btn btn-app" data-toggle="tooltip" title="Detalle del Expediente" onclick="paginaAjaxDialogo(null, 'Detalle de expediente técnico',{id_et:'<?=$ExpedienteTecnicoElaboracion[0]->id_et?>'}, base_url+'index.php/Expediente_Tecnico/DetalleExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-list-ul"></i> Detalle
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Responsables" onclick="paginaAjaxDialogo(null, 'Listar Responsables del Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ResponsableExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-users"></i> Responsable
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Documentos" onclick="paginaAjaxDialogo(null, 'Listar Documentos',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/DocumentoExpediente', 'GET', null, null, false, true);" >
															<i class="fa fa-file-pdf-o"></i> Documento
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Reporte Estadístico" href="<?= site_url('Expediente_Tecnico/ReporteEstadistico?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>
															<i class="fa fa-area-chart"></i> Reporte
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Repositorio"  href="<?= site_url('elfiles/elfinder_files?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et.'&mod=ET');?>" target='_blank'>
															<i class="fa fa-hdd-o"></i> Repositorio
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
				    <?php } }  ?>
					<?php if($ExpedienteTecnicoElaboracion[0]->id_etapa_et==10) { ?>
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
                    	<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li style="width:15%;"  role="presentation" class="active">
								<a href="#tabModificatoria"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b> Etapas de Ejecución</b></a>
                            </li>
                        	<li style="width:15%;"  role="presentation" class="">
								<a href="#tabSeguimiento"  id="profile-tab" role="tab" data-toggle="tab" aria-expanded="false"><b> Plan de Trabajo</b></a>
                            </li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabExpedienteTecnico" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Ejecución</b></a>
							</li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabDatosGenerales" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Datos Generales</b></a>
							</li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tabModificatoria" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
													<?php foreach ($listaContraActual as $key => $value) {?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>' class="tag">
																	<span>Contractual</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>'>Expediente Contractual</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"></p>
																	<?php if($value->aprobado){?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-default btn-sm">
																	<?php } else {?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-info btn-sm">
																	<?php }?>
																	<span>Crear Modificatoria</span>
																	</a>
																	
																</div>
																
															</div>
														</li>
														<?php }?>
														<?php foreach ($listaModificatoria as $key => $value) {?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>' class="tag">
																	<span><?=$value->descripcion_modificatoria?></span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title"><?=$value->descripcion_modificatoria?></a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"></p>
																	<?php if($value->aprobado){?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-default btn-sm">
																	<?php } else {?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-info btn-sm">
																	<?php }?>
																	<span>Crear Modificatoria</span>
																	</a>
																</div>
															</div>
														</li>
														<?php }?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabSeguimiento" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;" class="tag">
																	<span>Actividades</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">1.- Gestión y Asignación de Actividades</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro del Plan de Trabajo del Expediente Técnico a ser elaborado,
																	Asignar responsables a la actividades y registrar el avance de estas según lo programado.
																	El CRAET es responsable del registro de observaciones</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabExpedienteTecnico" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<?php if($aprobado!=1) { ?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Editar Ficha Técnica',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Ficha Técnica</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Editar Ficha Técnica',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;">1.- Ficha Técnica del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro de la Ficha Técnica del proyecto, responsables del Expediente técnico.</p>
																</div>
															</div>
														</li>
														<?php } ?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Agregar Periodo de Ejecucion',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/ET_Periodo_Ejecucion/insertar', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Ver plazo de Ejecución</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Definir Periodo de Ejecucion',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/ET_Periodo_Ejecucion/insertar', 'GET', null, null, false, true);return false;" >2.- Plazo de Ejecución del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro de la Fecha de inicio y fecha final de Ejecucion del proyecto para el registro de Cronograma valorizado de Ejecución.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Presupuesto Analítico</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;">3.- Asignación de Clasificador a costos del proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"> Se debe asignar el clasificador presupuestal al costo que se esta realizando.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>ver C,M,P</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;">4.- Analítico del Presupuesto General </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detallara el presupuesto general del proyecto a nivel de Componentes, Metas y Partidas en Costos Directos e Indirectos. Tambien se podra definir el Analisis de los costos unitarios de cada partida.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo('adicionalObra', 'Adicionales de Obra', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_AdicionalObra/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Adicionales</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo('adicionalObra', 'Adicionales de Obra', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_AdicionalObra/insertar', 'GET', null, null, false, true); return false;">5.- Adicionales de Obra </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra las prestaciones que no se encuentran considerados en el expediente técnico;  cuya realización resulta indispensable para dar cumplimiento a la meta de la obra principal</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Cronograma_Ejecucion/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;"  class="tag">
																	<span>Cronogramación</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Cronograma_Ejecucion/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">6.- Cronograma valorizado de ejecución del proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se realiza una programación del presupuesto a nivel de costos directos e indirectos.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Expediente_Tecnico/ControlMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'  class="tag">
																	<span>Ejecución Diaria.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Expediente_Tecnico/ControlMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>7.- Ejecución Diaria de Metrados.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra la ejecución diaria de metrados para la valorización mensual</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Expediente_Tecnico/ValorizacionFisicaMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'  class="tag">
																	<span>Valorización Mensual.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Expediente_Tecnico/ValorizacionFisicaMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>8.- Valorización Mensual.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Búsqueda de los informes de valorización mensual.</p>
																</div>
															</div>
														</li>
														<li>
															 <div class="block">
																<div class="tags">
																	<a href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Informe Mensual.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">9.- Informe Mensual.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Para el informe mensual se debe registrar como mínimo, información de las actividades técnicas, económicas y administrativas de loss proyectos.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('Manifiesto_Gasto/insertar?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Manifiesto de Gasto</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/insertar?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">10.- Manifiesto de Gastos </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra el manifiesto de gasto mensual por fuente de financiamiento</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Ejecución Presupuestal</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">11.- Ejecución Presupuestal  </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detalla los expedientes por especifica de gasto y fuente de financiamiento</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Programación de Presupuesto por Clasificador</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">12.- Programación de Presupuesto por Clasificador  </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se realiza la programación por especifica de gasto y fuente de financiamiento para el cuadro comparativo del presupuesto aprobado y ejecutado</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('ET_Maquinaria/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Maquinaria</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('ET_Maquinaria/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">13.- Registro de Maquinaria</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra las horas trabajadas de una maquinaria propia o alquilada</p>
																</div>
															</div>
														</li> 
														 <!-- <li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('ET_Almacen/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Almacen</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('ET_Almacen/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">14.- Gestión de Almacen</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra el movimiento diario de almacen</p>
																</div>
															</div> -->
														</li> 
													</ul>
												</div>
												<div class="row">
													<div class="col-md-12" style="text-align: center; display: inline-block;">
														<?php if($ExpedienteTecnicoElaboracion[0]->id_etapa_et == 2 || $ExpedienteTecnicoElaboracion[0]->id_etapa_et == 3 || $ExpedienteTecnicoElaboracion[0]->id_etapa_et == 10)
														{ ?>
															<div>
																<h6><span>Formatos de Ejecución</span></h6>
																<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ficha Técnica del Proyectos" href="<?= site_url('Expediente_Tecnico/reportePdfExpedienteTecnico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FF-01
																</a>
																<a style="background-color: #e73e3a;" href="#" data-toggle="modal" id="feedback" data-target="#feedback-modal" title="Ficha Técnica del Proyecto" class="btn btn-app btn-box">
																	<i class="fa fa-file-pdf-o"></i> Formato FE-01
																</a>
																 <a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Informe Mensual" href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-02
																</a>
																<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion Mensual" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionFisica?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-03
																</a> 
																<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Adicionales de Obra" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionFisicaAdicionales?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04A</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Mayores Metrados" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionMayorMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04B</span>
																</a>
																<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionDeductivo?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04C</span>
																</a>
																<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ejecución Presupuestal Mensual" href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-05
																</a>
																<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cuadro Comparativo del Presupuesto Analitico Aprobado y Ejecutado" href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-06
																</a>

																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Resumen de Horas Maquinaria" href="<?= site_url('ET_Maquinaria/reportePdf?query='.$ExpedienteTecnicoElaboracion[0]->id_et.'&form=fe10');?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-10
																</a>
																															
																<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Consumo de Combustible, Lubricante, Repuesto y Otros" href="<?= site_url('Expediente_Tecnico/formatoFE11?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-11
																</a>
																<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Adicionales de Obra" href="<?= site_url('Expediente_Tecnico/formatoFE12?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-12</span>
																</a>
																<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Mayores Metrados" href="<?= site_url('Expediente_Tecnico/formatoFE13?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-13</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE14?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-14</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE15?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-15</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE16?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-16</span>
																</a>

															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabDatosGenerales" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="text-align: center;padding-top:28px;">
													<div>
														<a class="btn btn-app" data-toggle="tooltip" title="Detalle del Expediente" onclick="paginaAjaxDialogo(null, 'Detalle de expediente técnico',{id_et:'<?=$ExpedienteTecnicoElaboracion[0]->id_et?>'}, base_url+'index.php/Expediente_Tecnico/DetalleExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-list-ul"></i> Detalle
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Responsables" onclick="paginaAjaxDialogo(null, 'Listar Responsables del Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ResponsableExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-users"></i> Responsable
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Documentos" onclick="paginaAjaxDialogo(null, 'Listar Documentos',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/DocumentoExpediente', 'GET', null, null, false, true);" >
															<i class="fa fa-file-pdf-o"></i> Documento
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Reporte Estadístico" href="<?= site_url('Expediente_Tecnico/ReporteEstadistico?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>
															<i class="fa fa-area-chart"></i> Reporte
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Repositorio"  href="<?= site_url('elfiles/elfinder_files?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et.'&mod=ET');?>" target='_blank'>
															<i class="fa fa-hdd-o"></i> Repositorio
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<?php } ?>
					<?php if($ExpedienteTecnicoElaboracion[0]->id_etapa_et==3) { ?>
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
                    	<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li style="width:15%;"  role="presentation" class="active">
								<a href="#tabModificatoria"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b> Etapas de Ejecución</b></a>
                            </li>
                        	<li style="width:15%;"  role="presentation" class="">
								<a href="#tabSeguimiento"  id="profile-tab" role="tab" data-toggle="tab" aria-expanded="false"><b> Plan de Trabajo</b></a>
                            </li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabExpedienteTecnico" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Ejecución</b></a>
							</li>
							<li style="width:15%;" role="presentation" class="">
								<a href="#tabDatosGenerales" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Datos Generales</b></a>
							</li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
						<div role="tabpanel" class="tab-pane fade active in" id="tabModificatoria" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
													<?php foreach ($listaContraActual as $key => $value) {?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>' class="tag">
																	<span>Contractual</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>'>Expediente Contractual</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"></p>
																	<?php if($value->aprobado){?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-default btn-sm">
																	<?php } else {?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-info btn-sm">
																	<?php }?>
																	<span>Crear Modificatoria</span>
																	</a>
																</div>
																
															</div>
														</li>
														<?php }?>
														<?php foreach ($listaModificatoria as $key => $value) {?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href='<?=base_url();?>Expediente_Tecnico/verdetalle?id_et=<?=$value->id_et?>' class="tag">
																	<span><?=$value->descripcion_modificatoria?></span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title"><?=$value->descripcion_modificatoria?></a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"></p>
																	<?php if($value->aprobado){?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-default btn-sm">
																	<?php } else {?>
																	<a href="" onclick="paginaAjaxDialogo(null, 'Crear Modificatoria', { idExpedienteTecnico : <?=$value->id_et?> }, base_url+'index.php/Expediente_Tecnico/crearModificatoria', 'GET', null, null, false, true); return false;" class="btn btn-info btn-sm">
																	<?php }?>
																	<span>Crear Modificatoria</span>
																	</a>
																</div>
															</div>
														</li>
														<?php }?>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabSeguimiento" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;" class="tag">
																	<span>Actividades</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Tarea/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">1.- Gestión y Asignación de Actividades</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro del Plan de Trabajo del Expediente Técnico a ser elaborado,
																	Asignar responsables a la actividades y registrar el avance de estas según lo programado.
																	El CRAET es responsable del registro de observaciones</p>
																</div>
															</div>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabExpedienteTecnico" aria-labelledby="profile-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="x_panel">
											<div class="x_content">
												<div style="padding-top:20px;padding-bottom:20px;">
													<ul class="list-unstyled timeline">
														<?php if($aprobado!=1) { ?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Editar Ficha Técnica',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Ficha Técnica</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Editar Ficha Técnica',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/editar', 'GET', null, null, false, true);return false;">1.- Ficha Técnica del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span> <a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro de la Ficha Técnica del proyecto, responsables del Expediente técnico.</p>
																</div>
															</div>
														</li>
														<?php } ?>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Agregar Periodo de Ejecucion',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/ET_Periodo_Ejecucion/insertar', 'GET', null, null, false, true);return false;" class="tag">
																	<span>Ver plazo de Ejecución</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Definir Periodo de Ejecucion',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/ET_Periodo_Ejecucion/insertar', 'GET', null, null, false, true);return false;" >2.- Plazo de Ejecución del Proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se debe realizar el registro de la Fecha de inicio y fecha final de Ejecucion del proyecto para el registro de Cronograma valorizado de Ejecución.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Presupuesto Analítico</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Presupuesto analítico', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Presupuesto_Analitico/insertar', 'GET', null, null, false, true); return false;">3.- Asignación de Clasificador a costos del proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt"> Se debe asignar el clasificador presupuestal al costo que se esta realizando.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>ver C,M,P</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true); return false;">4.- Analítico del Presupuesto General </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detallara el presupuesto general del proyecto a nivel de Componentes, Metas y Partidas en Costos Directos e Indirectos. Tambien se podra definir el Analisis de los costos unitarios de cada partida.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="paginaAjaxDialogo('adicionalObra', 'Adicionales de Obra', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_AdicionalObra/insertar', 'GET', null, null, false, true); return false;" class="tag">
																	<span>Adicionales</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="paginaAjaxDialogo('adicionalObra', 'Adicionales de Obra', { idExpedienteTecnico : <?=$ExpedienteTecnicoElaboracion[0]->id_et?> }, base_url+'index.php/ET_AdicionalObra/insertar', 'GET', null, null, false, true); return false;">5.- Adicionales de Obra </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra las prestaciones que no se encuentran considerados en el expediente técnico;  cuya realización resulta indispensable para dar cumplimiento a la meta de la obra principal</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Cronograma_Ejecucion/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;"  class="tag">
																	<span>Cronogramación</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="" onclick="window.open(base_url+'index.php/ET_Cronograma_Ejecucion/index?id_et=<?=$ExpedienteTecnicoElaboracion[0]->id_et?>', '_blank'); return false;">6.- Cronograma valorizado de ejecución del proyecto</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se realiza una programación del presupuesto a nivel de costos directos e indirectos.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Expediente_Tecnico/ControlMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'  class="tag">
																	<span>Ejecución Diaria.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Expediente_Tecnico/ControlMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>7.- Ejecución Diaria de Metrados.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra la ejecución diaria de metrados para la valorización mensual</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Expediente_Tecnico/ValorizacionFisicaMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'  class="tag">
																	<span>Valorización Mensual.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Expediente_Tecnico/ValorizacionFisicaMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>8.- Valorización Mensual.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Búsqueda de los informes de valorización mensual.</p>
																</div>
															</div>
														</li>
														<li>
															 <div class="block">
																<div class="tags">
																	<a href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Informe Mensual.</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">9.- Informe Mensual.</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Para el informe mensual se debe registrar como mínimo, información de las actividades técnicas, económicas y administrativas de loss proyectos.</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('Manifiesto_Gasto/insertar?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Manifiesto de Gasto</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/insertar?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">10.- Manifiesto de Gastos </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra el manifiesto de gasto mensual por fuente de financiamiento</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Ejecución Presupuestal</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">11.- Ejecución Presupuestal  </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se detalla los expedientes por especifica de gasto y fuente de financiamiento</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Programación de Presupuesto por Clasificador</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">12.- Programación de Presupuesto por Clasificador  </a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se realiza la programación por especifica de gasto y fuente de financiamiento para el cuadro comparativo del presupuesto aprobado y ejecutado</p>
																</div>
															</div>
														</li>
														<li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('ET_Maquinaria/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Maquinaria</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('ET_Maquinaria/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">13.- Registro de Maquinaria</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra las horas trabajadas de una maquinaria propia o alquilada</p>
																</div>
															</div>
														</li> 
														 <!-- <li>
															<div class="block">
																<div class="tags">
																	<a href="<?=site_url('ET_Almacen/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" class="tag">
																	<span>Almacen</span>
																	</a>
																</div>
																<div class="block_content">
																	<h2 class="title">
																	<a href="<?=site_url('ET_Almacen/index?query='.$ExpedienteTecnicoElaboracion[0]->id_et);?>">14.- Gestión de Almacen</a>
																	</h2>
																	<div class="byline">
																		<span></span><a></a>
																	</div>
																	<p class="excerpt">Se registra el movimiento diario de almacen</p>
																</div>
															</div> -->
														</li> 
													</ul>
												</div>
												<div class="row">
													<div class="col-md-12" style="text-align: center; display: inline-block;">
														<?php if($ExpedienteTecnicoElaboracion[0]->id_etapa_et == 2 || $ExpedienteTecnicoElaboracion[0]->id_etapa_et == 3 || $ExpedienteTecnicoElaboracion[0]->id_etapa_et == 10)
														{ ?>
															<div>
																<h6><span>Formatos de Ejecución</span></h6>
																<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ficha Técnica del Proyectos" href="<?= site_url('Expediente_Tecnico/reportePdfExpedienteTecnico?id_et='.@$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FF-01
																</a>
																<a style="background-color: #e73e3a;" href="#" data-toggle="modal" id="feedback" data-target="#feedback-modal" title="Ficha Técnica del Proyecto" class="btn btn-app btn-box">
																	<i class="fa fa-file-pdf-o"></i> Formato FE-01
																</a>
																 <a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Informe Mensual" href="<?=site_url('Expediente_Tecnico/InformeMensual?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-02
																</a>
																<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion Mensual" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionFisica?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-03
																</a> 
																<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Adicionales de Obra" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionFisicaAdicionales?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04A</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Mayores Metrados" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionMayorMetrado?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04B</span>
																</a>
																<a style="background-color: #0976b4;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/reportePdfValorizacionDeductivo?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-04C</span>
																</a>
																<a style="background-color: #fd9b15;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Ejecución Presupuestal Mensual" href="<?= site_url('Manifiesto_Gasto/busquedaEjecucionPresupuestal?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-05
																</a>
																<a style="background-color: #e73e3a;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Cuadro Comparativo del Presupuesto Analitico Aprobado y Ejecutado" href="<?= site_url('Manifiesto_Gasto/programacionClasificador?idExpedienteTecnico='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-06
																</a>

																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Resumen de Horas Maquinaria" href="<?= site_url('ET_Maquinaria/reportePdf?query='.$ExpedienteTecnicoElaboracion[0]->id_et.'&form=fe10');?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-10
																</a>
																															
																<a style="background-color: #5cb360;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Consumo de Combustible, Lubricante, Repuesto y Otros" href="<?= site_url('Expediente_Tecnico/formatoFE11?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i> Formato FE-11
																</a>
																<a style="background-color: #a200f9;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Adicionales de Obra" href="<?= site_url('Expediente_Tecnico/formatoFE12?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-12</span>
																</a>
																<a style="background-color: #11b8cc;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Mayores Metrados" href="<?= site_url('Expediente_Tecnico/formatoFE13?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-13</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE14?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-14</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE15?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-15</span>
																</a>
																<a style="background-color: #f3632e;" class="btn btn-app btn-box"  data-toggle="tooltip" title="Valorizacion de Deductivos" href="<?= site_url('Expediente_Tecnico/formatoFE16?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target="_blank" >
																	<i class="fa fa-file-pdf-o"></i><span style="font-size:10px;">Formato FE-16</span>
																</a>

															</div>
														<?php } ?>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tabDatosGenerales" aria-labelledby="home-tab">
                                <div class="row">
									<div class="col-md-12 col-sm-12 col-xs-12">
										<div class="x_panel">
											<div class="x_content">
												<div style="text-align: center;padding-top:28px;">
													<div>
														<a class="btn btn-app" data-toggle="tooltip" title="Detalle del Expediente" onclick="paginaAjaxDialogo(null, 'Detalle de expediente técnico',{id_et:'<?=$ExpedienteTecnicoElaboracion[0]->id_et?>'}, base_url+'index.php/Expediente_Tecnico/DetalleExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-list-ul"></i> Detalle
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Responsables" onclick="paginaAjaxDialogo(null, 'Listar Responsables del Expediente Técnico',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/ResponsableExpediente', 'POST', null, null, false, true);" >
															<i class="fa fa-users"></i> Responsable
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Documentos" onclick="paginaAjaxDialogo(null, 'Listar Documentos',{ id_et: '<?=$ExpedienteTecnicoElaboracion[0]->id_et?>' }, base_url+'index.php/Expediente_Tecnico/DocumentoExpediente', 'GET', null, null, false, true);" >
															<i class="fa fa-file-pdf-o"></i> Documento
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Reporte Estadístico" href="<?= site_url('Expediente_Tecnico/ReporteEstadistico?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et);?>" target='_blank'>
															<i class="fa fa-area-chart"></i> Reporte
														</a>
														<a class="btn btn-app" data-toggle="tooltip" title="Repositorio"  href="<?= site_url('elfiles/elfinder_files?id_et='.$ExpedienteTecnicoElaboracion[0]->id_et.'&mod=ET');?>" target='_blank'>
															<i class="fa fa-hdd-o"></i> Repositorio
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </div>
					<?php } ?>
                </div>
			</div>
		</div>
	</div>
</div>

<?php
$sessionTempCorrecto=$this->session->flashdata('correcto');
$sessionTempError=$this->session->flashdata('error');

if($sessionTempCorrecto){ ?>
	<script>
	$(document).ready(function()
	{
		swal('','<?=$sessionTempCorrecto?>', "success");
	});
	</script>
<?php }

if($sessionTempError){ ?>
<script>
	$(document).ready(function()
	{
	swal('','<?=$sessionTempError?>', "error");
	});
</script>
<?php } ?>
<script>

function Eliminar(id_et)
{
	swal({
		title: "Esta seguro que desea eliminar el Expediente Técnico, ya que se eliminara también los responsables y sus imagenes?",
		text: "",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "SI,ELIMINAR",
		cancelButtonText:"CERRAR",
		closeOnConfirm: false
	},
	function()
	{
		$.ajax({
			url:base_url+"index.php/Expediente_Tecnico/eliminar",
			type:"POST",
			data:{id_et:id_et},
			success:function(respuesta)
			{
				var object = JSON.parse(respuesta);
				if(<?=$ExpedienteTecnicoElaboracion[0]->id_etapa_et?> == 1)
				{
					(object.proceso == 'Error' ? swal(object.proceso,object.mensaje, "error") : swal(object.proceso,object.mensaje, "success"));
					window.location.href='<?=base_url();?>index.php/Expediente_Tecnico/index/';
					renderLoading();
				}
				if(<?=$ExpedienteTecnicoElaboracion[0]->id_etapa_et?> == 3)
				{
					(object.proceso == 'Error' ? swal(object.proceso,object.mensaje, "error") : swal(object.proceso,object.mensaje, "success"));
					window.location.href='<?=base_url();?>index.php/Expediente_Tecnico/ejecucion/';
					renderLoading();
				}
			}
		});
	});
}

$(document).on('hidden.bs.modal', '.modal', function ()
{
    if ($('body').find('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});

function mostrarMemoriaDescritiva(idExpediente,url)
{
	if(url=='')
	{
		swal("Error", "Aún no se ha subido la memoria Descriptiva", "error");
		return;
	}
	window.open('<?=base_url();?>uploads/MemoriaDescriptiva/'+idExpediente+url,'_blank');
}

function mostrarImpactoAmbiental(idExpediente,url)
{
	if(url=='')
	{
		swal("Error", "Aún no se ha subido el archivo","error");
		return;
	}
	window.open('<?=base_url();?>uploads/ImpactoAmbiental/'+idExpediente+url,'_blank');
}

function listaComponente(idExpediente)
{
	paginaAjaxDialogo(null, 'Especificaciones Técnicas',{ idExpediente: idExpediente }, base_url+'index.php/ET_EspecificacionTecnica/FormatoEspecificacionTecnicaPorComponente', 'POST', null, null, false, true);
}

function listaComponenteAnalisis(idExpediente)
{
	paginaAjaxDialogo(null, 'Reporte de Análisis de Costos Unitarios',{ idExpediente: idExpediente }, base_url+'index.php/Expediente_Tecnico/reportePdfAnalisisPrecioUnitarioFF11', 'POST', null, null, false, true);
}
</script>

<div id="feedback-modal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Formato FE-01</h3>
			</div>
			<div class="modal-body">
				<form id="formAddDocumento" class="feedback" name="feedback">
					<div class="form-group">
						<input type="hidden" name="id_et" value="<?=$ExpedienteTecnicoElaboracion[0]->id_et?>">
						<table class="table">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Documentos</th>
							</tr>
							</thead>
							<tbody>
								<?php $counter = 1; ?>
								<?php if ( !empty($et_documentos) ): ?>
									<?php foreach ($et_documentos as $et_documento): ?>
									<tr>
										<th scope="row"><?php echo $counter++; ?></th>
											<td><label for="exampleFormControlFile1">📑 </label> <a href="<?php echo base_url(); ?>uploads/ActaDeEntrega/<?= $et_documento['filename'] ?>" target="_blank"><?= $et_documento['filename'] ?></a></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					<input type="file" class="form-control-file" id="inputFileDoc" name="inputFileDoc">
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" id="send" type="submit">Guardar</button>
						<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>

	$("#formAddDocumento").submit(function(event)
	{
		event.preventDefault();
		var formData=new FormData($("#formAddDocumento")[0]);
		$.ajax({
			url: base_url+"index.php/Expediente_Tecnico/insertActaEntregaTerreno",
			type:'POST',
			enctype: 'multipart/form-data',
			data:formData,
			cache: false,
			contentType:false,
			processData:false,
			success:function(resp)
			{
				$('feedback-modal').modal('hide');
				swal("Bien!", "Se registro correctamente!", "success");
			},
			error: function ()
			{
					swal("Error", "Usted no tiene permisos para realizar esta acción", "error");
			}
		});
	});

</script>
