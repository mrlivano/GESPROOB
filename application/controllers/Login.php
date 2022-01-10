<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
  	public function __construct()
    {
        parent::__construct();
        $this->load->model("Login_model");
        $this->load->model("Model_UsuarioControl");
        $this->load->model("Model_Usuario");
        $this->load->model("Model_Control");
        $this->load->model("Model_UnidadE");
        $this->load->helper('FormatNumber_helper');
  	}

    public function muestralog()
    {

        if($this->session->userdata('nombreUsuario'))
        {
            redirect('Inicio');
        }
        else
        {
           $this->singin();
        }
    }

    public function singin()
    {
        $this->load->view('front/usuario/frm_login');
    }

    public function recuperarMenu($usuario)
    {
        if($this->input->is_ajax_request())
        {

            $Datos=$this->Login_model->recuperarMenu($usuario);
            echo json_encode($Datos);
        }
        else
        {
            show_404();
        }
    }

    public function ingresar()
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );

        $form_response=$this->input->post('g-recaptcha-response');
        $url="https://www.google.com/recaptcha/api/siteverify";
        $secretkey="6LcA-jkUAAAAAEw9rvEb_J_H15v_fWTo0pDPLTBi";

        $response=file_get_contents($url."?secret=".$secretkey.
        "&response=".$form_response."&remoteip=".$_SERVER["REMOTE_ADDR"], false, stream_context_create($arrContextOptions));

        $data = json_decode($response);

        $usuario = $this->input->post('txtUsuario');
        $password = sha1($this->input->post('txtPassword'));
        $query = $this->Login_model->login($usuario, $password);
        if($query->num_rows() > 0)
        {
            $usuario = $query->row();

            $controlUsuario=$this->Model_UsuarioControl->getControlPorUsuario($usuario->id_persona);
            if($controlUsuario[0]->periodo==0)
            {
                $this->CrearSesion($usuario,'libre');
            }
            else
            {
                $diaAcceso=date('d');
                if($controlUsuario[0]->desde=='' && $controlUsuario[0]->hasta=='')
                {
                    $controlAcceso=$this->Model_Control->verificarControlPorAnio(date('Y'));
                    if($diaAcceso>=$controlAcceso[0]->fecha_inicio && $diaAcceso<=$controlAcceso[0]->fecha_final)
                    {
                        $this->CrearSesion($usuario,'libre');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'No tiene acceso al sistema para esta fecha');
                        $this->muestralog();
                    }
                }
                else
                {
                    $hora=date('H:i');
                    if($diaAcceso>=$controlUsuario[0]->desde && $diaAcceso<=$controlUsuario[0]->hasta)
                    {
                        if($controlUsuario[0]->hora_acceso=='')
                        {
                            $this->CrearSesion($usuario,'libre');
                        }
                        else
                        {
                            $diaHoraAcceso=date('d H:i');
                            $diaMaximo=$controlUsuario[0]->hasta;
                            $hora_acceso=$controlUsuario[0]->hora_acceso;

                            $hora_acceso=$diaMaximo.' '.$hora_acceso;

                            if($diaHoraAcceso>$hora_acceso)
                            {
                                $this->session->set_flashdata('error', 'No tiene acceso al sistema para esta fecha');
                                $this->muestralog();
                            }
                            else
                            {
                                $this->CrearSesion($usuario,$hora_acceso);
                            }
                        }
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'No tiene acceso al sistema para esta fecha');
                        $this->muestralog();
                    }
                }
            }

        }
        else
        {
            $this->session->set_flashdata('error', 'Usuario y/o Contraseña Incorrrecto');
            $this->muestralog();
        }
    }

    public function logout()
    {
        $datosSession = array('nombreUsuario' => '',
                              'idUsuario' => '',
                              'idPersona' => '',
                              'tipoUsuario' => '',
                              'tipo_acceso' => '',
                              'desc_usuario_tipo'=>'',
                              'cod_usuario_tipo'=>'',
                              'horario_permitido'=>'',
                              'idUnidadEjecutora'=>'',
                              'UnidadEjecutora'=>'',
                              'codigoUE'=>''
                              );
        $this->session->set_userdata($datosSession);
        $this->session->sess_destroy();
        redirect('Login/muestralog');
    }

    private function CrearSesion($usuario,$AccesoMaximoPermitido)
    {
        $usuarioue=$this->Model_Usuario->getUsuarioUE($usuario->id_persona);
        $idUnidadEjecutora=$usuarioue->id_ue;
        $unidadEjecutora=$this->Model_UnidadE->UnidadEjecutoraId($usuarioue->id_ue);
        $datosSession = array('nombreUsuario' => $usuario->usuario,
                              'nombrePersona' => $usuario->nombres." ".$usuario->apellido_p." ".$usuario->apellido_m,
                              'idUsuario' =>'',
                              'idPersona' => $usuario->id_persona,
                              'tipoUsuario' => $usuario->id_usuario_tipo,
                              'tipo_acceso' => $usuario->tipo_acceso,
                              'desc_usuario_tipo' => $usuario->desc_usuario_tipo,
                              'cod_usuario_tipo' => $usuario->cod_usuario_tipo,
                              'horario_permitido'=>$AccesoMaximoPermitido,
                              'idUnidadEjecutora'=>$idUnidadEjecutora,
                              'UnidadEjecutora'=>$unidadEjecutora->nombre_ue,
                              'codigoUE'=>$unidadEjecutora->codigo_ue,
                              );
        $this->session->set_userdata($datosSession);
        $c_data['id_persona']=$usuario->id_persona;
        $c_data['fecha_acceso']=date('Y-m-d h:i:s');
        $registroAcceso=$this->Login_model->RegistrarAcceso($c_data);
        $result = $this->Login_model->recuperarMenu($usuario->id_persona);
        $this->session->set_userdata('menuUsuario',$result);
        $result = $this->Login_model->recuperarMenu(0);
        $this->session->set_userdata('menu',$result);
        redirect('Inicio');
    }
}
