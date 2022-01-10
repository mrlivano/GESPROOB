<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Meta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Meta_Model');
        $this->load->helper('FormatNumber_helper');
    }

    public function editarMeta()
    {
        if ($this->input->is_ajax_request()) 
        {
            $msg = array();
            $u_data['nombre_meta_pres']= $this->input->post("txt_nombre_meta_m");            
            $data = $this->Meta_Model->editarMeta($this->input->post("txt_id_meta"),$u_data);
            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron editados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }   
        else 
        {
            show_404();
        }   
    }

    public function AddMeta()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();
            $c_data['nombre_meta_pres']=$this->input->post("txt_nombre_meta");
            $query = $this->Meta_Model->AddMeta($c_data);
            if ($query>0)
            {                
                $msg = (['proceso' => 'Correcto', 'mensaje' => 'El registro fue guardado correctamente ']);
            } 
            else
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'ha ocurrido un error inesperado.']);            
            }
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        } 
        else 
        {
            show_404();
        }
    }

    public function listar_meta()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "R";
            $datos = $this->Meta_Model->listar_meta($flat);
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function Eliminar_meta_prepuestal()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat         = "D";
            $id_meta_pres = $this->input->post("id_meta_pres");
            if ($this->Meta_Model->Eliminar_meta_prepuestal($flat, $id_meta_pres) == true) 
            {
                echo "Se Eliminó  ";
            } 
            else 
            {
                echo "No se Eliminó ";
            }
        } 
        else 
        {
            show_404();
        }

    }

    public function listar_correlativo()
    {
        if ($this->input->is_ajax_request()) 
        {
            $datos = $this->Meta_Model->listar_correlativo();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function listar_meta_presupuestal()
    {
        if ($this->input->is_ajax_request()) 
        {
            $datos = $this->Meta_Model->listar_meta_presupuestal();
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    function metaPresupuestalPi()
    {
        $anio=$this->input->post('anio');
        $codigoUnico=$this->input->post('codigoUnico');
        $datos = $this->Meta_Model->cargarMetaPi($anio,$codigoUnico);
        if(count($datos)>0)
        {
            foreach ($datos as $key => $data) 
            {
                $data->presupuesto=a_number_format($data->presupuesto , 2, '.',",",3);
                $data->modificacion=a_number_format($data->modificacion, 2, '.',",",3);
                $data->compromiso=a_number_format($data->compromiso , 2, '.',",",3);
                $data->devengado=a_number_format($data->devengado , 2, '.',",",3);
                $data->girado=a_number_format($data->girado , 2, '.',",",3);
                $data->certificado=a_number_format($data->certificado , 2, '.',",",3);
            }
            echo json_encode($datos[0]);
        }    
        else
        {
            echo json_encode(['flag'=>0]);
        }    
    }

}
