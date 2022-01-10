	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GrupoFuncional extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_GrupoFuncional');
      $this->load->helper('FormatNumber_helper');
	}
    public function index()
    {
		$id_ue = $this->session->userdata('idUnidadEjecutora');
        $listaNumPipGrupo=$this->Model_GrupoFuncional->GrupoPipListar($id_ue);
        $listaMontoTotalGrupoFuncional=$this->Model_GrupoFuncional->GrupoFuncionalPipMontoTotalListar($id_ue);
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/GrupoFuncional/index',['listaNumPipGrupo'=>$listaNumPipGrupo,'listaMontoTotalGrupoFuncional'=>$listaMontoTotalGrupoFuncional]);
        $this->load->view('layout/Reportes/footer');
    }

	function GetGrupoFuncional()
	{
		if($this->input->is_ajax_request())
		{
			$datos=$this->Model_GrupoFuncional->GetGrupoFuncional();

			echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}

    function GetGrupoFuncionalId()
    {
      if ($this->input->is_ajax_request())
        {
            $id_div_funcional=$this->input->post('id_div_funcional');
            $datos=$this->Model_GrupoFuncional->GetGrupoFuncionalId($id_div_funcional);
            echo json_encode($datos);exit;
        }
        else
        {
          show_404();
        }
    }

     function AddGrupoFuncional()
    {
       if ($this->input->is_ajax_request())
              {
                $txt_codigoGfuncion =$this->input->post("txt_codigoGfuncion");
                $txt_nombreGfuncion =$this->input->post("txt_nombreGfuncion");
                $SelecDivisionFF=$this->input->post("SelecDivisionFF");
                $SelecSector=$this->input->post("SelecSector");

								$duplicado = $this->Model_GrupoFuncional->divGFuncionalDuplicado($txt_codigoGfuncion);

								if($duplicado) {
	                echo "1";exit;
								} else {
									$this->Model_GrupoFuncional->AddGrupoFuncional($txt_codigoGfuncion,$txt_nombreGfuncion,$SelecDivisionFF,$SelecSector);
									echo "0";exit;
								}
             }
             else
              {
                  show_404();
              }
    }
    function UpdateGrupoFuncional()
    {
      if ($this->input->is_ajax_request())
              {
                $txt_idGfuncionF =$this->input->post("txt_idGfuncionF");
                $IdSelecDivisionFFF =$this->input->post("SelecDivisionFFF");
                $IdSelecSectorF=$this->input->post("SelecSectorF");
                $txt_codigoGfuncionF=$this->input->post("txt_codigoGfuncionF");
                $txt_nombreGfuncionF=$this->input->post("txt_nombreGfuncionF");

                $this->Model_GrupoFuncional->UpdateGrupoFuncional($txt_idGfuncionF,$IdSelecDivisionFFF,$IdSelecSectorF,$txt_codigoGfuncionF,$txt_nombreGfuncionF);
                  echo "Se  modifico el grupo funcional funcional";
             }
             else
              {
                  show_404();
              }
    }
    function EliminarGFuncional()
    {
        if ($this->input->is_ajax_request())
        {
            $msg=array();
            $c=count($this->Model_GrupoFuncional->verificarGrupoFuncional($this->input->post("id_grup_funcional")));
            if($c>0)
            {
                $msg=(['proceso' => 'Error', 'mensaje' => 'Este grupo funcional esta relacionada a un proyecto, no puede ser eliminado']);
                $this->load->view('front/json/json_view', ['datos' => $msg]);
                return;
            }
            $q1 = $this->Model_GrupoFuncional->EliminarGFuncional($this->input->post("id_grup_funcional"));
            $msg=($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro eliminado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }
    }
	function _load_layout($template)
    {
      $this->load->view('layout/ADMINISTRACION/header');
      $this->load->view($template);
      $this->load->view('layout/ADMINISTRACION/footer');
    }

}
