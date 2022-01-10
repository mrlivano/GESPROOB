$(document).on("ready" ,function()
{
    listar_aniocartera_();
}); 

var lista_no_pip_programados=function(anio)
{
    var str1 = "Inv_";
    var anio_1= parseInt(anio) +1; 
    var anioR1 = str1.concat(anio_1);
    var table=$("#table_operacion_mantenimiento").DataTable({
        "processing": true,
        "serverSide":false,
        destroy:true,
        "ajax":{
            url:base_url+"index.php/NoPipProgramados/GetNoPipProgramados",
            type:"POST",
            data :{anio:anio}  
                                        
        },
        "columns":[ 
            { "data" : "id_pi", "visible" : false },
            { "data" : "codigo_unico_pi" },
            { "data" : "desc_tipo_nopip" },
            { "data" : "nombre_pi" },
            { "data" : "prioridad_prog" },
            { "data" : "nombre_brecha" },
            { "data" : anioR1,render: $.fn.dataTable.render.number( ',', '.', 2 )} 
        ],
        "language": idioma_espanol
    });
}

var listar_aniocartera_=function(valor)
{
    var html="";
    $("#Cbx_AnioCartera_no_pip").html(html);
    event.preventDefault();
    $.ajax({
        "url":base_url +"index.php/programar_pip/GetAnioCarteraProgramado",
        type:"POST",
        success:function(respuesta3)
        {
            var registros = eval(respuesta3);
            for (var i = 0; i <registros.length;i++) 
            {
                html +="<option  value="+registros[i]["anio"]+"> "+registros[i]["anio"]+" </option>";
            };
            $("#Cbx_AnioCartera_no_pip").html(html);
            var anio_cartera = new Date();
            var anio_actual = anio_cartera.getFullYear();
            $('select[name=Cbx_AnioCartera_no_pip]').val(anio_actual);
            $('.selectpicker').selectpicker('refresh');
            var anio=$("#Cbx_AnioCartera_no_pip").val();
            lista_no_pip_programados(anio);
        }
    });
}

$("#Cbx_AnioCartera_no_pip").change(function() 
{
    var anio=$("#Cbx_AnioCartera_no_pip").val();
    lista_no_pip_programados(anio);
});         

var idioma_espanol=
{
    "decimal":        ",",
    "thousands":      ".",
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
