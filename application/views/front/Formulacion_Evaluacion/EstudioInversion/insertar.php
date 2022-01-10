<form class="form-horizontal" id="frmInsertarEstudio" action="<?php echo base_url();?>index.php/Estudio_Inversion/AddEstudioInversion" method="POST" >
	<div class="row ">
        <div class="col-md-12">
            <div class=".col-xs-12 .col-md-12">
                <div class="panel panel-default">
                    <div class="panel-body">
						<div class="count red">Ojo: Proyectos previamente programadas en PMI </div>
						<br>
                    	<div class="row">
	                    	<div class="col-md-3">
	                            <div class=".col-xs-12 .col-md-3">
	                                <label for="txtNombreEstudioInversion">Seleccione Estado: <span class="required">*</span>
	                                </label>
	                                <select   id="selectEstado" name="selectEstado" class="selectpicker form-control col-md-3 col-xs-12" data-live-search="true"  title="Seleccione Estado...">	        
										<?php foreach($estado as $item ){ ?>
											<option value="<?=$item->nombre_estado_ciclo?>"><?=$item->nombre_estado_ciclo?></option>
										<?php } ?>   
							     	</select>
	                            </div>
	                        </div>
                        </div>
                        <div class="row">
	                    	<div class="col-md-12">
	                    		<br>
	                            <div class=".col-xs-12 .col-md-10">
	                                <label for="listaProyectos">Proyecto PMI: <span class="required">*</span></label>
							        <select id="listaProyectos" name="listaProyectos" class="selectpicker form-control col-md-9 col-xs-12" data-live-search="true"  title="Buscar Proyecto...">	        
							     	</select>
	                            </div>
	                        </div>
                        </div>
                        <div class="row">
	                        <div class="col-md-12">
	                        	<br>
	                            <div class=".col-xs-12 .col-md-10">
	                                <label for="txtNombreEstudioInversion">Nombre de Estudio de Inversión: <span class="required">*</span>
	                                </label>
	                                <input id="txtNombreEstudioInversion" name="txtNombreEstudioInversion"  class="form-control col-md-1 col-xs-1" placeholder="Nombre de Estudio de Inversión" required="required" type="text" autocomplete="off">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-md-12">
	                        	<br>
	                            <div class=".col-xs-12 .col-md-10">
	                                <label for="listaCoordinador">Asignar Coordinador: <span class="required">*</span>
	                                </label>
	                                <select   id="listaCoordinador" name="listaCoordinador" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Responsable...">
		                            <?php foreach($listaCoordinador as $item ){ ?>
							        	<option value="<?= $item->id_persona?>"><?=$item->nombres." ".$item->apellido_p?></option>
							     	<?php } ?>                         	
		                            </select>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="row">
	                    	<div class="col-md-6">
	                    		<br>
	                        	<label for="listaTipoEstudio">Tipo de Estudio: <span class="required">*</span></label>
	                            <select   id="listaTipoEstudio" name="listaTipoEstudio" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Tipo de Estudio...">
	                            <?php foreach($listaTipoEstudio as $item ){ ?>
						        	<option value="<?= $item->id_tipo_est?>"><?=$item->nombre_tipo_est?></option>
						     	<?php } ?>                            	
	                            </select>
	                        </div>
	                        <div class="col-md-6">
	                            <br>
	                            <label for="listaNivelEstudio">Nivel de Estudio: <span class="required">*</span></label>
	                            <select   id="listaNivelEstudio" name="listaNivelEstudio" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Nivel Estudio...">       
						        <?php foreach($listaNivelEstudio as $item ){ ?>
						        	<option value="<?= $item->id_nivel_estudio?>"><?=$item->denom_nivel_estudio?></option>
						     	<?php } ?>
						     	</select>
	                        </div>
	                    </div>
	                    <div class="row">
	                        <div class="col-md-3">
								<br>
								<label for="listaUnidadFormuladora">Unidad Formuladora: <span class="required"></span></label>
							  	<select   id="listaUnidadFormuladora" name="listaUnidadFormuladora" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar UF...">
							  	<?php foreach($listaUnidadFormuladora as $item ){ ?>
						        	<option value="<?= $item->id_uf?>"><?=$item->nombre_uf?></option>
						     	<?php } ?>      
							  	</select>
							</div>
							<div class="col-md-3">
								<br>
								<label for="listaUnidadEjecutora">Unidad Ejecutora: <span class="required">*</span></label>
							    <select   id="listaUnidadEjecutora" name="listaUnidadEjecutora" class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar UE...">
							    <?php foreach ($listaUnidadEjecutora as $key => $value) { ?>
							    	<option value="<?=$value->id_ue?>"><?=$value->nombre_ue?></option>
							    
							    <?php } 
							    ?>
							    </select>
							</div>
	                        <div class="col-md-3">
	                            <div class=".col-xs-6 .col-md-12">
	                            <br>
	                            <label for="txtMontoInversion">Monto de Inversión: <span class="required">*</span></label>
	                            <input id="txtMontoInversion" name="txtMontoInversion"  class="form-control col-md-1 col-xs-1" required="required" type="text" placeholder="0.00" autocomplete="off">
	                            </div>
	                        </div>
							<div class="col-md-3">
								<br>
								<label for="txtCostoEstudio">Costo del Estudio: <span class="required">*</span></label>
							    <input id="txtCostoEstudio" name="txtCostoEstudio"  class="form-control col-md-1 col-xs-1" required="required" type="text" placeholder="0.00" autocomplete="off">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class=".col-xs-12 .col-md-12">
									<br>
									<label for="txtDescripcionEstudio">Descripción del Estudio de Inversión<span class="required">*</span>
									</label>
									<textarea class="form-control" rows="3" name="txtDescripcionEstudio" id="txtDescripcionEstudio" autocomplete="off"></textarea>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="ln_solid"></div>
	<div class="form-group">
		<div class="col-md-6 col-md-offset-3">
			<button type="submit" class="btn btn-success" >
				<span class="glyphicon glyphicon-floppy-disk"></span>
				Guardar
			</button>
			<button class="btn btn-danger" data-dismiss="modal">
				<span class="glyphicon glyphicon-remove"></span>
				Cancelar
			</button>
		</div>
	</div>
</form>
<script>

	$(function()
	{
		$('#frmInsertarEstudio').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				listaProyectos:
				 {
				 	validators:
				 	{
				 		notEmpty:
				 		{
				 			message: '<b style="color: red;">El campo "Proyecto PMI" es requerido.</b>'
				 		}
				 	}
				},
				txtNombreEstudioInversion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
						}
					}
				},
				listaCoordinador:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Coordinador" es requerido.</b>'
						}
					}
				},
				listaTipoEstudio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Tipo de Estudio" es requerido.</b>'
						}
					}
				},
				listaNivelEstudio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Nivel de Estudio" es requerido.</b>'
						}
					}
				},
				listaUnidadFormuladora:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad Formuladora" es requerido.</b>'
						}
					}
				},
				listaUnidadEjecutora:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Unidad Ejecutora" es requerido.</b>'
						}
					}
				},
				txtMontoInversion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Monto de Inversión" es requerido.</b>'
						},
	                    regexp:
	                    {
	                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
	                        message: '<b style="color: red;">El campo "Monto de Inversión" debe ser númerico.</b>'
	                    }
					}
				},
				txtCostoEstudio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Costo de Estudio" es requerido.</b>'
						},
	                    regexp:
	                    {
	                        regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
	                        message: '<b style="color: red;">El campo "Costo de Estudio" debe ser númerico.</b>'
	                    }
					}
				},
				txtDescripcionEstudio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
						}
					}					
				}
			}
		});

		$('.selectpicker').selectpicker({
			size: 4
		});

		$("#selectEstado").change(function()
		{
			var estado=$('#selectEstado').val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Estudio_Inversion/listaProyectoPorEstado",
				data: 
				{
					valor:estado
				},
				cache: false,
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">--Seleccione--</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].id_pi+'>'+objectJSON[item].nombre_pi+'</option>';
					}
					$('#listaProyectos').html(htmlTemp);
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error");
				}
			});
		});

	});

	

</script>

