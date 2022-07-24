<style type="text/css">
	.pre {
		color: red;
		background: red;
	}

	#table_clasificador th {
		background-color: #3f5367;
		color: white;
	}
</style>

<?php $contD = 0; $contI = 0 ?>
<div class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<input type="hidden" name="hd_et" id="hd_et" value="<?= $expedienteTecnico->id_et ?>" notValidate>
			<input type="hidden" name="modalidad" id="modalidad" value="<?= $expedienteTecnico->modalidad_ejecucion_et ?>" notValidate>
			<label class="control-label">Nombre del proyecto de inversión</label>
			<div>
				<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="3" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?= $expedienteTecnico->nombre_pi ?></textarea>
			</div>
		</div>
	</div>
	<div class="" role="tabpanel" data-example-id="togglable-tabs">
		<ul id="myTabPie" class="nav nav-tabs" role="tablist">
		<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ ?>
			<li style="width:15%;" role="presentation" class="active">
				<a href="#tabAdmDirecta" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Administracion Directa</b></a>
			</li>
			<?php } if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
			<li style="width:15%;" role="presentation" class="">
				<a href="#tabAdmIndirecta" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Administracio Indirecta</b></a>
			</li>
			<?php }?>
		</ul>
		<br>
			<div id="myTabPieContent" class="tab-content">
				<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ ?>
				<div role="tabpanel" class="tab-pane fade active in" id="tabAdmDirecta" aria-labelledby="home-tab">
					<div class="form-horizontal">
					<table class="table">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Documentos</th>
							</tr>
							</thead>
							<tbody>
								<?php $counter = 1; ?>
								<?php if ( !empty($et_documento_GGD) ): ?>
									<?php foreach ($et_documento_GGD as $et_documento_GGDs): ?>
									<tr>
										<th scope="row"><?php echo $counter++; ?></th>
											<td><label for="exampleFormControlFile1">📑 </label> <a href="<?php echo base_url(); ?>uploads/DesagregadoGastos/<?= $et_documento_GGDs['filename'] ?>" target="_blank"><?= $et_documento_GGDs['filename'] ?></a></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>

					</div>

				</div>
				<?php } if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
				<div role="tabpanel" class="tab-pane fade <?=$expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA'?'active in':''?>" id="tabAdmIndirecta" aria-labelledby="profile-tab">
					<div class="form-horizontal">
					<table class="table">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Documentos</th>
							</tr>
							</thead>
							<tbody>
								<?php $counter = 1; ?>
								<?php if ( !empty($et_documento_GGI) ): ?>
									<?php foreach ($et_documento_GGI as $et_documento_GGIs): ?>
									<tr>
										<th scope="row"><?php echo $counter++; ?></th>
											<td><label for="exampleFormControlFile1">📑 </label> <a href="<?php echo base_url(); ?>uploads/DesagregadoGastos/<?= $et_documento_GGIs['filename'] ?>" target="_blank"><?= $et_documento_GGIs['filename'] ?></a></td>
									</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>


					</div>
				</div>
				<?php }?>
			</div>
	</div>

	<div class="row" style="text-align: right;">
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar
		</button>
	</div>

</div>

<script>
	function splitMulti(str, tokens) {
		var tempChar = tokens[0]; // We can use the first token as a temporary join character
		for (var i = 1; i < tokens.length; i++)
			str = str.split(tokens[i]).join(tempChar);

		str = str.split(tempChar);
		return str;
	}

	function obtenerMacroDirecta(macro) {
		const indexResp = macro.id.split('macroDirecta')[1];
		try {
			const arrayMacro = splitMulti(macro.value, ['+', '-', '/', '*']);
			const arrayVariable = document.querySelectorAll('.variableDirecta');

			arrayMacro.forEach(variable => {
				if (variable != '') {
					arrayVariable.forEach(variableFind => {
						if (variableFind.value == variable) {
							const indexVariable = variableFind.id.split('variableDirecta')[1];
							const monto = document.querySelector('#montoDirecta' + indexVariable).value.replaceAll(',','');
							console.log(monto);
							window[variable] = Number(monto);
						}
					});
				}
			});
			const res = eval(macro.value);
			const inputMonto = document.querySelector('#montoDirecta' + indexResp).value = res.toLocaleString('en-US');
		} catch (error) {
			document.querySelector('#montoDirecta' + indexResp).value = 0;
		}
	}
	function obtenerMacroIndirecta(macro) {
		const indexResp = macro.id.split('macroIndirecta')[1];
		try {
			const arrayMacro = splitMulti(macro.value, ['+', '-', '/', '*']);
			const arrayVariable = document.querySelectorAll('.variableIndirecta');

			arrayMacro.forEach(variable => {
				if (variable != '') {
					arrayVariable.forEach(variableFind => {
						if (variableFind.value == variable) {
							const indexVariable = variableFind.id.split('variableIndirecta')[1];
							const monto = document.querySelector('#montoIndirecta' + indexVariable).value.replaceAll(',','');
							window[variable] = Number(monto);
						}
					});
				}
			});
			const res = eval(macro.value);
			const inputMonto = document.querySelector('#montoIndirecta' + indexResp).value = res.toLocaleString('en-US');
		} catch (error) {
			document.querySelector('#montoIndirecta' + indexResp).value = 0;
		}
	}

	function changePresupuestoDirecta(select, cont) {
		if (select.value == '0') {
			select.parentElement.parentElement.style.background = '#eee';
			select.parentElement.parentElement.querySelector('#gastoDirecta' + cont).checked = false;
		} else {
			select.parentElement.parentElement.style.background = 'white';
			select.parentElement.parentElement.querySelector('#gastoDirecta' + cont).checked = true;
		}
		console.log(select.value);
		switch (select.value) {
			case 3:
				
				break;
				case 4:
				
				break
				case 6:
				
				break
		
			default:
				break;
		}
	}
	function changePresupuestoIndirecta(select, cont) {
		if (select.value == '0') {
			select.parentElement.parentElement.style.background = '#eee';
			select.parentElement.parentElement.querySelector('#gastoIndirecta' + cont).checked = false;
		} else {
			select.parentElement.parentElement.style.background = 'white';
			select.parentElement.parentElement.querySelector('#gastoIndirecta' + cont).checked = true;
		}
	}

	function guardarComponenteD(index) {
		
		let descripcion = $('#presupuestoEjecucionDirecta' + index).find("option:selected").text();
		let variable = $('#variableDirecta' + index).val();
		let macro = $('#macroDirecta' + index).val();
		let monto = $('#montoDirecta' + index).val().replaceAll(',','');
		let idPresupuesto = $('#presupuestoEjecucionDirecta' + index).find("option:selected").val();
		if (descripcion=='Seleccione'||variable==""||macro=="") {
			swal({
					title: 'Error',
					text: "Debe Seleccionar la Descripcion y rellenar los campos de Variable y Macro",
					
				},
				function() {});
		}
		else{
		paginaAjaxJSON({
				"descripcion": descripcion,
				"variable": variable,
				"macro": macro,
				"id_presupuesto_ej": idPresupuesto,
				"id_et": $('#hd_et').val(),
				"modalidad": 1,
				"orden": index,
				"monto": monto,
				"id_pie_presupuesto" : $('#idPieDirecta'+index).val(),
			},
			base_url + 'index.php/ET_Pie_Presupuesto/insertar',
			'POST', null,
			function(objectJSON) {
				resultado = JSON.parse(objectJSON);
				console.log(resultado);
				swal({
					title: '',
					text: resultado.mensaje,
					type: (resultado.proceso == 'Correcto' ? 'success' : 'error')
				},
				function() {});
				$('#idPieDirecta'+index).val(resultado.id_pie_presupuesto);
			}, false, true)
		}
	}
	function guardarComponenteI(index) {
		let descripcion = $('#presupuestoEjecucionIndirecta' + index).find("option:selected").text();
		let variable = $('#variableIndirecta' + index).val();
		let macro = $('#macroIndirecta' + index).val();
		let monto = $('#montoIndirecta' + index).val().replaceAll(',','');
		let idPresupuesto = $('#presupuestoEjecucionIndirecta' + index).find("option:selected").val();
		if (descripcion=='Seleccione'||variable==""||macro=="") {
			swal({
					title: 'Error',
					text: "Debe Seleccionar la Descripcion y rellenar los campos de Variable y Macro",
					
				},
				function() {});
		}
		else{
		paginaAjaxJSON({
				"descripcion": descripcion,
				"variable": variable,
				"macro": macro,
				"id_presupuesto_ej": idPresupuesto,
				"id_et": $('#hd_et').val(),
				"modalidad": 2,
				"orden": index,
				"monto": monto,
				"id_pie_presupuesto" : $('#idPieIndirecta'+index).val(),

			},
			base_url + 'index.php/ET_Pie_Presupuesto/insertar',
			'POST', null,
			function(objectJSON) {
				resultado = JSON.parse(objectJSON);
				swal({
					title: '',
					text: resultado.mensaje,
					type: (resultado.proceso == 'Correcto' ? 'success' : 'error')
				},
				function() {});
				$('#idPieIndirecta'+index).val(resultado.id_pie_presupuesto);
			}, false, true)
		}
	}
	function eliminarFilaD(index){
		paginaAjaxJSON({
				"id_pie_presupuesto" : $('#idPieDirecta'+index).val(),
			},
			base_url + 'index.php/ET_Pie_Presupuesto/eliminar',
			'POST', null,
			function(objectJSON) {
				resultado = JSON.parse(objectJSON);
				swal({
					title: '',
					text: resultado.mensaje,
					type: (resultado.proceso == 'Correcto' ? 'success' : 'error')
				},
				function() {});
				$("#trD" + index).remove();
			}, false, true)
		
}
function eliminarFilaI(index){
	console.log($('#idPieIndirecta'+index).val(),);
	paginaAjaxJSON({
				"id_pie_presupuesto" : $('#idPieIndirecta'+index).val(),
			},
			base_url + 'index.php/ET_Pie_Presupuesto/eliminar',
			'POST', null,
			function(objectJSON) {
				resultado = JSON.parse(objectJSON);
				swal({
					title: '',
					text: resultado.mensaje,
					type: (resultado.proceso == 'Correcto' ? 'success' : 'error')
				},
				function() {});
				$("#trI" + index).remove();
			}, false, true)
	
}
$("#formAddDocumento").submit(function(event)
	{
		event.preventDefault();
		var formData=new FormData($("#formAddDocumento")[0]);
		console.log(formData);
		$.ajax({
			url: base_url+"index.php/Expediente_Tecnico/insertDesagregadoGastos",
			type:'POST',
			enctype: 'multipart/form-data',
			data:formData,
			cache: false,
			contentType:false,
			processData:false,
			success:function(resp)
			{
				$('#modal-pdf').modal('hide');
				swal("Bien!", "Se registro correctamente!", "success");
			},
			error: function ()
			{
					swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error");
			}
		});
	});
	$('#modal-pdf').on('show.bs.modal', function(event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var recipient = button.data('elvalor');
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  modal.find('.modal-body #presupuesto_ejecucion').val(recipient)
})
</script>