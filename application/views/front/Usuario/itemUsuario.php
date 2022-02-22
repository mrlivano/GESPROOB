<link rel="stylesheet" href="http://kendo.cdn.telerik.com/2017.3.1026/styles/kendo.common.min.css" />
<link href="//cdn.kendostatic.com/2013.1.319/styles/kendo.default.min.css" rel="stylesheet" />

<div class="modal-body">
   <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" id='formUsuario' name="formUsuario"  method="post" onsubmit="return false;"  >
                  <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right"  for="form-field-1-1">Buscar Persona</label>
                          <div class="col-sm-6">
                            <?php if(isset($arrayUsuario->id_persona)) : ?>
                               <input type="text" class="form-control" name="comboPersona" disabled value="<?= $arrayUsuario->nombres." ".$arrayUsuario->apellido_p." ".$arrayUsuario->apellido_m ?>">
                               <input type="hidden" id="comboPersona" name="comboPersona" value="<?= $arrayUsuario->id_persona ?>">
                            <?php else: ?>
                              <select
                              class="form-control input-sm"
                               id="comboPersona" name="comboPersona"  title="Buscar persona" >
                              </select>
                            <?php endif; ?>
                          </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right"  for="form-field-1-1">Usuario </label>
                      <div class="col-sm-6">
                        <?php if(isset($arrayUsuario->id_persona)) : ?>
                          <input disabled type="text" placeholder="Nombre Usuario" class="form-control" autocomplete="off" value='<?php if(isset($arrayUsuario->usuario)) echo $arrayUsuario->usuario; ?>' />
                          <input type="hidden" id="txt_usuario_e" name="txt_usuario_e"  value='<?php echo $arrayUsuario->usuario; ?>' />
                          <label id="mensajeError" style="display: none;">Disponible</label>
                        <?php else: ?>
                          <input type="text" id="txt_usuario" name="txt_usuario" placeholder="Nombre Usuario" class="form-control" autocomplete="off" value='<?php if(isset($arrayUsuario->usuario)) echo $arrayUsuario->usuario; ?>' />
                          <label id="mensajeError" style="display: none;">  </label>
                        <?php endif; ?>
                        <span id="name_status"></span>
                        <input type="hidden" id="idPersona" name="idPersona" value='<?php if(isset($arrayUsuario->id_persona)) echo $arrayUsuario->id_persona; ?>' />
                      </div>

                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Tipo de Usuario </label>
                    <div class="col-sm-6">
                      <select  class="form-control input-sm" id="cbb_TipoUsuario" name="cbb_TipoUsuario">

                       </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Unidad Ejecutora </label>
                    <div class="col-sm-6">
                      <select  class="form-control input-sm" id="cbb_UnidadEjecutora" name="cbb_UnidadEjecutora">

                       </select>
                    </div>
                  </div>
                  <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Estado </label>
                        <div class="col-sm-6">
                               <select  id="cbb_estado" name="cbb_estado" class="form-control input-sm">
                               <option <?php if(isset($arrayUsuario->activo)) echo ($arrayUsuario->activo)==1 ? 'selected' : '' ?> value='1'> Activo </option>
                               <option <?php if(isset($arrayUsuario->activo)) echo ($arrayUsuario->activo)==0 ? 'selected' : '' ?> value='0'> Inactivo</option>
                               </select>
                        </div>
                  </div>

                  <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Contraseña</label>
                        <div class="col-sm-3">
                          <input type="password" id="txt_contrasenia" name="txt_contrasenia" placeholder="Contraseña" class="form-control" />
                        </div>
                  </div>
                  <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1"></label>
                        <div class="col-sm-9">
                            <div style="padding-top: 5px;">
                                <label><input <?php echo (empty($periodo) ? '': (($periodo==1) ? 'checked':'') );?> type="checkbox" class="checkPeriodo" name="checkPeriodo" id="checkPeriodo"> Periodo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <label><input <?php echo (empty($arrayUsuario->tipo_acceso) ? '': (($arrayUsuario->tipo_acceso==1) ? 'checked':'') );?> type="radio" value="1"  name="radioTipoAcceso" id="radioTipoAcceso1"> Lectura</label>&nbsp;&nbsp;&nbsp;
                                <label><input <?php echo (empty($arrayUsuario->tipo_acceso) ? '': (($arrayUsuario->tipo_acceso==2) ? 'checked':'') );?> type="radio" value="2"  name="radioTipoAcceso" id="radioTipoAcceso2"> Escritura</label>&nbsp;&nbsp;&nbsp;
                                <label><input <?php echo (empty($arrayUsuario->tipo_acceso) ? 'checked': (($arrayUsuario->tipo_acceso==3) ? 'checked':'') );?> type="radio" value="3"  name="radioTipoAcceso" id="radioTipoAcceso3"  > GESPRO</label>
                            </div>
                        </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-1-1">Acceso al menú</label>
                    <div class="col-sm-9">
                      <div class="demo-section k-content">
                          <div>
                              <div id="treeview"></div>
                          </div>
                          <div style="padding-top: 2em; display: none;">
                              <h4>Status</h4>
                              <p id="result"></p>
                          </div>
                      </div>
                    </div>
                  </div>
                  <div class="form-group" style="text-align: center;">
                      <button type="button" id="sendUsuario" class="btn btn-primary">Registrar Usuario </button>
                      <input  id="btnCerrar" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                 </div>
            </form>
        </div>
    </div>
</div>

<style>
    #treeview .k-sprite {
        background-image: url("http://demos.kendoui.com/content/web/treeview/coloricons-sprite.png");
    }

    .rootfolder { background-position: 0 0; }
    .folder     { background-position: 0 -16px; }
    .pdf        { background-position: 0 -32px; }
    .html       { background-position: 0 -48px; }
    .image      { background-position: 0 -64px; }
</style>

<script src="<?php echo base_url();?>assets/js/usuario/usuario.js"></script>

<script>

var definido = $('#idPersona').val();
var menuUsuarioHome = [];

$(function()
{
    if(definido!='')
    {
        $.ajax(
        {
            url: base_url+'index.php/Usuario/listaUrlAsignado',
            type: 'POST',
            data:
            {
               id_persona : definido
            },
            cache: false,
            async: false
        }).done(function(objectJSON)
        {
            objectJSON = JSON.parse(objectJSON);
            menuUsuarioHome.push(objectJSON);
        }).fail(function()
        {
            swal('Error', 'Error no controlado.', 'error');
        });
    }
});

function compara(json)
{
    var bool = false;
    if(menuUsuarioHome.length>0)
    {
        for (var i = 0; i < menuUsuarioHome[0].length; i++)
        {
            if (json == menuUsuarioHome[0][i].id_menu)
            {
                bool = true;
            }
        }
    }
    return bool;
}

$(function()
{
    var modulo = [];

    $.ajax(
    {
        url: base_url+'index.php/Usuario/listaMenu',
        type: 'POST',
        cache: false,
        async: false
    }).done(function(objectJSON)
    {
        objectJSON = JSON.parse(objectJSON);

        for (var i = 0; i < objectJSON.length; i++)
        {
            var submodulo = [];
            for (var j = 0; j < objectJSON[i].childModulo.length; j++)
            {
                submodulo.push(
                {
                    id:objectJSON[i].childModulo[j].id_menu,
                    text:objectJSON[i].childModulo[j].url.split("/",1)+" - "+objectJSON[i].childModulo[j].nombre,
                    spriteCssClass:"html",
                    checked:compara(objectJSON[i].childModulo[j].id_menu)
                });
            }
            modulo.push(
            {
                id: objectJSON[i].id_menu,
                text: objectJSON[i].nombre,
                expanded: false,
                spriteCssClass: "folder",
                items:submodulo,
                checked: compara(objectJSON[i].id_menu)
            });
        }
    }).fail(function()
    {
        swal('Error', 'Error no controlado.', 'error');
    });
    $("#treeview").kendoTreeView(
    {
        checkboxes:
        {
            checkChildren: true
        },
        check: onCheck,
        dataSource: modulo
    });

});

function checkedNodeIds(nodes, checkedNodes)
{
    for (var i = 0; i < nodes.length; i++)
    {
        if (nodes[i].checked)
        {
            checkedNodes.push(nodes[i].id);

            //Validacion de nodos padres en seleccion multiple de nodos
            //ALTER VAL 1
            if(nodes[i].id >=1 && nodes[i].id <=21){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==22){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(22);
                }
            }
            //ALTER VAL 2
            if(nodes[i].id >=32 && nodes[i].id <=45){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==23){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(23);
                }
            }
            //ALTER VAL 3
            if(nodes[i].id >=47 && nodes[i].id <=55){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==24){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(24);
                }
            }

            //ALTER VAL 4
            if((nodes[i].id >=58 && nodes[i].id <=69) || nodes[i].id==80 ){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==26){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(26);
                }
            }

            //ALTER VAL 5
            if( nodes[i].id==81 ){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==27){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(27);
                }
            }

            //ALTER VAL 6
            if(nodes[i].id >=70 && nodes[i].id <=79 ){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==28){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(28);
                }
            }
            //ALTER VAL 7
            if(nodes[i].id == 82 ){
                var verificapabre=false;
                for (var k = 0; k < checkedNodes.length; k++) {
                    if(checkedNodes[k]==29){
                        verificapabre=true;
                    }
                }
                if(verificapabre==false){
                    checkedNodes.push(29);
                }
            }

        }
        if (nodes[i].hasChildren)
        {
            checkedNodeIds(nodes[i].children.view(), checkedNodes);
        }
    }
}
function onCheck()
{
    var checkedNodes = [],
        treeView = $("#treeview").data("kendoTreeView"),
        message;

    checkedNodeIds(treeView.dataSource.view(), checkedNodes);
    if (checkedNodes.length > 0)
    {
        message = checkedNodes.join(",");
    } else
    {
        message = "No nodes checked.";
    }
    $("#result").html(message);
}
</script>

<script>
$(function()
{
    $("#formUsuario").submit(function(event)
    {
        event.preventDefault();
        var stringMenuUsuario ='';
        var c=0;
        var dat = $("#result").text();
        var b = dat.split(',').map(Number);
        for (var i = 0; i < b.length; i++)
        {
            if(c>0)
                    stringMenuUsuario+='-';
            stringMenuUsuario+=b[i];
            c++;
        }
        $.ajax({
            url:$("#formUsuario").attr("action"),
            type:$(this).attr('method'),
            data:$(this).serialize()+"&cbb_listaMenuDestino="+stringMenuUsuario,
            success:function(resp)
            {
                swal("",resp, "success");
                window.location.href=base_url+"index.php/Usuario";
            }
        });
    });

    $("body").on("click","#sendUsuario",function(e)
    {
        //alert($('#mensajeError').text());
        $('#formUsuario').data('formValidation').validate();
        if($('#formUsuario').data('formValidation').isValid()==true && ($('#mensajeError').text()=='Disponible'))
        {
            $('#formUsuario').submit();
            $('#formUsuario').each(function()
            {
                this.reset();
            });
            $('.selectpicker').selectpicker('refresh');
            $('#formUsuario').data('formValidation').resetForm();
            $('#formUsuario').off();
            $('#formUsuario').remove();
            $('#formUsuario').empty();
            $('#modalTemp').modal('hide');
        }
    });
});

$('#txt_usuario').blur(function()
{
    var username = $(this).val();
    if(username.length>0)
    {
        $.ajax(
        {
            url: base_url+'index.php/Usuario/VerificarNombreUsuario',
            type: 'POST',
            cache: false,
            data:{username:username},
            async: false
        }).done(function(objectJSON)
        {
            objectJSON = JSON.parse(objectJSON);
            if(objectJSON.cantidad>0)
            {
                $('#mensajeError').css('display','block');
                $('#mensajeError').css('color','red');
                $('#mensajeError').text('Este nombre de usuario ya esta registrado en el sistema, pruebe con otro');
            }
            else
            {
                $('#mensajeError').css('display','block');
                $('#mensajeError').css('color','green');
                $('#mensajeError').text('Disponible');
            }
        }).fail(function()
        {
            swal('Error', 'Error no controlado.', 'error');
        });
    }
});

$(document).ready(function()
{
    <?php if(isset($arrayUsuario->id_persona)){ ?>
      $("#formUsuario").attr("action",base_url+"index.php/Usuario/editUsuario");
    <?php }
    else { ?>
      $("#formUsuario").attr("action",base_url+"index.php/Usuario/addUsuario");
    <?php } ?>
    $('#formUsuario').formValidation({
        fields:
        {
            comboPersona:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Persona" es requerido.</b>'
                    }
                }
            },
            txt_usuario:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Usuario" es requerido.</b>'
                    }
                }
            },
            cbb_TipoUsuario:
            {
                validators:
                {
                    notEmpty:
                    {
                    message: '<b style="color: red;">El campo "Tipo de usuario" es requerido.</b>'
                }
            }
        },
    }
});
listaPersonaCombo("<?php if(isset($arrayUsuario->id_persona)) echo $arrayUsuario->id_persona; ?>");
listatipoUsuario("<?php if(isset($arrayUsuario->id_usuario_tipo)) echo $arrayUsuario->id_usuario_tipo; ?>");
listaUnidadEjecutora("<?php if(isset($arrayUsuario->id_ue)) echo $arrayUsuario->id_ue; ?>");
});

</script>
