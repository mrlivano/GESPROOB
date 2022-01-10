<style>
/* The checkboxContainer */
.checkboxContainer {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    font-size: 22px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* Hide the browser's default checkbox */
.checkboxContainer input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
}

/* Create a custom checkbox */
.checkmark {
    position: absolute;
    top: 0;
    left: 0;
    height: 25px;
    width: 25px;
    background-color: #eee;
}

/* On mouse-over, add a grey background color */
.checkboxContainer:hover input ~ .checkmark {
    background-color: #ccc;
}

/* When the checkbox is checked, add a blue background */
.checkboxContainer input:checked ~ .checkmark {
    background-color: #2196F3;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
    content: "";
    position: absolute;
    display: none;
}

/* Show the checkmark when checked */
.checkboxContainer input:checked ~ .checkmark:after {
    display: block;
}

/* Style the checkmark/indicator */
.checkboxContainer .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
}
</style>
<script type="text/javascript">
  var flag = false;
  function getCheckedProjects(foo) {
    var usuario_proj = <?php echo json_encode($usuario_proyecto); ?>;
    usuario_proj.forEach(function(currentValue, index, array){
      if (currentValue.id_pi == foo) {
        flag = true;
        $("#checkbox"+foo).prop('checked',true);
        document.getElementById('td'+foo).innerHTML = '☑️';
      }
    });
    return flag;
  }

  <?php foreach ($lista as $item): ?>
    getCheckedProjects(<?= $item->id_pi ?>);
  <?php endforeach; ?>

</script>
<div class="modal-body">
   <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" id='formUsuario' name="formUsuario"  method="post" onSubmit="return false;"  >
                  <div class="form-group">
                    <div class="table-responsive">
                        <table id="table_asignar_usuario_proyecto" class="table table-striped jambo_table bulk_action  table-hover" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <td class="col-md-1 col-xs-12"><input type="checkbox" onchange="checkAll(this)" name="" value=""> Todo</td>
                                    <td class="col-md-5 col-xs-12">Nombre De Proyecto</td>
                                    <td class="col-md-1 col-xs-12">Codigo Unico</td>
                                    <td class="col-md-1 col-xs-12">Estado</td>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($lista as $item){ ?>
                                  <tr>
                                    <td>
                                      <label class="checkboxContainer">
                                        <input onclick="getCheckedBoxes(<?php echo $item->id_pi ?>)" type="checkbox" name="checkbox" id="checkbox<?php echo $item->id_pi ?>" value="<?php echo $item->id_pi ?>" >
                                        <span class="checkmark"></span>
                                      </label>
                                    </td>
                                    <td><?= $item->nombre_pi ?></td>
                                    <td><?= $item->codigo_unico_pi ?></td>
                                    <td id="td<?php echo $item->id_pi ?>">
                                      ⚪
                                    </td>
                                  </tr>
                              <?php } ?>
                            </tbody>
                        </table>
                    </div>
                  </div>
                  <div class="form-group" style="text-align: center;">
                      <p id="result"></p>
                      <input type="hidden" id="id_persona" name="id_persona" value='<?php if(isset($usuario->id_persona)) echo $usuario->id_persona; ?>' />
                      <button type="button" id="sendUsuario" class="btn btn-primary">Guardar cambios </button>
                      <input  id="btnCerrar" class="btn btn-danger" data-dismiss="modal" value="Cancelar">
                 </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url();?>assets/js/usuario/usuario.js"></script>

<script>

$(document).ready(function()
{
  $('#table_asignar_usuario_proyecto').DataTable(
  {
      "language":idioma_espanol
  });

    <?php if(isset($usuario->id_persona)){ ?>
      $("#formUsuario").attr("action",base_url+"index.php/Usuario/editUsuarioProyecto");
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

});

$(function()
{
    $("#formUsuario").submit(function(event)
    {
        event.preventDefault();
        var stringMenuUsuario ='';
        var c=0;
        var dat = $("#result").text();
        var b = dat.split(',').map(Number);
        for (var i = 0; i < b.length; i++) {
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
                //window.location.href=base_url+"index.php/Usuario/Proyectos";
            }
        });
    });

    $("body").on("click","#sendUsuario",function(e)
    {
        $('#formUsuario').data('formValidation').validate();
        if($('#formUsuario').data('formValidation').isValid()==true)
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

function checkAll(ele) {
    var checkedNodes = [], message;
    var checkboxes = document.getElementsByTagName('input');
    if (ele.checked) {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox' && checkboxes[i].name == 'checkbox' ) {
                checkboxes[i].checked = true;
                checkedNodes.push(checkboxes[i].value);
                message = checkedNodes.join(",");
            }
        }
        $("#result").html(message);
    } else {
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].type == 'checkbox' && checkboxes[i].name == 'checkbox' ) {
                checkboxes[i].checked = false;
                message = "";
            }
        }
        $("#result").html(message);
    }
}


var checkedNodes = [], message;
var usuario_proj = <?php echo json_encode($usuario_proyecto); ?>;
usuario_proj.forEach(function(currentValue, index, array){
  checkedNodes.push(currentValue.id_pi);
});
// Pass the checkbox name to the function
function getCheckedBoxes(idCheckbox) {
  if($("#checkbox"+idCheckbox).prop('checked') == true) {
    checkedNodes.push(idCheckbox);
    message = checkedNodes.join(",");
  } else if ($("#checkbox"+idCheckbox).prop('checked') == false) {
    var index = checkedNodes.indexOf(idCheckbox);
    if (index > -1) {
      checkedNodes.splice(index, 1);
    }
    message = checkedNodes.join(",");
  }
  $("#result").html(message);
  // Return the array if it is non-empty, or null
  //return checkboxesChecked.length > 0 ? checkboxesChecked : null;
}
</script>
