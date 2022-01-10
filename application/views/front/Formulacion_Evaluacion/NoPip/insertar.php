<form class="form-horizontal" id="form-addNoPip" action="<?=base_url();?>index.php/NoPipProgramados/insertar" method="POST" enctype="multipart/form-data">
	<div class="form-horizontal">
		<div class="row">
            <div class="count red" style=" margin-left: 10px; ">Ojo: Proyectos previamente programadas en PMI </div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="x_panel">

					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Tipo No PIP</label>
							<select  id="TipoNoPip" name="TipoNoPip"  onclick="BuscarNoPIP();"  class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar No pip...">
								<?php foreach($ListarPipProgramados as $item){ ?>
								<option value="<?= $item->desc_tipo_nopip?>"> <?= $item->desc_tipo_nopip; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">No PIP</label>
							<select  id="ListadoFiltroNoPIP" name="ListadoFiltroNoPIP"  class="selectpicker form-control col-md-12 col-xs-12" data-live-search="true"  title="Buscar Tipo no pip...">

							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Nombre</label>
							<div>	
								<input id="txtnombreNoPip" name="txtnombreNoPip"  class="form-control col-md-4 col-xs-12">	
							</div>	
						</div>
					</div>
					<hr>
					DATOS DE DOCUMENTO
					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Nombre Documento</label>
							<div>	
								<input id="txtNombreDocumento" name="txtNombreDocumento"  class="form-control col-md-4 col-xs-12">	
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">
							<label class="control-label">Descripcion Documento</label>
							<div>	
								<input id="txtDescripcionDocumento" name="txtDescripcionDocumento"  class="form-control col-md-4 col-xs-12">	
							</div>	
						</div>
					</div>

					<div class="row">
						<div class="col-md-12 col-sm-3 col-xs-12">	
							<label class="control-label">Subir Documento No PIP</label>
							<div>	
								<input type="hidden" id="nombreUrlDocumento" name="nombreUrlDocumento">
								<input type="file" id="Documento_noPip" name="Documento_noPip"  accept=".xlsx,.xls,image/*,.doc, .docx,.ppt, .pptx,.txt,.pdf">
							</div>
						</div>
					</div>

					<hr style="margin-top: 4px;">
					<div class="row" style="text-align: right;">
						<button type="submit"  id="btnEnviarFormulario" class="btn btn-success">Guardar </button>

						<button  class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>	
		</div>	
	</div>		
</form>

<script>
$(document).ready(function() 
{
		 $('.selectpicker').selectpicker({
	  
	  });
		 $("#TipoNoPip").change(function()
		 {
 		 var html='';
 		 $("#ListadoFiltroNoPIP").html(html);
 		 var desc_tipo_nopip =$("#TipoNoPip").val();
 		 $.ajax({ url:base_url+"index.php/NoPipProgramados/listarNopip",type:"POST",data:{desc_tipo_nopip:desc_tipo_nopip},success:function(respuesta)
                {
                	console.log(respuesta);
                	var registros = eval(respuesta);
                    for (var i = 0; i <registros.length;i++) 
                    {
                      html +="<option  value='"+registros[i]["id_pi"]+'_'+registros[i]["nombre_pi"]+"'> "+registros[i]["nombre_pi"]+" </option>";
                    };
                    $("#ListadoFiltroNoPIP").html(html);
                    $('select[name=ListadoFiltroNoPIP]').change();//borrado
                    $('.selectpicker').selectpicker('refresh');  
                }
            });
		 });

		$("#ListadoFiltroNoPIP").change(function()
		 {
	  	var desc_tipo_nopip =$("#ListadoFiltroNoPIP").val().split('_')[1];
 		$("#txtnombreNoPip").val(desc_tipo_nopip);
	});
		

		$('#btnEnviarFormulario').on('click', function(event)
	{
		var Documento_noPip =document.getElementById('Documento_noPip').files[0].name;//$("#urlDocumentoObservacion").val();
        var url=getFileExtension(Documento_noPip);
        $("#nombreUrlDocumento").val(url);
	});

	function getFileExtension(filename)
    {
		return filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2);
	}
 		 			 
});

$(function()
{
	$('#form-addNoPip').formValidation(
    {
        framework: 'bootstrap',
        excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
        live: 'enabled',
        message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
        trigger: null,
        fields:
        {
            TipoNoPip:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Tipo" es requerido.</b>'
                    }
                }
            },
            ListadoFiltroNoPIP:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "No PIP" es requerido.</b>'
                    }
                }
            },
            txtnombreNoPip:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                    }
                }
            },
            txtNombreDocumento:
            {
                validators:
                {
                    notEmpty:
                    {
                        message:'<b style="color:red;">El campo "Nombre del Documento" es requerido.</b>'
                    }
                }
            },
            txtDescripcionDocumento:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Descripción" es requerido.</b>'
                    }
                }
            },
            Documento_noPip:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Documento" es requerido.</b>'
                    }
                }
            }

        }
    });

});

</script>


