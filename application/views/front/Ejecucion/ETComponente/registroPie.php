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
			<li style="width:15%;" role="presentation" class="active">
				<a href="#tabAdmDirecta" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Administracion Directa</b></a>
			</li>
			<li style="width:15%;" role="presentation" class="">
				<a href="#tabAdmIndirecta" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Administracio Indirecta</b></a>
			</li>
		</ul>
			<div id="myTabPieContent" class="tab-content">
				<div role="tabpanel" class="tab-pane fade active in" id="tabAdmDirecta" aria-labelledby="home-tab">
					<div class="form-horizontal">
						<label id="costoDirecto">Costos directo = NDIRECTO</label> <input id="montoDirecta" type="text" value="<?php echo ($expedienteTecnico->costoDirecto) ?>" disabled>
						<input id="variableDirecta" class="variableDirecta" type="hidden" value="NDIRECTO" disabled>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="height:300px;overflow:scroll;overflow-x: hidden;text-align: left; ">
							<table class="table table-bordered" id="tablePresupuestosDirecta" style="width: 100%;">
								<thead>
									<tr>
										<th style="width: 10%">DESCRIPCION</th>
										<th style="width: 10%">VARIABLE</th>
										<th style="width: 10%">MACRO</th>
										<th style="width: 1%">GASTO</th>
										<th style="width: 5%">MONTO</th>
										<th style="width: 20%">OPCION</th>
									</tr>
								</thead>
								<tbody id="bodyPie">

									<?php foreach ($PiePresupuesto->directa as $key => $value) { ?>
										<tr><?php $contD += 1 ?>
											<td style="width: 10%">
											<input type="hidden" id="idPieDirecta<?= $contD ?>" value="<?= $value->id_pie_presupuesto?>">
												<select name="presupuestoEjecucionDirecta<?= $contD ?>" id="presupuestoEjecucionDirecta<?= $contD ?>">
													<?php foreach ($PresupuestoEjecucion->directa as $key1 => $presupuesto) { ?>
														<option value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>
													<?php } ?>
												</select>
											</td>
											<td style="width: 10%"><input class="variableDirecta" id="variableDirecta<?= $contD ?>" name="variableDirecta<?= $contD ?>" type="text" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->variable ?>"></td>
											<td style="width: 15%"><input id="macroDirecta<?= $contD ?>" name="macroDirecta<?= $contD ?>" type="text" onchange="obtenerMacroDirecta(this)" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->macro ?>"></td>
											<td style="width: 5%"><input id="gastoDirecta<?= $contD ?>" name="gastoDirecta<?= $contD ?>" type="checkbox" <?= $value->id_presupuesto_ej == "" ? "" : "checked" ;?>></td>
											<td style="width: 20%"><input id="montoDirecta<?= $contD ?>" name="montoDirecta<?= $contD ?>" type="text" value="<?= $value->monto ?>"></td>
											<td style="width: 20%"><button onclick="guardarComponenteD(<?= $contD ?>)">guardar</button></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="form-group">
								<button type="button" class="btn btn-primary mr-2" onclick="agregarFilaD(<?= $contD ?>)">Agregar Fila</button>
								<button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button>
							</div>
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane fade" id="tabAdmIndirecta" aria-labelledby="profile-tab">
					<div class="form-horizontal">
						<label id="costoDirectoIndirecta">Costos directo = NDIRECTO</label> <input id="montoIndirecta" type="text" value="<?php echo ($expedienteTecnico->costoDirectoIndirecta) ?>" disabled>
						<input id="variableIndirecta" class="variableIndirecta" type="hidden" value="NDIRECTO" disabled>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12" style="height:300px;overflow:scroll;overflow-x: hidden;text-align: left; ">
							<table class="table table-bordered" id="tablePresupuestosIndirecta" style="width: 100%;">
								<thead>
									<tr>
										<th style="width: 10%">DESCRIPCION</th>
										<th style="width: 10%">VARIABLE</th>
										<th style="width: 10%">MACRO</th>
										<th style="width: 1%">GASTO</th>
										<th style="width: 5%">MONTO</th>
										<th style="width: 20%">OPCION</th>
									</tr>
								</thead>
								<tbody id="bodyPie">

									<?php foreach ($PiePresupuesto->indirecta as $key => $value) { ?>
										<tr><?php $contI += 1 ?>
											<td style="width: 10%">
											<input type="hidden" id="idPieIndirecta<?= $contI ?>" value="<?= $value->id_pie_presupuesto?>">
												<select name="presupuestoEjecucionIndirecta<?= $contI ?>" id="presupuestoEjecucionIndirecta<?= $contI ?>">
													<?php foreach ($PresupuestoEjecucion->indirecta as $key1 => $presupuesto) { ?>
														<option value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>
													<?php } ?>
												</select>
											</td>
											<td style="width: 10%"><input class="variableIndirecta" id="variableIndirecta<?= $contI ?>" name="variableIndirecta<?= $contI ?>" type="text" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->variable ?>"></td>
											<td style="width: 15%"><input id="macroIndirecta<?= $contI ?>" name="macroIndirecta<?= $contI ?>" type="text" onchange="obtenerMacroIndirecta(this)" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->macro ?>"></td>
											<td style="width: 5%"><input id="gastoIndirecta<?= $contI ?>" name="gastoIndirecta<?= $contI ?>" type="checkbox" checked=<?php $presupuesto->id_presupuesto_ej == null ? "true" : "false" ;?>></td>
											<td style="width: 20%"><input id="montoIndirecta<?= $contI ?>" name="montoIndirecta<?= $contI ?>" type="text" value="<?= $value->monto ?>"></td>
											<td style="width: 20%"><button onclick="guardarComponenteI(<?= $contI ?>)">guardar</button></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="form-group">
								<button type="button" class="btn btn-primary mr-2" onclick="agregarFilaI(<?= $contI ?>)">Agregar Fila</button>
								<button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button>
							</div>
						</div>
					</div>
				</div>
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
	var contadorD = 0;
	var contadorI = 0;

	function agregarFilaD(contD) {

		contadorD += contD + 1;

		document.getElementById("tablePresupuestosDirecta").insertRow(-1).innerHTML = '<?php $contD = $contD + 1; ?><td style="width: 10%"><input type="hidden" id="idPieDirecta'+contadorD+'" value=""><select  name="presupuestoEjecucionDirecta' + contadorD + '" id="presupuestoEjecucionDirecta' + contadorD + '" onchange="changePresupuestoDirecta(this,' + contadorD + ')">' +
			'<?php foreach ($PresupuestoEjecucion->directa as $key1 => $presupuesto) { ?>' +
			'<option size="10" value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>' +
			'<?php } ?>' +
			'<option value="0">SUBTOTAL</option>' +
			'<option value="0">COSTO TOTAL EJECUCION DE OBRA</option>' +
			'<option value="0">PRESUPUESTO TOTAL</option>' +
			'</select></td>' +
			'<td style="width: 10%"><input size="7" class="variableDirecta" id="variableDirecta' + contadorD + '" name="variableDirecta' + contadorD + '" type="text" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="7" id="macroDirecta' + contadorD + '" name="macroDirecta' + contadorD + '" type="text" onchange="obtenerMacroDirecta(this)" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="1" id="gastoDirecta' + contadorD + '" name="gastoDirecta' + contadorD + '" type="checkbox"></td>' +
			'<td style="width: 10%"><input size="7" id="montoDirecta' + contadorD + '" name="montoDirecta' + contadorD + '" type="text"></td>' +
			'<td style="width: 10%"><button size="10%" onclick="guardarComponenteD(' + contadorD + ')">guardar</button></td>'
	}
	function agregarFilaI(contI) {

contadorI += contI + 1;

document.getElementById("tablePresupuestosIndirecta").insertRow(-1).innerHTML = '<?php $contI = $contI + 1; ?><td style="width: 10%"><input type="hidden" id="idPieDirecta'+contadorI+'" value=""><select  name="presupuestoEjecucionIndirecta' + contadorI + '" id="presupuestoEjecucionIndirecta' + contadorI + '" onchange="changePresupuestoIndirecta(this,' + contadorI + ')">' +
	'<?php foreach ($PresupuestoEjecucion->indirecta as $key1 => $presupuesto) { ?>' +
	'<option size="10" value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>' +
	'<?php } ?>' +
	'<option value="0">SUBTOTAL</option>' +
	'<option value="0">COSTO TOTAL EJECUCION DE OBRA</option>' +
	'<option value="0">PRESUPUESTO TOTAL</option>' +
	'</select></td>' +
	'<td style="width: 10%"><input size="7" class="variableIndirecta" id="variableIndirecta' + contadorI + '" name="variableIndirecta' + contadorI + '" type="text" onkeyup="this.value = this.value.toUpperCase();"></td>' +
	'<td style="width: 10%"><input size="7" id="macroIndirecta' + contadorI + '" name="macroIndirecta' + contadorI + '" type="text" onchange="obtenerMacroIndirecta(this)" onkeyup="this.value = this.value.toUpperCase();"></td>' +
	'<td style="width: 10%"><input size="1" id="gastoIndirecta' + contadorI + '" name="gastoIndirecta' + contadorI + '" type="checkbox"></td>' +
	'<td style="width: 10%"><input size="7" id="montoIndirecta' + contadorI + '" name="montoIndirecta' + contadorI + '" type="text"></td>' +
	'<td style="width: 10%"><button size="10%" onclick="guardarComponenteI(' + contadorI + ')">guardar</button></td>'
}

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
							const monto = document.querySelector('#montoDirecta' + indexVariable).value;
							window[variable] = Number(monto);
						}
					});
				}
			});
			const res = eval(macro.value);
			const inputMonto = document.querySelector('#montoDirecta' + indexResp).value = res;
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
							const monto = document.querySelector('#montoIndirecta' + indexVariable).value;
							window[variable] = Number(monto);
						}
					});
				}
			});
			const res = eval(macro.value);
			const inputMonto = document.querySelector('#montoIndirecta' + indexResp).value = res;
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
		console.log('guarda');
		let descripcion = $('#presupuestoEjecucionDirecta' + index).find("option:selected").text();
		let variable = $('#variableDirecta' + index).val();
		let macro = $('#macroDirecta' + index).val();
		let monto = $('#montoDirecta' + index).val();
		let idPresupuesto = $('#presupuestoEjecucionDirecta' + index).find("option:selected").val();
		console.log(idPresupuesto);
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
			}, false, true)
	}
	function guardarComponenteI(index) {
		console.log('guarda');
		let descripcion = $('#presupuestoEjecucionIndirecta' + index).find("option:selected").text();
		let variable = $('#variableIndirecta' + index).val();
		let macro = $('#macroIndirecta' + index).val();
		let monto = $('#montoIndirecta' + index).val();
		let idPresupuesto = $('#presupuestoEjecucionIndirecta' + index).find("option:selected").val();
		console.log(idPresupuesto);
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
			}, false, true)
	}
	function eliminarFila(){
  var table = document.getElementById("tablaprueba");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 1)
    alert('No se puede eliminar el encabezado');
  else
    table.deleteRow(rowCount -1);
}
</script>