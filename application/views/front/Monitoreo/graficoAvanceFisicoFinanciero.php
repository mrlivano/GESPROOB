
<div class="right_col" role="main">
    <div class="">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <br>
                <p style="color:#265884; font-size: 16px; font-weight: bold; "><?=$pip->nombre_pi?></p>
                <br>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <p style="color: #408829; font-size: 16px;">Avance Físico Financiero Ejecutado<br></p>
                        <div id="grafico" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_content">
                        <p style="color: #408829; font-size: 15px;">Avance Físico Financiero Programado<br></p>
                        <div id="grafico2" style="height:350px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts.min.js"></script>

<script>
    var theme = {
          color: [
              '#1f5c90', '#248a49', '#c23531', '#3498DB',
              '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
              itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#408829',
                  fontSize:16
              }
          },

          dataRange: {
              color: ['#1f610a', '#97b58d']
          },

          toolbox: {
              color: ['#408829', '#408829', '#408829', '#408829']
          },

          tooltip: {
              backgroundColor: 'rgba(0,0,0,0.5)',
              axisPointer: {
                  type: 'line',
                  lineStyle: {
                      color: '#408829',
                      type: 'dashed'
                  },
                  crossStyle: {
                      color: '#408829'
                  },
                  shadowStyle: {
                      color: 'rgba(200,200,200,0.3)'
                  }
              }
          },

          dataZoom: {
              dataBackgroundColor: '#eee',
              fillerColor: 'rgba(64,136,41,0.2)',
              handleColor: '#408829'
          },
          grid: {
              borderWidth: 0
          },

          categoryAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },

          valueAxis: {
              axisLine: {
                  lineStyle: {
                      color: '#408829'
                  }
              },
              splitArea: {
                  show: true,
                  areaStyle: {
                      color: ['rgba(250,250,250,0.1)', 'rgba(200,200,200,0.1)']
                  }
              },
              splitLine: {
                  lineStyle: {
                      color: ['#eee']
                  }
              }
          },
          timeline: {
              lineStyle: {
                  color: '#408829'
              },
              controlStyle: {
                  normal: {color: '#408829'},
                  emphasis: {color: '#408829'}
              }
          },

          k: {
              itemStyle: {
                  normal: {
                      color: '#68a54a',
                      color0: '#a9cba2',
                      lineStyle: {
                          width: 1,
                          color: '#408829',
                          color0: '#86b379'
                      }
                  }
              }
          },
          map: {
              itemStyle: {
                  normal: {
                      areaStyle: {
                          color: '#ddd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  },
                  emphasis: {
                      areaStyle: {
                          color: '#99d2dd'
                      },
                      label: {
                          textStyle: {
                              color: '#c12e34'
                          }
                      }
                  }
              }
          },
          force: {
              itemStyle: {
                  normal: {
                      linkStyle: {
                          strokeColor: '#408829'
                      }
                  }
              }
          },
          chord: {
              padding: 4,
              itemStyle: {
                  normal: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  },
                  emphasis: {
                      lineStyle: {
                          width: 1,
                          color: 'rgba(128, 128, 128, 0.5)'
                      },
                      chordStyle: {
                          lineStyle: {
                              width: 1,
                              color: 'rgba(128, 128, 128, 0.5)'
                          }
                      }
                  }
              }
          },
          gauge: {
              startAngle: 225,
              endAngle: -45,
              axisLine: {
                  show: true,
                  lineStyle: {
                      color: [[0.2, '#86b379'], [0.8, '#68a54a'], [1, '#408829']],
                      width: 8
                  }
              },
              axisTick: {
                  splitNumber: 10,
                  length: 12,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              axisLabel: {
                  textStyle: {
                      color: 'auto'
                  }
              },
              splitLine: {
                  length: 18,
                  lineStyle: {
                      color: 'auto'
                  }
              },
              pointer: {
                  length: '90%',
                  color: 'auto'
              },
              title: {
                  textStyle: {
                      color: '#333'
                  }
              },
              detail: {
                  textStyle: {
                      color: 'auto'
                  }
              }
          },
          textStyle: {
              fontFamily: 'Arial, Verdana, sans-serif'
          }
      };

      var echartLine = echarts.init(document.getElementById('grafico'), theme);

      echartLine.setOption({
    title: {
        text: ''
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        orient: 'horizontal',
            left: 'center',
            top: 'top',
        data:['Avance Físico Ejecutado','Avance Financiero Ejecutado']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
          show: true,
          orient: 'vertical',
          left: 'right',
          top: 'top',
          feature: {
            magicType: {
              show: true,             
              title: {
                line: 'Linea',
                bar: 'Barra',
                stack: 'Stack',
                tiled: 'Tiled'
              },
              type: ['line', 'bar', 'stack', 'tiled']
            },
            restore: {
              show: true,
              title: "Restaurar"
            },
            saveAsImage: {
              show: true,
              title: "Guardar Imagen"
            }
          }
        },
    xAxis: {
        type: 'category',
        name: 'Mes',
        boundaryGap: false,
        data: [
            <?php 
                foreach ($dato as $key =>  $value)
                {
                    echo "'".trim($value->mes_programado)."',";
                } 
            ?>
        ]
    },
    yAxis: {
        type: 'value',        
        name: 'Porcentaje %'
    },
    series: [
        {
            name:'Avance Físico Ejecutado',
            type:'line',
            data:[
                <?php
                    $acumulado=0; 
                    foreach ($dato as $key =>  $value)
                    {
                        $acumulado+=$value->avance_fisico_proyecto;
                        echo (a_number_format($acumulado , 2, '.',",",0)).",";
                    } 
                ?>
            ]
        },
        {
            name:'Avance Financiero Ejecutado',
            type:'line',
            data:[
                <?php 
                    $acumulado=0;
                    foreach ($dato as $key =>  $value)
                    {
                        $acumulado+=$value->avance_financ_proyecto;
                        echo (a_number_format($acumulado , 2, '.',",",0)).",";
                    } 
                ?>
            ]
        }
    ]
}
);


var echartLine = echarts.init(document.getElementById('grafico2'));

      echartLine.setOption({
    title: {
        text: '',
        itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#408829',
                  fontSize:16
              }
    },
    tooltip: {
        trigger: 'axis'
    },
    legend: {
        orient: 'horizontal',
            left: 'center',
            top: 'top',
        data:['Avance Físico Programado','Avance Financiero Programado']
    },
    grid: {
        left: '3%',
        right: '4%',
        bottom: '3%',
        containLabel: true
    },
    toolbox: {
          show: true,
          orient: 'vertical',
          left: 'right',
          top: 'top',
          feature: {
            magicType: {
              show: true,             
              title: {
                line: 'Linea',
                bar: 'Barra',
                stack: 'Stack',
                tiled: 'Tiled'
              },
              type: ['line', 'bar', 'stack', 'tiled']
            },
            restore: {
              show: true,
              title: "Restaurar"
            },
            saveAsImage: {
              show: true,
              title: "Guardar Imagen"
            }
          }
        },
    xAxis: {
        type: 'category',
        name: 'Mes',
        boundaryGap: false,
        data: [
            <?php 
                foreach ($programado as $key =>  $value)
                {
                    echo "'".trim($value->mes_programado)."',";
                } 
            ?>
        ]
    },
    yAxis: {
        type: 'value',        
        name: 'Porcentaje %'
    },
    series: [
        {
            name:'Avance Físico Programado',
            type:'line',
            data:[
                <?php
                    $acumulado=0; 
                    foreach ($programado as $key =>  $value)
                    {
                        $acumulado+=$value->avance_fisico_proyecto;
                        echo (a_number_format($acumulado , 2, '.',",",0)).",";
                    } 
                ?>
            ]
        },
        {
            name:'Avance Financiero Programado',
            type:'line',
            data:[
                <?php 
                    $acumulado=0;
                    foreach ($programado as $key =>  $value)
                    {
                        $acumulado+=$value->avance_financ_proyecto;
                        echo (a_number_format($acumulado , 2, '.',",",0)).",";
                    } 
                ?>
            ]
        }
    ]
}
);



    </script>
