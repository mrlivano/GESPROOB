
<div class="modal-body">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal " name="frmMenu" id="frmMenu" method="post"  enctype="multipart/form-data" onSubmit="return false;">
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nivel: <span class="required">*</span></label>
          <div class="col-md-3 col-sm-3 col-xs-12 ">
            <select id="cbx_nivel" name="cbx_nivel" class="selectpicker" style="width:100%;" title="Elija Nivel">
              <option <?php if(isset($arrayMenu->nivel) and trim($arrayMenu->nivel)=='2') echo "selected"?> value="2">Menú</option>
              <option <?php if(isset($arrayMenu->nivel) and trim($arrayMenu->nivel)=='3') echo "selected"?> value="3">Submenú</option>
            </select>
          </div>
        </div>
        <div class="item form-group">
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Nombre menú: <span class="required">*</span></label>
          <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" id="tx_nombre" name="tx_nombre" class="form-control" value="<?php if(isset($arrayMenu->nombre)) echo $arrayMenu->nombre;?>"  />
            </div>
            <div id="ct_menuPadre">
          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Menú Padre: </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select id="cbx_menuPadre" name="cbx_menuPadre" class="selectpicker" style="width:100%;" title="Elija Menú Padre"></select>
          </div>
        </div>


      	</div>
         <div class="item form-group">

          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">URL: </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" id="tx_url" name="tx_url" class="form-control" value="<?php if(isset($arrayMenu->url)) echo $arrayMenu->url;?>"  />
            </div>
            <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Módulo: <span class="required">*</span></label>
          <div class="col-md-3 col-sm-3 col-xs-12">
            <select id="cbx_modulo" name="cbx_modulo" class="selectpicker" style="width:100%;" title="Elija Módulo">
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='PMI') echo "selected"?> value="PMI">PMI</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='FE') echo "selected"?> value="FE">FORMULACION Y EVALUACION</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='E') echo " selected "?> value="E">EJECUCION</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='SM') echo "selected"?> value="SM">SEGUIMIENTO Y MONITOREO</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='R') echo "selected"?> value="R">REPORTES</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='M') echo "selected"?> value="M">MANTENIMIENTO DE PARAMETROS</option>
              <option <?php if(isset($arrayMenu->id_modulo) and trim($arrayMenu->id_modulo)=='U') echo "selected"?> value="U">USUARIOS</option>
            </select>
          </div>

        </div>
         <div class="item form-group">

          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Icono: </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="text" id="tx_class_icono" name="tx_class_icono" class="form-control" value="<?php if(isset($arrayMenu->class_icono)) echo $arrayMenu->class_icono;?>"  />
            </div>


        </div>
         <div class="item form-group">

          <label class="control-label col-md-2 col-sm-2 col-xs-12" for="name">Posición: </label>
          <div class="col-md-3 col-sm-3 col-xs-12">
              <input type="number" id="tx_posicion" name="tx_posicion" class="form-control" value="<?php if(isset($arrayMenu->posicion)) echo $arrayMenu->posicion;?>"  />
            </div>
        </div>
        <div class="ln_solid"></div>
        <div class="form-group">
        	<div class="col-md-4 col-md-offset-8">
              <button class="btn btn-success" type="button" id="sendMenu"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
              <button  data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
                Cancelar</button>
            </div>
      </div>

      </form>
    </div>
  </div>
</div>
<script>
  function listarMenuPadre(idMenu){
    event.preventDefault();
    var htmlTemp="";
    $("#cbx_menuPadre").html(htmlTemp);
    $.ajax({
        "url":base_url +"index.php/menu/getMenu",
        type:"POST",
        success:function(data){
            var registros = eval(data);
            for (var i=0; i<registros.length;i++){
              if(idMenu!='' && idMenu==registros[i]["id_menu"])
                  htmlTemp+="<option selected='' value="+registros[i]["id_menu"]+">"+registros[i]["nombre"]+"</option>";
                else
                  htmlTemp+="<option value="+registros[i]["id_menu"]+">"+registros[i]["nombre"]+"</option>";
            }
            $("#cbx_menuPadre").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }
    });
}
$(function(){
  $("#frmMenu").submit(function(event){
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
        $('#table_menu').dataTable()._fnAjaxUpdate();
     }
  });
  })
  $("body").on("click","#sendMenu",function(e){
      $('#frmMenu').data('formValidation').validate();
      if($('#frmMenu').data('formValidation').isValid()==true){
        $('#frmMenu').submit();
        $('#frmMenu').each(function(){
          this.reset();
        });
        $('#frmMenu').data('formValidation').resetForm();
        $('#frmMenu').off();
        $('#frmMenu').remove();
        $('#frmMenu').empty();
        $('#null').modal('hide');
    }
  });
  $("body").on("change","#cbx_nivel",function(e){
    if($("#cbx_nivel").val()=='2'){
      $("#ct_menuPadre").css("display","none");
    }
    else{
      $("#ct_menuPadre").css("display","");
    }
  });
});
$(document).ready(function(){

    <?php
    if(isset($arrayMenu->id_menu)){
    ?>
          listarMenuPadre("<?php echo $arrayMenu->id_menu_padre; ?>");
      $("#frmMenu").attr("action",base_url+"index.php/menu/updateMenu/<?php echo $arrayMenu->id_menu; ?>");
      <?php
    }
    else{
      ?>

       listarMenuPadre();
      $("#frmMenu").attr("action",base_url+"index.php/menu/addMenu");
      <?php
    }
  ?>
	$('#frmMenu').formValidation({
      fields:
      {
        tx_nombre:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Nombre de menu" es requerido.</b>'
            }
          }
        },
        cbx_modulo:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Módulo" es requerido.</b>'
            }
          }
        },
        cbx_nivel:{
          validators:{
            notEmpty:{
              message: '<b style="color: red;">El campo "Nivel" es requerido.</b>'
            }
          }
        },

      }
    });
});
</script>
