 $(document).on("ready" ,function(){
                //alert("sdas");
               //lista();
            //division funcional

                listaFuncion();/*llamar a mi datatablet listar funcion*/
                $("#btn_Nuevadivision").click(function()//para que cargue el como una vez echo click sino repetira datos
                    {
                     listaFuncionCombo();//para llenar el combo de agregar division funcional
                    });
                $("#form-addFuncion").submit(function(event)//para añadir nueva funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/AddFucion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                          $('#table-Funcion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                           //listaSectorCombo();//llamado para la recarga al añadir un nuevo secto
                            listaFuncionCombo();
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });
                $("#form-ModificarFuncion").submit(function(event)//Actualizar funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/UpdateFuncion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-Funcion').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                           listaFuncionCombo();
                         },
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                      });
                  });    
                //fin de  funcional
        //division  funcional

               listarDivisionF();//para mostrar las divisiones funcionanes

                $("#form-AddDivisionFuncion").submit(function(event)//para añadir nuevo division funcional
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/AddDivisionFucion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                          swal("",resp, "success");
                          $('#table-DivisionF').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                           //listaSectorCombo();//llamado para la recarga al añadir un nuevo secto  
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });
                 $("#form-UpdateDivisionFuncion").submit(function(event)//para modificar la  division funcional
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/UpdateDivisionFucion",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                          $('#table-DivisionF').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet   funcion   
                           //listaSectorCombo();//llamado para la recarga al añadir un nuevo secto    

                         },
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                      });
                  });

        //fin division funcional
       //grupo funcional
            //listra sectores y division funcional para agregar grupo funcional
             $("#btn_nuevoGrupoFuncional").click(function(){
                listarDivisionFcombo();
             });
             $("#SelecDivisionFF").change(function(){//para cargar en agregar division funcionañ
                    listarSectorcombo();
             });

              listarGrupoF();/*llamar a mi metodo listado servicio publico asociado*/
              //registra  grupo  funcional
              $("#form-AddGrupoFuncional").submit(function(event)//Actualizar funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/AddGrupoFuncional",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-listarGrupoFuncional').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  });   

               $("#form-UpadataGrupoFuncional").submit(function(event)//Actualizar funcion
                  {
                      event.preventDefault();
                      $.ajax({
                          url:base_url+"index.php/MFuncion/UpdateGrupoFuncional",
                          type:$(this).attr('method'),
                          data:$(this).serialize(),
                          success:function(resp){
                           swal("",resp, "success");
                           $('#table-listarGrupoFuncional').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                         },
                          error: function ()
                          {
                              swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                          }
                      });
                  }); 
              //fin registra grupo funcional

        //fin grupo funcional

			});
    /*listra funcion*/
    var listaFuncion=function()
    {
        var table=$("#table-Funcion").DataTable(
        {
            "processing" : true,
            "serverSide" : false,
            "destroy" : true,
            "language" : idioma_espanol,
            "ajax" :
            {
                "url" : base_url+"index.php/MFuncion/GetFuncion",
                "method" : "POST",
                "dataSrc" : ""
            },
            "columns" : [
                { "data" : "id_funcion" },
                { "data" : "codigo_funcion" },
                { "data" : "nombre_funcion" },
                { "defaultContent" : "<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaModificarFuncion'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>" }]
        });

        FuncionData("#table-Funcion", table);
        EliminarFuncion("#table-Funcion", table);
    }

    var FuncionData=function(tbody, table)
    {
        $(tbody).on("click", "button.editar", function()
        {
            var data=table.row( $(this).parents("tr")).data();
            var txt_IdfuncionM=$('#txt_IdfuncionM').val(data.id_funcion);
            var txt_codigofuncionM=$('#txt_codigofuncionM').val(data.codigo_funcion);
            var txt_nombrefuncionM=$('#txt_nombrefuncionM').val(data.nombre_funcion);
        });
    }

    var EliminarFuncion=function(tbody,table)
    {
        $(tbody).on("click", "button.eliminar", function()
        {
            var data=table.row($(this).parents("tr")).data();
            
            swal(
            {
                title : "Desea eliminar funcion?",
                text : "",
                type : "warning",
                                showCancelButton: true,
                                cancelButtonText:"Cerrar" ,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "SI,Eliminar",
                                closeOnConfirm: false
            },
            function()
            {
                $.ajax(
                {
                    "url" : base_url+"index.php/MSectorEntidadSpu/EliminarSector1",
                    "type" : "POST",
                    "data" : { "id_sector" : id_sector },
                    "success" : function(respuesta)
                    {
                        swal("Eliminado!", "Se elimino corectamente el sector.", "success");

                        $('#table-sector').dataTable()._fnAjaxUpdate();//para actualizar mi datatablet datatablet
                    },
                    error: function ()
                    {
                        swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                    }
                });
            });
        });
    }
                var listaFuncionCombo=function(valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
                {
                    html="";
                    $("#listaFuncionC").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/MFuncion/GetFuncion",
                        type:"POST",
                        success:function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_funcion"]+"> "+ registros[i]["codigo_funcion"]+": "+registros[i]["nombre_funcion"]+" </option>";   
                            };
                            $("#listaFuncionC").html(html);//para modificar las entidades

                            $("#listaFuncionCM").html(html);//para modificar las entidades 
                            $('select[name=listaFuncionCM]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=listaFuncionCM]').change();

                            $('.selectpicker').selectpicker('refresh'); 
                            //listaFuncionCombo(); //PARA LLENAR CON EXACTITUD LOS DATOS
                        },
                        error: function ()
                        {
                            swal("Error", "Usted no tiene permisos para realizar esta acción", "error")
                        }
                    });
                }
                /*fin listar funcion*/
                var listarDivisionFcombo=function(valor_idDivision,valor_id_sector){

                     html="";
                    $("#SelecDivisionFF").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/MFuncion/GetDivisionFuncional",
                        type:"POST",
                        success:function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_division_funcional"]+"> "+ registros[i]["codigo_dfuncional"]+":"+registros[i]["nombre_dFuncional"]+" </option>";   
                            };
                            $("#SelecDivisionFF").html(html);
                            
                            $("#SelecDivisionFFF").html(html);
                            $('select[name=SelecDivisionFFF]').val(valor_idDivision);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=SelecDivisionFFF]').change();

                            $('.selectpicker').selectpicker('refresh'); 
                            listarSectorcombo(valor_id_sector);
                            //listaFuncionCombo(); //PARA LLENAR CON EXACTITUD LOS DATOS
                        }
                    });

                }
                  var listarSectorcombo=function(varlor){
                    html="";
                    $("#SelecSector").html(html); 
                    event.preventDefault(); 
                    $.ajax({
                        "url":base_url +"index.php/MSectorEntidadSpu/GetSector",
                        type:"POST",
                        success:function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_sector"]+"> "+ registros[i]["nombre_sector"]+" </option>";   
                            };
                            $("#SelecSector").html(html);
                            $("#SelecSectorF").html(html);
                            $('select[name=SelecSectorF]').val(varlor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=SelecSectorF]').change();
                            
                            $('.selectpicker').selectpicker('refresh'); 
                            //listaFuncionCombo(); //PARA LLENAR CON EXACTITUD LOS DATOS
                        }
                    });
                  }

                  /* listar y lista en tabla entidadr*/ 
                var listarDivisionF=function()
                {
                    var table=$("#table-DivisionF").DataTable({

                     "processing":true,
                     "serverSide":false,
                     destroy:true,

                         "ajax":{
                                    "url":base_url+"index.php/MFuncion/GetDivisionFuncional",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_division_funcional"},
                                    {"data":"id_funcion","visible": false},
                                    {"data":"nombre_funcion"},
                                    {"data":"codigo_dfuncional"},
                                    {"data":"nombre_dFuncional"},
                                    {"defaultContent":"<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateDivisionF'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    DivisionFuncionData("#table-DivisionF",table);  //obtener data de la division funcional para agregar  AGREGAR                 
                }

                  var  DivisionFuncionData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){

                        var data=table.row( $(this).parents("tr")).data();
                        var id_funcion=data.id_funcion;
                        console.log(id_funcion);
                        var id_DfuncionalM=$('#id_DfuncionalM').val(data.id_division_funcional);
                        var txt_CodigoDfuncionalM=$('#txt_CodigoDfuncionalM').val(data.codigo_dfuncional);
                        var txt_Nombre_DFuncionalM=$('#txt_Nombre_DFuncionalM').val(data.nombre_dFuncional);
                          /*$('select[name=listaFuncionCM]').val(id_funcion);//PARA AGREGAR UN COMBO PSELECIONADO
                          $('select[name=listaFuncionCM]').change();*/
                           listaFuncionCombo(id_funcion);//para agregar funcion selecionada mandamos parametro
                    });

                }

                /*fin crea tabla division funcional*/ 
                /*crear tabla dinamica servicio publico asociado */
                var listarGrupoF=function()
                {
                    var table=$("#table-listarGrupoFuncional").DataTable({

                     "processing":true,
                     "serverSide":false,
                      destroy:true,
                         "ajax":{
                                    "url": base_url+"index.php/MFuncion/GetGrupoFuncional",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_grupo_funcional"},
                                    {"data":"codigo_g_funcional"},
                                    {"data":"nombre_g_funcional"},
                                    {"data":"id_division_funcional"},
                                    {"data":"codigo_dfuncional"},
                                    {"data":"nombre_dFuncional"},
                                    {"data":"id_sector"},
                                    {"data":"nombre_sector"},
                                    {"defaultContent":"<button type='button'  class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#VentanaUpdateGrupoF'><i class='ace-icon fa fa-pencil bigger-120'></i></button><button type='button' class='eliminar btn btn-danger btn-xs' data-toggle='modal' data-target='#'><i class='fa fa-trash-o'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                    GrupoFuncionalData("#table-listarGrupoFuncional",table);  //obtener data de la division funcional para agregar  AGREGAR                 
                }
                   var  GrupoFuncionalData=function(tbody,table){
                    $(tbody).on("click","button.editar",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var id_division_funcional=data.id_division_funcional;
                        var id_sector=data.id_sector;
                        var txt_idGfuncionF=$('#txt_idGfuncionF').val(data.id_grupo_funcional);
                        var txt_codigoGfuncionF=$('#txt_codigoGfuncionF').val(data.codigo_g_funcional);
                        var txt_nombreGfuncionF=$('#txt_nombreGfuncionF').val(data.nombre_g_funcional);
                        listarDivisionFcombo(id_division_funcional,id_sector);//para agregar division  funcional
                        $('select[name=SelecSectorF]').val(id_sector);//PARA AGREGAR UN COMBO PSELECIONADO
                        $('select[name=SelecSectorF]').change();
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

        /* function lista()
					{
						event.preventDefault();
						$.ajax({
              "url": base_url+"index.php/MFuncion/GetGrupoFuncional",
							type:"POST",
							success:function(respuesta){
								alert(respuesta);
							

							}
						});
					}*/
