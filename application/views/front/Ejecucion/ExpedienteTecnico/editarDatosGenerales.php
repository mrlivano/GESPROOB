
<style>
	.row
	{
		margin-top: 4px;
	}
	.borderBudget
	{
		border: 1px solid #E6E9ED;
		padding-bottom: 12px;
	}
</style>

<form class="form-horizontal" id="form-EditarExpedienteTecnico" action="<?php echo base_url();?>index.php/Expediente_Tecnico/editarDatosGenerales" method="POST" enctype="multipart/form-data" >

	<div class="row">

		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">

				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">ENTIDAD</label>
							<div>
								<input id="hdIdExpediente" name="hdIdExpediente" value="<?= $ExpedienteTecnicoM->id_et?>" class="form-control col-md-4 col-xs-12" placeholder="" autocomplete="off"  type="hidden">
								<input id="hdIdDatosGenerales" name="hdIdDatosGenerales" value="<?= $ExpedienteTecnicoM->id_datosg?>" class="form-control col-md-4 col-xs-12" placeholder="" autocomplete="off"  type="hidden">	
								<input id="txtNombreUe" readonly name="txtNombreUe" value="<?= $ExpedienteTecnicoM->entidad?>" class="form-control col-md-4 col-xs-12"  placeholder="Nombre de la unidad ejecutora" autocomplete="off" maxlength="200">	
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">NOMBRE DE LA OBRA</label>
							<div>
								<textarea name="txtProyecto" readonly id="txtProyecto" rows="3" class="form-control" style="resize: none;resize: vertical;"><?=html_escape(trim($ExpedienteTecnicoM->proyecto))?></textarea>
							</div>
						</div>
					</div>

					<div class="row">
						<div class=" col-md-12 col-sm-12 col-xs-12">
					  		<label class="control-label">MODALIDAD DE LA EJECUCION</label>
					    	<div >
									<input id="txtModalidadEjecucion" name="txtModalidadEjecucion" value="POR CONTRATA" class="form-control col-md-4 col-xs-12"  disabled>
					    	</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">UBICACIÓN</label>
							<div>
								<input id="txtUbicacionUE" readonly name="txtUbicacionUE" value="<?= $ExpedienteTecnicoM->ubicacion?>" class="form-control col-md-4 col-xs-12"  placeholder="Ubicación"  autocomplete="off" maxlength="200" >	
							</div>	
						</div>
					</div>


					<div class="row">
						<div class="col-md-4 col-sm-12 col-xs-12">
                <label class="control-label">FECHA DE INICIO DE OBRA:</label>
                <input class="form-control col-md-4 col-xs-12" type="date" max="2200-12-31" name="txtFechaInicio" value="<?=$ExpedienteTecnicoM->fecha_inicio?>" id="txtFechaInicio" Validate>
            </div>
						<div class="col-md-4 col-sm-12 col-xs-12">
                <label class="control-label">FECHA DE FINALIZACIÓN DE OBRA:</label>
                <input class="form-control col-md-4 col-xs-12" type="date" max="2200-12-31" name="txtFechaFin" value="<?=$ExpedienteTecnicoM->fecha_fin?>" id="txtFechaFin" Validate>
								<p style="color: red; display: none;" id="Advertencia">La Fecha de Inicio no puede ser mayor a la Fecha de Fin</p>
            </div>
						<div class=" col-md-4 col-sm-6 col-xs-12">
					  		<label class="control-label">TIEMPO DE EJECUCIÓN</label>
					    	<div class="form-group" >
									<input type="text" id="txtTotalMeses" name="txtTotalMeses" value="<?=$ExpedienteTecnicoM->tiempo?>" class="form-control col-md-4 col-xs-12" readonly="readonly">
					    	</div>
					  </div>
					</div>
					<BR>
					<div>

					<?php 
						$cd=0;
						$ci=0;
						?>
						<?php if($MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION INDIRECTA' || $MostraExpedienteTecnicoExpe->modalidad_ejecucion_et=='ADMINISTRACION MIXTA'){?>
						<table style="width: 100%;" class="table table-bordered table-striped">
							<tbody>
								<tr>
								<th style="width: 10%;text-decoration: underline;background-color:#959494;color:white;"><b>COSTO DIRECTO</b></th>
								<td style="width: 15%;text-align: right;background-color:#959494;color:white;"><b>S/. <?=a_number_format($MostraExpedienteTecnicoExpe->costoDirectoIndirecta, 2, '.',",",3)?></b></td>
							</tr>
							<?php foreach($MostraExpedienteTecnicoExpe->piePresupuestoIndirecta as $key => $value) { ?>
								<tr>
									<th style="width: 85%; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;': ($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>"><b><?=strtoupper(html_escape($value->descripcion))?></b></th>
									<td style="width: 15%;text-align: right; <?= ($value->id_presupuesto_ej=='' && $value->descripcion=='PRESUPUESTO TOTAL')?'background-color:#959494;color:white;':($value->id_presupuesto_ej==''?'background-color:#e6e6e6;':'')?>">S/. <?=a_number_format($value->monto, 2, '.',",",3)?></td>
							
								</tr>				
							<?php } ?>
						</table>
						<?php } ?>

					</div>				
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">CONTRATISTA</label>
							<div>
								<input id="txtContratista"  name="txtContratista" value="<?=$ExpedienteTecnicoM->contratista?>" class="form-control col-md-4 col-xs-12"  placeholder="Contratista"  autocomplete="off" maxlength="200" >	
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">SUPERVISOR</label>
							<div>
								<input id="txtSupervisor"  name="txtSupervisor" value="<?=$ExpedienteTecnicoM->supervisor?>" class="form-control col-md-4 col-xs-12"  placeholder="Supervisor"  autocomplete="off" maxlength="200" >	
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">RESIDENTE</label>
							<div>
								<input id="txtResidente"  name="txtResidente" value="<?=$ExpedienteTecnicoM->residente?>" class="form-control col-md-4 col-xs-12"  placeholder="Residente"  autocomplete="off" maxlength="200" >	
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-sm-12 col-xs-12">
               			 <label class="control-label">AVANCE FÍSICO:</label>
                		<input class="form-control col-md-4 col-xs-12" type="text" name="txtAvanceFisico" value="<?=$ExpedienteTecnicoM->avance_fisico?>" id="txtAvanceFisico" Validate>
            		</div>
						
					<div class="col-md-4 col-sm-12 col-xs-12">
                		<label class="control-label">AVANCE FINANCIERO EJECUTADO:</label>
                		<input class="form-control col-md-4 col-xs-12 moneda" type="text" name="txtAvanceFinanciero" value="<?=$ExpedienteTecnicoM->avance_financiero?>" id="txtAvanceFinanciero" Validate>
           			 </div>
					<div class=" col-md-4 col-sm-6 col-xs-12">
					  	<label class="control-label">ESTADO DE LA OBRA</label>
					    <div class="form-group" >
						<select id="estado" name="estado" class="form-control">
						<option value="">Seleccione estado</option>
							<option value="EJECUCIÓN" <?=($ExpedienteTecnicoM->estado_obra == 'EJECUCIÓN' ? 'selected' : '')?>>EJECUCIÓN</option>
							<option value="FINALIZADO" <?=($ExpedienteTecnicoM->estado_obra == 'FINALIZADO' ? 'selected' : '')?>>FINALIZADO</option>
							<option value="PARALIZADO" <?=($ExpedienteTecnicoM->estado_obra == 'PARALIZADO' ? 'selected' : '')?>>PARALIZADO</option>
						</select>
					    </div>
					  </div>
					</div>
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
					  		<label class="control-label">MONTO DE CONTRATO EN S/ </label>
					    	<div >
							<input id="txtPresupuestoTotal" name="txtPresupuestoTotal" value="<?=$ExpedienteTecnicoM->monto_contrato?>" class="form-control col-md-4 col-xs-12 moneda"  readonly>
							</div>	
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div class="ln_solid"></div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
	  
$(function()
{
	$('#form-EditarExpedienteTecnico').formValidation(
	{
		framework: 'bootstrap',
		excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
		live: 'enabled',
		message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
		trigger: null,
		fields:
		{
			txtNombreUe:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Nombre Unidad Ejecutora." es requerido.</b>'
					}
				}
			},
			txtDireccionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Dirección de unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtUbicacionUE:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Ubicacion unidad ejecutora" es requerido.</b>'
					}
				}
			},
			txtCodigoUnico:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Codigo" es requerido.</b>'
					}
				}
			},
			txtProyecto:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Proyecto" es requerido.</b>'
					} 
				}
			},	
			txtContratista:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Contratista" es requerido.</b>'
					} 
				}
			},	
	
			txtAvanceFinanciero:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Avance Financiero" es requerido.</b>'
					},
					regexp:
					{
						regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
						message: '<b style="color: red;">El campo "Avance Financiero" debe ser un monto válido.</b>'
					}
				}
			},
			txtAvanceFisico:
			{
				validators:
				{
					notEmpty:
					{
						message: '<b style="color: red;">El campo "Avance Físico" es requerido.</b>'
					},
					regexp:
					{
						regexp: /^(0*100{1,1}\.?((?<=\.)0*)?%?$)|(^0*\d{0,2}\.?((?<=\.)\d*)?%?)$/,
						message: '<b style="color: red;">El campo "Avance Físico" debe ser un porcentaje válido.</b>'
					} 
				}
			}			
		}
	});

	listaResponsableEjecucion($('#hdIdExpediente').val());
	// $('#txtCostoTotalInversionADMINISTRACIONDIRECTA').val("<?=$cd?>");
	// $('#txtCostoTotalInversionADMINISTRACIONINDIRECTA').val("<?=$ci?>");
});

$(document).ready(function() {
		$('input[type="date"]').change(function() {
			var fecha1 = $('#txtFechaInicio').val();
			var fecha2 = $('#txtFechaFin').val();
			if ((Date.parse(fecha1)) > (Date.parse(fecha2))) {
				$('#Advertencia').css('display', 'block');
				$('#txtTotalMeses').val("");
			} else {
				$('#Advertencia').css('display', 'none');
				$.ajax({
					url: base_url + "index.php/Expediente_Tecnico/CalcularNumeroMeses",
					type: 'POST',
					data: {
						txtFecha1: fecha1,
						txtFecha2: fecha2
					},
					cache: false,
					async: true
				}).done(function(objectJSON) {
					objectJSON = JSON.parse(objectJSON);
					$('#txtTotalMeses').val(objectJSON.numerodemeses + " Meses");

				}).fail(function() {
					swal('Error', 'Error no controlado.', 'error');
				});
			}
		});
	});

	function EliminarImagen(id_img,id_et)
	{	
		event.preventDefault();
		swal({
			title: "Está seguro que desea eliminar la imagen del expediente técnico ?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText:"CERRAR" ,
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,ELIMINAR",
			closeOnConfirm: false
		},
		function()
		{
			$.ajax({
				url:base_url+"index.php/ET_Img/eliminar",
				type:"POST",
				data:{id_img:id_img,id_et:id_et},
				dataType:'JSON',
				success:function(respuesta)
				{                        	
					swal("ELIMINADO!", "Se elimino correctamente la imagen del expediente técnico.", "success");
					
					$('#divShowImage'+id_img).remove();
				}
			});
		});
	}

	$('#btnEnviarFormulario').on('click', function(event)
   	{
        var resolucion=$("#Documento_Resolucion").val(); 
        var url = resolucion.split('.').pop();
        $("#Editurl").val(url);
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

	$('.selectpicker').selectpicker({
	});


function valideKey(evt){
			
			// code is the decimal ASCII representation of the pressed key.
			var code = (evt.which) ? evt.which : evt.keyCode;
			
			if(code==46) { // backspace.
			  return true;
			} else if(code>=48 && code<=57) { // is a number.
			  return true;
			} else{ // other keys.
			  return false;
			}
		}

		function insertarResponsableElaboracion(id_et)
{
    paginaAjaxDialogo('otherModalResponsableElaboracion', 'Agregar Responsables de Elaboración', {id_et:id_et}, base_url+'index.php/Expediente_Tecnico/insertarResponsableElaboracion', 'GET', null, null, false, true);
}

function insertarResponsableEjecucion(id_et)
{
    paginaAjaxDialogo('otherModalResponsableEjecucion', 'Agregar Responsables de Ejecución', {id_et:id_et, modalidad:2}, base_url+'index.php/Expediente_Tecnico/insertarResponsableEjecucion', 'GET', null, null, false, true);
}

function listaResponsableEjecucion(id_et) 
	{
		var table=$("#tablaResponsableEjecucion").DataTable({
			"processing": true,
			"serverSide":false,
			destroy:true,
			"ajax":{
				url:base_url+"index.php/Expediente_Tecnico/listarResponsableEjecucionAI",
				type:"POST",
				data :{id_et:id_et}
			},
			"columns":
			[
				{"data":"nombres"},
				{"data":"desc_cargo"},
				{"data":"id_responsable_et",
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarResponsableEjecucion(" + data + ",this)><i class='fa fa-trash-o'></i></button>"; 
					}
				}
			],
			"language":idioma_espanol
		});
	}

	function eliminarResponsableEjecucion(id_responsable_et, element) 
	{
		swal({
			title: "Se eliminará responsable de elaboración. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"id_responsable_et": id_responsable_et
			}, base_url + 'index.php/Expediente_Tecnico/eliminarResponsableElaboracion', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaResponsableEjecucion').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}
</script>







