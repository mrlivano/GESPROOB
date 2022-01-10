<style>
	li
	{
		list-style:none;
		padding-top:5px;
	}
	ul
	{
		list-style-type: none;
    	margin: 0;
    	padding: 0;

	}
	b
	{
		padding-left: 5px;
	}
	.btnli
	{
		width: 30px;
	}
</style>
<form  id="frmInsertarVistoBueno">
<div class="form-horizontal">
	<div>
		<label id="hdDescripcion1" name="hdDescripcion1" style="color: #0073b7; font-size: 14px;" for="control-label"><?php echo ($hdIdProducto!='' ? 'Producto: ' : 'Actividad: ');?><?=$descripcion?></label><br>
	<br></label>					
	</div>
	<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==8 || $this->session->userdata('tipoUsuario')==9) {?>
	<div class="row">
		<input type="hidden" name="hdIdProducto" id="hdIdProducto" value="<?=$hdIdProducto?>">
		<input type="hidden" name="hdIdActividad" id="hdIdActividad" value="<?=$hdIdActividad?>">
		<input type="hidden" name="hdIdProyecto" id="hdIdProyecto" value="<?=$idProyecto?>">
		<input type="hidden" name="hdDescripcion" id="hdDescripcion" value="<?=$descripcion?>">
		<div id="divAgregarVisto">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<label for="control-label">Descripción:</label>
			<textarea class="form-control" id="txtDescripcion" name="txtDescripcion" autocomplete="off" rows="2"></textarea>
		</div>
		<div class="col-md-7 col-sm-6 col-xs-12">
			<label for="control-label">Agregar Archivo:</label>
			<input type="file" class="form-control" id="fileArchivo" name="fileArchivo">
		</div>
		<div class="col-md-3 col-sm-6 col-xs-12">
			<label class="control-label">Desea dar Visto Bueno:</label>
			<div style="padding-top: 5px;">
				<label><input type="checkbox" class="checkVistoBueno" name="vb" id="vb" <?php echo ($vbueno==1 ? 'checked' : '')?> > Visto Bueno</label>
			</div>			
		</div>
		</div>		
		<div class="col-md-2 col-sm-12 col-xs-12">
			<label for="control-label">.</label>
			<input type="button" class="btn btn-info" value="Guardar" onclick="agregarVistoBueno();" style="width: 100%;">
		</div>		
	</div>
	<?php } ?>
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div style="background-color: #f5fbfb; height: 270px;overflow-y: scroll; margin-top: 15px;">
				<ul id="Resultado">
					<?php if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==8 || $this->session->userdata('tipoUsuario')==9) {
					foreach ($vistoBueno as $key => $value) { ?>
					<li>
						<div class="btn-group  btn-group-xs">
	                        <button data-toggle="tooltip" data-placement="top" title="Guardar Cambios" onclick="guardarCambiosVistoBueno('<?=$value->id_act_prog_visto_bueno?>');" class="btn btn-default btnli" type="button">G</button>
	                        <button data-toggle="tooltip" data-placement="top" title="Eliminar" onclick="eliminarVistoBueno('<?=$value->id_act_prog_visto_bueno?>',this,'\'<?=$value->url_documento?>\'');" class="btn btn-default btnli" type="button">-</button>

	                        <?php if($value->url_documento != '') { ?>
	                        &nbsp;<a href='<?php echo base_url()."uploads/VistoBueno/".$value->url_documento;?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
	                        <?php } ?>
                      	</div><b id="descripcionVistoBueno<?=$value->id_act_prog_visto_bueno?>" style="color:#1e8c75;font-size:12px;text-transform:uppercase;" contenteditable><?=$value->desc_visto_bueno?></b> 
                    </li>  
					<?php } } 
					else { 
					foreach ($vistoBueno as $key => $value) { ?>
					<li>
						<div class="btn-group  btn-group-xs">
	                        <?php if($value->url_documento != '') { ?>
	                        &nbsp;<a href='<?php echo base_url()."uploads/VistoBueno/".$value->url_documento;?>' target='_blank'><i class='fa fa-file fa-lg'></i></a>
	                        <?php } ?>
                      	</div><b id="descripcionVistoBueno<?=$value->id_act_prog_visto_bueno?>" style="color:#1e8c75;font-size:12px;text-transform:uppercase;"><?=$value->desc_visto_bueno?></b> 
                    </li> 
					<?php }  } ?>

				</ul>
			</div>
		</div>
	</div>
	<hr>
	<div class="row" style="text-align: right;">		
		<button class="btn btn-danger" data-dismiss="modal">
			<span class="glyphicon glyphicon-remove"></span>
			Cerrar ventana
		</button>
	</div>
</div>
</form>

<script>

	$(function()
	{
		$('#divAgregarVisto').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
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

	function agregarVistoBueno()
	{
		event.preventDefault();
		$('#divAgregarVisto').data('formValidation').validate();
		if(!($('#divAgregarVisto').data('formValidation').isValid()))
		{
			return;
		}

		var formData=new FormData($("#frmInsertarVistoBueno")[0]);
		var descripcion=$('#txtDescripcion').val().trim();
		var hdIdProducto = $('#hdIdProducto').val();
		var hdIdActividad = $('#hdIdActividad').val();
		$.ajax({
	        type:"POST",
	        url:base_url+"index.php/Mo_ProActVistoBueno/insertar",
	        data: formData,
	        cache: false,
	        contentType:false,
	        processData:false,
	        success:function(resp)
	        {
	        	resp = JSON.parse(resp);
	        	((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));	   
	        	if(resp.proceso=='Correcto')
	        	{
	        		var htmlTemp ='<li><div class="btn-group  btn-group-xs"><button data-toggle="tooltip" data-placement="top" title="Guardar Cambios"  onclick="guardarCambiosVistoBueno('+resp.idVistoBueno+');" class="btn btn-default btnli" type="button">G</button><button  onclick="eliminarVistoBueno('+resp.idVistoBueno+',this,'+'\''+resp.urlDocumento+'\');" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-default btnli" type="button">-</button></div>';
	        		if(resp.urlDocumento!='')
	        		{
	        			htmlTemp+='&nbsp;<a href='+base_url+'uploads/VistoBueno/'+resp.urlDocumento+' target="_blank"><i class="fa fa-file fa-lg"></i></a>';
	        		}
	        		htmlTemp+='<b id="descripcionVistoBueno'+resp.idVistoBueno+'" style="color:#1e8c75; font-size:12px; text-transform: uppercase;" contenteditable>'+descripcion+'</b><ul style="padding-left: 27px;"></ul></li>';
	        		$('#Resultado').append(htmlTemp);

	        		if ($('input.checkVistoBueno').is(':checked')) 
	        		{
	        			if(hdIdProducto!='')
	        			{
	        				$('#btn'+hdIdProducto).attr('class','btn btn-round btn-success btn-xs');
	        			}	        		
	        			if(hdIdActividad!='')
	        			{
	        				$('#btn'+hdIdActividad).attr('class','btn btn-success btn-xs');
	        			}
	        		}
	        		else
	        		{
	        			if(hdIdProducto!='')
	        			{
	        				$('#btn'+hdIdProducto).attr('class','btn btn-round btn-warning btn-xs');
	        			}
	        			if(hdIdActividad!='')
	        			{
	        				$('#btn'+hdIdActividad).attr('class','btn btn-primary btn-xs');
	        			}

	        		}
	        		$('#txtDescripcion').val('');
	        		$('#fileArchivo').val('');
	        		$('.checkVistoBueno').attr('checked', false);
	        	}    		        		        	
	        },
	        error:function()
	        {
	        	swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
	        }
	        
    	});
	}

	function guardarCambiosVistoBueno(codigo)
	{
		if($('#descripcionVistoBueno'+codigo).text().trim()=='')
		{
			swal(
			{
				title: '',
				text: 'El campo resultado es requerido',
				type: 'error'
			},
			function(){});
			$('#descripcionVistoBueno'+codigo).text('___');
			return;
		}
		paginaAjaxJSON({ "codigo" : codigo, 'descripcionVistoBueno' : replaceAll(replaceAll($('#descripcionVistoBueno'+codigo).text().trim(), '<', '&lt;'), '>', '&gt;') }, base_url+'index.php/Mo_ProActVistoBueno/editar', 'POST', null, function(objectJSON)
		{
			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function(){});

			$('#descripcionVistoBueno'+codigo).text($('#descripcionVistoBueno'+codigo).text().trim());
		}, false, true);
	}

	function eliminarVistoBueno(codigo,element,urlDocumento) 
	{
		swal({
            title: "¿Realmente desea proseguir con la operación?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function(){
            paginaAjaxJSON({ "codigo" : codigo, 'urlDocumento':urlDocumento }, base_url+'index.php/Mo_ProActVistoBueno/eliminar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){});

				$(element).parent().parent().remove();

			}, false, true);
        });
	}
	
</script>