
$("#txtCostoEstudio").keyup(function(e)
{
    $(this).val(format($(this).val()));
});
$("#txtMontoEtapa").keyup(function(e)
{
    $(this).val(format($(this).val()));
});
$("#txtCostoEstudio").keyup(function(e)
{
    $(this).val(format($(this).val()));
});
$("#txtMontoInversion").keyup(function(e)
{
    $(this).val(format($(this).val()));
});


$('#anioCartera').on('change', function() 
{
    listaProyectosParaCartera();
});

$('#listaProyectos').on('change', function() 
{
    ProyectoParaCartera();
});

var format = function(num){
    var str = num.replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) 
    {
        parts = str.split(".");
        str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) 
    {
        if(str[j] != ",") 
        {
            output.push(str[j]);
            if(i%3 == 0 && j < (len - 1))
            {
                output.push(",");
            }
            i++;
        }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

var listaProyectosParaCartera=function(valor)
{
    var htmlTemp='';
    $("#listaProyectos").html(htmlTemp);
    var anio = $("#anioCartera").val();
    paginaAjaxJSON({ anio : anio }, base_url +"index.php/FEformulacion/getProyectos", "POST", null, function(objectJSON)
    {
        objectJSON=JSON.parse(objectJSON);
        var registros=eval(objectJSON);
        for(var i=0; i<registros.length; i++)
        {
            htmlTemp+='<option value="'+registros[i]['id_pi']+'">'+registros[i]['nombre_pi']+' </option>';   
        };

        $("#listaProyectos").html(htmlTemp);
        $('.selectpicker').selectpicker('refresh'); 
    }, false, true);
}

var ProyectoParaCartera=function(valor)
{
    var anio = $("#anioCartera").val();
    var id_pi = $("#listaProyectos").val();
    paginaAjaxJSON({ anio : anio, id_pi:id_pi}, base_url +"index.php/FEformulacion/getProyectoParaEstudioInversion", "POST", null, function(objectJSON)
    {
        objectJSON=JSON.parse(objectJSON);
        $("#txtNombreEstudioInversion").val(objectJSON.estudioInversion.nombre_pi);
        $("#txtMontoInversion").val(objectJSON.estudioInversion.costo_pi);
        $('select[name=listaUnidadFormuladora]').val(objectJSON.estudioInversion.id_uf);
        $('select[name=listaUnidadFormuladora]').change();

        $('select[name=listaUnidadEjecutora]').val(objectJSON.estudioInversion.id_ue);
        $('select[name=listaUnidadEjecutora]').change();

        $('.selectpicker').selectpicker('refresh'); 
               
    }, false, true);
}