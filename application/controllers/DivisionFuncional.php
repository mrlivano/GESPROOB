<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DivisionFuncional extends CI_Controller
{
	public function __construct()
    {
      parent::__construct();
      $this->load->model('Model_DivisionFuncional');
      $this->load->helper('FormatNumber_helper');
	}


    public function index()
    {
		$id_ue = $this->session->userdata('idUnidadEjecutora');
        $listaPipDivisionFuncional=$this->Model_DivisionFuncional->DivisionFuncionalPipListar($id_ue);
        $listaMontoTotalGrupoDivFunc=$this->Model_DivisionFuncional->DivFuncionalPipMontoTotalListar($id_ue);
        $this->load->view('layout/Reportes/header');
        $this->load->view('front/Reporte/DivisionFuncional/index',['listaPipDivisionFuncional'=>$listaPipDivisionFuncional,'listaMontoTotalGrupoDivFunc'=>$listaMontoTotalGrupoDivFunc]);
        $this->load->view('layout/Reportes/footer');
    }


	function GetDivisionFuncional()
	{
		if ($this->input->is_ajax_request())
		{
			$datos=$this->Model_DivisionFuncional->GetDivisionFuncional();

			echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}

    function GetDivisionFuncionalId()
    {
        if ($this->input->is_ajax_request())
        {
            $id_funcion=$this->input->post('id_funcion');
            $datos=$this->Model_DivisionFuncional->DivisionFuncionalPorFuncion($id_funcion);
            echo json_encode($datos);exit;
        }
        else
        {
          show_404();
        }

    }
    function AddDivisionFucion()
    {
        if ($this->input->is_ajax_request())
        {
            $txt_CodigoDfuncional =$this->input->post("txt_CodigoDfuncional");
            $txt_Nombre_DFuncional =$this->input->post("txt_Nombre_DFuncional");
            $listaFuncionC=$this->input->post("listaFuncionC");
            $duplicado = $this->Model_DivisionFuncional->divFuncionalDuplicado($txt_CodigoDfuncional);
            if ($duplicado)
            {
                echo "1";exit;
			}
            else
            {
                $this->Model_DivisionFuncional->AddDivisionFucion($txt_CodigoDfuncional,$txt_Nombre_DFuncional,$listaFuncionC);
				echo "0";exit;
			}
        }
        else
        {
            show_404();
        }
    }

    function UpdateDivisionFucion()
    {
       if ($this->input->is_ajax_request())
              {
                $id_DfuncionalM =$this->input->post("id_DfuncionalM");
                $IdlistaFuncionCM =$this->input->post("listaFuncionCM");
                $txt_CodigoDfuncionalM =$this->input->post("txt_CodigoDfuncionalM");
                $txt_Nombre_DFuncionalM=$this->input->post("txt_Nombre_DFuncionalM");

                $this->Model_DivisionFuncional->UpdateDivisionFucion($id_DfuncionalM,$IdlistaFuncionCM,$txt_CodigoDfuncionalM,$txt_Nombre_DFuncionalM);
                  echo "Se actualizo  una division funcional";
             }
             else
              {
                  show_404();
              }

    }
    function EliminarDivisionFunc(){
        if ($this->input->is_ajax_request())
        {
            $msg=array();
            $c=count($this->Model_DivisionFuncional->verificarDivisionFuncional($this->input->post("id_div_funcional")));
            if($c>0)
            {
                $msg=(['proceso' => 'Error', 'mensaje' => 'Esta division funcional esta relacionada a un grupo funcional, no puede ser eliminada']);
                $this->load->view('front/json/json_view', ['datos' => $msg]);
                return;
            }
            $q1 = $this->Model_DivisionFuncional->EliminarDivFuncional($this->input->post("id_div_funcional"));
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
