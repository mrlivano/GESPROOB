<br>
<table class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<td>Función</td>
			<td>División Funcional</td>
			<td>Grupo Funcional</td>
			<td>Provincia</td>
			<td>Distrito</td>
			<td>Total Beneficiarios</td>
			<td>Costo Total</td>
		</tr>
	</thead>
	<tbody>
	  	<tr>
	    	<td bgcolor="#D1F2EB"><p name = "Funcion" id="Funcion"></p></td>
			<td bgcolor="#D1F2EB"><p name = "DivisionFuncional" id="DivisionFuncional"></p></td>
			<td bgcolor="#D1F2EB"><p name = "GrupoFuncional" id="GrupoFuncional"></p></td>
			<td bgcolor="#D1F2EB"><p name = "provincia" id="provincia"></p></td>
			<td bgcolor="#D1F2EB"><p name = "distrito" id="distrito"></p></td>
			<td bgcolor="#D1F2EB"><p><?=$totalBeneficiarios?><p></td>
			<td bgcolor="#D1F2EB"><p>S/. <?=$costoTotal?></p></td>    	
	  	</tr>
	</tbody>
</table>
<br>

<table id="dynamic-table"  class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<td>Codigo</td>
			<td>Proyecto</td>
			<td>Función</td>
			<td>División Funcional</td>
			<td>Grupo Funcional</td>
			<td>Número de Beneficiarios</td>
			<td>Costo</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach($listaProyectos as $item ) { ?>
	  	<tr class="dato">
			<td>
				<?=$item->codigo_unico_pi?>
	    	</td>
	    	<td>
				<?=$item->nombre_pi?>
	    	</td>
	    	<td>
				<?=$item->nombre_funcion ?>
	    	</td>
	    	<td>
				<?=$item->nombre_div_funcional ?>
	    	</td>
	    	<td>
				<?=$item->nombre_grup_funcional?>
	    	</td>	    	
	    	<td>
				<?=$item->num_beneficiarios?>
	    	</td>
	    	<td style="text-align:right">
				S/. <?=$item->costo_pi?>
	    	</td>	    	
	  	</tr>
	<?php } ?>
	</tbody>
</table>
<script>
	$('#dynamic-table').DataTable(
		{
			"language":idioma_espanol,
            "searching": true,
            "info":     true,
            "paging":   true,
		});

	var Funcion = ($("#listaFuncion").val() == '') ? '-' : $('#listaFuncion option:selected').text();
	var DivisionFuncional =($("#listaDivisionFuncional").val() == '') ? '-' : $('#listaDivisionFuncional option:selected').text();
	var GrupoFuncional = ($("#listaGrupoFuncional").val()=='') ? '-': $('#listaGrupoFuncional option:selected').text();
	var provincia = ($("#listaProvincia").val()=='') ? '-' : $('#listaProvincia option:selected').text();
	var distrito = ($("#listaDistrito").val()=='') ? '-' : $('#listaDistrito option:selected').text(); 


	$("#Funcion").text(Funcion);
	$("#DivisionFuncional").text(DivisionFuncional);
	$("#GrupoFuncional").text(GrupoFuncional);
	$("#provincia").text(provincia);
	$("#distrito").text(distrito);
</script>