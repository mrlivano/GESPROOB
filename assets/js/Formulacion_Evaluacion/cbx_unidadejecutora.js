$(document).on("ready" ,function(){

               $("#btn_nuevoEstInv").click(function(){
                // alert("hola");
                 listarufcombo();
             });  
 
    

      });
         
                /*fin listar unidad formulador*/
                var listarufcombo=function(valor_idDivision,valor_id_sector){
                     html="";
                    $("#lista_unid_form").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/Estudio_Inversion/get_UnidadFormuladora",
                        type:"POST",
                        success:function(respuesta2){
                          // alert(respuesta);
                         var registros = eval(respuesta2);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option id='lista_unid_form' name='lista_unid_form' value="+registros[i]["id_uf"]+">"+registros[i]["nombre_uf"]+" </option>";   
                            }; 
                            $("#lista_unid_form").html(html);
                            $("#SelecDivisionFFF").html(html);
                            $('select[name=SelecDivisionFFF]').val(valor_idDivision);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=SelecDivisionFFF]').change();
                            $('.selectpicker').selectpicker('refresh'); 
                        }
                    });
                }

                 /*fin listar unidad formulador*/
    