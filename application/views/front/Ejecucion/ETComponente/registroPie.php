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
<div id="modal-pdf" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<a class="close" data-dismiss="modal">×</a>
				<h3>Formato FF-08</h3>
			</div>
			<div class="modal-body">
				<form id="formAddDocumento" class="feedback" name="feedback">
					<div class="form-group">
					<input type="hidden" id="presupuesto_ejecucion" name="presupuesto_ejecucion" value="">
					<input type="hidden"  name="id_et" value="<?=$expedienteTecnico->id_et?>">
					<input type="file" accept=".pdf,.doc,.docx" class="form-control-file" id="inputFileDocF08" name="inputFileDocF08">
					</div>
					<div class="modal-footer">
						<button class="btn btn-success" id="send" type="submit">Guardar</button>
						<a href="#" class="btn" data-dismiss="modal">Cerrar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>


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
						<label id="costoDirecto">Costos directo = NDIRECTO</label> <input id="montoDirecta" type="text" value="<?php echo (number_format($expedienteTecnico->costoDirecto,2,".",",")) ?>" disabled>
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
								<tbody id="bodyPieD">

									<?php foreach ($PiePresupuesto->directa as $key => $value) { ?><?php $contD += 1 ?>
										<tr id="trD<?=$contD?>">
											<td style="width: 10%">
											<input type="hidden" id="idPieDirecta<?= $contD ?>" value="<?= $value->id_pie_presupuesto?>">
												<select name="presupuestoEjecucionDirecta<?= $contD ?>" id="presupuestoEjecucionDirecta<?= $contD ?>" onchange="changePresupuestoDirecta(this,<?=$contD?>)">
													<?php foreach ($PresupuestoEjecucion->directa as $key1 => $presupuesto) { ?>
														<option value="<?= $presupuesto->id_presupuesto_ej ?>"<?php echo ($presupuesto->desc_presupuesto_ej == $value->descripcion ? "selected" : "") ?>>
														<?= $presupuesto->desc_presupuesto_ej ?></option><?php } ?>
														<option value="0" <?php echo ('COSTO TOTAL EJECUCION DE OBRA' == $value->descripcion ? "selected" : "") ?>>COSTO TOTAL EJECUCION DE OBRA</option> 
														<option value="0" <?php echo ('SUBTOTAL' == $value->descripcion ? "selected" : "") ?>>SUBTOTAL</option> 
														<option value="0" <?php echo ('PRESUPUESTO TOTAL' == $value->descripcion ? "selected" : "") ?>>PRESUPUESTO TOTAL</option> 
													
												</select>
											</td>
											<td style="width: 10%"><input style="width: 100%" class="variableDirecta" id="variableDirecta<?= $contD ?>" name="variableDirecta<?= $contD ?>" type="text" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->variable ?>"></td>
											<td style="width: 15%"><input id="macroDirecta<?= $contD ?>" name="macroDirecta<?= $contD ?>" type="text" onchange="obtenerMacroDirecta(this)" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->macro ?>"></td>
											<td style="width: 5%"><input id="gastoDirecta<?= $contD ?>" name="gastoDirecta<?= $contD ?>" type="checkbox" disabled <?= $value->id_presupuesto_ej == "" ? "" : "checked" ;?>></td>
											<td style="width: 20%"><input id="montoDirecta<?= $contD ?>" name="montoDirecta<?= $contD ?>" type="text" disabled value=<?= number_format($value->monto,2,'.',",") ?>></td>
											<td style="width: 40%">
											<button onclick="guardarComponenteD(<?= $contD ?>)" class="btn btn-success btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
											<button class="btn btn-danger btn-xs"  onclick="eliminarFilaD(<?=$contD?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
											<?php if(in_array($value->id_presupuesto_ej,array('3','4','6'))){ ?>
											<button class="btn btn-primary btn-xs" data-toggle="modal" id="modal-pdf" data-elvalor="<?= $value->id_presupuesto_ej ?>" data-target="#modal-pdf" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
											<?php } ?>
										</td>

										</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="form-group">
								<button  class="btn btn-primary mr-2" onclick="agregarFilaD(<?= $contD ?>)">Agregar Fila</button>
							</div>
						</div>
					</div>
				</div>
				<?php } if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
				<div role="tabpanel" class="tab-pane fade <?=$expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA'?'active in':''?>" id="tabAdmIndirecta" aria-labelledby="profile-tab">
					<div class="form-horizontal">
						<label id="costoDirectoIndirecta">Costos directo = NDIRECTO</label> <input id="montoIndirecta" type="text" value="<?php echo (number_format($expedienteTecnico->costoDirectoIndirecta,2,".",",")) ?>" disabled>
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

									<?php foreach ($PiePresupuesto->indirecta as $key => $value) { ?><?php $contI += 1 ?>
										<tr id="trI<?=$contI?>">
											<td style="width: 10%">
											<input type="hidden" id="idPieIndirecta<?= $contI ?>" value="<?= $value->id_pie_presupuesto?>">
												<select name="presupuestoEjecucionIndirecta<?= $contI ?>" id="presupuestoEjecucionIndirecta<?= $contI ?>" onchange="changePresupuestoIndirecta(this,<?=$contI?>)">
													<?php foreach ($PresupuestoEjecucion->indirecta as $key1 => $presupuesto) { ?>
														<option value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>
													<?php } ?>
													<option value="0" <?php echo ('COSTO TOTAL EJECUCION DE OBRA' == $value->descripcion ? "selected" : "") ?>>COSTO TOTAL EJECUCION DE OBRA</option> 
														<option value="0" <?php echo ('SUBTOTAL' == $value->descripcion ? "selected" : "") ?>>SUBTOTAL</option> 
														<option value="0" <?php echo ('PRESUPUESTO TOTAL' == $value->descripcion ? "selected" : "") ?>>PRESUPUESTO TOTAL</option> 
												</select>
											</td>
											<td style="width: 10%"><input style="width: 100%" class="variableIndirecta" id="variableIndirecta<?= $contI ?>" name="variableIndirecta<?= $contI ?>" type="text" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->variable ?>"></td>
											<td style="width: 15%"><input id="macroIndirecta<?= $contI ?>" name="macroIndirecta<?= $contI ?>" type="text" onchange="obtenerMacroIndirecta(this)" onkeyup="this.value = this.value.toUpperCase();" value="<?= $value->macro ?>"></td>
											<td style="width: 5%"><input id="gastoIndirecta<?= $contI ?>" name="gastoIndirecta<?= $contI ?>" type="checkbox" disabled <?= $value->id_presupuesto_ej == "" ? "" : "checked" ;?>></td>
											<td style="width: 20%"><input id="montoIndirecta<?= $contI ?>" name="montoIndirecta<?= $contI ?>" type="text" disabled value=<?= number_format($value->monto,2,'.',",") ?>></td>
											<td style="width: 20%">
											<button onclick="guardarComponenteI(<?= $contI ?>)" class="btn btn-success btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i></i><i</button>
											<button class="btn btn-danger btn-xs"  onclick="eliminarFilaI(<?=$contI?>)"><i class="fa fa-trash" aria-hidden="true"></i></button>
											<?php if(in_array($value->id_presupuesto_ej,array('1037','1040','1039'))){ ?>
											<button class="btn btn-primary btn-xs" data-toggle="modal" id="modal-pdf" data-elvalor="<?= $value->id_presupuesto_ej ?>" data-target="#modal-pdf" ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
											<?php } ?>
										</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
							<div class="form-group">
								<button type="button" class="btn btn-primary mr-2" onclick="agregarFilaI(<?= $contI ?>)">Agregar Fila</button>
							</div>
						</div>
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
	var contadorD = 0;
	var contadorI = 0;

	function agregarFilaD(contD) {
		let cont=0;
		contadorD += 1;
		cont=contadorD+contD;
		let tr= document.createElement('tr');
		tr.id='trD'+cont;
		tr.innerHTML= '<td style="width: 10%"><input type="hidden" id="idPieDirecta'+cont+'" value=""><select  name="presupuestoEjecucionDirecta' + cont + '" id="presupuestoEjecucionDirecta' + cont + '" onchange="changePresupuestoDirecta(this,' + cont + ')" >' +
			'<option value disabled selected>Seleccione</option>' +
			'<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION DIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ foreach ($PresupuestoEjecucion->directa as $key1 => $presupuesto) { ?>' +
			'<option size="10" value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>' +
			'<?php }} ?>' +
			'<option value="0">COSTO TOTAL EJECUCION DE OBRA</option>' +
			'<option value="0">SUBTOTAL</option>' +
			'<option value="0">PRESUPUESTO TOTAL</option>' +
			'</select></td>' +
			'<td style="width: 10%"><input size="7" class="variableDirecta" id="variableDirecta' + cont + '" name="variableDirecta' + cont + '" type="text" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="20" id="macroDirecta' + cont + '" name="macroDirecta' + cont + '" type="text" onchange="obtenerMacroDirecta(this)" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="1" id="gastoDirecta' + cont + '" name="gastoDirecta' + cont + '" type="checkbox" disabled></td>' +
			'<td style="width: 10%"><input size="20" id="montoDirecta' + cont + '" name="montoDirecta' + cont + '" type="text" disabled></td>' +
			'<td style="width: 10%"><button onclick="guardarComponenteD(' + cont + ')" class="btn btn-success btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i></i><i</button>'+
			'<button class="btn btn-danger btn-xs"  onclick="eliminarFilaD(' + cont + ')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
			document.getElementById("bodyPieD").appendChild(tr);
	}
	function agregarFilaI(contI) {
		let cont=0;
		contadorI += 1;
		cont=contadorI+contI;
		let tr= document.createElement('tr');
		tr.id='trI'+cont;
		tr.innerHTML= '<td style="width: 10%"><input type="hidden" id="idPieIndirecta'+cont+'" value=""><select  name="presupuestoEjecucionIndirecta' + cont + '" id="presupuestoEjecucionIndirecta' + cont + '" onchange="changePresupuestoIndirecta(this,' + cont + ')">' +
			'<option value disabled selected>Seleccione</option>' +
			'<?php if($expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $expedienteTecnico->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){ foreach ($PresupuestoEjecucion->indirecta as $key1 => $presupuesto) { ?>' +
			'<option size="10" value="<?= $presupuesto->id_presupuesto_ej ?>"><?= $presupuesto->desc_presupuesto_ej ?></option>' +
			'<?php }} ?>' +
			'<option value="0">SUBTOTAL</option>' +
			'<option value="0">COSTO TOTAL EJECUCION DE OBRA</option>' +
			'<option value="0">PRESUPUESTO TOTAL</option>' +
			'</select></td>' +
			'<td style="width: 10%"><input size="7" class="variableIndirecta" id="variableIndirecta' + cont + '" name="variableIndirecta' + cont + '" type="text" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="20" id="macroIndirecta' + cont + '" name="macroIndirecta' + cont + '" type="text" onchange="obtenerMacroIndirecta(this)" onkeyup="this.value = this.value.toUpperCase();"></td>' +
			'<td style="width: 10%"><input size="1" id="gastoIndirecta' + cont + '" name="gastoIndirecta' + cont + '" type="checkbox" disabled></td>' +
			'<td style="width: 10%"><input size="20" id="montoIndirecta' + cont + '" name="montoIndirecta' + cont + '" type="text" disabled></td>' +
			'<td style="width: 10%"><button onclick="guardarComponenteI(' + cont + ')" class="btn btn-success btn-xs"><i class="fa fa-floppy-o" aria-hidden="true"></i></i><i</button>'+
			'<button class="btn btn-danger btn-xs"  onclick="eliminarFilaI(' + cont + ')"><i class="fa fa-trash" aria-hidden="true"></i></button></td>';
			document.getElementById("bodyPie").appendChild(tr);
	
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
		
		let descripcion = $('#presupuestoEjecucionDirecta' + index).find("option:selected").text().trim();
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
		let descripcion = $('#presupuestoEjecucionIndirecta' + index).find("option:selected").text().trim();
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