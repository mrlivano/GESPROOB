<div class="modal-body">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal " name="frmCriterio" id="frmCriterio" method="post"  enctype="multipart/form-data" onSubmit="return false;">
        <div class="item form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Factor: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
	       		<select id="cbx_idFactor" name="cbx_idFactor" class="selectpicker" style="width:100%;" title="Elija Factor"></select>
	       	</div>
	       	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Función: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
	       		<select id="cbx_idFuncion" name="cbx_idFuncion" class="selectpicker" style="width:100%;" title="Elija Función"></select>
	       	</div>
      	</div>
        <div class="item form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<input type="text" id="tx_nombre_criterio" name="tx_nombre_criterio" class="form-control" value="<?php if(isset($arrayCriterio->nombre_criterio)) echo $arrayCriterio->nombre_criterio;?>" />
            </div>
      	</div>
      	<div class="item form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Peso: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<input type="number" id="tx_peso_criterio" name="tx_peso_criterio" class="form-control" value="<?php if(isset($arrayCriterio->peso)) echo $arrayCriterio->peso;?>"  />
            </div>
      	</div>
      	<div class="item form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Definición: </label>
        	<div class="col-md-6 col-sm-6 col-xs-12">
        		<textarea id="tx_definicion_criterio" name="tx_definicion_criterio" class="form-control"><?php if(isset($arrayCriterio->definicion)) echo $arrayCriterio->definicion;?></textarea>
            </div>
      	</div>
        <div class="ln_solid"></div>
        <div class="form-group">
        	<div class="col-md-4 col-md-offset-8">
              <button class="btn btn-success" type="button" id="sendCriterio"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
              <button  data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
                Cancelar</button>
            </div>
      	</div>
        
      </form>
    </div>
  </div>
  	<?php
  	if(isset($arrayCriterio->id_criterio)){
  	?>
   <div class="row">
    	<div class="col-xs-12">
    		<div class="x_content">
    		<button type="button" class="btn btn-primary" data-toggle="modal" onclick=paginaAjaxDialogo('m_Valorizacion','Registrar&nbsp;valorizaci&oacute;n',{idCriterio:"<?php echo $arrayCriterio->id_criterio; ?>"},base_url+"index.php/criterio/itemValorizacion",'GET',null,null,false,true);><span class="fa fa-plus-circle"></span> Nuevo</button>
                <table id="table_valorizacionPtje" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
              		<thead style="background-color:#5A738E;color:#FFFFFF;">
                		<tr>
                  			
                  			<th >Nombre</th>
                  			<th style="width:100px;">Puntaje</th>
                            <th style="width:50px;"></th>
                		</tr>
              		</thead>
                </table>
            </div>
    	</div>
   </div>
   <?php
	}
   ?>
</div>
<script>
function listarValorizacionPtje(criterio){
	var table=$("#table_valorizacionPtje").DataTable({
		"processing":true,
		"serverSide":false,
		"destroy":true,
		"language":idioma_espanol,
		"bPaginate": false,
		"bFilter": false, //hide Search bar
    	"bInfo": false, // hide showing entries
		"ajax":{
			"url":base_url+"index.php/criterio/getValorizacionPtje/"+criterio,
			"method":"POST",
			"dataSrc":""
		},
		"columns":[
			{"data":"nombre_val"},
			{"data":"puntaje_val"},
			{"data":'nombre_val',render:function(data,type,row){
				    return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-primary btn-xs' data-toggle='modal' onclick=paginaAjaxDialogo('m_Valorizacion','Modificar&nbsp;valorizaci&oacute;n',{id_valorizacion:"+row.id_valorizacion+"},'"+base_url+"index.php/criterio/itemValorizacion','GET',null,null,false,true);><i class='ace-icon fa fa-pencil bigger-120'></i></button>";
				}
			}
		],
	}); 
}
function listarFactor(idFactor){
    event.preventDefault();
    var htmlTemp="";
    $("#cbx_idFactor").html(htmlTemp);
    $.ajax({
        "url":base_url +"index.php/criterio/getFactor",
        type:"POST",
        success:function(data){
            var registros = eval(data);
            for (var i=0; i<registros.length;i++){
            	if(idFactor!='' && idFactor==registros[i]["id_factor"])
                	htmlTemp+="<option selected='' value="+registros[i]["id_factor"]+">"+registros[i]["nombre_factor"]+"</option>";
                else
                	htmlTemp+="<option value="+registros[i]["id_factor"]+">"+registros[i]["nombre_factor"]+"</option>";
            }
            $("#cbx_idFactor").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh'); 
        }
    });
}
function listarFuncion(idFuncion){
    event.preventDefault();
    var htmlTemp="";
    $("#cbx_idFuncion").html(htmlTemp);
    $.ajax({
        "url":base_url +"index.php/Funcion/GetFuncion",
        type:"POST",
        success:function(data){
            var registros = eval(data);
            for (var i=0; i<registros.length;i++){
            	if(idFuncion!='' && idFuncion==registros[i]["id_funcion"])
                	htmlTemp+="<option selected='' value="+registros[i]["id_funcion"]+">"+registros[i]["nombre_funcion"]+"</option>";
                else
                	htmlTemp+="<option value="+registros[i]["id_funcion"]+">"+registros[i]["nombre_funcion"]+"</option>";
            }
            $("#cbx_idFuncion").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh'); 
        }
    });
}
$(function(){
	$("#frmCriterio").submit(function(event){
	    event.preventDefault();
	    $.ajax({
	      url:$(this).attr("action"),
	      type:$(this).attr('method'),
	      data:$(this).serialize(),
	      success:function(data){
	        if(data==true)
	          swal("","Se grabaron los datos!","success");
	        else
	          swal("","Error... no se grabaron los datos","error");
	        $('#table_criterio').dataTable()._fnAjaxUpdate();
	     }
	  });
	})
	$("body").on("click","#sendCriterio",function(e){
	  	$('#frmCriterio').data('formValidation').validate();
	  	if($('#frmCriterio').data('formValidation').isValid()==true){
	      $('#frmCriterio').submit();
	      $('#frmCriterio').each(function(){ 
	        this.reset();
	      });
	      $('.selectpicker').selectpicker('refresh');
	      $('#frmCriterio').data('formValidation').resetForm();
	      $('#frmCriterio').off();
	      $('#frmCriterio').remove();
	      $('#frmCriterio').empty();
	      $('#null').modal('hide');
	  }  
	});
})
$(document).ready(function(){
	<?php       
    if(isset($arrayCriterio->id_criterio)){
      ?>
      listarValorizacionPtje("<?php echo $arrayCriterio->id_criterio; ?>");
      listarFactor("<?php echo $arrayCriterio->id_factor; ?>");
      listarFuncion("<?php echo $arrayCriterio->id_funcion; ?>");
      $("#frmCriterio").attr("action",base_url+"index.php/criterio/updateCriterio/<?php echo $arrayCriterio->id_criterio; ?>");
      <?php
    }
    else{
      ?>
      //listarValorizacionPtje();
      listarFactor();
      listarFuncion();
      $("#frmCriterio").attr("action",base_url+"index.php/criterio/addCriterio");
      <?php
    }
  ?>
	
	$('#frmCriterio').formValidation({
      fields:{
      	cbx_idFactor:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Factor" es requerido.</b>'
            }
          }
        },
        cbx_idFuncion:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Función" es requerido.</b>'
            }
          }
        },
        tx_nombre_criterio:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Nombre de criterio" es requerido.</b>'
            }
          }
        },
        tx_peso_criterio:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Peso" es requerido.</b>'
            }
          }
        },
      }
    });
}); 
</script>