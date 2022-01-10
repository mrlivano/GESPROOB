<div id="validarRubroPi">
	<form class="form-horizontal" id="frmRubroPi">
		<input id="hdIdPI" name="hdIdPI" value="<?=@$proyectoInversion[0]->id_pi?>" readonly="readonly" autocomplete="off"  type="hidden">	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label">Proyecto*</label>
				<div>
					<textarea rows="3" class="form-control" readonly style="resize: none;resize: vertical;"><?=html_escape(trim(@$proyectoInversion[0]->nombre_pi))?></textarea>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-sm-3 col-xs-12">
				<label class="control-label">Rubro*</label>
				<div class="form-group">
					<select class="selectpicker form-control" id="selectRubro" name="selectRubro" data-live-search="true">
						<option value="">Seleccione una opción</option>
						<?php foreach ($rubro as $key => $value) { ?>
							<option value='<?=$value->id_rubro?>' >
							<?=$value->nombre_rubro?></option>		      								      			
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Monto*</label>
				<div>
					<input id="txtMonto" name="txtMonto" class="form-control moneda" autocomplete="off" maxlength="40" >
				</div>
			</div>	
			<div class="col-md-3 col-sm-3 col-xs-12">
				<label class="control-label">Fecha:</label>
				<div>
					<input type="date" id="txtFecha" name="txtFecha" class="form-control">
				</div>
			</div>
			<div class="col-md-2 col-sm-3 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarRubroPi();" value="Guardar">
				</div>
			</div>						
		</div>
	</form>
	<div class="ln_solid"></div>
	<div class="table-responsive">
		<table id="tablaRubro" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
			<thead>
				<tr>
					<th>Rubro</th>
					<th>Monto</th>
					<th>Fecha</th>
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
	$(function()
	{
		listarRubroPI($('#hdIdPI').val());
		
		$('#validarRubroPi').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				selectRubro:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Rubro" es requerido.</b>'
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
				txtMonto:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Monto" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Monto" debe ser un valor en soles.</b>'
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

	function listarRubroPI(id_pi) 
	{
		var table = $("#tablaRubro").DataTable({
			"processing": true,
			"serverSide": false,
			destroy: true,
			"ajax": 
			{
				url: base_url + "index.php/PMI_RubroPi/ListaRubroProyecto",
				type: "POST",
				data: 
				{
					id_pi: id_pi
				}
			},
			"columns": 
			[
				{
					"data": "nombre_rubro"
				},
				{
					"data": "monto"
				},
				{
					"data": "fecha_rubro_pi"
				},
				{
				"data": 'id_rubro_pi',
					render: function(data, type, row)
					{
						return "<button type='button' class='btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarrubroPI(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
					}
				}
			],
			"language": idioma_espanol
		});
	}

	function eliminarrubroPI(id_rubro_pi, element) 
	{
		swal({
			title: "Se eliminará el Rubro. ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"id_rubro_pi": id_rubro_pi
			}, base_url + 'index.php/PMI_RubroPi/eliminar', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaRubro').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}

	function guardarRubroPi()
	{
		event.preventDefault();
        $('#validarRubroPi').data('formValidation').validate();
		if(!($('#validarRubroPi').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmRubroPi")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_RubroPi/insertar",
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
				$('#tablaRubro').dataTable()._fnAjaxUpdate();
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		}); 
	}
</script>






