
<style>
  .dropdown-submenu {
    position: relative;
}

.dropdown-submenu .dropdown-menu {
    left: 100%;

}
.dropdown:hover {
}
.trElement li
{
  list-style:none;
   border: 1px solid #D8D8D8;
   padding-top: 6px;
   padding-left: 5px;
  padding-bottom: 5px;
  background-color: #fdfdfd;
}
.trElement li:hover {
  background: #f9f9f9;
}
.nivel
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 10px;
    font-weight: 100;
	line-height:1.4;
 }
 .partida
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 9px;
    font-weight: 100;
	padding: 0px !important;
	
 }
 .right
{
	text-align: right;
 }
 .center
{
	text-align: center;
 }
 .title
{
  color: red;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 10px;
    font-weight: 400;
	padding: 0px !important;
 }
 ul{
  padding-left: 30px;
  padding-top: 0px;
  padding-bottom: 0px;

 }
.btnf{
    padding-top: 1px;
    border-top-width: 0px;
    border-bottom-width: 0px;
    padding-bottom: 1px;
    font-size: 11px;
 }
 .btnm{
    padding-right: 2px;
    padding-left: 2px;
    background-color: transparent;
 }
 .all 
    {
      margin-bottom: 0;
      margin-right: 0;
      width: 100%;
    }
.colPage1 
    {
      margin-bottom: 0;
      margin-right: 0;
	  padding : 0;
      width: 30%;
	  height :100%
    }
.colPage2 
    {
      margin-bottom: 0;
      margin-right: 0;
	  padding : 0;
      width: 70%;
	  height :100%;
    }
.subpresupuesto{
	padding:0 !important;
}
.ocultar{
display:none;
}
.mostrar{
display:block;
}
.detPage1{
	margin: 10px;
    font-size: 8px;
    line-height: 0.4;
    font-weight: 100 !important;
}
.head{
	background: rgba(52,73,94,0.94);
    color: #ECF0F1;
	margin: 0;
    padding: 10px 0;
}
.select{
	background: moccasin !important;
}
.space{
	margin-right: 10px;
    margin-left: 10px;
}
</style>
<div class="right_col" role="main">
	<div>
		<div class="clearfix"></div>
		<div class="col-md-12 col-xs-12 col-xs-12">
			<div class="x_panel">
				<div class="x_title">
					<h2><b>PRESUPUESTOS</b></h2>
					<div class="clearfix"></div>
				</div>
				<div class="item form-group">
					<label class="control-label col-md-1 col-sm-1 col-xs-1">Proyectos:</label>
					<div class="col-md-11 col-sm-11 col-xs-11">
						<select id="listaProyectoBD"  class="selectpicker show-tick form-control" data-live-search="true">
							<option value="0" selected="true" disabled>Seleccione</option>
						<?php foreach ($listaBds10 as $row) { ?>
							<option value="<?=trim($row->CodigoUnico)?>" <?php echo (trim($codigo)==trim($row->CodigoUnico) ? 'selected' : ''); ?> ><?=$row->CodigoUnico?> - <?=$row->Proyecto?></option>
						<?php  } ?>
						</select>
					</div>
                </div>


				<div class="x_content">
					<div class="row">
                    
					<div class="col-md-2 col-sm-2 col-xs-2 colPage1">
					<h6 class="center head" style="margin-left:10px !important">Presupuestos</h6>
						<div  style="height: 450px;overflow: scroll; background-color: transparent;"><ul class="trElement" style="padding-left: 10px;">
                     </ul></div>
                  </div>
				  <div class="col-md-10 col-sm-10 col-xs-10 colPage2">
				  		<h6 class="center head">Hoja de Presupuesto</h6>
						<div id="hojaPresupuesto" style="height: 250px;overflow: scroll; background-color: transparent;"></div>
						<div id="descripcioHojaPresupuesto" style="background-color: transparent;"></div>
						<div id="costoUnitario" style="height: 114px;overflow: scroll; background-color: transparent;"></div>
                  </div>
				</div>
				</div>
				
			</div>
		</div>
	</div>
</div>
<!--Modal Meta Oficina-->
<div class="modal fade" id="VentanaPresupuestoDesc" role="dialog">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
				<span id="nameProy"></span>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<ul id="myTab" class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active">
						<a href="#tab_general"  id="home-tab" role="tab" data-toggle="tab" >GENERAL</a>
					</li>
					<li role="presentation">
						<a href="#tab_moneda"  id="profile-tab" role="tab" data-toggle="tab" aria-expanded="false">MONEDA PRINCIPAL</a>
					</li>
				</ul> 
			<!--General</h4-->
			<div id="myTabContent" class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="tab_general" aria-labelledby="home-tab">
									<div class="form-horizontal" id="form-MetaOficina">
											<div class="row space space">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Codigo :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<label class="control-label" id="txtCodigo" name="txtCodigo"></label>
												</div>	
											</div>
											<div class="row space">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Descripcion :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<label class="control-label" id="txtDescripcion" name="txtDescripcion" style="text-align: justify;"></label>
												</div>	
											</div>
											<div class="row space">
												<div class="col-md-3 col-sm-3 col-xs-3">
													<label class="control-label">Cliente :</label>
												</div>
												<div class="col-md-8 col-sm-9 col-xs-9">
													<label class="control-label" id="txtCliente" name="txtCliente" style="text-align: justify;"></label>
												</div>	
											</div>
											<div class="row space">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Lugar :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<label class="control-label" id="txtLugar" name="txtLugar"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Fecha :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<label class="control-label" id="txtFecha" name="txtFecha"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Plazo :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<label class="control-label" id="txtPlazo" name="txtPlazo"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Jornada :</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<label class="control-label" id="txtJornada" name="txtJornada"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-3 col-sm-3 col-xs-3">
												<label class="control-label">Fecha Proceso	:</label>
											</div>
											<div class="col-md-8 col-sm-9 col-xs-9">
												<label class="control-label" id="txtFecha_Proceso" name="txtFecha_Proceso"></label>
											</div>	
										</div>  
									</div>            
									
								</div>
								<div role="tabpanel" class="tab-pane fade" class="control-label" id="tab_moneda" aria-labelledby="home-tab">
									<div class="form-horizontal" id="form-MetaOficina">
											<div class="row space">
												<div class="col-md-5 col-sm-5 col-xs-5">
													<label class="control-label">Costo Directo Base S/ :</label>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-7">
													<label class="control-label" id="txtCosto_Directo_Base" name="txtCosto_Directo_Base"></label>
												</div>	
											</div>
											<div class="row space">
												<div class="col-md-5 col-sm-5 col-xs-5">
													<label class="control-label">Costo Indirecto Base S/ :</label>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Indirecto_Base" name="txtCosto_Indirecto_Base"></label>
												</div>	
											</div>
											<div class="row space">
												<div class="col-md-5 col-sm-5 col-xs-5">
													<label class="control-label">Costo Base S/ :</label>
												</div>
												<div class="col-md-7 col-sm-7 col-xs-7">
													<label class="control-label" id="txtCosto_Base" name="txtCosto_Base"></label>
												</div>	
											</div>
											<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Directo Oferta S/ :</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Directo_Oferta" name="txtCosto_Directo_Oferta"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Indirecto Oferta S/ :</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Indirecto_Oferta" name="txtCosto_Indirecto_Oferta"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Oferta S/ :</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Oferta" name="txtCosto_Oferta"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Directo Oferta Total S/ :</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Directo_Oferta_Total" name="txtCosto_Directo_Oferta_Total"></label>
											</div>	
										</div>
										<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Indirecto Oferta Total S/	:</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Indirecto_Oferta_Total" name="txtCosto_Indirecto_Oferta_Total"></label>
											</div>	
										</div>  
										<div class="row space">
											<div class="col-md-5 col-sm-5 col-xs-5">
												<label class="control-label">Costo Oferta Total S/	:</label>
											</div>
											<div class="col-md-7 col-sm-7 col-xs-7">
												<label class="control-label" id="txtCosto_Oferta_Total" name="txtCosto_Oferta_Total"></label>
											</div>	
										</div> 
									</div>            
									
								</div>

						</div>
				<div class="row" style="text-align: right; padding-top:10px">
					<button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
		</div>
		
	</div>
<!-- mondal end-->
<script>
	var presupuesto=[];
	let elementHojaPresupuesto=[];
	let presupuestoSelect = "";
	let hojaPresupuestoSelect = "";
	$(document).ready(function (e) {
		var ue=$('select[id=listaProyectoBD]');
		var maxLength = 130;
		$('#listaProyectoBD > option').text(function(i, text) {
			if (text.length > maxLength) {
				return text.substr(0, maxLength) + '...';  
			}
		});
		if(ue.val()!==null){mostrarPresupuesto(ue.val(),ue);}
  $('#VentanaPresupuestoDesc').on('show.bs.modal', function(e) { 
     var id = $(e.relatedTarget).data().id;
     var denom = $(e.relatedTarget).data().denom;
	 var proyecto=$("#listaProyectoBD :selected").text();
	 $(e.currentTarget).find('#nameProy').text(proyecto);
      const result=presupuesto.find(element => element.Codigo==id);
      	$(e.currentTarget).find('#txtCodigo').text(result.Codigo);
		$(e.currentTarget).find('#txtCliente').text(result.Cliente);
		$(e.currentTarget).find('#txtCosto_Base').text(Number(parseFloat(result.Costo_Base)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Directo_Base').text(Number(parseFloat(result.Costo_Directo_Base)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Directo_Oferta').text(Number(parseFloat(result.Costo_Directo_Oferta)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Directo_Oferta_Total').text(Number(parseFloat(result.Costo_Directo_Oferta_Total)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Indirecto_Base').text(Number(parseFloat(result.Costo_Indirecto_Base)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Indirecto_Oferta').text(Number(parseFloat(result.Costo_Indirecto_Oferta)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Indirecto_Oferta_Total').text(Number(parseFloat(result.Costo_Indirecto_Oferta_Total)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Oferta').text(Number(parseFloat(result.Costo_Oferta)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtCosto_Oferta_Total').text(Number(parseFloat(result.Costo_Oferta)).toLocaleString('en-US'));
		$(e.currentTarget).find('#txtDescripcion').text(result.Descripcion);
		$(e.currentTarget).find('#txtFecha').text(result.Fecha);
		$(e.currentTarget).find('#txtFecha_Proceso').text(result.Fecha_Proceso);
		$(e.currentTarget).find('#txtJornada').text(result.Jornada);
		$(e.currentTarget).find('#txtLugar').text(result.Lugar);
		$(e.currentTarget).find('#txtPlazo').text(result.Plazo);
  });
});
	
	 function mostrarPresupuesto(CodigoUnico,element){
	$('#hojaPresupuesto').html('');
	$('#descripcioHojaPresupuesto').html('');
	$('#costoUnitario').html('');
    $.ajax(
		{
			type: "POST",
			url: base_url+"index.php/Expediente_Tecnico/listarBds10",
			cache: false,
			data: { CodigoUnico: CodigoUnico},
			success: function(resp)
			{
				var obj=JSON.parse(resp);
				presupuesto=obj;
				if(obj.length==0)
				{
					$(element).parent().parent().parent().parent().parent().find('.trElement').html('No ....');
					return false;
				}
			
				var htmlTemp='';
			
				for(var i=0; i<obj.length; i++)
				{
					if(obj[i].SubPresupuesto == "subpresupuesto")
					{
					htmlTemp+='<li>'+
					'<div style=""><i  class="elegir btn-xs fa"  style="margin-right: 8px;"></i></div>'+
							'<div class="nivel"><a href="" class="nivel" data-toggle="modal" data-target="#VentanaPresupuestoDesc" data-id=\''+obj[i].Codigo+'\'  data-denom=\''+obj[i].Descripcion+'\'>'+obj[i].Descripcion+'</a>'+     
							"</div>"+
					'</li>';
					}
					else
					{
					htmlTemp+='<li >'+
					'<div style="display: inline-flex; width: 6%;"><i  class="elegir btn btnm btn-xs fa fa-chevron-right" id="btnAccion" name="Accion" value="+" onclick="elegirAccion(this);"></i></div>'+  
							'<div class="nivel" style="display: inline-flex; width: 94%;><a href="" class="nivel" data-toggle="modal" data-target="#VentanaPresupuestoDesc" data-id=\''+obj[i].Codigo+'\'  data-denom=\''+obj[i].Descripcion+'\'>'+obj[i].Descripcion+'</a>'+       
							"</div><ul class='ocultar'>";
					for(var j=0; j<obj[i].SubPresupuesto.length; j++){
						htmlTemp+='<li onclick="hojaPresupuesto(\''+CodigoUnico+'\',\''+obj[i].Codigo+'\',\''+obj[i].SubPresupuesto[j].CodSubpresupuesto+'\', this);" class="subpresupuesto">'+
					'<i  class="elegir btn-xs fa fa-file-text-o"  style="margin-right: 2px;"></i>'+
							'<a class="nivel">'+obj[i].SubPresupuesto[j].Descripcion+"</a>"+     
							"</div>"+
					'</li>';
					}
					htmlTemp+='</ul></li>';
					}       
				}

			htmlTemp+='';
			$(element).parent().parent().parent().parent().parent().find('.trElement').html(htmlTemp);                                         
			}
		});
  }
  function elegirAccion(element)
{
  var valueButton =  $(element).attr('value');
  var clase=$(element).attr('class');
  if(valueButton == '+')
  {
    $($(element).parent().parent().find('ul')[0]).attr('class','mostrar'); 
    $(element).attr('value','-');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-down');
  }
  else
  {
    $($(element).parent().parent().find('ul')[0]).attr('class','ocultar'); 
    $(element).attr('value','+');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-right');
  } 
}
  $("#listaProyectoBD").change(function(){
	  
        var ue=$('select[id=listaProyectoBD]').val()
        mostrarPresupuesto(ue,this);

  });
  function hojaPresupuesto(CodigoUnico,CodigoPresupuesto,CodigoSubPresupuesto,element){
	$('#descripcioHojaPresupuesto').html('');
	$('#costoUnitario').html('');
	$(presupuestoSelect).removeClass('select');
	presupuestoSelect = element;
	$(element).addClass('select');
	$.ajax(
  {
    type: "POST",
    url: base_url+"index.php/Expediente_Tecnico/HojaPresupuesto",
    cache: false,
    data: { CodigoUnico: CodigoUnico,CodigoPresupuesto:CodigoPresupuesto,CodigoSubPresupuesto:CodigoSubPresupuesto},
    success: function(resp)
    {
      var obj=JSON.parse(resp);
	  var htmlTemp='<table id="TableUbigeoProyectoInv" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >'+
                           ' <thead >'+
                               ' <tr>'+
                                   ' <th class="center" style="width: 10%" >Item</th>'+
                                   ' <th class="center" style="width: 55%" >Descripcion</th>'+
                                   ' <th class="center" style="width: 5%" >Und.</th>'+
                                   ' <th class="center" style="width: 10%" >Metrado</th>'+
                                   ' <th class="center" style="width: 10%" >Precio(S/.)</th>'+
                                   ' <th class="center" style="width: 10%" >Parcial(S/.)</th>'+
                               ' </tr>'+
                           ' </thead>'+
                           ' <tbody>';
						   elementHojaPresupuesto=obj;
						   obj.forEach((element,key) => {
							   
							   
							   if(element.titulos!="REGISTRO RESTRINGIDO"){
								htmlTemp+='<tr><td class="partida" style="padding-left:'+element.nivel*5+'px !important;">'+element.orden+'</td>';
									htmlTemp+='<td class="title" style="padding-left:'+element.nivel*5+'px !important;">'+element.titulos+'</td>';
							   }
							   else{
								htmlTemp+='<tr onclick="costoUnitario(\''+CodigoUnico+'\',\''+CodigoPresupuesto+'\',\''+CodigoSubPresupuesto+'\',\''+element.codpartida+'\',\''+key+'\', this);"><td class="partida" style="padding-left:'+element.nivel*5+'px !important;">'+element.orden+'</td>';
								htmlTemp+='<td class="partida" style="padding-left:'+element.nivel*5+'px !important;"><a hreft="#">'+element.partida+'</td>';
							   }
							   htmlTemp+='<td class="partida center">'+(isNaN(element.simbolo)? element.simbolo:'')+'</td>';
								htmlTemp+='<td class="partida center">'+(isNaN(parseFloat(element.metrado))? '':parseFloat(element.metrado))+'</td>'+
							   '<td class="partida right">'+(isNaN(parseFloat(element.Precio))? '':parseFloat(element.Precio))+'</td>'+
							   '<td class="partida right">'+(isNaN(parseFloat(element.Parcial))? '':parseFloat(element.Parcial))+'</td>';
							   htmlTemp+='</tr>';
						   });
						  

						   htmlTemp+=' </tbody>'+
                       ' </table>';

	  $('#hojaPresupuesto').html(htmlTemp);
                                           
    }
  });
  }
  function costoUnitario(CodigoUnico,CodigoPresupuesto,CodigoSubPresupuesto,CodigoPartida,key,element){
		$(hojaPresupuestoSelect).removeClass('select');
		hojaPresupuestoSelect = element;
		$(element).addClass('select');
	  let valor = elementHojaPresupuesto[key];
	  var htmlTemp1='<div class="row detPage1"><label class="col-md-3 col-sm-3 col-xs-3"><i class="fa fa-folder-open"></i> '+valor.codpartida+'</label><label class="col-md-2 col-sm-2 col-xs-2">'+valor.Codigo+'</label><label class="col-md-3 col-sm-3 col-xs-3">Jornada = '+valor.Jornada+'</label><label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-male"></i> Mano de Obra</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Mano_Obra))? '0.00':parseFloat(valor.Mano_Obra))+'</label>'+
	  '<label class="col-md-8 col-sm-8 col-xs-8">'+valor.partida+'</label>'+
	  '<label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-road"></i> Materiales</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Materiales))? '0.00':parseFloat(valor.Materiales))+'</label>'+
	  '<label class="col-md-3 col-sm-3 col-xs-3">Productividad por und:</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Productividadhh))? '0.00':parseFloat(valor.Productividadhh))+' hh</label><label class="col-md-3 col-sm-3 col-xs-3">'+(isNaN(parseFloat(valor.Productividadhm))? '0.00':parseFloat(valor.Productividadhm))+' hm.hp</label>'+
	  '<label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-wrench"></i> Equipos</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Equipos))? '0.00':parseFloat(valor.Equipos))+'</label>'+
	  '<label class="col-md-3 col-sm-3 col-xs-3">Rendimiento DIA:</label><label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-male"></i> '+(isNaN(parseFloat(valor.Rendimiento_MO))? '0.00':parseFloat(valor.Rendimiento_MO))+'</label><label class="col-md-3 col-sm-3 col-xs-3"><i class="fa fa-balance-scale"></i> '+(isNaN(parseFloat(valor.peso))? '0.00':parseFloat(valor.peso))+'</label>'+
	  '<label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-file-text-o"></i> Subcontratos</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Subcontratos))? '0.00':parseFloat(valor.Subcontratos))+'</label>'+
	  '<label class="col-md-3 col-sm-3 col-xs-3">Precio Unitario:</label><label class="col-md-2 col-sm-2 col-xs-2">'+valor.simbolo+'</label><label class="col-md-3 col-sm-3 col-xs-3"> S/'+(isNaN(parseFloat(valor.Precio_Unitario))? '0.00':parseFloat(valor.Precio_Unitario))+'</label>'+
	  '<label class="col-md-2 col-sm-2 col-xs-2"><i class="fa fa-newspaper-o"></i> Subpartidas</label><label class="col-md-2 col-sm-2 col-xs-2">'+(isNaN(parseFloat(valor.Subpartidas))? '0.00':parseFloat(valor.Subpartidas))+'</label></div>';

	  $('#descripcioHojaPresupuesto').html(htmlTemp1);
	$.ajax(
  {
    type: "POST",
    url: base_url+"index.php/Expediente_Tecnico/costoUnitario",
    cache: false,
    data: { CodigoUnico: CodigoUnico,CodigoPresupuesto:CodigoPresupuesto,CodigoSubPresupuesto:CodigoSubPresupuesto,CodigoPartida:CodigoPartida},
    success: function(resp)
    {
      var obj=JSON.parse(resp);
	  var htmlTemp='<table id="TableUbigeoProyectoInv" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%" >'+
                           ' <thead >'+
                               ' <tr>'+
                                   ' <th class="center" style="width: 55%" >Descripcion</th>'+
                                   ' <th class="center" style="width: 5%" >Und.</th>'+								   
                                   ' <th class="center" style="width: 10%" >Cuadrilla</th>'+
                                   ' <th class="center" style="width: 10%" >Cantidad</th>'+
                                   ' <th class="center" style="width: 10%" >Precio(S/.)</th>'+
                                   ' <th class="center" style="width: 10%" >Parcial(S/.)</th>'+
                               ' </tr>'+
                           ' </thead>'+
                           ' <tbody>';
						   obj.forEach(element => {
							   htmlTemp+='<tr><td class="partida"> '+((element.tipo===1)?'<i class="fa fa-male"></i> ':(element.tipo===2)?'<i class="fa fa-road"></i> ':'<i class="fa fa-wrench"></i> ')+element.descripcion+'</td>'+
								'<td class="title">'+element.unidad+'</td>'+
								'<td class="partida">'+(isNaN(parseFloat(element.cuadrilla))? '':parseFloat(element.cuadrilla))+'</td>'+
								'<td class="partida">'+(isNaN(parseFloat(element.cantidad))? '':parseFloat(element.cantidad))+'</td>'+
							   '<td class="partida right">'+(isNaN(parseFloat(element.Precio))? '':parseFloat(element.Precio))+'</td>'+
							   '<td class="partida right">'+(isNaN(parseFloat(element.Parcial))? '':parseFloat(element.Parcial))+'</td>';
							   htmlTemp+='</tr>';
						   });

						   htmlTemp+=' </tbody>'+
                       ' </table>';

	  $('#costoUnitario').html(htmlTemp);
                                           
    }
  });
  }
</script>