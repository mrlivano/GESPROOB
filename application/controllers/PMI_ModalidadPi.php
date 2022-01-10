<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PMI_ModalidadPi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('Model_ModalidadPi');
        $this->load->model('Model_ModalidadE');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $nombreArchivo = $_FILES['fileResolucionModalidad']['name'];
            $c_data['id_modalidad_ejec']=$this->input->post("selectModalidad");
            $c_data['id_pi']=$this->input->post("hdIdPI");
            $c_data['fecha_modalidad_ejec_pi']=$this->input->post("txtFechaModalidad");
            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $c_data['url_resolucion']=".".pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            }
            $q1 = $this->Model_ModalidadPi->insertar($c_data);               
            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $config['upload_path'] = './uploads/ResolucionModalidadEjecucion/';
                $config['allowed_types'] = 'pdf';
                $config['file_name'] = $q1;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('fileResolucionModalidad'))
                {
                    $u_data['url_resolucion']='';
                    $this->Model_ModalidadPi->editar($u_data, $q1);  
                    $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                    echo json_encode($msg);exit;
                } 
            }
            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
        if($_GET)
        {
            $idProyecto=$this->input->get('codigo');
            $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
            $modalidad=$this->Model_ModalidadE->ListaModalidad();
            $this->load->view('front/Pmi/ProyectoInversion/modalidad', ['proyectoInversion'=>$proyectoInversion,'modalidad'=>$modalidad]);
        }        
    }

    function eliminar()
    {
        $msg = array();
        $id_modalidad=$this->input->post("idModalidad");
        $data = $this->Model_ModalidadPi->modalidadPorId($id_modalidad);
        $this->Model_ModalidadPi->eliminar($id_modalidad);
        if (file_exists("uploads/ResolucionModalidadEjecucion/".$id_modalidad.$data[0]->url_resolucion))
        {
            unlink("uploads/ResolucionModalidadEjecucion/".$id_modalidad.$data[0]->url_resolucion);
        }
        $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function ListaModalidadProyecto()
    {
        if ($this->input->is_ajax_request())
        {
            $data=$this->Model_ModalidadPi->ListaModalidadProyecto($this->input->post("id_pi"));
            foreach ($data as $key => $value)
            {
                $value->fecha_modalidad_ejec_pi=date('d/m/Y',strtotime($value->fecha_modalidad_ejec_pi));
            }
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }
}
