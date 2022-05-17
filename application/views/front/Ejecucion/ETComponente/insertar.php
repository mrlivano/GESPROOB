<?php
function mostrarMetaAnidada($meta, $idExpedienteTecnico, $idPresupuestoEjecucion, $expedienteTecnico)
{
	$htmlTemp='';
	if(!$expedienteTecnico->aprobado && $expedienteTecnico->id_etapa_et!=3){
		$htmlTemp.='<li class="listaNivel'.$meta->nivel.'">';
		$htmlTemp.='<input type="button" title="Guardar Cambios" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosMeta('.$meta->id_meta.');" style="width: 30px;">
			<input type="button" title="Eliminar Meta" class="btn btn-default btn-xs" value="-" onclick="eliminarMeta('.$meta->id_meta.', this);" style="width: 30px;">
			<button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'.$meta->id_meta.'"><i class="fa fa-expand"></i></button>';

			$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Meta" value="+M" onclick="agregarMeta(\'\', $(this).parent(), '.$meta->id_meta.', '.$meta->nivel.', '.$idPresupuestoEjecucion.')" style="width: 30px;">';

			$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Partida" value="+P" onclick="renderizarAgregarPartida($(this).parent(), '.$meta->id_meta.','.$idPresupuestoEjecucion.')" style="width: 30px;">';

			if($idPresupuestoEjecucion==16 && $meta->nivel==1)
			{
				$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Clasificador" value="+C" onclick="paginaAjaxDialogo(\'clasificadorMeta\', \'Asociar a Clasificador\', { idET : '.$idExpedienteTecnico.', idMeta : '.$meta->id_meta.'}, \''.base_url().'index.php/ET_Meta_Analitico/insertar\', \'get\', null, null, false, true);" style="width: 30px;" style="width: 30px;">';
			}

			$htmlTemp.='<span style="text-transform: uppercase; font-weight: bold;" id="nombreMeta'.$meta->id_meta.'" contenteditable>'.html_escape($meta->desc_meta).'</span>'.
			((count($meta->childMeta)==0 && count($meta->childPartida))>0 ? '<div style="margin-bottom : 8px;margin-top : 2px;" id="demo'.$meta->id_meta.'" class="collapse"><table class ="tablaPartidas"><thead><th class = "col-md-2">OPCIONES</th><th class = "col-md-6">PARTIDA</th><th class = "col-md-1">U. MEDIDA</th><th class = "col-md-1">CANTIDAD</th><th class = "col-md-1">PRECIO U.</th><th class = "col-md-1">TOTAL</th></thead><tbody>' : '<ul>');

		if(count($meta->childMeta)==0)
		{
			foreach($meta->childPartida as $key => $value)
			{
				$htmlTemp.='<tr id="rowPartida'.$value->id_partida.'" style="color: '.($value->partidaCompleta ? 'blue' : 'red').';" class="liPartida">'.
					'<td>'.
						'<input type="button" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosPartida('.$value->id_partida.');" style="width: 30px;">'.
						'<input type="button" class="btn btn-default btn-xs" value="-" onclick="eliminarPartida('.$value->id_partida.', this);" style="width: 30px;">';
						// if($idPresupuestoEjecucion==2)
						// {
							$htmlTemp.='<input type="button" class="btn btn-default btn-xs" value="A" onclick="paginaAjaxDialogo(\'otherModal\', \'Análisis presupuestal\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.', aprobado :'.$expedienteTecnico->aprobado.',  id_etapa_et :'.$expedienteTecnico->id_etapa_et.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
						// }
						// else
						// {
						// 	$htmlTemp.='<input type="button" class="btn btn-default btn-xs" value="C" onclick="paginaAjaxDialogo(\'otherModal\', \'Asociar Clasificador\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
						// }
						
					$htmlTemp.='</td>'.
					'<td style="text-transform: uppercase;"><span id="nombrePartida'.$value->id_partida.'" contenteditable>'.html_escape($value->desc_partida).'</span></td>'.
					'<td style="text-align: right; text-transform: uppercase;">'.html_escape($value->descripcion).'</td>'.
					'<td style="text-align: right;"><span id="cantidadPartida'.$value->id_partida.'" contenteditable>'.number_format($value->cantidad, 4, '.', '').'</span></td>'.
					'<td style="text-align: right;"><span id="precioUnitarioPartida'.$value->id_partida.'" contenteditable>'.$value->precio_unitario.'</span></td>';
					$htmlTemp.='<td style="text-align: right;">'. number_format(@$value->parcial, 2, '.', ',').'</td>'.
				'</tr>';
			}
		}
   }
   else {
	$htmlTemp.='<li class="listaNivel'.$meta->nivel.'">';
	$htmlTemp.='<button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'.$meta->id_meta.'"><i class="fa fa-expand"></i></button>';

		$htmlTemp.='<span style="text-transform: uppercase; font-weight: bold;" id="nombreMeta'.$meta->id_meta.'">'.html_escape($meta->desc_meta).'</span>'.
		((count($meta->childMeta)==0 && count($meta->childPartida))>0 ? '<div style="margin-bottom : 8px;margin-top : 2px;" id="demo'.$meta->id_meta.'" class="collapse"><table class ="tablaPartidas"><thead><th class = "col-md-2">OPCIONES</th><th class = "col-md-6">PARTIDA</th><th class = "col-md-1">U. MEDIDA</th><th class = "col-md-1">CANTIDAD</th><th class = "col-md-1">PRECIO U.</th><th class = "col-md-1">TOTAL</th></thead><tbody>' : '<ul>');

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr id="rowPartida'.$value->id_partida.'" style="color: '.($value->partidaCompleta ? 'blue' : 'red').';" class="liPartida">'.
				'<td>';
					// if($idPresupuestoEjecucion==2)
					// {
						$htmlTemp.='<input type="button" class="btn btn-default btn-xs" value="A" onclick="paginaAjaxDialogo(\'otherModal\', \'Análisis presupuestal\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.', aprobado :'.$expedienteTecnico->aprobado.', id_etapa_et:'.$expedienteTecnico->id_etapa_et.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
					// }
					// else
					// {
					// 	$htmlTemp.='<input type="button" class="btn btn-default btn-xs" value="C" onclick="paginaAjaxDialogo(\'otherModal\', \'Asociar Clasificador\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
					// }
					
				$htmlTemp.='</td>'.
				'<td style="text-transform: uppercase;"><span id="nombrePartida'.$value->id_partida.'">'.html_escape($value->desc_partida).'</span></td>'.
				'<td style="text-align: right; text-transform: uppercase;">'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;"><span id="cantidadPartida'.$value->id_partida.'">'.number_format($value->cantidad, 4, '.', '').'</span></td>'.
				'<td style="text-align: right;"><span id="precioUnitarioPartida'.$value->id_partida.'">'.$value->precio_unitario.'</span></td>';
				$htmlTemp.='<td style="text-align: right;">'. number_format(@$value->parcial, 2, '.', ',').'</td>'.
			'</tr>';
		}
	}
   }

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value, $idExpedienteTecnico,$idPresupuestoEjecucion, $expedienteTecnico);
	}

	$htmlTemp.=((count($meta->childMeta)==0 && count($meta->childPartida))>0 ? '</tbody></table></div>' : '</ul>').
	'</li>';
	return $htmlTemp;
}
?>
<style>
	.modal-dialog
	{
		width: 90%;
		margin: 0;
		margin-left: 5%;
		padding: 0;
	}

	.listaNivel1
	{
		color:#1d73c9;
		padding-left:37px;
	}

	.listaNivel2
	{
		color:#fba905;
		padding-left:37px;
	}
	.listaNivel3
	{		
		color:#249991;
		padding-left:37px;
	}

	.listaNivel4
	{
		color:#b3372f;
		padding-left:37px;
	}
	
	.listaNivelCI1
	{
		color:#1d73c9;
		padding-left:37px;
	}

	.listaNivelCI2
	{
		color:#fba905;
		padding-left:74px;
	}
	.listaNivelCI3
	{		
		color:#249991;
		padding-left:37px;
	}

	.listaNivelCI4
	{
		color:#b3372f;
		padding-left:37px;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
	.nivel
	{
		color: #73879C;
	    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
	    font-size: 13px;
	    font-weight: 400;
	    line-height: 1.471;
	    margin : 2px;
	}
	li
	{
		list-style:none;
	}
	.liPartida
	{
		list-style:none;
	}
	.tablaPartidas
	{
		margin-left: 70px;
		width:90%;
	}
	.tablaPartidas {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	}

	.tablaPartidas td {
	    border: 1px solid #ddd;
	    padding: 2px 6px;
	}
	.tablaPartidas th {
	    text-align: left;
	    background-color: #e5e5e5;
	    color: #5d87b1;
	    border: 1px solid #ddd;
	    padding: 4px;
	}
	.panel-title 
    {
        font-size: 13px;
        font-weight: bold;
    }
    .active a span.fa 
    {
    text-align: right !important;
    margin-right: 0px;
    }
</style>
<div class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div>
				<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="2" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=html_escape(trim($expedienteTecnico->nombre_pi))?></textarea>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 3px;">
			<div class="col-md-12 col-sm-12 col-xs-12">
					<select id="selectPresupuesto" name="selectPresupuesto" class="form-control">
						<option selected="true" value="" disabled>Seleccione Presupuesto</option>
						<?php foreach ($SelectPresupuesto as $key => $value) { ?>
							<option value="<?=$value->Codigo?>"><?=$value->Descripcion?></option>
						<?php } ?>
					</select>
			</div>
		</div>
	<div id="divImportarComponente" class="row" style="margin-top: 3px;">
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div>
				<select id="selectPresupuestoEjecucionI" name="selectPresupuestoEjecucionI" class="form-control">
					<option value="">Estructura de Presupuesto</option>
					<?php foreach ($PresupuestoEjecucion as $key => $value) { ?>
						<option value="<?=$value->id_presupuesto_ej?>"><?=$value->desc_presupuesto_ej?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-7 col-sm-12 col-xs-12">
				<select id="selectComponente" name="selectComponente" class="form-control">
				<option selected="true" value="" disabled>Seleccione Componente</option>
				</select>
		</div>
		
		<div class="col-md-2 col-sm-12 col-xs-12">
			<input type="button" class="btn btn-info" value="Importar componente" onclick="importarComponente();" style="width: 100%;">
		</div>
	</div>
	<div id="divAgregarComponente" class="row" style="margin-top: 3px;">
		<div class="col-md-3 col-sm-12 col-xs-12">
			<div>
				<select id="selectPresupuestoEjecucion" name="selectPresupuestoEjecucion" class="form-control">
					<option value="">Estructura de Presupuesto</option>
					<?php foreach ($PresupuestoEjecucion as $key => $value) { ?>
						<option value="<?=$value->id_presupuesto_ej?>"><?=$value->desc_presupuesto_ej?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-7 col-sm-12 col-xs-12">
			<input type="text" class="form-control" id="txtDescripcionComponente" name="txtDescripcionComponente" placeholder="Descripción del componente">
		</div>
		<div class="col-md-2 col-sm-12 col-xs-12">
			<input type="button" class="btn btn-info" value="Agregar componente" onclick="agregarComponente();" style="width: 100%;">
		</div>
	</div>
	<div id="divAgregarPartida" class="row" style="display: none;margin-top: 2px;">
		<div class="col-md-6">
			<label>.</label>
			<div>
				<select name="selectBuscarPartida" id="selectBuscarPartida" class="form-control selectpicker"></select>
			</div>
			<input  name='hdIdPresupuestoEjecucion' id='hdIdPresupuestoEjecucion'>
			<label for="control-label">Descripción de la Partida</label>
			<div style="height: 200px;overflow-y: scroll; background-color: #f2f5f7;">
				<ul>
			    	<?php foreach ($listaPartidaNivel1 as $key => $value)
			    	{
		    			if($value->hasChild)
		    			{?>
		    				<li>
		    					<input type="button" style="width: 25px;" class="btn btn-default btn-xs" id="btnAccion" name="Accion" value="+" onclick="elegirAccion('<?=$value->CodPartida?>', 3, this);" style="margin: 1px;">
				    			<span class="nivel"><?=$value->Descripcion?> <?=($value->Simbolo==null ? '' : ($value->Simbolo))?> </span>
				    		</li>
		    			<?php } else { ?>
		    				<li>
				    			<span class="nivel"><?=$value->Descripcion?></span>
				    		</li>
		    			<?php } ?>
			    	<?php } ?>
			    </ul>
			</div>
		</div>
		<div class="col-md-6">
			<div id="validarPartida">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label for="control-label">Partida:</label>
						<div>
							<input type="text" id="selectDescripcionPartida" name="selectDescripcionPartida" autocomplete="off" class="form-control" placeholder="Busque o ingrese una partida">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="control-label">Unidad</label>
						<div>
							<select  name="selectUnidadMedidaPartida" id="selectUnidadMedidaPartida" class="form-control selectpicker">
								<option value="">Buscar Unidad</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label for="control-label">Cantidad:</label>
						<div>
							<input type="text" id="txtCantidadPartida" name="txtCantidadPartida" autocomplete="off" class="form-control">
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label for="control-label">Precio:</label>
						<div>
							<input type="text" id="txtPrecioUnitarioPartida" name="txtPrecioUnitarioPartida" autocomplete="off" class="form-control" placeholder="0.00">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<br>
				<div class="col-md-6 col-sm-2 col-xs-12">
					<input type="hidden" id="hdIdListaPartida" name="hdIdListaPartida">
					<input type="button" class="btn btn-success" value="Guardar" onclick="agregarPartida();">
					<input type="button" class="btn btn-danger" value="Cerrar" onclick="cerrar();">
				</div>
			</div>
		</div>
	</div>
	<hr style="margin-top: 1px;">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($expedienteTecnico->childPresupuestoEjecucion as $key => $temp3) { ?>                
                <div class="panel">
                    <div class="panel-heading" style="padding: 6px;">
                        <a class="panel-title" id="heading<?=$temp3->id_presupuesto_ej?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$temp3->id_presupuesto_ej?>" aria-expanded="false" aria-controls="collapse<?=$temp3->id_presupuesto_ej?>" style="text-transform: uppercase;"><?=$temp3->desc_presupuesto_ej?>
                        </a>
                    </div>
                    <div id="collapse<?=$temp3->id_presupuesto_ej?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading<?=$temp3->id_presupuesto_ej?>">
                        <div class="panel-body">
	                        <ul id="ulComponenteMetaPartida<?=$temp3->id_presupuesto_ej?>" style="list-style-type: upper-roman;">
								<?php foreach($temp3->childComponente as $key => $value) { ?>
									<li>
										<?php if(!$expedienteTecnico->aprobado && $expedienteTecnico->id_etapa_et!=3){?>
											<input type="button" class="btn btn-default btn-xs" value="G" title="Guardar Cambios" onclick="guardarCambiosComponente(<?=$value->id_componente?>);" style="width: 30px;">
											<input type="button" class="btn btn-default btn-xs" value="+M" title="Agregar Meta" onclick="agregarMeta(<?=$value->id_componente?>, $(this).parent(), '',1,<?=$temp3->id_presupuesto_ej?>);" style="width: 30px;">
											<input type="button" class="btn btn-default btn-xs" value="-" title="Eliminar Componente" onclick="eliminarComponente(<?=$value->id_componente?>,<?=$value->id_presupuesto_ej?>, this);" style="width: 30px;"><b style="text-transform: uppercase; color: black;" id="nombreComponente<?=$value->id_componente?>" contenteditable><?=html_escape($value->descripcion)?></b>
										<?php } else {?>
											<b style="text-transform: uppercase; color: black;" id="nombreComponente<?=$value->id_componente?>"><?=html_escape($value->descripcion)?></b>
										<?php }?>
										<ul>
											<?php foreach($value->childMeta as $index => $item){ ?>
												<?=mostrarMetaAnidada($item, $expedienteTecnico->id_et, $temp3->id_presupuesto_ej,$expedienteTecnico);?>
											<?php } ?>
										</ul>
									</li>
								<?php } ?>
							</ul>              
                        </div>
                    </div>
                </div> 
                <?php } ?>              
            </div>
        </div>
	</div>
	<hr>
	<div class="row" style="text-align: right;">
		<input type="hidden" id="hdIdET" value="<?=$expedienteTecnico->id_et?>">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	function cerrar()
	{
		$('#divAgregarPartida').hide(1000);
	}
	function limpiarArbolCompletoMasOpciones()
	{

		limpiarText('divAgregarPartida', []);
	}

	function agregarComponente()
	{
		$('#divAgregarComponente').data('formValidation').resetField($('#txtDescripcionComponente'));
		$('#divAgregarComponente').data('formValidation').resetField($('#selectPresupuestoEjecucion'));

		$('#divAgregarComponente').data('formValidation').validate();

		if(!($('#divAgregarComponente').data('formValidation').isValid()))
		{
			return;
		}

		var existeComponente=false;

		var PresupuestoEjecucion=$('#selectPresupuestoEjecucion').val();

		$('#ulComponenteMetaPartida'+PresupuestoEjecucion).find('> li > b').each(function(index, element)
		{
			if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll($('#txtDescripcionComponente').val(), ' ', '').toLowerCase())
			{
				existeComponente=true;

				return false;
			}
		});

		if(existeComponente)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar dos veces el mismo componente.',
				type: 'error'
			},
			function(){});

			return;
		}

		paginaAjaxJSON({ "idET" : $('#hdIdET').val(), "descripcionComponente" : $('#txtDescripcionComponente').val().trim(), idPresupuestoEjecucion:PresupuestoEjecucion }, base_url+'index.php/ET_Componente/insertar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			if(objectJSON.proceso=='Error')
			{
				return false;
			}

			var htmlTemp='<li>'+
				'<input type="button" class="btn btn-default btn-xs" value="G" title="Guardar Cambios" onclick="guardarCambiosComponente('+objectJSON.idComponente+');" style="width: 30px;"> ';

				htmlTemp+='<input type="button" class="btn btn-default btn-xs" value="+M" title="Agregar Meta" onclick="agregarMeta('+objectJSON.idComponente+', $(this).parent(), \'\',1,'+PresupuestoEjecucion+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" value="-" title="Eliminar Componente" onclick="eliminarComponente('+objectJSON.idComponente+','+PresupuestoEjecucion+', this);" style="width: 30px;"> <b style="text-transform: uppercase; color: black;" id="nombreComponente'+objectJSON.idComponente+'" contenteditable>'+replaceAll(replaceAll($('#txtDescripcionComponente').val().trim(), '<', '&lt;'), '>', '&gt;')+'</b>';
				htmlTemp+='<ul></ul></li>';


			$('#ulComponenteMetaPartida'+PresupuestoEjecucion).append(htmlTemp);

			$('#txtDescripcionComponente').val('');

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}
	function importarComponente()
	{
		$('#divImportarComponente').data('formValidation').resetField($('#selectComponente'));
		$('#divImportarComponente').data('formValidation').resetField($('#selectPresupuestoEjecucionI'));

		$('#divImportarComponente').data('formValidation').validate();

		if(!($('#divImportarComponente').data('formValidation').isValid()))
		{
			return;
		}

		var existeComponente=false;

		var PresupuestoEjecucion=$('#selectPresupuestoEjecucionI').val();

		$('#ulComponenteMetaPartida'+PresupuestoEjecucion).find('> li > b').each(function(index, element)
		{
			if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll($('#selectComponente').val(), ' ', '').toLowerCase())
			{
				existeComponente=true;

				return false;
			}
		});

		if(existeComponente)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar dos veces el mismo componente.',
				type: 'error'
			},
			function(){});

			return;
		}

		paginaAjaxJSON({ "idET" : $('#hdIdET').val(), "descripcionComponente" : $('#selectComponente').val().trim(), idPresupuestoEjecucion:PresupuestoEjecucion }, base_url+'index.php/ET_Componente/insertar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			// swal(
			// {
			// 	title: '',
			// 	text: objectJSON.mensaje,
			// 	type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			// },
			// function(){});

			if(objectJSON.proceso=='Error')
			{
				return false;
			}

			var htmlTemp='<li>'+
				'<input type="button" class="btn btn-default btn-xs" value="G" title="Guardar Cambios" onclick="guardarCambiosComponente('+objectJSON.idComponente+');" style="width: 30px;"> ';

				htmlTemp+='<input type="button" class="btn btn-default btn-xs" value="+M" title="Agregar Meta" onclick="agregarMeta('+objectJSON.idComponente+', $(this).parent(), \'\',1,'+PresupuestoEjecucion+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" value="-" title="Eliminar Componente" onclick="eliminarComponente('+objectJSON.idComponente+','+PresupuestoEjecucion+', this);" style="width: 30px;"> <b style="text-transform: uppercase; color: black;" id="nombreComponente'+objectJSON.idComponente+'" contenteditable>'+replaceAll(replaceAll($('#selectComponente').val().trim(), '<', '&lt;'), '>', '&gt;')+'</b>';
				htmlTemp+='<ul></ul></li>';


			$('#ulComponenteMetaPartida'+PresupuestoEjecucion).append(htmlTemp);

			//Importar Meta S10

			id = $('#selectComponente option:selected').attr('id');
			componente = $('#selectComponente').val();

			$('#ulComponenteMetaPartida'+PresupuestoEjecucion).find('> li > b').each(async function(index, element)
			{
				var elementP = [];
				var idelementP = [];
				elementP[0]=$(element).parent();
				if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll(componente, ' ', '').toLowerCase()){
					
					paginaAjaxJSON(
						{ 
						"idSubpresupuesto" : id ,
						"idComponente" : objectJSON.idComponente ,
						"idET" : $('#hdIdET').val(),
						},
						base_url+'index.php/ET_Componente/cargarMetaS10',
						'POST', null, async function(metaJSON)
						{
							resultado=JSON.parse(metaJSON);
							console.log(resultado);
							let idetTemp=$('#hdIdET').val();
							console.log(idetTemp);

							swal(
							{
								title: '',
								text: objectJSON.mensaje,
								type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
							},function(){});
							
							window.location.reload();
							//paginaAjaxDialogo(null, 'Registro de componentes, metas y partidas',idetTemp, base_url+'index.php/ET_Componente/insertar', 'GET', null, null, false, true);

								/*await Promise.all(resultado.data.map(async (elementM) => {
								
								if (elementM.Nivel===0) {
									elementP[(elementM.Nivel+1)]= await importarMeta(objectJSON.idComponente,elementP[elementM.Nivel],'',(elementM.Nivel+1),PresupuestoEjecucion,elementM.Titulo);
									console.log(elementP[(elementM.Nivel+1)]);
								}
								else{
									console.log(elementP[elementM.Nivel]);
									//importarMeta('',elementP[elementM.Nivel],idelementP[(elementM.Nivel-1)],(elementM.Nivel+1),PresupuestoEjecucion,elementM.Titulo, function(resultado,idmeta){ elementP[elementM.Nivel]=resultado; idelementP[elementM.Nivel]=idmeta;});
								}
					        }));*/
							
					    }, false, true)
				}
			});
				console.log('id'+id)
				console.log('componente'+componente)



			$('#selectComponente').val('');

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}
	$("#selectPresupuesto").change(function()
		{
			let Codigo_Presupuesto=$(this).find("option:selected").val();
			let CodigoProyecto="<?php echo $expedienteTecnico->codigo_unico_pi ?>";
			
			console.log(CodigoProyecto);
			paginaAjaxJSON(
				{ 
				"Codigo_Presupuesto" : Codigo_Presupuesto ,
				"Codigo_Proyecto" :  CodigoProyecto,
				},
				base_url+'index.php/ET_Componente/cargarSelectSubPresupuesto',
				 'POST', null, function(objectJSON)
				{
					resultado=JSON.parse(objectJSON);
					let select = document.getElementsByName("selectComponente")[0];
					$("#selectComponente").find('option').not(':first').remove();
						resultado.data.forEach(element => {
							var option = document.createElement("option");
							option.text = element.Codigo_Presupuesto+" - "+element.Descripcion;
							option.id = element.Id;
							select.add(option);
						}); 
							
						
					
			}, false, true)
		});
		
	function guardarCambiosComponente(idComponente)
	{
		if($('#nombreComponente'+idComponente).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El nombre del componente es obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombreComponente'+idComponente).text('___');

			return;
		}

		paginaAjaxJSON({ "idComponente" : idComponente, 'descripcionComponente' : replaceAll(replaceAll($('#nombreComponente'+idComponente).text().trim(), '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/ET_Componente/editarDescComponente', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			$('#nombreComponente'+idComponente).text($('#nombreComponente'+idComponente).text().trim());
		}, false, true);
	}

	function guardarCambiosMeta(idMeta)
	{
		if($('#nombreMeta'+idMeta).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El nombre de la meta es obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombreMeta'+idMeta).text('___');

			return;
		}

		paginaAjaxJSON({ "idMeta" : idMeta, 'descripcionMeta' : replaceAll(replaceAll($('#nombreMeta'+idMeta).text().trim(), '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/ET_Meta/editarDescMeta', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			$('#nombreMeta'+idMeta).text($('#nombreMeta'+idMeta).text().trim());
		}, false, true);
	}

	function guardarCambiosPartida(idPartida)
	{
		var nombrePartida = $('#nombrePartida'+idPartida).text().trim();
		var cantidad = $('#cantidadPartida'+idPartida).text().trim();
		var precioUnitario = $('#precioUnitarioPartida'+idPartida).text().trim();
		if(nombrePartida=='')
		{
			swal(
			{
				title: '',
				text: 'Partida es un campo obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombrePartida'+idPartida).text('___');

			return;
		}
		if(cantidad=='')
		{
			swal(
			{
				title: '',
				text: 'Cantidad es un campo obligatorio.',
				type: 'error'
			},
			function(){});

			$('#cantidadPartida'+idPartida).text('___');

			return;
		}
		if(precioUnitario=='')
		{
			swal(
			{
				title: '',
				text: 'Precio Unitario es un campo obligatorio.',
				type: 'error'
			},
			function(){});

			$('#precioUnitario'+idPartida).text('___');

			return;
		}

		paginaAjaxJSON({ "idPartida" : idPartida,'nombrePartida' : replaceAll(replaceAll(nombrePartida, '<', '&lt;'), '>', '&gt;') , 'cantidadPartida' : replaceAll(replaceAll(cantidad, '<', '&lt;'), '>', '&gt;'), 'rendimientoPartida' : '', 'precioUnitarioPartida' : replaceAll(replaceAll(precioUnitario, '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/ET_Partida/editarCambiosPartida', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			var currentRow = $("#rowPartida"+objectJSON.idPartida);

			currentRow.find("td:eq(1)").html('<span id="nombrePartida'+objectJSON.idPartida+'" contenteditable>'+nombrePartida+'</span>');

			currentRow.find("td:eq(3)").html('<span id="cantidadPartida'+objectJSON.idPartida+'" contenteditable>'+(parseFloat(objectJSON.cantidad).toFixed(2))+'</span>');

			currentRow.find("td:eq(4)").html('<span id="precioUnitarioPartida'+objectJSON.idPartida+'" contenteditable>'+(parseFloat(objectJSON.precioUnitario).toFixed(2))+'</span>');

			currentRow.find("td:eq(5)").text(parseFloat(objectJSON.precioParcial).toFixed(2));

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}

	function eliminarComponente(idComponente,idPresupuestoEjecucion, element)
    {
        swal({
            title: "Al borrar componente se eliminará todas las metas, sub metas y partidas asociadas. ¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idComponente" : idComponente, "idPresupuestoEjecucion" : idPresupuestoEjecucion }, base_url+'index.php/ET_Componente/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				$(element).parent().remove();

				limpiarArbolCompletoMasOpciones();
			}, false, true);
        });
    }

	function eliminarMeta(idMeta, element)
    {
        swal({
            title: "Al borrar meta se eliminará todas las sub metas y partidas asociadas. ¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idMeta" : idMeta }, base_url+'index.php/ET_Meta/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				$(element).parent().remove();

				limpiarArbolCompletoMasOpciones();
			}, false, true);
        });
    }

	function agregarMeta(idComponente, elementoPadre, idMetaPadre, nivel, idPresupuestoEjecucion)
	{
		if($($(elementoPadre).find('> div')[0]).find('> table > tbody > .liPartida').length>0)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar submeta al mismo nivel que una partida.',
				type: 'error'
			},
			function(){});

			return;
		}

		var descripcionMeta = '';

		swal({
			title: "",
			text: "Descripción de la Meta",
			type: "input",
			showCancelButton: true,
			cancelButtonText:"CERRAR",
			confirmButtonText: "ACEPTAR",
			closeOnConfirm: false,
		 	inputPlaceholder: ""
		}, function (inputValue)
		{
		  	if (inputValue === false) return false;
		  	if (inputValue === "")
		  	{
		    	swal.showInputError("Meta es un campo requerido");
		    	return false
		  	}

		  	descripcionMeta = inputValue;

			if(descripcionMeta==null || descripcionMeta.trim()=='')
			{
				return;
			}

			var existeMeta=false;

			$($(elementoPadre).find('ul')[0]).find('> li').each(function(index, element)
			{
				if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll(descripcionMeta, ' ', '').toLowerCase())
				{
					existeMeta=true;

					return false;
				}
			});

			if(existeMeta)
			{
				swal(
				{
					title: '',
					text: 'No se puede agregar dos metas iguales en el mismo nivel.',
					type: 'error'
				},
				function(){});

				return;
			}

			paginaAjaxJSON({ "idComponente" : idComponente, "descripcionMeta" : descripcionMeta.trim(), "idMetaPadre" : idMetaPadre }, base_url+'index.php/ET_Meta/insertar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				if(objectJSON.proceso=='Error')
				{
					return false;
				}

				var htmlTemp='<li class="listaNivel'+nivel+'">'+
					'<input type="button" class="btn btn-default btn-xs" title="Guardar Cambios" value="G" onclick="guardarCambiosMeta('+objectJSON.idMeta+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" title="Eliminar Meta" value="-" onclick="eliminarMeta('+objectJSON.idMeta+', this);" style="width: 30px;"> <button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'+objectJSON.idMeta+'"><i class="fa fa-expand"></i></button><input type="button" class="btn btn-default btn-xs" title="Agregar Meta" value="+M" onclick="agregarMeta(\'\', $(this).parent(), '+objectJSON.idMeta+','+(nivel+1)+','+idPresupuestoEjecucion+')" style="width: 30px;"><input type="button" class="btn btn-default btn-xs" title="Agregar Partida" value="+P" onclick="renderizarAgregarPartida($(this).parent(), '+objectJSON.idMeta+','+idPresupuestoEjecucion+')" style="width: 30px;"><span style="text-transform: uppercase; font-weight: bold;" id="nombreMeta'+objectJSON.idMeta+'" contenteditable>'+descripcionMeta+'</span>';
					htmlTemp+='<ul></ul></li>';

				$($(elementoPadre).find('ul')[0]).append(htmlTemp);

				limpiarArbolCompletoMasOpciones();
			}, false, true);
		});
	}

	function importarMeta(idComponente, elementoPadre, idMetaPadre, nivel, idPresupuestoEjecucion,meta)
	{
		if($($(elementoPadre).find('> div')[0]).find('> table > tbody > .liPartida').length>0)
		{
			return;
		}

		var descripcionMeta = '';

		  	descripcionMeta = meta;

			if(descripcionMeta==null || descripcionMeta.trim()=='')
			{
				return;
			}

			var existeMeta=false;

			$($(elementoPadre).find('ul')[0]).find('> li').each(function(index, element)
			{
				if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll(descripcionMeta, ' ', '').toLowerCase())
				{
					existeMeta=true;

					return false;
				}
			});

			if(existeMeta)
			{
				return;
			}

			paginaAjaxJSON({ "idComponente" : idComponente, "descripcionMeta" : descripcionMeta.trim(), "idMetaPadre" : idMetaPadre }, base_url+'index.php/ET_Meta/insertar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);
				idmeta = objectJSON.idMeta;
				if(objectJSON.proceso=='Error')
				{
					return false;
				}

				var htmlTemp='<li class="listaNivel'+nivel+'">'+
					'<input type="button" class="btn btn-default btn-xs" title="Guardar Cambios" value="G" onclick="guardarCambiosMeta('+objectJSON.idMeta+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" title="Eliminar Meta" value="-" onclick="eliminarMeta('+objectJSON.idMeta+', this);" style="width: 30px;"> <button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'+objectJSON.idMeta+'"><i class="fa fa-expand"></i></button><input type="button" class="btn btn-default btn-xs" title="Agregar Meta" value="+M" onclick="agregarMeta(\'\', $(this).parent(), '+objectJSON.idMeta+','+(nivel+1)+','+idPresupuestoEjecucion+')" style="width: 30px;"><input type="button" class="btn btn-default btn-xs" title="Agregar Partida" value="+P" onclick="renderizarAgregarPartida($(this).parent(), '+objectJSON.idMeta+','+idPresupuestoEjecucion+')" style="width: 30px;"><span style="text-transform: uppercase; font-weight: bold;" id="nombreMeta'+objectJSON.idMeta+'" contenteditable>'+descripcionMeta+'</span>';
					htmlTemp+='<ul></ul></li>';

				$($(elementoPadre).find('ul')[0]).append(htmlTemp);

				limpiarArbolCompletoMasOpciones();

				$($(elementoPadre).find('ul')[0]).find('> li >span').each(function(index, element)
				{
					if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll(descripcionMeta, ' ', '').toLowerCase())
					{
						console.log($(element).parent());
						return  $(element).parent();
					}
				});

			}, false, true);
		
	}

	var elementoPadreParaAgregarPartida, metaPadreParaAgregarPartida;

	function renderizarAgregarPartida(elementoPadre, metaPadre, idPresupuestoEjecucion)
	{
		limpiarArbolCompletoMasOpciones();

		if($($(elementoPadre).find('ul')[0]).find('input[value="+M"]').length)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar partida a una meta antecesora de otra.',
				type: 'error'
			},
			function(){});

			return;
		}

		$('#divAgregarPartida').show(1000);

		$('#hdIdPresupuestoEjecucion').val(idPresupuestoEjecucion);

		$(elementoPadre).css({ "background-color" : "#f5f5f5" });

		elementoPadreParaAgregarPartida=elementoPadre;
		metaPadreParaAgregarPartida=metaPadre;
	}

	function agregarPartida()
	{
		$('#divAgregarPartida').data('formValidation').resetField($('#selectDescripcionPartida'));
		$('#divAgregarPartida').data('formValidation').resetField($('#selectUnidadMedidaPartida'));
		$('#divAgregarPartida').data('formValidation').resetField($('#txtCantidadPartida'));
		$('#divAgregarPartida').data('formValidation').resetField($('#txtPrecioUnitarioPartida'));

		$('#divAgregarPartida').data('formValidation').validate();

		if(!($('#divAgregarPartida').data('formValidation').isValid()))
		{
			return;
		}

		var existePartida=false;

		$($(elementoPadreParaAgregarPartida).find('table')[0]).find('> tbody > tr > td > b').each(function(index, element)
		{
			if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll($('#selectDescripcionPartida').val(), ' ', '').toLowerCase())
			{
				existePartida=true;

				return false;
			}
		});

		if(existePartida)
		{
			swal(
			{
				title: '',
				text: 'No se puede agregar dos partidas iguales en el mismo nivel.',
				type: 'error'
			},
			function(){});

			return;
		}

		var idUnidad = $('#selectUnidadMedidaPartida').val().trim();
		var descripcion = $('#selectDescripcionPartida').val().trim();
		var cantidad = $('#txtCantidadPartida').val();
		var precio = $('#txtPrecioUnitarioPartida').val();
		var idLista = $('#hdIdListaPartida').val();
		var idPresupuestoEjecucion = $('#hdIdPresupuestoEjecucion').val();

		paginaAjaxJSON({ "idMeta" : metaPadreParaAgregarPartida, "idUnidad" : idUnidad, "descripcionPartida" : descripcion, "rendimientoPartida" : '', "cantidadPartida" : cantidad, "precioUnitarioPartida" : precio, "idListaPartida" : idLista }, base_url+'index.php/ET_Partida/insertar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			if(objectJSON.proceso=='Error')
			{
				return false;
			}

			var htmlTemp='<tr id="rowPartida'+objectJSON.idPartida+'" style="color: red;" class="liPartida">'+
				'<td>'+
					'<input type="button" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosPartida('+objectJSON.idPartida+');" style="width: 30px;">'+
					'<input type="button" class="btn btn-default btn-xs" value="-" onclick="eliminarPartida('+objectJSON.idPartida+', this);" style="width: 30px;">';
				// if(idPresupuestoEjecucion==2)
				// {
					htmlTemp+='<input type="button" class="btn btn-default btn-xs" value="A" onclick="paginaAjaxDialogo(\'otherModal\', \'Análisis presupuestal\', { idET : <?=$expedienteTecnico->id_et?>, idPartida : '+objectJSON.idPartida+', idPresupuesto : '+idPresupuestoEjecucion+' , aprobado :<?=$expedienteTecnico->aprobado?>, id_etapa_et :<?=$expedienteTecnico->id_etapa_et?> }, \''+base_url+'index.php/ET_Analisis_Unitario/insertar\''+', \'get\', null, null, false, true);" style="width: 30px;">';
				// }
				// else
				// {
				// 	htmlTemp+='<input type="button" class="btn btn-default btn-xs" value="C" onclick="paginaAjaxDialogo(\'otherModal\', \'Asociar Clasificador\', { idET : <?=$expedienteTecnico->id_et?>, idPartida : '+objectJSON.idPartida+', idPresupuesto : '+idPresupuestoEjecucion+' }, \''+base_url+'index.php/ET_Analisis_Unitario/insertar\''+', \'get\', null, null, false, true);" style="width: 30px;">';
				// }
				htmlTemp+='</td>'+
				'<td style="text-transform: uppercase;"><span id="nombrePartida'+objectJSON.idPartida+'" contenteditable>'+replaceAll(replaceAll($('#selectDescripcionPartida').val().trim(), '<', '&lt;'), '>', '&gt;')+'</span></td>'+

				'<td style="text-align: right; text-transform: uppercase;">'+replaceAll(replaceAll(objectJSON.descripcionUnidadMedida, '<', '&lt;'), '>', '&gt;')+'</td>'+

				'<td style="text-align: right;"><span id="cantidadPartida'+objectJSON.idPartida+'" contenteditable>'+ parseFloat(objectJSON.cantidadDetallePartida).toFixed(2)+'</span></td>'+

				'<td style="text-align: right;"><span id="precioUnitarioPartida'+objectJSON.idPartida+'" contenteditable>'+parseFloat(objectJSON.precioUnitarioDetallePartida).toFixed(2)+'</span></td>'+

				'<td style="text-align: right;">'+parseFloat(objectJSON.precioParcialDetallePartida).toFixed(2)+'</td>'+
			'</tr>';
			if(!($(elementoPadreParaAgregarPartida).find('table').length))
			{
				$($(elementoPadreParaAgregarPartida).find('ul')[0]).replaceWith('<div id="demo'+metaPadreParaAgregarPartida+'" style="margin-bottom : 8px;margin-top : 2px;" class="collapse"><table class ="tablaPartidas"><thead><th class = "col-md-2">OPCIONES</th><th class = "col-md-6">PARTIDA</th><th class = "col-md-1">U. MEDIDA</th><th class = "col-md-1">CANTIDAD</th><th class = "col-md-1">PRECIO U.</th><th class = "col-md-1">TOTAL</th></thead><tbody></tbody</table></div>');
			}

			$($(elementoPadreParaAgregarPartida).find('table > tbody')[0]).append(htmlTemp);

			$('#selectUnidadMedidaPartida').html('<option val="">Buscar Partida</option>');
			$('#selectUnidadMedidaPartida').selectpicker('refresh');

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}

	function eliminarPartida(idPartida, element)
    {
        swal({
            title: "Al borrar partida se eliminará todos los datos relacionados a dicha partida. ¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idPartida" : idPartida }, base_url+'index.php/ET_Partida/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){});

				var tBodyTemporal=$(element).parent().parent().parent();

				$(element).parent().parent().remove();

				if(!($(tBodyTemporal).find('tr').length))
				{
					$($(tBodyTemporal).parent()[0]).parent().replaceWith('<ul></ul>');
				}

				limpiarArbolCompletoMasOpciones();
			}, false, true);
        });
    }

	function MostrarSubLista(codigoPartida, nivel, element)
	{
		var marginLeftTemp=35;
		$.ajax(
		{
			type: "POST",
			url: base_url+"index.php/ET_Componente/cargarNivel",
			cache: false,
			data: { codigoPartida: codigoPartida, nivel: nivel },
			success: function(resp)
			{
				var obj=JSON.parse(resp);

				if(obj.length==0)
				{
					return false;
				}
				var htmlTemp='<ul style="margin-left: '+marginLeftTemp+'px;">';
				for(var i=0; i<obj.length; i++)
				{
					if(obj[i].hasChild == false)
					{
						htmlTemp+='<li>'+
						'<input type="button" id="btnAgregar" class="btn btn-warning btn-xs" value="A" style="width: 25px;" onclick="seleccionar(\''+replaceAll(obj[i].Descripcion,'"','*')+'\',\''+obj[i].Unidad+'\', \''+obj[i].RendimientoMO+'\');" style="margin: 1px;">'+
						'<span class="nivel">'+obj[i].Descripcion+ ((obj[i].Simbolo == null) ? "" : ' ('+obj[i].Simbolo+')')+'</span>'+
						'</li>';
					}
					else
					{
						htmlTemp+='<li>'+
						'<input type="button" style="width: 25px;" class="btn btn-default btn-xs" value="+" onclick="elegirAccion(\''+obj[i].CodPartida+'\', '+(obj[i].Nivel+1)+', this);" style="margin: 1px;">'+
						'<span class="nivel">'+obj[i].Descripcion+ ((obj[i].Simbolo == null) ? "" : ' ('+obj[i].Simbolo+')')+'</span>'+
					'</li>';
					}
				}

				htmlTemp+='</ul>';
				$(element).parent().append(htmlTemp);
			}
		});
	}

	function ContraerSubLista(element)
	{
		$(element).parent().find('>ul').remove();
	}

	function seleccionar(partida,unidad,rendimiento)
	{
		var nuevoPartida = replaceAll(partida,'*','"');
		$('#selectDescripcionPartida').val(nuevoPartida);
		if(unidad=='null')
		{
			$('#selectUnidadMedidaPartida').html('<option val="UNIDAD">UNIDAD</option>');
			$('#selectUnidadMedidaPartida').selectpicker('refresh');
			$('#selectUnidadMedidaPartida').selectpicker('val', "UNIDAD");
		}
		else
		{
			$('#selectUnidadMedidaPartida').html('<option val="'+unidad+'">'+unidad+'</option>');
			$('#selectUnidadMedidaPartida').selectpicker('refresh');
			$('#selectUnidadMedidaPartida').selectpicker('val', unidad);
		}
	}

	function elegirAccion(codigoInsumo, nivel, element)
	{
		var valueButton =  $(element).attr('value');
		if(valueButton == '+')
		{
			MostrarSubLista(codigoInsumo, nivel, element);
			$(element).attr('value','-');
		}
		else
		{
			ContraerSubLista(element);
			$(element).attr('value','+');
		}
	}

	$(function()
	{
		limpiarArbolCompletoMasOpciones();

		$('#selectBuscarPartida').selectpicker({ liveSearch: true }).ajaxSelectPicker(
		{
	        ajax: {
	            url: base_url+'index.php/ET_Lista_Partida/verPorDescripcion',
	            data: { valueSearch : '{{{q}}}' }
	        },
	        locale:
	        {
	        	statusInitialized : 'Escriba para buscar partida',
	            statusNoResults : 'No se encontro',
	            statusSearching : 'Buscando...',
	            searchPlaceholder : 'Buscar',
	            emptyTitle : 'Buscar Partida'
	        },
	        preprocessData: function(data)
	        {
	        	var dataForSelect=[];

	        	for(var i=0; i<data.length; i++)
	        	{
	        		dataForSelect.push(
	                {
	                    "value" : data[i].Descripcion,
	                    "text" : data[i].Descripcion,
	                    "data" :
	                    {
	                    	"unidad" : data[i].Unidad,
	                    	"rendimiento" : data[i].RendimientoMO
	                    },
	                    "disabled" : false
	                });
	        	}

	            return dataForSelect;
	        },
	        preserveSelected: false
	    });

	    $('#selectBuscarPartida').on('change', function()
	    {
			var selected=$(this).find("option:selected").val();
			var unidad ='';
			if(selected.trim()!='')
			{
				unidad=$(this).find("option:selected").data('unidad');
				$('#selectDescripcionPartida').val(selected);
			}
			if(unidad===undefined)
			{
				$('#selectUnidadMedidaPartida').html('<option val="UNIDAD">UNIDAD</option>');	
				$('#selectUnidadMedidaPartida').selectpicker('refresh');
				$('#selectUnidadMedidaPartida').selectpicker('val', "UNIDAD");
			}
			else
			{
				$('#selectUnidadMedidaPartida').html('<option val="'+unidad+'">'+unidad+'</option>');
				$('#selectUnidadMedidaPartida').selectpicker('refresh');	
				$('#selectUnidadMedidaPartida').selectpicker('val',unidad);
			}
	    });

	    $('#selectUnidadMedidaPartida').selectpicker({ liveSearch: true }).ajaxSelectPicker(
		{
	        ajax: {
	            url: base_url+'index.php/Unidad_Medida/listaUnidadMedida',
	            data: { valueSearch : '{{{q}}}' }
	        },
	        locale: {
	            statusInitialized : 'Escriba para buscar unidad',
	            statusNoResults : 'No se encontro',
	            statusSearching : 'Buscando...',
	            searchPlaceholder : 'Buscar',
	            emptyTitle : 'Buscar Unidad'
	        },
	        preprocessData: function(data)
	        {
	        	var dataForSelect=[];
	        	for(var i=0; i<data.length; i++)
	        	{
	        		dataForSelect.push(
	                {
	                    "value" : data[i].descripcion,
	                    "text" : data[i].descripcion,
	                    "data" :
	                    {
	                    	"id-unidad" : data[i].id_unidad
	                    },
	                    "disabled" : false
	                });
	        	}

	            return dataForSelect;
	        },
	        preserveSelected: false
	    });

		$('#divImportarComponente').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectComponente:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción del componente" es requerido.</b>'
						}
					}
				},
				selectPresupuestoEjecucionI:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Estructurao de Presupuesto" es requerido.</b>'
						}
					}

				}
			}
		});

		$('#divAgregarComponente').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtDescripcionComponente:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción del componente" es requerido.</b>'
						}
					}
				},
				selectPresupuestoEjecucion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Estructurao de Presupuesto" es requerido.</b>'
						}
					}

				}
			}
		});

		$('#divAgregarPartida').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectDescripcionPartida:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción partida" es requerido.</b>'
						}
					}
				},
				selectUnidadMedidaPartida:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad" es requerido.</b>'
						}
					}
				},
				txtCantidadPartida:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Cantidad" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
	                        message: '<b style="color: red;">El campo "Cantidad" debe ser un número.</b>'
	                    }
					}
				},
				txtPrecioUnitarioPartida:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Precio unitario" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
	                        message: '<b style="color: red;">El campo "Precio unitario" debe ser en soles.</b>'
	                    }
					}
				}
			}
		});
	});
</script>
