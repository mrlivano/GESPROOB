<style type="text/css">
	.pre{
		color: red;
		background: red;
	}

	#table_clasificador th {
		background-color: #3f5367;
		color: white;
	}
</style>
<?php $cont=0?>
<div class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<input type="hidden" name="hd_et" id="hd_et" value="<?=$expedienteTecnico->id_et?>" notValidate>
			<label class="control-label">Nombre del proyecto de inversión</label>
			<div>
				<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="3" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=$expedienteTecnico->nombre_pi?></textarea>
			</div>
		</div>
	</div>
	<div class="form-horizontal">
		<label id="costoDirecto">Costos directo <?php echo($expedienteTecnico->costoDirecto) ?> </label>
	</div>

	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12" style="height:300px;overflow:scroll;overflow-x: hidden;text-align: left; ">
			<table class="table table-bordered" id="tablePresupuestos">
				<thead>
					<tr>
						<th>DESCRIPCION</th>
						<th>VARIABLE</th>
						<th>MACRO</th>
						<th>GASTO</th>
						<th>MONTO</th>
						<th>OPCION</th>
					</tr>
				</thead>
				<tbody id="bodyPie">
					
					<?php foreach ($PiePresupuesto as $key => $value) {?>
						<tr><?php $cont+=1?>
						<td>
								<select name="presupuestoEjecucion<?=$cont?>" id="presupuestoEjecucion<?=$cont?>">
								<?php foreach ($PresupuestoEjecucion as $key1 => $presupuesto) { ?>
									<option value="<?php $presupuesto->id_presupuesto_ej?>"><?=$presupuesto->desc_presupuesto_ej?></option>
							<?php }?></select></td>
							<td><input class="variable" id="variable<?=$cont?>" name="variable<?=$cont?>" type="text"><?=$value->descripcion?></td>
							<td><input id="macro<?=$cont?>" name="macro<?=$cont?>" type="text" onchange="obtenerMacro(this)"><?=$value->macro?></td>
							<td><input id="gasto<?=$cont?>" name="gasto<?=$cont?>" type="checkbox"></td>
							<td><input id="monto<?=$cont?>" name="monto<?=$cont?>" type="text"><?=$value->monto?></td>
							<td><button >guardar</button></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
			<div class="form-group">
      <button type="button" class="btn btn-primary mr-2" onclick="agregarFila(<?=$cont?>)">Agregar Fila</button>
      <!-- <button type="button" class="btn btn-danger" onclick="eliminarFila()">Eliminar Fila</button> -->
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
	var contador=0;
function agregarFila(cont){

	contador+=cont+1;
  document.getElementById("tablePresupuestos").insertRow(-1).innerHTML = '<?php  $cont=$cont+1; ?><td><select name="presupuestoEjecucion'+contador+'" id="presupuestoEjecucion'+contador+'" onchange="changePresupuesto(this,'+contador+')">'+
								'<?php foreach ($PresupuestoEjecucion as $key1 => $presupuesto) { ?>'+
									'<option value="<?= $presupuesto->id_presupuesto_ej?>"><?=$presupuesto->desc_presupuesto_ej?></option>'+
							'<?php }?>'+
							'<option value="0">SUBTOTAL</option>'+
							'<option value="0">COSTO TOTAL EJECUCION DE OBRA</option>'+
							'<option value="0">PRESUPUESTO TOTAL</option>'+
							'</select></td>'+
							'<td><input class="variable" id="variable'+contador+'" name="variable'+contador+'" type="text"></td>'+
							'<td><input id="macro'+contador+'" name="macro'+contador+'" type="text" onchange="obtenerMacro(this)"></td>'+
							'<td><input id="gasto'+contador+'" name="gasto'+contador+'" type="checkbox"></td>'+
							'<td><input id="monto'+contador+'" name="monto'+contador+'" type="text"></td>'+
							'<td><button >guardar</button></td>'
}

function splitMulti(str, tokens){
        var tempChar = tokens[0]; // We can use the first token as a temporary join character
        for(var i = 1; i < tokens.length; i++)
            str = str.split(tokens[i]).join(tempChar);
        
        str = str.split(tempChar);
        return str;
  }

	function obtenerMacro(macro) {
		const indexResp = macro.id.split('macro')[1];
		try {
			console.log(indexResp);
			const arrayMacro=splitMulti(macro.value,['+', '-', '/', '*']);
			const arrayVariable=document.querySelectorAll('.variable');
			
			arrayMacro.forEach(variable => {
				if(variable != ''){
					arrayVariable.forEach(variableFind => {
						if(variableFind.value == variable){
							const indexVariable = variableFind.id.split('variable')[1];
							const monto = document.querySelector('#monto'+indexVariable).value;
							window[variable] = Number(monto);
						}
					});
				}
			});
			const res=eval(macro.value);
			const inputMonto = document.querySelector('#monto'+indexResp).value = res;
			console.log(res);
		} catch (error) {
			document.querySelector('#monto'+indexResp).value = 0;
			console.log(0);
		}
	}

	function changePresupuesto(select, cont) {
		if(select.value=='0'){
			select.parentElement.parentElement.style.background='#eee';
			select.parentElement.parentElement.querySelector('#gasto'+cont).checked = false;
		}
		else{
			select.parentElement.parentElement.style.background='white';
			select.parentElement.parentElement.querySelector('#gasto'+cont).checked = true;
		}
	}
</script>

