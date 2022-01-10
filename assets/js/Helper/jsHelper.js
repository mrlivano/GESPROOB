function renderLoading()
{
    if(!($('#divModalCargaAjax').length))
    {
        $('head').prepend('<style>@keyframes loadingSuperior{    0%    {        transform: rotate(0deg);    }    100%    {        transform: rotate(360deg);    }}#divLoading{    background-color: transparent;    border-radius: 40px;    border: 5px solid transparent;    border-left: 5px solid white;    border-right: 5px solid white;    display: inline-block;    height: 40px;    margin-top: 4px;    text-align: center;    width: 40px;    animation: loadingSuperior 1s infinite;}#divLoadingContenedor{    display: inline-block;    margin-top: 170px;}#divModalCargaAjax{    background-color: rgba(0, 0, 0, 0.7);    bottom: 0px;    display: none;    left: 0px;    position: fixed;    right: 0px;   text-align: center;    top: 0px;    z-index: 70000;}#spanTextoLoading{    color: #ffffff;    font-size: 20px;}</style>');

        $('body').append('<div id="divModalCargaAjax"><div id="divLoadingContenedor"><span id="spanTextoLoading">Cargando</span><br><div id="divLoading"></div></div></div>');
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

        swal("Error","Usted no tiene permisos, para realizar esta acción", "error");
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
        $('#'+idSeccion).html('<div class="alert alert-danger">Usted no tiene permisos, para realizar esta acción.</div>');
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

    var htmlTempInicio='<div id="'+idModalTemp+'" data-keyboard="false" class="modal fade" role="dialog" data-backdrop="static">'+
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

        $('body').append(htmlTempInicio+'<div class="alert alert-danger">Error en la red (Transferencia de datos). Por favor reporte ésto al administrador del sistema. Pedimos disculpas y damos gracias por su comprensión.</div>'+htmlTempFin);

        $('#'+idModalTemp).modal('show');
    });
}

function replaceAll(a,b,c){for(;-1!=a.toString().indexOf(b);)a=a.toString().replace(b,c);return a}function limpiarText(a,b){var c=null==b?0:b.length;$("#"+a).find("input[type='text']").each(function(a,e){for(var f=!0,d=0;d<c;d++)if(b[d]==$(e).attr("id")){f=!1;break}f&&$(e).val("")})};var evtTimeOutJsBuscar="";function agregarSlashes(e){return e.replace(/([.*+?^=!:${}()|\[\]\/\\])/g,"\\$1")}function textAdapter(e){for(var g,b=0;20>b;b++)g=new RegExp("\u00c0\u00c1\u00c8\u00c9\u00cc\u00cd\u00d2\u00d3\u00d9\u00da\u00e0\u00e1\u00e8\u00e9\u00ec\u00ed\u00f2\u00f3\u00f9\u00fa".charAt(b),"g"),e=e.replace(g,"AAEEIIOOUUaaeeiioouu".charAt(b));return e}function filtrarHtml(e,g,b,k,c){c=c||window.event;if(13==(c.charCode||c.keyCode||c.which)||b)""!=evtTimeOutJsBuscar&&(clearTimeout(evtTimeOutJsBuscar),evtTimeOutJsBuscar=""),evtTimeOutJsBuscar=setTimeout(function(){g=textAdapter(g);for(var f=g.split(/ /),d="",a=0;a<f.length;a++)""!=f[a]&&(d+=" "+f[a]);d=d.substring(1);d=agregarSlashes(d);d=d.split(/ /);var b=document.getElementById(e).getElementsByClassName("elementoBuscar"),c=b.length,k=d.length,l="";for(a=0;a<c;a++)if("none"!=b[a].style.display){l=b[a].style.display;break}if(""==f)for(a=0;a<c;a++)b[a].style.display=l;else for(a=0;a<c;a++){var h=b[a];f=!0;for(var m=0;m<k;m++){var n=d[m];n=new RegExp(n,"i");if(!n.test(textAdapter(("undefined"!=h.textContent?h.textContent:h.innerText).replace(/\s/g,"")))){f=!1;break}}h.style.display=f?l:"none"}},k)};
