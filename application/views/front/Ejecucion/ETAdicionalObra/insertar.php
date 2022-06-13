<?php
function mostrarMetaAnidada($meta, $idExpedienteTecnico, $idPresupuestoEjecucion)
{
	$htmlTemp='';
	$htmlTemp.='<li class="listaNivelAdicional'.$meta->nivel.'">';
	$htmlTemp.='<input type="button" title="Guardar Cambios" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosMetaAdicional('.$meta->id_meta.');" style="width: 30px;">
		<input type="button" title="Eliminar Meta" class="btn btn-default btn-xs" value="-" onclick="eliminarMetaAdicional('.$meta->id_meta.', this);" style="width: 30px;">
		<input type="button" title="Resolución de Aprobación de Adicional de Obra" class="btn btn-default btn-xs" value="R" onclick="subirResolucionAprobacionMeta('.$meta->id_meta.');" style="width: 30px;">
		<button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'.$meta->id_meta.'"><i class="fa fa-expand"></i></button>';

		$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Meta" value="+M" onclick="agregarMetaAdicional(\'\', $(this).parent(), '.$meta->id_meta.', '.$meta->nivel.', '.$idPresupuestoEjecucion.')" style="width: 30px;">';

		$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Partida" value="+P" onclick="renderizarAgregarPartidaAdicional($(this).parent(), '.$meta->id_meta.','.$idPresupuestoEjecucion.')" style="width: 30px;">';

		if($idPresupuestoEjecucion==16 && $meta->nivel==1)
		{
			$htmlTemp.='<input type="button" class="btn btn-default btn-xs" title="Agregar Clasificador" value="+C" onclick="paginaAjaxDialogo(\'clasificadorMeta\', \'Asociar a Clasificador\', { idET : '.$idExpedienteTecnico.', idMeta : '.$meta->id_meta.'}, \''.base_url().'index.php/ET_Meta_Analitico/insertar\', \'get\', null, null, false, true);" style="width: 30px;" style="width: 30px;">';
		}

		$htmlTemp.='<span style="text-transform: uppercase; font-weight: bold;" id="nombreMetaAdicional'.$meta->id_meta.'" contenteditable>'.html_escape($meta->desc_meta).'</span>'.
		((count($meta->childMeta)==0 && count($meta->childPartida))>0 ? '<div style="margin-bottom : 8px;margin-top : 2px;" id="demo'.$meta->id_meta.'" class="collapse"><table class ="tablaPartidas"><thead><th class = "col-md-2">OPCIONES</th><th class = "col-md-6">PARTIDA</th><th class = "col-md-1">U. MEDIDA</th><th class = "col-md-1">CANTIDAD</th><th class = "col-md-1">PRECIO U.</th><th class = "col-md-1">TOTAL</th></thead><tbody>' : '<ul>');

	if(count($meta->childMeta)==0)
	{
		foreach($meta->childPartida as $key => $value)
		{
			$htmlTemp.='<tr id="rowPartida'.$value->id_partida.'" style="color: '.($value->partidaCompleta ? 'blue' : 'red').';" class="liPartidaAdicional">'.
				'<td>'.
					'<input type="button" title="Guardar Cambios" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosPartidaAdicional('.$value->id_partida.');" style="width: 30px;">'.
					'<input type="button" title="Eliminar Partida" class="btn btn-default btn-xs" value="-" onclick="eliminarPartidaAdicional('.$value->id_partida.', this);" style="width: 30px;">'.
					'<input type="button" title="Resolución de Aprobación de Adicional de Obra" class="btn btn-default btn-xs" value="R" onclick="subirResolucionAprobacionPartida('.$value->id_partida.', this);" style="width: 30px;">';
					// if($idPresupuestoEjecucion==2)
					// {
						$htmlTemp.='<input type="button" title="Análisis Unitario" class="btn btn-default btn-xs" value="A" onclick="paginaAjaxDialogo(\'otherModal\', \'Análisis presupuestal\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
					// }
					// else
					// {
					// 	$htmlTemp.='<input type="button" title="Asociar Clasificador" class="btn btn-default btn-xs" value="C" onclick="paginaAjaxDialogo(\'otherModal\', \'Asociar Clasificador\', { idET : '.$idExpedienteTecnico.', idPartida : '.$value->id_partida.', idPresupuesto :'.$idPresupuestoEjecucion.' }, \''.base_url().'index.php/ET_Analisis_Unitario/insertar\', \'get\', null, null, false, true);" style="width: 30px;">';
					// }
					
				$htmlTemp.='</td>'.
				'<td style="text-transform: uppercase;"><span id="nombrePartidaAdicional'.$value->id_partida.'" contenteditable>'.html_escape($value->desc_partida).'</span></td>'.
				'<td style="text-align: right; text-transform: uppercase;">'.html_escape($value->descripcion).'</td>'.
				'<td style="text-align: right;"><span id="cantidadPartida'.$value->id_partida.'" contenteditable>'.html_escape($value->cantidad).'</span></td>'.
				'<td style="text-align: right;"><span id="precioUnitarioPartidaAdicional'.$value->id_partida.'" contenteditable>'.$value->precio_unitario.'</span></td>';
				$htmlTemp.='<td style="text-align: right;">'. number_format($value->parcial, 2).'</td>'.
			'</tr>';
		}
	}

	foreach($meta->childMeta as $key => $value)
	{
		$htmlTemp.=mostrarMetaAnidada($value, $idExpedienteTecnico,$idPresupuestoEjecucion);
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

	.listaNivelAdicional1
	{
		color:#1d73c9;
		padding-left:37px;
	}

	.listaNivelAdicional2
	{
		color:#fba905;
		padding-left:37px;
	}
	.listaNivelAdicional3
	{		
		color:#249991;
		padding-left:37px;
	}

	.listaNivelAdicional4
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
	.liPartidaAdicional
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
	<div id="divAgregarComponenteAdicional" class="row" style="margin-top: 3px;">
		<div class="col-md-2 col-sm-12 col-xs-12">
			<div>
				<select id="selectPresupuestoEjecucionAdicional" name="selectPresupuestoEjecucionAdicional" class="form-control">
					<option value="">Estructura de Presupuesto</option>
					<?php foreach ($PresupuestoEjecucion as $key => $value) { ?>
						<option value="<?=$value->id_presupuesto_ej?>"><?=$value->desc_presupuesto_ej?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="col-md-8 col-sm-12 col-xs-12">
			<input type="text" class="form-control" id="txtDescripcionComponenteAdicional" name="txtDescripcionComponenteAdicional" placeholder="Descripción del componente (Adicional)">
		</div>
		<div class="col-md-2 col-sm-12 col-xs-12">
			<input type="button" class="btn btn-info" value="Agregar componente" onclick="agregarComponenteAdicional();" style="width: 100%;">
		</div>
	</div>
	<div id="divAgregarPartidaAdicional" class="row" style="display: none;margin-top: 2px;">
		<div class="col-md-6">
			<label>.</label>
			<div>
				<select name="selectBuscarPartidaAdicional" id="selectBuscarPartidaAdicional" class="form-control selectpicker"></select>
			</div>
			<input type="hidden" name='hdIdPresupuestoEjecucionAdicional' id='hdIdPresupuestoEjecucionAdicional'>
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
			<div id="validarPartidaAdicional">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label for="control-label">Partida (Adicional):</label>
						<div>
							<input type="text" id="selectDescripcionPartidaAdicional" name="selectDescripcionPartidaAdicional" autocomplete="off" class="form-control" placeholder="Busque o ingrese una partida">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="control-label">Unidad</label>
						<div>
							<select  name="selectUnidadMedidaPartidaAdicional" id="selectUnidadMedidaPartidaAdicional" class="form-control selectpicker">
								<option value="">Buscar Unidad</option>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label for="control-label">Cantidad:</label>
						<div>
							<input type="text" id="txtCantidadPartidaAdicional" name="txtCantidadPartidaAdicional" autocomplete="off" class="form-control">
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<label for="control-label">Precio:</label>
						<div>
							<input type="text" id="txtPrecionUnitarioAdicional" name="txtPrecionUnitarioAdicional" autocomplete="off" class="form-control" placeholder="0.00">
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<br>
				<div class="col-md-6 col-sm-2 col-xs-12">
					<input type="hidden" id="hdIdListaPartidaAdicional" name="hdIdListaPartidaAdicional">
					<input type="button" class="btn btn-success" value="Guardar" onclick="agregarPartidaAdicional();">
					<input type="button" class="btn btn-danger" value="Cerrar" onclick="cerrar();">
				</div>
			</div>
		</div>
	</div>
	<hr style="margin-top: 1px;">
	<div class="row" style="height: 300px;overflow-y: scroll;">
		<div class="col-md-12 col-sm-12 col-xs-12">
            <div class="accordion" id="accordionAdicional" role="tablist" aria-multiselectable="true">
                <?php foreach ($expedienteTecnico->childPresupuestoEjecucion as $key => $temp3) { ?>                
                <div class="panel">
                    <div class="panel-heading" style="padding: 6px;">
                        <a class="panel-title" id="Adicionalheading<?=$temp3->id_presupuesto_ej?>" data-toggle="collapse" data-parent="#accordionAdicional" href="#Adicionalcollapse<?=$temp3->id_presupuesto_ej?>" aria-expanded="false" aria-controls="Adicionalcollapse<?=$temp3->id_presupuesto_ej?>" style="text-transform: uppercase;"><?=$temp3->desc_presupuesto_ej?>
                        </a>
                    </div>
                    <div id="Adicionalcollapse<?=$temp3->id_presupuesto_ej?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="Adicionalheading<?=$temp3->id_presupuesto_ej?>">
                        <div class="panel-body">
	                        <ul id="ulComponenteMetaPartidaAdicional<?=$temp3->id_presupuesto_ej?>" style="list-style-type: upper-roman;">
								<?php foreach($temp3->childComponente as $key => $value) { ?>
									<li>
										<input type="button" class="btn btn-default btn-xs" value="G" title="Guardar Cambios" onclick="guardarCambiosComponenteAdicional(<?=$value->id_componente?>);" style="width: 30px;">
										<input type="button" class="btn btn-default btn-xs" value="+M" title="Agregar Meta" onclick="agregarMetaAdicional(<?=$value->id_componente?>, $(this).parent(), '',1,<?=$temp3->id_presupuesto_ej?>);" style="width: 30px;">										
										<input type="button" class="btn btn-default btn-xs" value="+R" title="Resolución de Aprobación de Adicional de Obra" onclick="subirResolucionAprobacion(<?=$value->id_componente?>);" style="width: 30px;">
										<input type="button" class="btn btn-default btn-xs" value="-" title="Eliminar Componente" onclick="eliminarComponenteAdicional(<?=$value->id_componente?>,<?=$value->id_presupuesto_ej?>, this);" style="width: 30px;"><b style="text-transform: uppercase; color: black;" id="nombreComponenteAdicional<?=$value->id_componente?>" contenteditable><?=html_escape($value->descripcion)?></b>
										<ul>
											<?php foreach($value->childMeta as $index => $item){ ?>
												<?=mostrarMetaAnidada($item, $expedienteTecnico->id_et, $temp3->id_presupuesto_ej);?>
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
		<input type="hidden" id="hdIdETAdicional" value="<?=$expedienteTecnico->id_et?>">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>
</div>
<script>
	function cerrar()
	{
		$('#divAgregarPartidaAdicional').hide(1000);
	}
	function limpiarArbolCompletoMasOpciones()
	{

		limpiarText('divAgregarPartidaAdicional', []);
	}

	function agregarComponenteAdicional()
	{
		$('#divAgregarComponenteAdicional').data('formValidation').resetField($('#txtDescripcionComponenteAdicional'));
		$('#divAgregarComponenteAdicional').data('formValidation').resetField($('#selectPresupuestoEjecucionAdicional'));

		$('#divAgregarComponenteAdicional').data('formValidation').validate();

		if(!($('#divAgregarComponenteAdicional').data('formValidation').isValid()))
		{
			return;
		}

		var existeComponente=false;

		var PresupuestoEjecucion=$('#selectPresupuestoEjecucionAdicional').val();

		$('#ulComponenteMetaPartidaAdicional'+PresupuestoEjecucion).find('> li > b').each(function(index, element)
		{
			if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll($('#txtDescripcionComponenteAdicional').val(), ' ', '').toLowerCase())
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

		paginaAjaxJSON({ "idET" : $('#hdIdETAdicional').val(), "descripcionComponente" : $('#txtDescripcionComponenteAdicional').val().trim(), idPresupuestoEjecucion:PresupuestoEjecucion }, base_url+'index.php/ET_AdicionalObra/insertar', 'POST', null, function(objectJSON)
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
				'<input type="button" class="btn btn-default btn-xs" value="G" title="Guardar Cambios" onclick="guardarCambiosComponenteAdicional('+objectJSON.idComponente+');" style="width: 30px;"> ';

				htmlTemp+='<input type="button" class="btn btn-default btn-xs" value="+M" title="Agregar Meta" onclick="agregarMetaAdicional('+objectJSON.idComponente+', $(this).parent(), \'\',1,'+PresupuestoEjecucion+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" value="+R" title="Resolución de Aprobación de Adicional de Obra" onclick="subirResolucionAprobacion('+objectJSON.idComponente+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" value="-" title="Eliminar Componente" onclick="eliminarComponenteAdicional('+objectJSON.idComponente+','+PresupuestoEjecucion+', this);" style="width: 30px;"><b style="text-transform: uppercase; color: black;" id="nombreComponenteAdicional'+objectJSON.idComponente+'" contenteditable>'+replaceAll(replaceAll($('#txtDescripcionComponenteAdicional').val().trim(), '<', '&lt;'), '>', '&gt;')+'</b>';
				htmlTemp+='<ul></ul></li>';


			$('#ulComponenteMetaPartidaAdicional'+PresupuestoEjecucion).append(htmlTemp);

			$('#txtDescripcionComponenteAdicional').val('');

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}

	function guardarCambiosComponenteAdicional(idComponente)
	{
		if($('#nombreComponenteAdicional'+idComponente).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El nombre del componente es obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombreComponenteAdicional'+idComponente).text('___');

			return;
		}

		paginaAjaxJSON({ "idComponente" : idComponente, 'descripcionComponente' : replaceAll(replaceAll($('#nombreComponenteAdicional'+idComponente).text().trim(), '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/ET_Componente/editarDescComponente', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			$('#nombreComponenteAdicional'+idComponente).text($('#nombreComponenteAdicional'+idComponente).text().trim());
		}, false, true);
	}

	function guardarCambiosMetaAdicional(idMeta)
	{
		if($('#nombreMetaAdicional'+idMeta).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El nombre de la meta es obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombreMetaAdicional'+idMeta).text('___');

			return;
		}

		paginaAjaxJSON({ "idMeta" : idMeta, 'descripcionMeta' : replaceAll(replaceAll($('#nombreMetaAdicional'+idMeta).text().trim(), '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/ET_Meta/editarDescMeta', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
			},
			function(){});

			$('#nombreMetaAdicional'+idMeta).text($('#nombreMetaAdicional'+idMeta).text().trim());
		}, false, true);
	}

	function guardarCambiosPartidaAdicional(idPartida)
	{
		var nombrePartida = $('#nombrePartidaAdicional'+idPartida).text().trim();
		var cantidad = $('#cantidadPartidaAdicional'+idPartida).text().trim();
		var precioUnitario = $('#precioUnitarioPartidaAdicional'+idPartida).text().trim();
		if(nombrePartida=='')
		{
			swal(
			{
				title: '',
				text: 'Partida es un campo obligatorio.',
				type: 'error'
			},
			function(){});

			$('#nombrePartidaAdicional'+idPartida).text('___');

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

			$('#cantidadPartidaAdicional'+idPartida).text('___');

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

			currentRow.find("td:eq(1)").html('<span id="nombrePartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+nombrePartida+'</span>');

			currentRow.find("td:eq(3)").html('<span id="cantidadPartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+(parseFloat(objectJSON.cantidad).toFixed(2))+'</span>');

			currentRow.find("td:eq(4)").html('<span id="precioUnitarioPartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+(parseFloat(objectJSON.precioUnitario).toFixed(2))+'</span>');

			currentRow.find("td:eq(5)").text(parseFloat(objectJSON.precioParcial).toFixed(2));

			limpiarArbolCompletoMasOpciones();
		}, false, true);
	}


	function eliminarComponenteAdicional(idComponente,idPresupuestoEjecucion, element)
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


	function eliminarMetaAdicional(idMeta, element)
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

	function agregarMetaAdicional(idComponente, elementoPadre, idMetaPadre, nivel, idPresupuestoEjecucion)
	{
		if($($(elementoPadre).find('> table')[0]).find('> tbody > .liPartidaAdicional').length>0)
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
			text: "Descripción de la Meta (Adicional)",
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

				var htmlTemp='<li class="listaNivelAdicional'+nivel+'">'+
					'<input type="button" class="btn btn-default btn-xs" title="Guardar Cambios" value="G" onclick="guardarCambiosMetaAdicional('+objectJSON.idMeta+');" style="width: 30px;"> <input type="button" class="btn btn-default btn-xs" title="Eliminar Meta" value="-" onclick="eliminarMetaAdicional('+objectJSON.idMeta+', this);" style="width: 30px;"> <input type="button" title="Resolución de Aprobación de Adicional de Obra" class="btn btn-default btn-xs" value="R" onclick="subirResolucionAprobacionMeta('+objectJSON.idMeta+');" style="width: 30px;"> <button type="button" title="Mostrar Partidas" class="btn btn-default btn-xs" style="width: 30px;" data-toggle="collapse" data-target="#demo'+objectJSON.idMeta+'"><i class="fa fa-expand"></i></button><input type="button" class="btn btn-default btn-xs" title="Agregar Meta" value="+M" onclick="agregarMetaAdicional(\'\', $(this).parent(), '+objectJSON.idMeta+','+(nivel+1)+','+idPresupuestoEjecucion+')" style="width: 30px;"><input type="button" class="btn btn-default btn-xs" title="Agregar Partida" value="+P" onclick="renderizarAgregarPartidaAdicional($(this).parent(), '+objectJSON.idMeta+','+idPresupuestoEjecucion+')" style="width: 30px;"><span style="text-transform: uppercase; font-weight: bold;" id="nombreMetaAdicional'+objectJSON.idMeta+'" contenteditable>'+descripcionMeta+'</span>';
					htmlTemp+='<ul></ul></li>';

				$($(elementoPadre).find('ul')[0]).append(htmlTemp);

				limpiarArbolCompletoMasOpciones();
			}, false, true);
		});

	}

	var elementoPadreParaAgregarPartida, metaPadreParaAgregarPartida;

	function renderizarAgregarPartidaAdicional(elementoPadre, metaPadre, idPresupuestoEjecucion)
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

		$('#divAgregarPartidaAdicional').show(1000);

		$('#hdIdPresupuestoEjecucionAdicional').val(idPresupuestoEjecucion);

		$(elementoPadre).css({ "background-color" : "#f5f5f5" });

		elementoPadreParaAgregarPartida=elementoPadre;
		metaPadreParaAgregarPartida=metaPadre;
	}
	function agregarPartidaAdicional()
	{

		$('#divAgregarPartidaAdicional').data('formValidation').resetField($('#selectDescripcionPartidaAdicional'));
		$('#divAgregarPartidaAdicional').data('formValidation').resetField($('#selectUnidadMedidaPartidaAdicional'));
		$('#divAgregarPartidaAdicional').data('formValidation').resetField($('#txtCantidadPartidaAdicional'));
		$('#divAgregarPartidaAdicional').data('formValidation').resetField($('#txtPrecionUnitarioAdicional'));

		$('#divAgregarPartidaAdicional').data('formValidation').validate();

		if(!($('#divAgregarPartidaAdicional').data('formValidation').isValid()))
		{
			return;
		}


		var existePartida=false;

		$($(elementoPadreParaAgregarPartida).find('table')[0]).find('> tbody > tr > td > b').each(function(index, element)
		{
			if(replaceAll($(element).text(), ' ', '').toLowerCase()==replaceAll($('#selectDescripcionPartidaAdicional').val(), ' ', '').toLowerCase())
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

		var idUnidad = $('#selectUnidadMedidaPartidaAdicional').val().trim();
		var descripcion = $('#selectDescripcionPartidaAdicional').val().trim();
		var cantidad = $('#txtCantidadPartidaAdicional').val();
		var precio = $('#txtPrecionUnitarioAdicional').val();
		var idLista = $('#hdIdListaPartidaAdicional').val();
		var idPresupuestoEjecucion = $('#hdIdPresupuestoEjecucionAdicional').val();

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

			var htmlTemp='<tr id="rowPartida'+objectJSON.idPartida+'" style="color: red;" class="liPartidaAdicional">'+
				'<td>'+
					'<input type="button" title="Guardar Cambios" class="btn btn-default btn-xs" value="G" onclick="guardarCambiosPartidaAdicional('+objectJSON.idPartida+');" style="width: 30px;">'+
					'<input type="button" title="Eliminar Partida" class="btn btn-default btn-xs" value="-" onclick="eliminarPartidaAdicional('+objectJSON.idPartida+', this);" style="width: 30px;">'+
					'<input type="button" title="Resolución de Aprobación de Adicional de Obra" class="btn btn-default btn-xs" value="R" onclick="subirResolucionAprobacionPartida('+objectJSON.idPartida+');" style="width: 30px;">';
				// if(idPresupuestoEjecucion==2)
				// {
					htmlTemp+='<input type="button" title="Análisis Unitario" class="btn btn-default btn-xs" value="A" onclick="paginaAjaxDialogo(\'otherModal\', \'Análisis presupuestal\', { idET : <?=$expedienteTecnico->id_et?>, idPartida : '+objectJSON.idPartida+', idPresupuesto : '+idPresupuestoEjecucion+' }, \''+base_url+'index.php/ET_Analisis_Unitario/insertar\''+', \'get\', null, null, false, true);" style="width: 30px;">';
				// }
				// else
				// {
				// 	htmlTemp+='<input type="button" title="Asociar Clasificador" class="btn btn-default btn-xs" value="C" onclick="paginaAjaxDialogo(\'otherModal\', \'Asociar Clasificador\', { idET : <?=$expedienteTecnico->id_et?>, idPartida : '+objectJSON.idPartida+', idPresupuesto : '+idPresupuestoEjecucion+' }, \''+base_url+'index.php/ET_Analisis_Unitario/insertar\''+', \'get\', null, null, false, true);" style="width: 30px;">';
				// }
				htmlTemp+='</td>'+
				'<td style="text-transform: uppercase;"><span id="nombrePartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+replaceAll(replaceAll($('#selectDescripcionPartidaAdicional').val().trim(), '<', '&lt;'), '>', '&gt;')+'</span></td>'+

				'<td style="text-align: right; text-transform: uppercase;">'+replaceAll(replaceAll(objectJSON.descripcionUnidadMedida, '<', '&lt;'), '>', '&gt;')+'</td>'+

				'<td style="text-align: right;"><span id="cantidadPartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+ parseFloat(objectJSON.cantidadDetallePartida).toFixed(2)+'</span></td>'+

				'<td style="text-align: right;"><span id="precioUnitarioPartidaAdicional'+objectJSON.idPartida+'" contenteditable>'+parseFloat(objectJSON.precioUnitarioDetallePartida).toFixed(2)+'</span></td>'+

				'<td style="text-align: right;">'+parseFloat(objectJSON.precioParcialDetallePartida).toFixed(2)+'</td>'+
			'</tr>';
			if(!($(elementoPadreParaAgregarPartida).find('table').length))
			{
				$($(elementoPadreParaAgregarPartida).find('ul')[0]).replaceWith('<div id="demo'+metaPadreParaAgregarPartida+'" style="margin-bottom : 8px;margin-top : 2px;" class="collapse"><table class ="tablaPartidas"><thead><th class = "col-md-2">OPCIONES</th><th class = "col-md-6">PARTIDA</th><th class = "col-md-1">U. MEDIDA</th><th class = "col-md-1">CANTIDAD</th><th class = "col-md-1">PRECIO U.</th><th class = "col-md-1">TOTAL</th></thead><tbody></tbody</table></div>');
			}

			$($(elementoPadreParaAgregarPartida).find('table > tbody')[0]).append(htmlTemp);

			$('#selectUnidadMedidaPartidaAdicional').html('<option val="">Buscar Partida</option>');
			$('#selectUnidadMedidaPartidaAdicional').selectpicker('refresh');

			limpiarArbolCompletoMasOpciones();
		}, false, true);

	}

	function eliminarPartidaAdicional(idPartida, element)
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
		$('#selectDescripcionPartidaAdicional').val(nuevoPartida);
		if(unidad=='null')
		{
			$('#selectUnidadMedidaPartidaAdicional').html('<option val="UNIDAD">UNIDAD</option>');
			$('#selectUnidadMedidaPartidaAdicional').selectpicker('refresh');
			$('#selectUnidadMedidaPartidaAdicional').selectpicker('val', "UNIDAD");
		}
		else
		{
			$('#selectUnidadMedidaPartidaAdicional').html('<option val="'+unidad+'">'+unidad+'</option>');
			$('#selectUnidadMedidaPartidaAdicional').selectpicker('refresh');
			$('#selectUnidadMedidaPartidaAdicional').selectpicker('val', unidad);
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

	function subirResolucionAprobacion(idComponente)
	{
		paginaAjaxDialogo('resolucionComponente', 'Resolución de Aprobación de Adicional de Obra',{ idComponente: idComponente}, base_url+'index.php/ET_AdicionalObra/resolucionComponente', 'GET', null, null, false, true);
	}

	function subirResolucionAprobacionMeta(idMeta)
	{
		paginaAjaxDialogo('resolucionMeta', 'Resolución de Aprobación de Adicional de Obra',{ idMeta: idMeta}, base_url+'index.php/ET_AdicionalObra/resolucionMeta', 'GET', null, null, false, true);
	}

	function subirResolucionAprobacionPartida(idPartida)
	{
		paginaAjaxDialogo('resolucionPartida', 'Resolución de Aprobación de Adicional de Obra',{ idPartida: idPartida}, base_url+'index.php/ET_AdicionalObra/resolucionPartida', 'GET', null, null, false, true);
	}

	$(function()
	{
		limpiarArbolCompletoMasOpciones();

		$('#selectBuscarPartidaAdicional').selectpicker({ liveSearch: true }).ajaxSelectPicker(
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

	    $('#selectBuscarPartidaAdicional').on('change', function()
	    {
			var selected=$(this).find("option:selected").val();
			var unidad ='';
			if(selected.trim()!='')
			{
				unidad=$(this).find("option:selected").data('unidad');
				$('#selectDescripcionPartidaAdicional').val(selected);
			}
			if(unidad===undefined)
			{
				$('#selectUnidadMedidaPartidaAdicional').html('<option val="UNIDAD">UNIDAD</option>');	
				$('#selectUnidadMedidaPartidaAdicional').selectpicker('refresh');
				$('#selectUnidadMedidaPartidaAdicional').selectpicker('val', "UNIDAD");
			}
			else
			{
				$('#selectUnidadMedidaPartidaAdicional').html('<option val="'+unidad+'">'+unidad+'</option>');
				$('#selectUnidadMedidaPartidaAdicional').selectpicker('refresh');	
				$('#selectUnidadMedidaPartidaAdicional').selectpicker('val',unidad);
			}
	    });

	    $('#selectUnidadMedidaPartidaAdicional').selectpicker({ liveSearch: true }).ajaxSelectPicker(
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

		$('#divAgregarComponenteAdicional').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtDescripcionComponenteAdicional:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción del componente" es requerido.</b>'
						}
					}
				},
				selectPresupuestoEjecucionAdicional:
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

		$('#divAgregarPartidaAdicional').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectDescripcionPartidaAdicional:
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
				txtCantidadPartidaAdicional:
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
				txtPrecionUnitarioAdicional :
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
