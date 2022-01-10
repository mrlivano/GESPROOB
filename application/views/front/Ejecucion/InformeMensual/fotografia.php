
<style>
	.tablastand td, .tablastand th
	{
		border:1px solid black;
		padding: 2px 5px;
		vertical-align: middle;		
	}
	.tablastand th
	{
		background-color:#f1f1f1;
		font-weight:bold;
	}
</style>
<div class="form-horizontal">
	<form  id="frmEtFotografia" >					
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<label class="control-label">Descripción de la fotografia (indicando cual es la partida que se esta ejecutando y la actividad):</label>
				<input type="hidden" id="idDetalleFormato" name="idDetalleFormato" notValidate value="<?=$idDetalleFormato?>">	                            									
				<textarea style="resize: none;resize: vertical;" name="txtDescripcion" id="txtDescripcion" class="form-control" rows="3"></textarea>									
			</div>
		</div>
		<div class="row">
			<div class="col-md-10 col-sm-12 col-xs-12">
				<label class="control-label">Seleccione el archivo:</label>
				<div>
					<input accept="image/*" type="file" id="fileFotografia" name="fileFotografia" class="form-control">
					<label style="color:#f0ad4e;">Solo se aceptan archivos en formato jpg,png</label>
				</div>
			</div>
			<div class="col-md-2 col-sm-12 col-xs-12">
				<label class="control-label">.</label>
				<div>       
					<input style="width:100%;" type="button" class="btn btn-success" value="Guardar" onclick="guardarFotografia();">
				</div>	
			</div>			
		</div>
	</form>
	<br>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12" style="height:250px;overflow:scroll;overflow-x: hidden;text-align: left; ">
			<div class="table-responsive">
			<table class="table table-bordered table-sm tablastand">
				<thead>
					<tr>
						<th>Fotografía</th>
						<th>Descripción</th>
						<th>Opción</th>											
					</tr>
				</thead>
				<tbody id="bodyPlazo">
					<?php foreach($listaFotografia as $key => $value ) { ?>
					<tr>
						<td style="width:10%;text-align:center;"><?=$value->extension?></td>
						<td style="width:85%;"><?=$value->descripcion?></td>
						<td style="width:5%;text-align:center;">
							<button type="button" class="btn btn-danger btn-xs" onclick="eliminar('<?=$value->id_fotografia?>','<?=$value->extension?>',this);"><i class="fa fa-trash-o"></i> Eliminar</button>						
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			</div>		
		</div>
	</div>	
	<div class="row" style="text-align: right;">		
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
<div class="form-horizontal">

<script>
 
	$(function()
	{
		$('#frmEtFotografia').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				fileFotografia:
				{
					validators:
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Archivo" es requerido.</b>'
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

	function guardarFotografia()
	{
		event.preventDefault();
        $('#frmEtFotografia').data('formValidation').validate();
		if(!($('#frmEtFotografia').data('formValidation').isValid()))
		{
			return;
		}
        var formData=new FormData($("#frmEtFotografia")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/ET_Detalle_Formato/guardarFotografia",
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
            	objectJSON=JSON.parse(resp);
				swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
				$('#modalTemp').modal('hide');
				$('#divModalCargaAjax').hide();	
            },
			error: function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
	}

	function eliminar(codigo,extension,element)
	{
		swal(
		{
			title: "",
			text: "Realmente desea realizar esta operación",
			type: "warning",
			showCancelButton: true,
			confirmButtonClass: "btn-danger",
			confirmButtonColor: "#DD6B55",
			confirmButtonText: "Si, eliminar",
			cancelButtonText: "Cerrar",
			closeOnConfirm: false
		},
		function(isConfirm)
		{
			if(isConfirm)
			{
				$.ajax({
					type:"POST",
					url:base_url+"index.php/ET_Detalle_Formato/eliminarFotografia",
					data: 
					{
						codigo : codigo,
						extension :extension
					},
					cache: false,
					success:function(resp)
					{
						objectJSON=JSON.parse(resp);
						swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
						$(element).parent().parent().remove();
					},
					error:function()
					{
						swal("Error","Ha ocurrido un error inesperado", "error");
						$('#divModalCargaAjax').hide();	
					}
				}); 
			}
		});
	}
		  
</script>