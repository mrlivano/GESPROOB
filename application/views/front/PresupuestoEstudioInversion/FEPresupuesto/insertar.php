<form class="form-horizontal"  id="form-addFePresupuesto">
		<h4 style="margin-bottom: 0px;">Datos generales</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control" name="cbx_estudioInversion" value="<?= $nombreProyectoInver->nombre_est_inv?>" id="cbx_estudioInversion" autocomplete="off" disabled="disabled">
				<input type="hidden" class="form-control" name="idEstudioInversion"  value="<?= $nombreProyectoInver->id_est_inv?>" id="idEstudioInversion" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-6 col-xs-12">
				<label>Sector</label>
				<select id="cbx_Sector" name="cbx_Sector" class="form-control notValidate" required="">
					<?php foreach($listarSector as $item ){ ?>
						 <option value="<?=$item->id_sector?>"><?=$item->nombre_sector?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<label>Pliego</label>
				<input type="text" class="form-control" id="txtPliego" name="txtPliego" placeholder="Pliego" autocomplete="off" maxlength="200">
			</div>
		</div>
		<h4 style="margin-bottom: 0px;">Fuente de financiamiento</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row" id="divPresupuestoFuente">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Descripción Fuente</label>
				<select id="selectIdFuente" name="selectIdFuente" class="form-control notValidate" required="">
					<?php foreach($listarFuenteFinanciamiento as $item ){ ?>
						 <option value="<?=$item->id_fuente_finan.','.$item->nombre_fuente_finan?>"><?=$item->nombre_fuente_finan?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Correlativo Meta</label>
				<input type="text" class="form-control" id="txtCorelativoMeta" name="txtCorelativoMeta" autocomplete="off" maxlength="100">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Año</label>
				<input type="text" class="form-control" id="txtAnio" name="txtAnio" autocomplete="off" maxlength="4">
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
				<tbody></tbody>
			</table>
		</div>
		<div class="row" style="text-align: right;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Registrar fuente de finan.</button>
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
		var descripcionFuente=replaceAll(replaceAll($('#selectIdFuente').val().substring(posicionSeparadorTemp+1, $('#selectIdFuente').val().length), '<', '&lt;'), '>', '&gt;');

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
		$('#form-addFePresupuesto').formValidation(
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
						},
	                    stringLength:
	                    {
	                        max: 200,
	                        message: '<b style="color: red;">El campo "Pliego" no puede exceder los 200 cáracteres.</b>'
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
						},
	                    stringLength:
	                    {
	                        max: 100,
	                        message: '<b style="color: red;">El campo "Correlativo Meta" no puede exceder los 100 cáracteres.</b>'
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
	                    },
	                    stringLength:
	                    {
	                        max: 4,
	                        message: '<b style="color: red;">El campo "Año" no puede exceder los 4 cáracteres.</b>'
	                    }
					}
				}
			}
		});	
	});

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		$('#form-addFePresupuesto').data('formValidation').validate();

		if(!($('#form-addFePresupuesto').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-addFePresupuesto').serialize(), '<?=base_url();?>index.php/FE_Presupuesto_Inv/insertar', 'POST', null, function(objectJSON)
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