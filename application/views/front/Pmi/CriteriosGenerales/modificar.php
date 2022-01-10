<form class="form-horizontal"  id="form-EditarCriterioGeneral">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12">
				<label>Función</label><br/>
				<input type="hidden" class="form-control" id="hdIdcriterioGeneral" name="hdIdcriterioGeneral" value="<?= $listadoUnicoCGeneral->id_criterio_gen?>" placeholder="" autocomplete="off">
				<select id="cbx_funcion" name="cbx_funcion" class="form-control" >
						<?php foreach ($function as $Itemp) {?>
								 <option value="<?=$Itemp->id_funcion?>" <?=($Itemp->id_funcion==$listadoUnicoCGeneral->id_funcion ? 'selected' : '')?> ><?=$Itemp->nombre_funcion?></option>
						<?php  } ?>
				</select>
			</div>
			<div class="col-md-8 col-sm-8 col-xs-12">
				<label>Nombre</label>
				<input type="text" class="form-control" id="txtNombreCriterio" value="<?= $listadoUnicoCGeneral->nombre_criterio_gen?>" name="txtNombreCriterio" placeholder="Nombre Criterio" autocomplete="off">
			</div>
		</div>
		<h4 style="margin-bottom: 0px;">Detalle</h4>
		<hr style="margin: 2px;margin-bottom: 5px;">
		<div class="row" id="divCriterioGeneral">
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Año</label>
				<input type="text" class="form-control"  value="<?= $listadoUnicoCGeneral->anio_criterio_gen?>" id="txtAnioCriterioG" name="txtAnioCriterioG" placeholder="Año" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>Peso</label>	
				<input type="text" class="form-control" id="txtPesoCriterioG"  value="<?= $listadoUnicoCGeneral->peso_criterio_gen?>" name="txtPesoCriterioG" placeholder="Peso" autocomplete="off">
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label></label>
				<input type="button" id="btnEditarCriterioGeneral" class="btn btn-primary form-control" value="Agregar">
			</div>
		</div>

</form>
<script>
	$( document ).ready(function()
	{
	   	$('#cbx_funcion').selectpicker('refresh');
	   	$('#btnEditarCriterioGeneral').on('click', function(event)
		{
			event.preventDefault();
			
			$('#form-EditarCriterioGeneral').data('formValidation').validate();

			if(!($('#form-EditarCriterioGeneral').data('formValidation').isValid()))
			{
				return;
			}
			paginaAjaxJSON($('#form-EditarCriterioGeneral').serialize(), '<?=base_url();?>index.php/PmiCriterioG/editar', 'POST', null, function(objectJSON)
			{
				
				$('#1').modal('hide');
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function()
				{					
					paginaAjaxDialogo(null, 'Registro Criterio Generales', { id_funcion:objectJSON.id_funcion, nombre_funcion:'SALUD',anio:objectJSON.anio }, base_url+'index.php/PmiCriterioG/insertar', 'GET', null, null, false, true);
				});

			}, false, true);
		});
	});
	$(function()
	{
		$('#form-EditarCriterioGeneral').formValidation(
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
							message: '<b style="color: red;text-align: center;">El campo "Anio Criterio" es requerido.</b>'
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
</script>