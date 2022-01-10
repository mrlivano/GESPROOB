<div class="form-horizontal">
	<div class="row">
		<div class="col-md-12 col-sm-12 col-xs-12">
			<div>
				<input type="hidden" id="id_pi" value="<?=$proyecto[0]->id_pi?>">
				<textarea name="txtNombreProyectoInversion" id="txtNombreProyectoInversion" rows="2" class="form-control" style="resize: none;resize: vertical;" readonly="readonly"><?=html_escape(trim($proyecto[0]->nombre_pi))?></textarea>
			</div>
		</div>
	</div>
	<br>
	<?php if($this->session->userdata('tipoUsuario')==7 || $this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9) {?>
	<div>
        <label style="color:red;font-size:12px;">Valoración Restante: <span id="hdValoracionRestante">100</span> %</label>
    </div>
	<div id="divAgregarProducto" class="row" style="margin-top: 3px;">
		<div class="col-md-8 col-sm-6 col-xs-12">
			<input type="text" class="form-control" id="txtDescripcionProducto" name="txtDescripcionProducto" placeholder="Descripción del producto">
		</div>
		<div class="col-md-2 col-sm-6 col-xs-12 has-feedback">
			<input type="text" class="form-control" id="txtValoracion" name="txtValoracion" placeholder="Valoración" maxlength="5">
			<span class="form-control-feedback right" aria-hidden="true">%</span>				
		</div>
		<div class="col-md-2 col-sm-4 col-xs-12">
			<input type="button" class="btn btn-info" value="Agregar producto" onclick="agregarProducto();" style="width: 100%;">
		</div>
	</div>
	<?php } ?>
	<div class="row" style="height: 300px;overflow-y: scroll; margin-top: 15px;">
		<div class="col-md-12 col-sm-12 col-xs-12">
        	<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">           	
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

<script>
	function agregarProducto()
	{
		$('#divAgregarProducto').data('formValidation').resetField($('#txtDescripcionProducto'));

		$('#divAgregarProducto').data('formValidation').validate();

		if(!($('#divAgregarProducto').data('formValidation').isValid()))
		{
			return;
		}
		paginaAjaxJSON({ "idPi" : $('#id_pi').val(), "descripcionProducto" : $('#txtDescripcionProducto').val().trim(),"valoracionProducto" : $('#txtValoracion').val().trim() }, base_url+'index.php/Mo_MonitoreodeProyectos/InsertarProducto', 'POST', null, function(objectJSON)
		{
			resp=JSON.parse(objectJSON);

			((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));
            
            if(resp.proceso=='Correcto')
            {
            	calcularValoracion();
            	var htmlTemp= '<div class="panel"><div class="panel-heading" style="padding: 6px;"><h4 class="panel-title" style="float:right;"><a onclick="eliminarProducto('+resp.idProducto+',this);" role = "button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Eliminar Producto"><i class="fa fa-trash-o"></i></a><a onclick="paginaAjaxDialogo(\'modal2\',\'Agregar Actividad\', {idPi:'+$('#id_pi').val()+', idProducto :'+resp.idProducto+'}, base_url+\'index.php/Mo_Actividad/Insertar\',\'GET\', null, null, false, true);" role="button" class="btn btn-round btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="Agregar Actividad"><i class="fa fa-plus"></i></a></h4><a class="panel-title" id="heading'+resp.idProducto+'" data-toggle="collapse" data-parent="#accordion" href="#collapse'+resp.idProducto+'" aria-expanded="false" aria-controls="collapse'+resp.idProducto+'" style="text-transform: uppercase;">'+replaceAll(replaceAll($('#txtDescripcionProducto').val().trim(), '<', '&lt;'), '>', '&gt;')+'</a></div>';
            	htmlTemp+='<div id="collapse'+resp.idProducto+'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'+resp.idProducto+'><div class="panel-body"><div class="table-responsive"><table class="table table-bordered"><thead><tr><th>Actividad</th><th>U. Medida</th><th>Meta</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Opciones</th></tr></thead></table></div></div></div></div>';

				$('#accordion').append(htmlTemp);
				$('#txtDescripcionProducto').val('');
				$('#txtValoracion').val('');
            }
		}, false, true);

	}

	function calcularValoracion()
    {
        idPi=$('#id_pi').val().trim();
        $.ajax(
        {
            url: base_url+'index.php/Mo_MonitoreodeProyectos/valoracionRestante',
            type: 'POST',
            cache: false,
            data:{idPi:idPi},
            async: true
        }).done(function(objectJSON)
        {
            objectJSON = JSON.parse(objectJSON);
            $('#hdValoracionRestante').text(objectJSON.valoracionRestante);
        });
    }

    function eliminarProducto(idProducto, element)
    {
        swal({
            title: "Esta seguro que desea eliminar el producto y sus actividades?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idProducto" : idProducto }, base_url+'index.php/Mo_MonitoreodeProyectos/eliminarProducto', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje,"success") : swal(resp.proceso,resp.mensaje,"error"));

                if(resp.proceso=='Correcto')
                {
                    calcularValoracion();
                    $(element).parent().parent().parent().remove();
                }               
            }, false, true);
        });
    }
    

	$(function()
	{
		$('#divAgregarProducto').formValidation(
		{
			framework: 'bootstrap',
			excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
			live: 'enabled',
			message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
			trigger: null,
			fields:
			{
				txtDescripcionProducto:
				{
					validators: 
					{
						notEmpty:
						{
							message: '<b style="color: red;">El campo "Descripción del producto" es requerido.</b>'
						}
					}
				},
				txtValoracion:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Valoración del producto" es requerido.</b>'
                        },
                        regexp:
                        {
                            regexp: /^(\d+([\.]{1}(\d{1,2})?)?)*$/,
                            message: '<b style="color: red;">El campo "Valoración" debe ser un valor en decimales.</b>'
                        },
                        between: {
                            min: 0.1,
                            max: 100,
                            message: '<b style="color: red;">El campo "Valoración" debe estar entre 1 y 100.</b>'
                        }
                    }
                }
			}
		});		
	});

	$('#nuevoProducto').on('hidden.bs.modal', function(){
	    window.location.href=base_url+'Mo_MonitoreodeProyectos/index';
	});
</script>