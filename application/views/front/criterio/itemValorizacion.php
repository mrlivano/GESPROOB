<div class="modal-body">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal " name="frmValorizacion" id="frmValorizacion" method="post"  enctype="multipart/form-data" onSubmit="return false;">
        <div class="item form-group">
        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<input type="text" id="tx_nombre_valorizacion" name="tx_nombre_valorizacion" class="form-control" value="<?php if(isset($arrayValorizacion->nombre_val)) echo $arrayValorizacion->nombre_val;?>" />
            </div>
      	</div>
      	<div class="item form-group">

        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Puntaje: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<input type="text" id="tx_puntaje_valorizacion" name="tx_puntaje_valorizacion" class="form-control" value="<?php if(isset($arrayValorizacion->puntaje_val)) echo $arrayValorizacion->puntaje_val;?>" />
            </div>
      	</div>
        <div class="ln_solid"></div>
        <div class="form-group">
        	<div class="col-md-4 col-md-offset-8">
              <button class="btn btn-success" type="button" id="sendValorizacion"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
              <button  data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
                Cancelar</button>
            </div>
      </div>
        
      </form>
    </div>
  </div>
</div>
<script>
$(function(){
	$("#frmValorizacion").submit(function(event){
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
	        $('#table_valorizacionPtje').dataTable()._fnAjaxUpdate();
	     }
	  });
	})
	$("body").on("click","#sendValorizacion",function(e){
	  	$('#frmValorizacion').data('formValidation').validate();
	  	if($('#frmValorizacion').data('formValidation').isValid()==true){
	      $('#frmValorizacion').submit();
	      $('#frmValorizacion').each(function(){ 
	        this.reset();
	      });
	      $('.selectpicker').selectpicker('refresh');
	      $('#frmValorizacion').data('formValidation').resetForm();
	      $('#frmValorizacion').off();
	      $('#frmValorizacion').remove();
	      $('#frmValorizacion').empty();
	      $('#m_Valorizacion').modal('hide');
	  }  
	});
})
$(document).ready(function(){
	<?php       
    if(isset($arrayValorizacion->id_valorizacion)){
      ?>
      $("#frmValorizacion").attr("action",base_url+"index.php/criterio/updateValorizacion/<?php echo $arrayValorizacion->id_valorizacion; ?>");
      <?php
    }
    else{
      ?>
      $("#frmValorizacion").attr("action",base_url+"index.php/criterio/addValorizacion/<?php echo $idCriterio; ?>");
      <?php
    }
  	?>
	
	$('#frmValorizacion').formValidation({
      fields:{
      	tx_nombre_valorizacion:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
            }
          }
        },
        tx_puntaje_valorizacion:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Puntaje" es requerido.</b>'
            }
          }
        },
      }
    });
}); 
</script>