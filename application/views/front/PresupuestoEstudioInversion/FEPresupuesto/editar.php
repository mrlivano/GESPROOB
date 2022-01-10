<form class="form-horizontal"  id="form-editFePresupuesto">
		<h4 style="margin-bottom: 0px;">Datos generales</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control" name="cbx_estudioInversion" value="<?=html_escape($fePresupuestoInv->nombre_est_inv)?>" id="cbx_estudioInversion" autocomplete="off" disabled="disabled">
				<input type="hidden" name="hdIdPresupuestoFE" value="<?=$fePresupuestoInv->id_presupuesto_fe?>">
				<input type="hidden" name="idEstudioInversion"  value="<?=$fePresupuestoInv->id_est_inv?>">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<label>Sector</label>
				<select id="cbx_Sector" name="cbx_Sector" class="form-control notValidate" required="">
					<?php foreach($listarSector as $item ){ ?>
						 <option <?=($fePresupuestoInv->id_sector==$item->id_sector ? 'selected' : '')?> value="<?=$item->id_sector?>"><?=html_escape($item->nombre_sector)?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<label>Pliego</label>
				<input type="text" class="form-control" id="txtPliego" name="txtPliego" placeholder="Pliego" value="<?=html_escape($fePresupuestoInv->pliego)?>" autocomplete="off">
			</div>
		</div>
		<h4 style="margin-bottom: 0px;">Fuente de financiamiento</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row" id="divPresupuestoFuente">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Descripción Fuente</label>
				<select id="selectIdFuente" name="selectIdFuente" class="form-control notValidate" required="">
					<?php foreach($listarFuenteFinanciamiento as $item ){ ?>
						 <option value="<?=$item->id_fuente_finan.','.html_escape($item->nombre_fuente_finan)?>"><?=html_escape($item->nombre_fuente_finan)?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Correlativo Meta</label>
				<input type="text" class="form-control" id="txtCorelativoMeta" name="txtCorelativoMeta" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Año</label>
				<input type="text" class="form-control" id="txtAnio" name="txtAnio" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>.</label>
				<input type="button" id="btnAgregarFEPresupuestoFuente" class="btn btn-success form-control" value="Agregar">
			</div>
		</div>
		<div>
			<table id="table-PresupestoFormulacion" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>Descripcion de la Fuente</td>
						<td>Correlativo Meta</td>
						<td>Año</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($listaFEPresupuestoFuente as $item){ ?>
						<tr>
							<td><input type="hidden" value="<?=$item->id_fuente_finan?>" name="hdIdFuente[]"><?=$item->nombre_fuente_finan?></td>
							<td><input type="hidden" value="<?=$item->correlativo_meta?>" name="hdCorrelativoMeta[]"><?=$item->correlativo_meta?></td>
							<td><input type="hidden" value="<?=$item->anio_pres_fuen?>" name="hdAnio[]"><?=substr($item->anio_pres_fuen, 0, 4)?></td>
							<td><a href="#" onclick="$(this).parent().parent().remove();" style="color: red;font-weight: bold;text-decoration: underline;">Eliminar</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
		<div class="row" style="text-align: right;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar cambios</button>
			<button class="btn btn-warning" onclick="paginaAjaxDialogo(null, 'Registrar detalle de gastos', { idPresupuestoFE : '<?=$fePresupuestoInv->id_presupuesto_fe?>' }, base_url+'index.php/FE_Detalle_Presupuesto/insertar', 'GET', null, null, false, true);">Ir a detalle de gastos</button>
			<button class="btn btn-danger" data-dismiss="modal">Cerrar</button>
		</div>
</form>
<script>
	$("#btnAgregarFEPresupuestoFuente").on('click', function(event)
	{
		$('#divPresupuestoFuente').data('formValidation').resetField($('#txtCorelativoMeta'));
		$('#divPresupuestoFuente').data('formValidation').resetField($('#txtAnio'));
		
		$('#divPresupuestoFuente').data('formValidation').validate();

		if(!($('#divPresupuestoFuente').data('formValidation').isValid()))
		{
			return;
		}

		var posicionSeparadorTemp=$('#selectIdFuente').val().indexOf(',');
		var idFuente=$('#selectIdFuente').val().substring(0, posicionSeparadorTemp);
		var descripcionFuente=replaceAll(replaceAll($('#selectIdFuente').val().substring(posicionSeparadorTemp+1, $('#selectIdFuente').val().length), '<', '&lt;'), '>', '&lt;');

		var htmlTemp='<tr>'+
			'<td><input type="hidden" value='+idFuente+' name="hdIdFuente[]"> '+descripcionFuente+'</td>'+
			'<td><input type="hidden" value='+replaceAll(replaceAll($('#txtCorelativoMeta').val(), '<', '&lt;'), '>', '&gt;')+' name="hdCorrelativoMeta[]">'+replaceAll(replaceAll($('#txtCorelativoMeta').val(), '<', '&lt;'), '>', '&gt;')+'</td>'+
			'<td><input type="hidden" value='+$('#txtAnio').val()+' name="hdAnio[]">'+$('#txtAnio').val()+'</td>'+
			'<td><a href="#" onclick="$(this).parent().parent().remove();" style="color: red;font-weight: bold;text-decoration: underline;">Eliminar</a></td>'+
		'</tr>'

		$('#table-PresupestoFormulacion > tbody').append(htmlTemp);

		limpiarText('divPresupuestoFuente', []);
	});

	$(function()
	{
		$('#form-editFePresupuesto').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtSector:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Sector" es requerido.</b>'
						}
					}
				},
				txtPliego:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Pliego" es requerido.</b>'
						}
					}
				}
			}
		});

		$('#divPresupuestoFuente').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectIdFuente:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción fuente" es requerido.</b>'
						}
					}
				},
				txtCorelativoMeta:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Correlativo Meta" es requerido.</b>'
						}
					}
				},
				txtAnio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Año" es requerido.</b>'
						},
						regexp:
	                    {
	                        regexp: "^([0-9]){4}$",
	                        message: '<b style="color: red;">El campo "Año" debe ser un número de 4 díjitos.</b>'
	                    }
					}
				}
			}
		});	
	});

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		paginaAjaxJSON($('#form-editFePresupuesto').serialize(), '<?=base_url();?>index.php/FE_Presupuesto_Inv/editar', 'POST', null, function(objectJSON)
		{
			$('#modalTemp').modal('hide');

			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function()
			{
				window.location.href='<?=base_url();?>index.php/FE_Presupuesto_Inv/index/'+objectJSON.idEstudioInversion;

				renderLoading();
			});
		}, false, true);
	});
</script>