<div class="modal-body">
    <div class="row">
        <div class="col-xs-12">
            <form class="form-horizontal" name="form-RegistraCarteraInv" id="form-RegistraCarteraInv" action="<?php echo base_url(); ?>CarteraInversion/AddCartera" method="POST">
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Año Apertura Cartera <span class="required">*</span></label>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" id="dateAñoAperturaCart" name="dateAñoAperturaCart">
                          <?php
                          if(isset($arrayCartera)){
                            for($i=date('Y');$i<=date('Y')+1;$i++){
                              if($i==$arrayCartera->anio)
                                echo '<option selected value="'.$i.'">'.$i.'</option>';
                              else
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          else{
                            for($i=date('Y');$i<=date('Y')+1;$i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                          }
                          ?>
                          </select>
                    </div>
                    <span><b>Las cartera debe ser registrados con el año actual, y las fechas<br>de inicio y fin con relacion a la resolucion de aprobacion de la cartera.</b></span>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Fecha Inicio Cartera <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" id="dateFechaIniCart" name="dateFechaIniCart" value="<?php if(isset($arrayCartera)){echo $arrayCartera->fecha_inicio_cartera;} else { echo date('Y-m-d');}?>" class="form-control col-md-7 col-xs-5" required="required" type="text">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="name">Fecha Fin Cartera <span class="required">*</span></label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="date" id="dateFechaFinCart" name="dateFechaFinCart" value="<?php if(isset($arrayCartera)){echo $arrayCartera->fecha_cierre_cartera;} else { echo date('Y-m-d');}?>" class="form-control col-md-7 col-xs-5" required="required" type="text">
                    </div>
                    <p style="color: red; display: none;" id="Advertencia">La Fecha de Inicio no puede ser mayor a la Fecha de Fin</p>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12"  for="name">Estado <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <select class="form-control" id="estadoCartera" name="estadoCartera">
                      <option value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    </select>
                  </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Numero Resolucion Cartera</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="txt_NumResolucionCart" name="txt_NumResolucionCart" class="form-control col-md-7 col-xs-12" placeholder="Numero Resolucion Cartera"  type="text" value="<?php if(isset($arrayCartera->numero_resolucion_cartera)) echo $arrayCartera->numero_resolucion_cartera;?>">
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Adjuntar resolución</label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div><input type="file" class="form-control" name="cartera_resolucion" id="cartera_resolucion" ></div>
                        <?php
                        if(isset($arrayCartera->url_resolucion_cartera) and $arrayCartera->url_resolucion_cartera!='' ){
                        ?>
                        <div style="margin-top:5px;">
                          <a href="../../uploads/cartera/<?php echo $arrayCartera->url_resolucion_cartera; ?>" target="_blank"><i class='fa fa-file fa-2x'></i></a>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    <p style="color: red; display: block;" id="Advertencia">Solo se aceptan archivos en formato PDF, JPG y PNG</p>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button   class="btn btn-success" type="button" id="sendCartera">
                            <span class="glyphicon glyphicon-floppy-disk"></span>
                            Guardar
                        </button>
                        <button  data-dismiss="modal" class="btn btn-danger">
                            <span class="glyphicon glyphicon-remove"></span>
                            Cerrar ventana
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
$(document).ready(function()
{
    $('input[type="date"]').change(function()
    {
        var fecha1 = $('#dateFechaIniCart').val();
        var fecha2 = $('#dateFechaFinCart').val();
        if ((Date.parse(fecha1)) > (Date.parse(fecha2)))
        {
            $('#Advertencia').css('display','block');
        }
        else
        {
            $('#Advertencia').css('display','none');
        }
    });
});

$(function(){
    $("#form-RegistraCarteraInv").submit(function(event){
    event.preventDefault();
    $.ajax({
        url:$("#form-RegistraCarteraInv").attr("action"),
        type:$(this).attr('method'),
        data: new FormData(this),
        processData: false,
        contentType: false,
        success:function(resp)
        {
            resp = JSON.parse(resp);
            ((resp.proceso=='Correcto') ? swal(resp.proceso,resp.mensaje, "success") : swal(resp.proceso,resp.mensaje, "error"));
            $('#table-CarteraInv').dataTable()._fnAjaxUpdate();
        }
    });
});

    $("body").on("click","#sendCartera",function(e)
    {
        $('#form-RegistraCarteraInv').data('formValidation').validate();
        if($('#form-RegistraCarteraInv').data('formValidation').isValid()==true)
        {
            $('#form-RegistraCarteraInv').submit();
            $('#form-RegistraCarteraInv').each(function()
            {
                this.reset();
            });
            $('.selectpicker').selectpicker('refresh');
            $('#form-RegistraCarteraInv').data('formValidation').resetForm();
            $('#form-RegistraCarteraInv').off();
            $('#form-RegistraCarteraInv').remove();
            $('#form-RegistraCarteraInv').empty();
            $('#null').modal('hide');
        }
    });

    $("body").on("change","#dateAñoAperturaCart",function(e)
    {
        $("#dateFechaIniCart").val($("#dateAñoAperturaCart").val()+'-01-01');
        $("#dateFechaFinCart").val($("#dateAñoAperturaCart").val()+'-03-30');
    });
});

$(document).ready(function()
{
    <?php if(isset($arrayCartera->id_cartera)) { ?>
        $("#form-RegistraCarteraInv").attr("action",base_url+"index.php/CarteraInversion/EditCartera/<?php echo $arrayCartera->id_cartera; ?>");
    <?php }
    else { ?>
        $("#form-RegistraCarteraInv").attr("action",base_url+"index.php/CarteraInversion/AddCartera");
    <?php } ?>
    $('#form-RegistraCarteraInv').formValidation({
        fields:
        {
            dateFechaFinCart:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Fecha de Inicio" es requerido.</b>'
                    }
                }
            },
            dateFechaIniCart:
            {
                validators:
                {
                    notEmpty:
                    {
                        message: '<b style="color: red;">El campo "Fecha Fin" es requerido.</b>'
                    }
                }
            },
        }
    });

});
</script>
