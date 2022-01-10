
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
  background-color: #F2F2F2;
}
.trElement li:hover {
  background: #fdfdfd;
}
.nivel
{
  color: #73879C;
    font-family: "Helvetica Neue", Roboto, Arial, "Droid Sans", sans-serif;
    font-size: 12px;
    font-weight: 400;
    line-height: 1.471;
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
</style>
<div class="right_col" role="main">
    <div class="">

        <div class="clearfix"></div>

        <div class="">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><b> OFICINAS </b></h2>
                        <ul class="nav navbar-right panel_toolbox">
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                  <div class="row">

                <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="control-label">Unidad Ejecutora:</label>
                <div>
                <select id="listaUnidadEjecutoraR"  class="selectpicker form-control" data-live-search="true">
                <?php foreach ($lista_ue as $row) { ?>
                    <option value="<?=trim($row->id_ue)?>" <?php echo (trim($unidadejecutora)==trim($row->codigo_ue) ? 'selected' : ''); ?>><?=$row->codigo_ue?> - <?=$row->nombre_ue?></option>
                <?php  } ?>
              </select>
                </div>
                 </div>


            <div class="col-md-2 col-sm-12 col-xs-12">
            <label>&nbsp</label>
            <div>
              <span class="input-group-btn">
              <button type="button" class="btn btn-primary" onclick="insertarOficinaRUE(this);"><span class="fa fa-plus-circle"></span> Nuevo</button>                  
            </span>
          </div>
          </div>


                </div>
                <div class="row" style="height: 500px; margin-top:5px;padding-top:10px; overflow: scroll; background-color: transparent;">
                    <ul class="trElement" style="padding-left: 10px";>
                        <?php foreach ($listaNivel1 as $key => $value) 
                        {
                          if($value->hasChild)
                          {?>
                            <li>
                              <i  class="elegir btn btnm btn-xs fa fa-chevron-right" id="btnAccion" name="Accion" value="+" onclick="elegirAccion('<?=$value->id_oficina?>', this);"></i>                               
                              <span class="nivel"><?=$value->denom_oficina?></span>
                              <div class='btn-group pull-right' style="margin-right: 2px;"><button data-toggle='dropdown' class='btn btn-primary btnf btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>
                              <button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR('<?=$value->id_oficina?>', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>
                              <button type='button' class='btn btn-primary btn-xs all pull-right' onclick="editarOficinaR('<?=$value->id_oficina?>','<?=$value->denom_oficina?>', this);"><i class='ace-icon fa fa-pencil bigger-120'></i> Editar Oficina</button>
                              <button type='button' class='btn btn-danger btn-xs all pull-right' onclick='eliminarOficinaR(<?=$value->id_oficina?>,this)'><i class='fa fa-trash-o'></i> Eliminar Oficina</button>  
                              <button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id="<?=$value->id_oficina?>"  data-denom="<?=$value->denom_oficina?>"><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>         
                              </ul></div> 
                            </li>
                          <?php } else { ?>
                            <li>
                              <i  class='elegir btn-xs fa' style="margin-right: 8px;"></i>
                              <div class='btn-group pull-right' style="margin-right: 2px;"><button data-toggle='dropdown' class='btn btnf btn-primary btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>
                              <button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR('<?=$value->id_oficina?>', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>
                              <button type='button' class='btn btn-primary btn-xs all pull-right' onclick="editarOficinaR('<?=$value->id_oficina?>','<?=$value->denom_oficina?>', this);"><i class='ace-icon fa fa-pencil bigger-120'></i> Editar Oficina</button>
                              <button type='button' class='btn btn-danger btn-xs all pull-right' onclick='eliminarOficinaR(<?=$value->id_oficina?>,this)'><i class='fa fa-trash-o'></i> Eliminar Oficina</button>  
                              <button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id="<?=$value->id_oficina?>"  data-denom="<?=$value->denom_oficina?>"><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>         
                              </ul></div>
                              <span class="nivel"><?=$value->denom_oficina?></span> 
                            </li>
                          <?php } ?>                      
                        <?php } ?>
                      </ul>
                  </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="clearfix"></div>
    </div>
</div>

<div class="modal fade" id="VentanaEditarOficinaR" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Editar Oficina</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <!-- FORULARIO PARA REGISTRAR NUEVO FUNCION  -->
                        <form class="form-horizontal " id="form-EditarOficinaR"
                              action="<?php echo base_url();?>OficinaR/UpdateOficinaR" method="POST">
                            <div id="validarEditarOficinaR">
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name"> Denominacion <span
                                              class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input id="txt_id_oficinaR" name="txt_id_oficinaR"
                                                 class="form-control col-md-7 col-xs-12" data-validate-length-range="6"
                                                 data-validate-words="2"
                                                 required="required" type="hidden">
                                      </div>
                                      <input id="txt_denom_oficinaR" name="txt_denom_oficinaR"
                                             class="form-control col-md-7 col-xs-12" required="required"
                                             type="text">
                                  </div>
                              </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">

                                    <button id="send" type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-floppy-disk"></span>
                                        Guardar
                                    </button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                                        <span class="glyphicon glyphicon-remove"></span>
                                        Cancelar
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- FORULARIO PARA REGISTRAR NUEVO FUNCION  -->
                    </div>
                    <!-- /.span -->
                </div>
                <!-- /.row -->
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!--Modal Meta Oficina-->
<div class="modal fade" id="VentanaMetaOficina" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Asignar Meta - Oficina</h4>
            </div>
     <div class="modal-body">
     <div class="row">
     <div class="col-xs-12">
     <div id="validarMetaOficina">
    <form class="form-horizontal" id="form-MetaOficina">
        <input id="txt_id_oficina" name="txt_id_oficina"  readonly="readonly" autocomplete="off"  type="hidden">
           <div class="row">
            <div class="col-md-9 col-sm-12 col-xs-12">
                <label class="control-label">Oficina:</label>
                <div>
                    <input id="txt_oficina" name="txt_oficina" class="form-control" readonly="readonly" required="required" type="text" >
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Año:</label>
                <div>
                    <input type="text" value="<?=date('Y')?>" id="txtAniometa" name="txtAniometa" autocomplete="off" class="form-control" maxlenght="4">
                </div>
            </div>
            <div class="col-md-1 col-sm-6 col-xs-12">
                <label class="control-label">.</label>
                <div>
                     <button  type="button" class="btn btn-info" onclick="cargarComboMetaSiaf();">
                        <span class="glyphicon glyphicon-search"></span>
                     </button>
                </div>
            </div> 
           </div>  
           <div class="row">
            <input id="txt_ue" name="txt_ue"  autocomplete="off"  type="hidden">
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="control-label">Sec Func*</label>
                <div class="form-group">
                    <select class="selectpicker form-control" id="listarMetaO" name="listarMetaO" data-live-search="true">
                        <option value="">Seleccione una opción</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12">
                <label class="control-label">Unidad Ejecutora:</label>
                <div>
                    <input id="txt_unidad_ejecutora" name="txt_unidad_ejecutora" class="form-control" readonly="readonly" required="required" type="text" >
                </div>
            </div>
            

        </div>
        <div class="row">
             <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Funcion:</label>
                <div>
                    <input type="text" name="txt_funcion" autocomplete="off" class="form-control " id="txt_funcion" >
                </div>
            </div> 
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Programa:</label>
                <div>
                    <input type="text" name="txt_programa" autocomplete="off" id= "txt_programa" class="form-control" maxlength="3">
                </div>  
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Sub Programa:</label>
                <div>
                    <input type="text" name="txt_sub_programa" id= "txt_sub_programa" autocomplete="off" class="form-control" maxlenght="4">
                </div>  
            </div>  
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Componente:</label>
                <div>
                    <input type="text" name="txt_componente" autocomplete="off" class="form-control" id="txt_componente" maxlength="7">
                </div>
            </div>  
             <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Meta:</label>
                <div>
                    <input type="text" name="txt_meta" id= "txt_meta" class="form-control" autocomplete="off" maxlength="5">
                </div>  
            </div>
            <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Finalidad:</label>
                <div>
                    <input type="text" name="txt_finalidad" class="form-control" id="txt_finalidad" autocomplete="off" maxlength="7">
                </div>
            </div>    
        </div>
        <div class="row">
          <div class="col-md-2 col-sm-3 col-xs-12">
                <label class="control-label">Act Proy:</label>
                <div>
                    <input type="text" name="txt_act_proy" id= "txt_act_proy" autocomplete="off" class="form-control" maxlenght="7">
                </div>  
            </div>
            <div class="col-md-8 col-sm-3 col-xs-12">
                <label class="control-label">Proyecto:</label>
                <div>
                    <input type="text" name="txt_nombre_proyecto" id= "txt_nombre_proyecto" autocomplete="off" class="form-control" id="txt_nombre_meta">
                </div>
            </div>   
            <div class="col-md-2 col-sm-6 col-xs-12">
                <label>.</label>
                <div>
                    <input style="width:100%" type="button" class="btn btn-success" onclick="guardarMetaOficina();" value="Guardar">
                </div>
            </div>           
        </div>
    </form>
    <div class="ln_solid"></div>
    <div class="table-responsive">
    <table id="tablaMetaOficina" class="table table-bordered table-striped tablaGenerica" style="width:100%;">
            <thead>
                <tr>
                    <th>Sec Func</th>
                    <th>Finalidad</th>
                    <th>Act Proy</th>
                    <th>Proyecto</th>
                    <th>Opción</th>
                </tr>
            </thead>
        </table>
    </div>              
</div>
<div class="row" style="text-align: right;">
    <button  class="btn btn-danger" data-dismiss="modal">Cerrar</button>
</div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



<!-- fin para modificar division  funcional-->
<script>

  function guardarMetaOficina()
    {
        event.preventDefault();
        $('#validarMetaOficina').data('formValidation').validate();
        if(!($('#validarMetaOficina').data('formValidation').isValid()))
        {
            return;
        }
        var formData=new FormData($("#form-MetaOficina")[0]);
        $.ajax({
            type:"POST",
            url:base_url+"index.php/OficinaR/insertarMeta",
            data: formData,
            cache: false,
            contentType:false,
            processData:false,
            beforeSend: function() 
            {
                renderLoading();
            },
            success:function(objectJSON)
            {
                objectJSON=JSON.parse(objectJSON);
                swal(objectJSON.proceso, objectJSON.mensaje, (objectJSON.proceso=='Correcto' ? 'success' : 'error'));
                $('#divModalCargaAjax').hide(); 
                $('#tablaMetaOficina').dataTable()._fnAjaxUpdate();
                $('#listarMetaO').val('');
                $('#listarMetaO').change();
                $('#txt_funcion').val('');
                $('#txt_programa').val('');
                $('#txt_sub_programa').val('');
                $('#txt_act_proy').val('');
                $('#txt_componente').val('');
                $('#txt_meta').val('');
                $('#txt_finalidad').val('');
                $('#txt_nombre_proyecto').val('');
            },
            error:function()
            {
                swal("Error", "Ha ocurrido un error inesperado", "error")
                $('#divModalCargaAjax').hide();
            }
        }); 
    }

    

  function cargarComboMetaSiaf()
    {

        anio_meta=$('#txtAniometa').val();
        id_oficina=$('#txt_id_oficina').val();
        sec_ejec=$('#txt_ue').val();
        html = "";
    $("#listarMetaO").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/OficinaR/listarMeta",
        type: "POST",
        data:
            {
            anio_meta : anio_meta,
            sec_ejec  : sec_ejec
            },
        success: function (respuesta) {
            // alert(respuesta);
            var registros = eval(respuesta);
            html+="<option value=''>Seleccione una opción</option>"
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["sec_func"] + "> " + registros[i]["sec_func"] +" - "+  registros[i]["act_proy"] +" - "+registros[i]["nombre"] + " </option>";
            }

            $("#listarMetaO").html(html);//para modificar las entidades

            //$('select[name=listaGerenciaCM]').change();

            $('.selectpicker').selectpicker('refresh');
        }
    });
    listaMetaOficinaR(id_oficina,anio_meta);
    }

    $("#listarMetaO").change(function(){
        sec_func=$('select[id=listarMetaO]').val();
        anio_meta=$('#txtAniometa').val();
        sec_ejec=$('#txt_ue').val();
        $.ajax(
        {
            url: base_url+'index.php/OficinaR/cargarMeta',
            type: 'POST',
            data:
            {
            sec_func : sec_func,
            anio_meta : anio_meta,
            sec_ejec:sec_ejec
            },
            cache: false,
            async: true
        }).done(function(objectJSON)
        { 
            obj = JSON.parse(objectJSON);
            if(obj.flag!=0)
            {
                $('#txt_funcion').val(obj.funcion+' - '+obj.nombre_funcion);
                $('#txt_programa').val(obj.programa);
                $('#txt_sub_programa').val(obj.sub_programa);
                $('#txt_act_proy').val(obj.act_proy);
                $('#txt_componente').val(obj.componente);
                $('#txt_meta').val(obj.meta);
                $('#txt_finalidad').val(obj.finalidad);
                $('#txt_nombre_proyecto').val(obj.nombre);
            }
            else
               {
              //  swal('', 'No se asigno meta presupuestal para el año '+anio_meta, 'error');
                $('#txt_funcion').val('');
                $('#txt_programa').val('');
                $('#txt_sub_programa').val('');
                $('#txt_act_proy').val('');
                $('#txt_componente').val('');
                $('#txt_meta').val('');
                $('#txt_finalidad').val('');
                $('#txt_nombre_proyecto').val('');
            }

        }).fail(function()
        {
            swal('Error', 'Error no controlado.', 'error');
        });

  });


  $(function()
  {

     
      $('#validarMetaOficina').formValidation(
      {
          framework: 'bootstrap',
          excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
          live: 'enabled',
          message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
          trigger: null,
          fields:
          {
              txtAniometa:
              {
                  validators:
                  {
                      notEmpty:
                      {
                          message: '<b style="color: red;">El campo es requerido.</b>'
                      }
                  }
              },
              listarMetaO:
                {
                    validators:
                    {
                        notEmpty:
                        {
                            message: '<b style="color: red;">El campo es requerido.</b>'
                        }
                    }
                }
          }
      });


 $('#validarEditarOficinaR').formValidation(
      {
          framework: 'bootstrap',
          excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
          live: 'enabled',
          message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
          trigger: null,
          fields:
          {
              txt_denom_oficinaR:
              {
                  validators:
                  {
                      notEmpty:
                      {
                          message: '<b style="color: red;">El campo es requerido.</b>'
                      },
                      regexp: {
                            regexp: /^[a-zA-Z\s]+$/,
                            message: 'El campo solo puede contener caracteres alfabéticos'
                      }
                  }
              }
          }
      });

    });
function MostrarSubLista(id_oficina,element)
{
  ContraerSubLista(element);
  $.ajax(
  {
    type: "POST",
    url: base_url+"index.php/OficinaR/cargarNivel",
    cache: false,
    data: { id_oficina: id_oficina},
    success: function(resp)
    {
      var obj=JSON.parse(resp);

      if(obj.length==0)
      {
        $($(element).parent().find('i')[0]).attr('class','elegir btn-xs fa'); 
        $($(element).parent().find('i')[0]).attr('onclick',''); 
        return false;
      }
      
      var htmlTemp='<ul>';
       
      for(var i=0; i<obj.length; i++)
      {
        if(obj[i].hasChild == false)
        {
          htmlTemp+='<li>'+
          '<i  class="elegir btn-xs fa"  style="margin-right: 8px;"></i>'+
                '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
                "<div class='btn-group pull-right' style='margin-right: 2px;'><button data-toggle='dropdown' class='btn btnf btn-primary btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>"+
                '<button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR(\''+obj[i].id_oficina+'\', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>'+
                '<button type="button" class="editar btn btn-primary btn-xs all pull-right" onclick="editarOficinaR(\''+obj[i].id_oficina+'\',\''+obj[i].denom_oficina+'\', this);"><i class="ace-icon fa fa-pencil bigger-120"></i> Editar Oficina</button>'+
                ' <button type="button" class="btn btn-danger btn-xs all pull-right" onclick="eliminarOficinaR(\''+obj[i].id_oficina+'\',this)"><i class="fa fa-trash-o"></i> Eliminar Oficina</button> '+   
                 '<button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\'  data-denom=\''+obj[i].denom_oficina+'\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>'+     
                "</ul></div>"+
          '</li>';
        }
        else
        {
        htmlTemp+='<li>'+
         '<i  class="elegir btn btnm btn-xs fa fa-chevron-right" id="btnAccion" name="Accion" value="+" onclick="elegirAccion(\''+obj[i].id_oficina+'\', this);"></i>'+
                '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
                "<div class='btn-group pull-right' style='margin-right: 2px;'><button data-toggle='dropdown' class='btn btnf btn-primary btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>"+
                '<button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR(\''+obj[i].id_oficina+'\', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>'+
                '<button type="button" class="editar btn btn-primary btn-xs all pull-right" onclick="editarOficinaR(\''+obj[i].id_oficina+'\',\''+obj[i].denom_oficina+'\', this);"><i class="ace-icon fa fa-pencil bigger-120"></i> Editar Oficina</button>'+
                ' <button type="button" class="btn btn-danger btn-xs all pull-right" onclick="eliminarOficinaR(\''+obj[i].id_oficina+'\',this)"><i class="fa fa-trash-o"></i> Eliminar Oficina</button> '+  
                 '<button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\'  data-denom=\''+obj[i].denom_oficina+'\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>'+       
                "</ul></div>"+
          
        '</li>';
        }       
      }

      htmlTemp+='</ul>';
      $(element).parent().append(htmlTemp);                                         
    }
  });
}
function ContraerSubLista(element)
{
  $(element).parent().find('>ul').remove();
}

function seleccionar(insumo,element)
{
  var nuevoInsumo = replaceAll(insumo,'*','"');
  $('#txtInsumo').val(nuevoInsumo);
  if(unidad=='null')
  {
    $('#selectUnidadMedida').html('<option val="UNIDAD">UNIDAD</option>');    
    $('#selectUnidadMedida').selectpicker('refresh');
    $('#selectUnidadMedida').selectpicker('val', "UNIDAD");
  }
  else
  {
    $('#selectUnidadMedida').html('<option val="'+unidad+'">'+unidad+'</option>');
    $('#selectUnidadMedida').selectpicker('refresh'); 
    $('#selectUnidadMedida').selectpicker('val', unidad);
  } 
}

function elegirAccion(id_oficina, element)
{
  var valueButton =  $(element).attr('value');
  var clase=$(element).attr('class');
  if(valueButton == '+')
  {
    MostrarSubLista(id_oficina,element);
    $(element).attr('value','-');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-down');
  }
  else
  {
    ContraerSubLista(element);
    $(element).attr('value','+');
    $(element).attr('class','elegir btn btnm btn-xs fa fa-chevron-right');
  } 
}

$(document).ready(function (e) {
  $('#VentanaMetaOficina').on('show.bs.modal', function(e) { 
     var id = $(e.relatedTarget).data().id;
     var denom = $(e.relatedTarget).data().denom;
     var ue_denom=$('select[id="listaUnidadEjecutoraR"] option:selected').text();
     var id_ue=ue_denom.split('-');
      $(e.currentTarget).find('#txt_id_oficina').val(id);
      $(e.currentTarget).find('#txt_oficina').val(denom);
      $(e.currentTarget).find('#txt_ue').val(id_ue[0]);
      $(e.currentTarget).find('#txt_unidad_ejecutora').val(ue_denom);
      cargarComboMetaSiaf();
  });
});



 function eliminarOficinaR(id_oficina, element) 
  {
    swal({
      title: "Se eliminará la Oficina. ¿Realmente desea proseguir con la operación?",
      text: "",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI,Eliminar",
      closeOnConfirm: false
    }, function() {
      paginaAjaxJSON({
        "id_oficina": id_oficina
      }, base_url + 'index.php/OficinaR/EliminarOficinaR', 'POST', null, function(objectJSON) {
        objectJSON = JSON.parse(objectJSON);
        swal({
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
        }, function() {});
        elemento=$($(element).parent().parent().parent().find('span')[0]);
       $(elemento).parent().remove();
      }, false, true);
    });
  }

  function editarOficinaR(id_oficina,denom_oficina,elemento) 
  {
   var denominacion = '';

    swal({
      title: "",
      text: "Denominación",
      type: "input",
      inputValue: denom_oficina,
      showCancelButton: true,
      cancelButtonText:"CERRAR",
      confirmButtonText: "ACEPTAR",
      closeOnConfirm: false,
      inputPlaceholder: ""
    }, function (inputValue)
    {
        if (inputValue === false) return false;
        if (inputValue === "")
        {
          swal.showInputError("Denominación es un campo requerido");
          return false
        }

        denominacion = inputValue;

      if(denominacion==null || denominacion.trim()=='')
      {
        return;
      }
 
      paginaAjaxJSON({ "id_oficina" : id_oficina, "denom_oficina" : denominacion.trim()}, base_url+'index.php/OficinaR/UpdateOficinaR', 'POST', null, function(objectJSON)
      {
        objectJSON=JSON.parse(objectJSON);

        swal(
        {
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
        },
        function(){});

        if(objectJSON.proceso=='Error')
        {
          return false;
        }
        html="editarOficinaR('"+id_oficina+"','"+denominacion.trim()+"', this);";
        //$(elemento).parent().parent().parent().html("PROBANDO");
        $($(elemento).parent().parent().parent().find('span')[0]).html(denominacion);
        $($(elemento).parent().find('button')[1]).attr('onclick',html); 
          
      }, false, true);
    });
  }
   function insertarOficinaR(id_oficinaP,elemento) 
  {
  
   var denominacion = '';
   var ue=null;
    swal({
      title: "",
      text: "Denominación",
      type: "input",
      showCancelButton: true,
      cancelButtonText:"CERRAR",
      confirmButtonText: "ACEPTAR",
      closeOnConfirm: false,
      inputPlaceholder: ""
    }, function (inputValue)
    {
        if (inputValue === false) return false;
        if (inputValue === "")
        {
          swal.showInputError("Denominación es un campo requerido");
          return false
        }

        denominacion = inputValue;

      if(denominacion==null || denominacion.trim()=='')
      {
        return;
      }
        paginaAjaxJSON({ "id_oficina" : id_oficinaP, "denom_oficina" : denominacion.trim(), "id_ue" : ue}, base_url+'index.php/OficinaR/InsertarOficinaR', 'POST', null, function(objectJSON)
      {
        objectJSON=JSON.parse(objectJSON);
        swal(
        {
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
        },
        function(){});

        if(objectJSON.proceso=='Error')
        {
          return false;
        }
         element=$($(elemento).parent().parent().parent().find('i')[0]);
        $(element).attr('class','elegir btnm btn btn-xs fa fa-chevron-down'); 
        $(element).attr('onclick','elegirAccion('+id_oficinaP+', this);'); 
        $(element).attr('value','-');
        MostrarSubLista(id_oficinaP,element);
        //$($(elemento).parent().parent().parent().find('span')[0]).html(denominacion);
        //$($(elemento).parent().find('button')[1]).attr('onclick',html); 
          
      }, false, true);
      
    });
  
  }

  var listaMetaOficinaR = function (id_oficina,anio_meta)
    {
        id_oficina=id_oficina;
        anio_meta=anio_meta;
        var table=$("#tablaMetaOficina").DataTable({
            "processing": true,
            "serverSide":false,
            destroy:true,
            "ajax":{
                url:base_url+"index.php/OficinaR/listar_metas_oficina",
                type:"POST",
                data :{id_oficina:id_oficina,
                        anio_meta:anio_meta}
            },
            "columns":
            [
                {"data":"sec_func"},
                {"data":"finalidad"},
                {"data":"act_proy"},
                {"data":"nombre"},
                {"data":"id_oficinaR_meta",
                    render: function(data, type, row)
                    {
                        return "<button type='button' class='btn btn-danger btn-xs' onclick=eliminarMetaOficina(" + data + ",this)><i class='fa fa-trash-o'></i></button>";
                    }
                }
            ],
            "language":idioma_espanol
        });
    }

  function eliminarMetaOficina(id_oficinameta, element) 
  {
    swal({
      title: "Se eliminará la Meta. ¿Realmente desea proseguir con la operación?",
      text: "",
      type: "warning",
      showCancelButton: true,
      cancelButtonText: "Cerrar",
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "SI,Eliminar",
      closeOnConfirm: false
    }, function() {
      paginaAjaxJSON({
        "id_oficinameta": id_oficinameta
      }, base_url + 'index.php/OficinaR/eliminarMeta', 'POST', null, function(objectJSON) {
        objectJSON = JSON.parse(objectJSON);
        swal({
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso == 'Correcto' ? 'success' : 'error')
        }, function() {});
        $('#tablaMetaOficina').dataTable()._fnAjaxUpdate();
      }, false, true);
    });
  }

  function insertarOficinaRUE(element){
    var ue=$('select[id=listaUnidadEjecutoraR]').val()+"";
    var ue_denom=$('select[id="listaUnidadEjecutoraR"] option:selected').text();
    var id_oficinaP=null;
    var denominacion = '';
    swal({
      title: "",
      text: "Denominación",
      type: "input",
      showCancelButton: true,
      cancelButtonText:"CERRAR",
      confirmButtonText: "ACEPTAR",
      closeOnConfirm: false,
      inputPlaceholder: ""
    }, function (inputValue)
    {
        if (inputValue === false) return false;
        if (inputValue === "")
        {
          swal.showInputError("Denominación es un campo requerido");
          return false
        }

        denominacion = inputValue;
      if(denominacion==null || denominacion.trim()=='')
      {
        return;
      }
         paginaAjaxJSON({"id_oficina" : id_oficinaP, "denom_oficina" : denominacion.trim(), "id_ue" : ue}, base_url+'index.php/OficinaR/InsertarOficinaR', 'POST', null, function(objectJSON)
      {
        objectJSON=JSON.parse(objectJSON);
        swal(
        {
          title: '',
          text: objectJSON.mensaje,
          type: (objectJSON.proceso=='Correcto' ? 'success' : 'error')
        },
        function(){});

        if(objectJSON.proceso=='Error')
        {
          return false;
        }
        mostrarOficinaUE(ue,element);
        //$($(elemento).parent().parent().parent().find('span')[0]).html(denominacion);
        //$($(elemento).parent().find('button')[1]).attr('onclick',html); 
          
      }, false, true);
    });
  }

  function mostrarOficinaUE(id_ue,element){
    $.ajax(
  {
    type: "POST",
    url: base_url+"index.php/OficinaR/ListaNivel1",
    cache: false,
    data: { id_ue: id_ue},
    success: function(resp)
    {
      var obj=JSON.parse(resp);
      if(obj.length==0)
      {
         $(element).parent().parent().parent().parent().parent().find('.trElement').html('No existen Oficinas en esta Unidad Ejecutora');
        return false;
      }
      
      var htmlTemp='';
       
      for(var i=0; i<obj.length; i++)
      {
        if(obj[i].hasChild == false)
        {
          htmlTemp+='<li>'+
          '<i  class="elegir btn-xs fa"  style="margin-right: 8px;"></i>'+
                '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
                "<div class='btn-group pull-right' style='margin-right: 2px;'><button data-toggle='dropdown' class='btn btnf btn-primary btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>"+
                '<button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR(\''+obj[i].id_oficina+'\', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>'+
                '<button type="button" class="editar btn btn-primary btn-xs all pull-right" onclick="editarOficinaR(\''+obj[i].id_oficina+'\',\''+obj[i].denom_oficina+'\', this);"><i class="ace-icon fa fa-pencil bigger-120"></i> Editar Oficina</button>'+
                ' <button type="button" class="btn btn-danger btn-xs all pull-right" onclick="eliminarOficinaR(\''+obj[i].id_oficina+'\',this)"><i class="fa fa-trash-o"></i> Eliminar Oficina</button> '+   
                 '<button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\'  data-denom=\''+obj[i].denom_oficina+'\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>'+     
                "</ul></div>"+
          '</li>';
        }
        else
        {
        htmlTemp+='<li>'+
         '<i  class="elegir btn btnm btn-xs fa fa-chevron-right" id="btnAccion" name="Accion" value="+" onclick="elegirAccion(\''+obj[i].id_oficina+'\', this);"></i>'+
                '<span class="nivel">'+obj[i].denom_oficina+'</span>'+
                "<div class='btn-group pull-right' style='margin-right: 2px;'><button data-toggle='dropdown' class='btn btnf btn-primary btn-xs dropdown-toggle' type='button' aria-expanded='false'><i class='fa fa-cogs'></i></button><ul class='dropdown-menu drop'>"+
                '<button type="button" class="insertar btn btn-warning btn-xs all pull-right" onclick="insertarOficinaR(\''+obj[i].id_oficina+'\', this);"><i class="ace-icon fa fa-plus bigger-120"></i> Insertar Oficina</button>'+
                '<button type="button" class="editar btn btn-primary btn-xs all pull-right" onclick="editarOficinaR(\''+obj[i].id_oficina+'\',\''+obj[i].denom_oficina+'\', this);"><i class="ace-icon fa fa-pencil bigger-120"></i> Editar Oficina</button>'+
                ' <button type="button" class="btn btn-danger btn-xs all pull-right" onclick="eliminarOficinaR(\''+obj[i].id_oficina+'\',this)"><i class="fa fa-trash-o"></i> Eliminar Oficina</button> '+  
                 '<button type="button" class="meta btn btn-success btn-xs all pull-right" data-toggle="modal" data-target="#VentanaMetaOficina" data-id=\''+obj[i].id_oficina+'\'  data-denom=\''+obj[i].denom_oficina+'\'><i class="ace-icon fa fa-list-alt bigger-120"></i> Asignar Meta</button>'+       
                "</ul></div>"+
          
        '</li>';
        }       
      }

      htmlTemp+='';
      $(element).parent().parent().parent().parent().parent().find('.trElement').html(htmlTemp);                                         
    }
  });
  }

  $("#listaUnidadEjecutoraR").change(function(){
        var ue=$('select[id=listaUnidadEjecutoraR]').val()
        mostrarOficinaUE(ue,this)

  });
</script>


