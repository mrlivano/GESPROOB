<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PMI_OperacionMantenimientoPi extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('Model_OperacionMantenimientoPi');
        $this->load->model('Model_RubroE');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();
            $nombreArchivo = $_FILES['fileActaCompromiso']['name'];
            $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
            $this->db->trans_start();
            $c_data['id_pi']=$this->input->post("hdIdPI");
            $c_data['monto_operacion']=floatval(str_replace(",","",$this->input->post("txt_monto_operacion")));
            $c_data['monto_mantenimiento']=floatval(str_replace(",","",$this->input->post("txt_monto_mantenimiento")));
            $c_data['responsable_operacion']=$this->input->post("txt_responsable_operacion");
            $c_data['responsable_mantenimiento']=$this->input->post("txt_responsable_mantenimiento");
            $c_data['urlArchivo']=$extension;
            $ultimoId = $this->Model_OperacionMantenimientoPi->insertar($this->security->xss_clean($c_data));
            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $config['upload_path'] = './uploads/ActaCompromisoOperacionyMantenimiento/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $ultimoId;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('fileActaCompromiso'))
                {
                    $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                    echo json_encode($msg);exit;
                }
            }
            $this->db->trans_complete();
            $msg = ($ultimoId != '' ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }

        $idProyecto=$this->input->get('codigo');
        $proyectoInversion=$this->Model_ProyectoInversion->getProyectoInversionPorIdPi($idProyecto);    
        $this->load->view('front/Pmi/ProyectoInversion/operacionmantenimiento', ['proyectoInversion'=>$proyectoInversion]);
    }

    function eliminar()
    {
        $id_operacion_mantenimiento_pi = $this->input->post("idOperacion");
        $extension = $this->Model_OperacionMantenimientoPi->getOperacionyMantenimiento($id_operacion_mantenimiento_pi)->urlArchivo;
        $data = $this->Model_OperacionMantenimientoPi->eliminar($id_operacion_mantenimiento_pi);
        $msg = array();
        if($data>0)
        {
            if (file_exists("uploads/ActaCompromisoOperacionyMantenimiento/".$id_operacion_mantenimiento_pi.".".$extension))
            {
                unlink("uploads/ActaCompromisoOperacionyMantenimiento/".$id_operacion_mantenimiento_pi.".".$extension);
            }
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron guardados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }
    }

    function ListaOperacionMantenimiento()
    {
        if ($this->input->is_ajax_request())
        {
            $data=$this->Model_OperacionMantenimientoPi->ListaOperacionMantenimiento($this->input->post("id_pi"));
            foreach ($data as $key => $value)
            {
                $value->fecha_registro=date('d/m/Y',strtotime($value->fecha_registro));
                $value->monto_operacion= number_format($value->monto_operacion, 2, '.', ',');
                $value->monto_mantenimiento= number_format($value->monto_mantenimiento, 2, '.', ',');
            }
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }
}
