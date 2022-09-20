<style>
	.informe
	{
		background-color:#fdfdfd;
		padding: 20px 30px;
		color:black;
		font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;		
		font-size:10px;
	}
	table
	{
		border-collapse: collapse;
		color:#35353e;
		width:100%;		
	}
	.tablastand td, .tablastand th
	{
		border:1px solid black;
		padding: 2px 5px;
		vertical-align: middle;		
	}
	.tablastand th
	{
		background-color:#f1f1f1;
		font-weight:bold;
	}
	.firstbox
	{
		margin: 0 0 10px;
	}
	.secondbox
	{
		margin: 5px 14px;
	}
	.thirdbox
	{
		margin: 0px 30px;
	}
	.firsttext
	{
		font-weight:bold;
	}
	.secondtext
	{
		text-decoration: underline;		
	}
	.tablacenter td, .tablacenter th
	{
		text-align:center;
	}
	.tablaMayuscula td, .tablacenter th
	{
		text-transform:uppercase;
	}
	.field:focus 
	{
    	border: 2px solid #2e6da4;		
	}	
</style>
<div class="informe">
	<form id="frmFichaInforme"  action="<?php echo base_url();?>index.php/ET_Detalle_Formato/reportePdf" method="POST" target="_blank">
	<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=$idExpedienteTecnico?>">
	<input type="hidden" name="hdMetaPresupuestal" id="hdMetaPresupuestal" value="<?=$metaPresupuestal?>">
	<input type="hidden" name="hdMes" id="hdMes" value="<?=$mes?>">
	<input type="hidden" name="hdFechaReporte" id="hdFechaReporte" value="<?=$fechaReporte?>">
	<input type="hidden" name="hdIdDetalleFormato" id="hdIdDetalleFormato" value="<?=@$detalleFormato[0]->id_detalle?>">			
	<div class="cuerpo">
		<table class="tablastand tablaMayuscula">
			<tr>
				<th>NOMBRE DEL PROYECTO</th>
				<td style="width:80%;"><?=@$proyectoInversion->nombre_pi?></td>
			</tr>
			<tr>
				<th>UNIDAD EJECUTORA</th>
				<td><?=@$proyectoInversion->nombre_ue?></td>
			</tr>
		</table>
		<br>
		
		<div class="firstbox">
			<div class="secondbox">
				<div class="secondcontent">
					<br>
					<table class="tablastand">
						<tr>
							<th>AVANCE FÍSICO</th>
							<td colspan="5">
								<div>
									<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->plazo_ejecucion_real?>" name="txtPlazoEjecReal" id="txtPlazoEjecReal" type="text">
								</div>
							</td>
						</tr>
						<tr>
							<th>AVANCE FINANCIERO</th>
							<td colspan="5">
								<div>
									<input class="form-control input-sm field" value="<?=@$detalleFormato[0]->plazo_ejecucion_real?>" name="txtPlazoEjecReal" id="txtPlazoEjecReal" type="text">
								</div>
							</td>
						</tr>
					</table>
					<br>
					<p>PROBLEMAS PRESENTADOS</p>
					<textarea style="resize: none;resize: vertical;" name="txtObservaciones" id="txtObservaciones" class="form-control field" rows="3" cols="50" placeholder="Observaciones y/o Comentarios"><?=@$detalleFormato[0]->descripcion_observaciones?></textarea>					
					<p class="secondtext">SUBIR INFORME</p>					
					<input type="button" class="btn btn-info" value="Agregar Informe" onclick="agregarFotografia('<?=@$detalleFormato[0]->id_detalle?>');">
					<input type="button" class="btn btn-warning" value="Exportar a PDF" onclick="exportarFicha();">	
				</div>					
			</div>
		</div>
	</div>
	<hr>
	<div style="float:right;">       
		<input style="width:100%;" type="button" class="btn btn-primary" value="Guardar Informe" onclick="guardarInformeMensual();">
	</div>	
	</form>
</div> 
<script>
	
	$(function()
	{
		$('input').attr('autocomplete', 'off');		
	});

    function guardarInformeMensual()
    {
		if($('#txtOcurrencias').val().trim()=='')
		{
			swal('','El campo "Principales Ocurrrencias en el mes es requerido".','error');
			$('#txtOcurrencias').focus();
			return;
		}
		var formulario = $('#frmFichaInforme');
		$.ajax({
            type:"POST",
            url:base_url+"index.php/ET_Detalle_Formato/guardarDetalleFormato",
            data: formulario.serialize(),
            cache: false,
            beforeSend:function() 
			{
            	renderLoading();
		    },
            success:function(objectJSON)
            {
				objectJSON=JSON.parse(objectJSON);
				swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				$('#divModalCargaAjax').hide();
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
    }

	function agregarFotografia(detalleFormato)
	{
		if(detalleFormato.trim()=='')
		{
			swal('', 'Tiene que guardar el informe para poder agregar fotografias','error');
			return;
		}
		paginaAjaxDialogo(null, 'Agregar Fotografia',{ idDetalleFormato: detalleFormato}, base_url+'index.php/ET_Detalle_Formato/guardarFotografia', 'GET', null, null, false, true);
	}

	function exportarFicha()
	{
		$('#frmFichaInforme').submit();
	}
</script>