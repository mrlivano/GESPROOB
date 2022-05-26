<div id="validarAddOperacionMantenimiento">
	<form class="form-horizontal" id="frmOperacionMantenimiento" enctype="multipart/form-data">
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
			<div class="col-md-2 col-sm-6 col-xs-12">
				<label>Monto Operación</label>
				<input  class="form-control moneda" autocomplete="off" id="txt_monto_operacion" name="txt_monto_operacion" type="text">
			</div>
			<div class="col-md-5 col-sm-6 col-xs-12">
				<label>Responsable Operación</label>
				<input type="text" class="form-control" autocomplete="off" id="txt_responsable_operacion" name="txt_responsable_operacion" >
			</div>
			<div class="col-md-3 col-sm-6 col-xs-12">
				<label for="name">Fecha <span class="required"></span></label>
				<input type="date" max="2050-12-31" id="dateFechaIniC" name="dateFechaIniC" class="form-control" required="required" type="text" value="<?php echo date("Y-m-d"); ?>" class="notValidate" disabled="true">
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 col-sm-6 col-xs-12">
				<label>Monto Mantenimiento</label>
				<input class="form-control moneda" id="txt_monto_mantenimiento" name="txt_monto_mantenimiento" autocomplete="off" type="text">
			</div>
			<div class="col-md-5 col-sm-6 col-xs-12">
				<label>Responsable Mantenimiento</label>
				<input type="text" class="form-control" id="txt_responsable_mantenimiento" name="txt_responsable_mantenimiento" autocomplete="off">
			</div>
			<div class="col-md-5 col-sm-6 col-xs-12">
				<label>Acta de Compromiso:</label>
				<input type="file" class="form-control" id="fileActaCompromiso" name="fileActaCompromiso" autocomplete="off">
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 col-sm-2 col-xs-12">
				<label class="control-label">.</label>
				<div>
					<input style="width:100%" type="button" class="btn btn-success" onclick="guardarOperacionMantenimiento();" value="Guardar">
				</div>
			</div>						
		</div>
	</form>
	<div class="ln_solid"></div>
	<div class="table-responsive">
		<table id="tablaOperacion" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
			<thead>
				<tr>
					<th> Monto Operación</th>
					<th> Responsable Operación</th>
					<th> Monto Mantenimiento</th>
					<th> Responsable Mantenimiento</th>
					<th> Acta de Compromiso</th>
					<th> Fecha Registro</th>
					<th> Opción</th>
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
		listaOperacionMantenimiento($('#hdIdPI').val());
		
		$('#validarAddOperacionMantenimiento').formValidation({
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúreseeee que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txt_monto_operacion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Monto de Operación" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Monto de Operación" debe ser númerico.</b>'
						}
					}
				},
				txt_responsable_operacion:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Responsable de Operación" es requerido.</b>'
						}
					}
				},
				txt_monto_mantenimiento:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Monto de Mantenimiento" es requerido.</b>'
						},
						regexp:
						{
							regexp: /(((\d{1,3},)(\d{3},)*\d{3})|(\d{1,3}))\.?\d{1,2}?$/,
							message: '<b style="color: red;">El campo "Monto de Mantenimiento" debe ser númerico.</b>'
						}
					}
				},
				txt_responsable_mantenimiento:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Responsable de Mantenimiento" es requerido.</b>'
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

	function listaOperacionMantenimiento(id_pi) 
	{
		var table = $("#tablaOperacion").DataTable({
			"processing": true,
			"serverSide": false,
			destroy: true,
			"ajax": 
			{
				url: base_url + "index.php/PMI_OperacionMantenimientoPi/ListaOperacionMantenimiento",
				type: "POST",
				data: 
				{
					id_pi: id_pi
				}
			},
			"columns": 
			[
				{"data": "monto_operacion"},
				{"data": "responsable_operacion"},
				{"data": "monto_mantenimiento"},
				{"data": "responsable_mantenimiento"},
				{"data": "fecha_registro"},
				{"data": "urlArchivo",
					render: function(data, type, row) 
					{
						if (data == null || data=='') 
						{
							return '<p>No se subio Resolución</p>';
						} 
						else 
						{
							url = base_url + "uploads/ActaCompromisoOperacionyMantenimiento/"+row.id_operacion_mantenimiento_pi +"."+data;
							
							return '<a href="'+url+'" target="_blank"><i class="fa fa-file fa-lg"></i></a>';
						}
					}
				},
				{"data": "id_operacion_mantenimiento_pi",
					render: function(data, type, row) 
					{
						return "<button type='button' data-toggle='tooltip' class='btn btn-danger btn-xs' data-toggle='modal' onclick=eliminarOperacion(" + data + ",this)><i class='ace-icon fa fa-trash-o bigger-120'></i></button>";
					}
				}   
			],
			"language": idioma_espanol
		});
	}

	function eliminarOperacion(idOperacion, element) 
	{
		swal({
			title: "Se eliminará la modalidad ¿Realmente desea proseguir con la operación?",
			text: "",
			type: "warning",
			showCancelButton: true,
			cancelButtonText: "Cerrar",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "SI,Eliminar",
			closeOnConfirm: false
		}, function() {
			paginaAjaxJSON({
				"idOperacion": idOperacion
			}, base_url + 'index.php/PMI_OperacionMantenimientoPi/eliminar', 'POST', null, function(objectJSON) {
				objectJSON = JSON.parse(objectJSON);
				swal({
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
				}, function() {});
				$('#tablaOperacion').dataTable()._fnAjaxUpdate();
			}, false, true);
		});
	}

	function guardarOperacionMantenimiento()
	{
		var codigo=$('#hdIdPI').val();
		event.preventDefault();
        $('#validarAddOperacionMantenimiento').data('formValidation').validate();
		if(!($('#validarAddOperacionMantenimiento').data('formValidation').isValid()))
		{
			return;
		}
		var formData=new FormData($("#frmOperacionMantenimiento")[0]);
		$.ajax({
			type:"POST",
			url:base_url+"index.php/PMI_OperacionMantenimientoPi/insertar",
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
				$('#tablaOperacion').dataTable()._fnAjaxUpdate();
				$('#txt_monto_operacion').val("");
                $('#txt_responsable_operacion').val("");
                $('#txt_monto_mantenimiento').val("");
                $('#txt_responsable_mantenimiento').val("");
                $('#fileActaCompromiso').val("");
			},
			error:function()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
		});		
	}
</script>






