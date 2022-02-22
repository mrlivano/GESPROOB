<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts-all-3.js"></script>
<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Cantidad de PIP Por Naturaleza de inversión</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="NaturalezaInversion" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Costos generales de PIP Por Naturaleza</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="MontosPipPorNaturaleza" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5>Cantidad PIP Por Fuente Financiamiento</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="NumPipFuenteFinanciamiento" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5> Cantidad PIP Por Modalidad Ejecucion</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="NumPipModalidad" style="height:350px;"></div>
                        </div>                          
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5> Monto total de PIP Por Modalidad Ejecución</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="MontoPipsModalidad" style="height:350px;"></div>
                        </div>                          
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5> Cantidad de PIP Por Rubro Ejecución</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="CantidadPipRubro" style="height:350px;"></div>
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
        <!--<div class="row">            
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h5> Cantidad de PIP por provincias</h5>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive" >
                            <div id="container" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</div>
<script>
    
    $(document).on("ready" ,function()
    {
        $.ajax({
        url:base_url+"/index.php/PrincipalReportes/GetAprobadosEstudio",
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

            var dom = document.getElementById("NaturalezaInversion");
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
                    data: ['Creación','Ampliación','Mejoramiento','Recuperación']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNaturalezaInv[0], name:'Creación'},
                    {value:arrayNaturalezaInv[1], name:'Ampliación'},
                    {value:arrayNaturalezaInv[2], name:'Mejoramiento'},
                    {value:arrayNaturalezaInv[3], name:'Recuperación'},
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
        url:base_url+"/index.php/PrincipalReportes/NaturalezaInversionMontos",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayNaturalezaMontosPip=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayNaturalezaMontosPip[index]=element.Monto;
            });

            var dom = document.getElementById("MontosPipPorNaturaleza");
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
                    data: ['Creación','Ampliación','Mejoramiento','Recuperación']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNaturalezaMontosPip[0], name:'Creación'},
                    {value:arrayNaturalezaMontosPip[1], name:'Ampliación'},
                    {value:arrayNaturalezaMontosPip[2], name:'Mejoramiento'},
                    {value:arrayNaturalezaMontosPip[3], name:'Recuperación'},
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
    url:base_url+"/index.php/PrincipalReportes/CantidadPipFuenteFinancimiento",
    dataType:"json",
    type:"POST",
    cache:false,
    success:function(respuesta)
    {
        var arrayNumPipFuenteFinan=new Array();
        $.each(respuesta,function(index,element)
        {
            arrayNumPipFuenteFinan[index]=element.Cantidadpip;
        });
            var dom = document.getElementById("NumPipFuenteFinanciamiento");
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
                    data: ['Donaciones y transferencias','Recursos Determinados','Recursos Directamente Recaudados','Recursos ordinarios','Recursos Por Operaciones Oficiales de Credito']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:arrayNumPipFuenteFinan[0], name:'Donaciones y transferencias'},
                        {value:arrayNumPipFuenteFinan[1], name:'Recursos Determinados'},
                        {value:arrayNumPipFuenteFinan[2], name:'Recursos Directamente Recaudados'},
                        {value:arrayNumPipFuenteFinan[3], name:'Recursos ordinarios'},
                        {value:arrayNumPipFuenteFinan[4], name:'Recursos Por Operaciones Oficiales de Credito'}
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
        url:base_url+"/index.php/PrincipalReportes/CantidadPipModalidad",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayNumPipModalidad=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayNumPipModalidad[index]=element.CantidadPip;
            });

            var dom = document.getElementById("NumPipModalidad");
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
                    data: ['Administracion Directa','Contrata Consultores Externos','Mixto']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNumPipModalidad[0], name:'Administracion Directa'},
                    {value:arrayNumPipModalidad[1], name:'Contrata Consultores Externos'},
                    {value:arrayNumPipModalidad[2], name:'Mixto'}
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
    url:base_url+"/index.php/PrincipalReportes/MontoPipModalidad",
    dataType:"json",
    type:"POST",
    cache:false,
    success:function(respuesta)
    {
        var arrayModalidadMontosPip=new Array();
        $.each(respuesta,function(index,element)
        {
            arrayModalidadMontosPip[index]=element.Monto;
        });

            var dom = document.getElementById("MontoPipsModalidad");
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
                    data: ['Administracion Directa','Contrata Consultores Externos','Mixto']
                },

                series : [
                {
                    name: 'Naturaleza Inversion',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '60%'],
                    data:[
                        {value:arrayModalidadMontosPip[0], name:'Administracion Directa'},
                        {value:arrayModalidadMontosPip[1], name:'Contrata Consultores Externos'},
                        {value:arrayModalidadMontosPip[2], name:'Mixto'}
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
        url:base_url+"/index.php/PrincipalReportes/CantidadPipRubro",
        dataType:"json",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var arrayNumPipRubro=new Array();
            $.each(respuesta,function(index,element)
            {
                arrayNumPipRubro[index]=element.Cantidadpip;
            });

            var dom = document.getElementById("CantidadPipRubro");
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
                    data: ['Canon y sobrecanon','Contribuciones a fondos','Donaciones y transferencias','Fondo de compensación regional','Recursos Directamente Recaudados','Recursos por operaciones']
                },

                series : [
                {
                    name: 'Rubro Ejecucion',
                    type: 'pie',
                    radius : '45%',
                    center: ['50%', '60%'],
                    data:[
                    {value:arrayNumPipRubro[0], name:'Canon y sobrecanon'},
                    {value:arrayNumPipRubro[1], name:'Contribuciones a fondos'},
                    {value:arrayNumPipRubro[2], name:'Donaciones y transferencias'},
                    {value:arrayNumPipRubro[3], name:'Fondo de compensación regional'},
                    {value:arrayNumPipRubro[4], name:'Recursos Directamente Recaudados'},
                    {value:arrayNumPipRubro[5], name:'Recursos ordinarios'},
                    {value:arrayNumPipRubro[6], name:'Recursos por operaciones'},
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

   /* $.ajax({
        url:base_url+"/index.php/PrincipalReportes/CantidadPipProvincia",
        type:"POST",
        cache:false,
        success:function(respuesta)
        {
            var cantidadpipprovincias=JSON.parse(respuesta);
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            app.title = '坐标轴刻度与标签对齐';

            option = {
                color: ['#3398DB'],
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
                        data : ['Abancay', 'Andahuaylas', 'Antabamba', 'Aymaraes', 'Chincheros', 'Cotabambas', 'Grau'],
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
                        name:'Cantidad de pip',
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
    });*/


});

</script>

