<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Persona_Juridica extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Persona_Juridica');
    }

    public function index()
    {
        $this->_load_layout('Front/Administracion/frmPersonal');
    }

    public function GetPersonal()
    {
        if($this->input->is_ajax_request())
        {
            $skip=$this->input->post('start');
            $numberRow=$this->input->post('length');
            $valueSearch=$this->input->post('search[value]');

            $datos=$this->Model_Persona_Juridica->GetPersonal('R', $skip, $numberRow, $valueSearch);
            foreach ($datos as $key => $value)
            {
                $value->razon_social=strtoupper($value->razon_social);
            }

            $cantidadDatos=$this->Model_Persona_Juridica->CountPersonalParaPaginacion('X', $valueSearch);

            echo '{ "recordsTotal" : '.$cantidadDatos[0]->cantidad.', "recordsFiltered" : '.$cantidadDatos[0]->cantidad.', "data" : '.json_encode($datos).' }';
        }
        else
        {
            show_404();
        }
    }    

    public function ListarPersonal()
    {
        if($this->input->is_ajax_request())
        {

            $Datos=$this->Model_Persona_Juridica->ListarPersonalUsuario();
            echo json_encode($Datos);
        }
        else
        {
            show_404();
        }
    }

    public function getcargo()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Cargo_Modal->getcargo();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }

    public function EliminarCargo()
    {
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_cargo = $this->input->post("id_cargo");

        if($this->Cargo_Modal->EliminarCargo($id_cargo)==true){
                $flag=0;
                $msg="registro Eliminado Satisfactoriamente";
            }
            else{
                $flag=1;
                $msg="No se pudo eliminar";
            }
                    $datos['flag']=$flag;
                    $datos['msg']=$msg;
                    echo json_encode($datos);
        }  else {
            show_404();
        }

    }

    public function addcargo()
    {
        if ($this->input->is_ajax_request()) {
            $flat            = "C";
            $idcargo         = "0";
            $txt_nombrecargo = $this->input->post("txt_nombrecargo");
            $this->Cargo_Modal->addcargo($flat, $idcargo, $txt_nombrecargo);
        } else {
            show_404();
        }
    }

    public function updatecargo()
    {
        if ($this->input->is_ajax_request()) {
            $flat              = "U";
            $txt_idcargo_m     = $this->input->post("txt_idcargo_m");
            $txt_nombrecargo_m = $this->input->post("txt_nombrecargo_m");
            if ($this->Cargo_Modal->updatecargo($flat, $txt_idcargo_m, $txt_nombrecargo_m) == false) {
                echo "1";
            } else {
                echo "2";
            }
        } else {
            show_404();
        }
    }

    public function AddPersonal()
    {
        if ($this->input->is_ajax_request())
        {
          $msg = array();

          $c_data['razon_social']= strtoupper($this->input->post("txt_razon_social"));
          $c_data['representante_legal'] = strtoupper($this->input->post("txt_representante_legal"));
          $c_data['ruc']= $this->input->post("txt_ruc");
          $c_data['direccion'] = $this->input->post("txt_direccionR");
          $c_data['telefono'] = $this->input->post("txt_telefonoR");
          $c_data['correo']= $this->input->post("txt_correoR");

          $q1 = $this->Model_Persona_Juridica->addPersona($c_data);

          $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
          $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }

    }

    function verifyPersonalByRUC()
  	{
      $ruc = $this->input->post('ruc');
  		$data = count($this->Model_Persona_Juridica->verifyPersonalByRUC($ruc));
  		echo json_encode(['cantidad'=>$data]);exit;
  	}

    public function UpdatePersonal()
    {
        if ($this->input->is_ajax_request())
        {
            $c_data['razon_social']= $this->input->post("txt_razon_socialm");
            $c_data['representante_legal'] = $this->input->post("txt_representante_legalm");
            $c_data['ruc']= $this->input->post("txt_rucm");
            $c_data['direccion'] = $this->input->post("txt_direccionRm");
            $c_data['telefono'] = $this->input->post("txt_telefonoRm");
            $c_data['correo']= $this->input->post("txt_correoRm");
            $msg = array();

            $q1 = $this->Model_Persona_Juridica->UpdatePersonal($c_data,$this->input->post("txt_idpersonamR"));

            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);

        }
        else
        {
            show_404();
        }

    }
    public function EliminarPersonal()
    {
        if ($this->input->is_ajax_request()) {
            $flag=0;
            $msg="";
            $id_persona_juridica = $this->input->post("id_persona_juridica");

        if($this->Model_Persona_Juridica->EliminarPersonal($id_persona_juridica)==true){
                $flag=0;
                $msg="registro Eliminado Satisfactoriamente";
            }
            else{
                $flag=1;
                $msg="No se pudo eliminar";
            }
                    $datos['flag']=$flag;
                    $datos['msg']=$msg;
                    echo json_encode($datos);
        }  else {
            show_404();
        }

    }

    /*fin Personal*/
    public function BuscarPersonaCargo()
    {
        if ($this->input->is_ajax_request()) {
            $text_buscarPersona = 'Formulador';
            $skip=$this->input->post('start');
            $numberRow=$this->input->post('length');
            $valueSearch=$this->input->post('search[value]');

            $datos = $this->Model_Persona_Juridica->BuscarPersonaCargo($text_buscarPersona,$skip,$numberRow,$valueSearch);
            $CantidadData=$this->Model_Persona_Juridica->CountPaginacionPersonaCargo($text_buscarPersona,$skip,$numberRow,$valueSearch);
            echo '{ "recordsTotal" : '.$CantidadData[0]->cantidad.', "recordsFiltered" : '.$CantidadData[0]->cantidad.', "data" : '.json_encode($datos).' }';
        } else {
            show_404();
        }

    }
/* Personal para actividad*/
    public function BuscarPersonaActividad()
    {
        if ($this->input->is_ajax_request()) {
            $skip        =$this->input->post('start');
            $numberRow   =$this->input->post('length');
            $valueSearch =$this->input->post('search[value]');
            $datos        = $this->Model_Persona_Juridica->BuscarPersonaActividad($skip, $numberRow, $valueSearch);
            $CantidadData = $this->Model_Persona_Juridica->CountPaginacionPersonaActividad($skip, $numberRow, $valueSearch);
            echo '{ "recordsTotal" : '.$CantidadData[0]->cantidad.', "recordsFiltered" : '.$CantidadData[0]->cantidad.', "data" : '.json_encode($datos).' }';

        } else {
            show_404();
        }

    }

    public function GetEspecilidad()
    {
        if ($this->input->is_ajax_request()) {
            $datos = $this->Model_Persona_Juridica->GetEspecilidad();
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
/* fin Personal actividad*/

    public function _load_layout($template)
    {
        $this->load->view('layout/ADMINISTRACION/header');
        $this->load->view($template);
        $this->load->view('layout/ADMINISTRACION/footer');
    }

    //cargo
    //-----------------------------------------------------------------------------------------------------------

}
