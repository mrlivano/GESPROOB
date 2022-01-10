<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_Control');
        $this->load->model('Model_UsuarioControl');
        $this->load->model('Login_model');        
    }

    function index()
    {
        $listaControl = $this->Model_Control->getAll();
        $listaUsuarioControl = $this->Model_UsuarioControl->getAll();
        $estadisticaUso = $this->Login_model->estadisticaUso();

        foreach ($listaUsuarioControl as $key => $value) 
        {
            $value->nombres=strtoupper($value->nombres);
            $controlusuario=$this->Model_UsuarioControl->getControlUsuario($value->id_persona);
            if($controlusuario->desde!='')
            {
                $value->fecha_inicio=$controlusuario->desde;            

            }
            if ($controlusuario->hasta!='')
            {
                $value->fecha_final=$controlusuario->hasta;
            }
        }        
        $this->load->view('layout/USUARIO/header');
        $this->load->view('Front/Usuario/ControlAcceso/index',['listaControl'=>$listaControl,'listaUsuarioControl'=>$listaUsuarioControl,'estadisticaUso'=>$estadisticaUso]);
        $this->load->view('layout/USUARIO/footer');
    }

    function insertar()
    {
        if($_POST)
        {
            $msg = array();

            $control=$this->Model_Control->verificarControlPorAnio($this->input->post('txtAnio'));
            if(count($control)>0)
            {
                $msg = (['proceso' => 'Error', 'mensaje' => 'El control de acceso ya fue configurado para este año']);
                echo json_encode($msg);
                exit;
            }

            $c_data['anio']=$this->input->post('txtAnio');
            $c_data['fecha_inicio']=$this->input->post('txtDiaInicio');
            $c_data['fecha_final']=$this->input->post('txtDiaFin');
            
            $data = $this->Model_Control->insertar($c_data);

            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Se configuro correctamente el rango de acceso para este año']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;

        }

        $idControlAcceso=$this->input->get('idControlAcceso');        
        if($idControlAcceso=='')
        {
            $accion='insertar';
            $this->load->view('Front/Usuario/ControlAcceso/insertar',['accion'=>$accion]);
        }
        else
        {
            $accion='editar';
            $controlAcceso=$this->Model_Control->getControlAcceso($idControlAcceso);
            $this->load->view('Front/Usuario/ControlAcceso/insertar',['accion'=>$accion,'controlAcceso'=>$controlAcceso]);
        }        
    }

    function editar()
    {
        if($_POST)
        {
            $c_data['fecha_inicio']=$this->input->post('txtDiaInicio');
            $c_data['fecha_final']=$this->input->post('txtDiaFin');
            
            $data = $this->Model_Control->editar($c_data,$this->input->post('hdIdControlAcceso'));

            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'La configuración de control de acceso fue editada correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;

        }
    }

    function eliminar()
    {
        $msg = array();
        $data = $this->Model_Control->eliminar($this->input->post('idControl'));
        $msg = ($data > 0 ? (['proceso' => 'Correcto', 'mensaje' => 'El registro fue eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
        echo json_encode($msg);exit;
    }

    function editarControlUsuario()
    {
        if($_POST)
        {
            $u_data['desde']=$this->input->post('txtDiaInicio');
            $u_data['hasta']=$this->input->post('txtDiaFin');
            $u_data['hora_acceso']=$this->input->post('txtHoraAcceso');
            
            $data = $this->Model_UsuarioControl->editar($u_data,$this->input->post('hdIdPersona'));

            $msg = ($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'El registro ha sido editado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            echo json_encode($msg);exit;
        }

        $idPersona=$this->input->get('idPersona');
        $controlAcceso=$this->Model_Control->verificarControlPorAnio(date('Y'));
        $controlusuario=$this->Model_UsuarioControl->getControlUsuario($idPersona);
        if($controlusuario->desde=='')
        {
            $controlusuario->desde=$controlAcceso[0]->fecha_inicio;            

        }
        if ($controlusuario->hasta=='')
        {
            $controlusuario->hasta=$controlAcceso[0]->fecha_final;
        }
        $this->load->view('Front/Usuario/ControlAcceso/controlusuario',['controlUsuario'=>$controlusuario]);
    }
}
