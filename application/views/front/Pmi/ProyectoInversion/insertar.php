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
							<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
							<input id="txtCodigoUnico" name="txtCodigoUnico" value="<?=@$proyectoInversion[0]->codigo_unico_pi?>" class="form-control" autocomplete="off" maxlength="10">	
						</div>	
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Fecha de viabilidad:</label>
						<div>
							<input type="date" id="txtFechaViabilidad" name="txtFechaViabilidad" value="<?=@$proyectoInversion[0]->fecha_viabilidad_pi?>"  class="form-control">
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
						<label class="control-label">Naturaleza*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectNaturaleza" name="selectNaturaleza" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($naturaleza as $key => $value) { ?>
									<option value='<?=$value->id_naturaleza_inv?>' <?php echo (@$proyectoInversion[0]->id_naturaleza_inv == $value->id_naturaleza_inv ? "selected" : "")?> >
									<?=$value->nombre_naturaleza_inv?></option>		      								      			
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
							<input autocomplete="off" id="txtCostoInversion" name="txtCostoInversion" value="<?=a_number_format(@$proyectoInversion[0]->costo_pi, 2, '.',",",3) ?>"  class="form-control moneda"  placeholder="Total del Proyecto (Pre Inversión)" autocomplete="off" maxlength="40" >
						</div>
					</div>					
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Número de Beneficiarios*</label>
						<div>
							<input autocomplete="off" id="txtNumBeneficiarios" name="txtNumBeneficiarios" value="<?=@$proyectoInversion[0]->num_beneficiarios?>" class="form-control"  placeholder="Número de beneficiarios indirectos" autocomplete="off" maxlength="40" >
						</div>
					</div>
					<div class=" col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Tipologia de Inversión*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectTipologiaInversion" name="selectTipologiaInversion" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($tipologia as $key => $value) { ?>
									<option value='<?=$value->id_tipologia_inv?>' <?php echo (@$proyectoInversion[0]->id_tipologia_inv == $value->id_tipologia_inv ? "selected" : "")?> >
									<?=$value->nombre_tipologia_inv?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Programa*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectPrograma" name="selectPrograma" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($programa as $key => $value) { ?>
									<option value='<?=$value->id_programa_pres?>' <?php echo (@$proyectoInversion[0]->id_programa_pres == $value->id_programa_pres ? "selected" : "")?> >
									<?=$value->nombre_programa_pres?></option>		      								      			
								  <?php } ?>
							</select>
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
				<!--
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Gerencia*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectGerencia" name="selectGerencia" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($gerencia as $key => $value) { ?>
									<option value='<?=$value->id_gerencia?>' <?php echo (@$proyectoInversion[0]->id_gerencia == $value->id_gerencia ? "selected" : "")?>>
									<?=$value->denom_gerencia?></option>		      								      			
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Sub Gerencia*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectSubGerencia" name="selectSubGerencia" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($subgerencia as $key => $value) { ?>
									<option value='<?=$value->id_subgerencia?>' <?php echo (@$proyectoInversion[0]->id_subgerencia == $value->id_subgerencia ? "selected" : "")?>>
									<?=$value->denom_subgerencia?></option>		      								      			
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<label class="control-label">Oficina*</label>
						<div class="form-group">
							<select class="selectpicker form-control" id="selectOficina" name="selectOficina" data-live-search="true">
								<option value="">Seleccione una opción</option>
								<?php foreach ($oficina as $key => $value) { ?>
									<option value='<?=$value->id_oficina?>' <?php echo (@$proyectoInversion[0]->id_oficina == $value->id_oficina ? "selected" : "")?> >
									<?=$value->denom_oficina?></option>		      								      			
								  <?php } ?>
							</select>
						</div>
					</div>
				</div>	-->	
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
				txtFechaViabilidad:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Fecha de viabilidad" es requerido.</b>'
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
				txtNumBeneficiarios:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Número de Beneficiarios" es requerido.</b>'
						},
						regexp:
						{
							regexp: /^[0-9]+$/,
							message: '<b style="color: red;">El campo "Número de Beneficiarios" es un valor númerico.</b>'
						}
					}
				},
				selectTipologiaInversion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipologia de Inversión" es requerido.</b>'
						}
					}
				},
				selectPrograma:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Programa Presupuestal" es requerido.</b>'
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
				},
				selectGerencia:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Gerencia" es requerido.</b>'
						}
					}
				},
				selectSubGerencia:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Sub Gerencia" es requerido.</b>'
						}
					}
				},
				selectOficina:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Oficina" es requerido.</b>'
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
		$("#selectGerencia").change(function()
		{
			var gerencia=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/SubGerencia/GetSubGerenciaId",
				data: 
				{
					id_gerencia:gerencia
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
						htmlTemp+='<option value='+objectJSON[item].id_subgerencia+'>'+objectJSON[item].denom_subgerencia+'</option>';
					}
					$('#selectSubGerencia').html(htmlTemp);
					$('#selectSubGerencia').selectpicker('refresh');
					$('#selectOficina').html('<option value="">Seleccione una opción</option>');
					$('#selectOficina').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

		$("#selectSubGerencia").change(function()
		{
			var subgerencia=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Oficina/GetOficinaId",
				data: 
				{
					id_subgerencia:subgerencia
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
						htmlTemp+='<option value='+objectJSON[item].id_oficina+'>'+objectJSON[item].denom_oficina+'</option>';
					}
					$('#selectOficina').html(htmlTemp);
					$('#selectOficina').selectpicker('refresh');
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
				$('#table_proyectos_inversion').dataTable()._fnAjaxUpdate();
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






