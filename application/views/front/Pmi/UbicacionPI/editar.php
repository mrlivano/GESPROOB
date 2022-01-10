<form class="form-horizontal " id="form_EditarUbigeo"   action="<?php echo base_url(); ?>bancoproyectos/ActualizarUbigeoPip" method="POST" >

                	<input id="txt_id_id_ubigeo_pi" name="txt_id_id_ubigeo_pi" class="form-control col-md-7 col-xs-12" value="<?= $detalleUbigeoPi->id_ubigeo_pi?>" type="hidden">

              		 <div class="item form-group">
                                   <div class="col-md-4">
                                           <label for="name">Departamento.<span class="required"></span>
                                            </label>
                                                 <select  class="selectpicker" disabled="disabled" id="txtDepartamento">
                                                    <option value="Apurímac">Apurímac</option>
                                                 </select>
                                    </div>

                                     <div class="col-md-4">
                                           <label for="name">Provincia.<span class="required"></span>
                                            </label>
                                               <select  id="cbx_provinciaEditar"  name="cbx_provinciaEditar" class="selectpicker"  title="Elija provincia(s)">
	                                             <?php foreach ($provincias as $itemp) {?>
		                                            	<option value="<?= $itemp->provincia ?>"  <?=($itemp->provincia==$UbicacionPipProvinciDistrito->provincia ? 'selected' : '')?> > <?= $itemp->provincia ?></option>
  												<?php } ?>	
                                               </select>
                                    </div>


                                     <div class="col-md-4">
                                           <label for="name">Distritos.<span class="required"></span>
                                            </label>
                                              <select name="cbx_distritoEditar" id="cbx_distritoEditar" data-live-search="true"  class="selectpicker" title="Elija distrito"></select>
                                    </div>
                                    <div class="col-md-3">
                                          <div class=".col-xs-3 .col-md-10">
                                          <br>
                                           <label for="name">Latitud<span class="required"></span>
                                            </label>
                                                  <input id="txt_latitud" name="txt_latitudEditar"  class="form-control col-md-1 col-xs-1" value="<?= $detalleUbigeoPi->latitud?>">
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                          <div class=".col-xs-3 .col-md-10">
                                          <br>
                                           <label for="name">Longitud<span class="required"></span>
                                            </label>
                                                  <input id="txt_longitud" name="txt_longitudEditar"  class="form-control col-md-1 col-xs-1" value="<?= $detalleUbigeoPi->longitud?>">
                                          </div>
                                    </div> 
                                    <div class="col-md-6">
                                          <div class=".col-xs-3 .col-md-10" style="margin-top: -5px;">
                                          <br>
                                           <label for="name"><br/>Adjuntar Imagen: <label style="color: red;">(Si se sube alguna imagen sustituye a la anterior imagen) </label><span class="required"></span>
                                            </label>
                                             <input type="file" name="ImgUbicacionEditar">

                                          </div>
                                    </div>    
                     		 </div>
                          <div class="col-md-3 col-sm-3 col-xs-12">
                            <label></label>
                            <button class="btn btn-primary form-control"  type="submit" style="margin-top: 5px;margin-left: 250px;" " > Guardar </button>
                          </div>
			</form>
<script type="text/javascript">

	    $('#txtDepartamento').selectpicker('refresh');
	    $('#cbx_provinciaEditar').selectpicker('refresh');

	    var distrito=$("#cbx_provinciaEditar").val();
	    var cbx_provinciaEditar=$("#cbx_provinciaEditar").val();
	
    		var html='';
            $("#cbx_distritoEditar").html(html);
            event.preventDefault();
            $.ajax({
                "url":base_url +"index.php/bancoproyectos/listar_distrito",
                type:"POST",
                data :{nombre_distrito:cbx_provinciaEditar},
                success:function(respuesta3){
                 var registros = eval(respuesta3);
                    for (var i = 0; i <registros.length;i++) {
                      html +="<option  value="+registros[i]["id_ubigeo"]+"  > "+registros[i]["distrito"]+" </option>";
                    };
                    var dynamicId='<?=$UbicacionPipProvinciDistrito->id_ubigeo?>';
                    $("#cbx_distritoEditar").html(html);
                     $('#cbx_distritoEditar > option[value='+dynamicId+']').attr('selected', 'selected');

                    $('#cbx_distritoEditar').selectpicker('refresh');
            	}
            });
       $( document ).ready(function() 
       {
			$("#form_EditarUbigeo").submit(function(event)
	    		{
	    			event.preventDefault();

					var formData=new FormData($("#form_EditarUbigeo")[0]);
			        $.ajax({
			            type:"POST",
			            enctype: 'multipart/form-data',
			            url:base_url+"index.php/bancoproyectos/Editar_ubigeo_proyecto",
			            data: formData,
			            cache: false,
			            contentType:false,
			            processData:false,
			            success:function(resp)
			            {

			            	swal("SE EDITO CORRECTAMENTE SU  REGISTRÓ ");
			            	 $('#2').modal('hide');   
			                $('#TableUbigeoProyecto_x').dataTable()._fnAjaxUpdate();
			                //formReset();
			                       
			            }
			        });
				
	         });  

			$( "#cbx_provinciaEditar" ).change(function() {
			  	var cbx_provinciaEditar=$("#cbx_provinciaEditar").val();
	
	    		var html='';
	            $("#cbx_distritoEditar").html(html);
	            event.preventDefault();
	            $.ajax({
	                "url":base_url +"index.php/bancoproyectos/listar_distrito",
	                type:"POST",
	                data :{nombre_distrito:cbx_provinciaEditar},
	                success:function(respuesta3){
	                 var registros = eval(respuesta3);
	                    for (var i = 0; i <registros.length;i++) {
	                      html +="<option  value="+registros[i]["id_ubigeo"]+"  > "+registros[i]["distrito"]+" </option>";
	                    };
	                    $("#cbx_distritoEditar").html(html);
	                    $('#cbx_distritoEditar').selectpicker('refresh');
	            	}
	            });
			});
      });   
	    
</script>