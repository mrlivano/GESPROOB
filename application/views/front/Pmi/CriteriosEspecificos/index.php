<form class="form-horizontal"  id="form-addCriteriosEspecificos">
		<div class="row">
			<div class="col-md-6 col-sm-4 col-xs-12">
				<label>Criterio General</label>
				<input type="hidden" class="form-control" id="txtIdCriterioG" name="txtIdCriterioG" value="<?= $id_criterio_gen;?>" placeholder="" autocomplete="off">
				<input type="text" class="form-control" id="txtNombreCriterioG" value="<?=$listadoUnicoCGeneral->nombre_criterio_gen?>" name="txtNombreCriterio" readonly="readonly" >
			</div>
			<div class="col-md-6 col-sm-8 col-xs-12">
				<label>Criterio Específico</label>
				<input type="text" class="form-control" id="txtNombreCriterioEspecifico" name="txtNombreCriterioEspecifico" placeholder="Ingrese Criterio Específico" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-8 col-xs-12">
				<label>Peso</label>
				<input type="text" class="form-control" id="txtpeso" name="txtpeso" placeholder="Ingrese peso" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>.</label>
				<input type="button" id="btnAgregarCriterioEspecifico" class="btn btn-primary form-control" value="Agregar">
			</div>
		</div>
	<hr>
		<div>
			<table id="table-GriteriosEspecificos" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>Criterio especifico</td>
						<td>Peso</td>
						<td>Porcentaje</td>
						<td>Accion</td>
					</tr>
				</thead>
				<tbody id="bodyCriteriosEspecificos">
					<?php $peso=0;$porcentaje=0; foreach ($listaCriterioEspec as $key => $item) { $peso +=$item->peso; $porcentaje+=$item->porcentaje;?>
						<tr>
									<tr>
										<td><?= $item->nombre_criterio?></td>
										<td style="text-align:center;"><?= $item->peso?></td>
										<td style="text-align:center;"><?= $item->porcentaje?>%</td>
										<td>
											<button type="button"  class='editar btn btn-primary btn-xs' onclick="EditarCriterioEspecifico(<?=$item->id_criterio?>)"><i class="fa fa-pencil"></i></button>
										
											<!--<button onclick="EliminarCriterioEspefico(<?=$item->id_criterio?>,this);" data-toggle="tooltip" data-original-title="Eliminar Criterio Específico"   class='btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button>-->

											<button type='button' class='eliminar btn btn-danger btn-xs' onclick="Eliminar(<?=$item->id_criterio?>,<?=$item->id_criterio_gen?>);"><i class='fa fa-trash-o'></i></button>
										</td>
																
									</tr>
						</tr>						
					<?php }?>
					<tr>
						<td></td>
						<td style="text-align:center;"><?php echo $peso;?></td>
						<td style="text-align:center;"><?php echo $porcentaje;?> %</td>
						<td></td>
					</tr>
				</tbody>
			</table>
		</div>

</form>

<script>
$( document ).ready(function() {

    $('#btnAgregarCriterioEspecifico').on('click', function(event)
	{
		event.preventDefault();
		paginaAjaxJSON($('#form-addCriteriosEspecificos').serialize(), '<?=base_url();?>index.php/PmiCriterioEspecifico/index', 'POST', null, function(objectJSON)
		{
			//$('#modalTemp').modal('hide');
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function()
			{
				var html;
                    	$("#bodyCriteriosEspecificos").html('');
                    	var peso=0;var porcentaje=100;
                    	$.each(objectJSON.listaCriteriosEspecificos,function(index,element)
                    	{
                    	    peso = (parseInt(peso) + parseInt(element.peso));
                    	    html +='<tr>';
                    		html +='<td>'+element.nombre_criterio+'</td>';
                    		html +='<td>'+element.peso+'</td>';
                    		html +='<td>'+element.porcentaje+'</td>';
                    		html +='<td><button type="button" class="btn btn-primary btn-xs " onclick="EditarCriterioEspecifico('+element.id_criterio+')"><span class="fa fa-plus-circle"></span></button>';
                    		html +='<button onclick="Eliminar('+element.id_criterio+','+element.id_criterio_gen+');" data-toggle="tooltip" data-original-title="Eliminar Criterio Específico"   class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>';
                    		html +='</td>';
                    		html +='</tr>';
                    	});
                    	html +='<td> </td>';
                    	html +='<td>'+peso+'</h6> ';
                    	html +='<td> '+porcentaje+' % </td>';
                    	html +='<td> </td>';
                 $("#table-GriteriosEspecificos > #bodyCriteriosEspecificos").append(html);
			});

		}, false, true);

	});

});
	function EditarCriterioEspecifico(id)
	{
		paginaAjaxDialogo(11, 'Modificar Criterio Específico Criterio',{ id:id}, base_url+'index.php/PmiCriterioEspecifico/editar', 'GET', null, null, false, true);
	}

	function Eliminar(id_criterio,id_criterio_gen)
	{
		event.preventDefault();
		paginaAjaxJSON({ "id_criterio" : id_criterio,"id_criterio_gen":id_criterio_gen}, '<?=base_url();?>index.php/PmiCriterioEspecifico/eliminar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);
		swal({
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			
			function()
			{
				var html;
                    	$("#bodyCriteriosEspecificos").html('');
                    	var peso=0;var porcentaje=100;
                    	$.each(objectJSON.listaCriteriosEspecificos,function(index,element)
                    	{
                    	    peso = (parseInt(peso) + parseInt(element.peso));
                    	    html +='<tr>';
                    		html +='<td>'+element.nombre_criterio+'</td>';
                    		html +='<td>'+element.peso+'</td>';
                    		html +='<td>'+element.porcentaje+'</td>';
                    		html +='<td><button type="button" class="btn btn-primary btn-xs " onclick="EditarCriterioEspecifico('+element.id_criterio+')"><span class="fa fa-plus-circle"></span></button>';
                    		html +='<button onclick="Eliminar('+element.id_criterio+','+element.id_criterio_gen+');" data-toggle="tooltip" data-original-title="Eliminar Criterio Específico"   class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>';
                    		html +='</td>';
                    		html +='</tr>';
                    	});
                    	html +='<td> </td>';
                    	html +='<td>'+peso+'</h6> ';
                    	html +='<td> '+porcentaje+' % </td>';
                    	html +='<td> </td>';
                 $("#table-GriteriosEspecificos > #bodyCriteriosEspecificos").append(html);
			});
		}, false, true);
	}

</script>
