<div class="row">
	<div class="col-md-9">
		<label for="tx_mensaje">Mensaje: </label>
		<textarea id="tx_mensaje" style="width:100%;"></textarea>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<label for="">Elige a los detinatarios del mensaje: </label>
		<select id="sl_usuario" name="sl_usuario[]" multiple style="width:100%;height:200px;"></select>
	</div>
	<div class="col-md-1"  style="padding-top:20px;">
		<button id="bt_Dererecha" class="btn btn-info" type="button" style="width:100%; text-align:center;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></button>
        <button id="bt_Izquierda" type="button" class="btn btn-warning" style="width:100%;margin-top:10px; text-align:center;"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button>
	</div>
	<div class="col-md-4">
		<label for="">&nbsp;</label>
		<select id="sl_destino" name="sl_destino[]" multiple style="width:100%;height:200px;"></select>
	</div>
</div>
<div class="row">
	<div class="col-md-11" style="margin-top:2px;">
		<button type="button" id="bt_sendMensaje" class="btn btn-primary">Enviar</button>&nbsp;<button type="button" id="bt_cancelMensaje" class="btn btn-danger">Cancelar</button>
	</div>
</div>
<script type="text/javascript">
	function listarUsuario(){
		var html="";
        $.ajax({
            "url":base_url +"index.php/Usuario/getUsuario/",
            async:false,
            type:"POST",
            success:function(respuesta){
                var registros = eval(respuesta);
                for (var i = 0; i <registros.length;i++){
                  html +="<option value="+registros[i]["id_persona"]+"> "+registros[i]["desc_usuario_tipo"]+": "+registros[i]["nombres"]+" </option>";   
                };
                $("#sl_usuario").html(html);
                $('#sl_destino option').each(function(){
                    $("#sl_usuario option[value='"+$(this).val()+"']").remove();
                });
            }
        });
	}
	$(function(){
		$("#bt_sendMensaje").click(function() {
		  var string ='';
	        var c=0;
	        $("#sl_destino option").each(function(){
	              if(c>0)
	                string+='-';  
	              string+=$(this).attr('value');
	              c++;
	        });
	        var formData = {tx_mensaje:$("#tx_mensaje").val(),sl_destino:string};
	        $.ajax({
	            url:base_url+"index.php/mensaje/enviar",
	            type: "POST",
	            data : formData,
	            dataType: "json",
	            success:function(data){
	                if(data==true)
			          swal("","Se envió el mensaje!","success");
			        else
			          swal("","Error... no se envió el mensaje","error");
	            }
	        });
		});
		$("body").on("click","#bt_cancelMensaje",function(e){
			$('#dg_enviarMensaje').modal('hide');
		});
		$("body").on("click","#bt_Dererecha",function(e){
	        $('#sl_usuario option:selected').each(function(){
	            var seleccionado=$(this).val();
	            $('#sl_destino').append("<option title='"+$(this).text()+"' value='"+$(this).val()+"'>"+$(this).text()+"</option>");
	            $(this).remove();
	        }); 
	  	});
	  	$("body").on("click","#bt_Izquierda",function(e){
	        $('#sl_destino option:selected').each(function(){
	            var seleccionado=$(this).val();
	            $('#sl_usuario').append("<option title='"+$(this).text()+"' value='"+$(this).val()+"'>"+$(this).text()+"</option>");
	            $(this).remove();
	        }); 
	  	});
	}); 
	$(document).ready(function(){
		listarUsuario();
	}); 
</script>