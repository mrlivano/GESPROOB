<style>
	.help-block {
        color: indianred;
    }

    .msgError {
        display: none;
        padding-bottom: 0px;
        margin-bottom: 0px;
        font-size: 12px;
    }
</style>
<form class="form-horizontal" id="frmAgregarEspecificacionTecnica">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="x_panel">
				<div class="x_content">
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<p style="color:; font-size:12px; text-transform:uppercase;font-weight:bold;"><?=@$DetallePartida[0]->numeracion?> <?=@$DetallePartida[0]->desc_partida?></p>						
						</div>
					</div>
					<div class="row">
						<div class="col-md-12  col-sm-12 col-xs-12">
							<label for="control-label">Buscar Sugerencias por Descripción</label>
							<div>
								<select name="selectDescripcionEspecificacion" id="selectDescripcionEspecificacion" class="form-control selectpicker"></select>
							</div>
						</div>
					</div>
					<div class="row" id="divEspecificacionSugerencia" style="display:none;">
						<div class="col-md-12  col-sm-12 col-xs-12">
							<label class="control-label">Sugerencias:</label></br>
							<p><textarea readonly name="txtEspecificacionSugerencia" id="txtEspecificacionSugerencia" rows="10" cols="80"></textarea></p>							
						</div>
					</div>		
					<div class="row">
						<div class="col-md-12 col-sm-12 col-xs-12">
							<label class="control-label">Especificación Técnica:</label></br>
							<input type="hidden" name="hdIdDetallePartida" id="hdIdDetallePartida" value="<?=@$DetallePartida[0]->id_detalle_partida?>">											
							<input type="hidden" name="hdIdPartida" id="hdIdPartida" value="<?=@$DetallePartida[0]->id_partida?>">											
							<input type="hidden" id="hdEspecificacionTecnica" value="<?=htmlspecialchars(@$DetallePartida[0]->especificacion_tecnica)?>" type="hidden">
							<p><textarea name="txtEspecificacionTecnica" id="txtEspecificacionTecnica" rows="10" cols="80"></textarea></p>
							<div class="msgError"><p class="help-block" id="MsgContenido"> Oops!</p></div>                              
						</div>	
					</div>		
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="text-align: right;">
		<button type="submit" id="btnEnviarFormulario" class="btn btn-success">Guardar</button>
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>  
$(function()
{
	CKEDITOR.replace('txtEspecificacionTecnica', {
		filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
	});
	CKEDITOR.replace('txtEspecificacionSugerencia', {
		filebrowserImageBrowseUrl : '<?php echo base_url('assets/filemanager/index.html');?>'
	});
	html=$("#hdEspecificacionTecnica").val();
	CKEDITOR.instances.txtEspecificacionTecnica.setData(html);
	$('#selectDescripcionEspecificacion').selectpicker({ liveSearch: true }).ajaxSelectPicker(
	{		
        ajax: {
            url: base_url+'index.php/ET_EspecificacionTecnica/verPorDescripcion',
			data: 
			{ 
				valueSearch : '{{{q}}}',
				idPartida : $("#hdIdPartida").val()
			}
        },
        locale:
        {
        	statusInitialized : 'Escriba para buscar por partida',
            statusNoResults : 'No se encontro',
            statusSearching : 'Buscando...',
            searchPlaceholder : 'Buscar',
            emptyTitle : 'Buscar sugerencias'
        },
        preprocessData: function(data)
        {
        	var dataForSelect=[];

        	for(var i=0; i<data.length; i++)
        	{
        		dataForSelect.push(
                {
                    "value" : data[i].id_detalle_partida,
                    "text" : data[i].desc_partida,
                    "data" :
                    {
                    	"especificacion_tecnica" : data[i].especificacion_tecnica
                    },
                    "disabled" : false
                });
        	}

            return dataForSelect;
        },
        preserveSelected: false
    });

    $('#selectDescripcionEspecificacion').on('change', function()
    {
		if($(this).find("option:selected").val()!='')
		{
			CKEDITOR.instances.txtEspecificacionSugerencia.setData($(this).find("option:selected").data('especificacion_tecnica'));
			$('#divEspecificacionSugerencia').show(1000);
		}		
	});
});

function valCKEDITOR()
{
	var cantidad = CKEDITOR.instances.txtEspecificacionTecnica.getData().replace(/<[^>]*>/gi, '').length;
	if (!cantidad)
	{
		var mensaje = 'El campo "contenido" es requerido';
		$("#MsgContenido").parent().css("display", "block");
		$("#MsgContenido").text(mensaje);
		return mensaje;
	}
	else
	{
		$("#MsgContenido").parent().css("display", "none");
		return '';
	}	
}

$('#btnEnviarFormulario').on('click', function(event)
{
    event.preventDefault();	
	if(valCKEDITOR()!='')
	{
		return;
	}
	for (instance in CKEDITOR.instances) 
	{
		CKEDITOR.instances[instance].updateElement();
	}
    var formData=new FormData($("#frmAgregarEspecificacionTecnica")[0]);
    $.ajax({
        type:"POST",
        url:base_url+"index.php/ET_EspecificacionTecnica/Guardar",
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
			var idDetallePartida=$('#hdIdDetallePartida').val();
			swal('',objectJSON.mensaje,(objectJSON.proceso=='Correcto' ? 'success' : 'error'));
			$('#otherModalEspecificacionTecnica').modal('hide');
			$('#divModalCargaAjax').hide();
			$('#btnDetallePartida'+idDetallePartida).attr('class','btn btn-success btn-xs');		
        },
		error: function ()
		{
			swal("Error", "Ha ocurrido un error inesperado", "error")
			$('#divModalCargaAjax').hide();
		}
    });  
	$('#frmAgregarEspecificacionTecnica')[0].reset();
});

</script>







