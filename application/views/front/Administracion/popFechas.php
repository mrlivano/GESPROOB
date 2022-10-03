<div class="right_col" role="main">
	<div class="x_panel">
		<div class="x_content">   
			<form class="form-horizontal" id="frmInformeMensual" method="POST" target="_blank">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<input type="hidden" name="hdIdExpedienteTecnico" id="hdIdExpedienteTecnico" value="<?=@$idEt?>">
						<div class="row" id="divBusquedaInforme">	
							
						<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="control-label">Mes:</label>
								<div>
									<input type="hidden" id="hdMes" name="hdMes">								
									<select id="selectMes" name="selectMes" class="form-control">
										<?php foreach($listaPlazo as $key => $value) { ?>
										<option value="<?=$value->num?>"><?=$mes[$value->num]?></option>
										<?php } ?>
									</select>
								</div>	
							</div>	
							
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="control-label">Año:</label>
								<div>
								<select id="selectAnio" name="selectAnio" class="form-control">
									<?php foreach($listaPlazo as $key => $value) { ?>
									<option value="<?=$value->anio?>"><?=$value->anio?></option>
									<?php } ?>
								</select>
								</div>	
							</div>
							
							<div class="col-md-4 col-sm-4 col-xs-12">
								<label class="control-label">.</label>
								<div>       
									<input style="width:100%;" class="btn btn-default" onclick="guardarCierreMes();" value="Cerrar Mes">
								</div>		
							</div>	
						</div>
					</div>
				</div>
			</form>
			<br>
			<div class="table-responsive">
				<div id="contenedorManifiestoGasto"></div>
			</div>
		</div>
	</div>
</div>
<script>
    $(function()
    {
        $('#divBusquedaInforme').formValidation(
        {
            framework: 'bootstrap',
            excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
            live: 'enabled',
            message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
            trigger: null,
            fields:
            {
							selectAnio:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Año" es requerido.</b>'
                        }
                    }
                },
                selectMes:
                {
                    validators: 
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo "Mes" es requerido.</b>'
                        }
                    }
                }
            }
        }); 

        $("#selectMes").change(function()
		{
			var mes=$(this).find("option:selected").text();
			$('#hdMes').val(mes);
		});             
    });

    function guardarCierreMes()
    {
        event.preventDefault();
        $('#divBusquedaInforme').data('formValidation').validate();
		if(!($('#divBusquedaInforme').data('formValidation').isValid()))
		{
			return;
		}

		swal(
	{
		title: "Confirmación",
		text: "Realmente desea realizar esta operación",
		type: "info",
		showCancelButton: true,
		confirmButtonClass: "btn-danger",
		confirmButtonText: "Consentir proceso",
		cancelButtonText: "Cerrar",
		closeOnConfirm: false
	},
	function(isConfirm)
	{
		if(isConfirm)
		{
			var idExpedienteTecnico=$('#hdIdExpedienteTecnico').val();
			var anio=$('#selectAnio').val();
			var mes=$('#selectMes').val();
			var hdMes=$('#hdMes').val();
	
      $.ajax({
            type:"POST",
            url:base_url+"index.php/Proyectos/fechas",
            data: 
				{
				idExpedienteTecnico:idExpedienteTecnico,
				anio:anio,
				mes:mes,
        hdMes:hdMes
				},
            cache: false,
        beforeSend:function() 
				{
            	renderLoading();
		    },
        success:function(resp)
            {
				$('#divModalCargaAjax').hide();
				$(".modal-header .close").click();
				resp =JSON.parse(resp);
				swal(resp.proceso, resp.mensaje, (resp.proceso=='Correcto' ? 'success' : 'error'));
			},
			error:function ()
			{
				swal("Error", "Ha ocurrido un error inesperado", "error")
				$('#divModalCargaAjax').hide();
			}
        });
		}
	});
			
    }
</script>

