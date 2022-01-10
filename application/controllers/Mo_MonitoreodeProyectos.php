<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_MonitoreodeProyectos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Mo_Producto');
        $this->load->model('Model_Mo_Actividad');
        $this->load->model('Model_Mo_Ejecucion_Actividad');
        $this->load->model('Model_Mo_Programacion_Actividad');
        $this->load->model('Model_Mo_Bandeja_Monitoreo');
        $this->load->model('Model_Funcion');
        $this->load->helper('FormatNumber_helper');
        $this->load->library('mydompdf');
    }

    function index()
    {
        if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9)
        {
            $listaProyecto = $this->Model_Mo_Producto->listadoProyectosAdmin();
        }
        else
        {
            $listaProyecto = $this->Model_Mo_Producto->listaProyecto();
        }
        $mensajesNoLeidos = count($this->Model_Mo_Bandeja_Monitoreo->getNoleidos());
        $this->load->view('layout/MONITOREO/header',['mensajesNoLeidos'=>$mensajesNoLeidos]);
        $this->load->view('front/Monitoreo/index',['listaProyecto' => $listaProyecto]);
        $this->load->view('layout/MONITOREO/footer');
    }

    public function consulta()
    {
        if($_POST)
        {
            $idFuncion = $this->input->post('idFuncion');
            $idDivisionFuncional = $this->input->post('idDivisionFuncional');
            $idGrupoFuncional = $this->input->post('idGrupoFuncional');
            $provincia = $this->input->post('idProvincia');
            $distrito = $this->input->post('idDistrito');

            $idFuncion=(($idFuncion=='' || $idFuncion==null) ? 'NULL' : $idFuncion);
            $idDivisionFuncional=(($idDivisionFuncional=='' || $idDivisionFuncional==null) ? 'NULL' : $idDivisionFuncional);
            $idGrupoFuncional=(($idGrupoFuncional=='' || $idGrupoFuncional==null) ? 'NULL' : $idGrupoFuncional);
            $provincia=(($provincia=='' || $provincia==null) ? 'NULL' : "'".$provincia."'");
            $distrito=(($distrito=='' || $distrito==null) ? 'NULL' : "'".$distrito."'");

            $listaProyecto=$this->Model_Funcion->GetProyectos($idFuncion,$idDivisionFuncional,$idGrupoFuncional,$provincia,$distrito,'NULL','NULL');

            foreach ($listaProyecto as $value) 
            {                
                $avance=$this->Model_Mo_Producto->graficoEjecucion($value->id_pi);
                $value->avanceFisico=(count($avance)>0 ? $avance[0]->avance_fisico_proyecto :0 );                
            }

            $this->load->view('front/Monitoreo/tablaConsulta',['listaProyecto'=>$listaProyecto]);
        }
        else
        {
            $funcion=$this->Model_Funcion->GetListaFuncion();
            $provincia=$this->Model_Funcion->GetProvincia();
            $mensajesNoLeidos = count($this->Model_Mo_Bandeja_Monitoreo->getNoleidos());
            $this->load->view('layout/MONITOREO/header',['mensajesNoLeidos'=>$mensajesNoLeidos, 'funcion'=>$funcion, 'provincia'=>$provincia]);
            $this->load->view('front/Monitoreo/consulta');
            $this->load->view('layout/MONITOREO/footer');

        }
        
    }

    function BuscarProyecto()
    {
        $codigoUnico = $this->input->get('inputValue');
        $existe = count($this->Model_Mo_Producto->existeProyecto($codigoUnico));
        if($existe>0)
        {
            $msg = (['proceso' => 'Info', 'mensaje' => 'Este proyecto ya existe']);
                echo json_encode($msg);
            exit;
        }
        $proyecto = $this->Model_Mo_Producto->buscarProyecto($codigoUnico);
        $this->load->view('front/json/json_view', ['datos' => $proyecto]);
    }

    function InsertarProducto()
    {
        if($_POST)
        {
            $msg = array();

            $existe = count($this->Model_Mo_Producto->verificarProducto($this->input->post('descripcionProducto'),$this->input->post('idPi')));
            if($existe!=0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'Ya existe el Producto.']);
                echo json_encode($msg);
                exit;
            }

            $sumatoriaValoracion = $this->Model_Mo_Producto->sumarValoracion($this->input->post('idPi'));
            $valorizacionRestante = 100-$sumatoriaValoracion->sumatoria;
            if($this->input->post('valoracionProducto')>$valorizacionRestante)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'La valorizacion ingresada supera la valorización Restante. Intente con otro valor']);
                echo json_encode($msg);
                exit;
            }

            $c_data['desc_producto'] = $this->input->post('descripcionProducto');
            $c_data['id_pi'] =  $this->input->post('idPi');
            $c_data['valoracion_producto'] =  $this->input->post('valoracionProducto');
            $data = $this->Model_Mo_Producto->insertar($c_data);

            $msg = ($data != '' || $data != null ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente', 'idProducto' => $data ]) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $codigoUnico = $this->input->get('codigoUnico');
        $proyecto = $this->Model_Mo_Producto->buscarProyecto($codigoUnico);
        $this->load->view('front/Monitoreo/Mo_Producto/insertar', ['proyecto' => $proyecto]);
    }

    function EditarProducto()
    {
        if($_POST)
        {

        }
        $idPi = $this->input->get('id_pi');
        $proyecto = $this->Model_Mo_Producto->ProyectoPorId($idPi);
        $producto = $this->Model_Mo_Producto->listaProducto($idPi);
        foreach ($producto as $key => $value)
        {
            $value->childActividad = $this->Model_Mo_Actividad->listaActividad($value->id_producto);
            foreach ($value->childActividad as $key => $actividad)
            {
                $actividad->childProgramacion = $this->Model_Mo_Programacion_Actividad->listaProgramacionActividad($actividad->id_actividad);
            }
        }

        $sumatoriaValoracion = $this->Model_Mo_Producto->sumarValoracion($idPi);
        $valorizacionRestante = 100-$sumatoriaValoracion->sumatoria;

        $this->load->view('front/Monitoreo/Mo_Producto/editar', ['proyecto' => $proyecto, 'producto'=>$producto,'valorizacionRestante'=>$valorizacionRestante]);
    }

    function editarDatosProducto()
    {
        if($_POST)
        {
            $c_data['desc_producto'] = $this->input->post('txtProducto');
            $c_data['valoracion_producto'] = $this->input->post('txtValoracionProducto');

            $this->db->trans_begin();

            $data = $this->Model_Mo_Producto->editar($c_data,$this->input->post('hdIdProducto')); 

            $sumatoriaValoracion = $this->Model_Mo_Producto->sumarValoracion($this->input->post('hdIdProyecto'));
            if($sumatoriaValoracion->sumatoria>100)
            {
                $this->db->trans_rollback();
                $msg = (['proceso' => 'Error', 'mensaje' => 'Supero la valorización Restante.']);
                echo json_encode($msg);exit;
            }

            $this->db->trans_complete(); 
         
            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron editados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));

            echo json_encode($msg);exit;
        }

        $idPi = $this->input->get('idPi');
        $idProducto = $this->input->get('idProducto');
        $producto = $this->Model_Mo_Producto->ProductoId($idProducto);
        $this->load->view('front/Monitoreo/Mo_Producto/EditarProducto',['producto'=>$producto,'idPi'=>$idPi]);
    }


    function eliminarMonitoreo()
    {
        $msg = array();
        if($this->session->userdata('tipoUsuario')==1 || $this->session->userdata('tipoUsuario')==9)
        {
            $data = $this->Model_Mo_Producto->eliminarMonitoreo($this->input->post('idPi'));
            $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el monitoreo del proyecto fue eliminado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        else
        {
            $msg = (['proceso' => 'Error', 'mensaje' => 'Usted. No tiene permiso para realizar esta acción']);
            echo json_encode($msg);exit;
        }

    }

    function eliminarProducto()
    {
        $msg = array();
        $data = $this->Model_Mo_Producto->eliminarProducto($this->input->post('idProducto'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'el monitoreo del proyecto fue eliminado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function FichadeMonitoreo()
    {
        if($_GET)
        {
            $id_pi = isset($_GET['id_pi']) ? $_GET['id_pi'] : null;
            $producto=$this->Model_Mo_Actividad->listaActividadProducto($id_pi);
            foreach ($producto as $key => $value)
            {
                $mes = date('Y-m').'-01';
                $actividadProgramada = $this->Model_Mo_Programacion_Actividad->verificarProgramacion($mes,$value->id_actividad);
                $programadoAcumulado = $this->Model_Mo_Programacion_Actividad->EjecucionAcumulado($value->id_actividad);
                $actividadEjecutada = $this->Model_Mo_Ejecucion_Actividad->ejecucionMensual($value->id_actividad, date('m'),date('Y'));
                $ejecutadoAcumulado = $this->Model_Mo_Ejecucion_Actividad->ejecucionAcumulado($value->id_actividad);
                $value->MetaProgdelMes='';
                $value->MontoProgdelMes='';
                $value->MetaAcumulado='';
                $value->MontoAcumulado='';
                $value->MetaEjecdelMes='';
                $value->MontoEjecdelMes='';
                $value->MetaEjecAcumulado='';
                $value->MontoEjecAcumulado='';

                foreach ($actividadProgramada as $key => $item)
                {
                    $value->MetaProgdelMes=$actividadProgramada[0]->cantidad_ejecucion_programada;
                    $value->MontoProgdelMes=$actividadProgramada[0]->ejec_finan_programada;
                }
                foreach ($programadoAcumulado as $key => $item)
                {
                    $value->MetaAcumulado = $programadoAcumulado->metaacumulado;
                    $value->MontoAcumulado = $programadoAcumulado->montoacumulado;
                }
                foreach ($actividadEjecutada as $key => $item)
                {
                    $value->MetaEjecdelMes = $actividadEjecutada->metames;
                    $value->MontoEjecdelMes = $actividadEjecutada->montomes;
                }
                foreach ($ejecutadoAcumulado as $key => $item)
                {
                    $value->MetaEjecAcumulado = $ejecutadoAcumulado->metaacumulado;
                    $value->MontoEjecAcumulado = $ejecutadoAcumulado->montoacumulado;
                }
                $value->PorcentajeEjecAcumulado=($value->MetaAcumulado=='' || $value->MetaAcumulado==0 ? '' : (100*$value->MetaEjecAcumulado)/$value->MetaAcumulado);
                $value->PorcentajeProgAcumulado=($value->MontoAcumulado=='' || $value->MontoAcumulado==0 ? '' :(100*$value->MontoEjecAcumulado)/$value->MontoAcumulado);
            }
            
            $meses = $this->listaMeses();

            $mensajesNoLeidos = count($this->Model_Mo_Bandeja_Monitoreo->getNoleidos());
            $this->load->view('layout/MONITOREO/header',['mensajesNoLeidos'=>$mensajesNoLeidos]);
            $this->load->view('front/Monitoreo/FichaMonitoreo', ['listaProducto' => $producto ,'listaMeses' =>$meses, 'idPi'=>$id_pi]);
            $this->load->view('layout/MONITOREO/footer');
        }

        else
        {
            $id_pi = $this->input->post('hdIdProyecto');
            $anio = $this->input->post('anio');
            $mes = $this->input->post('mes');
            $producto=$this->Model_Mo_Actividad->listaActividadProducto($id_pi);
            foreach ($producto as $key => $value)
            {
                $fecha = $anio.'-'.$mes.'-01';
                $actividadProgramada = $this->Model_Mo_Programacion_Actividad->verificarProgramacion($fecha,$value->id_actividad);
                $programadoAcumulado = $this->Model_Mo_Programacion_Actividad->EjecucionAcumulado($value->id_actividad);
                $actividadEjecutada = $this->Model_Mo_Ejecucion_Actividad->ejecucionMensual($value->id_actividad, $mes,$anio);
                $ejecutadoAcumulado = $this->Model_Mo_Ejecucion_Actividad->ejecucionAcumulado($value->id_actividad);
                $value->MetaProgdelMes='';
                $value->MontoProgdelMes='';
                $value->MetaAcumulado='';
                $value->MontoAcumulado='';
                $value->MetaEjecdelMes='';
                $value->MontoEjecdelMes='';
                $value->MetaEjecAcumulado='';
                $value->MontoEjecAcumulado='';

                foreach ($actividadProgramada as $key => $item)
                {
                    $value->MetaProgdelMes=$actividadProgramada[0]->cantidad_ejecucion_programada;
                    $value->MontoProgdelMes=$actividadProgramada[0]->ejec_finan_programada;
                }
                foreach ($programadoAcumulado as $key => $item)
                {
                    $value->MetaAcumulado = $programadoAcumulado->metaacumulado;
                    $value->MontoAcumulado = $programadoAcumulado->montoacumulado;
                }
                foreach ($actividadEjecutada as $key => $item)
                {
                    $value->MetaEjecdelMes = $actividadEjecutada->metames;
                    $value->MontoEjecdelMes = $actividadEjecutada->montomes;
                }
                foreach ($ejecutadoAcumulado as $key => $item)
                {
                    $value->MetaEjecAcumulado = $ejecutadoAcumulado->metaacumulado;
                    $value->MontoEjecAcumulado = $ejecutadoAcumulado->montoacumulado;
                }
                $value->PorcentajeEjecAcumulado=($value->MetaAcumulado=='' || $value->MetaAcumulado==0 ? '' : (100*$value->MetaEjecAcumulado)/$value->MetaAcumulado);
                $value->PorcentajeProgAcumulado=($value->MontoAcumulado=='' || $value->MontoAcumulado==0 ? '' :(100*$value->MontoEjecAcumulado)/$value->MontoAcumulado);
            }

            $this->load->view('front/Monitoreo/tablaMonitoreo', ['listaProducto' => $producto]);
        }
    }

    function FichadeMonitoreoPDF()
    {
        $id_pi = isset($_GET['id_pi']) ? $_GET['id_pi'] : null;
        $anio = isset($_GET['anio']) ? $_GET['anio'] : null;
        $mes = isset($_GET['mes']) ? $_GET['mes'] : null;
        $producto=$this->Model_Mo_Actividad->listaActividadProducto($id_pi);
        foreach ($producto as $key => $value)
        {
            $fecha = $anio.'-'.$mes.'-01';
            $actividadProgramada = $this->Model_Mo_Programacion_Actividad->verificarProgramacion($fecha,$value->id_actividad);
            $programadoAcumulado = $this->Model_Mo_Programacion_Actividad->EjecucionAcumulado($value->id_actividad);
            $actividadEjecutada = $this->Model_Mo_Ejecucion_Actividad->ejecucionMensual($value->id_actividad, $mes,$anio);
            $ejecutadoAcumulado = $this->Model_Mo_Ejecucion_Actividad->ejecucionAcumulado($value->id_actividad);
            $value->MetaProgdelMes='';
            $value->MontoProgdelMes='';
            $value->MetaAcumulado='';
            $value->MontoAcumulado='';
            $value->MetaEjecdelMes='';
            $value->MontoEjecdelMes='';
            $value->MetaEjecAcumulado='';
            $value->MontoEjecAcumulado='';

            foreach ($actividadProgramada as $key => $item)
            {
                $value->MetaProgdelMes=$actividadProgramada[0]->cantidad_ejecucion_programada;
                $value->MontoProgdelMes=$actividadProgramada[0]->ejec_finan_programada;
            }
            foreach ($programadoAcumulado as $key => $item)
            {
                $value->MetaAcumulado = $programadoAcumulado->metaacumulado;
                $value->MontoAcumulado = $programadoAcumulado->montoacumulado;
            }
            foreach ($actividadEjecutada as $key => $item)
            {
                $value->MetaEjecdelMes = $actividadEjecutada->metames;
                $value->MontoEjecdelMes = $actividadEjecutada->montomes;
            }
            foreach ($ejecutadoAcumulado as $key => $item)
            {
                $value->MetaEjecAcumulado = $ejecutadoAcumulado->metaacumulado;
                $value->MontoEjecAcumulado = $ejecutadoAcumulado->montoacumulado;
            }
            $value->PorcentajeEjecAcumulado=($value->MetaAcumulado=='' || $value->MetaAcumulado==0 ? '' : (100*$value->MetaEjecAcumulado)/$value->MetaAcumulado);
            $value->PorcentajeProgAcumulado=($value->MontoAcumulado=='' || $value->MontoAcumulado==0 ? '' :(100*$value->MontoEjecAcumulado)/$value->MontoAcumulado);
        }

        $html = $this->load->view('front/Monitoreo/FichaMonitoreoPDF',['listaProducto'=> $producto], true);
        $this->mydompdf->load_html($html);
        $this->mydompdf->set_paper("A4", "landscape");
        $this->mydompdf->render();
        $this->mydompdf->stream("FichaMonitoreo.pdf", array("Attachment" => false));
    }

    function avanceFisicoFinanciero()
    {
        $id_pi = isset($_GET['id_pi']) ? $_GET['id_pi'] : null;
        $ejecutado = $this->Model_Mo_Producto->graficoEjecucion($id_pi);
        $programado = $this->Model_Mo_Producto->graficoProgramacion($id_pi);
        $pip = $this->Model_Mo_Producto->getProyecto($id_pi);

        $mensajesNoLeidos = count($this->Model_Mo_Bandeja_Monitoreo->getNoleidos());
        $this->load->view('layout/MONITOREO/header',['mensajesNoLeidos'=>$mensajesNoLeidos]);
        $this->load->view('front/Monitoreo/graficoAvanceFisicoFinanciero',['dato'=>$ejecutado,'programado'=>$programado,'pip'=>$pip]);
        $this->load->view('layout/Monitoreo/footer');
    }

    function valoracionRestante()
    {
        $msg = array();
        $sumatoriaValorac=$this->Model_Mo_Producto->sumarValoracion($this->input->post('idPi'));
        $valoracionRestante = 100-$sumatoriaValorac->sumatoria;
        $msg =(['valoracionRestante'=>$valoracionRestante]);
        echo json_encode($msg);exit;
    }

    function diagramGantt ()
    {
      $proyecto = $this->Model_Mo_Producto->ProyectoPorId($this->input->get('id_pi'));

      $producto = $this->Model_Mo_Producto->listaProductoGantt($this->input->get('id_pi'));

      foreach ($producto as $key => $value)
      {
          $value->childActividad = $this->Model_Mo_Actividad->listaActividadGantt($value->id_producto);
      }

      $this->load->view('front/Monitoreo/diagramaGantt', ['producto'=>$producto, 'proyecto'=>$proyecto]);
    }

    private function listaMeses()
    {
        $array = array(
            'Enero'=>'01',
            'Febrero'=>'02',
            'Marzo'=>'03',
            'Abril'=>'04',
            'Mayo'=>'05',
            'Junio'=>'06',
            'Julio'=>'07',
            'Agosto'=>'08',
            'Setiembre'=>'09',
            'Octubre'=>'10',
            'Noviembre'=>'11',
            'Diciembre'=>'12'
        );
        return $array;
    }
}
