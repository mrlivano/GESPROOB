<div id="validarMetaPi">
	<form class="form-horizontal" id="editarFrmMetaPi">
		<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<input id="hdIdMetaPi" name="hdIdMetaPi" value="<?=@$metaPi[0]->id_meta_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<input id="hdCodigoUnico" name="hdCodigoUnico" value="<?=@$proyectoInversion[0]->codigo_unico_pi?>" readonly="readonly" autocomplete="off" type="hidden">	
		<div class="row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<label class="control-label">Actividad/Acción de Inversión/obra *</label>
				<div class="form-group">
					<select class="selectpicker form-control" id="selectMeta" name="selectMeta" data-live-search="true">
						<option value="">Seleccione una opción</option>
						<?php foreach ($metaPresupuestal as $key => $value) { ?>
							<option value='<?=$value->id_meta_pres?>' <?php echo (@$metaPi[0]->id_meta_pres == $value->id_meta_pres ? "selected" : "")?>>
							<?=$value->nombre_meta_pres?></option>		      								      			
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label class="control-label">Año:</label>
				<div>
					<input type="text" value="<?=date('Y',strtotime(@$metaPi[0]->anio_meta_pres))?>" id="txtAnio" name="txtAnio" readonly autocomplete="off" class="form-control" maxlenght="4">
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-info" onclick="cargarDatosMeta();" value="Cargar Datos">
				</div>
			</div>						
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Correlativo Meta:</label>
				<div>
					<input type="text" value="<?=@$metaPi[0]->id_correlativo_meta?>" name="txtCorrelativo" class="form-control" autocomplete="off" id="txtCorrelativo" maxlength="5">
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">PIA:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->pia_meta_pres, 2, '.',",")?>" name="txtPia" id= "txtPia" autocomplete="off" class="form-control moneda" >
				</div>  
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">PIM:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->pim_acumulado, 2, '.',",")?>" name="txtPim" autocomplete="off" class="form-control moneda" id="txtPim" >
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Certificado:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->certificacion_acumulado, 2, '.',",")?>" name="txtCertificado" autocomplete="off" id= "txtCertificado" class="form-control moneda" >
				</div>  
			</div>			
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Compromiso:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->compromiso_acumulado, 2, '.',",")?>" name="txtCompromiso" autocomplete="off" class="form-control moneda" id="txtCompromiso" >
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Devengado:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->devengado_acumulado, 2, '.',",")?>" name="txtDevengado" id= "txtDevengado" class="form-control moneda" autocomplete="off" autocomplete="off">
				</div>  
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Girado:</label>
				<div>
					<input type="text" value="<?=number_format(@$metaPi[0]->girado_acumulado, 2, '.',",")?>" name="txtGirado" class="form-control moneda" id="txtGirado" autocomplete="off">
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarMetaPi();" value="Guardar">
				</div>
			</div>
		</div>
	</form>			
</div>
<div class="row" style="text-align: right;">
	<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>

<script>

	function cargarDatosMeta()
	{
		anio=$('#txtAnio').val();
		codigoUnico=$('#hdCodigoUnico').val();
		$.ajax(
		{
			url: base_url+'index.php/Meta/metaPresupuestalPi',
			type: 'POST',
			data:
			{
			anio : anio,
			codigoUnico : codigoUnico
			},
			cache: false,
			async: true
		}).done(function(objectJSON)
		{
			obj = JSON.parse(objectJSON);
			if(obj.flag!=0)
			{
				$('#txtCorrelativo').val(obj.meta);
				$('#txtPia').val(obj.presupuesto);
				$('#txtPim').val(obj.modificacion);
				$('#txtCertificado').val(obj.certificado);
				$('#txtCompromiso').val(obj.compromiso);
				$('#txtDevengado').val(obj.devengado);
				$('#txtGirado').val(obj.girado);
			}
			else
			{
				swal('', 'No se asigno meta presupuestal para el año '+anio, 'error');
				$('#txtCorrelativo').val('');
				$('#txtPia').val('');
				$('#txtPim').val('');
				$('#txtCertificado').val('');
				$('#txtCompromiso').val('');
				$('#txtDevengado').val('');
				$('#txtGirado').val('');
			}

		}).fail(function()
		{
			swal('Error', 'Error no controlado.', 'error');
		});
	}

	$(function()
	{		
		$('#validarMetaPi').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectMeta:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Actividad/Acción de Inversión/obra" es requerido.</b>'
						}
					}
				},
				txtAnio:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Año" es requerido.</b>'
						}
					}
				},
				txtPia:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "PIA" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "PIA" debe ser un valor en soles.</b>'
						}
					}
				},
				txtPim:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "PIM" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "PIM" debe ser un valor en soles.</b>'
						}
					}
				},
				txtCertificado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Certificado" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Certificado" debe ser un valor en soles.</b>'
						}
					}
				},
				txtCompromiso:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Compromiso" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Compromiso" debe ser un valor en soles.</b>'
						}
					}
				},
				txtDevengado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Devengado" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Devengado" debe ser un valor en soles.</b>'
						}
					}
				},
				txtGirado:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Girado" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Girado" debe ser un valor en soles.</b>'
						}
					}
				}
			}
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

	function guardarMetaPi()
	{
		event.preventDefault();
        $('#validarMetaPi').data('formValidation').validate();
		if(!($('#validarMetaPi').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#editarFrmMetaPi")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_MetaPresupuestalPi/editar",
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
				$('#divModalCargaAjax').hide();	
				$('#modaltemporal').modal('hide');
				$('#tablaMetaPresupuestal').dataTable()._fnAjaxUpdate();
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






