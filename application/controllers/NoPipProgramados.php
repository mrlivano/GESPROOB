<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NoPipProgramados extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('NoPipProgramados_Model');
        $this->load->model('Estudio_Inversion_Model');
        $this->load->helper('FormatNumber_helper');
    }

    public function GetNoPipProgramados()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat = "listarnopip_programado";
            $anio = $this->input->post("anio");
            $data = $this->NoPipProgramados_Model->GetNoPipProgramados($flat, $anio);
            echo json_encode(array('data' => $data));
        }
        else 
        {
            show_404();
        }
    }

    public function index()
    {
        $this->_load_layout('Front/Pmi/frmnopipprogramados');
    }

    public function nopipformulacion()
    {
        $listarnopipFormulacion=$this->NoPipProgramados_Model->NoPipFormulacionEvaluacionListar();
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view('front/Formulacion_Evaluacion/NoPip/index',['listarnopipFormulacion'=>$listarnopipFormulacion]);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }
    
    public function insertar()
    {
        if($_POST)
        {
            $id_piC=$this->input->post('ListadoFiltroNoPIP');
            $id_pi=explode("_",$id_piC);
            $TipoNoPip=$this->input->post('txtnombreNoPip'); 

            $this->NoPipProgramados_Model->AddEstudioInversionNoPIP($id_pi[0],$TipoNoPip);

            $data=$this->NoPipProgramados_Model->listarUltimoEstudioInversion();

            $id_estudio_inv=$data->id_est_inv;
            $txtNombreDocumento=$this->input->post('txtNombreDocumento'); 
            $txtDescripcionDocumento=$this->input->post('txtDescripcionDocumento');

            $dataUltimoDocumentoanterior=$this->Estudio_Inversion_Model->get_obtener_ultimo_id();
            $idanterior=$dataUltimoDocumentoanterior->idultimo;
            $idanterior=$idanterior+1;
            $url=$idanterior.".".$this->input->post('nombreUrlDocumento');
            $this->Estudio_Inversion_Model->AddDocumentosEstudio2($id_estudio_inv, $txtNombreDocumento, $txtDescripcionDocumento, $url);

            $dataUltimoDocumento=$this->NoPipProgramados_Model->listarUltimoDocumentoInversion();
            $id=$dataUltimoDocumento->id_documento;
            $config['upload_path']   = './uploads/DocumentoNoPip/';
            $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx|jpg|png';//'*';
            $config['max_width']     = 2000;
            $config['max_height']    = 2000;
            $config['max_size']      = 50000;
            $config['encrypt_name']  = false;
            $config['file_name']    = $id;
            $this->load->library('upload', $config);
            $this->upload->do_upload('Documento_noPip');
            $this->session->set_flashdata('correcto', 'No PIP registrada correctamente..');
            return redirect('/NoPipProgramados/nopipformulacion');
        }
        $ListarPipProgramados=$this->NoPipProgramados_Model->ListarPipProgramados();
        $this->load->view('front/Formulacion_Evaluacion/NoPip/insertar',['ListarPipProgramados' => $ListarPipProgramados ]);
    }

    public function editar()
    {
        if($this->input->post('hdId'))
        {   
            $this->db->trans_start(); 
            $id=$this->input->post('hdId');
            $txtNombreNoPip=$this->input->post('txtNombreNoPip');

            $this->NoPipProgramados_Model->editar($id,$txtNombreNoPip);    
            $this->db->trans_complete();     
            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se actualizo los datos de NO PIP.']);exit;
        }

        $id=$this->input->get('id');
        $NoPipData=$this->NoPipProgramados_Model->NoPip($id);
        return $this->load->view('front/Formulacion_Evaluacion/NoPip/editar',['NoPipData'=>$NoPipData]);       
    }

    public function listarNopip()
    {
        if ($this->input->is_ajax_request())
        {
            $TipoNoPip=$this->input->post('desc_tipo_nopip');
            $data = $this->NoPipProgramados_Model->listarNopip($TipoNoPip);
            echo json_encode($data);
        } 
        else
        {
            show_404();
        }
    }

    public function _load_layout($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsNoPipProgramados.php');
    }
}
