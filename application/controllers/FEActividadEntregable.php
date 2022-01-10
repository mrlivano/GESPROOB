<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FEActividadEntregable extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_FEActividadEntregable');

    }

    public function get_Actividades()
    {
        if ($this->input->is_ajax_request())
        {
            $id_en = $this->input->post('id_en');
            $datos = $this->Model_FEActividadEntregable->get_Actividades($id_en);
            foreach ($datos as $key => $value)
            {
                $value->startEdit=date('m/d/Y',strtotime($value->start));
                $value->endEdit=date('m/d/Y',strtotime($value->end));
            }
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }


    //mostra vance de la actividad
    public function MostrarAvance()
    {
        if ($this->input->is_ajax_request()) {
            $txt_id_entregable = $this->input->post('txt_id_entregable');
            $datos             = $this->Model_FEActividadEntregable->get_Actividades($txt_id_entregable);
            echo json_encode($datos);
        } else {
            show_404();
        }
    }
    //fin mostrar el abance  de la actividad

    public function Add_Actividades()
    {
        if ($this->input->is_ajax_request()) 
        {
            $msg=array();

            $c_data['id_entregable']=$this->input->post("txt_id_entregable");
            $c_data['nombre_act']=$this->input->post("txt_nombre_act");
            $c_data['fecha_inicio']=date('Y-m-d',strtotime($this->input->post("fechaInicio"))); 
            $c_data['fecha_final']=date('Y-m-d',strtotime($this->input->post("fechaFin")));
            $c_data['valoracion']=$this->input->post("txt_valoracionEAc");     
            $c_data['avance']=0;
            $c_data['observacion']=$this->input->post("txt_observacio_EntreAc");
            $c_data['color']=$this->input->post("txt_ActividadColor");

            $q1=$this->Model_FEActividadEntregable->Add_Actividades($c_data);

            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);
        } 
        else 
        {
            show_404();
        }
    }

    public function Update_Actividades()
    {
        if ($this->input->is_ajax_request()) {
            $opcion                  = "u";
            $tx_IdActividad          = $this->input->post("tx_IdActividad");
            $txt_idEntregable        = $this->input->post("txt_idEntregable");
            $txt_NombreActividadAc   = $this->input->post("txt_NombreActividadAc");
            $txtFechaInicio   = $this->input->post("fechaInicioEdit");
            $txtFechaFin   = $this->input->post("fechaFinEdit");
            $txt_valorizacionEAct    = $this->input->post("txt_valorizacionEAct");
            $txt_avanceEAct          = $this->input->post("txt_avanceEAct");
            $txt_observacio_EntreAct = $this->input->post("txt_observacio_EntreAct");
            $txt_ActividadColorAc    = $this->input->post("txt_ActividadColorAc");

            $FechaActividadCalendar    = $this->input->post("FechaActividadCalendar");
            
            if ($this->Model_FEActividadEntregable->Update_Actividades($opcion,$tx_IdActividad,$txt_idEntregable,$txt_NombreActividadAc,$txtFechaInicio,$txtFechaFin,$txt_valorizacionEAct,$txt_avanceEAct,$txt_observacio_EntreAct,$txt_ActividadColorAc) == false) {
                echo "Se actualizo una Actividad ";
            } else {
                echo " Se actualizo una Actividad ";
            }

        } else {
            show_404();
        }
    }
    public function CalcularAvanceActividad()
    {
//calcula el avance de la actividad asociado a un entregable
        if ($this->input->is_ajax_request()) {
            $tx_IdActividad   = $this->input->post("tx_IdActividad");
            $txt_idEntregable = $this->input->post("txt_idEntregable");
            $data             = $this->Model_FEActividadEntregable->CalcularAvanceActividad($tx_IdActividad,$txt_idEntregable);
            echo json_encode($data);

        } else {
            show_404();
        }
    }

    public function VerValoracionRestanteActividad()
    {
      if ($this->input->is_ajax_request()) {
            $id_entregable = $this->input->post('id_entregable');
            $datos             = $this->Model_FEActividadEntregable->VerValoracionRestanteActividad($id_entregable);
            echo json_encode($datos);
        } else {
            show_404();
        }  
    }

    //asignacion de personal
    public function AsignacionPersonalActividad()
    {
        if ($this->input->is_ajax_request()) {
            $Opcion                    = 'C';
            $txt_idActividadCronograma = $this->input->post("txt_idActividadCronograma");
            $txt_idPersonaActividad    = $this->input->post("txt_idPersonaActividad");
            $txt_AsigPersonalActividad = $this->input->post("txt_AsigPersonalActividad"); //fecha de asiganacion del responsable a actividad
            if ($this->Model_FEActividadEntregable->AsignacionPersonalActividad($Opcion,$txt_idActividadCronograma,$txt_idPersonaActividad,$txt_AsigPersonalActividad) == false) {
                echo "SE ASIGNO  UN NUEVO RESPONSABLE A LA ACTIVIDAD ";
            } else {
                echo "NO SE ASIGNO  UN NUEVO RESPONSABLE A LA ACTIVIDAD";
            }

        } else {
            show_404();
        }

    }

    public function ObservacionActividad()
    {
         if ($this->input->is_ajax_request()) 
         {
            
            $tx_IdActividadObser          = $this->input->post('tx_IdActividadObser');
            $txt_desco_obs                = $this->input->post('txt_desco_obs');
            $txt_fechaLevantaminetoObse   = $this->input->post('txt_fechaLevantaminetoObse');
            $NombreUrlObservacion         = $this->input->post('NombreUrlObservacion');
            $nombreArchivo=explode(".",$NombreUrlObservacion);
            $nombreO=(String)$nombreArchivo[0];
            $urlO=(String)$nombreArchivo[1];
            $doc_observacio=$nombreO.''.$tx_IdActividadObser.'.'.$urlO;
            $this->Model_FEActividadEntregable->ObservacionActividad($tx_IdActividadObser,$txt_desco_obs,$txt_fechaLevantaminetoObse,$doc_observacio);            
            $config['upload_path']          = './uploads/DocumentoObservacionAtividad/';
            $config['allowed_types']        = 'pdf|doc|xml|docx|PDF|DOC|DOCX|xls|xlsx';
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['max_size']             = 15000;
            $config['encrypt_name']         = false;
            $config['file_name']            =$doc_observacio;

            $this->load->library('upload',$config);
            echo json_encode(['mensaje'=>'Observación registrada correctamente']);
                                 
         } 
    }
     public function LevantaminetoObservacionActividad()
    {
         if ($this->input->is_ajax_request()) 
         {
            
            $tx_IdActividadObser          = $this->input->post('tx_IdActividadLevantamiento');
            $txt_desco_obs                = $this->input->post('txt_desco_levantamiento');
            $txt_fechaLevantaminetoObse   = $this->input->post('txt_fechaLevantamineto');
            $NombreUrlObservacion         = $this->input->post('NombreUrlObservacionLevantamiento');
            $nombreArchivo=explode(".",$NombreUrlObservacion);
            $nombreO=(String)$nombreArchivo[0];
            $urlO=(String)$nombreArchivo[1];
            $doc_observacio=$nombreO.''.$tx_IdActividadObser.'.'.$urlO;
            $this->Model_FEActividadEntregable->LevantaminetoObservacionActividad($tx_IdActividadObser,$txt_desco_obs,$txt_fechaLevantaminetoObse,$doc_observacio);            
            $config['upload_path']          = './uploads/LevantamientoDocumentoActividad/';
            $config['allowed_types']        = 'pdf|doc|xml|docx|PDF|DOC|DOCX|xls|xlsx';
            $config['max_width']            = 1024;
            $config['max_height']           = 768;
            $config['max_size']             = 15000;
            $config['encrypt_name']         = false;
            $config['file_name']            =$doc_observacio;

            $this->load->library('upload',$config);
            echo json_encode(['mensaje'=>'Observación registrada correctamente']);
                                 
         } 
    }

    public function listadoObservacion()
    {
         if ($this->input->is_ajax_request()) 
         {
           $idActividad=$this->input->Post('idActividad');
           $data=$this->Model_FEActividadEntregable->listadoObservacion($idActividad);
           echo json_encode($data);

                                 
         } 
    }

      public function ActualizarActividadEntregable()
    {
        /*if ($this->input->is_ajax_request()) 
        {
            $tx_idActividadEntregable =$this->input->post("tx_idActividadEntregable");
            $txt_idEntregableEstudio =$this->input->post("txt_idEntregableEstudio");
            $txt_NombreActividadEntreg =$this->input->post("txt_NombreActividadEntreg");
            $txt_fechaActividadInicial =$this->input->post("txt_fechaActividadInicial");
            $txt_fechaActividadfinal =$this->input->post("txt_fechaActividadfinal");
            $txt_valorizacionAct =$this->input->post("txt_valorizacionAct");
            $txt_avanceActividad =$this->input->post("txt_avanceActividad");
                if($this->Model_FEActividadEntregable->ActualizarActividad($txt_IdActividadEntregable,$txt_idEntregableEstudio,$txt_NombreActividadEntreg,$txt_fechaActividadfinal,$txt_valorizacionAct,$txt_avanceActividad) == false)
                echo "Se actualizo correctamente la actividad";
                else
                echo "No Se actualizo correctamente la actividad"; 
        }
        else
        {
            show_404();
        }*/
         if ($this->input->is_ajax_request()) {
            $opcion                  = "u";
            $tx_IdActividad          = $this->input->post("tx_IdActividad");
            $txt_idEntregable        = $this->input->post("txt_idEntregable");
            $txt_NombreActividadAc   = $this->input->post("txt_NombreActividadAc");
            $txt_fechaActividadIAc   = $this->input->post("txt_fechaActividadIAc");
            $txt_fechaActividadfAc   = $this->input->post("txt_fechaActividadfAc");
            $txt_valorizacionEAct    = $this->input->post("txt_valorizacionEAct");
            $txt_avanceEAct          = $this->input->post("txt_avanceEAct");
            $txt_observacio_EntreAct = $this->input->post("txt_observacio_EntreAct");
            $txt_ActividadColorAc    = $this->input->post("txt_ActividadColorAc");

            $FechaActividadCalendar    = $this->input->post("FechaActividadCalendar");
            $FechasCalendar=explode('-',$FechaActividadCalendar);
            
            if ($this->Model_FEActividadEntregable->Update_Actividades($opcion,$tx_IdActividad,$txt_idEntregable,$txt_NombreActividadAc,$FechasCalendar[0],$FechasCalendar[1],$txt_valorizacionEAct,$txt_avanceEAct,$txt_observacio_EntreAct,$txt_ActividadColorAc) == false) {
                echo "Se actualizo una Actividad ";
            } else {
                echo " Se actualizo una Actividad ";
            }

        } else {
            show_404();
        }
     
    }


    public function _load_layout($template)
    {
        $this->load->view('layout/Formulacion_Evaluacion/header');
        $this->load->view($template);
        $this->load->view('layout/Formulacion_Evaluacion/footer');
    }

}
