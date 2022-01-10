$(document).on("ready", function()
{
    //lista_gerencias();
   // listaUnidadEjecutoraComboR('1');
    /*llamar a mi datatablet listar funcion*/
   
});

    //OFICINA R
    var listaUnidadEjecutoraComboR = function (valor)//COMO CON LAS FUNCIONES PARA AGREGAR DIVIVISION FUNCIONAL
    {
    html = "";

    $("#listaUnidadEjecutoraR").html(html);
    event.preventDefault();
    $.ajax({
        "url": base_url + "index.php/UnidadE/GetUnidadE",
        type: "POST",
        success: function (respuesta) {
            var registros = eval(respuesta);
            for (var i = 0; i < registros.length; i++) {
                html += "<option value=" + registros[i]["id_ue"] + "> " + registros[i]["codigo_ue"] +" - "+ registros[i]["nombre_ue"] + " </option>";
            }

            $("#listaUnidadEjecutoraR").html(html);//para modificar las entidades
            $('select[name=listaUnidadEjecutoraR]').value('1').change();//PARA AGREGAR UN COMBO PSELECIONADO

            $('.selectpicker').selectpicker('refresh');
        }
    });
    };



/* Idioma DT*/
var idioma_espanol =
    {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    };
