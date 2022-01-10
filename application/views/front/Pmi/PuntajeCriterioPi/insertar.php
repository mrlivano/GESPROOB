
</style>
<form class="form-horizontal"  id="form-addAsignarPuntajePi">
		<div class="row">
			<div class="col-md-12 col-sm-3 col-xs-12">
				<label class="control-label">Nombre del Proyecto de Inversion </label>
				<input type="hidden" name="id_funcion" id="id_funcion" value="<?= $id_funcion?>">
				<input type="hidden" name="anioPriorizacioProyecto" id="anioPriorizacioProyecto" value="<?= $anio?>">

				<div>
					<input type="hidden" id="txtIdPi" name="txtIdPi" value="<?= $listaUnicaProIv->id_pi?>" class="form-control col-md-4 col-xs-12"  placeholder="Nombre del proyecto" autocomplete="off"  type="hidden">
					<input id="txtNombreUe" name="txtNombrePi" value="<?= $listaUnicaProIv->nombre_pi?>" class="form-control col-md-4 col-xs-12"  autocomplete="off" readonly="readonly">
				</div>
			</div>
		</div><br/>
		<div class="row">

			<div style=" margin-left: 100px;" class="col-md-3 col-sm-3 col-xs-12">
			<label class="control-label">AÑO</label>
				<select  id="comboanioCriterioG" name="comboanioCriterioG" class="form-control" class="selectpicker" data-width="75%" data-live-search="true"></select>
			</div>
		</div><br/>
		<div class="row">
			<div class="col-md-12 col-sm-3 col-xs-12">
					<label class="control-label">Criterio general: &nbsp;&nbsp;&nbsp;</label>
					<input type="hidden"  name="sumaPesoTotalGeberal" value="<?= $sumaPesoTotalGeberal ?>">
					<select  id="combocriteriogeneral" name="combocriteriogeneral"  class="selectpicker" data-width="75%" data-live-search="true">

					</select>
			</div>
		</div><br/>
		<div class="row">
			<input type="hidden" name="SumaTotaCriterio" id="SumaTotaCriterio">
			<div class="col-md-12 col-sm-3 col-xs-12">
					<label class="control-label">Criterio especifico:</label>
					<select  id="combocriterioespecif" name="combocriterioespecif[]" class="selectpicker" multiple data-actions-box="true" data-width="75%" data-live-search="true" required="required" class="form-control">

					</select>
			</div>
		</div>

		<div class="row" id="divCriterioGeneral">
			<div class="col-md-2 col-sm-2 col-xs-12">
				<label></label>
				<input style="margin-top: 5px;" type="button" id="btnAsignarPuntajePip" class="btn btn-primary form-control" value="Agregar"/>
			</div>
			<div class="col-md-2 col-sm-2 col-xs-12">
				<label></label>
				<button class="btn btn-info form-control" style="margin-top: 5px;margin-left: 50px;" id="btnGuardarCambios"><i class="fa fa-refresh"> Guardar</i> </button>
			</div>
		</div>
		<div style="height:300px;overflow:scroll;overflow-x: hidden; "><br/>
			 <div class="row">
				<div class="col-md-3 col-sm-3 col-xs-12">
								 <label style="text-align: center;background: #ffffff;" ><h5><span class="badge"> Listado de Puntaje del año <label id="anio"><?= $anio?></label></span> </h5></label>
				</div>
				<div class="col-md-3 col-sm-3 col-xs-12">
					<select  id="ComboListadoCriterios" name="ComboListadoCriterios" class="form-control" class="selectpicker" data-width="75%" data-live-search="true"></select>
				</div>
			</div>

			<table id="table-puntaje" class="table table-striped table-bordered jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
				<thead>
					<tr>
						<td width="40%"><u> Criterio General</u> | <u style="margin-left: 10px;"> Criterio Especificos</u></td>
						<td width="1%">Puntaje</td>
						<td width="5%">Opcion</td>
					</tr>
				</thead>
				<tbody id="bodyPuntaje">

						<?php foreach ($dataCriterioGeneralAniFuncion as $ite) {?>
							<tr>
									<td  class="success" colspan="3"><strong><?= $ite->nombre_criterio_gen ?></strong></td>

										<?php $puntaje=0; foreach ($listarPuntajeCriterioPip as $itemp) { $puntaje =round($puntaje,2)+round($itemp->puntaje_criterio,2)?>
											<?php if($ite->id_criterio_gen==$itemp->id_criterio_gen) {?>
												<tr>

													<td><ol style="margin-left: 60px;text-align: left;"><?= $itemp->nombre_criterio ?></ol></td>
						                    		<td style="text-align: right;"><?= $itemp->puntaje_criterio ?></td>
						                    		<td>
						                    			<button type="button" class="btn btn-danger btn-xs " onclick="eliminarPuntaje(<?=$itemp->id_ptje_criterio?>,<?=$itemp->id_pi?>,<?= $itemp->anio_ptje_criterio ?>)"><span class="fa fa-trash"></span></button>
						                    		</td>
						                    	</tr>
											<?php } ?>
										<?php } ?>

							</tr>
						<?php } ?>
					<tr>
						<td></td>
						<td><button type="button" class="btn btn-success">Puntaje Total <span class="badge"><?= (!isset($puntaje) ? '' : number_format($puntaje, 2, '.', ' ')); ?></span></button> </td>
						<td></td>
					</tr>

				</tbody>
			</table>

		</div>
</form>

<script>
$(document).ready(function()
	{
		aniosCriterioGeneral();
		anioListadoCriterios();
	});

$(function()
	{

		$('#btnGuardarCambios').on('click', function(event)
		{
			var id_funcion=$('#id_funcion').val();
			window.location.href=base_url+"index.php/PuntajeCriterioPi/index?id="+id_funcion;
			renderLoading();

		});
		$('#comboanioCriterioG').selectpicker('refresh');
		$('#combocriterioespecif').selectpicker('refresh');
		$('#combocriteriogeneral').selectpicker('refresh');
		$('#comboanios').selectpicker('refresh');

		$('#form-addAsignarPuntajePi').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				combocriteriogeneral:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;text-align: center;">El campo "Criterio General" es requerido.</b>'
						}
					}
				},
				combocriterioespecif:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;text-align: center;">El campo "Criterio especifico" es requerido.</b>'
						}
					}
				}

			}
		});
	});


$("#comboanioCriterioG" ).change(function() {

		$("#combocriterioespecif").html('');
		$('#combocriterioespecif').selectpicker('refresh');

		var anio=$("#comboanioCriterioG").val();
		var id_funcion=$("#id_funcion").val();
		var parametros = {
                "anio" : anio,
                "id_funcion" :id_funcion,
        };
        $.ajax({
                data:  parametros,
                url:    base_url+'index.php/PmiCriterioG/listarCriterioGPorAnios',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
                		 objectJSON=JSON.parse(response);
                     	 var html,sumaTotalCriteo=0;
                    	$("#combocriteriogeneral").html('');

                    	html +='<option value="">Elija Criterio General </option>';
                    	$.each(objectJSON.dataCriterioGeneralAni,function(index,element)
                    	{
                    	 sumaTotalCriteo =parseInt(sumaTotalCriteo) + parseInt(element.peso_criterio_gen);
                    	 html +='<option value="'+element.id_criterio_gen+'">'+element.nombre_criterio_gen+'</option>';
                    	});
                 		$("#combocriteriogeneral").append(html);
                 		$('#combocriteriogeneral').selectpicker('refresh');
                 		$("#SumaTotaCriterio").val(sumaTotalCriteo);

                }
        });
	});

$("#combocriteriogeneral" ).change(function() {

		id_criterio_gen=$("#combocriteriogeneral").val();
		var parametros = {
                "id_criterio_gen" : id_criterio_gen,
        };
        $.ajax({
                data:  parametros,
                url:    base_url+'index.php/PmiCriterioEspecifico/listarCriterioEspecificos',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
                		objectJSON=JSON.parse(response);
                     	 var html,sumaTotalCriteo=0;
                    	$("#combocriterioespecif").html('');
                    	$.each(objectJSON.listaCriteriosEspecificos,function(index,element)
                    	{
                    	 sumaTotalCriteo =parseInt(sumaTotalCriteo) + parseInt(element.peso);
                    	 html +='<option value="'+element.id_criterio+'">'+element.nombre_criterio+'</option>';
                    	});
                 		$("#combocriterioespecif").append(html);
                 		$('#combocriterioespecif').selectpicker('refresh');
                 		$("#SumaTotaCriterio").val(sumaTotalCriteo);

                }
        });
	});

$("#ComboListadoCriterios").change(function()
{
		var anio=$("#ComboListadoCriterios").val();
		var txtIdPi=$("#txtIdPi").val();
		var id_funcion=$("#id_funcion").val();

		var parametros = {
                "IdPi" : txtIdPi,
                "anio":anio,
                "id_funcion" :id_funcion,
        };
        $.ajax({
                data:  parametros,
                url:    base_url+'index.php/PuntajeCriterioPi/listarPuntajePorAnios',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
						objectJSON=JSON.parse(response);
						var html;
                		$("#bodyPuntaje").html('');
                    	var puntaje=0;

                    	$.each(objectJSON.dataCriterioGeneralAniFuncion,function(index,elemento)
                    	{
            				html +='<tr>';
							html +='<td  class="success" colspan="3"><strong>'+elemento.nombre_criterio_gen+'</strong></td>';

		                    	$.each(objectJSON.listarPuntajeCriterioPip,function(index,element)
		                    	{
		                    	    if(elemento.id_criterio_gen==element.id_criterio_gen)
		                    	    {
		                    	    	puntaje = parseFloat(puntaje) + parseFloat(element.puntaje_criterio);
		                    	    	html +='<tr>';
				                    		html +='<td><ol style="margin-left: 60px;text-align: left;">'+element.nombre_criterio+'</ol></td>';
				                    		html +='<td style="text-align: right;">'+element.puntaje_criterio+'</td>';
				                    		html +='<td><button type="button" class="btn btn-danger btn-xs " onclick="eliminarPuntaje('+element.id_ptje_criterio+','+element.id_pi+','+element.anio_ptje_criterio+')"><span class="fa fa-trash"></span></button> </td>';
			                    		html +='</tr>';
		                    	    }

		                    	});

							html +='<tr>';
                    	});
                    	html +='<tr><td> </td>';
                    	html +='<td><button type="button" class="btn btn-success">Puntaje Total <span class="badge">'+puntaje+'.00'+'</span></button></td>';
                    	html +='<td></td></tr>';
		                 $("#table-puntaje > #bodyPuntaje").append(html);
		                 $("#anio").html('');
		                 $("#anio").html(anio);
                }
        });
	});

$(function()
	{

    $('#btnAsignarPuntajePip').on('click', function(event)
	{
		event.preventDefault();

		$('#form-addAsignarPuntajePi').data('formValidation').validate();

		if(!($('#form-addAsignarPuntajePi').data('formValidation').isValid()))
		{
			return;
		}

		paginaAjaxJSON($('#form-addAsignarPuntajePi').serialize(), '<?=base_url();?>index.php/PuntajeCriterioPi/insertar', 'POST', null, function(objectJSON)
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
                    	$("#bodyPuntaje").html('');
                    	var puntaje=0;

                    	$.each(objectJSON.dataCriterioGeneralAniFuncion,function(index,elemento)
                    	{
            				html +='<tr>';
							html +='<td  class="success" colspan="3"><strong>'+elemento.nombre_criterio_gen+'</strong></td>';

		                    	$.each(objectJSON.listarPuntajeCriterioPip,function(index,element)
		                    	{
		                    	    if(elemento.id_criterio_gen==element.id_criterio_gen)
		                    	    {
		                    	    	puntaje = parseFloat(puntaje) + parseFloat(element.puntaje_criterio);
		                    	    	html +='<tr>';
				                    		html +='<td><ol style="margin-left: 60px;text-align: left;">'+element.nombre_criterio+'</ol></td>';
				                    		html +='<td style="text-align: right;">'+element.puntaje_criterio+'</td>';
				                    		html +='<td><button type="button" class="btn btn-danger btn-xs " onclick="eliminarPuntaje('+element.id_ptje_criterio+','+element.id_pi+','+element.anio_ptje_criterio+')"><span class="fa fa-trash"></span></button> </td>';
			                    		html +='</tr>';
		                    	    }

		                    	});

							html +='<tr>';
                    	});
                    	html +='<tr><td> </td>';
                    	html +='<td><button type="button" class="btn btn-success">Puntaje Total <span class="badge">'+puntaje+'.00'+'</span></button></td>';
                    	html +='<td></td></tr>';

                 $("#table-puntaje > #bodyPuntaje").append(html);
			});

		}, false, true);

	});


});
function eliminarPuntaje(id_ptje_criterio,id_pi,anio)
	{
		var id_funcion=$("#id_funcion").val();
		event.preventDefault();
		paginaAjaxJSON({ "id_ptje_criterio" : id_ptje_criterio,"id_pi" : id_pi,"anio" : anio,"id_funcion" :id_funcion}, '<?=base_url();?>index.php/PuntajeCriterioPi/eliminarPuntajecriterio', 'POST', null, function(objectJSON)
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
                    	$("#bodyPuntaje").html('');
                    	var puntaje=0;

                    	$.each(objectJSON.dataCriterioGeneralAniFuncion,function(index,elemento)
                    	{
            				html +='<tr>';
							html +='<td  class="success" colspan="3"><strong>'+elemento.nombre_criterio_gen+'</strong></td>';

		                    	$.each(objectJSON.listarPuntajeCriterioPip,function(index,element)
		                    	{
		                    	    if(elemento.id_criterio_gen==element.id_criterio_gen)
		                    	    {
		                    	    	puntaje = parseFloat(puntaje) + parseFloat(element.puntaje_criterio);
		                    	    	html +='<tr>';
				                    		html +='<td><ol style="margin-left: 60px;text-align: left;">'+element.nombre_criterio+'</ol></td>';
				                    		html +='<td style="text-align: right;">'+element.puntaje_criterio+'</td>';
				                    		html +='<td><button type="button" class="btn btn-danger btn-xs " onclick="eliminarPuntaje('+element.id_ptje_criterio+','+element.id_pi+','+element.anio_ptje_criterio+')"><span class="fa fa-trash"></span></button> </td>';
			                    		html +='</tr>';
		                    	    }

		                    	});

							html +='<tr>';
                    	});
                    	html +='<tr><td> </td>';
                    	html +='<td><button type="button" class="btn btn-success">Puntaje Total <span class="badge">'+puntaje+'.00'+'</span></button></td>';
                    	html +='<td></td></tr>';

                 $("#table-puntaje > #bodyPuntaje").append(html);
			});

		}, false, true);

	}
function aniosCriterioGeneral()
	{



		var aniosI=2015;

		var html;
		var itn=1;
		html +='<option value=""> Buscar Años </option>';
		for (var i=2015; i<=2050; i++) {

			html +='<option value="'+(parseInt(aniosI)+parseInt(itn))+'"> '+(parseInt(aniosI)+parseInt(itn))+' </option>';
			itn++;
		}
		$("#comboanioCriterioG").append(html);

	}
	function anioListadoCriterios()
	{



		var aniosI=2015;

		var html;
		var itn=1;
		html +='<option value=""> Buscar Años </option>';
		for (var i=2015; i<=2050; i++) {

			html +='<option value="'+(parseInt(aniosI)+parseInt(itn))+'"> '+(parseInt(aniosI)+parseInt(itn))+' </option>';
			itn++;
		}
		$("#ComboListadoCriterios").append(html);

	}

</script>
