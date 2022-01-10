<style>
	.row
	{
		margin-top: 4px;
	}
</style>
<form class="form-horizontal" id="frmProyectoInversion">
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_content" id="validarProyectoInversion">
				<div class="row">
					<div class="col-md-4 col-sm-12 col-xs-12">
						<label class="control-label">Codigo Unico*</label>
						<div>
							<input id="hdIdNopip" name="hdIdNopip" value="<?=@$proyectoInversion[0]->id_nopip?>" readonly="readonly" autocomplete="off"  type="hidden">	
							<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
							<input id="txtCodigoUnico" name="txtCodigoUnico" value="<?=@$proyectoInversion[0]->codigo_unico_pi?>" class="form-control" autocomplete="off" maxlength="10">	
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<label class="control-label">Proyecto*</label>
						<div>
							<textarea autocomplete="off" name="txtProyecto" id="txtProyecto" rows="3" class="form-control" style="resize: none;resize: vertical;"><?=html_escape(trim(@$proyectoInversion[0]->nombre_pi))?></textarea>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Tipo IOARR*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectNaturaleza" name="selectNaturaleza" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($naturaleza as $key => $value) { ?>
									<option value='<?=$value->id_tipo_nopip?>' <?php echo (@$proyectoInversion[0]->id_tipo_nopip == $value->id_tipo_nopip ? "selected" : "")?>>
									<?=$value->desc_tipo_nopip?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Nivel de Gobierno*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectNivelGobierno" name="selectNivelGobierno" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($nivelGobiero as $key => $value) { ?>
									<option value='<?=$value->id_nivel_gob?>' <?php echo (@$proyectoInversion[0]->id_nivel_gob == $value->id_nivel_gob ? "selected" : "")?> >
									<?=$value->nombre_nivel_gob?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Unidad Ejecutora*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectUnidadEjecutora" name="selectUnidadEjecutora" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($unidadEjecutora as $key => $value) { ?>
									<option value='<?=$value->id_ue?>' <?php echo (@$proyectoInversion[0]->id_ue == $value->id_ue ? "selected" : "")?> >
									<?=$value->nombre_ue?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
				</div>			
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Función*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectFuncion" name="selectFuncion" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($funcion as $key => $value) { ?>
									<option value='<?=$value->id_funcion?>' <?php echo (@$proyectoInversion[0]->id_funcion == $value->id_funcion ? "selected" : "")?>>
									<?=$value->nombre_funcion?></option>		      								      			
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Divisón Funcional*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectDivisionFuncional" name="selectDivisionFuncional" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($divisionfuncional as $key => $value) { ?>
									<option value='<?=$value->id_div_funcional?>' <?php echo (@$proyectoInversion[0]->id_div_funcional == $value->id_div_funcional ? "selected" : "")?>>
									<?=$value->nombre_div_funcional?></option>		      								      			
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Grupo Funcional*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectGrupoFuncional" name="selectGrupoFuncional" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($grupofuncional as $key => $value) { ?>
									<option value='<?=$value->id_grup_funcional?>' <?php echo (@$proyectoInversion[0]->id_grupo_funcional == $value->id_grup_funcional ? "selected" : "")?> >
									<?=$value->nombre_grup_funcional?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
				</div>					
				<div class="row">	
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Costo de Inversión*</label>
						<div>
							<input id="txtCostoInversion" name="txtCostoInversion" value="<?=a_number_format(@$proyectoInversion[0]->costo_pi, 2, '.',",",3) ?>"  class="form-control moneda"  placeholder="Total del Proyecto (Pre Inversión)" autocomplete="off" maxlength="40" >
						</div>
					</div>	
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Unidad Formuladora*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectUnidadFormuladora" name="selectUnidadFormuladora" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($unidadFormuladora as $key => $value) { ?>
									<option value='<?=$value->id_uf?>' <?php echo (@$proyectoInversion[0]->id_uf == $value->id_uf ? "selected" : "")?> >
									<?=$value->nombre_uf?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Estado*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectEstado" name="selectEstado" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<option value="1" <?php echo (@$proyectoInversion[0]->estado_pi == 1 ? "selected" : "")?>>Activo</option>
								<option value="2" <?php echo (@$proyectoInversion[0]->estado_pi == 2 ? "selected" : "")?>>Inactivo</option>
							</select>
						</div>
					</div>				
				</div>		
			</div>
		</div>
	</div>
</div>
<div class="ln_solid"></div>
<div class="row" style="text-align: right;">
	<input type="button" class="btn btn-success" onclick="guardarProyectoInversion();" value="Guardar">
	<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>
</form>

<script>
	$(function()
	{
		$('#validarProyectoInversion').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtCodigoUnico:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Código unico" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^[0-9]+$/,
							message: '<b style="color: red;">El campo "Código unico" debe contener solo números.</b>'
						}
					}
				},
				txtProyecto:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Nombre del Proyecto de Inversión" es requerido.</b>'
						}
					}
				},
				selectNaturaleza:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Naturaleza de Inversión" es requerido.</b>'
						}
					}
				},
				selectNivelGobierno:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Nivel de Gobierno" es requerido.</b>'
						}
					}
				},
				selectUnidadEjecutora:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad Ejecutora" es requerido.</b>'
						}
					}
				},
				selectFuncion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Función" es requerido.</b>'
						}
					}
				},
				selectDivisionFuncional:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "División Funcional" es requerido.</b>'
						}
					}
				},
				selectGrupoFuncional:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Grupo Funcional" es requerido.</b>'
						}
					}
				},				
				txtCostoInversion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Costo de Inversión" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Costo de Inversión" debe ser un valor en soles.</b>'
						}
					}
				},
				selectUnidadFormuladora:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad Formuladora" es requerido.</b>'
						}
					}
				},
				selectEstado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Estado" es requerido.</b>'
						}
					}
				}
			}
		});

		$("#selectFuncion").change(function()
		{
			var funcion=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/DivisionFuncional/GetDivisionFuncionalId",
				data: 
				{
					id_funcion:funcion
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">Seleccione una opción</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].id_div_funcional+'>'+objectJSON[item].nombre_div_funcional+'</option>';
					}
					$('#selectDivisionFuncional').html(htmlTemp);
					$('#selectDivisionFuncional').selectpicker('refresh');
					$('#selectGrupoFuncional').html('<option value="">Seleccione una opción</option>');
					$('#selectGrupoFuncional').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

		$("#selectDivisionFuncional").change(function()
		{
			var divisionFuncional=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/GrupoFuncional/GetGrupoFuncionalId",
				data: 
				{
					id_div_funcional:divisionFuncional
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">Seleccione una opción</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].id_grup_funcional+'>'+objectJSON[item].nombre_grup_funcional+'</option>';
					}
					$('#selectGrupoFuncional').html(htmlTemp);
					$('#selectGrupoFuncional').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});
	})

	$(".moneda").keyup(function(e)
    {
        $(this).val(format($(this).val()));
    }); 
   
    var format = function(num)
    {
	    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
	    if(str.indexOf(".") > 0) 
	    {
	        parts = str.split(".");
	        str = parts[0];
	    }
	    str = str.split("").reverse();
	    for(var j = 0, len = str.length; j < len; j++) 
	    {
	        if(str[j] != ",") 
	        {
	            output.push(str[j]);
	            if(i%3 == 0 && j < (len - 1))
	            {
	                output.push(",");
	            }
	            i++;
	        }
	    }
	    formatted = output.reverse().join("");
	    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
	};

	$('.selectpicker').selectpicker({
	});

	function guardarProyectoInversion()
	{
		event.preventDefault();
        $('#validarProyectoInversion').data('formValidation').validate();
		if(!($('#validarProyectoInversion').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmProyectoInversion")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/ProyectoInversion/<?=$accion?>",
			data: formData,
			cache: false,
			contentType:false,
			processData:false,
			beforeSend: function() 
			{
            	renderLoading();
		    },
			success:function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);
				swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();	
				$('#table_no_pip').dataTable()._fnAjaxUpdate();
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






