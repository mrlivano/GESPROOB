<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="">
            <div class="col-md-12 col-xs-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2> <b>Control de Acceso</b> </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                            <ul id="myTab" class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#tabEstadistica"  id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><b>Estadisticas de uso</b></a>
                                </li>
                                <li role="presentation"><a href="#tab_Sector" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Control de Acceso</b></a>
                                </li>
                                <li role="presentation"><a href="#tab_Entidad" role="tab"  id="profile-tab" data-toggle="tab" aria-expanded="false"><b>Control de Usuarios</b></a>
                                </li>                                
                            </ul>
                            <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tabEstadistica" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <div class="table-responsive">
                                                        <div id="graficoEstadistico" style="height:350px;"></div>       
                                                    </div>                                                                                                 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_Entidad" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="x_panel">
                                                <div class="x_content">
                                                    <table id="tablaControlUsuario" class="table table-striped table-bordered table-hover" ellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombres y Apellidos</th>
                                                                <th>Usuario</th>
                                                                <th>Desde</th>
                                                                <th>Hasta</th>
                                                                <th>Con Plazo</th>
                                                                <th>Acciones</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($listaUsuarioControl as $key => $value) {?>
                                                            <tr id="tr<?=$value->id_persona?>">
                                                                <td><?=$value->nombres?></td>
                                                                <td><?=$value->usuario?></td>
                                                                <td><?=$value->fecha_inicio?></td>
                                                                <td><?=$value->fecha_final?></td>
                                                                <td style="text-align: center;"><?php echo ($value->periodo==1 ? '<i class="fa fa-check fa-2x"></i>':'' );?></td>
                                                                <td>
                                                                    <button onclick="paginaAjaxDialogo('modalEditarControlUsuario', 'Editar Control de Usuario',{idPersona:'<?=$value->id_persona?>'}, base_url+'index.php/Control/editarControlUsuario', 'GET', null, null, false, true)" class="btn btn-success btn-xs"><span class="fa fa-edit"></span>  Editar</button>
                                                                </td>
                                                            </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="tab_Sector" aria-labelledby="profile-tab">
                                    <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <div class="x_panel">
                                                    <button onclick="paginaAjaxDialogo('modalControlAcceso', 'Agregar Control para Acceso',{idControlAcceso:''}, base_url+'index.php/Control/insertar', 'GET', null, null, false, true)"  type="button"  class="btn btn-primary"><span class="fa fa-plus-circle"></span> Nuevo </button>
                                                    <div class="x_title">
                                                        <div class="clearfix"></div>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="x_content">
                                                        <table id="tablaControlAcceso"  class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th style="width: 25%">Año</th>
                                                                    <th style="width: 25%">Dia de Inicio</th>
                                                                    <th style="width: 25%">Dia de Final</th>
                                                                    <th style="width: 25%">Acciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php foreach ($listaControl as $key => $value){?>
                                                                    <tr>
                                                                        <td><?=$value->anio?></td>
                                                                        <td><?=$value->fecha_inicio?></td>
                                                                        <td><?=$value->fecha_final?></td>
                                                                        <td><button onclick="paginaAjaxDialogo('modalControlAccesoEditar', 'Editar Control para Acceso',{idControlAcceso:'<?=$value->id_control_acceso?>'}, base_url+'index.php/Control/insertar', 'GET', null, null, false, true)" class="btn btn-success btn-xs"><span class="fa fa-edit"></span>  Editar</button><button onclick="eliminarControldeAcceso('<?=$value->id_control_acceso?>', this);" class="btn btn-danger btn-xs"><span class="fa fa-trash-o"></span>  Eliminar</button></td>
                                                                    </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/vendors/echarts/dist/echarts.min.js"></script>
<script>
    $(document).ready(function()
    {
        graficar();
        $('#tablaControlAcceso').DataTable(
        {
            "language":idioma_espanol
        });
        $('#tablaControlUsuario').DataTable(
        {
            "language":idioma_espanol
        });
    });

    function eliminarControldeAcceso(idControl, element)
    {
        swal({
            title: "Esta seguro que desea eliminar este registro?",
            text: "",
            type: "warning",
            showCancelButton: true,
            cancelButtonText:"CANCELAR" ,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "SI,ELIMINAR",
            closeOnConfirm: false
        },
        function()
        {
            paginaAjaxJSON({ "idControl" : idControl }, base_url+'index.php/Control/eliminar', 'POST', null, function(resp)
            {
                resp=JSON.parse(resp);
                swal(resp.proceso,resp.mensaje,(resp.proceso=='Correcto') ? 'success':'error');
                if(resp.proceso=='Correcto')
                {
                    $(element).parent().parent().remove();
                }               
            }, false, true);
        });
    }

    function graficar()
    {
        
        var theme = {
          color: [
              '#26B99A', '#34495E', '#BDC3C7', '#3498DB',
              '#9B59B6', '#8abb6f', '#759c6a', '#bfd3b7'
          ],

          title: {
              itemGap: 8,
              textStyle: {
                  fontWeight: 'normal',
                  color: '#408829'
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

      var echartLine = echarts.init(document.getElementById('graficoEstadistico'), theme);

      echartLine.setOption({
        tooltip : {
            trigger: 'axis'
        },
        calculable : true,
        xAxis : [
            {
                type : 'category',
                data : [
                    <?php foreach ($estadisticaUso as $key => $value) {
                        echo "'".$value->anio."',";
                    }?>
                ]
            }
        ],
        yAxis : [
            {
                type : 'value'
            }
        ],
        series : [
            {
                name:'Número de Visitas',
                type:'bar',
                data:[
                    <?php foreach ($estadisticaUso as $key => $value) {
                        echo $value->num_visitas.",";
                    }?>

                ]
            }
        ]
    });

    }
    

</script>