function MontoProgramadoPip(anio)
{
  //  alert(anio);
   $("#monto_programado").text("");
   $("#totalpip").text("");
   $("#monto_programado_nopip").text("");
   $("#totalnopip").text("");

     var tipo=new Array();
     var num=new Array();
     var total_monto=new Array();
    event.preventDefault();

   $.ajax(
    {
        "url": base_url+"index.php/PrincipalPmi/get_cantidad_costo_tipo_pi",
        type: "POST",
        data :{anio:anio},
        success: function(respuesta)
        {
            var registros = eval(respuesta);
            var sum=0;
            var sum_monto=0;
            var sumaTotal = 0 ;

            for(var i=0; i<registros.length; i++)
            {
                tipo[i]=registros[i]["nombre_tipo_inversion"];
                num[i]=parseFloat(registros[i]["Cant_pi"]);
                sum=num[i]+sum;
                total_monto[i]=parseFloat(registros[i]["SumaCosto"]);
                sum_monto=total_monto[i]+sum_monto;
                sumaTotal = registros[0]["SumaTotal"];
            }

            $("#NumPip").text(sum);
            $("#TotalMonto").text("S/. "+sumaTotal);
            if(tipo[0]=="NO PIP")
            {
               // alert("1");
            $("#monto_programado_nopip").text("S/. "+registros[0]["SumaCosto"]);
            $("#totalnopip").text(registros[0]["Cant_pi"]);
            }
                if(tipo[1]=="PIP")
            {
               // alert("2");
            $("#monto_programado").text("S/. "+registros[1]["SumaCosto"]);
            $("#totalpip").text(registros[1]["Cant_pi"]);
            }

            if(tipo[0]=="PIP")
            {
               // alert("3");
            $("#monto_programado").text("S/. "+registros[0]["SumaCosto"]);
            $("#totalpip").text(registros[0]["Cant_pi"]);
            }
            if(tipo[1]=="NO PIP")
            {
              //  alert("4");
            $("#monto_programado_nopip").text("S/. "+registros[1]["SumaCosto"]);
            $("#totalnopip").text(registros[1]["Cant_pi"]);
            }
        }
    });
}

function EstaProyProvincia()
{
    var provincias=new Array();

    event.preventDefault();

    $.ajax(
    {
        "url": base_url+"index.php/PrincipalPmi/EstadisticaPipProvinc",
        type: "POST",
        success: function(respuesta)
        {
            var registros=eval(respuesta);

            var sum=0;

            for(var i=0; i<registros.length; i++)
            {
                provincias[i]=registros[i]["Cantidadpip"];
                sum=provincias[i]+sum;
            }

             //OBTENER NUMERO DE PIP EN LA CABECERA

            $("#NumPips").text(provincias);
            cantidadPIPAbancay=(100*(parseInt(provincias[0]))/sum);

            $("#CantidadPAbancay").text(provincias[0]); //LISTAR CANTIDAD DE PIP REPORTE GENERAL
            $("#porcentajeAban").text(cantidadPIPAbancay.toFixed(2)); //LISTAR PORCENTAJES EN EL GRAFICO PROYECTOS POR PRIVINCIAS EN TEXTO

            cantidadPIPAndahuaylas=(100*(parseInt(provincias[1]))/sum);

            $("#CantidadPAndahuaylas").text(provincias[1]);
            $("#porcentajeAnd").text(cantidadPIPAndahuaylas.toFixed(2));

            cantidadPIPAntabamba=(100*(parseInt(provincias[2]))/sum);

            $("#CantidadPAntabamba").text(provincias[2]);
            $("#porcentajeAnt").text(cantidadPIPAntabamba.toFixed(2));

            cantidadPIPAymaraes=(100*(parseInt(provincias[3]))/sum);

            $("#CantidadPAymaraes").text(provincias[3]);
            $("#porcentajeAy").text(cantidadPIPAymaraes.toFixed(2));

            cantidadPIPChincheros=(100*(parseInt(provincias[4]))/sum);

            $("#CantidadPChincheros").text(provincias[4]);
            $("#porcentajeChinc").text(cantidadPIPChincheros.toFixed(2));

            cantidadPIPCotabambas=(100*(parseInt(provincias[5]))/sum);

            $("#CantidadPCotabambas").text(provincias[5]);
            $("#porcentajeCotab").text(cantidadPIPCotabambas.toFixed(2));

            cantidadPIPGrau=(100*(parseInt(provincias[6]))/sum);

            $("#CantidadPGrau").text(provincias[6]);
            $("#porcentajeGrau").text(cantidadPIPGrau.toFixed(2));

            if ("undefined" != typeof Chart && (console.log("init_chart_doughnut"), $(".canvasDoughnut1").length))
            {
                var a=
                {
                    type: "doughnut",
                    tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                    data:
                    {
                        labels: ["Abancay", "Andahuaylas", "Antabamba", "Aymaraes", "Contabambas", "Chincheros", "Grau"],
                        datasets: [
                        {
                            data: [cantidadPIPAbancay, cantidadPIPAndahuaylas, cantidadPIPAntabamba, cantidadPIPAymaraes, cantidadPIPChincheros, cantidadPIPCotabambas, cantidadPIPGrau],
                            backgroundColor: ["#3498DB", "#9B59B6", "#E74C3C", "#26B99A", "#B6CBD6", "#708B99", "#52C5E1"],
                            hoverBackgroundColor: ["#3498DB", "#B370CF", "#E95E4F", "#36CAAB", "#BDD3DF", "#7C96A3", "#52C5E1"]
                        }]
                    },
                    options: { legend: !1, responsive: !1 }
                };

                $(".canvasDoughnut1").each(function()
                {
                    var b=$(this);

                    new Chart(b, a)
                });
            }
        }
    });
}

var EstadistMontosPipProv=function()
{
    var MontosPipProv=new Array();

    var html1='';

    $.ajax(
    {
        "url": base_url+"index.php/PrincipalPmi/EstadisticaMontoPipProvincias",
        success: function(respuesta)
        {
         
            
            var registros=eval(respuesta);

            var suma=0;

            html1+='<thead>'
				+'<tr>'
					+'<th class="active"><h6>Provincia</h6></th>'
					+'<th class="active"><h6>Estadistica</h6></th>'
					+'<th class="active" style="text-align: right;"><h6>Montos</h6></th>'
				+'</tr>'
			+'</thead>'
			+'<tbody>';

            for(var i=0; i<registros.length; i++)
            {
                MontosPipProv[i]=registros[i]["MontoProyecto"]; //OPCIONAL, SIRVE PARA IMPRIR LOS MONTOS  EN DATOS PIP PROYECTOS POR PROVINCIA EN LOS DIV

                suma=MontosPipProv[i]+suma; //TOTAL MONTO PROYECTOS EN CABECERA

                html1+='<tr>'
						+'<td>'+registros[i]['provincia']+'</td>'
						+'<td><div class="progress progress_sm"><div class="progress-bar bg-green progress_sm" role="progressbar" data-transitiongoal="45" style="width: '+registros[i]['Cantidad']+'%;"></div></div></td>'
						+'<td style="text-align: right;">'+registros[i]['MontoProyecto']+'</td>'
				+'</tr>';
            }

            html1+="</tbody>";

            $("#table-estaditMontPIPProv").html(html1);

            $("#MontoPipAbancay").html(MontosPipProv[0]); // MONTO TOTAL DE ABANCAY EN EL DIV MontoPipAbancay
            $("#MontoPipAndahuaylas").html(MontosPipProv[1]);
            $("#MontoPipAntabamba").html(MontosPipProv[2]);
            $("#MontoPipAymaraes").html(MontosPipProv[3]);
            $("#MontoPipChincheros").html(MontosPipProv[4]);
            $("#MontoPipCotabambas").html(MontosPipProv[5]);
            $("#MontoPipGrau").html(MontosPipProv[6]);
            $("#MontoTotalPip").html(suma); //OBTENER EL MONTO TOTAL DE PROYECTOS EN LA CABECERA
        }
    });
}

function EstadisticasPorCiclosInversion() {
    $.ajax({
        url: base_url+"index.php/PrincipalPmi/EstadisticaPipEstadoCiclo",
        type: "POST",
        success: function(respuesta)
        {
            var registros=eval(respuesta);
            var sql='';
            var NumProyectos=0;
            var total_proyectos=registros[0]["Num_Total"];
            var total_otros=registros[0]["TotalNoCiclo"];
            var panel_estadistica=$("#panel_estadistica_ciclo_inversion");
            var porcentaje=0.00;
            for (var i=0; i<registros.length; i++)
            {
                NumProyectos=registros[i]["Num_Proyectos"];
                porcentaje=Math.round((NumProyectos / total_proyectos) * 100);
                sql='<div class="widget_summary">'
					+'<div class="w_left w_25">'
						+'<span>'+(registros[i]['nombre_estado_ciclo'].charAt(0).toUpperCase())+(registros[i]['nombre_estado_ciclo'].toLowerCase().substring(1))+'</span>'
					+'</div>'
					+'<div class="w_center w_55">'
						+'<div class="progress">'
							+'<div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="font-size: 11px;width: '+porcentaje+'%;">'
								+porcentaje+'%'
							+'</div>'
						+'</div>'
					+'</div>'
					+'<div class="w_right w_20">'
						+'<span style="font-size: 14px;">'+NumProyectos+'</span>'
					+'</div>'
				+'</div>';

                panel_estadistica.append(sql);
            }

            porcentaje=Math.round((total_otros/total_proyectos)*100);

            sql='<div class="widget_summary">'
				+'<div class="w_left w_25">'
					+'<span>Otros</span>'
				+'</div>'
				+'<div class="w_center w_55">'
					+'<div class="progress">'
						+'<div class="progress-bar bg-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="font-size: 11px;width: '+porcentaje+'%;">'
						+porcentaje+'%'
						+'</div>'
					+'</div>'
				+'</div>'
				+'<div class="w_right w_20">'
					+'<span style="font-size: 14px;">'+total_otros+'</span>'
				+'</div>'
			+'</div>';

            panel_estadistica.append(sql);
        }
    });
}

function initMap()
{
    //var LatLng={lat: -25.363, lng: 131.044};
    var map=new google.maps.Map(document.getElementById('map'),
    {
        zoom: 8,
        center: {lat: -14, lng: -73}
        //disableDefaultUI: true
    });

    $.ajax(
    {
        url: base_url+"index.php/PrincipalPmi/GetDatosUbicacion",
        type: "POST",
        success: function(respuesta)
        {
            var registros=eval(respuesta);

            var marker;

            for(var i=0; i<registros.length; i++)
            {
                marker=new google.maps.Marker(
                {
                    position: { lat : registros[i]["latitud"], lng: registros[i]["longitud"] },
                    map : map,
                    image:base_url+'img/Semaforomalogrado.png',
                    title : registros[i]["distrito"]+": "+registros[i]["nombre_pi"]

                });
            }

        }
    });
}
var listar_aniocartera_r=function(valor){ //listar ani cartera operacion y mantenimiento
                    var  html="";
                    $("#Aniocartera_dasboard").html(html);
                    event.preventDefault();
                    $.ajax({
                        "url":base_url +"index.php/programar_pip/GetAnioCarteraProgramado",
                        type:"POST",
                        success:function(respuesta3){
                         //  alert(respuesta);
                         var registros = eval(respuesta3);
                            for (var i = 0; i <registros.length;i++) {
                              html +="<option  value="+registros[i]["anio"]+"> "+registros[i]["anio"]+" </option>";
                            };
                            $("#Aniocartera_dasboard").html(html);
                            $('select[name=Aniocartera_dasboard]').val(valor);//PARA AGREGAR UN COMBO PSELECIONADO
                            $('select[name=Aniocartera_dasboard]').change();
                            $('.selectpicker').selectpicker('refresh');
                            var anio=$("#Aniocartera_dasboard").val();
                            MontoProgramadoPip(anio);
                        }
                    });
                }
                      $("#Aniocartera_dasboard").change(function() {
                          var anio=$("#Aniocartera_dasboard").val();
                           $("#Aniocartera_dasboard_imput").val(anio);
                           MontoProgramadoPip(anio);
                        });



$(document).on('ready', function()
{
    EstaProyProvincia();
   // MontoProgramadoPip();
    EstadistMontosPipProv();
    EstadisticasPorCiclosInversion();
    listar_aniocartera_r();


     $.ajax({
        url:base_url+"index.php/PrincipalPmi/EstadisticaPipProvinc",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayNaturalezaInv=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayNaturalezaInv[index]=element.Cantidadpip;
            });

            var dom = document.getElementById("PipProvincias");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title : {
                    text: '',
                    subtext: '',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'horizontal',
                    left: 'left',
                    data: ['Abancay','Andahuaylas','Antabamba','Aymaraes','Chincheros','Cotabambas','Grau']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNaturalezaInv[0], name:'Abancay'},
                    {value:arrayNaturalezaInv[1], name:'Andahuaylas'},
                    {value:arrayNaturalezaInv[2], name:'Antabamba'},
                    {value:arrayNaturalezaInv[3], name:'Aymaraes'},
                    {value:arrayNaturalezaInv[4], name:'Chincheros'},
                    {value:arrayNaturalezaInv[5], name:'Cotabambas'},
                    {value:arrayNaturalezaInv[6], name:'Grau'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                ]
            };
            if (option && typeof option === "object")
            {
                myChart.setOption(option, true);
        }
    }
});

$.ajax({
        url:base_url+"index.php/PrincipalPmi/EstadisticaMontoPipProvincias",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var cantidadpipprovincias=JSON.parse(respuesta);
            var dom = document.getElementById("MontoPipProvincia");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = 'MONTOS DE LOS PIP POR PROVINCIAS';

            option = {
                color: ['#45B39D'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {
                        type : 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ['Abancay', 'Andahua', 'Antabamba', 'Aymaraes', 'Chincheros', 'Cotab', 'Grau'],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Monto de pip',
                        type:'bar',
                        barWidth: '60%',
                        data:cantidadpipprovincias
                    }
                ]
            };
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }

            }
    });

 $.ajax({
        url:base_url+"index.php/PrincipalPmi/EstadisticaPipEstadoCiclo",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayNaturalezaInv=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayNaturalezaInv[index]=element.Num_Proyectos;
            });

            var dom = document.getElementById("NumPipCicloInversion");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            option = {
                title : {
                    text: '',
                    subtext: '',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'horizontal',
                    left: 'left',
                    data: ['Idea','Formulación y Evaluación','Viable','Ejecución','Cerrados','Cotabambas','Grau']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNaturalezaInv[0], name:'Idea'},
                    {value:arrayNaturalezaInv[1], name:'Formulación y Evaluación'},
                    {value:arrayNaturalezaInv[2], name:'Viable'},
                    {value:arrayNaturalezaInv[3], name:'Ejecución'},
                    {value:arrayNaturalezaInv[4], name:'Cerrados'},
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
                ]
            };
            if (option && typeof option === "object")
            {
                myChart.setOption(option, true);
        }
    }
});

$.ajax({
        url:base_url+"index.php/PrincipalPmi/EstadisticaMontoPipCicloInversion",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var cantidadpipprovincias=JSON.parse(respuesta);
            var dom = document.getElementById("MontoPipCicloInversion");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = 'MONTOS DE PROYECTOS POR CICLO DE INVERSION';

            option = {
                color: ['#F1948A'],
                tooltip : {
                    trigger: 'axis',
                    axisPointer : {
                        type : 'shadow'
                    }
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '3%',
                    containLabel: true
                },
                xAxis : [
                    {
                        type : 'category',
                        data : ['Idea', 'Form. y Eval.', 'Viable', 'Ejecución', 'Cerrados'],
                        axisTick: {
                            alignWithLabel: true
                        }
                    }
                ],
                yAxis : [
                    {
                        type : 'value'
                    }
                ],
                series : [
                    {
                        name:'Monto de pip',
                        type:'bar',
                        barWidth: '60%',
                        data:cantidadpipprovincias
                    }
                ]
            };
            ;
            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }

            }
    });


});
