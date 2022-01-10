<div class="modal-body">
  <div class="row">
    <div class="col-xs-12">
      <form class="form-horizontal " name="frmPrioridad" id="frmPrioridad" method="post"  enctype="multipart/form-data" onSubmit="return false;">
        <div class="item form-group">
          <table class="table tablePrioridad">
            <thead style="background-color:#5A738E;color:#FFFFFF;">
              <tr><th>PESO</th><th>CRITERIOS</th><th>Ptje.</th><th>Ptje.*Peso</th><th colspan="10"></th></tr>
            </thead>
           
            <tbody>
              <?php
              for($i=0;$i<count($arrayValorizacion);$i++){
                $check='';
                if($arrayValorizacion[$i]['puntaje_valP']!=''){
                  $check=' checked="" ';
                }
                if(($i>0) and ($arrayValorizacion[$i]['id_criterio']==$arrayValorizacion[$i-1]['id_criterio'])){
                  echo "<td style='width:130px;'><div class='radio'>
                          <label><input ".$check." onclick=puntaje('".$arrayValorizacion[$i]['id_criterio']."','".$arrayValorizacion[$i]['puntaje_val']."','".$arrayValorizacion[$i]['peso']."'); type='radio' id='rb_".$arrayValorizacion[$i]['id_criterio']."' name='rb_".$arrayValorizacion[$i]['id_criterio']."' value='".$arrayValorizacion[$i]['id_valorizacion']."'/> ".$arrayValorizacion[$i]['nombre_val']."</label>
                        </div></td>";
                }
                else{
                  if($i>0){
                    echo "</td></tr>";
                  }
                  echo "<tr><td>".$arrayValorizacion[$i]['denPeso']."</td><td>".$arrayValorizacion[$i]['nombre_criterio']."</td><td><input readonly='' class='ptje' type='text' name='tx_ptje_".$arrayValorizacion[$i]['id_criterio']."' id='tx_ptje_".$arrayValorizacion[$i]['id_criterio']."'  /></td><td><input readonly='' class='peso' type='text' name='tx_peso_".$arrayValorizacion[$i]['id_criterio']."' id='tx_peso_".$arrayValorizacion[$i]['id_criterio']."'  /></td><td> 
                    <td style='width:130px;'><div class='radio'>
                      <label><input ".$check." onclick=puntaje('".$arrayValorizacion[$i]['id_criterio']."','".$arrayValorizacion[$i]['puntaje_val']."','".$arrayValorizacion[$i]['peso']."'); type='radio' id='rb_".$arrayValorizacion[$i]['id_criterio']."' name='rb_".$arrayValorizacion[$i]['id_criterio']."' value='".$arrayValorizacion[$i]['id_valorizacion']."'/> ".$arrayValorizacion[$i]['nombre_val']."</label>
                    </div></td>";
                }   
              }
              ?>
            </tbody>
            <tfoot >
              <tr style='border-top:solid 2px #5A738E;'><td colspan="4" style="text-align:right;padding-right:20px;"><strong>PRIORIDAD: </strong><input readonly='' class="total" type="text" id="tx_ptjeTotal" name="ptjeTotal" /></td><td colspan="10"></td></tr>
            </tfoot>
          </table>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-4 col-md-offset-8">
              <button onclick=guardarPrioridad("<?php echo $id_proyecto;?>");$('#null').modal('hide');$('#bt_<?php echo $id_proyecto;?>').trigger('click'); class="btn btn-success" type="button" id="sendPrioridad"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button>
              <button  data-dismiss="modal" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span>
                Cancelar</button>

                <!--<button  type='button' title='Programar' id="bt_prioridadAProgramar"  class='btn btn-warning btn-xs'  ><i class='fa fa-file-powerpoint-o ' aria-hidden='true'></i></button>-->



            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
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
  $(function(){
  
  }); 
  $(document).ready(function(){
    $("#frmPrioridad :input[type='radio']:checked").each(function(){
      $(this).trigger("click");
    });
  }); 

</script>
<style>
  .radio{
    display: inline;
  }
  .radio input[type='radio']{
    margin-top: 0;
  }
  .tablePrioridad .ptje{
    width: 40px;
    color: green;
    text-align: center;
  }
  .tablePrioridad .peso{
    width: 40px;
    color: #D9534F;
    text-align: center;
  }
  .tablePrioridad .total{
    width: 80px;
    color: black;
    text-align: right;
    font-weight: bold;
  }
</style>