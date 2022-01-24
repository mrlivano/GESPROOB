function renderLoading()
{
    if(!($('#divModalCargaAjax').length))
    {
        $('head').prepend('<style>@keyframes loadingSuperior{    0%    {        transform: rotate(0deg);    }    100%    {        transform: rotate(360deg);    }}#divLoading{    background-color: transparent;    border-radius: 40px;    border: 5px solid transparent;    border-left: 5px solid white;    border-right: 5px solid #1F618D;    display: inline-block;    height: 40px;    margin-top: 4px;    text-align: center;    width: 40px;    animation: loadingSuperior 1s infinite;}#divLoadingContenedor{    display: inline-block;    margin-top: 170px;}#divModalCargaAjax{    background-color: rgba(0, 0, 0, 0.7);    bottom: 0px;    display: none;    left: 0px;    position: fixed;    right: 0px;   text-align: center;    top: 0px;    z-index: 70000;}#spanTextoLoading{    color: #ffffff;    font-size: 20px;}</style>');

        $('body').append('<div id="divModalCargaAjax"><div id="divLoadingContenedor"><span id="spanTextoLoading">Actualizando ... </span><br><div id="divLoading"></div></div></div>');
    }

    $('#divModalCargaAjax').show();
}

function paginaAjaxJSON(data, url, method, preFunction, postFunction, cache, async)
{
    renderLoading();

    var returnTemp=null;

    if((typeof preFunction)=='function')
    {
        preFunction();
    }
    
    $.ajax(
    {
        url : url,
        type : method,
        data : data,
        cache : cache,
        async : async
    }).done(function(pagina)
    {
        $('#divModalCargaAjax').hide();
        
        if((typeof postFunction)=='function')
        {
            postFunction(pagina);
        }
    }).fail(function()
    {
        $('#divModalCargaAjax').hide();
        
        alert('Error en la red (Transferencia de datos). Por favor reporte ésto al administrador del sistema. Pedimos disculpas y damos gracias por su comprensión. paginaAjaxJSON');
    });
}

function paginaAjax(idSeccion, data, url, method, preFunction, postFunction, cache, async)
{
    renderLoading();

    if((typeof preFunction)=='function')
    {
        preFunction();
    }

    $.ajax(
    {
        url : url,
        type : method,
        data : data,
        cache : cache,
        async : async
    }).done(function(pagina) 
    {
        $('#divModalCargaAjax').hide();
        $('#'+idSeccion).html(pagina);

        if((typeof postFunction)=='function')
        {
            postFunction();
        }
    }).fail(function()
    {
        $('#divModalCargaAjax').hide();
        $('#'+idSeccion).html('<div class="alert alert-danger">No se Pudo establecer conexion con el servidor SIAF, consulte con el administrador.</div>');
    });
}

function paginaAjaxDialogo(idModal, titulo, data, url, method, preFunction, postFunction, cache, async)
{

    renderLoading();

    if((typeof preFunction)=='function')
    {
        preFunction();
    }

    var idModalTemp=(idModal!=null ? idModal : 'modalTemp');

    var htmlTempInicio='<div id="'+idModalTemp+'" class="modal fade" role="dialog" data-backdrop="static">'+
        '<div class="modal-dialog modal-lg">'+
            '<div class="modal-content">'+
                '<div class="modal-header">'+
                    '<button type="button" class="close" data-dismiss="modal">&times;</button>'+
                    '<h4 id="'+idModalTemp+'Titulo" class="modal-title">'+titulo+'</h4>'+
                '</div>'+
                '<div id="'+idModalTemp+'Cuerpo" class="modal-body">';

    var htmlTempFin='</div>'+
                '<div class="modal-footer"></div>'+
            '</div>'+
        '</div>'+
    '</div>';
    
    $.ajax(
    {
        url : url,
        type : method,
        data : data,
        cache : cache,
        async : async
    }).done(function(pagina) 
    {
        $('#divModalCargaAjax').hide();

        if($('#'+idModalTemp).length)
        {
            $('#'+idModalTemp+'Titulo').text(titulo);
            $('#'+idModalTemp+'Cuerpo').html(pagina);

            $('#'+idModalTemp).modal('show');
        }
        else
        {
            $('body').append(htmlTempInicio+pagina+htmlTempFin);

            $('#'+idModalTemp).modal('show');
        }

        if((typeof postFunction)=='function')
        {
            postFunction();
        }
    }).fail(function()
    {
        $('#divModalCargaAjax').hide();

        $('body').append(htmlTempInicio+'<div class="alert alert-danger">Error en la red (Transferencia de datos). Por favor reporte ésto al administrador del sistema. Pedimos disculpas y damos gracias por su comprensión.paginaAjaxDialogo</div>'+htmlTempFin);

        $('#'+idModalTemp).modal('show');
    });
}

function replaceAll(a,b,c){for(;-1!=a.toString().indexOf(b);)a=a.toString().replace(b,c);return a}function limpiarText(a,b){var c=null==b?0:b.length;$("#"+a).find("input[type='text']").each(function(a,e){for(var f=!0,d=0;d<c;d++)if(b[d]==$(e).attr("id")){f=!1;break}f&&$(e).val("")})};