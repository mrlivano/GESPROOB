<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MFuncion extends CI_Controller {/* Mantenimiento de division funcional y grupo funcional*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Model_Funcion');
	}
    
    /* Pagina principal de la vista entidad Y servicio publico asociado */
	public function index()
	{
		$this->_load_layout('Front/Administracion/frmFuncion');
	}
    /*fin pagina principal de la vista */
    
	/* Funcion*/
	function GetFuncion()
	{
		if($this->input->is_ajax_request()) 
		{
			$datos=$this->Model_Funcion->GetFuncion();

			echo json_encode($datos);
		}
		else
		{
			show_404();
		}
	}

	function AddFucion()
         {
              if ($this->input->is_ajax_request()) 
              {
                $txt_codigofuncion =$this->input->post("txt_codigofuncion");
                $txt_nombrefuncion =$this->input->post("txt_nombrefuncion");
                if($this->Model_Funcion->AddFucion($txt_codigofuncion,$txt_nombrefuncion) == true)
                  echo "Se añadio una funcion";
                else
                  echo "No se añadio  una funcion";  
             }
             else
              {
                  show_404();
              }

       }
        //modifcar funcion

        function UpdateFuncion()
         {
              if ($this->input->is_ajax_request()) 
              {
                $txt_IdfuncionM =$this->input->post("txt_IdfuncionM");
                $txt_codigofuncionM =$this->input->post("txt_codigofuncionM");
                $txt_nombrefuncionM =$this->input->post("txt_nombrefuncionM");

                if($this->Model_Funcion->UpdateFuncion($txt_IdfuncionM,$txt_codigofuncionM,$txt_nombrefuncionM) == true)
                  echo "Se actualizao  la funcion";
                else
                  echo "No se actualizo la  funcion";  
             }
             else
              {
                  show_404();
              }

        }

        //fin modificar funcion

    /*fin FUNCION*/
    
    /* division funcional*/
    function GetDivisionFuncional()
    {
        if ($this->input->is_ajax_request()) 
        {
        $datos=$this->Model_Funcion->GetDivisionFuncional();
        echo json_encode($datos);
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

                if($this->Model_Funcion->AddDivisionFucion($txt_CodigoDfuncional,$txt_Nombre_DFuncional,$listaFuncionC)== true)
                  echo "Se inserto una division funcional";
                else
                  echo "No inserto una division funcional";  
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

                if($this->Model_Funcion->UpdateDivisionFucion($id_DfuncionalM,$IdlistaFuncionCM,$txt_CodigoDfuncionalM,$txt_Nombre_DFuncionalM)== true)
                  echo "Se actualizo  una division funcional";
                else
                  echo "No se actualizo  una division funcional";  
             }
             else
              {
                  show_404();
              }

    }
    function GetGrupoFuncional()
    {
        $valor='';
        if ($this->input->is_ajax_request()) 
        {
        $datos=$this->Model_Funcion->GetGrupoFuncional($valor);
        echo json_encode($datos);
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

                if($this->Model_Funcion->AddGrupoFuncional($txt_codigoGfuncion,$txt_nombreGfuncion,$SelecDivisionFF,$SelecSector)== true)
                  echo "Se inserto un grupo funcional funcional";
                else
                  echo "No inserto un grupo funcional";  
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

                if($this->Model_Funcion->UpdateGrupoFuncional($txt_idGfuncionF,$IdSelecDivisionFFF,$IdSelecSectorF,$txt_codigoGfuncionF,$txt_nombreGfuncionF)== true)
                  echo "Se  modifico el grupo funcional funcional";
                else
                  echo "No no se modifico el grupo funcional";  
             }
             else
              {
                  show_404();
              }
    }
    /*Fin Servicios publico asociado*/
	function _load_layout($template)
    {
      $this->load->view('layout/header');
      $this->load->view($template);
      $this->load->view('layout/footer');
    }

}
