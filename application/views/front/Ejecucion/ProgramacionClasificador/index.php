<style>
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
    color: #131010;
    background-color: #f1f1f1;
}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>INFORMACIÓN FINANCIERA</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
					<div class="" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active">
								<a href="#tab_cronograma"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Porgramación de Analitico</a>
							</li>
							<li role="presentation">
								<a href="#tab_comparacion"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Comparación de Cuadros</a>
							</li>
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade active in" id="tab_cronograma" aria-labelledby="home-tab">
								<br>
								<form class="form-horizontal" id="frmAgregarPeriodo" method="POST">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=@$idExpedienteTecnico?>">
											<div class="row" id="divEjecucionPresupuestal">
												<div class="col-md-2 col-sm-4 col-xs-12">
													<label class="control-label">Meta:</label>
													<div>
													<select id="selectMetaPresupuestal" name="selectMetaPresupuestal" class="form-control">
														<option value="">--Seleccionar--</option>
														<?php foreach($metaPresupuestal as $key => $value) { ?>
														<option value="<?=$value->sec_ejec?>-<?=$value->ano_eje?>-<?=$value->sec_func?>"><?=(int)$value->sec_ejec?>-<?=$value->ano_eje?>-<?=(int) $value->sec_func?></option>
														<?php } ?>
													</select>
													</div>	
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<label class="control-label">Fuente de Financiamiento:</label>
													<div>
													<select id="selectFuente" name="selectFuente" class="form-control">
													</select>
													</div>	
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<label class="control-label">.</label>
													<div>       
														<input style="width:100%;" type="button" class="btn btn-warning" value="Buscar" onclick="busquedaProgramacionAnalitico();">
													</div>		
												</div>	
											</div>
										</div>
									</div>
								</form>
								<br>
								<div class="table-responsive">
									<div id="contenedorProgramacion"></div>				
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade" id="tab_comparacion" aria-labelledby="home-tab">								
								<br>
								<form class="form-horizontal" id="frmCuadroComparativo" action="<?php echo base_url();?>index.php/Manifiesto_Gasto/reportePdfCuadro" method="POST" target="_blank">
									<div class="row">
										<div class="col-md-12 col-sm-12 col-xs-12">
											<input type="hidden" name="hdIdExpediente" id="hdIdExpediente" value="<?=@$idExpedienteTecnico?>">
											<div class="row" id="divCuadroComparativo">
												<div class="col-md-2 col-sm-4 col-xs-12">
													<label class="control-label">Meta:</label>
													<div>
													<select id="selectMeta" name="selectMeta" class="form-control">
														<option value="">--Seleccionar--</option>
														<?php foreach($metaPresupuestal as $key => $value) { ?>
														<option value="<?=$value->sec_ejec?>-<?=$value->ano_eje?>-<?=$value->sec_func?>"><?=(int)$value->sec_ejec?>-<?=$value->ano_eje?>-<?=(int) $value->sec_func?></option>
														<?php } ?>
													</select>
													</div>	
												</div>
												<div class="col-md-4 col-sm-4 col-xs-12">
													<label class="control-label">Fuente de Financiamiento:</label>
													<div>
													<select id="selectFuenteFinanciamiento" name="selectFuenteFinanciamiento" class="form-control">
													</select>
													</div>	
												</div>
												<div class="col-md-2 col-sm-4 col-xs-12">
													<label class="control-label">Mes:</label>
													<div>
													<input type="hidden" id="hdMes" name="hdMes">	
													<select id="selectMes" name="selectMes" class="form-control">
														<option value="">--Seleccionar--</option>
														<?php foreach($listaMeses as $key => $value) { ?>
														<option value="<?=$value?>"><?=$key?></option>
														<?php } ?>
													</select>
													</div>	
												</div>
												<div class="col-md-2 col-sm-2 col-xs-12">
													<label class="control-label">.</label>
													<div>       
														<input style="width:100%;" type="button" class="btn btn-default" value="Buscar" onclick="busquedaCuadroComparativo();">
													</div>		
												</div>	
												<div class="col-md-2 col-sm-2 col-xs-12">
													<label class="control-label">.</label>
													<div>       
														<input style="width:100%;" type="button" class="btn btn-warning" value="Imprimir" onclick="ImprimirReporte();">
													</div>		
												</div>	
											</div>
										</div>
									</div>
								</form>
								<br>
								<div class="table-responsive">
									<div id="contenedorCuadroComparativo"></div>				
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
<script>
	$(function()
	{
		$('#divEjecucionPresupuestal').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectMetaPresupuestal:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Meta" es requerido.</b>'
						}
					}
				},
				selectFuente:	
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fuente de Financiamiento" es requerido.</b>'
						}
					}
				}
			}
		});

		$('#divCuadroComparativo').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectMeta:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Meta" es requerido.</b>'
						}
					}
				},
				selectFuenteFinanciamiento:	
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fuente de Financiamiento" es requerido.</b>'
						}
					}
				},
				selectMes:	
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Mes" es requerido.</b>'
						}
					}
				}		
			}
		});

		$("#selectMetaPresupuestal").change(function()
		{
			var metaPresupuestal=$('#selectMetaPresupuestal').val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Manifiesto_Gasto/listaFuenteFinanciamiento",
				data: 
				{
					metaPresupuestal:metaPresupuestal
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">--Seleccione--</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].fuente_financ+'>'+objectJSON[item].nombre+'</option>';
					}
					$('#selectFuente').html(htmlTemp);
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

		$("#selectMeta").change(function()
		{
			var metaPresupuestal=$('#selectMeta').val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Manifiesto_Gasto/listaFuenteFinanciamiento",
				data: 
				{
					metaPresupuestal:metaPresupuestal
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">--Seleccione--</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].fuente_financ+'>'+objectJSON[item].nombre+'</option>';
					}
					htmlTemp+='<option value="TODOS">RESUMEN CONSOLIDADO</option>';
					$('#selectFuenteFinanciamiento').html(htmlTemp);
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

		$("#selectMes").change(function()
		{
			var mes=$(this).find("option:selected").text();
			$('#hdMes').val(mes);
		});
	});

	function busquedaProgramacionAnalitico()
	{
		event.preventDefault();
        $('#divEjecucionPresupuestal').data('formValidation').validate();
		if(!($('#divEjecucionPresupuestal').data('formValidation').isValid()))
		{
			return;
		}
		var idExpedienteTecnico=$('#hdIdExpedienteTecnico').val();
		var metaPresupuestal=$('#selectMetaPresupuestal').val();
		var idFuenteEt=$('#selectFuente').val();
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Manifiesto_Gasto/programacionClasificador",
			data: 
			{
				idExpedienteTecnico:idExpedienteTecnico,				
				metaPresupuestal:metaPresupuestal,
				idFuenteEt:idFuenteEt
			},
			cache: false,
			beforeSend:function() 
			{
				renderLoading();
			},
			success:function(objectJSON)
			{
				$('#contenedorProgramacion').html(objectJSON);
				$('#divModalCargaAjax').hide();
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});		
	}

	function busquedaCuadroComparativo()
	{
		event.preventDefault();
        $('#divCuadroComparativo').data('formValidation').validate();
		if(!($('#divCuadroComparativo').data('formValidation').isValid()))
		{
			return;
		}
		var idExpediente=$('#hdIdExpediente').val();
		var metaPresupuestal=$('#selectMeta').val();
		var idFuenteEt=$('#selectFuenteFinanciamiento').val();
		var mes=$('#selectMes').val();
		$.ajax({
			type:"POST",
			url:base_url+"index.php/Manifiesto_Gasto/cuadroComparativo",
			data: 
			{
				idExpediente:idExpediente,				
				metaPresupuestal:metaPresupuestal,
				idFuenteEt:idFuenteEt,
				mes:mes
			},
			cache: false,
			beforeSend:function() 
			{
				renderLoading();
			},
			success:function(objectJSON)
			{
				$('#contenedorCuadroComparativo').html(objectJSON);
				$('#divModalCargaAjax').hide();
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});	
	}

	function ImprimirReporte()
	{
		event.preventDefault();
        $('#divCuadroComparativo').data('formValidation').validate();
		if(!($('#divCuadroComparativo').data('formValidation').isValid()))
		{
			return;
		}
		$('#frmCuadroComparativo').submit();
	}

</script>