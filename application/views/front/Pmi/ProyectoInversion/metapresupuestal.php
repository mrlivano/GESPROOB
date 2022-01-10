<div id="validarMetaPresupuestalPI">
	<form class="form-horizontal" id="frmMetaPresupuestalPi">
		<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<input id="hdCodigoUnico" name="hdCodigoUnico" value="<?=@$proyectoInversion[0]->codigo_unico_pi?>" readonly="readonly" autocomplete="off" type="hidden">	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label">Proyecto*</label>
				<div>
					<textarea rows="3" class="form-control" readonly style="resize: none;resize: vertical;"><?=html_escape(trim(@$proyectoInversion[0]->nombre_pi))?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-sm-12 col-xs-12">
				<label class="control-label">Actividad/Acción de Inversión/obra *</label>
				<div class="form-group">
					<select class="selectpicker form-control" id="selectMetaPresupuestal" name="selectMetaPresupuestal" data-live-search="true">
						<option value="">Seleccione una opción</option>
						<?php foreach ($metaPresupuestal as $key => $value) { ?>
							<option value='<?=$value->id_meta_pres?>' >
							<?=$value->nombre_meta_pres?></option>		      								      			
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label class="control-label">Año:</label>
				<div>
					<input type="text" value="<?=date('Y')?>" id="txtAnio" name="txtAnio" autocomplete="off" class="form-control" maxlenght="4">
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-info" onclick="cargarMetaSiaf();" value="Cargar Datos">
				</div>
			</div>						
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Correlativo Meta:</label>
				<div>
					<input type="text" name="cbx_Meta" class="form-control" autocomplete="off" id="cbx_Meta" maxlength="5">
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">PIA:</label>
				<div>
					<input type="text" name="txt_pia" id= "txt_pia" autocomplete="off" class="form-control moneda" >
				</div>  
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">PIM:</label>
				<div>
					<input type="text" name="txt_pim" autocomplete="off" class="form-control moneda" id="txt_pim" >
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Certificado:</label>
				<div>
					<input type="text" name="txt_certificado" autocomplete="off" id= "txt_certificado" class="form-control moneda" >
				</div>  
			</div>			
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Compromiso:</label>
				<div>
					<input type="text" name="txt_compromiso" autocomplete="off" class="form-control moneda" id="txt_compromiso" >
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Devengado:</label>
				<div>
					<input type="text" name="txt_devengado" id= "txt_devengado" class="form-control moneda" autocomplete="off" autocomplete="off">
				</div>  
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Girado:</label>
				<div>
					<input type="text" name="txt_girado" class="form-control moneda" id="txt_girado" autocomplete="off">
				</div>
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label>.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarMetaPresupuestal();" value="Guardar">
				</div>
			</div>
		</div>
	</form>
	<div class="ln_solid"></div>
	<div class="table-responsive">
		<table id="tablaMetaPresupuestal" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
			<thead>
				<tr>
					<th>Año</th>
					<th>PIA</th>
					<th>PIM</th>
					<th>Certificación</th>
					<th>Compromiso</th>
					<th>Devengado</th>
					<th>Girado</th>
					<th>Opción</th>
				</tr>
			</thead>
		</table>
	</div>				
</div>
<div class="row" style="text-align: right;">
	<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>

<script>
	function cargarMetaSiaf()
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
				$('#cbx_Meta').val(obj.meta);
				$('#txt_pia').val(obj.presupuesto);
				$('#txt_pim').val(obj.modificacion);
				$('#txt_certificado').val(obj.certificado);
				$('#txt_compromiso').val(obj.compromiso);
				$('#txt_devengado').val(obj.devengado);
				$('#txt_girado').val(obj.girado);
			}
			else
			{
				swal('', 'No se asigno meta presupuestal para el año '+anio, 'error');
				$('#cbx_Meta').val('');
				$('#txt_pia').val('');
				$('#txt_pim').val('');
				$('#txt_certificado').val('');
				$('#txt_compromiso').val('');
				$('#txt_devengado').val('');
				$('#txt_girado').val('');
			}

		}).fail(function()
		{
			swal('Error', 'Error no controlado.', 'error');
		});
	}

	$(function()
	{
		listaMetaPresupuestalPi($('#hdIdPI').val());
		
		$('#validarMetaPresupuestalPI').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectMetaPresupuestal:
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
				txt_pia:
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
				txt_pim:
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
				txt_certificado:
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
				txt_compromiso:
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
				txt_devengado:
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
				txt_girado:
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

	function listaMetaPresupuestalPi(id_pi) 
	{
		var table=$("#tablaMetaPresupuestal").DataTable({
			"processing": true,
			"serverSide":false,
			destroy:true,
			"ajax":{
				url:base_url+"index.php/programar_nopip/listar_metas_pi",
				type:"POST",
				data :{id_pi:id_pi}
			},
			"columns":
			[
				{"data":"anio"},
				{"data":"pia_meta_pres"},
				{"data":"pim_acumulado"},
				{"data":"certificacion_acumulado"},
				{"data":"compromiso_acumulado"},
				{"data":"devengado_acumulado"},
				{"data":"girado_acumulado"},
				{"data":"id_meta_pi",
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarMetaPresupuestalPi(" + data + ",this)><i class='fa fa-trash-o'></i></button><button type='button' class='btn btn-info btn-xs' onclick=editarMetaPresupuestalPi(" + data + ")><i class='fa fa-edit'></i></button>";
					}
				}
			],
			"language":idioma_espanol
		});
	}

	function eliminarMetaPresupuestalPi(idMetaPresupuestal, element) 
	{
		swal({
			title: "Se eliminará la Meta Presupuestal. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"idMetaPresupuestal": idMetaPresupuestal
			}, base_url + 'index.php/PMI_MetaPresupuestalPi/eliminar', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaMetaPresupuestal').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}

	function editarMetaPresupuestalPi(idMetaPresupuestal)
	{
		paginaAjaxDialogo('modaltemporal', 'Editar Meta Presupuestal',{ idMetaPresupuestal: idMetaPresupuestal}, base_url+'index.php/PMI_MetaPresupuestalPi/editar', 'GET', null, null, false, true);
	}

	function guardarMetaPresupuestal()
	{
		event.preventDefault();
        $('#validarMetaPresupuestalPI').data('formValidation').validate();
		if(!($('#validarMetaPresupuestalPI').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmMetaPresupuestalPi")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_MetaPresupuestalPi/insertar",
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
				$('#tablaMetaPresupuestal').dataTable()._fnAjaxUpdate();
				$('#cbx_Meta').val('');
				$('#txt_pia').val('');
				$('#txt_pim').val('');
				$('#txt_certificado').val('');
				$('#txt_compromiso').val('');
				$('#txt_devengado').val('');
				$('#txt_girado').val('');
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






