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

          $c_data['id_oficina'] = $this->input->post("Cbx_Oficina");
          $c_data['nombres']= strtoupper($this->input->post("txt_nombrepersonal"));
          $c_data['apellido_p'] = strtoupper($this->input->post("txt_apellidopaterno"));
          $c_data['apellido_m'] = strtoupper($this->input->post("txt_apellidomaterno"));
          $c_data['dni']= $this->input->post("txt_dni");
          $c_data['direccion'] = $this->input->post("txt_direccion");
          $c_data['telefonos'] = $this->input->post("txt_telefono");
          $c_data['correo']= $this->input->post("txt_correo");
          $c_data['grado_academico'] = $this->input->post("txt_gradoacademico");
          $c_data['id_esp'] = $this->input->post("Cbx_especialidad");

          $q1 = $this->Model_Persona_Juridica->addPersona($c_data);

          $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
          $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }

    }

    function verifyPersonalByDNI()
  	{
      $dni = $this->input->post('dni');
  		$data = count($this->Model_Persona_Juridica->verifyPersonalByDNI($dni));
  		echo json_encode(['cantidad'=>$data]);exit;
  	}

    public function UpdatePersonal()
    {
        if ($this->input->is_ajax_request())
        {
            $c_data['id_oficina'] = $this->input->post("Cbx_OficinaModificar");
            $c_data['nombres']= $this->input->post("txt_nombrepersonalm");
            $c_data['apellido_p'] = $this->input->post("txt_apellidopaternom");
            $c_data['apellido_m'] =  $this->input->post("txt_apellidomaternom");
            $c_data['dni']= $this->input->post("txt_dnim");
            $c_data['direccion'] = $this->input->post("txt_direccionm");
            $c_data['telefonos'] = $this->input->post("txt_telefonom");
            $c_data['correo']= $this->input->post("txt_correom");
            $c_data['grado_academico'] = $this->input->post("txt_gradoacademicom");
            $c_data['id_esp'] = $this->input->post("txtEspecialidadm");
            $msg = array();

            $q1 = $this->Model_Persona_Juridica->UpdatePersonal($c_data,$this->input->post("txt_idpersonam"));

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
            $id_persona = $this->input->post("id_persona");

        if($this->Model_Persona_Juridica->EliminarPersonal($id_persona)==true){
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
