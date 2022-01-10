<form class="form-horizontal"  id="form-addCriterioGeneral">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label>Función</label><br/>
				<input type="hidden" class="form-control" id="txtIdFuncion" name="txtIdFuncion" value="<?= $id_funcion;?>" placeholder="" autocomplete="off" >
				<select id="cbx_funcion" name="cbx_funcion" class="selectpicker" data-live-search="true" disabled>
						<?php foreach ($function as $Itemp) {?>
								 <option value="<?=$Itemp->id_funcion?>" <?=($Itemp->id_funcion==$id_funcion ? 'selected' : '')?> ><?=$Itemp->nombre_funcion?></option>
						<?php  } ?>
				</select>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<label>Nombre</label>
				<input type="text" class="form-control" id="txtNombreCriterio" name="txtNombreCriterio" placeholder="Nombre Criterio" autocomplete="off" maxlength="200">
			</div>
		</div>
		<h4 style="margin-bottom: 0px;">Detalle</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row" id="divCriterioGeneral">
			<div class="col-md-2 col-sm-6 col-xs-12">
				<label>Año</label>
				<input type="text" class="form-control" id="txtAnioCriterioG" name="txtAnioCriterioG" value="<?= $anio;?>" placeholder="Año" autocomplete="off" maxlength="10">
			</div>
			<div class="col-md-2 col-sm-6 col-xs-12">
				<label>Peso</label>
				<!-- <input type="text" class="form-control" id="txtPesoCriterioG" name="txtPesoCriterioG" placeholder="Peso" autocomplete="off"> -->
				<input class="form-control" id="txtPesoCriterioG" name="txtPesoCriterioG" placeholder="Peso" autocomplete="off" type='number' max='100'>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label></label>
				<input style="margin-top: 5px;" type="button" id="btnAgregarCriterioGeneral" class="btn btn-primary form-control" value="Agregar">
			</div>
		</div>
		<div style="height:200px;overflow:scroll;overflow-x: hidden; "><br/>
			<table id="table-GriterioGenerales" class="table table-striped table-bordered jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td>Nombre</td>
						<td>Peso</td>
						<td>Porcentaje %</td>
						<td style="width:15%"></td>
					</tr>
				</thead>
				<tbody id="bodyCriterioGenerales">
						<?php $peso=0;$por=0; foreach ($listaCritetioGeneral as $key => $item) { $peso +=$item->peso_criterio_gen; $por=100; ?>
						<tr>
										<td><?= $item->nombre_criterio_gen?></td>
										<td><?= $item->peso_criterio_gen?></td>
										<td><?php  if($item->porcentaje<1){ echo '0'.$item->porcentaje;}else{ echo $item->porcentaje;} ?> %</td>
										<td>
											<button data-toggle="tooltip" title="Editar Criterio General" type="button" class="btn btn-primary btn-xs " onclick="EditarCriterioGeneral(<?=$item->id_criterio_gen?>)"><i class="fa fa-pencil"></i></button>
											<button data-toggle="tooltip" title="Agregar Criterio Especifico" type="button" class="btn btn-primary btn-xs " onclick="CriterioEspecificos(<?=$item->id_criterio_gen?>)"><i class="fa fa-bars"></i></button>
											<button data-toggle="tooltip" title="Eliminar Criterio General" onclick="EliminarCriterioGeneral(<?=$item->id_criterio_gen?>,<?=$item->id_funcion?>,<?=$item->anio_criterio_gen ?>);" data-toggle="tooltip" data-original-title="Eliminar Analitico"   class='btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button></td>
						</tr>
					<?php }?>
					<tr>
						<td> </td>
						<td> <h6>Total <?php echo $peso;?></h6> </td>
						<td> <h6><?php echo $por ;?> %</h6> </td>
						<td> </td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12 col-sm-12 col-xs-12">
			<button class="btn btn-danger" style="float: right;" data-dismiss="modal">
                <span class="glyphicon glyphicon-remove"></span> Cerrar
           	</button>
		</div>
</form>
<script>
$(function()
	{
		$('#btnGuardarCambios').on('click', function(event)
		{
			txtAnioCriterioG=$('#txtAnioCriterioG').val();
			window.location.href=base_url+"index.php/PmiCriterioG/criterioFuncion?anio="+txtAnioCriterioG;
			renderLoading();
		});

		$('#form-addCriterioGeneral').formValidation(
				{
					framework: 'bootstrap',
					excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
					live: 'enabled',
					message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
					trigger: null,
					fields:
					{
						txtNombreCriterio:
						{
							validators:
							{
								notEmpty:
								{
									message: '<b style="color: red;text-align: center;">El campo "Criterio General" es requerido.</b>'
								},
					regexp:
                    {
                        regexp: /^[a-zA-Z\s]+$/,
                        message: '<b style="color: red;">El campo "Criterio General" es solo texto.</b>'
                    },
					stringLength:
                    {
                        max: 150,
                        message: '<b style="color: red;">El campo "Criterio General" no puede exceder los 150 carácteres.</b>'
                    }
							}
						},
						txtAnioCriterioG:
						{
							validators:
							{
								notEmpty:
								{
									message: '<b style="color: red;text-align: center;">El campo "Anio Criterio" debe ser un número entero.</b>'
								},
						regexp:
			            {
			                regexp: /^\d{4}$/,
			                message: '<b style="color: red;">El campo "Anio Criterio" debe ser un número entero de 4 dígitos.</b>'
			            },
			          stringLength:
                    {
                        min: 4,
                        max: 4,
                        message: '<b style="color: red;">Ingrese un valor válido.</b>'
                    }
							}
						},
						txtPesoCriterioG:
						{
							validators:
							{
								notEmpty:
								{
									message: '<b style="color: red;text-align: center;">El campo "Criterio General" es requerido.</b>'
								},
								regexp:
								   {
								       regexp: /^[1-9][0-9]?$|^100$/,
								       message: '<b style="color: red;">El campo "Peso Criterio General" 0 - 100.</b>'
								   }
							}
						}


					}
				});
});

$(function()
	{

    $('#cbx_funcion').selectpicker('refresh');

    $('#btnAgregarCriterioGeneral').on('click', function(event)
	{
		event.preventDefault();
		$('#form-addCriterioGeneral').data('formValidation').validate();

		if(!($('#form-addCriterioGeneral').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-addCriterioGeneral').serialize(), '<?=base_url();?>index.php/PmiCriterioG/insertar', 'POST', null, function(objectJSON)
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
                    	$("#bodyCriterioGenerales").html('');
                    	var peso=0;var por=100;
                    	$.each(objectJSON.listaCritetioGeneral,function(index,element)
                    	{
                    	    peso = (parseInt(peso) + parseInt(element.peso_criterio_gen));
                    	    html +='<tr>';
                    		html +='<td>'+element.nombre_criterio_gen+'</td>';
                    		html +='<td>'+element.peso_criterio_gen+'</td>';
                    		html +='<td>'+element.porcentaje+'</td>';
                    		html +='<td><button type="button" class="btn btn-primary btn-xs " onclick="EditarCriterioGeneral('+element.id_criterio_gen+')"><i class="fa fa-pencil"></i></button>';
                    		html +='<button type="button" class="btn btn-primary btn-xs " onclick="CriterioEspecificos('+element.id_criterio_gen+')"><i class="fa fa-bars"></i></button>';
                    		html +='<button onclick="EliminarCriterioGeneral('+element.id_criterio_gen+','+element.id_funcion+','+element.anio_criterio_gen+');" data-toggle="tooltip" data-original-title="Eliminar Analitico"   class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>';
                    		html +='</td>';
                    		html +='</tr>';
                    	});
                    	html +='<tr><td> </td>';
                    	html +='<td> <h6>'+peso+'</h6> </td>';
                    	html +='<td> <h6> '+por+' %</h6> </td>';
                    	html +='<td> </td></tr>';
                 $("#table-GriterioGenerales > #bodyCriterioGenerales").append(html);
			});

		}, false, true);

	});

});
function EditarCriterioGeneral(idCriterioGeneral)
{
	//alert(idCriterioGeneral);
	paginaAjaxDialogo(1, 'Editar Criterio General',{ idCriterioGeneral:idCriterioGeneral}, base_url+'index.php/PmiCriterioG/editar', 'GET', null, null, false, true);
}
function CriterioEspecificos(id_criterio_gen)
{
	paginaAjaxDialogo(2, 'Registro Criterio Específicos',{ id_criterio_gen:id_criterio_gen}, base_url+'index.php/PmiCriterioEspecifico/index', 'GET', null, null, false, true);
}
function EliminarCriterioGeneral(idCriterioGeneral,id_funcion,anio_criterio_gen)
{
	swal({
	    title: "¿Esta seguro que desea eliminar el Criterio General?",
	    text: "",
	    type: "warning",
	    showCancelButton: true,
	    cancelButtonText:"Cerrar" ,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "SI,Eliminar",
	    closeOnConfirm: false
	},
	function()
	{
		$('#cbx_funcion').selectpicker('refresh');
		event.preventDefault();
		paginaAjaxJSON({ "idCriterioGeneral" : idCriterioGeneral,"id_funcion" : id_funcion,'anio_criterio_gen':anio_criterio_gen}, '<?=base_url();?>index.php/PmiCriterioG/eliminar', 'POST', null, function(objectJSON)
		{
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
            	$("#bodyCriterioGenerales").html('');
            	var peso=0;var por=100;
            	$.each(objectJSON.listaCritetioGeneral,function(index,element)
            	{
            	    peso = (parseInt(peso) + parseInt(element.peso_criterio_gen));
            	    html +='<tr>';
            		html +='<td>'+element.nombre_criterio_gen+'</td>';
            		html +='<td>'+element.peso_criterio_gen+'</td>';
            		html +='<td>'+element.porcentaje+'</td>';
            		html +='<td><button type="button" class="btn btn-primary btn-xs " onclick="EditarCriterioGeneral('+element.id_criterio_gen+')"><i class="fa fa-pencil"></i></button>';
            		html +='<button type="button" class="btn btn-primary btn-xs " onclick="CriterioEspecificos('+element.id_criterio_gen+')"><i class="fa fa-bars"></i></button>';
            		html +='<button onclick="EliminarCriterioGeneral('+element.id_criterio_gen+','+element.id_funcion+','+element.anio_criterio_gen+');" data-toggle="tooltip" data-original-title="Eliminar Analitico"   class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button>';
            		html +='</td>';
            		html +='</tr>';
            	});
            	html +='<tr><td> </td>';
            	html +='<td> <h6>'+peso+'</h6> </td>';
            	html +='<td> <h6> '+por+' %</h6> </td>';
            	html +='<td> </td></tr>';
                $("#table-GriterioGenerales > #bodyCriterioGenerales").append(html);
			});

		}, false, true);

	});

}
</script>
