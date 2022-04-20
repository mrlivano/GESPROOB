<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estudio_Inversion extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Estudio_Inversion_Model');
        $this->load->model('EstadoCicloInversion_Model');
        $this->load->helper('FormatNumber_helper');        
    }

    public function index()
    {
        $this->_load_layout('front/Formulacion_Evaluacion/frmEstudioInversion');
    }

    public function registroEstudio()
    {
        $listaNivelEstudio= $this->Estudio_Inversion_Model->get_NivelEstudio();
        $listaTipoEstudio= $this->Estudio_Inversion_Model->get_TipoEstudio();
        $listaUnidadFormuladora = $this->Estudio_Inversion_Model->get_UnidadFormuladora();
        $listaUnidadEjecutora = $this->Estudio_Inversion_Model->get_UnidadEjecutora();
        $estado = $this->EstadoCicloInversion_Model->listarEstadoCicloNombre();
        return $this->load->view('Front/Formulacion_Evaluacion/EstudioInversion/insertar',['estado'=>$estado, 'listaNivelEstudio' => $listaNivelEstudio, 'listaTipoEstudio' => $listaTipoEstudio , 'listaUnidadFormuladora' => $listaUnidadFormuladora, 'listaUnidadEjecutora' => $listaUnidadEjecutora]);
    }

    public function listaProyectoPorEstado()
    {
        $NombreEstadoFormulacionEvalu=$this->input->post('valor');
        $datos=$this->Estudio_Inversion_Model->get_listaproyectos($NombreEstadoFormulacionEvalu);
        echo json_encode($datos);
        exit;
    }

    public function get_listaproyectos()
    {
        if ($this->input->is_ajax_request())
        {
            $NombreEstadoFormulacionEvalu=$this->input->post('valor');
            $datos=$this->Estudio_Inversion_Model->get_listaproyectos($NombreEstadoFormulacionEvalu);
            echo json_encode($datos);            
        } 
        else 
        {
            show_404();
        }
    }

    public function get_EstudioInversion()
    {
        if ($this->input->is_ajax_request())
        {
            $anio=$this->input->post('anio');
            $datos=$this->Estudio_Inversion_Model->get_EstudioInversion($anio);
            foreach ($datos as $key => $value)
            {
                $value->fecha = date('d/m/Y',strtotime($value->fecha));
            }
            echo json_encode($datos);        
        }
        else
        {
            show_404();
        }
    }
    
    public function  get_listaproyectosCargar() //mostra ESTADO INVERSION
    {
        if ($this->input->is_ajax_request())
        {
            $id_Pi=$this->input->post('id_Pi');
            $datos = $this->Estudio_Inversion_Model->get_listaproyectosCargar($id_Pi);
            foreach ($datos as $key => $value) 
            {
              $value->costo_pi=a_number_format($value->costo_pi,2,'.',",",3);
            }
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    public function get_UnidadFormuladora()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Estudio_Inversion_Model->get_UnidadFormuladora();
            echo json_encode($datos);
        } 
        else
        {
            show_404();
        }
    }

    public function get_estado_PI()
    {
        $codigo_unico_pi = $_GET['id_pi'];
        $datos = $this->Estudio_Inversion_Model->get_estado_PI($codigo_unico_pi);
        echo json_encode($datos);
    }

    public function get_UnidadEjecutora()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Estudio_Inversion_Model->get_UnidadEjecutora();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function get_persona()
    {

        if ($this->input->is_ajax_request())
        {
            $idUsuario    = $this->session->userdata('idPersona');
            $dataIdPersona= $this->Estudio_Inversion_Model->UsuarioPersona($idUsuario);
            $idPersona=$dataIdPersona->id_persona;
            $datos = $this->Estudio_Inversion_Model->listaPersona();
            echo json_encode($datos);
        } 
        else
        {
            show_404();
        }
    }

    public function get_TipoEstudio()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Estudio_Inversion_Model->get_TipoEstudio();
            echo json_encode($datos);
        } 
        else
        {
            show_404();
        }
    }

    public function get_NivelEstudio()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Estudio_Inversion_Model->get_NivelEstudio();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function get_etapasFE()
    {
        if ($this->input->is_ajax_request()) 
        {
            $datos = $this->Estudio_Inversion_Model->get_etapasFE();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function get_cargo() //mostra ESTADO INVERSION

    {

        if ($this->input->is_ajax_request()) {
            $datos = $this->Estudio_Inversion_Model->get_cargo();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //REGISTRAR NUEVA
    public function AddEtapaEstudio()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();

            $c_data['id_est_inv']=$this->input->post("txt_id_est_inv");
            $c_data['id_etapa_fe']=$this->input->post("listaretapasFE_M");
            $c_data['fecha_inicio']=$this->input->post("dateFechaIniC");
            $c_data['fecha_final']=$this->input->post("dateFechaIniF");
            $c_data['avance_fisico']=0;
            $c_data['fecha_estado']=date('Y-m-d H:i:s');
            $c_data['recomendaciones']=$this->input->post("txadescripcion");
            $c_data['en_seguimiento']=1;

            if ($this->input->post("dateFechaIniC")>$this->input->post("dateFechaIniF"))
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'la fecha de Inicio no puede ser superior a la fecha de finalizacion']);
                $this->load->view('front/json/json_view', ['datos' => $msg]);
                return;
            }

            $q1=$this->Estudio_Inversion_Model->AddEtapaEstudio($c_data);

            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }
    }
    public function eliminarEtapaEstado()
    {
        $msg = array();
        $q1=$this->Estudio_Inversion_Model->eliminarEtapaEstado($this->input->post('idEtapaEstudio'),$this->input->post('idEstudioInversion'));
        $msg=($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Se elimino Correctamente el registro']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
        $this->load->view('front/json/json_view', ['datos' => $msg]);
    }

    //REGISTRAR NUEVA
    public function AddEstudioInversion()
    {
        if ($this->input->is_ajax_request()) {
            $flat               = "C";
            $id_est_inv         = "0";
            $txtCodigoUnico     = $this->input->post("txtCodigoUnico");
            $txtnombres         = $this->input->post("txtnombres");
            $listaFuncionC      = $this->input->post("listaFuncionC");
            $listaTipoInversion = $this->input->post("listaTipoInversion");
            $listaNivelEstudio  = $this->input->post("listaNivelEstudio");
            $lista_unid_form    = $this->input->post("lista_unid_form");
            $lista_unid_ejec    = $this->input->post("lista_unid_ejec");
            $txadescripcion     = $this->input->post("txadescripcion");
            $txtMontoInversion  = floatval(str_replace(",","",$this->input->post("txtMontoInversion")));
            $txtcostoestudio    = floatval(str_replace(",","",$this->input->post("txtcostoestudio")));
            if ($this->Estudio_Inversion_Model->AddEstudioInversion($flat, $id_est_inv, $txtCodigoUnico, $txtnombres, $listaFuncionC, $listaTipoInversion, $listaNivelEstudio, $lista_unid_form, $lista_unid_ejec, $txadescripcion, $txtMontoInversion, $txtcostoestudio) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }
    }
    //REGISTRAR NUEVA
    public function AddResponsableEstudio()
    {
        if ($this->input->is_ajax_request()) {
            $flat              = "C";
            $id_est_inv        = $this->input->post("id_est_inv");
            $listaResponsables = $this->input->post("listaResponsables");
            $dateFechaAsig     = $this->input->post("dateFechaAsig");
            if ($this->Estudio_Inversion_Model->AddResponsableEstudio($flat, $id_est_inv, $listaResponsables, $dateFechaAsig) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }
    }

     public function AddCoordinadorEstudio()
    {
        if ($this->input->is_ajax_request()) {
            $flat              = "AGREGARCOORDINADOR";
            $id_est_inv        = $this->input->post("id_est_inv");
            $listaResponsables = $this->input->post("listaResponsables");
            $dateFechaAsig     = $this->input->post("dateFechaAsig");
            if ($this->Estudio_Inversion_Model->AddCoordinadorEstudio($flat, $id_est_inv, $listaResponsables, $dateFechaAsig) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }
    }

    public function AddAsiganarPersona()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();

            $c_data['id_persona']=$this->input->post("Cbx_Persona");
            $c_data['id_cargo']=$this->input->post("Cbx_Cargo");
            $c_data['id_etapa_estudio']=$this->input->post("txt_IdEtapa_Estudio_p");
            $c_data['funcion']=$this->input->post("txadescripcion");
            $c_data['fecha']=date('Y-m-d');
            $c_data['estado']=1;

            $q1=$this->Estudio_Inversion_Model->AddAsignarPersona($c_data);

            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }
    }


    public function AddDocumentosEstudio()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();

            $config['upload_path']   = './uploads/DocumentosInversion/';
            $config['allowed_types'] = 'pdf|doc|docx|PDF|DOC|DOCX';
            $config['max_width']     = 1024;
            $config['max_height']    = 768;
            $config['file_name'] = 'DOC_';
            $config['max_size'] = '1024000';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('Documento_invserion'))
            {
                $error = array('error' => $this->upload->display_errors('', ''));
                $this->load->view('front/json/json_view',['datos' => $error]);
            }
            else
            {
                $c_data['id_est_inv']=$this->input->post("txt_id_est_invAdd");
                $c_data['nombre_documento']=$this->input->post("txt_documentosEstudio");
                $c_data['desc_documento']=$this->input->post("txt_descripcionEstudio");
                $c_data['Url_documento']=$this->upload->data('file_name');

                $q1=$this->Estudio_Inversion_Model->AddDocumentosEstudio($c_data);

                $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
                $this->load->view('front/json/json_view', ['datos' => $msg]);
            }
        }
        else
        {
            show_404();
        }
    }

    //listar las etapas de los estudios
    public function get_etapas_estudio() //mostra ESTADO INVERSION

    {
        if ($this->input->is_ajax_request())
        {
            $id_est_inv = $this->input->post("id_est_inv");            
            $data       = $this->Estudio_Inversion_Model->get_etapas_estudio($id_est_inv);

            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }
    //listar Documentos de inversion
    public function GetDocumentosEstudio() //mostra ESTADO INVERSION

    {
        if ($this->input->is_ajax_request()) {
            $id_est_inv = $this->input->post('id_est_inv');
            $datos      = $this->Estudio_Inversion_Model->GetDocumentosEstudio($id_est_inv);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //fin listar documentos de inversion

    public function EstudioCoordinadorFunc()
    {
        $listarEstudioCoordinadorFuncion=$this->Estudio_Inversion_Model->EstudioCoordinadorF();
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('front/Formulacion_Evaluacion/EstudioCoordinador/index',['listarEstudioCoordinadorFuncion'=>$listarEstudioCoordinadorFuncion]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }
    public function AsignarFormulador()
    {
         $this->load->view('front/Formulacion_Evaluacion/EstudioCoordinador/AsignarFormulador.php');
    }

    public function getCoordinadorEstudio()
    {
        if ($this->input->is_ajax_request()) 
        {
            $id_est_inv = $this->input->post('id_est_inv');
            $datos      = $this->Estudio_Inversion_Model->getCoordinadorEstudio($id_est_inv);
            foreach ($datos as $key => $value) 
            {
                $value->fecha=date('d/m/Y',strtotime($value->fecha));
            }
            echo json_encode(array('data' => $datos));
        } 
        else 
        {
            show_404();
        }

    }

    public function eliminarCoordinadorEstudio()
    {
        if ($this->input->is_ajax_request()) 
        {
            $msg = array();
            $id_est_inv = $this->input->post('id_est_inv');
            $id_persona = $this->input->post('id_persona');
            $data = $this->Estudio_Inversion_Model->eliminarCoordinadorEstudio($id_est_inv,$id_persona);
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron eliminados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        } 
        else 
        {
            show_404();
        }

    }
//------------------------------------------------------------------------------------------------------------------

    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
        $this->load->view('front/Formulacion_Evaluacion/js/jsFormEval');
    }
}
