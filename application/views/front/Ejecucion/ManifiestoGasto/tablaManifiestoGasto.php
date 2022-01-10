<style>
	table
	{
		border-collapse: collapse;
		color:#35353e;
	}
	#tablaDinamicaManifiestoGasto td, #tablaDinamicaManifiestoGasto th
	{
		font-size: 10px;
		padding: 2px 5px;
		vertical-align: middle;
	}
	#tablaDinamicaManifiestoGasto th
	{
		background-color:#2e6da4;
		color:white;
		text-align:center;
	}	
</style>
<p style="color:#35353e;">Solo pueden ser editados los siguientes campos: Clase de Documento, Proveedor, Detalle de Gasto</p>
<table id="tablaDinamicaManifiestoGasto" class="table-striped table-bordered" cellspacing="0" width="130%">
	<thead>
		<tr>
			<th rowspan="2">Nº</th>
			<th rowspan="2"></th>			
			<th rowspan="2"></th>
			<th rowspan="2">CLASIF.</th>
			<th rowspan="2">SIAF</th>
			<th colspan="3">DOCUMENTO</th>
			<th rowspan="2">NOMBRE/PROVEEDOR</th>
			<th rowspan="2">DETALLE DEL GASTO</th>
			<th rowspan="2">UNID. MEDIDA</th>
			<th rowspan="2">CANTIDAD</th>
			<th rowspan="2">P.U</th>
			<th rowspan="2">P.T</th>
			<th rowspan="2">TOTAL DOCUMENTO</th>
		</tr>
		<tr>
			<th >CLASE</th>
			<th >Nº</th>
			<th >Nº C/P.</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach($listaExpDev as $key => $item ) { 
		if(@$item->cantidadDetalle>0) {?>			
			<?php foreach($item->childDetalleGasto as $llave => $temp) {?>
			<tr>
				<?php if($llave==0) { ?>				
				<td style ="width:2%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>"><?=@$key+1?></td>
				<td style ="width:3;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<button class="btn btn-info btn-xs" onclick="EditarCampos('<?=@$item->id_manifiestoGasto?>',<?=(int)@$item->expediente?>,'<?=@$item->meta?>','<?=@$item->ano_eje?>','<?=@$item->sec_ejec?>','<?=@$item->mes?>','<?=@$item->total_documento?>','<?=@$item->fuente_financ?>');"><i class="fa fa-save"></i></button>
				</td>
				<td style ="width:20%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<select id="selectPresupuestoEjecucion<?=(int)@$item->expediente?>" name="selectPresupuestoEjecucion<?=(int)@$item->expediente?>" class="form-control input-sm">
						<option value="">SELECCIONE</option>
						<?php foreach ($PresupuestoEjecucion as $temporal) { 						
							if($temporal->numHijos>0)
							{	?>
								<optgroup label="<?=$temporal->desc_presupuesto_ej?>">
								<?php foreach ($temporal->childPresupuesto as $temporalChild) { ?>
									<option value="<?=$temporalChild->id_presupuesto_ej?>" <?php echo ($temporalChild->id_presupuesto_ej == @$item->id_presupuesto ? "selected" : "")?>><?=$temporalChild->desc_presupuesto_ej?></option>
								<?php } ?>
								</optgroup>
							<?php }
							else { ?>
								<option value="<?=$temporal->id_presupuesto_ej?>" <?php echo ($temporal->id_presupuesto_ej == @$item->id_presupuesto ? "selected" : "")?> ><?=$temporal->desc_presupuesto_ej?></option>
							<?php }
						} ?>
					</select>
				</td>
				<td style ="width:5%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<p id="numClasificador<?=(int) @$item->expediente?>" name="numClasificador<?=(int) @$item->expediente?>">
						<?=@$item->num_clasificador?>
					</p>					
				</td>
				<td style ="width:5%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>"><?=(int) @$item->expediente?></td>
				<td style ="width:5%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<p id="tipoDoc<?=(int)@$item->expediente?>" name="tipoDoc<?=(int) @$item->expediente?>" contenteditable>
						<?=@$item->tipo_doc?>
					</p>
				</td>
				<td style ="width:5%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<p id="numDocumento<?=(int) @$item->expediente?>" name="numDocumento<?=(int) @$item->expediente?>">
						<?=(int) @$item->nro_documento?>
					</p>					
				</td>
				<td style ="width:5%;text-align:center;" rowspan="<?=$item->cantidadDetalle?>">
					<p id="numComprobante<?=(int) @$item->expediente?>" name="numComprobante<?=(int) @$item->expediente?>">
						<?=(int) @$item->nro_comprobante?>
					</p>					
				</td>
				<td style ="width:15%;" rowspan="<?=$item->cantidadDetalle?>">
					<p id="proveedor<?=(int) @$item->expediente?>" name="proveedor<?=(int) @$item->expediente?>" contenteditable>
						<?=@$item->nombre_proveedor?>
					</p>
				</td>	
				<?php } ?>			
				<td style ="width:25%;">
					<p id="detalleGasto<?=(int)@$item->expediente?>" name="detalleGasto<?=(int)@$item->expediente?>" contenteditable="<?=(@$item->tipo_bien=='B' ? true:false)?>">
					<?php 
					if(@$item->tipo_bien=='B') 
					{ 
						echo @$temp->NOMBRE_ITEM;
					}
					else
					{
						echo (@$item->detalle_gasto=='' ? @$temp->NOMBRE_ITEM : @$item->detalle_gasto);
					}
					?>
					</p>
				</td>
				<td style ="width:7%;text-align:center;"><?=$temp->ABREVIATURA?></td>
				<td style ="width:5%;text-align:center;"><?php echo ($temp->ABREVIATURA!='SERVICIO' ? number_format(@$temp->CANT_ITEM, 2, '.', '') : '');?></td>
				<td style ="width:5%;text-align:right;"><?php echo ($temp->ABREVIATURA!='SERVICIO' ? number_format(@$temp->PREC_UNIT_MONEDA, 2, '.', '') : '');?></td>
				<td style ="width:5%;text-align:right;"><?php echo ($temp->ABREVIATURA!='SERVICIO' ? number_format(@$temp->PREC_TOT_MONEDA, 2, '.', '') : '');?></td>
				<?php if($llave==0) { ?>
				<td style="text-align:right;width:8%;" rowspan="<?=$item->cantidadDetalle?>"><?=number_format(@$item->total_documento, 2, '.', ',')?></td>
				<?php } ?>	
			</tr>
			<?php }?>			
		<?php } else { ?>			
	  	<tr>
		  	<td style ="width:2%;text-align:center;">
				<?=@$key+1?>
			</td>
		  	<td style ="width:3%;text-align:center;">
			  	<button class="btn btn-info btn-xs" onclick="EditarCampos('<?=@$item->id_manifiestoGasto?>',<?=(int)@$item->expediente?>,'<?=@$item->meta?>','<?=@$item->ano_eje?>','<?=@$item->sec_ejec?>','<?=@$item->mes?>','<?=@$item->total_documento?>','<?=@$item->fuente_financ?>');"><i class="fa fa-save"></i></button>
			</td>
			<td style ="width:20%;text-align:center;">
				<select id="selectPresupuestoEjecucion<?=(int)@$item->expediente?>" name="selectPresupuestoEjecucion<?=(int)@$item->expediente?>" class="form-control input-sm">
					<option value="">SELECCIONE</option>
					<?php foreach ($PresupuestoEjecucion as $temporal) { 						
						if($temporal->numHijos>0)
						{	?>
							<optgroup label="<?=$temporal->desc_presupuesto_ej?>">
							<?php foreach ($temporal->childPresupuesto as $temporalChild) { ?>
								<option value="<?=$temporalChild->id_presupuesto_ej?>" <?php echo ($temporalChild->id_presupuesto_ej==@$item->id_presupuesto ? "selected" : "")?>><?=$temporalChild->desc_presupuesto_ej?></option>
							<?php } ?>
							</optgroup>
						<?php }
						else { ?>
							<option value="<?=$temporal->id_presupuesto_ej?>" <?php echo ($temporal->id_presupuesto_ej==@$item->id_presupuesto ? "selected" : "")?>><?=$temporal->desc_presupuesto_ej?></option>
						<?php }
					} ?>
				</select>
			</td>
			<td style ="width:5%;text-align:center;">
				<p id="numClasificador<?=(int) @$item->expediente?>" name="numClasificador<?=(int) @$item->expediente?>">
					<?=@$item->num_clasificador?>
				</p>	
			</td>
			<td style ="width:5%;text-align:center;">
				<?=(int) @$item->expediente?>
			</td>
			<td style ="width:5%;text-align:center;">
				<p id="tipoDoc<?=(int)@$item->expediente?>" name="tipoDoc<?=(int) @$item->expediente?>" contenteditable>
					<?=@$item->tipo_doc?>
				</p>
			</td>
			<td style ="width:5%;text-align:center;">
				<p id="numDocumento<?=(int) @$item->expediente?>" name="numDocumento<?=(int) @$item->expediente?>">
					<?=@$item->nro_documento?>
				</p>
			</td>
			<td style ="width:5%;text-align:center;">
				<p id="numComprobante<?=(int) @$item->expediente?>" name="numComprobante<?=(int) @$item->expediente?>">
					<?=(int) @$item->nro_comprobante?>
				</p>
			</td>
			<td style ="width:15%;">
				<p id="proveedor<?=(int) @$item->expediente?>" name="proveedor<?=(int) @$item->expediente?>" contenteditable>
					<?=(@$item->nombre_proveedor!='' ? $item->nombre_proveedor : '' )?>
				</p>
			</td>
			<td style ="width:25%;">
				<p id="detalleGasto<?=(int) @$item->expediente?>" name="detalleGasto<?=(int) @$item->expediente?>" contenteditable>
					<?=(@$item->detalle_gasto!='' ? $item->detalle_gasto : '' )?>
				</p>
			</td>			
			<td style ="width:7%;text-align:center;"></td>
			<td style ="width:5%;text-align:center;"></td>
			<td style ="width:5%;text-align:right;"></td>
			<td style ="width:5%;text-align:right;"></td>
			<td style="text-align:right;width:8%;">
				<?=number_format(@$item->total_documento, 2, '.', ',')?>
			</td>	
	  	</tr>
	<?php } 
	} ?>
	<tr>
		<td style="text-align:center;width:92%;font-size:12px;" colspan="14"><b>TOTAL</b></td>
		<td style="text-align:right;width:8%;font-size:12px;"><b><?=number_format(@$gastoTotalManifiesto, 2, '.', ',')?></b></td>
	</tr>
	</tbody>
</table>
<script>
	function EditarCampos(idManifiesto, expediente, meta, anio, sec_ejec, mes, monto, fuenteFinanciamiento)
	{
		if($('#selectPresupuestoEjecucion'+expediente).val()=='')
		{
			swal(
			{
				title: '',
				text: 'Debe asignar Estructura de Gasto',
				type: 'error'
			},
			function(){});
			return;
		}
		if($('#tipoDoc'+expediente).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El campo Tipo de Documento es Requerido',
				type: 'error'
			},
			function(){});
			return;
		}
		if($('#proveedor'+expediente).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El campo Proveedor es Requerido',
				type: 'error'
			},
			function(){});
			return;
		}
		if($('#detalleGasto'+expediente).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El campo Detalle de Gasto es Requerido',
				type: 'error'
			},
			function(){});
			return;
		}
		var idExpedienteTecnico = $('#hdIdExpedienteTecnico').val();
		var idPresupuesto = $('#selectPresupuestoEjecucion'+expediente).val();
		var tipoDocumento = replaceAll(replaceAll($('#tipoDoc'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');
		var proveedor = replaceAll(replaceAll($('#proveedor'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');
		var detalleGasto = replaceAll(replaceAll($('#detalleGasto'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');
		var numeroComprobante = replaceAll(replaceAll($('#numComprobante'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');
		var numeroDocumento = replaceAll(replaceAll($('#numDocumento'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');
		var numeroClasificador = replaceAll(replaceAll($('#numClasificador'+expediente).text().trim(), '<', '&lt;'), '>', '&gt;');

		$.ajax({
            type:"POST",
            url:base_url+"index.php/Manifiesto_Gasto/insertar",
            data: 
			{
				idExpedienteTecnico:idExpedienteTecnico,
				idManifiesto:idManifiesto,
				expedienteSiaf:expediente,
				meta:meta,
				anio:anio,	
				sec_ejec:sec_ejec,
				mes:mes,
				idPresupuesto:idPresupuesto,			
				tipoDocumento:tipoDocumento,
				proveedor:proveedor,
				detalleGasto:detalleGasto,
				numeroComprobante:numeroComprobante,
				numeroDocumento:numeroDocumento,
				numeroClasificador:numeroClasificador,
				monto:monto,
				fuenteFinanciamiento:fuenteFinanciamiento
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
				$('#tipoDoc'+expediente).text(tipoDocumento);
				$('#proveedor'+expediente).text(proveedor);
				$('#detalleGasto'+expediente).text(detalleGasto);
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
	}
</script>