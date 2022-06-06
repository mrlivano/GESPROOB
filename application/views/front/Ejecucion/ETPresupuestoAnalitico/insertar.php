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
	<div class="row">
		<div class="col-md-3 col-sm-3 col-xs-3">
			<label class="control-label">Presupuesto Ejecución</label>
			<div>
				<select id="selectPresupuestoEjecucion" name="selectPresupuestoEjecucion" class="form-control">
					<?php foreach ($PresupuestoEjecucionListar as $key => $value) { if ((strpos($value->desc_presupuesto_ej, $expedienteTecnico->modalidad_ejecucion_et) !== false)||($expedienteTecnico->modalidad_ejecucion_et=="MIXTO")){						
						if(count($value->childPresupuesto)>0)
						{	?>
							<optgroup label="<?=$value->desc_presupuesto_ej?>">
							<?php foreach ($value->childPresupuesto as $key => $item) { ?>
								<option value="<?=$item->id_presupuesto_ej?>"><?=$item->desc_presupuesto_ej?></option>
							<?php } ?>
							</optgroup>
						</tr>
						<?php }
						else { ?>
							<option value="<?=$value->id_presupuesto_ej?>"><?=$value->desc_presupuesto_ej?></option>
						<?php }
					} }?>
				</select>

			</div>
		</div>
		<div class="col-md-5 col-sm-5 col-xs-5" id="divPresupuestoAnalitico">
			<input type="hidden"  id="hdIdClasificador" name="hdIdClasificador" notValidate>
			<label class="control-label">Clasificador</label>
			<div>
				<select name="selectClasificador" id="selectClasificador" class="form-control selectpicker">
					<option value="">Buscar Clasificador</option>
				</select>
			</div>
			<label><b id="msgError" style="color: red; font-size: 9px; display: none;">El campo "Clasificador" es requerido.</b></label>
		</div>	
		<div id="divAgregarComponente" style="margin-top: 23px;">
			<div class="col-md-4 col-sm-4 col-xs-4">
				<input type="button" class="btn btn-info" value="Agregar Presupuesto Analítico " onclick="agregarPresupuestoAnalitico();" style="width: 100%;">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12" style="height:300px;overflow:scroll;overflow-x: hidden;text-align: left; ">
			<table class="table table-bordered" id="table_clasificador">
				<thead>
					<tr>
						<th>PRESUPUESTO DE EJECUCIÓN</th>
						<th>CLASIF.</th>
						<th>DESCRIPCIÓN</th>
						<th></th>
					</tr>
				</thead>
				<tbody id="bodyClasificador">
					<?php foreach ($PresupuestoEjecucionListar as $key => $value) {?>
						<tr id="trPresupuestoEjecucion<?=$value->id_presupuesto_ej?>">
							<td style="background-color: #f1f1f1;color:#3f5367;" colspan="4">
								<?=$value->desc_presupuesto_ej?>								
							</td>
							<?php if(count($value->childPresupuesto)==0) 
							{							
								foreach ($value->ChilpresupuestoAnalitico as $key => $temp) { ?>
									<tr>
										<td></td>
										<td><?= $temp->num_clasificador?></td>
										<td><?= $temp->desc_clasificador?></td>
										<td>
											<button onclick="EliminarPresClasiAnalitico(<?=$temp->id_analitico?>,this);" data-toggle="tooltip" data-original-title="Eliminar Analitico"   class='btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button>
										</td>
									</tr>							 	
								<?php } 							 	
							}?>
							<?php if(count($value->childPresupuesto)>0) { 
								foreach ($value->childPresupuesto as $key => $item) { ?>
									<tr id="trPresupuestoEjecucion<?=$item->id_presupuesto_ej?>">
										<td colspan="4"><?=$item->desc_presupuesto_ej?></td>
										<?php foreach ($item->ChilpresupuestoAnalitico as $key => $temp2) { ?>
											<tr>
												<td></td>
												<td><?= $temp2->num_clasificador?></td>
												<td><?= $temp2->desc_clasificador?></td>
												<td>
													<button onclick="EliminarPresClasiAnalitico(<?=$temp2->id_analitico?>,this);" data-toggle="tooltip" data-original-title="Eliminar Analitico"   class='btn btn-danger btn-xs'><i class="fa fa-trash-o"></i></button>
												</td>
											</tr>							 	
										<?php } ?>
									</tr>
								<?php }
							} ?>
						</tr>						
					<?php } ?>
				</tbody>
			</table>		
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

	function agregarPresupuestoAnalitico()
	{
		if ($('#selectClasificador').val()=="")
		{
			$( "#msgError").css( "display", "block" );
			return;
		}
		$( "#msgError").css( "display", "none" );
		var idClasificador=$("#hdIdClasificador").val();
		var hd_id_et=$('#hd_et').val();
		var idPresupuestoEjecucion=$("#selectPresupuestoEjecucion").val();
		$.ajax({ 
			url:base_url+"index.php/ET_Presupuesto_Analitico/insertar",
			type:"POST",
			data:{idClasificador:idClasificador,hd_id_et:hd_id_et,idPresupuestoEjecucion:idPresupuestoEjecucion},
			success:function(respuesta)
            {
            	respuesta=JSON.parse(respuesta);
            	if(respuesta.proceso=='Error')
            	{
            		swal('',respuesta.mensaje,'error')
            	}
            	else
            	{
            		var html;
            		html='<tr><td></td>';
            		html+='<td>'+respuesta.num_clasificador+'</td>';
            		html+='<td>'+respuesta.desc_clasificador+'</td>';
            		html+='<td><button onclick="EliminarPresClasiAnalitico('+respuesta.idAnalitico+',this);" data-toggle="tooltip" data-original-title="Eliminar Analitico" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></button></td></tr>';
            		$('#trPresupuestoEjecucion'+idPresupuestoEjecucion).after(html);
            		swal(respuesta.proceso, respuesta.mensaje, "success");
                }
            }
        });
	}

	function EliminarPresClasiAnalitico(idClasiAnalitico, element)
    {
        swal({
            title: "Se eliminará el presupuesto analítico. ¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CERRAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "idClasiAnalitico" : idClasiAnalitico}, base_url+'index.php/ET_Presupuesto_Analitico/eliminar', 'POST', null, function(objectJSON)
            {
                objectJSON=JSON.parse(objectJSON);

                swal(
                {
                    title: '',
                    text: objectJSON.mensaje,
                    type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
                },
                function(){});
                if(objectJSON.proceso=='Error')
                {
                    return false;
                }
                if(objectJSON.proceso=='Correcto')
                {
                    $(element).parent().parent().remove();
                }

            }, false, true);
        });
    }
    $(function()
	{
		$('#selectClasificador').selectpicker({ liveSearch: true }).ajaxSelectPicker(
		{
	        ajax: {
	            url: base_url+'index.php/ET_Clasificador/BuscarDetalleClasificador',
	            data: { valueSearch : '{{{q}}}' }
	        },
	        locale:
	        {
	            statusInitialized : 'Escriba para buscar Clasificador',
	            statusNoResults : 'No se encontro',
	            statusSearching : 'Buscando...',
	            searchPlaceholder : 'Buscar',
	            emptyTitle:'Seleccionar y comienze a escribir',
	            errorText:'No se han podido recuperar los resultados'

	        },
	        preprocessData: function(data)
	        {
	        	var dataForSelect=[];
	        	for(var i=0; i<data.length; i++)
	        	{
	        		
	        		dataForSelect.push(
	                {
	                    "value" : data[i].num_clasificador,
	                    "text" : data[i].num_clasificador,
	                    "data" :
	                    {
	                    	"id_clasificador" : data[i].id_clasificador
	                    },
	                    "disabled" : false
	                });
	        	}

	            return dataForSelect;
	        },
	        preserveSelected: false
	    });

		$('#selectClasificador').on('change', function()
		{
			var selected=$(this).find("option:selected").val();

			if(selected.trim()!='')
			{
				$('#hdIdClasificador').val($(this).find("option:selected").data('id_clasificador'));
			}
		});

		$('#divPresupuestoAnalitico').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectClasificador:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Clasificador" es requerido.</b>'
						}
					}
				}
			}
		});		
	});
</script>

