<?php
defined('BASEPATH') or exit('No direct script access allowed');

class bancoproyectos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('bancoproyectos_modal');
        $this->load->helper('FormatNumber_helper');
        $this->load->model('Model_PMI_ubicacion');
        $this->load->model('Model_UnidadE');
        $this->load->model('Model_Gerencia');
        $this->load->model('Model_ProyectoInversion');
        $this->load->model('ESTADO_CICLO_PI_MODEL');
        $this->load->model('Model_RubroE');
        $this->load->model('Model_ModalidadE');
        $this->load->model('bancoproyectos_modal');
        $this->load->helper('Fecha_helper');
        $this->load->model('Model_OficinaR');

    }
    
    public function AddNoPip()
    {
        if ($this->input->is_ajax_request())
        {
            $this->db->trans_start();
            
            $c_data['id_ue'] = $this->input->post("cbxUnidadEjecutora");
            $c_data['id_tipo_inversion'] = 2;
            $c_data['id_grupo_funcional'] = $this->input->post("cbxGrupoFunc");
            $c_data['id_nivel_gob'] = $this->input->post("cbxNivelGob");
            $c_data['codigo_unico_pi'] = $this->input->post("txtCodigoUnico");
            $c_data['nombre_pi'] = $this->input->post("txtNombrePip");
            $c_data['costo_pi'] = floatval(str_replace(",","",$this->input->post("txtCostoPip")));
            $c_data['num_beneficiarios'] = $this->input->post("txt_beneficiarios");
            $c_data['fecha_registro_pi'] = date('Y-m-d h:i:s');
            $c_data['fecha_viabilidad_pi'] = $this->input->post("fecha_viabilidad");
            $c_data['estado_pi'] = $this->input->post("cbx_estado");

            $flag = 0;
            $msg = [];

            $q1 = $this->bancoproyectos_modal->AddNoPip($this->security->xss_clean($c_data));

            if( $q1 > 0)
            {
                $e_data['id_pi'] = $q1;
                $e_data['id_estado_ciclo'] = $this->input->post("cbxEstCicInv_");
                $e_data['fecha_estado_ciclo_pi'] = date('Y-m-d h:i:s');
                if($this->ESTADO_CICLO_PI_MODEL->Insertar_ciclo($e_data) == FALSE)
                {
                    $flag = 1;
                    $msg[] = 'Error: x001ci';
                }

                $m_data['id_modalidad_ejec'] = $this->input->post("cbxModalidadEjec");
                $m_data['id_pi'] = $q1;
                $m_data['fecha_modalidad_ejec_pi'] = date('Y-m-d h:i:s');
                if($this->Model_ModalidadE->Insertar_modalidade($m_data) == FALSE)
                {
                    $flag = 1;
                    $msg[] = 'Error: x001m';
                }

                $r_data['id_rubro'] = $this->input->post("cbxRubro");
                $r_data['id_pi'] = $q1;
                $r_data['fecha_rubro_pi'] = date('Y-m-d h:i:s');
                if($this->Model_RubroE->Insertar_rubro($r_data) == FALSE)
                {
                    $flag = 1;
                    $msg[] = 'Error: x001m';
                }

                $t_data['id_tipo_nopip'] = $this->input->post("Cbx_TipoNoPip_i");
                $t_data['id_pi'] = $q1;
                $t_data['fecha_nopip'] = date('Y-m-d h:i:s');
                if($this->bancoProyectos_modal->InsertNoPip($t_data) == FALSE)
                {
                    $flag = 1;
                    $msg[] = 'Error: x001m';
                }
            }
            else
            {
                $flag = 1;
                $msg[] = 'Error x00q1';
            }

            $this->db->trans_complete();

            $datos['flag'] = $flag;
            $datos['msg'] = $msg;
            $data['datos'] = $datos;
            $this->load->view('front/json/json_view', $data);
        } 
        else 
        {
            show_404();
        }
    }

    public function update_no_pip()
    {
        if ($this->input->is_ajax_request()) {
            $flat               = "U_IPCNOPIP";
            $id_pi              = $this->input->post("txt_idNo_Pip");
            $cbxUnidadEjecutora = $this->input->post("cbxUnidadEjecutora_m");
            $cbx_tipo_no_pip_m = $this->input->post("cbx_tipo_no_pip_m");
            $cbxGrupoFunc      = $this->input->post("cbxGrupoFunc_m");
            $cbxNivelGob       = $this->input->post("cbxNivelGob_m");
            $txtCodigoUnico    = $this->input->post("txtCodigoUnico_m");
            $txtNombrePip      = $this->input->post("txtNombrePip_m");
            $txtCostoPip       = floatval(str_replace(",", "", $this->input->post('txtCostoPip_m')));
            $txt_beneficiarios = $this->input->post("txt_beneficiarios_m");
            $cbx_tipo_inversion = $this->input->post("cbxEstCicInv_m");
            $cbxEstado_pi       = $this->input->post("cbx_estado_m");
            $cbxRubro           = $this->input->post("cbxRubroEjecucion_m");
            $cbxModalidadEjec   = $this->input->post("cbxModalidadEjecucion_m");
            $Cbx_TipoNoPip_m    = $this->input->post("Cbx_TipoNoPip_m");
            if ($this->bancoproyectos_modal->update_no_pip(
                $flat, $id_pi, $cbxUnidadEjecutora, $cbx_tipo_no_pip_m, $cbxGrupoFunc, $cbxNivelGob, $txtCodigoUnico, $txtNombrePip, $txtCostoPip, $txt_beneficiarios, $cbx_tipo_inversion, $cbxEstado_pi, $cbxRubro, $cbxModalidadEjec, $Cbx_TipoNoPip_m) == false) {
                echo "1";
            } else {
                echo "2";
            }

        } else {
            show_404();
        }
    }

    public function GetProyectoInversion()
    {
        if ($this->input->is_ajax_request())
        {

            $datos = $this->bancoproyectos_modal->GetProyectoInversion();
            foreach ($datos as $key => $value)
            {
                $value->fecha_viabilidad_pi=($value->fecha_viabilidad_pi=='' ? '' : date('d/m/Y', strtotime($value->fecha_viabilidad_pi)));
                $value->fecha_viable=$value->fecha_registro_pi;
                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
            }
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }
    public function filtrarProyectoInversion()
    {
        if ($this->input->is_ajax_request())
        {
            $idUnidadEjecutora = $this->input->post("idUnidadEjecutora");
            $idOficina = $this->input->post("idOficina");
            $datos = $this->bancoproyectos_modal->filtrarProyectoInversion($idUnidadEjecutora,$idOficina);
            foreach ($datos as $key => $value)
            {
                $value->fecha_viabilidad_pi=($value->fecha_viabilidad_pi=='' ? '' : date('d/m/Y', strtotime($value->fecha_viabilidad_pi)));
                $value->fecha_viable=$value->fecha_registro_pi;
                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
            }
            echo json_encode($datos);
        }
        else
        {
            show_404();
        }
    }
    public function listar_estados()
    {
        if ($this->input->is_ajax_request())
        {
            $flat  = "listar_estados";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->bancoproyectos_modal->listar_estados($flat, $id_pi);
            foreach ($data as $key => $value)
            {
                $value->fecha_estado_ciclo_pi=date('d/m/Y',strtotime($value->fecha_estado_ciclo_pi));
            }
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }

    public function eliminarEstadoCiclo()
    {
        if ($this->input->is_ajax_request())
        {
            $msg = array();

            $id_estado_ciclo_pi=$this->input->post("id_estado_ciclo_pi");
            $data=$this->bancoproyectos_modal->eliminarEstadoCiclo($id_estado_ciclo_pi);
            $msg=($data>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Se elimino Correctamente el Estado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));

            $this->load->view('front/json/json_view', ['datos' => $msg]);
        }
        else
        {
            show_404();
        }
    }

    public function listar_estado()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->bancoproyectos_modal->listar_estado($flat);
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function Get_ubigeo_pip()
    {
        if ($this->input->is_ajax_request())
        {
            $flat  = "listar_ubigeo";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->bancoproyectos_modal->Get_ubigeo_pip($flat, $id_pi);
            echo json_encode(array('data' => $data));
        }
        else
        {
            show_404();
        }
    }

    public function  eliminarUbigeo ()
    {
        if ($this->input->is_ajax_request())
        {
            $id_ubigeo_pi = $this->input->post("id_ubigeo_pi");

            $this->bancoproyectos_modal->eliminarUbigeo($id_ubigeo_pi);

            echo json_encode(['proceso' => 'Correcto', 'mensaje' => 'Se elimino Correctamente el ubigeo.']);exit;

        } 
        else 
        {
            show_404();
        }
    }

    public function Add_ubigeo_proyecto()
    {
        if ($this->input->is_ajax_request())
        {
            $msg = array();
            $nombreArchivo = $_FILES['ImgUbicacion']['name'];

            $c_data['id_ubigeo'] = $this->input->post("cbx_distrito");
            $c_data['id_pi']= $this->input->post("txt_id_pip");
            $c_data['direccion_ubigeo_pi'] = NULL;
            $c_data['latitud'] = $this->input->post("txt_latitud");
            $c_data['longitud'] = $this->input->post("txt_longitud");

            if($nombreArchivo != '' || $nombreArchivo != null)
            {
                $extension = pathinfo($nombreArchivo, PATHINFO_EXTENSION);
                if($extension=='png' || $extension=='jpg')
                {
                    $q1 = $this->bancoproyectos_modal->InsertarUbigeo_Pi($c_data);

                    $config['upload_path'] = './uploads/ImgUbicacionProyecto/';
                    $config['allowed_types'] = '*';
                    $config['file_name'] = 'DOC_';
                    $config['max_size'] = '20048';

                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('ImgUbicacion'))
                    {
                        $msg=(['proceso' => 'Error', 'mensaje' => $this->upload->display_errors('', '')]);
                        $this->load->view('front/json/json_view',['datos' => $msg]);
                    }
                    else
                    {
                        $d_data['id_ubigeo_pi'] = $q1['ultimoId'];
                        $d_data['url_img']= $this->upload->data('file_name');
                        $q2 = $this->Model_PMI_ubicacion->insertarUbigeoPiImg($d_data);

                        $msg=($q2>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Ubigeo guardado correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
                        $this->load->view('front/json/json_view', ['datos' => $msg]);
                    }
                }
                else
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'El tipo de archivo que intentas subir no está permitido.']);
                    $this->load->view('front/json/json_view', ['datos' => $msg]);
                }
            }
            else
            {
                $q1 = $this->bancoproyectos_modal->InsertarUbigeo_Pi($c_data);
                $msg=($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'Registro guardado']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado']));
                $this->load->view('front/json/json_view', ['datos' => $msg]);
            }
        }
        else
        {
            show_404();
        }
    }

    public function Editar_ubigeo_proyecto()
    {
        $config['upload_path']   = './uploads/ImgUbicacionProyecto/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '2000';
        $config['max_width']     ='2024';
        $config['max_height']    = '2008';
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('ImgUbicacionEditar')) 
        {

            $id_ubigeo_pi =  $this->input->post("txt_id_id_ubigeo_pi");
            $id_ubigeo    = $this->input->post("cbx_distritoEditar");
            $txt_latitudEditar  = $this->input->post("txt_latitudEditar");
            $txt_longitudEditar = $this->input->post("txt_longitudEditar");
            $this->bancoproyectos_modal->actualizar_ubigeo_proyecto($id_ubigeo_pi,$id_ubigeo , $txt_latitudEditar, $txt_longitudEditar);
        }
        else 
        {

            $id_ubigeo_pi =  $this->input->post("txt_id_id_ubigeo_pi");
            $id_ubigeo    = $this->input->post("cbx_distritoEditar");
            $txt_latitudEditar  = $this->input->post("txt_latitudEditar");
            $txt_longitudEditar = $this->input->post("txt_longitudEditar");
            $file_info = $this->upload->data();
            $imagen = $file_info['file_name'];

            if ($this->bancoproyectos_modal->actualizar_ubigeo_proyecto($id_ubigeo_pi,$id_ubigeo , $txt_latitudEditar, $txt_longitudEditar) == true) 
            {
                $dataId=$this->Model_PMI_ubicacion->id_ubigeo_pi_img($id_ubigeo_pi);
                $this->Model_PMI_ubicacion->actualizar($dataId->id_ubigeo_pi_img,$imagen);
                echo $id_ubigeo_pi;
            }
        }
    }

    public function AddEstadoCicloPI()
    {
        if ($this->input->is_ajax_request())
        {
            $estadoActual = $this->bancoproyectos_modal->verificarCicloPi($this->input->post("txt_id_pip_Ciclopi"));
            $cantidad = count($estadoActual);
            if($cantidad>0)
            {
                if($estadoActual[0]->id_estado_ciclo>$this->input->post("Cbx_EstadoCiclo"))
                {
                    $msg = (['proceso' => 'Error', 'mensaje' => 'No puede regresar a un Estado Anterior']);
                    $this->load->view('front/json/json_view', ['datos' => $msg]);
                    return;
                }
            }

            $c_data['id_pi']= $this->input->post("txt_id_pip_Ciclopi");
            $c_data['id_estado_ciclo'] = $this->input->post("Cbx_EstadoCiclo");
            $c_data['fecha_estado_ciclo_pi'] = $this->input->post("dateFechaIniC");
            $msg = array();
            $q1 = $this->bancoproyectos_modal->AgregarEstadoCicloPI($c_data);
            $msg = ($q1>0 ? (['proceso' => 'Correcto', 'mensaje' => 'los datos fueron registrados correctamente']) : (['proceso' => 'Error', 'mensaje' => 'Ha ocurrido un error inesperado.']));
            $this->load->view('front/json/json_view', ['datos' => $msg]);

        }
        else
        {
            show_404();
        }
    }

    public function listar_provincia()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "listar_provincia";
            $datos = $this->bancoproyectos_modal->listar_provincia($flat);
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function listar_distrito()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat            = "listar_distrito";
            $nombre_distrito = $this->input->post("nombre_distrito");
            $datos           = $this->bancoproyectos_modal->listar_distrito($flat, $nombre_distrito);
            echo json_encode($datos);
        } 
        else 
        {
            show_404();
        }
    }

    public function GetNOPIP()
    {
        if ($this->input->is_ajax_request())
        {
            $datos = $this->bancoproyectos_modal->GetNOPIP();
            foreach ($datos as $key => $value)
            {
                $value->costo_pi = a_number_format($value->costo_pi , 2, '.',",",3);
            }
            echo json_encode($datos);exit;
        }
        else
        {
            show_404();
        }
    }

    public function AddTipoNoPip()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat                 = "C";
            $id_tipo_NoPip        = "0";
            $txt_id_pip_Tipologia = $this->input->post("txt_id_pip_Tipologia");
            $Cbx_TipoNoPip        = $this->input->post("Cbx_TipoNoPip");
            if ($this->bancoproyectos_modal->AddTipoNoPip($flat, $id_tipo_NoPip, $Cbx_TipoNoPip, $txt_id_pip_Tipologia) == false) 
            {
                echo "1";
            } 
            else 
            {
                echo "2";
            }

        } 
        else 
        {
            show_404();
        }
    }

    public function Get_TipoNoPip()
    {
        if ($this->input->is_ajax_request()) 
        {
            $flat  = "listar_tipo_nopip";
            $id_pi = $this->input->post("id_pi");
            $data  = $this->bancoproyectos_modal->Get_TipoNoPip($flat, $id_pi);
            echo json_encode(array('data' => $data));
        } 
        else 
        {
            show_404();
        }
    }

    public function BuscarProyectoSiaf()
    {
        $data  = $this->bancoproyectos_modal->BuscarProyectoSiaf($this->input->post('codigo'));
        echo json_encode($data);exit;
    }
    public function BuscarProyectoCodigoUnico()
    {
        $data  = $this->bancoproyectos_modal->verificarProyecto($this->input->post('codigo'));
        echo json_encode(['datos'=>$data]);exit;
    }
    public function BuscarProyectoCodigoUnico2()
    {
        $data  = $this->bancoproyectos_modal->verificarProyectoCodigoUnico($this->input->post('codigo'));
        echo $data;exit;
    }
    public function BuscarProyectoCodigoUnico2nopip()
    {
        $data  = $this->bancoproyectos_modal->verificarProyectoCodigoUniconopip($this->input->post('codigo'));
        echo $data;exit;
    }
    public function NoPip()
    {
        $this->_load_layout_NoPip('Front/Pmi/frmbancoproyectosNoPip');
    }
    public function _load_layout_NoPip($template)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsNoPip');
    }
    public function index()
    {
        $anio='2022';
        $listaUnidadEjecutora = $this->Model_UnidadE->getUnidadEjecutoraOpciones();
        $listarSiaf           = $this->Model_UnidadE->cargarSiaf($anio);
        $this->_load_layout('Front/Pmi/frmbancoproyectos',['unidadEjecutora'=>$listaUnidadEjecutora,'listarSiaf'=>  $listarSiaf]);
    }
    public function _load_layout($template,$variable)
    {
        $this->load->view('layout/PMI/header');
        $this->load->view($template,$variable);
        $this->load->view('layout/PMI/footer');
        $this->load->view('Front/Pmi/js/jsPip');
    }

    function insertarProyectosSiaf()
    {
        $idUnidadEjecutora=$this->input->post('idUnidadEjecutora');
        $anio=$this->input->post('anio');

        $UE=$this->Model_UnidadE->UnidadEjecutoraId($idUnidadEjecutora);

        $proyectosSiaf = $this->bancoproyectos_modal->obtenerProyectosSiaf($UE->codigo_ue,$anio);

        foreach ($proyectosSiaf as $key => $value)
        {
            $verificar=count($this->bancoproyectos_modal->verificarCodigoUnico($value->act_proy));

            if($verificar==0)
            {
                $c_data['id_ue'] = $idUnidadEjecutora;
                $c_data['codigo_unico_pi'] = $value->act_proy;
                $c_data['nombre_pi'] = $value->nombre;
                $c_data['costo_pi'] = $value->costo_expediente;
                $c_data['id_naturaleza_inv'] = 27;
                $c_data['id_tipologia_inv'] = 23;
                $c_data['id_tipo_inversion'] = 1;
                $c_data['id_grupo_funcional'] = 1;
                $c_data['id_nivel_gob'] =19;
                $c_data['estado_pi'] =1;
                $c_data['fecha_viabilidad_pi'] =  NULL;
                $data = $this->bancoproyectos_modal->insertarProyectosdeSiaf($c_data);
            }
            else
            {
                if($value->costo_expediente!=0 && $value->costo_expediente!='')
                {
                    $u_data['costo_pi'] = $value->costo_expediente;
                    $data = $this->bancoproyectos_modal->editarProyectosdeSiaf($u_data,$value->act_proy);
                }
            }
        }
    }
}
