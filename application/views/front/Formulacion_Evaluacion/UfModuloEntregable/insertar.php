<style type="text/css">
	.modal-dialog
	{
		width: 90%;
		margin: 0;
		margin-left: 5%;
		padding: 0;
	}

	.modal-content
	{
		height: auto;
		min-height: 100%;
		border-radius: 0;
	}
</style>
<form class="form-horizontal"  id="form-addEntregable">
		<h4 style="margin-bottom: 0px;">Datos Estudio</h4>
		<hr style="margin: 1px;margin-bottom: 5px;">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<input type="text" class="form-control" name="cbx_estudioInversion" value="<?= $DetallEstudioInversion->nombre_estudio_inv?>" id="cbx_estudioInversion" autocomplete="off" disabled="disabled">
				<input type="hidden" class="form-control" name="id_est_inv"  value="<?= $DetallEstudioInversion->id_est_inv?>" id="id_est_inv" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-5 col-sm-5 col-xs-12">
				<label>Entregable</label>
					<select id="cbx_entregable" name="cbx_entregable" class="form-control notValidate" required=""> 
							<?php foreach ($listarEntregable as $itemp) {?>
								<option value="<?=$itemp->id_entregable.','.$itemp->nombre_entregable?>"> <?= $itemp->nombre_entregable?></option>
							<?php } ?>
					</select>

			</div>
			<div class="col-md-7 col-sm-7 col-xs-7">
				<label>Modulo</label><br/>
				<select id="cbx_modulos" name="cbx_modulos[]"  class="selectpicker" multiple data-live-search="true" data-live-search-placeholder="Search" data-actions-box="true" data-width="100%" >
					<?php foreach ($listarModulo as $itemp) {?>
						<option value="<?=$itemp->id_modulo.','.$itemp->nombre_modulo?>"> <?= $itemp->nombre_modulo?></option>
					<?php } ?>
				</select>
			</div>
			<div class="col-md-5 col-sm-5 col-xs-5">
				<label>Descripcion Entregable</label><br/>
					<textarea rows="4" cols="100" class="form-control" name="txtDescripcionEntregable" id="txtDescripcionEntregable" >
					 
					</textarea>
			</div>
			<div class="col-md-1 col-sm-1 col-xs-1" style="margin-top: 60px ">
				<label>Valor</label><br/>
				<input type="text" name="" class="form-control">	
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12" style="margin-top: 60px;">
				<label>.</label>
				<input type="button" id="btnAgregarFEntregable" class="btn btn-success form-control" value="Agregar">
			</div>
		</div>
		<div><br/>
			<table id="table-Entregable" class="table table-striped jambo_table bulk_action" with="100%">
				<thead>
					<tr>
						<td style="width:10%; ">Entregable  </td>
						<td style="width:30%; ">Descripcion</td>
						<td>Modulo</td>
						<td style="width:10%; ">Valor </td>
						<td></td>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
		<div class="row" style="text-align: right;">
			<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Registrar Entregable.</button>
			<button class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		</div>
</form>

<script>
$( document ).ready(function() {
	 
	 $('#cbx_modulos').selectpicker('refresh');

	$("#btnAgregarFEntregable").on('click', function(event)
	{
		var htmlTemp;
		var posicionSeparadorTemp1=$('#cbx_entregable').val().indexOf(',');
		var identregable=$('#cbx_entregable').val().substring(0, posicionSeparadorTemp1);
		var descripcionEntregable=replaceAll(replaceAll($('#cbx_entregable').val().substring(posicionSeparadorTemp1+1, $('#cbx_entregable').val().length), '<', '&lt;'), '>', '&gt;');
		
		var valorEntregable	=$("#valorEntregable").val();

		var txtDescripcionEntregable=$('#txtDescripcionEntregable').val();

		var modulo=$("#cbx_modulos").val();
		for (var i = 0; i < modulo.length; i++) {
			var posicionSeparadorTemp=modulo[i].indexOf(',');
			var idmodulo=modulo[i].substring(0, posicionSeparadorTemp);
			var descripcionModulo=replaceAll(replaceAll(modulo[i].substring(posicionSeparadorTemp+1, modulo[i].length), '<', '&lt;'), '>', '&gt;');
			htmlTemp +='<tr>'+
				'<td><input type="hidden" value='+identregable+' name="hdidEntregable[]">'+descripcionEntregable+'</td>'+ 
				'<td><input type="hidden"> '+txtDescripcionEntregable+'</td>'+
				'<td><input type="hidden" name="hdidEntregable[]">'+descripcionModulo+'</td>'+
				'<td><input style="height:30px;" class="form-control" type="text" placeholder="Valor" name="ValorEntregable[]"></td>'+
				'<td><a href="#" onclick="$(this).parent().parent().remove();" style="color: red;font-weight: bold;text-decoration: underline;">Eliminar</a></td>'+
			'</tr>'
		}
		
		$('#table-Entregable > tbody').append(htmlTemp);

		//limpiarText('divPresupuestoFuente', []);
	});

	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		/*$('#form-addFePresupuesto').data('formValidation').validate();

		if(!($('#form-addFePresupuesto').data('formValidation').isValid()))
		{
			return;
		}*/

		paginaAjaxJSON($('#form-addEntregable').serialize(), '<?=base_url();?>index.php/UF_ModuloEntregable/insertar', 'POST', null, function(objectJSON)
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
				/*window.location.href='<?=base_url();?>index.php/FE_Presupuesto_Inv/index/'+objectJSON.idEstudioInversion;*/

				renderLoading();
			});
		}, false, true);
	});
});
</script>