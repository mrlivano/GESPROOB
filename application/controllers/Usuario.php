<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Model_Usuario');
		$this->load->model('Model_Personal');
		$this->load->model('Model_Control');
		$this->load->model('Model_UsuarioControl');
		$this->load->model('Model_UnidadE');
		$this->load->model("Login_model");
		$this->load->model('bancoproyectos_modal');
		$this->load->model('UsuarioProyecto_model');
	}
	function ListarTipoUsuarioMenu($tipo)
	{
        $datos = $this->Model_Usuario->ListarTipoUsuarioMenu($tipo);
        echo json_encode($datos);
	}
	function ListarTipoUsuario()
	{
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Model_Usuario->ListarTipoUsuario();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
	}
	function addTipoUsuario()
	{
		if ($this->input->is_ajax_request())
		{
			$cod_usuario_tipo = $this->input->post("txt_codUsuarioTipo");
			$desc_usuario_tipo = $this->input->post("txt_descUsuarioTipo");
			$datos = $this->Model_Usuario->addTipoUsuario($cod_usuario_tipo,$desc_usuario_tipo);
			if($datos)
			{
				echo "1";
			}
		}
		else
		{
				show_404();
		}
	}
	function updateTipoUsuario()
	{
		if ($this->input->is_ajax_request())
		{
			$id_usuario_tipo = $this->input->post("txt_idUsuarioTipo");
			$cod_usuario_tipo = $this->input->post("txt_codUsuarioTipo");
			$desc_usuario_tipo = $this->input->post("txt_descUsuarioTipo");
			$datos = $this->Model_Usuario->updateTipoUsuario($id_usuario_tipo,$cod_usuario_tipo,$desc_usuario_tipo);
			echo json_encode($datos);
		}
		else
		{
				show_404();
		}
	}
	function deleteTipoUsuario()
	{
		if ($this->input->is_ajax_request()) {
				$flag=0;
				$msg="";
				$id_usuario_tipo = $this->input->post("id_usuario_tipo");

				if($this->Model_Usuario->deleteTipoUsuario($id_usuario_tipo)==true){
						$flag=1;
						$msg="registro Eliminado Satisfactoriamente";
				}
				else{
						$flag=0;
						$msg="No se pudo eliminar";
				}
								$datos['flag']=$flag;
								$datos['msg']=$msg;
								echo json_encode($datos);
		}  else {
				show_404();
		}

	}

	function ListarUnidadEjecutora()
	{
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Model_UnidadE->getUnidadEjecutoraOpciones();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
	}
	function GetUsuario()
	{
        if ($this->input->is_ajax_request())
        {
            $datos = $this->Model_Usuario->GetUsuario();
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
	}

	function AddUsuario()
	{
	    if ($this->input->is_ajax_request())
	    {
	      	$id_persona=$this->input->post("comboPersona");
	      	$txt_usuario =$this->input->post("txt_usuario");
	      	$txt_contrasenia =sha1($this->input->post("txt_contrasenia"));
	      	$cbb_TipoUsuario =$this->input->post("cbb_TipoUsuario");
	     		$cbb_listaMenuDestino =$this->input->post("cbb_listaMenuDestino");
	     		$tipoAcceso=$this->input->post('radioTipoAcceso');

					$cbb_UnidadEjecutora =$this->input->post("cbb_UnidadEjecutora");
					$currentDate = date('Y-m-d H:i:s');

	     		$data = $this->Model_Usuario->AddUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino,$tipoAcceso);
					$this->Model_Usuario->UsuarioUE($currentDate, $id_persona, $cbb_UnidadEjecutora);

	     		$bitPeriodo = ($this->input->post('checkPeriodo')=='on'? 1:0);
					$periodo=$this->Model_Control->verificarControlPorAnio(date('Y'));

	        $u_data['desde'] = NULL;
            $u_data['hasta'] = NULL;
            $u_data['periodo'] = $bitPeriodo;
            $u_data['id_persona'] = $id_persona;
            $u_data['id_control_acceso'] = $periodo[0]->id_control_acceso;

            $this->Model_UsuarioControl->insertar($u_data);

	      	if($data==true)
		       	echo "Se añadio un nuevo usuario";
		  	else
		       	echo "Error... no se grabaron los datos del Usuario.";
		}
	    else
	    {
	    	show_404();
	    }
 	}

 	function editUsuario()
 	{
	    if ($this->input->is_ajax_request())
	    {
	      	$id_persona=$this->input->post("comboPersona");
	      	$txt_usuario =$this->input->post("txt_usuario_e");
	      	if($this->input->post("txt_contrasenia")!='')
	      		$txt_contrasenia =sha1($this->input->post("txt_contrasenia"));
	      	else
	      		$txt_contrasenia='';
	      	$cbb_TipoUsuario =$this->input->post("cbb_TipoUsuario");
	      	$cbb_listaMenuDestino =$this->input->post("cbb_listaMenuDestino");
	      	$cbb_estado =$this->input->post("cbb_estado");
	      	$tipoAcceso=$this->input->post('radioTipoAcceso');

					$cbb_UnidadEjecutora =$this->input->post("cbb_UnidadEjecutora");
					$currentDate = date('Y-m-d H:i:s');

	      	$data=$this->Model_Usuario->editUsuario($id_persona,$txt_usuario,$txt_contrasenia,$cbb_TipoUsuario,$cbb_listaMenuDestino,$cbb_estado,$tipoAcceso);
					$this->Model_Usuario->UsuarioUE_Update($currentDate, $id_persona, $cbb_UnidadEjecutora);

	      	$bitPeriodo = ($this->input->post('checkPeriodo')=='on'? 1:0);
			$periodo=$this->Model_Control->verificarControlPorAnio(date('Y'));
	        $u_data['desde'] = NULL;
            $u_data['hasta'] = NULL;
            $u_data['periodo'] = $bitPeriodo;
            $u_data['id_control_acceso'] = $periodo[0]->id_control_acceso;

	      	$controlPersona=$this->Model_UsuarioControl->getControlPorUsuario($id_persona);
	      	if(count($controlPersona)>0)
	      	{
	      		$this->Model_UsuarioControl->editar($u_data,$id_persona);
	      	}
	      	else
	      	{
	      		$u_data['id_persona'] = $id_persona;
	      		$this->Model_UsuarioControl->insertar($u_data);
	      	}

	      	if($data == true)
		       	echo "Se modificó el usuario";
			else
			    echo "Error... no se grabaron los datos del Usuario.";
		}
	    else
	    {
	    	show_404();
	    }
 	}

	function editUsuarioProyecto() {
		if ($this->input->is_ajax_request()) {

			$id_persona =$this->input->post("id_persona");

			$id_pi =$this->input->post("cbb_listaMenuDestino");

			$this->Model_Usuario->editUsuarioProyecto($id_persona,$id_pi);
		}	else {
			show_404();
		}
	}


	public function index()
	{
		$listaUsuarios = $this->Model_Usuario->listaUsuario();
		foreach ($listaUsuarios as $key => $value)
		{
			$value->nombres=strtoupper($value->nombres);
            $value->apellido_p=strtoupper($value->apellido_p);
            $value->apellido_m=strtoupper($value->apellido_m);
		}
		$this->load->view('layout/USUARIO/header');
	      	$this->load->view('Front/Usuario/frm_usuario',['listaUsuario'=>$listaUsuarios]);
      	$this->load->view('layout/USUARIO/footer');
	}

	public function Proyectos()
	{
		$data = $this->bancoproyectos_modal->getBancoProyecto();
		$listaUsuarios = $this->Model_Usuario->listaUsuario();
		foreach ($listaUsuarios as $key => $value)
		{
			$value->nombres=strtoupper($value->nombres);
            $value->apellido_p=strtoupper($value->apellido_p);
            $value->apellido_m=strtoupper($value->apellido_m);
		}

		$this->load->view('layout/USUARIO/header');
		$this->load->view('Front/Usuario/proyecto_usuario',['lista'=>$data,'listaUsuario'=>$listaUsuarios]);
		$this->load->view('layout/USUARIO/footer');
	}

	function _load_layout($template)
    {
      $this->load->view('layout/USUARIO/header');
      $this->load->view($template);
      $this->load->view('layout/USUARIO/footer');
    }
    function itemUsuario()
    {
    	if($this->input->get('id_persona')!='')
    	{
    		$data['periodo']=0;
    		$persona=$this->Model_UsuarioControl->getControlPorUsuario($this->input->get('id_persona'));
    		if(count($persona)>0)
    		{
    			$data['periodo']=$persona[0]->periodo;
    		}
    		$data['arrayUsuario']=$this->Model_Usuario->getUsuario($this->input->get('id_persona'))[0];
    		$this->load->view('Front/Usuario/itemUsuario',$data);
    	}
    	else
    	{
			$this->load->view('Front/Usuario/itemUsuario');
    	}

	}
	function asignarProyecto()
	{
		if($this->input->get('id_persona')!='')
		{

			$data = $this->bancoproyectos_modal->getBancoProyecto();

			$usuario=$this->Model_Usuario->getUsuario($this->input->get('id_persona'))[0];

			$usuario_proyecto = $this->UsuarioProyecto_model->get_usuario_proyecto($this->input->get('id_persona'));
			$this->load->view('Front/Usuario/asignar_proyecto',['lista'=>$data,'usuario'=>$usuario,'usuario_proyecto'=>$usuario_proyecto]);
		}
		else
		{
			show_404();
		}
	}
	function accesodenegado()
	{
		$this->load->view('Front/Usuario/acceso_denegado');
	}
	function listaUrlAsignado()
	{
		$idPersona = $this->input->post('id_persona');
		$data = $this->Model_Usuario->listaUrlAsignado($idPersona);
		echo json_encode($data);
	}
	function listaMenu()
	{
		$data = $this->Model_Usuario->listaModulo();
		foreach ($data as $key => $value)
		{
			$value->childModulo = $this->Model_Usuario->listaSubModulo($value->id_menu);
		}
		echo json_encode($data);
	}

	function cambiarContrasenia()
	{
		if($_POST)
		{
			$msg = array();
			$contraseniaActual=sha1($this->input->post('txtContraseniaActual'));
			$contraseniaNueva=$this->input->post('txtContraseniaNueva');
			$repiteContrasenia=$this->input->post('txtContraseniaRepite');
			if($contraseniaNueva!=$repiteContrasenia)
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'La contraseña nueva y la contraseña que se repite no son las mismas']);exit;
			}
			$query = $this->Login_model->login( $this->session->userdata('nombreUsuario'), $contraseniaActual);
			if($query->num_rows()>0)
			{
				$q1 = $this->Model_Usuario->cambiarContrasenia($this->session->userdata('idPersona'),sha1($contraseniaNueva));
				if($q1>0)
				{
					echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'La contraseña ha sido actualizada correctamente']);exit;
				}
				else
				{
					echo json_encode(['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']);exit;

				}
			}
			else
			{
				echo json_encode(['proceso' => 'Error', 'mensaje' => 'La contraseña es Incorrecta']);exit;

			}

		}
		$this->load->view('Front/Usuario/cambiarcontrasenia');
	}
	function VerificarNombreUsuario()
	{
		$usuario = $this->input->post('username');
		$data = count($this->Model_Usuario->verificarUsername($usuario));
		echo json_encode(['cantidad'=>$data]);exit;
	}

}
