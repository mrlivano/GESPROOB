
<form  id="frmValorizacion" action="<?php echo base_url();?>index.php/Expediente_Tecnico/insertar" method="POST">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_content">		
					<div class="row">
						<input name="hdIdDetallePartida" id="hdIdDetallePartida" readonly="readonly" type="hidden" value="<?=$DetallePartida->id_detalle_partida?>"> 	
						<input type="hidden" name="hdIdCantidad" id="hdIdCantidad"  autocomplete="off" value="<?=$DetallePartida->cantidad?>" readonly="readonly" >
						<input type="hidden" autocomplete="off" readonly="readonly" name="txtPrecioUnitarioDetalle" id="txtPrecioUnitarioDetalle" value="<?=$DetallePartida->precio_unitario?>" >
						<div class="col-md-12 col-sm-3 col-xs-12">
							<p style="color: #0073b7; font-size: 14px; font-weight:bold;" for="control-label">
								PARTIDA: <?=$DetallePartida->desc_partida?><br>
								Meta: <?=$DetallePartida->cantidad?><br>
								Precio Unitario: S/. <?=a_number_format($DetallePartida->precio_unitario, 2, '.',",",3)?>
							</p>									
						</div>	
					</div>	
					<div id="validarValorizacion">
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12 hidden">
							<div>
								<select name="selectEtapaValorizacion" id="selectEtapaValorizacion" class="form-control">
									<option value="valorizacion">Valorización</option>
								</select>
							</div>	
						</div>
						<div class="col-md-12 col-sm-12 col-xs-12">
							<div>
								<textarea rows="2" class="form-control" placeholder="Descripción" name="txtDescripcion" id="txtDescripcion" type="text" autocomplete="off" maxlength="500"></textarea>
							</div>	
						</div>
					</div>		
					<div class="row">
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Fecha: </label>
							<div>
								<input class="form-control" name="txtFecha" id="txtFecha" type="date" max="2050-12-31" autocomplete="off" value="<?=$fecha?>">	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Cantidad: </label>
							<div>
								<input class="form-control" placeholder="Cantidad" autocomplete="off" name="txtCantidad" id="txtCantidad">
								<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta ejecutar <span id="txtCantidadRestante"><?=$cantidadRestante?></span> en cantidad
								</label>	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">Costo: </label>
							<div>
								<input class="form-control moneda" placeholder="Costo" autocomplete="off" name="txtCosto" id="txtCosto" readonly>
								<label style="color: #f39c12; font-size: 11px;"><span class="fa fa-warning"></span> Falta ejecutar <span id="txtCantidadRestante"><?=a_number_format($costoRestante,2,'.',",",3)?></span> en costo
								</label>	
							</div>	
						</div>
						<div class="col-md-3 col-sm-6 col-xs-12">
							<label class="control-label">.</label>
							<div>
								<button style="width:100%;" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
							</div>
						</div>
					</div>
					</div>
			</div>				
		</div>
	</div>
</form>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" >
		<div class="table-responsive">
			<table id="tableListaValorizacion" style="text-align: left;" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th style="width: 5%" class="col-md-1 col-xs-12">Etapa</th>
						<th style="width: 5%" class="col-md-1 col-xs-12">Fecha</th>
						<th style="width: 30%" class="col-md-2 col-xs-12">Cantidad</th>
						<th style="width: 30%" class="col-md-2 col-xs-12">Costo</th>
						<th style="width: 30%" class="col-md-2 col-xs-12">Descripción</th>	
						<th style="width: 3%" class="col-md-2 col-xs-12">Opciones</th>						
					</tr>
				</thead>
				<tbody>
				<?php foreach ($listaValorizacion as $key => $value) { ?>
					<tr>
						<td><?=$value->etapa_valorizacion?></td>
						<td><?=(new DateTime($value->fecha_dia))->format('d-m-Y')?></td>
						<td><?=$value->cantidad?></td>
						<td><?=a_number_format($value->sub_total, 2, '.',",",3)?></td>
						<td><?=$value->descripcion?></td>
						<td><button type="button" class="btn btn-danger btn-xs" onclick="eliminar('<?=$value->id_det_seg_valorizacion?>',this);"><i class="fa fa-trash-o"></i> Eliminar</button></td>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" style="text-align: center">
		<button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cerrar</button>
	</div>	
</div>
<script>

$("#txtCantidad").keyup(function()
{
	var precioUnitario = $('#txtPrecioUnitarioDetalle').val();
	var calculo = $(this).val()*precioUnitario;
	$('#txtCosto').val(format(''+calculo+''));
});

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

$(document).ready(function()
{
	$('#tableListaValorizacion').DataTable(
	{
		"language":idioma_espanol
	});
});

$(function()
{
	$('#validarValorizacion').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
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
	                    message: '<b style="color: red;">El campo "Cantidad" debe ser un número.</b>'
					}
				}
			},
			txtFecha:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Fecha" es requerido.</b>'
					}
				}
			},
			selectEtapaValorizacion:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Etapa" es requerido.</b>'
					}
				}
			},
			txtDescripcion:
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
});

$('#btnEnviarFormulario').on('click', function(event)
{
    event.preventDefault();
    $('#validarValorizacion').data('formValidation').resetField($('#txtFecha'));
    $('#validarValorizacion').data('formValidation').resetField($('#txtCantidad'));
    $('#validarValorizacion').data('formValidation').validate();
	if(!($('#validarValorizacion').data('formValidation').isValid()))
	{
		return;
	}
	var formData=new FormData($("#frmValorizacion")[0]);
	var idDetallePartida = $('#hdIdDetallePartida').val();
	var cantidadDetallePartida = $('#hdIdCantidad').val();
    var dataString = $('#frmValorizacion').serialize();
    $.ajax({
        type:"POST",
        url:base_url+"index.php/Expediente_Tecnico/AsignarValorizacion",
        data: formData,
        cache: false,
        contentType:false,
        processData:false,
        beforeSend: function() 
        {
        	renderLoading();
	    },
        success:function(resp)
        {
			objectJson=JSON.parse(resp);

			$('#divModalCargaAjax').hide();
			
			swal(objectJson.proceso, objectJson.mensaje, (objectJson.proceso=='Correcto' ? "success" : "error"));

			$('#frmValorizacion')[0].reset();

			if(objectJson.proceso=='Correcto')
			{
				if(objectJson.acumulado==cantidadDetallePartida)
					$('#btnOpcion'+idDetallePartida).attr('class','btn btn-success btn-xs');
				if(objectJson.acumulado>cantidadDetallePartida)
					$('#btnOpcion'+idDetallePartida).attr('class','btn btn-info btn-xs');
				if(objectJson.acumulado<cantidadDetallePartida)		
					$('#btnOpcion'+idDetallePartida).attr('class','btn btn-warning btn-xs');	
			}

			$('#modalTemp').modal('hide');
        },
        error:function()
        {
			$('#divModalCargaAjax').hide();

			swal("Error","Ha ocurrido un error inesperado", "error");			
        }
    });  
});

function eliminar(codigo,element)
{
	swal(
	{
		title: "Confirmación",
		text: "Realmente desea realizar esta operación",
		type: "info",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Consentir proceso",
		cancelButtonText: "Cerrar",
		closeOnConfirm: false
	},
	function(isConfirm)
	{
		if(isConfirm)
		{
			$.ajax({
				type:"GET",
				url:base_url+"index.php/Expediente_Tecnico/eliminarValorizacionPartida",
				data: {idDetSegValorizacion : codigo},
				cache: false,
				success:function(resp)
				{
					if (resp=='1') 
					{
						swal("Correcto","El registro se eliminó correctamente", "success");
						$(element).parent().parent().remove();
					}
					else
					{
						swal("Error","Ocurrio un error ", "error");
					}
				},
				error:function()
				{
					swal("Error","Ha ocurrido un error inesperado", "error");
					window.location.href='<?=base_url();?>index.php/Expediente_Tecnico/ControlMetrado?id_et='+<?=$idExpedienteTecnico?>;
				}
			}); 
		}
	});
}
</script>

