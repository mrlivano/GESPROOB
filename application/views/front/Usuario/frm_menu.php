<div class="right_col" role="main">
  <div class="clearfix"></div>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
              <h2>MENU</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
        <div class="" role="tabpanel" data-example-id="togglable-tabs">
          <ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_menu"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">Menú</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_factor" aria-labelledby="profile-tab">
                            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick=paginaAjaxDialogo('null','Registrar&nbsp;menu',{},base_url+"index.php/Menu/itemMenu",'GET',null,null,false,true);><span class="fa fa-plus-circle"></span> Nuevo</button>
                                        <div class="x_content">
                                            <table id="table_menu" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                              <thead style="background-color:#5A738E;color:#FFFFFF;">
                                                <tr>

                                                    <th >Módulo</th>
                                                    <th >Menú</th>
                                                    <th >URL</th>
                                                        <th style="width:50px;"></th>
                                                </tr>
                                              </thead>
                                            </table>
                                        </div>
                                    </div>
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
function listarMenu(){
  var table=$("#table_menu").DataTable({
    "processing":true,
    "serverSide":false,
    "destroy":true,
    "language":idioma_espanol,
    "ajax":{
      "url":base_url+"index.php/Menu/getMenu",
      "method":"POST",
      "dataSrc":""
    },
    "columns":[

      {"data":"id_modulo"},
       {"data":"nombre"},
        {"data":"url"},
      {"data":'nombre',render:function(data,type,row){
            return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-primary btn-xs' data-toggle='modal' onclick=paginaAjaxDialogo('null','Modificar&nbsp;menu',{id_menu:"+row.id_menu+"},'"+base_url+"index.php/Menu/itemMenu','GET',null,null,false,true);><i class='ace-icon fa fa-pencil bigger-120'></i></button>";
        }
      }
    ],
  });
}
$(function(){

});
$(document).ready(function(){
  listarMenu();
});
</script>
<script src="<?php echo base_url();?>assets/js/Helper/jsHelper.js"></script>
