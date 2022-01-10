<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FEentregableEstudio extends CI_Controller
{
/* Mantenimiento de division funcional y grupo funcional*/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_FEentregableEstudio');
        $this->load->model('Gant_Model');
        $this->load->helper('string');

    }
    public function ver_FEentregable()
    {
        $id_etapa_estudio = isset($_GET['id_etapa_estudio']) ? $_GET['id_etapa_estudio'] : '';
        $data = array('Etapa_Estudio' => $id_etapa_estudio);
        $this->session->set_userdata($data);
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Gant_Model->GetEntregable($id_etapa_estudio);
            $links = $this->Gant_Model->GetLink($id_etapa_estudio);
            echo json_encode(array('data' => $datos, 'links' => $links));
        }
        else
        {
            $data = array('Etapa_Estudio' => $id_etapa_estudio);
            $this->session->set_userdata($data);
            $this->_load_layout('Front/Formulacion_Evaluacion/frmEntregable');
        }

    }

/*    public function GetEntregable()
{
if ($this->input->is_ajax_request()) {
$id_etapa_estudio = $this->session->userdata('Etapa_Estudio');

$datos = $this->Gant_Model->GetEntregable($id_etapa_estudio);
echo json_encode($datos);
} else {
show_404();
}
}*/

    //OPERACIONES CON LOS AVANCES
    public function MostrarAvance()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_etapa_estudio = $this->session->userdata('Etapa_Estudio');
            $datos                = $this->Model_FEentregableEstudio->get_Entregables($txt_id_etapa_estudio);
            echo json_encode($datos);
        } else {
            show_404();
        }

    }
    //FIN OPERACIONES CON LOS AVANCES
    public function get_Entregables()
    {
        if ($this->input->is_ajax_request())
        {
            $id_etapaestudio = $this->session->userdata('Etapa_Estudio');
            $this->session->unset_tempdata('Codigo_único');
            $this->session->unset_tempdata('NombreEstudio');
            $nombre=$this->Model_FEentregableEstudio->get_NombreEtapaEstudio($id_etapaestudio);
            foreach ($nombre as $nombre )
            {
                $Codigo_único = $nombre['codigo_unico_est_inv'];
                $NombreEstudio = $nombre['nombre_est_inv'];
            }
            $data = array('NombreEstudio' =>$NombreEstudio,'Codigo_único'=>$Codigo_único);
            $this->session->set_userdata($data);
            $txt_id_etapa_estudio=$this->session->userdata('Etapa_Estudio');
            $datos= $this->Model_FEentregableEstudio->get_Entregables($txt_id_etapa_estudio);

            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }

    public function Add_Entregable()
    {
        if ($this->input->is_ajax_request()) {
            $opcion                  = "c";
            $id_entregable           = "0";
            $txt_denominacion_entre  = $this->input->post("txt_denominacion_entre");
            $id_etapa_estudio        = $this->session->userdata('Etapa_Estudio');
            $txt_nombre_entre        = $this->input->post("txt_nombre_entre");
            $txt_valoracion_entre    = $this->input->post("txt_valoracion_entre");
            $txt_avance_entre        = 0;
            $txt_observacio_entre    = $this->input->post("txt_observacio_entre");
            $txt_levantamintoO_entre = $this->input->post("txt_levantamintoO_entre");


             $data = $this->Model_FEentregableEstudio->Add_Entregable($opcion, $id_entregable, $txt_denominacion_entre, $id_etapa_estudio, $txt_nombre_entre, $txt_valoracion_entre, $txt_avance_entre, $txt_observacio_entre, $txt_levantamintoO_entre);
             echo json_encode("SE REGISTRO CORRECTAMENTE EL ENTREGABLE");
        } else {
            show_404();
        }
    }
    public function editar_Entregable()
    {
        if ($this->input->is_ajax_request()) {
            $id_entregable              = $this->input->post("IdEntregable");
            $Editxt_nombre_entre        = $this->input->post("Editxt_nombre_entre");
            $Editxt_denoMultiple        = $this->input->post("Editxt_denoMultiple");
            $Editxt_valoracion_entre    = $this->input->post("Editxt_valoracion_entre");

            $txt_id_etapa_estudio = $this->session->userdata('Etapa_Estudio');
            $listarSumaEntregables=$this->Model_FEentregableEstudio->sumaValorizaEntregebleValidar($txt_id_etapa_estudio,$id_entregable);
            $SumaEntregable=0;
            foreach ($listarSumaEntregables as $itemp)
            {
                $SumaEntregable=$SumaEntregable+(int)$itemp->valoracion;
            }
            $totalValidar=$SumaEntregable + $Editxt_valoracion_entre;
            if($totalValidar<=100)
            {
                $data = $this->Model_FEentregableEstudio->editar_Entregable($id_entregable,$Editxt_nombre_entre,$Editxt_denoMultiple,$Editxt_valoracion_entre);
                echo json_encode("Se actualizo la valoracion  del entregable");
            }else
            {
                echo json_encode("No es posible actualizar la valoración  del entregable");
            }


        } else {
            show_404();
        }
    }
    public function UpdateEntregableAvance()
    {
        if ($this->input->is_ajax_request()) {
            $sumaTotalAvance = $this->input->post("sumaTotalAvance");
            $id_entregable   = $this->input->post("id_entregable");
            if ($this->Model_FEentregableEstudio->UpdateEntregableAvance($sumaTotalAvance, $id_entregable) == false) {
                echo "SE ACTUALIZO EL AVANCE DEL ENTREGABLE";
            } else {
                echo "SE ACTUALIZO EL AVANCE DEL ENTREGABLE";
            }

        } else {
            show_404();
        }
    }
    //verificcion de porcentajes del entregable
    //
    //
    public function get_entregableId()
    {
        if ($this->input->is_ajax_request()) {
            $id_entregable = $this->input->post("id_entregable");
            $datos         = $this->Model_FEentregableEstudio->get_entregableId($id_entregable);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    public function calcular_AvaceFisico()
    {
        if ($this->input->is_ajax_request()) {
            $id_etapa_estudio = $this->input->post("id_etapa_estudio");
            if ($this->Model_FEentregableEstudio->calcular_AvaceFisico($id_etapa_estudio) == true) {
                echo "SE ACTUALIZO SU EL AVANCE FÍSICO";
            } else {
                echo "SE ACTUALIZO SU AVANCE FÍSICO";
            }

        } else {
            show_404();
        }
    }

    //asignacion de personal ala entregable
    public function AsignacionPersonalEntregable()
    {
        if ($this->input->is_ajax_request()) {
            $Opcion                     = 'C';
            $txt_idPersona              = $this->input->post("txt_idPersona");
            $txt_identregable           = $this->input->post("txt_identregable");
            $txt_AsigPersonalEntregable = $this->input->post("txt_AsigPersonalEntregable"); //fecha de asiganacion al qnetregable
            $data                       = $this->Model_FEentregableEstudio->AsignacionPersonalEntregable($Opcion, $txt_identregable, $txt_idPersona, $txt_AsigPersonalEntregable);
            echo json_encode($data);
        } else {
            show_404();
        }

    }

    public function get_ResponsableEntregableE()
    {
        if ($this->input->is_ajax_request()) {
            $id_etapa_estudio = $this->session->userdata('Etapa_Estudio');
            $id_entregable    = $this->input->post("id_entregable");
            $datos            = $this->Model_FEentregableEstudio->get_ResponsableEntregableE($id_entregable, $id_etapa_estudio);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //fin
    //Generar entregables gantt
    public function get_gantt()
    {
        if ($this->input->is_ajax_request()) {
            $id_entregable = $this->input->post("id_entregable");
            $datos         = $this->Model_FEentregableEstudio->get_gantt($id_entregable);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //fin generar entregables con gantt

    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
