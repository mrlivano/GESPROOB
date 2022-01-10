<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_title">
			<h2><b>Manifiesto de Gastos</b></h2>
			<div class="clearfix"></div>
		</div>
		<div class="x_content">   
			<form class="form-horizontal" action="<?php echo base_url();?>index.php/Manifiesto_Gasto/reportePdf" id="frmAgregarPeriodo" method="POST" target="_blank">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=@$idExpedienteTecnico?>">
						<div class="row" id="divBusquedaManifiesto">							
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
									<input type="hidden" id="hdFuenteFinanciamiento" name="hdFuenteFinanciamiento">
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
										<?php foreach($mes as $key => $value) { ?>
										<option value="<?=$value?>"><?=$key?></option>
										<?php } ?>
									</select>
								</div>	
							</div>	
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label class="control-label">.</label>
								<div>       
									<input style="width:100%;" type="button" class="btn btn-default" value="Buscar" onclick="buscarManifiesto();">
								</div>		
							</div>
							<div class="col-md-2 col-sm-2 col-xs-12">
								<label class="control-label">.</label>
								<div> 
									<input style="width:100%;" type="button" class="btn btn-warning" value="Exportar a PDF" onclick="exportarPDF();">
								</div>		
							</div>		
						</div>
					</div>
				</div>
			</form>
			<br>
			<div class="table-responsive">
				<div id="contenedorManifiestoGasto"></div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function()
	{
		$('#divBusquedaManifiesto').formValidation(
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
							message: '<b style="color: red;">El campo "Meta Presupuestal" es requerido.</b>'
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
					htmlTemp+='<option value="TODOS">TODOS</option>';
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

		$("#selectFuenteFinanciamiento").change(function()
		{
			var fuenteFinanciamiento=$(this).find("option:selected").text();
			$('#hdFuenteFinanciamiento').val(fuenteFinanciamiento);
		});

		$("#selectMes").change(function()
		{
			var mes=$(this).find("option:selected").text();
			$('#hdMes').val(mes);
		});
	});

	function buscarManifiesto()
	{	
		event.preventDefault();
        $('#divBusquedaManifiesto').data('formValidation').validate();
		if(!($('#divBusquedaManifiesto').data('formValidation').isValid()))
		{
			return;
		}		
		var idExpedienteTecnico=$('#hdIdExpedienteTecnico').val();
		var metaPresupuestal=$('#selectMetaPresupuestal').val();
		var fuenteFinanciamiento=$('#selectFuenteFinanciamiento').val();
		var mes=$('#selectMes').val();
        $.ajax({
            type:"POST",
            url:base_url+"index.php/Manifiesto_Gasto/busquedaManifiesto",
            data: 
			{
				idExpedienteTecnico:idExpedienteTecnico,
				metaPresupuestal:metaPresupuestal,
				fuenteFinanciamiento:fuenteFinanciamiento,
				mes:mes
			},
            cache: false,
            beforeSend:function() 
			{
            	renderLoading();
		    },
            success:function(objectJSON)
            {
				$('#divModalCargaAjax').hide();
				$('#contenedorManifiestoGasto').html(objectJSON);
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
	}

	function exportarPDF()
	{
		event.preventDefault();
        $('#divBusquedaManifiesto').data('formValidation').validate();
		if(!($('#divBusquedaManifiesto').data('formValidation').isValid()))
		{
			return;
		}
		$('#frmAgregarPeriodo').submit();
	}
</script>