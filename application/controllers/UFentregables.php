<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UFentregables extends CI_Controller {/* Mantenimiento de sector entidad Y servicio publico asociado*/

	public function __construct(){
      parent::__construct();
      $this->load->model('Modelo_UF_ModuloEntregable');
      $this->load->model('Model_UF_Req_Personal_Estudio');


	}

    public function inicio($estudio_inv)
    {
      
      $listarEntregable=$this->Modelo_UF_ModuloEntregable->LitsraEntregable($estudio_inv);
      $MostrarNombreEstudio=$this->Model_UF_Req_Personal_Estudio->listaIndependienteEstudio($estudio_inv);

      $this->load->view('layout/Formulacion_Evaluacion/UFentregableEstudio/header');
      $this->load->view('front/Formulacion_Evaluacion/UfModuloEntregable/inicio' , ['listarEntregable' =>  $listarEntregable , 'MostrarNombreEstudio' => $MostrarNombreEstudio]);
      $this->load->view('layout/Formulacion_Evaluacion/UFentregableEstudio/footer');
    }

    function _load_layout($template)
    {
      $this->load->view('layout/PMI/header');
      $this->load->view($template);
      $this->load->view('layout/PMI/footer');
    }

}
