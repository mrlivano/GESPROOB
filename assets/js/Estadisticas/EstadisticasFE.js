$(document).on("ready" ,function(){

$.ajax({
		url:base_url+"index.php/PrincipalFyE/GetAprobadosEstudio",
		dataType:"json",
		type:"POST",
		cache:false,
		success:function(respuesta)
		{
			var arrayEstudioE=new Array();
			$.each(respuesta,function(index,element)
			{
				arrayEstudioE[index]=element.Cantidadpip;
			});

			var dom = document.getElementById("EstudioEtapa");
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
					data: ['Aprobados','Evaluación','Viabilidad','Formulación','Otros']
				},

				series : [
				{
					name: 'Estudios',
					type: 'pie',
					radius : '55%',
					center: ['50%', '60%'],
					data:[
					{value:arrayEstudioE[0], name:'Aprobados'},
					{value:arrayEstudioE[1], name:'Evaluación'},
					{value:arrayEstudioE[2], name:'Formulación'},
					{value:arrayEstudioE[3], name:'Viabilidad'},
					{value:0, name:'Otros'}
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
	url:base_url+"index.php/PrincipalFyE/EstudioInvPorTipoEstudio",
	dataType:"json",
	type:"POST",
	cache:false,
	success:function(respuesta)
	{
		var arrayTipoEstudio=new Array();
		$.each(respuesta,function(index,element)
		{
			arrayTipoEstudio[index]=element.CantidadEstudio;
		});

			var dom = document.getElementById("CenterFEvaluacion");
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
					data: ['Administracion Directa','TDR']
				},

				series : [
				{
					name: 'Estudios',
					type: 'pie',
					radius : '55%',
					center: ['50%', '60%'],
					data:[
					{value:arrayTipoEstudio[0], name:'Administracion Directa'},
					{value:arrayTipoEstudio[1], name:'TDR'}
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
	url:base_url+"index.php/PrincipalFyE/TipoGastoMontos",
	dataType:"json",
	type:"POST",
	cache:false,
	success:function(respuesta)
	{
		/*var arrayTipoEstudio=new Array();
		$.each(respuesta,function(index,element)
		{
			arrayTipoEstudio[index]=element.Total;
		});

		var dom = document.getElementById("MontosTiposGasto");
		var myChart = echarts.init(dom);
		var app = {};

		app.title = '';

		option = {
		    tooltip: {
		        trigger: 'item',
		        formatter: "{a} <br/>{b}: {c} ({d}%)"
		    },
			legend: {
				orient: 'horizontal',
				left: 'left',
					data: ['Recursos Humanos','Estudios Complementarios','Materiales de oficina','Gestion Doc. Alquiler Viaticos']
			},
		    series: [
		        {
		            name:'Tipo de Gasto',
		            type:'pie',
		            radius: ['27%', '50%'],
		            avoidLabelOverlap: false,
		            label: {
		                normal: {
		                    show: false,
		                    position: 'center'
		                },
		                emphasis: {
		                    show: true,
		                    textStyle: {
		                        fontSize: '15',
		                        fontWeight: 'bold'
		                    }
		                }
		            },
		            labelLine: {
		                normal: {
		                    show: false
		                }
		            },
		           data:[
							{value:arrayTipoEstudio[0], name:'Recursos Humanos'},
							{value:arrayTipoEstudio[1], name:'Estudios Complementarios'},
							{value:arrayTipoEstudio[2], name:'Materiales de oficina'},
							{value:arrayTipoEstudio[3], name:'Gestion Doc. Alquiler Viaticos'}
						]

		        }
		    ]
		};
	
		if (option && typeof option === "object") {
			myChart.setOption(option, true);
		}*/
		var arrayTipoEstudio=new Array();
		$.each(respuesta,function(index,element)
		{
			arrayTipoEstudio[index]=element.Total;
		});

			var dom = document.getElementById("MontosTiposGasto");
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
					data: ['Recursos Humanos','Estudios Complementarios','Materiales de oficina','Gestion Doc. Alquiler Viaticos']
				},

				series : [
				{
					name: 'Estudios',
					type: 'pie',
					radius : '55%',
					center: ['50%', '60%'],
					data:[
					{value:arrayTipoEstudio[0], name:'Recursos Humanos'},
					{value:arrayTipoEstudio[1], name:'Estudios Complementarios'},
					{value:arrayTipoEstudio[2], name:'Materiales de oficina'},
					{value:arrayTipoEstudio[3], name:'Gestion Doc. Alquiler Viaticos'}
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
	url:base_url+"index.php/PrincipalFyE/AvanceCostoInv",
	type:"POST",
	cache:false,
	success:function(respuesta)
	{
		var valor=JSON.parse(respuesta);
		var dom = document.getElementById("Avance");
		var myChart = echarts.init(dom);
		var app = {};
				option = null;
				option = {
		    title : {
		        text: '',
		        subtext: ''
		    },
		    grid: {
		        left: '3%',
		        right: '7%',
		        bottom: '3%',
		        containLabel: true
		    },
		    tooltip : {
		        trigger: 'axis',
		        showDelay : 0,
		        formatter : function (params) {
		            if (params.value.length > 1) {
		                return params.seriesName + ' :<br/>'
		                + params.value[0] + '%'
		                + params.value[1] + 'S/. ';
		            }
		            else {
		                return params.seriesName + ' :<br/>'
		                + params.name + ' : '
		                + params.value + ' S/. ';
		            }
		        },
		        axisPointer:{
		            show: true,
		            type : 'cross',
		            lineStyle: {
		                type : 'dashed',
		                width : 1
		            }
		        }
		    },
		    toolbox: {
		        feature: {
		            dataZoom: {},
		            brush: {
		                type: ['rect', 'polygon', 'clear']
		            }
		        }
		    },
		    brush: {
		    },
		    legend: {
		        data: ['AVANCE FÍSICO VS COSTO ESTUDIO','COSTO ESTUDIO'],
		        left: 'center'
		    },
		    xAxis : [
		        {
		            type : 'value',
		            scale:true,
		            axisLabel : {
		                formatter: '% {value}'
		            },
		            splitLine: {
		                show: false
		            }
		        }
		    ],
		    yAxis : [
		        {
		            type : 'value',
		            scale:true,
		            axisLabel : {
		                formatter: 'S/ . {value}'
		            },
		            splitLine: {
		                show: false
		            }
		        }
		    ],
		    series : [
		        {
		            name:'AVANCE FÍSICO VS COSTO ESTUDIO',
		            type:'scatter',
		            data: valor,
		            markArea: {
		                silent: true,
		                itemStyle: {
		                    normal: {
		                        color: 'transparent',
		                        borderWidth: 1,
		                        borderType: 'dashed'
		                    }
		                },
		                data: [[{
		                    name: 'AAVANCE FÍSICO VS COSTO ESTUDIO',
		                    xAxis: 'min',
		                    yAxis: 'min'
		                }, {
		                    xAxis: 'max',
		                    yAxis: 'max'
		                }]]
		            },
		            markPoint : {
		                data : [
		                    {type : 'max', name: 'AVANCE FÍSICO VS COSTO ESTUDIO'},
		                    {type : 'min', name: 'AVANCE FÍSICO'}
		                ]
		            },
		            markLine : {
		                lineStyle: {
		                    normal: {
		                        type: 'solid'
		                    }
		                },
		                data : [
		                    {type : 'average', name: 'AVANCE FÍSICO'},
		                    { xAxis: 160 }
		                ]
		            }
		        }
		    ]
		};

		if (option && typeof option === "object") {
			myChart.setOption(option, true);
		}
	}
});
});

