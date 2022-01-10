<style>
  #table_proyecto>tbody>tr>td:nth-child(0n+3)
  {
    text-align: right;
  }
</style>
<div class="right_col" role="main">
	<div class="clearfix"></div>
  	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            	<h2>ESTABLECER PRIORIDAD</h2>
            	<div class="clearfix"></div>
          	</div>
            <div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_proyecto"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">Proyectos</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_proyecto" aria-labelledby="profile-tab">
                            <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <table id="table_proyecto" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                          		<thead style="background-color:#5A738E;color:#FFFFFF;">
                                            		<tr>
                                                        <th style="width:60px;">Código</th>
                                              			<th >Nombre del Proyecto</th>
                                                        <th style="width:100px; text-align: right;">Costo</th>
                                                        <th style="width:100px;">Función</th>
                                                        <th style="width:100px;">Estado Ciclo</th>
                                                        <th style="width:30px;"></th>
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
function guardarPrioridad(id_proyecto){
  var c=0;
  var arrayValorizacion=new Array();
  $("#frmPrioridad :input[name*='tx_peso_']").each(function(){
    var criterio=(($(this).attr("id")).split('tx_peso_'))[1];
    arrayValorizacion[c]=[$('input:radio[name=rb_'+criterio+']:checked').val(),$("#tx_ptje_"+criterio).val(),$("#tx_peso_"+criterio).val()];
    c++;
  });
  var formData={id_proyecto:id_proyecto,arrayValorizacion:arrayValorizacion};  
  $.ajax({
      url:base_url+"index.php/criterio/addPrioridad",
      type:"POST",
      data:formData,
      dataType:'json',
      success:function(data){
        if(data==true)
          swal("","Se grabaron los datos!","success");
        else
          swal("","Error... no se grabaron los datos","error");
      }
  });
}
function total(){
    var total=0;
    $("#frmPrioridad :input[name*='tx_peso_']").each(function(){
      if($(this).val()!='')
        total=total+parseFloat($(this).val());
    });
    $("#tx_ptjeTotal").val(total.toFixed(2));
}
function puntaje(id,valor,peso){
    $("#tx_ptje_"+id).val(valor);
    $("#tx_peso_"+id).val(valor*peso/100);
    total();
}
function listarProyectos(){
	var table=$("#table_proyecto").DataTable({
		"processing":true,
		"serverSide":false,
		"destroy":true,
		"language":idioma_espanol,
		"ajax":{
			"url":base_url+"index.php/bancoproyectos/GetProyectoInversion",
			"method":"POST",
			"dataSrc":""
		},
		"columns":[
            {"data":"codigo_unico_pi"},
            {"data":"nombre_pi"},
            {"data":"costo_pi"},
            {"data":"nombre_funcion"},
            {"data":"nombre_estado_ciclo"},
			{"data":'nombre_pi',render:function(data,type,row){
                return "<button title='ESTABLECER PRIORIDAD' type='button'  data-toggle='tooltip'  class='editar btn btn-success btn-xs' data-toggle='modal' onclick=paginaAjaxDialogo('null','Prioridad',{id_proyecto:"+row.id_pi+",id_funcion:"+row.id_funcion+"},'"+base_url+"index.php/criterio/itemPrioridad','GET',null,null,false,true);><i class='ace-icon fa fa-list-ol bigger-120'></i></button>";
				}
			}
		],
	}); 
}
$(function(){

}); 
$(document).ready(function(){
	listarProyectos();
}); 
</script>