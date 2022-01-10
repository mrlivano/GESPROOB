<form  id="form-darVistoBueno">
    <input type="hidden" id="id_et" name="id_et" value="<?= $expedienteVistoBueno->id_et?>">
    <div class="row" style="text-align: center;">
		<button  class="btn btn-success" id="btnEnviarFormulario" >	<i class="fa fa-thumbs-up"> si </i></button>  
		<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
	</div>
</form>

<script>
	$('#btnEnviarFormulario').on('click', function(event)
	{
		event.preventDefault();

		paginaAjaxJSON($('#form-darVistoBueno').serialize(), '<?=base_url();?>index.php/Expediente_Tecnico/vistoBueno', 'POST', null, function(objectJSON)
		{
			$('#modalTemp').modal('hide');

			objectJSON=JSON.parse(objectJSON);

			swal(
			{
				title: '',
				text: objectJSON.mensaje,
				type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
			},
			function()
			{
			});
		}, false, true);
	});
</script>