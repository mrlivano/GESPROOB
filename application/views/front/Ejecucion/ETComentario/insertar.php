<link rel="stylesheet" href="<?=base_url()?>assets/vendors/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="<?=base_url()?>assets/dist/css/bootstrap-select.css">
<div id="divComentario" style="height: 250px;overflow-y: scroll;">
	<table id="tableComentario" class="table table-striped">
		<tbody>
			<?php foreach($listaETComentario as $key => $value){ ?>
				<tr>
					<td style="padding: 2px;padding-top: 4px;width: 45px;">
						<img src="<?=base_url()?>assets/img/user.png" height="45" width="45" style="background-color: #ffffff;border: 1px solid #cccccc;border-radius: 50px;">
					</td>
					<td style="padding: 4px;padding-left: 0px;">
						<b><?=html_escape($value->nombres.' '.$value->apellido_p.' '.$value->apellido_m)?> <small style="color: #999999;">(<?=html_escape($value->nombre_esp)?>)</small></b><br>
						<small><?=html_escape($value->desc_comentario)?></small>
						<div>
							<small>
								<?=count($value->childETArchivo)!=0 ? '<b>Archivos adjuntos: </b>' : ''?>
								<?php foreach($value->childETArchivo as $index => $item){ ?>
									<a href="#" onclick="window.location.href='<?=base_url()?>index.php/ET_Archivo/descargar/<?=$item->id_et_archivo?>';"><?=html_escape($item->nombre_archivo)?></a><?=(count($value->childETArchivo)-1)!=$index ? ', ' : ''?>
								<?php } ?>
							</small>
						</div>
						<div style="color: #999999;font-size: 9px;text-align: right;">
							<a href="#" style="color: red;font-size: 10px;" onclick="eliminarComentario(<?=$value->id_et_comentario?>, this);">Eliminar</a> | <?=$value->fecha_comentario?>
						</div>
					</td>
				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>
<hr>
<div class="row">
	<div class="col-md-12">
		<div class="col-md-12">
			<textarea id="txtDescripcionComentario" rows="3" class="form-control" style="resize: none;" placeholder="Escribe un comentario con respecto a la actividad actualmente seleccionada."></textarea>
		</div>
		<div class="col-md-12" style="margin-top: 4px;">
			<input type="file" id="fileArchivosComentario" value="Publicar" multiple class="col-md-7">
			<div class="col-md-1"></div>
			<input type="button" class="btn btn-primary col-md-4" value="Publicar comentario" onclick="insertarComentario();">
		</div>
	</div>
</div>
<script src="<?=base_url()?>assets/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="<?=base_url()?>assets/dist/js/bootstrap-select.js"></script>
<script>
	function insertarComentario()
	{
		if($('#txtDescripcionComentario').val().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'Debe escribir un comentario para publicarlo.',
				type: 'error'
			},
			function(){});

			return;
		}

		var dataAjax=new FormData();

		dataAjax.append('idTareaET', <?=$idTareaET?>);

		$.each($($('#fileArchivosComentario')[0]).get(0).files, function(key, value)
		{
			dataAjax.append('archivo'+key, value);
		});
		
		dataAjax.append('descComentario', $('#txtDescripcionComentario').val());

		$.ajax({
		    type: 'POST',
		    url: '<?=base_url()?>index.php/ET_Comentario/insertar',
		    contentType: false,
		    processData: false,
		    data: dataAjax,
		    beforeSend: function(xhr)
		    {
		        renderLoading();
		    },
		    success: function(objectJSON)
		    {
		    	$('#txtDescripcionComentario').val(null);
		    	$('#fileArchivosComentario').val(null);

		    	$('#divModalCargaAjax').hide();

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

				var htmlArchivosTemp='';

				if(objectJSON.etComentario.childETArchivo.length!=0)
				{
					htmlArchivosTemp+='<div><small><b>Archivos adjuntos: </b>';
				}

				$.each(objectJSON.etComentario.childETArchivo, function(key, value)
				{
					htmlArchivosTemp+='<a href="#" onclick="window.location.href=\'<?=base_url()?>index.php/ET_Archivo/descargar/'+value.id_et_archivo+'\';">'+replaceAll(replaceAll(value.nombre_archivo, '<', '&lt;'), '>', '&gt')+'</a>'+((objectJSON.etComentario.childETArchivo.length-1)!=key ? ', ' : '');
				});

				if(objectJSON.etComentario.childETArchivo.length!=0)
				{
					htmlArchivosTemp+='</small></div>';
				}

				var htmlTemp='<tr>'+
					'<td style="padding: 2px;padding-top: 4px;width: 45px;">'+
						'<img src="<?=base_url()?>assets/img/user.png" height="45" width="45" style="background-color: #ffffff;border: 1px solid #cccccc;border-radius: 50px;">'+
					'</td>'+
					'<td style="padding: 4px;padding-left: 0px;">'+
						'<b>'+replaceAll(replaceAll((objectJSON.etComentario.nombres+' '+objectJSON.etComentario.apellido_p+' '+objectJSON.etComentario.apellido_m), '<', '&lt;'), '>', '&gt')+' <small style="color: #999999;">('+replaceAll(replaceAll(objectJSON.etComentario.nombre_esp, '<', '&lt;'), '>', '&gt')+')</small></b><br>'+
						'<small>'+objectJSON.etComentario.desc_comentario+'</small>'+
						htmlArchivosTemp+
						'<div style="color: #999999;font-size: 9px;text-align: right;">'+
							'<a href="#" style="color: red;font-size: 10px;" onclick="eliminarComentario('+objectJSON.etComentario.id_et_comentario+', this);">Eliminar</a> | '+objectJSON.etComentario.fecha_comentario+
						'</div>'+
					'</td>'+
				'</tr>';

				$('#tableComentario > tbody').append(htmlTemp);
				$('#txtDescripcionComentario').val(null);

				$('#divComentario').animate({ scrollTop :  $('#divComentario').scrollTop()+$('#divComentario')[0].scrollHeight }, 200);
		    }
		});
	}

	function eliminarComentario(idETComentario, element)
	{
		if(confirm('¿Realmente desea eliminar el comentario?'))
		{
			paginaAjaxJSON({ idETComentario : idETComentario }, '<?=base_url()?>index.php/ET_Comentario/eliminar', 'POST', null, function(objectJSON)
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

				$(element).parent().parent().parent().remove();
			}, false, true);
		}
	}
</script>