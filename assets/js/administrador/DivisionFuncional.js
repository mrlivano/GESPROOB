$(document).on("ready" ,function()
{
    FuncionCombo();
    listaProvinciaCombo();
    listarDivisionF();
    $("#btn_Nuevadivision").click(function()
    {
         listaFuncionCombo();
    });

    $('#listaFuncion').on('change', function()
    {
        var idFuncion = $("#listaFuncion").val();
        if(idFuncion == '')
        {
            $("#listaDivisionFuncional").html('');
            $("#listaDivisionFuncional").selectpicker('refresh');
            $("#listaGrupoFuncional").html('');
            $("#listaGrupoFuncional").selectpicker('refresh');
        }
        else
        {
            listaDivisionFuncionalCombo(null);
        }
    })
    $('#listaDivisionFuncional').on('change', function()
    {
        var idDivisionFuncional = $("#listaDivisionFuncional").val();
        if(idDivisionFuncional == '')
        {
            $("#listaGrupoFuncional").html('');
            $("#listaGrupoFuncional").selectpicker('refresh');
        }
        else
        {
            listaGrupoFuncionalCombo(null);
        }
    })
    $('#listaProvincia').on('change', function()
    {
        listaDistritoCombo(null);
    })

    $("#btnBuscar").click(function()
    {
        listaProyectos();
    });

    


    $("#form-AddDivisionFuncion").submit(function(event)
    {
        event.preventDefault();
        $('#validarDivisionFuncional').data('formValidation').validate();
        if(!($('#validarDivisionFuncional').data('formValidation').isValid()))
        {
            return;
        }

        $.ajax(
        {
            url:base_url+"index.php/DivisionFuncional/AddDivisionFucion",
            type:$(this).attr('method'),
            data:$(this).serialize(),
            success:function(resp)
            {
                if (resp == "1")
                {
                    swal("","Codigo Division Funcional Duplicado.", "error");
                }
                if (resp == "0")
                {
                    swal("","Se Añadió Correctamente.", "success");
                }
                $('#table-DivisionF').dataTable()._fnAjaxUpdate();
                $('#VentanaRegistraDivisionF').modal('hide');
            },
            error:function()
            {
                swal("Error","Ha ocurrido un error Inesperado", "success");
                $('#VentanaRegistraDivisionF').modal('hide');
            }
        });
    });

    $("#form-UpdateDivisionFuncion").submit(function(event)//para modificar la  division funcional
    {
        event.preventDefault();

        $('#EditarDivisionFuncional').data('formValidation').validate();
        if(!($('#EditarDivisionFuncional').data('formValidation').isValid()))
        {
            return;
        }

        $.ajax(
        {
            url : base_url+"index.php/DivisionFuncional/UpdateDivisionFucion",
            type : $(this).attr('method'),
            data : $(this).serialize(),
            success : function(resp)
            {
                swal("",resp, "success");

                $('#table-DivisionF').dataTable()._fnAjaxUpdate();

                $('#VentanaUpdateDivisionF').modal('hide');
            },
            error:function()
            {
                swal("Error","Ha ocurrido un error Inesperado", "error");
                $('#VentanaUpdateDivisionF').modal('hide');
            }
        });
    });
});

    /*listra funcion*/
    var listaFuncionCombo=function(valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
    {
        event.preventDefault();

        var htmlTemp="";

        $("#listaFuncionC").html(htmlTemp);

        $.ajax(
        {
            "url" : base_url +"index.php/Funcion/GetFuncion",
            type : "POST",
            success : function(respuesta)
            {
                var registros=eval(respuesta);

                for(var i=0; i<registros.length; i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_funcion"]+"> "+ registros[i]["codigo_funcion"]+": "+registros[i]["nombre_funcion"]+" </option>";
                };

                $("#listaFuncionC").html(htmlTemp);//para modificar las entidades
                $("#listaFuncionCM").html(htmlTemp);//para modificar las entidades
                $('select[name=listaFuncionCM]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                $('select[name=listaFuncionCM]').change();

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    /* listar y lista en tabla entidad*/
    var listarDivisionF=function()
    {
        var table=$("#table-DivisionF").DataTable(
        {
            "processing" : true,
            "serverSide" : false,
            "destroy" : true,
            "order": [[3,'asc']],
            "language" : idioma_espanol,
            "ajax" :
            {
                "url" : base_url+"index.php/DivisionFuncional/GetDivisionFuncional",
                "method" : "POST",
                "dataSrc" : ""
            },
            "columns" : [
            { "data" : "id_div_funcional","visible" : false },
            { "data" : "id_funcion","visible" : false },
            { "data" : "nombre_funcion" },
            { "data" : "codigo_div_funcional" },
            { "data" : "nombre_div_funcional" },
            { "defaultContent" : "<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateDivisionF'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>" }],
      "language":idioma_espanol
        });

        DivisionFuncionData("#table-DivisionF", table);  //obtener data de la division funcional para agregar  AGREGAR
        EliminarDivFuncional("#table-DivisionF", table);
    }

    var  DivisionFuncionData=function(tbody, table)
    {
        $(tbody).on("click","button.editar",function()
        {
            var data=table.row( $(this).parents("tr")).data();
            var id_funcion=data.id_funcion;
            var id_DfuncionalM=$('#id_DfuncionalM').val(data.id_div_funcional);
            var txt_CodigoDfuncionalM=$('#txt_CodigoDfuncionalM').val(data.codigo_div_funcional);
            var txt_Nombre_DFuncionalM=$('#txt_Nombre_DFuncionalM').val(data.nombre_div_funcional);

            listaFuncionCombo(id_funcion);//para agregar funcion selecionada mandamos parametro
        });
    }


    /*Idioma de datatablet table-sector */
    var idioma_espanol=
    {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

    /*Mostrar division funcional en base a la funcion*/
    var FuncionCombo=function()
    {
        var htmlTemp='<option value = "">Seleccionar Funcion</option>';
        $("#listaFuncion").html(htmlTemp);
        paginaAjaxJSON(null, base_url +"index.php/Funcion/GetListaFuncion", "POST", null, function(objectJSON)
        {
            objectJSON=JSON.parse(objectJSON);
            var registros=eval(objectJSON);
            for(var i=0; i<registros.length; i++)
            {
                htmlTemp+='<option value="'+registros[i]['id_funcion']+'">'+registros[i]['nombre_funcion']+ '</option>';
            };

            $("#listaFuncion").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }, false, true);
    }


    /*Mostrar division funcional en base a la funcion*/
    var listaDivisionFuncionalCombo=function(valor)
    {
        //var htmlTemp='';
        var htmlTemp='<option value = "">Seleccionar Division Funcional</option>';
        $("#listaDivisionFuncional").html(htmlTemp);
        var idFuncion = $("#listaFuncion").val();
        paginaAjaxJSON({ idFuncion : idFuncion }, base_url +"index.php/Funcion/GetDivisionFuncional", "POST", null, function(objectJSON)
        {
            objectJSON=JSON.parse(objectJSON);
            var registros=eval(objectJSON);
            for(var i=0; i<registros.length; i++)
            {
                //htmlTemp+='<option value="'+registros[i]['id_div_funcional']+'">'+ registros[i]['codigo_div_funcional']+':'+registros[i]['nombre_div_funcional']+'</option>';
                htmlTemp+='<option value="'+registros[i]['id_div_funcional']+'">'+registros[i]['nombre_div_funcional']+'</option>';
            };

            $("#listaDivisionFuncional").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }, false, true);
    }

    /*Mostrar grupo funcional en base a la division funcional*/
    var listaGrupoFuncionalCombo=function(valor)
    {
        //var htmlTemp='';
        var htmlTemp='<option value = "">Seleccionar Grupo Funcional</option>';
        $("#listaGrupoFuncional").html(htmlTemp);
        var idDivisionFuncional = $("#listaDivisionFuncional").val();
        paginaAjaxJSON({ idDivisionFuncional : idDivisionFuncional }, base_url +"index.php/Funcion/GetGrupoFuncional", "POST", null, function(objectJSON)
        {
            objectJSON=JSON.parse(objectJSON);
            var registros=eval(objectJSON);
            for(var i=0; i<registros.length; i++)
            {
                htmlTemp+='<option value="'+registros[i]['id_grup_funcional']+'">'+registros[i]['nombre_grup_funcional']+'</option>';
            };

            $("#listaGrupoFuncional").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }, false, true);
    }

    /*Mostrar listado de provincias en un combobox*/
    var listaProvinciaCombo=function(valor)
    {
        var htmlTemp='<option value = "">Seleccionar Provincia</option>';
        $("#listaProvincia").html(htmlTemp);
        paginaAjaxJSON(null, base_url +"index.php/Funcion/GetProvincia", "POST", null, function(objectJSON)
        {
            objectJSON=JSON.parse(objectJSON);
            var registros=eval(objectJSON);
            for(var i=0; i<registros.length; i++)
            {
                htmlTemp+='<option value="'+registros[i]['provincia']+'">'+registros[i]['provincia']+'</option>';
            };

            $("#listaProvincia").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }, false, true);
    }

    /*Mostrar listado de distritos en base a la Provincia*/
    var listaDistritoCombo=function(valor)
    {
        var htmlTemp="<option value = ''>Seleccionar Distrito</option>";
        $("#listaDistrito").html(htmlTemp);
        var provincia = $("#listaProvincia").val();
        paginaAjaxJSON({ provincia : provincia }, base_url +"index.php/Funcion/GetDistrito", "POST", null, function(objectJSON)
        {
            objectJSON=JSON.parse(objectJSON);
            var registros=eval(objectJSON);
            for(var i=0; i<registros.length; i++)
            {
                htmlTemp+='<option value="'+registros[i]['distrito']+'">'+registros[i]['distrito']+' </option>';
            };

            $("#listaDistrito").html(htmlTemp);
            $('.selectpicker').selectpicker('refresh');
        }, false, true);
    }

    /*Listar proyectos por distintos parametros*/
    var listaProyectos=function()
    {
        var idFuncion = $("#listaFuncion").val();
        var idDivisionFuncional = $("#listaDivisionFuncional").val();
        var idGrupoFuncional = $("#listaGrupoFuncional").val();
        var idProvincia = $("#listaProvincia").val();
        var idDistrito = $("#listaDistrito").val();
        var deFecha = $('#deFecha').val();
        var aFecha = $("#aFecha").val();
        $.ajax({
            url: base_url +"index.php/Funcion/ProyectosPorCadenaFuncional",
            type: 'POST',
            cache: false,
            data:
            {
                idFuncion: idFuncion,
                idDivisionFuncional : idDivisionFuncional,
                idGrupoFuncional: idGrupoFuncional,
                idProvincia:idProvincia,
                idDistrito:idDistrito,
                deFecha:deFecha,
                aFecha:aFecha
            },
            beforeSend: function(xhr)
            {
                renderLoading();
            },
            success: function (data)
            {
                $('#divModalCargaAjax').hide();

                $('#dataTableFuncion').html(data);
            },
            error: function ()
            {
                $('#divModalCargaAjax').hide();

                alert("Ocurrio un error!");
            }
        });
    }
                var EliminarDivFuncional=function(tbody,table){
                  $(tbody).on("click","button.eliminar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_div_funcional=data.id_div_funcional;
                         swal({
                                title: "Desea eliminar el Registro ?",
                                text: "",
                                type: "warning",
                                showCancelButton: true,
                                cancelButtonText:"Cerrar" ,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "SI,Eliminar",
                                closeOnConfirm: false
                              },
                              function(){
                                    $.ajax({
                                          url:base_url+"index.php/DivisionFuncional/EliminarDivisionFunc",
                                          type:"POST",
                                          data:{id_div_funcional:id_div_funcional},
                                          success:function(resp)
                                          {
                                                resp = JSON.parse(resp);
                                                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto'?'success':'error'));
                                                $('#table-DivisionF').dataTable()._fnAjaxUpdate();
                                           },
                                            error: function ()
                                            {
                                                swal("Error", "Ocurrió un error en la conexión, vuelva a intentarlo", "error")
                                            }
                                        });
                              });
                    });
                }
            var idioma_espanol=
                {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }

    $(function() 
    {
     
        $('#validarDivisionFuncional').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_CodigoDfuncional: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Código" es requerido.</b>'
                     },
                     stringLength: {
                         max: 3,
                         message: '<b style="color: red;">El campo "Código" debe tener como máximo 03 caracteres.</b>'
                     },
                     regexp: {
                          regexp: /^[0-9]+$/,
                         message: '<b style="color: red;">El campo "Código" debe contener solamente números.</b>'
                     }
                 }
             },
        txt_Nombre_DFuncional: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Nombre" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
     $('#EditarDivisionFuncional').formValidation({
         framework: 'bootstrap',
         excluded: [':disabled', ':hidden', ':not(:visible)', '[class*="notValidate"]'],
         live: 'enabled',
         message: '<b style="color: #9d9d9d;">Asegúrese que realmente no necesita este valor.</b>',
         trigger: null,
         fields: {
             txt_CodigoDfuncionalM: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Código" es requerido.</b>'
                     },
                     stringLength: {
                         max: 3,
                         message: '<b style="color: red;">El campo "Código" debe tener como máximo 03 caracteres.</b>'
                     },
                     regexp: {
                          regexp: /^[0-9]+$/,
                         message: '<b style="color: red;">El campo "Código" debe contener solamente números.</b>'
                     }
                 }
             },
        txt_Nombre_DFuncionalM: {
                 validators: {
                     notEmpty: {
                         message: '<b style="color: red;">El campo "Nombre" es requerido.</b>'
                     },
                     stringLength: {
                         max: 199,
                         message: '<b style="color: red;">El campo "Nombre" debe tener como máximo 199 caracteres.</b>'
                     },
                     regexp: {
                         regexp: /^[a-z\s]+$/i,
                         message: '<b style="color: red;">El campo "Nombre" debe contener solamante caracteres alfabéticos y espacios.</b>'
                     }
                 }
             }
         }
     });
 });
