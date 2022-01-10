<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AplicativoMovil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Model_Funcion');
        $this->load->model('Model_DashboardPmi');
        $this->load->model('Model_AplicativoMovil');
	}
    
    public function listadoProyectoGrupoFuncional()
    {
       $id_grup_funcional=$this->input->post('id_grup_funcional');
       $listaProyectoGrupoFuncional=$this->Model_AplicativoMovil->listadoProyectoGrupoFuncional($id_grup_funcional);
       $listaTotaProyecto= array();
       foreach ($listaProyectoGrupoFuncional as $key => $Itemp) {
           $listaTotaProyecto[$key]=[$Itemp->nombre_pi.'Codigo<a href="https://www.google.com/">'.$Itemp->latitud.' </a></h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];
        }
       echo json_encode($listaTotaProyecto);
    }
    public function listadoProyectoDivisionFuncional()
    {

        $id_div_funcional=$this->input->post('id_div_funcional');
           $listaProyectoDivisionFuncional=$this->Model_AplicativoMovil->listadoProyectoDivisionFuncional($id_div_funcional);
           $listaTotaProyecto= array();
           foreach ($listaProyectoDivisionFuncional as $key => $Itemp) {

                if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }

            }
           echo json_encode($listaTotaProyecto);
    }

    public function listadoProyectoFuncion()
    {

        $id_funcion=$this->input->post('id_funcion');
           $listaProyectoFuncion=$this->Model_AplicativoMovil->listadoProyectoFuncion($id_funcion);
           $listaTotaProyecto= array();
           foreach ($listaProyectoFuncion as $key => $Itemp) {
              if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }
            }
           echo json_encode($listaTotaProyecto);
    }

    public function listadoNoPipPorTipoNoPip()
    {
    	$id_tipo_nopip=$this->input->post('id_tipo_nopip');
    	$listanopiportiponopip=$this->Model_AplicativoMovil->listaNoPipPorTipoNoPip($id_tipo_nopip);
    	$listaTotaProyecto= array();

           foreach ($listanopiportiponopip as $key => $Itemp) {

              if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }
            }
           echo json_encode($listaTotaProyecto);

    }

    public function index()
    {
        $comboboxfuncion=$this->Model_Funcion->GetFuncion();
        $comboboxtiponopip=$this->Model_AplicativoMovil->listaTipoNoPip();
       // var_dump($comboboxtiponopip);exit;
        $this->load->view('front/Aplicativo_Movil/index',['comboboxfuncion'=>$comboboxfuncion,'comboboxtiponopip'=>$comboboxtiponopip]);
    } 

    public function listaTotalDeUbicacionesProyecto()
    {
        if ($this->input->is_ajax_request()) {
            $listaTotaProyecto= array();
            $datos = $this->Model_AplicativoMovil->listaTotalDeUbicacionesProyecto();
            foreach ($datos as $key => $Itemp) {
                if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }
            
            }
            echo json_encode($listaTotaProyecto);
        } else {
            show_404();
        }
    }

    function  DatosGeneralesdelPip()
    {
        $codigounico=$this->input->POST('codigounico');

        $data=$this->Model_AplicativoMovil->busquedaPorCodigoDatosGeneralesPip($codigounico);
        
            echo json_encode($data);
    }

    function  GraficarPip()
    {
        $codigounico=$this->input->POST('codigounico'); 
        if($codigounico=='')
        {
            $data=$this->Model_AplicativoMovil->listaTotalDeUbicacionesProyecto();
        
           $listaTotaProyecto= array();
           foreach ($data as $key => $Itemp) {

              if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }
            }
           echo json_encode($listaTotaProyecto); 
        }else{

        $data=$this->Model_AplicativoMovil->busquedaPorCodigoMostrarEnMapaPip($codigounico);
        
        $listaTotaProyecto= array();
           foreach ($data as $key => $Itemp) {

              if($Itemp->url_img=='')
                {
                    $url_img='SinImagen.jpg';
                    $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }else{

                     $listaTotaProyecto[$key]=['<strong><center>'.$Itemp->nombre_pi.'</center></strong></br><strong>Codigo:</strong> &nbsp;&nbsp;  '.$Itemp->codigo_unico_pi.' &nbsp;&nbsp;<center><img src='.base_url().'uploads/ImgUbicacionProyecto/'.$Itemp->url_img.'  width="150" height="120"></center> </h6>',$Itemp->latitud,$Itemp->longitud,$Itemp->icono_sector];

                }
            }
           echo json_encode($listaTotaProyecto);  
        }
               
           
    }

    public function Pips()
    {
        $listarpip=$this->Model_AplicativoMovil->listapip();

        $this->load->view('front/Aplicativo_Movil/pip',['listarpip'=>$listarpip]);
    }

}