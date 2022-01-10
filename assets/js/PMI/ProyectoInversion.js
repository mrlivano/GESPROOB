$(document).on("ready" ,function()
{
    var listarCicloInversion=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxEstadoCicloInv").html(htmlTemp); //nombre del selectpicker UNIDAD EJECUTORA

        $.ajax(
        {
            "url":base_url +"index.php/EstadoCicloInversion/get_EstadoCicloInversion",
            type:"POST",
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for(var i=0; i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_estado_ciclo"]+"> "+ registros[i]["nombre_estado_ciclo"]+" </option>";
                }
                $("#cbxEstadoCicloInv").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    var listarTipologiaInversion2=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxTipologiaInv").html(htmlTemp); //nombre del selectpicker Tipologia de inversion

        $.ajax(
        {
            "url":base_url +"index.php/TipologiaInversion/get_TipologiaInversion",
            type:"POST",
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for (var i=0;i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_tipologia_inv"]+"> "+ registros[i]["nombre_tipologia_inv"]+" </option>";
                }

                $("#cbxTipologiaInv").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    var listarNaturalezaInversion=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxNatI").html(htmlTemp); //nombre del selectpicker UNIDAD EJECUTORA

        $.ajax(
        {
            url:base_url+"index.php/TipologiaInversion/get_NaturalezaInversion",
            type:"POST",
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for (var i=0; i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_naturaleza_inv"]+"> "+ registros[i]["nombre_naturaleza_inv"]+" </option>";
                }

                $("#cbxNatI").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
    var listarProgramaPresupuestal=function()
    {
        var html="";
        $("#cbxProgramaPres").html(html); //nombre del selectpicker UNIDAD EJECUTORA
        event.preventDefault();
        $.ajax({
            url:base_url+"index.php/ProgramaPresupuestal/GetProgramaP",
            type:"POST",
            success : function(respuesta){
               // alert(respuesta);
             var registros = eval(respuesta);
                for (var i = 0; i <registros.length;i++) {
                  html +="<option value="+registros[i]["id_programa_pres"]+"> "+ registros[i]["nombre_programa_pres"]+" </option>";
                }
                $("#cbxProgramaPres").html(html);//
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    var listarNivelGobierno=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxNivelGob").html(htmlTemp); //nombre del selectpicker UNIDAD EJECUTORA

        $.ajax(
        {
            url:base_url +"index.php/NivelGobierno/get_NivelGobierno",
            type:'POST',
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for (var i=0; i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_nivel_gob"]+"> "+ registros[i]["nombre_nivel_gob"]+" </option>";
                }

                $("#cbxNivelGob").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    var listaUnidadEjecutora=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxUnidadEjecutora").html(htmlTemp); //nombre del selectpicker UNIDAD EJECUTORA

        $.ajax(
        {
            url:base_url +"index.php/UnidadE/GetUnidadE",
            type:"POST",
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for (var i=0; i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_ue"]+"> "+ registros[i]["nombre_ue"]+" </option>";
                }

                $("#cbxUnidadEjecutora").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    var listarFuncion=function()
    {
        event.preventDefault();

        var htmlTemp="";
        $("#cbxFuncion").html(htmlTemp); //nombre del selectpicker UNIDAD EJECUTORA

        $.ajax(
        {
            "url":base_url +"index.php/MFuncion/GetFuncion",
            type:"POST",
            success : function(respuesta)
            {
                var registros = eval(respuesta);

                for (var i=0; i<registros.length;i++)
                {
                    htmlTemp+="<option value="+registros[i]["id_funcion"]+"> "+ registros[i]["nombre_funcion"]+" </option>";
                }

                $("#cbxFuncion").html(htmlTemp);

                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
                //TRAER DATOS EN UN COMBO DE CICLO DE INVERSION
                var listarFuenteFinan=function()
                {
                    var htmlFuentFin="";
                    $("#cbxFuenteFinanc").html(htmlFuentFin); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/FuenteFinanciamiento/get_FuenteFinanciamiento",
                        type:"POST",
                        success : function(respuesta){
                           //alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              htmlFuentFin +="<option value="+registros[i]["id_fuente_finan"]+"> "+ registros[i]["nombre_fuente_finan"]+" </option>";
                            }
                            $("#cbxFuenteFinanc").html(htmlFuentFin);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN UN COMBO DE CICLO DE INVERSION
        /*var listarMetaPresupuestal=function()
                {
                    htmlMeta="";
                    $("#cbxMetaPresupuestal").html(htmlMeta); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/MetaPresupuestal/GetMetaP",
                        type:"POST",
                        success : function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              htmlMeta +="<option value="+registros[i]["id_meta_pres"]+"> "+ registros[i]["numero_meta_pres"]+" </option>";
                            }
                            $("#cbxMetaPresupuestal").html(htmlMeta);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }*/
    listaProyectoInversion();
    listarCicloInversion();
    listarTipologiaInversion2();
    listarNaturalezaInversion();
    listarNivelGobierno();
    listarProgramaPresupuestal();
    listaUnidadEjecutora();
    listarFuncion();
    listarFuenteFinan();
    //listarMetaPresupuestal();
    $("#btn-NuevoProyectoI").click(function()
    {
        listarTipoInversion();
    });


    $("#cbxFuncion").change(function()
    {
        var id_funcion=$("#cbxFuncion").val();

        listarDivisionFuncional(id_funcion);

        $('#cbxDivFunc').removeAttr('disabled');
        $('#cbxGrupoFunc').attr('disabled', 'disabled');

        $('#cbxDivFunc').html('');
        $('#cbxGrupoFunc').html('');

        $('.selectpicker').selectpicker('refresh');
    });

    $("#cbxDivFunc").change(function()
    {
        $('#cbxGrupoFunc').html('');

        var id_div_funcional=$("#cbxDivFunc").val();

        listarGrupoFuncional(id_div_funcional);

        $('#cbxGrupoFunc').removeAttr('disabled');

        $('.selectpicker').selectpicker('refresh');
    });

   /* $("#cbxGrupoFunc").change(function()
    {
        listarMetaPresupuestal();
    });*/

              //TRAER EN COMBOBOX DIVISION FUNCIONAL
               //TRAER EN COMBOBOX PIM
            /*  $("#cbxMetaPresupuestal").change(function(){//para cargar en agregar division funcionañ
                    listarFuenteFinan();
             });*/
              //TRAER EN COMBOBOX DIVISION FUNCIONAL
               //OBTENER DATOS RUBRO DE EJECUCION
              $("#cbxFuenteFinanc").change(function(){//para cargar en agregar division funcionañ

                      var id_fuente_finan=$("#cbxFuenteFinanc").val();
                        listarRubro(id_fuente_finan);
             });
              //FIN OBTENER DATOS RUBRO DE EJECUCION
              //OBTENER DATOS MODALIDAD DE EJECUCION
              $("#cbxRubro").change(function(){//para cargar en agregar division funcionañ
                    listarModalidadEjec();
             });
              //FIN OBTENER DATOS MODALIDAD DE EJCUCION
            //OBTENER PROGRAMA PRESUPUESTAL
              $("#cbxModalidadEjec").change(function(){//para cargar en agregar division funcionañ
                  listarProgramaPresupuestal();
             });
              //FIN OBTENER PROGRAMA PRESUPUESTAL

            //TRAER DATOS EN UN COMBO DE TIPO DE INVERSION
           var listarTipoInversion=function()
                {
                    html="";
                    $("#cbxTipoInv").html(html); //nombre del selectpicker Tipologia de inversion
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/TipologiaInversion/get_TipoInversion",
                        type:"POST",
                        success : function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_tipo_inversion"]+"> "+ registros[i]["nombre_tipo_inversion"]+" </option>";
                            }
                            $("#cbxTipoInv").html(html);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN UN COMBO DE TIPO DE INVERSION
           //TRAER DATOS EN GRUPO FUNCIONAL
                var listarGrupoFuncional=function(id_div_funcional)
                {
                    html="";
                    $("#cbxGrupoFunc").html(html); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/GrupoFuncional/GetGrupoFuncionalId",
                        type:"POST",
                        data:{id_div_funcional:id_div_funcional},
                        success : function(respuesta)
                        {
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_grup_funcional"]+"> "+ registros[i]["nombre_grup_funcional"]+" </option>";
                            }
                            $("#cbxGrupoFunc").html(html);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN GRUPO FUNCIONAL
             //TRAER DATOS DE META PRESUPUESTAL

          //FIN TRAER DATOS DE META PRESUPUESTAL


            //TRAER DATOS EN UN COMBO DE MODALIDAD DE EJECUCION
                var listarModalidadEjec=function()
                {
                    html="";
                    $("#cbxModalidadEjec").html(html); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/ModalidadEjecucion/GetModalidadE",
                        type:"POST",
                        success : function(respuesta){
                           // alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_modalidad_ejec"]+"> "+ registros[i]["nombre_modalidad_ejec"]+" </option>";
                            }
                            $("#cbxModalidadEjec").html(html);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN UN COMBO DE MODALIDAD DE EJECUCION

          //TRAER DATOS EN UN COMBO DE DIVISION FUNCIONAL
                var listarDivisionFuncional=function(id_funcion)
                {
                    html="";
                    $("#cbxDivFunc").html(html); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/DivisionFuncional/GetDivisioFuncuonaId",
                        type:"POST",
                        data:{id_funcion:id_funcion},
                        success : function(respuesta){
                           //alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_div_funcional"]+"> "+ registros[i]["nombre_div_funcional"]+" </option>";
                            }
                            $("#cbxDivFunc").html(html);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN UN COMBO DE DIVISION FUNCIONAL

                    //TRAER DATOS EN UN COMBO DE DIVISION FUNCIONAL
                var listarRubro=function(id_fuente_finan)
                {
                    html="";
                    $("#cbxRubro").html(html); //nombre del selectpicker UNIDAD EJECUTORA
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/MRubroEjecucion/GetRubroId",
                        type:"POST",
                        data:{id_fuente_finan:id_fuente_finan},
                        success : function(respuesta){
                           //alert(respuesta);
                         var registros = eval(respuesta);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option value="+registros[i]["id_rubro"]+"> "+ registros[i]["nombre_rubro"]+" </option>";
                            }
                            $("#cbxRubro").html(html);//
                            $('.selectpicker').selectpicker('refresh');
                        }
                    });
                }
          //FIN TRAER DATOS EN UN COMBO DE DIVISION FUNCIONAL
              //AGREGAR UNA PIP
               /* $("#form-addProyectoInversion").submit(function(event)
                {
                //  alert('hola');
                  event.preventDefault();
                    $.ajax({
                        url:base_url+"index.php/ProyectoInversion/AddProyecto",
                        type:$(this).attr('method'),
                        data:$(this).serialize(),
                        success : function(resp){
                          alert(resp);
                         //swal("REGISTRADO!", resp, "success");
                         //$('#table-ProyectoInversion').dataTable()._fnAjaxUpdate();    //SIRVE PARA REFRESCAR LA TABLA
                        }
                    });
                });  */
                //FIN DE AGREGAR PIP
			});
			   //listaR proyeto de inversion*/
                var listaProyectoInversion=function()
                {
                    var table=$("#table-ProyectoInversion").DataTable({
                     "processing":true,
                     "serverSide":true,
                     destroy:true,
                         "ajax":{
                                    "url":base_url+"index.php/ProyectoInversion/GetProyectoInversion",
                                    "method":"POST",
                                    "dataSrc":""
                                    },
                                "columns":[
                                    {"data":"id_pi"},
                                    {"data":"nombre_pi"},
                                    {"data":"codigo_unico_pi"},
                                    {"data":"costo_pi"},
                                    {"data":"devengado_ac_pi"},
                                    {"data":"fecha_registro_pi"},
                                    {"data":"fecha_viabilidad_pi"},
                                    {"defaultContent":"<button type='button' class='editar btn btn-primary btn-xs' data-toggle='modal' data-target='#'><i class='ace-icon fa fa-pencil  bigger-120'></i></button><button type='button' class='VerProyecto btn btn-success btn-xs' data-toggle='modal' data-target='#VerDetalleProyectoInversion'><i class='ace-icon fa fa-eye bigger-120'></i></button>"}
                                ],

                                "language":idioma_espanol
                    });
                 ListaProyectoInversionData("#table-ProyectoInversion",table);  //obtener data de funcion para agregar  AGREGAR
                }

                /*fin listar proyecto de inversion*/
                var ListaProyectoInversionData=function(tbody,table){
                       $(tbody).on("click","button.VerProyecto",function(){
                        var data=table.row( $(this).parents("tr")).data();
                        var Id_ProyectoInver=data.id_pi;
                        MostrarDetalleProyecto(Id_ProyectoInver);
                        /*var txt_codigofuncionM=$('#txt_codigofuncionM').val(data.codigo_funcion);
                        var txt_nombrefuncionM=$('#txt_nombrefuncionM').val(data.nombre_funcion);*/

                    });
                }
                var MostrarDetalleProyecto=function(Id_ProyectoInver){
                    event.preventDefault();
                    html="";
                    $("table-detalleProyectoInversion").html(html);
                    $.ajax({
                        "url":base_url +"index.php/ProyectoInversion/BuscarProyectoInversion",
                        type:"POST",
                        data:{Id_ProyectoInver:Id_ProyectoInver},
                        success : function(respuesta){
                         var registros = eval(respuesta);
                            html+="<thead> <tr> <th class='active'>DATOS DEL PROYECTOS DE INVERSIÓN</th>  <th class='active' colspan='5'>DETALLE </th> </tr></thead>"
                            for (var i = 0; i <registros.length;i++) {
                              html +="<tbody> <tr><th class='success'>CÓDIGO ÚNICOa</th><th  colspan='5'>"+registros[i]["codigo_unico_pi"]+"</th></tr> <tr><th class='success'>PROYECTO DE INVERSIÓN</th><th  colspan='5'>"+registros[i]["nombre_pi"]+"</th></tr>";
                              html +="<tr><th class='success'>COSTO</th><th  colspan='5'>"+registros[i]["costo_pi"]+"</th></tr> <tr><th class='success'>DEVENGADO</th><th  colspan='5'>"+registros[i]["devengado_ac_pi"]+"</th></tr>";
                              html +="<tr><th class='success'>FECHA  DE REGISTRO</th><th  colspan='5'>"+registros[i]["fecha_registro_pi"]+"</th></tr> <tr><th class='success'>FECHA DE VIABILIDAD</th><th  colspan='5'>"+registros[i]["fecha_viabilidad_pi"]+"</th></tr>";
                              html+="<thead> <tr> <th class='active'>UNIDAD EJECUTORA</th>  <th class='active' colspan='5'>DETALLE </th> </tr></thead>";
                              html +="<tr><th class='success'>NOMBRE UNIDAD EJECUTORA</th><th  colspan='5'>"+registros[i]["nombre_ue"]+"</th></tr> <tr><th class='success'>NOMBRE</th><th  colspan='5'>"+registros[i]["nombre_ue"]+"</th></tr>";
                              html+="<thead> <tr> <th class='active'>NATURALEZA DE INVERSIÓN</th>  <th class='active' colspan='5'>DETALLE </th> </tr></thead>";
                              html +="<tr><th class='success'>NATURALEZA DE INVERSIÓN</th><th  colspan='5'>"+registros[i]["nombre_naturaleza_inv"]+"</th></tr> <tr><th class='success'>NOMBRE</th><th  colspan='5'>"+registros[i]["nombre_naturaleza_inv"]+"</th></tr>";

                              html +="</tbody>";
                            }
                            $("#table-detalleProyectoInversion").html(html);
                        }
                    });

                }
                /*fin listar proyecto de inversion*/
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

        /* function listar()
					{
						alert("hola");
            event.preventDefault();
						$.ajax({
              "url":base_url+"index.php/ProyectoInversion/GetProyectoInversion",
							type:"POST",
							success : function(respuesta){
								alert(respuesta);
                console.log(respuesta);
							}
						});
					}*/
