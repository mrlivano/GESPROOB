
<div class="right_col" role="main">
		 <div class="row" style="margin-left: 10px; margin:10px; ">
			 <div class="panel panel-default">
					  <div class="col-lg-12" style="margin-left: 250px;">
						        <h3><?php echo $mensaje; ?></h3>
				    	<!--   <input type="hidden" id="proyectoSnip" name="proyectoSnip" value="<?php echo $CodigoUnico; ?>" class="form-control" placeholder="Ingrese código Unico"  > -->
				       </div>
			 </div>
		</div>
</div>
<!-- <script>
$(document).ready(function() {
 		importar();//importacion carpeta
});
 function importar()
 		{
	 		var CodigoUnico=document.getElementById("proyectoSnip").value;
			/*if(!confirm(' Actualizar . ¿Realmente desea proseguir con la operaición?')){return;}*/

			paginaAjaxJSON({ "CodigoUnico" : CodigoUnico }, base_url+'index.php/Importacion/importar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: '',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
				},
				function(){
					window.close();
				});


			}, false, true);

 		}

</script> -->

