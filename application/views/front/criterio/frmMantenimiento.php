<div class="right_col" role="main">
	<div class="clearfix"></div>
  	<div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            	<h2>CRITERIOS DE PRIORIZACION</h2>
            	<div class="clearfix"></div>
          	</div>
            <div class="x_content">
				<div class="" role="tabpanel" data-example-id="togglable-tabs">
					<ul id="myTab" class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab_factor"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">Factor</a></li>
                        <li role="presentation"><a href="#tab_criterio"  role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Criterio</a></li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab_factor" aria-labelledby="profile-tab">
                            <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick=paginaAjaxDialogo('null','Registrar&nbsp;factor',{},base_url+"index.php/criterio/itemFactor",'GET',null,null,false,true);><span class="fa fa-plus-circle"></span> Nuevo</button>
                                        <div class="x_content">
                                            <table id="table_factor" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                          		<thead style="background-color:#5A738E;color:#FFFFFF;">
                                            		<tr>
                                              			<th >Factor</th>
                                                        <th style="width:50px;"></th>
                                            		</tr>
                                          		</thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab_criterio" aria-labelledby="profile-tab">
                            <div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="x_panel">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" onclick=paginaAjaxDialogo('null','Registrar&nbsp;criterio',{},base_url+"index.php/criterio/itemCriterio",'GET',null,null,false,true);><span class="fa fa-plus-circle"></span> Nuevo</button>
                                        <div class="x_content">
                                            <table id="table_criterio" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                          		<thead style="background-color:#5A738E;color:#FFFFFF;">
                                            		<tr>
                                              			<th style="width:20%;">Función</th>
                                                        <th style="width:20%;">Factor</th>
                                              			<th style="width:10%;">Peso</th>
                                              			<th >Criterio</th>
                                                        <th style="width:10%"></th>
                                            		</tr>
                                          		</thead>
                                                <tfoot>
                                                    <tr>
                                                        <th></th>
                                                        
                                                    </tr>
                                                </tfoot>
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
function listarFactor(){
	var table=$("#table_factor").DataTable({
		"processing":true,
		"serverSide":false,
		"destroy":true,
		"language":idioma_espanol,
		"ajax":{
			"url":base_url+"index.php/criterio/getFactor",
			"method":"POST",
			"dataSrc":""
		},
		"columns":[
			{"data":"nombre_factor"},
			{"data":'nombre_factor',render:function(data,type,row){
				    return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-primary btn-xs' data-toggle='modal' onclick=paginaAjaxDialogo('null','Modificar&nbsp;factor',{id_factor:"+row.id_factor+"},'"+base_url+"index.php/criterio/itemFactor','GET',null,null,false,true);><i class='ace-icon fa fa-pencil bigger-120'></i></button>";
				}
			}
		],
	}); 
}
function listarCriterio(){
	var table=$("#table_criterio").DataTable({
		"processing":true,
		"serverSide":false,
		"destroy":true,
		"language":idioma_espanol,
		"ajax":{
			"url":base_url+"index.php/criterio/getCriterio",
			"method":"POST",
			"dataSrc":""
		},
		"columns":[
			{"data":"nombre_funcion"},
            {"data":"nombre_factor"},
			{"data":"denPeso"},
			{"data":"nombre_criterio"},
			{"data":'nombre_criterio',render:function(data,type,row){
				    return "<button type='button'  data-toggle='tooltip'  class='editar btn btn-primary btn-xs' data-toggle='modal' onclick=paginaAjaxDialogo('null','Modificar&nbsp;criterio',{id_criterio:"+row.id_criterio+"},'"+base_url+"index.php/criterio/itemCriterio','GET',null,null,false,true);><i class='ace-icon fa fa-pencil bigger-120'></i></button>";
				}
			}
		],
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
	}); 
}
$(function(){
	
}); 
$(document).ready(function(){
	listarFactor();
    listarCriterio();
}); 
</script>