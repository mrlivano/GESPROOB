
<div class="right_col" role="main">
		 <div class="row" style="margin-left: 10px; margin:10px; ">
			 <div class="panel panel-default">
					  <div class="col-lg-12" style="margin-left: 250px;">
					      <input type="hidden" id="anio" name="anio" value="<?php echo $anio?>" class="form-control" placeholder="Ingrese código Unico"  >
					  </div>
			 </div>
		</div>							
</div>
<script>
function importar()
 		{
	 		var anio=document.getElementById("anio").value;
			paginaAjaxJSON({ "anio" : anio }, base_url+'index.php/ImporSeguimientoCertificado/importar', 'POST', null, function(objectJSON)
			{
				objectJSON=JSON.parse(objectJSON);

				swal(
				{
					title: 'Importacion Completada',
					text: objectJSON.mensaje,
					type: (objectJSON.proceso=='Correcto' ? 'success' : 'error') 
				},
				function(){
					window.close(); 
				});
			}, false, true);

 		}
$(document).ready(function() {
importar();
});
</script>

