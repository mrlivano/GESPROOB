<div class="modal-body">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal " name="frmFactor" id="frmFactor" method="post"  enctype="multipart/form-data" onSubmit="return false;">
        <div class="item form-group">

        	<label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre: <span class="required">*</span></label>
        	<div class="col-md-3 col-sm-3 col-xs-12">
            	<input type="text" id="tx_nombre_factor" name="tx_nombre_factor" class="form-control" value="<?php if(isset($arrayFactor->nombre_factor)) echo $arrayFactor->nombre_factor;?>" />
            </div>
      	</div>
        <div class="ln_solid"></div>
        <div class="form-group">
        	<div class="col-md-4 col-md-offset-8">
              <button class="btn btn-success" type="button" id="sendFactor"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
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
  $("#frmFactor").submit(function(event){
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
        $('#table_factor').dataTable()._fnAjaxUpdate();
     }
  });
  })
  $("body").on("click","#sendFactor",function(e){
      $('#frmFactor').data('formValidation').validate();
      if($('#frmFactor').data('formValidation').isValid()==true){
        $('#frmFactor').submit();
        $('#frmFactor').each(function(){ 
          this.reset();
        });
        $('#frmFactor').data('formValidation').resetForm();
        $('#frmFactor').off();
        $('#frmFactor').remove();
        $('#frmFactor').empty();
        $('#null').modal('hide');
    }  
  });
}); 
$(document).ready(function(){
  <?php       
    if(isset($arrayFactor->id_factor)){
      ?>
      $("#frmFactor").attr("action",base_url+"index.php/criterio/updateFactor/<?php echo $arrayFactor->id_factor; ?>");
      <?php
    }
    else{
      ?>
      $("#frmFactor").attr("action",base_url+"index.php/criterio/addFactor");
      <?php
    }
  ?>
	$('#frmFactor').formValidation({
      fields:
      {
        tx_nombre_factor:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Nombre de factor" es requerido.</b>'
            }
          }
        },
      }
    });
}); 
</script>