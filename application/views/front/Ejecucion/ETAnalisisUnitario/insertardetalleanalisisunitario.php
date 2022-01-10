<style>
	.dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    top: 0;
    left: 100%;
    margin-top: -1px;
}
.dropdown:hover {
}
li
{
	list-style:none;
}
.nivel
{
	color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.471;
    margin : 2px;
}
</style>


<form  id="frmInsertarDetalleAnalisisUnitario" action="" method="POST">
	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content" >		
					<div class="row">
						<div class="col-md-6 col-sm-6 col-xs-12">
							<input type="hidden" id="idAnalisis" name="idAnalisis" class="form-control" value="<?=$idAnalisis?>">
							<input type="hidden" id="hdDescripcionInsumo" name="hdDescripcionInsumo" value="<?=$partida->desc_partida?>">							
							<label for="control-label">Buscar Insumo</label>
							<div>
								<select name="selectDescripcionDetalleAnalisis" id="selectDescripcionDetalleAnalisis" class="form-control selectpicker"></select>
							</div>
							<label for="control-label">Descripción del insumo</label>
							<div style="height: 250px;overflow-y: scroll; background-color: #f2f5f7;">
								<ul>
							    	<?php foreach ($listaNivel1 as $key => $value) 
							    	{
						    			if($value->hasChild)
						    			{?>
						    				<li>
						    					<input type="button" style="width: 25px;" class="btn btn-default btn-xs" id="btnAccion" name="Accion" value="+" onclick="elegirAccion('<?=$value->CodInsumo?>', 1, this);" style="margin: 1px;">	
								    			<span class="nivel"><?=$value->Descripcion?> <?=($value->Simbolo==null ? '' : ($value->Simbolo))?> </span>
								    		</li>
						    			<?php } else { ?>
						    				<li>
								    			<span class="nivel"><?=$value->Descripcion?></span>
								    		</li>
						    			<?php } ?>							    		
							    	<?php } ?>
							    </ul>
							</div>
						</div>
						<div class="col-md-6">
							<div id ="divFormDetallaAnalisisUnitario">
								<input type="hidden" id="hdIdEt" name="hdIdEt" readonly value="<?=$idET?>" >
								<input type="hidden" id="hdIdRecurso" name="hdIdRecurso" readonly value="<?=$partida->id_recurso?>" >
								<input type="hidden" id="hdIdPartida" name="hdIdPartida" readonly value="<?=$partida->id_partida?>" >							
								<input type="hidden" id="hdMetrado" name="hdMetrado" readonly value="<?=$partida->cantidad?>" >
								<div class="row">
									<div class="col-md-12 col-sm-2 col-xs-12">
										<input type="button" class="btn btn-warning" onclick="asignarComoInsumo();" value="Asignar Partida como Insumo">	
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-2 col-xs-12">
										<label for="control-label">Insumo:*</label>
										<div>
											<input type="text" id="txtInsumo" name="txtInsumo" autocomplete="off" class="form-control">
										</div>
									</div>								
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-2 col-xs-12">
										<label for="control-label">Cuadrilla</label>
										<div>
											<input type="text" id="txtCuadrilla" name="txtCuadrilla" autocomplete="off" class="form-control" onkeyup="">
										</div>
									</div>
									<div class="col-md-4 col-sm-1 col-xs-12">
										<label for="control-label">Horas</label>
										<div>
											<input type="text" id="txtHoras" name="txtHoras" autocomplete="off" class="form-control" onkeyup="">
										</div>
									</div>
									<div class="col-md-4 col-sm-2 col-xs-12">
										<label class="control-label">Unidad:</label>
										<div>
											<select  name="selectUnidadMedida" id="selectUnidadMedida" class="form-control selectpicker">
												<option value="">Seleccione Unidad</option>
											</select>
										</div>
										<input type="hidden" name="hdUnidad" id="hdUnidad">
									</div>									
								</div>
								<div class="row">
									<input type="hidden" id="txtRendimiento" autocomplete="off" name="txtRendimiento" class="form-control" onkeyup="" value="0">
										
									<div class="col-md-4 col-sm-2 col-xs-12">
										<label for="control-label">Cantidad*</label>
										<div>
											<input type="text" id="txtCantidad" autocomplete="off" name="txtCantidad" class="form-control" onkeyup="calcularSubTotal();">
										</div>
									</div>
									<div class="col-md-4 col-sm-3 col-xs-12">
										<label for="control-label">Precio unitario*</label>
										<div>
											<input type="text" id="txtPrecioUnitario" autocomplete="off" name="txtPrecioUnitario" class="form-control" onkeyup="calcularSubTotal();">
										</div>
									</div>										
								</div>
								<div class="row">
									<div class="col-md-4 col-sm-3 col-xs-12">
										<label for="control-label">Sub total*</label>
										<div>
											<input type="text" id="txtSubTotal" class="form-control" readonly="readonly">
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<br>
								<div class="col-md-6 col-sm-2 col-xs-12">
									<button  class="btn btn-success" onclick="guardarDetalleAnalisisPresupuestal();">Guardar</button>
									<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
								</div>	
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
</form>
<script>
$(function()
{
	$('#selectDescripcionDetalleAnalisis').selectpicker({ liveSearch: true }).ajaxSelectPicker(
	{
        ajax: {
            url: base_url+'index.php/ET_Insumo/verPorDescripcion',
            data: { valueSearch : '{{{q}}}' }
        },
        locale:
        {
        	statusInitialized : 'Escriba para buscar insumo',
            statusNoResults : 'No se encontro',
            statusSearching : 'Buscando...',
            searchPlaceholder : 'Buscar',
            emptyTitle : 'Buscar Insumo'
        },
        preprocessData: function(data)
        {
        	var dataForSelect=[];

        	for(var i=0; i<data.length; i++)
        	{
        		dataForSelect.push(
                {
                    "value" : data[i].Descripcion,
                    "text" : data[i].Descripcion,
                    "data" :
                    {
                    	"unidad" : data[i].Unidad
                    },
                    "disabled" : false
                });
        	}

            return dataForSelect;
        },
        preserveSelected: false
    });

    $('#selectDescripcionDetalleAnalisis').on('change', function()
    {
		var selected=$(this).find("option:selected").val();
		var unidad ='';
		if(selected.trim()!='')
		{
			unidad=$(this).find("option:selected").data('unidad');
			$('#txtInsumo').val(selected);
		}
		if(unidad===undefined)
		{
			$('#selectUnidadMedida').html('<option val="UNIDAD">UNIDAD</option>');	
			$('#selectUnidadMedida').selectpicker('refresh');
			$('#selectUnidadMedida').selectpicker('val', "UNIDAD");
		}
		else
		{
			$('#selectUnidadMedida').html('<option val="'+unidad+'">'+unidad+'</option>');
			$('#selectUnidadMedida').selectpicker('refresh');	
			$('#selectUnidadMedida').selectpicker('val',unidad);
		}
    });

	$('#selectUnidadMedida').selectpicker({ liveSearch: true }).ajaxSelectPicker(
	{
        ajax: {
            url: base_url+'index.php/Unidad_Medida/listaUnidadMedida',
            data: { valueSearch : '{{{q}}}' }
        },
        locale: {
            statusInitialized : 'Escriba para buscar unidad',
            statusNoResults : 'No se encontro',
            statusSearching : 'Buscando...',
            searchPlaceholder : 'Buscar',
            emptyTitle : 'Buscar Unidad'
        },
        preprocessData: function(data)
        {
        	var dataForSelect=[];
        	for(var i=0; i<data.length; i++)
        	{
        		dataForSelect.push(
                {
                    "value" : data[i].descripcion,
                    "text" : data[i].descripcion,
                    "data" :
                    {
                    	"id-unidad" : data[i].id_unidad
                    },
                    "disabled" : false
                });
        	}

            return dataForSelect;
        },
        preserveSelected: false
	});
	
	$('#selectUnidadMedida').on('change', function()
    {
		var selected=$(this).find("option:selected").val();
		if(selected.trim()!='')
		{
			$('#hdUnidad').val(selected);
		}
    });

	$('#divFormDetallaAnalisisUnitario').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
			txtInsumo:
			{
				validators:
				{				
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Insumo" es requerido.</b>'
					}
				}
			},
			txtCuadrilla:
			{
				validators:
				{
					regexp:
		            {
		                regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
		                message: '<b style="color: red;">El campo "Cuadrilla" debe ser un número entero.</b>'
		            }
				}
			},
			txtHoras:
			{
				validators:
				{				
					regexp:
		            {
		                regexp: /^\d*$/,
		                message: '<b style="color: red;">El campo "Hora" debe ser un número entero.</b>'
		            }
				}
			},
			selectUnidadMedida:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Unidad de Medida" es requerido.</b>'
					}
				}
			},
			txtCantidad:
			{
				validators:
				{				
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Cantidad" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
						message: '<b style="color: red;">El campo "Cantidad" debe ser un valor en decimales.</b>'
					}
				}
			},
			txtPrecioUnitario:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Precio unitario" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
						message: '<b style="color: red;">El campo "Precio unitario" debe ser un valor en soles.</b>'
					}
				}
			}
		}
	});
});

function calcularSubTotal()
{
	var cantidad=$('#txtCantidad').val();
	var precioUnitario=$('#txtPrecioUnitario').val();
	var subTotal=null;

	if(!isNaN(cantidad) && cantidad.trim()!='' && !isNaN(precioUnitario) && precioUnitario.trim()!='')
	{
		subTotal=cantidad*precioUnitario;

		$('#txtSubTotal').val(subTotal.toFixed(2));
	}
	else
	{
		$('#txtSubTotal').val('');
	}
}
function guardarDetalleAnalisisPresupuestal()
{
	event.preventDefault();
	$('#divFormDetallaAnalisisUnitario').data('formValidation').resetField($('#txtCantidad'));
	$('#divFormDetallaAnalisisUnitario').data('formValidation').resetField($('#txtInsumo'));
	$('#divFormDetallaAnalisisUnitario').data('formValidation').validate();
	if(!($('#divFormDetallaAnalisisUnitario').data('formValidation').isValid()))
	{
		return;
	}
	var formData=new FormData($("#frmInsertarDetalleAnalisisUnitario")[0]);
    var dataString = $('#frmInsertarDetalleAnalisisUnitario').serialize();
    $.ajax({
        type:"POST",
        url:base_url+"index.php/ET_Detalle_Analisis_Unitario/insertar",
        data: formData,
        cache: false,
        contentType:false,
        processData:false,
        success:function(resp)
        {
			resp =JSON.parse(resp);
			swal(resp.proceso, resp.mensaje, (resp.proceso=='Correcto' ? 'success' : 'error'));
			$('#otherModal2').modal('hide');
            paginaAjaxDialogo('otherModal', 'Análisis presupuestal', { idET : <?=$idET?> , idPartida : <?=$partida->id_partida?>, idPresupuesto : '2' }, base_url+'index.php/ET_Analisis_Unitario/insertar', 'GET', null, null, false, true);                   
		},
		error:function()
		{
			swal("Error","Ha ocurrido un error inesperado.", "error");
			$('#otherModal2').modal('hide');
		}
    }); 
}
function MostrarSubLista(codigoInsumo, nivel, element)
{
	var marginLeftTemp=35;
	$.ajax(
	{
		type: "POST",
		url: base_url+"index.php/ET_Analisis_Unitario/cargarNivel",
		cache: false,
		data: { codigoInsumo: codigoInsumo, nivel: nivel },
		success: function(resp)
		{
			var obj=JSON.parse(resp);

			if(obj.length==0)
			{
				return false;
			}
			var htmlTemp='<ul style="margin-left: '+marginLeftTemp+'px;">';
			for(var i=0; i<obj.length; i++)
			{
				if(obj[i].hasChild == false)
				{
					htmlTemp+='<li>'+
					'<input type="button" class="btn btn-warning btn-xs" style="width: 25px;" value="A" onclick="seleccionar(\''+replaceAll(obj[i].Descripcion,'"','*')+'\',\''+obj[i].Unidad+'\', this);" style="margin: 1px;">'+
					'<span class="nivel">'+obj[i].Descripcion+ ((obj[i].Simbolo == null) ? "" : ' ('+obj[i].Simbolo+')')+'</span>'+
					'</li>';
				}
				else
				{
					htmlTemp+='<li>'+
					'<input type="button" style="width: 25px;" class="btn btn-default btn-xs" value="+" onclick="elegirAccion(\''+obj[i].CodInsumo+'\', '+(obj[i].Nivel+1)+', this);" style="margin: 1px;">'+
					'<span class="nivel">'+obj[i].Descripcion+ ((obj[i].Simbolo == null) ? "" : ' ('+obj[i].Simbolo+')')+'</span>'+
				'</li>';
				}				
			}

			htmlTemp+='</ul>';
			$(element).parent().append(htmlTemp);        											            
		}
	});
}

function ContraerSubLista(element)
{
	$(element).parent().find('>ul').remove();
}

function seleccionar(insumo,unidad,element)
{
	var nuevoInsumo = replaceAll(insumo,'*','"');
	$('#txtInsumo').val(nuevoInsumo);
	if(unidad=='null')
	{
		$('#selectUnidadMedida').html('<option val="UNIDAD">UNIDAD</option>');		
		$('#selectUnidadMedida').selectpicker('refresh');
		$('#selectUnidadMedida').selectpicker('val', "UNIDAD");
	}
	else
	{
		$('#selectUnidadMedida').html('<option val="'+unidad+'">'+unidad+'</option>');
		$('#selectUnidadMedida').selectpicker('refresh');	
		$('#selectUnidadMedida').selectpicker('val', unidad);
	}	
}

function elegirAccion(codigoInsumo, nivel, element)
{
	var valueButton =  $(element).attr('value');
	if(valueButton == '+')
	{
		MostrarSubLista(codigoInsumo, nivel, element);
		$(element).attr('value','-');
	}
	else
	{
		ContraerSubLista(element);
		$(element).attr('value','+');
	}	
}

function asignarComoInsumo()
{
	var insumo=$('#hdDescripcionInsumo').val();
	$('#txtInsumo').val(insumo);
	$('#txtCantidad').val('1.00');
	$('#txtPrecioUnitario').val('<?=$partida->precio_unitario?>');
	$('#txtSubTotal').val('<?=$partida->precio_unitario?>');

	var unidad = '<?=$partida->descripcion?>'

	$('#selectUnidadMedida').html('<option val="'+unidad+'">'+unidad+'</option>');
	$('#selectUnidadMedida').selectpicker('refresh');	
	$('#selectUnidadMedida').selectpicker('val', unidad);
}

</script>
