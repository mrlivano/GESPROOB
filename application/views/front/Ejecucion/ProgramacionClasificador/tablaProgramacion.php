<style>
	table
	{
		border-collapse: collapse;
		color:#35353e;
	}
	#tablaClasificador td, #tablaClasificador th
	{
		font-size: 10px;
		padding: 2px 5px;
		vertical-align: middle;
	}
	#tablaClasificador th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}
	.field
	{
    	padding:8px;
		width: 130px;
	}
	.field:focus 
	{
    	border: 2px solid #2e6da4;		
	}	
	.contenidoParrafo
	{
		background-color:#f2f5f7;
		padding:8px;
		font-weight:bold;
		font-size:12px;
	}
</style>
<p class="contenidoParrafo"><?=@$fuenteFinanciamiento[0]->nombre?> : S/. <?=number_format(@$fuenteFinanciamiento[0]->pim, 2, '.', ',')?></p>
<table id="tablaClasificador" class="table table-bordered table-sm" style="width:100%;">
	<thead>
		<tr>
			<th colspan="2">ESPECIFICA DE GASTO</th>
			<th>DETALLE</th>
			<th></th>
		</tr>
	</thead>
	<tbody id="bodyClasificador">
		<?php foreach ($PresupuestoEjecucion as $key => $value) {?>
			<tr id="trPresupuestoEjecucion<?=$value->id_presupuesto_ej?>">
				<td style="background-color: #f1f1f1;color:#3f5367;" colspan="4">
					<?=$value->desc_presupuesto_ej?>								
				</td>
				<?php if(count($value->childPresupuesto)==0) 
				{							
					foreach ($value->ChilpresupuestoAnalitico as $key => $temp) { ?>
						<tr>
							<td colspan="2" style="width:10%;"><?= $temp->num_clasificador?></td>
							<td style="width:50%;"><?= $temp->desc_clasificador?></td>
							<td style="width:40%;">
								<div>
									<input class="form-control input-sm field" data-toggle="tooltip" data-placement="right" data-trigger="focus" title="Enter para guardar"  type="text" value="<?=number_format($temp->monto, 2, '.', ',')?>" onkeyup="onKeyUpGuardarDatos(this, event, '<?=$temp->id_analitico?>','<?=$temp->fuente_finan?>','<?=$temp->sec_ejec?>','<?=$temp->meta?>','<?=$temp->anio?>');">
								</div>
							</td>
						</tr>							 	
					<?php } 							 	
				}?>
				<?php if(count($value->childPresupuesto)>0) { 
					foreach ($value->childPresupuesto as $key => $item) { ?>
						<tr id="trPresupuestoEjecucion<?=$item->id_presupuesto_ej?>">
							<?php if(count($item->ChilpresupuestoAnalitico)>0) 
							{ ?>
							<td style="background-color:#f1f1f1;" colspan="4"><?=$item->desc_presupuesto_ej?></td>
							<?php foreach ($item->ChilpresupuestoAnalitico as $key => $temp2) { ?>
								<tr>
									<td colspan="2" style="width:10%;"><?= $temp2->num_clasificador?></td>
									<td style="width:50%;"><?= $temp2->desc_clasificador?></td>
									<td style="width:40%;">
										<div>
											<input class="form-control input-sm field" data-toggle="tooltip" data-placement="right" data-trigger="focus" title="Enter para guardar" type="text" value="<?=number_format($temp2->monto, 2, '.', ',')?>" onkeyup="onKeyUpGuardarDatos(this, event, '<?=$temp2->id_analitico?>','<?=$temp2->fuente_finan?>','<?=$temp2->sec_ejec?>','<?=$temp2->meta?>','<?=$temp2->anio?>');">
										</div>
									</td>
								</tr>							 	
							<?php } 
							}?>
						</tr>
					<?php }
				} ?>
			</tr>						
		<?php } ?>
	</tbody>
</table>
<script>

	function onKeyUpGuardarDatos(element, event, id_analitico, fuente, sec_ejec, meta, anio)
	{
		var evt=event || window.event;		
		var code=0;
		if(evt!='noEventHandle')
		{
			code=evt.charCode || evt.keyCode || evt.which;
		}
		if(code==13)
		{
			var monto=$(element).val();
			if(isNaN(monto) || monto.trim()=='')
			{
				return;
			}
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Manifiesto_Gasto/insertarProgramacionAnalitico",
				data: 
				{
					idAnalitico:id_analitico,
					fuente:fuente,
					sec_ejec:sec_ejec,
					meta:meta,
					anio:anio,
					monto:monto
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					$('#divModalCargaAjax').hide();
					swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success':'error'));
					$(element).val(objectJSON.monto);
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		}
	}
</script>