<style>
	ul
	{
		list-style-type: none;
    	margin: 0;
    	padding: 0;
	}
	.titulo
	{
		cursor: pointer;
	}
	.prod_color li
	{
    	margin: 0 0px;
	}
	.list-inline>li
	{
	    display: inline-block;
	    padding-right: 2px;
	    padding-left: 2px;
	}
	.prod_color .color
	{
	    border: 1px black !important;
	}
	.bg-off
	{
		background:#6f6f6f !important;border:1px solid #6f6f6f !important;color:#fff
	}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>EJECUCIÓN FÍSICA DE PROYECTOS DE INVERSIÓN</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="x_content">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">	                                   	
                                <div class="row">
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <label class="control-label">Función:</label>
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="selectFuncion" name="selectFuncion" data-live-search="true">
                                                <option value="">Seleccione una opción</option>
                                                <?php foreach ($funcion as $key => $value) { ?>
                                                    <option value='<?=$value->id_funcion?>'>
                                                    <?=$value->nombre_funcion?></option>		      								      			
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <label class="control-label">División Funcional:</label>
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="selectDivisionFuncional" name="selectDivisionFuncional" data-live-search="true">
                                                <option value="">Seleccione una opción</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-4 col-xs-12">
                                        <label class="control-label">Grupo Funcional:</label>
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="selectGrupoFuncional" name="selectGrupoFuncional" data-live-search="true">
                                                <option value="">Seleccione una opción</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <label class="control-label">Provincia:</label>
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="selectProvincia" name="selectProvincia" data-live-search="true">
                                                <option value="">Seleccione una opción</option>
                                                <?php foreach ($provincia as $key => $value) { ?>
                                                    <option value='<?=$value->provincia?>'>
                                                    <?=$value->provincia?></option>		      								      			
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
                                        <label class="control-label">Distrito:</label>
                                        <div class="form-group">
                                            <select class="selectpicker form-control" id="selectDistrito" name="selectDistrito" data-live-search="true">
                                                <option value="">Seleccione una opción</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-12">
										<label class="control-label">.</label>
										<div class="form-group">
											<input type="button" class="btn btn-success" onclick="buscarProyectoInversion();" value="Buscar">
                                        </div>                                        
                                    </div>     
                                </div>  
                                <div class="table-responsive" id="dataTableFuncion">                                
                                </div>                       
                            </div>
                        </div>
                    </div>                    
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix"></div>
</div>
<script>
	$(function()
	{
		$("#selectFuncion").change(function()
		{
			var funcion=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/DivisionFuncional/GetDivisionFuncionalId",
				data: 
				{
					id_funcion:funcion
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">Seleccione una opción</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].id_div_funcional+'>'+objectJSON[item].nombre_div_funcional+'</option>';
					}
					$('#selectDivisionFuncional').html(htmlTemp);
					$('#selectDivisionFuncional').selectpicker('refresh');
					$('#selectGrupoFuncional').html('<option value="">Seleccione una opción</option>');
					$('#selectGrupoFuncional').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

		$("#selectDivisionFuncional").change(function()
		{
			var divisionFuncional=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/GrupoFuncional/GetGrupoFuncionalId",
				data: 
				{
					id_div_funcional:divisionFuncional
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">Seleccione una opción</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].id_grup_funcional+'>'+objectJSON[item].nombre_grup_funcional+'</option>';
					}
					$('#selectGrupoFuncional').html(htmlTemp);
					$('#selectGrupoFuncional').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});

        $("#selectProvincia").change(function()
		{
			var provincia=$(this).val();
			$.ajax({
				type:"POST",
				url:base_url+"index.php/Funcion/GetDistrito",
				data: 
				{
					provincia:provincia
				},
				cache: false,
				beforeSend:function() 
				{
					renderLoading();
				},
				success:function(objectJSON)
				{
					objectJSON=JSON.parse(objectJSON);
					var htmlTemp='<option value="">Seleccione una opción</option>';
					for (var item in objectJSON)
					{
						htmlTemp+='<option value='+objectJSON[item].distrito+'>'+objectJSON[item].distrito+'</option>';
					}
					$('#selectDistrito').html(htmlTemp);
					$('#selectDistrito').selectpicker('refresh');
					$('#divModalCargaAjax').hide();
				},
				error:function ()
				{
					swal("Error", "Ha ocurrido un error inesperado", "error")
					$('#divModalCargaAjax').hide();
				}
			});
		});
	})

    function buscarProyectoInversion()
    {
        var idFuncion = $("#selectFuncion").val();
        var idDivisionFuncional = $("#selectDivisionFuncional").val();
        var idGrupoFuncional = $("#selectGrupoFuncional").val();
        var idProvincia = $("#selectProvincia").val();
        var idDistrito = $("#selectDistrito").val();
        $.ajax({
            url: base_url +"index.php/Mo_MonitoreodeProyectos/consulta",
            type: 'POST',
            cache: false,
            data:
            {
                idFuncion: idFuncion,
                idDivisionFuncional : idDivisionFuncional,
                idGrupoFuncional: idGrupoFuncional,
                idProvincia:idProvincia,
                idDistrito:idDistrito
            },
            beforeSend: function()
            {
                renderLoading();
            },
            success: function (data)
            {
                $('#divModalCargaAjax').hide();

                $('#dataTableFuncion').html(data);
            },
            error: function ()
            {
                $('#divModalCargaAjax').hide();

                swal("Error","Ha ocurrido un error inesperado", "error");
            }
        });
    }

</script>