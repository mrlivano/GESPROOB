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
    public function PipSiaf()
    {
        $anio='2022';
        $listaUnidadEjecutora = $this->Model_UnidadE->getUnidadEjecutoraOpciones();
        $listarSiaf           = $this->Model_UnidadE->cargarSiaf($anio);
        $this->_load_layout('Front/Pmi/frmbancoproyectosSiaf',['unidadEjecutora'=>$listaUnidadEjecutora,'listarSiaf'=>  $listarSiaf]);
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

    function insertarProyectosPIDE()
    {
        $idUnidadEjecutora=$this->input->post('idUnidadEjecutora');
        $anio=$this->input->post('anio');
        $proyectosPIDE=$this->input->post('data');
        $proyectosPIDE;
        foreach ($proyectosPIDE as $key => $value) {
            $verificar=count($this->bancoproyectos_modal->verificarCodigoUnico($value['idProyecto']));

            if($verificar===0)
            {
                $c_data['id_ue'] = $idUnidadEjecutora;
                $c_data['codigo_unico_pi'] = $value['idProyecto'];
                $c_data['nombre_pi'] = $value['nombre'];
                $c_data['costo_pi'] = NULL;
                $c_data['id_naturaleza_inv'] = NULL;
                $c_data['id_tipologia_inv'] = NULL;
                $c_data['id_tipo_inversion'] = 1;
                $c_data['id_grupo_funcional'] = NULL;
                $c_data['id_nivel_gob'] =NULL;
                $c_data['estado_pi'] = $value['estado']==='A'?1:0;
                $c_data['fecha_viabilidad_pi'] =  NULL;
                $data = $this->bancoproyectos_modal->insertarProyectosdePIDE($c_data);

            }
            else
            {
               $u_data['estado_pi'] = $value['estado']==='A'?1:0;
               $u_data['id_tipo_inversion'] = 1;
               $data = $this->bancoproyectos_modal->editarProyectosdePIDE($u_data,$value['idProyecto']);
            }
        }
    }
    function insertarProyectoCodigoPIDE()
    {
        $id=$this->input->post('id');
        $idUnidadEjecutora=$this->session->userdata('idUnidadEjecutora');;
        $anio=$this->input->post('anio');
        $value=$this->input->post('proy');
            $verificar=count($this->bancoproyectos_modal->verificarCodigoUnicoPIDE($id));

            if($verificar===0)
            {
                if(gettype($value['PIA'])==='array'){
                    $c_data['PIA']='';
                }else{
                    $c_data['PIA']=$value['PIA'];
                }
                $c_data['PIM'] = $value['PIM'];
                $c_data['actualizacion'] = $value['actualizacion'];
                $c_data['anioViabilidad'] = $value['anioViabilidad'];
                $c_data['beneficiario'] = $value['beneficiario'];
                $c_data['codigo'] = $id;
                $c_data['conInformeCierre'] = $value['conInformeCierre'];
                $c_data['costoActualizado'] = $value['costoActualizado'];
                $c_data['desTipoFormato'] = $value['desTipoFormato'];
                $c_data['devengadoAcumulado'] = $value['devengadoAcumulado'];
                $c_data['devengadoAnioActual'] = $value['devengadoAnioActual'];
                $c_data['ejecutora'] = $value['ejecutora'];
                $c_data['ejecutoraCodigo'] = $value['ejecutoraCodigo'];
                $c_data['estado'] = $value['estado'];
                $c_data['estadoUltimoEstudio'] = $value['estadoUltimoEstudio'];
                $c_data['evaluadora'] = $value['evaluadora'];
                $c_data['evaluadoraCodigo'] = $value['evaluadoraCodigo'];
                $c_data['fechaRegistro'] = $value['fechaRegistro'];
                $c_data['fechaViabilidad'] = $value['fechaViabilidad'];
                $c_data['flagEtapas'] = $value['flagEtapas'];
                $c_data['flagExpedienteTecnico'] = $value['flagExpedienteTecnico'];
                $c_data['fuenteFinanciamiento'] = $value['fuenteFinanciamiento'];
                $c_data['funcion'] = $value['funcion'];
                $c_data['incluidoPMI'] = $value['incluidoPMI'];
                $c_data['incluidoPMIEjecucion'] = $value['incluidoPMIEjecucion'];
                $c_data['marco'] = $value['marco'];
                $c_data['montoAlternativa'] = $value['montoAlternativa'];
                $c_data['montoCartaFianza'] = $value['montoCartaFianza'];
                $c_data['montoF15'] = $value['montoF15'];
                $c_data['montoF16'] = $value['montoF16'];
                $c_data['montoLaudo'] = $value['montoLaudo'];
                $c_data['montoReformulado'] = $value['montoReformulado'];
                $c_data['nivelEstudio'] = $value['nivelEstudio'];
                $c_data['nivelGobierno'] = $value['nivelGobierno'];
                $c_data['nombre'] = $value['nombre'];
                $c_data['nombreProgramaInversion'] = $value['nombreProgramaInversion'];
                $c_data['numeroConvenio'] = $value['numeroConvenio'];
                $c_data['pliego'] = $value['pliego'];
                $c_data['programa'] = $value['programa'];
                $c_data['sector'] = $value['sector'];
                $c_data['situacion'] = $value['situacion'];
                $c_data['subprograma'] = $value['subprograma'];
                $c_data['ultimoEstudio'] = $value['ultimoEstudio'];
                $c_data['unidadFormuladora'] = $value['unidadFormuladora'];
                $c_data['unidadFormuladoraCodigo'] = $value['unidadFormuladoraCodigo'];
                $c_data['unidadUEICodigo'] = $value['unidadUEICodigo'];
                $data = $this->bancoproyectos_modal->insertarProyectoCodigoPIDE($c_data);
                
            }
            else
            {
                if(gettype($value['PIA'])==='array'){
                    $u_data['PIA']='';
                }else{
                    $u_data['PIA']=$value['PIA'];
                }
                $u_data['PIM'] = $value['PIM'];
                $u_data['actualizacion'] = $value['actualizacion'];
                $u_data['anioViabilidad'] = $value['anioViabilidad'];
                $u_data['beneficiario'] = $value['beneficiario'];
                $u_data['conInformeCierre'] = $value['conInformeCierre'];
                $u_data['costoActualizado'] = $value['costoActualizado'];
                $u_data['desTipoFormato'] = $value['desTipoFormato'];
                $u_data['devengadoAcumulado'] = $value['devengadoAcumulado'];
                $u_data['devengadoAnioActual'] = $value['devengadoAnioActual'];
                $u_data['ejecutora'] = $value['ejecutora'];
                $u_data['ejecutoraCodigo'] = $value['ejecutoraCodigo'];
                $u_data['estado'] = $value['estado'];
                $u_data['estadoUltimoEstudio'] = $value['estadoUltimoEstudio'];
                $u_data['evaluadora'] = $value['evaluadora'];
                $u_data['evaluadoraCodigo'] = $value['evaluadoraCodigo'];
                $u_data['fechaRegistro'] = $value['fechaRegistro'];
                $u_data['fechaViabilidad'] = $value['fechaViabilidad'];
                $u_data['flagEtapas'] = $value['flagEtapas'];
                $u_data['flagExpedienteTecnico'] = $value['flagExpedienteTecnico'];
                $u_data['fuenteFinanciamiento'] = $value['fuenteFinanciamiento'];
                $u_data['funcion'] = $value['funcion'];
                $u_data['incluidoPMI'] = $value['incluidoPMI'];
                $u_data['incluidoPMIEjecucion'] = $value['incluidoPMIEjecucion'];
                $u_data['marco'] = $value['marco'];
                $u_data['montoAlternativa'] = $value['montoAlternativa'];
                $u_data['montoCartaFianza'] = $value['montoCartaFianza'];
                $u_data['montoF15'] = $value['montoF15'];
                $u_data['montoF16'] = $value['montoF16'];
                $u_data['montoLaudo'] = $value['montoLaudo'];
                $u_data['montoReformulado'] = $value['montoReformulado'];
                $u_data['nivelEstudio'] = $value['nivelEstudio'];
                $u_data['nivelGobierno'] = $value['nivelGobierno'];
                $u_data['nombre'] = $value['nombre'];
                $u_data['nombreProgramaInversion'] = $value['nombreProgramaInversion'];
                $u_data['numeroConvenio'] = $value['numeroConvenio'];
                $u_data['pliego'] = $value['pliego'];
                $u_data['programa'] = $value['programa'];
                $u_data['sector'] = $value['sector'];
                $u_data['situacion'] = $value['situacion'];
                $u_data['subprograma'] = $value['subprograma'];
                $u_data['ultimoEstudio'] = $value['ultimoEstudio'];
                $u_data['unidadFormuladora'] = $value['unidadFormuladora'];
                $u_data['unidadFormuladoraCodigo'] = $value['unidadFormuladoraCodigo'];
                $u_data['unidadUEICodigo'] = $value['unidadUEICodigo'];
                $data = $this->bancoproyectos_modal->editarProyectoCodigoPIDE($u_data,$id);
            }
            $verificar_pi=count($this->bancoproyectos_modal->verificarCodigoUnico($id));

            if($verificar_pi===0)
            {
                $c_data_pi['id_ue'] = $idUnidadEjecutora;
                $c_data_pi['codigo_unico_pi'] = $id;
                $c_data_pi['nombre_pi'] = $value['nombre'];
                $c_data_pi['costo_pi'] = $value['montoAlternativa'];
                $c_data_pi['id_naturaleza_inv'] = NULL;
                $c_data_pi['id_tipologia_inv'] = NULL;
                $c_data_pi['id_tipo_inversion'] = $value['desTipoFormato']==='2'?'2':'1';
                $c_data_pi['id_grupo_funcional'] = NULL;
                $c_data_pi['id_nivel_gob'] =NULL;
                $c_data_pi['estado_pi'] = $value['estado']==='ACTIVO'?1:0;
                $c_data_pi['num_beneficiarios'] =  $value['beneficiario'];
                $c_data_pi['fecha_viabilidad_pi'] =  date('Y-m-d', strtotime(str_replace('/', '-',$value['fechaViabilidad'])));
                $data_pi = $this->bancoproyectos_modal->insertarProyectosdePIDE($c_data_pi);

            }
            else
            {
                $u_data_pi['id_ue'] = $idUnidadEjecutora;
                $u_data_pi['nombre_pi'] = $value['nombre'];
                $u_data_pi['costo_pi'] = $value['montoAlternativa'];
                $u_data_pi['id_naturaleza_inv'] = NULL;
                $u_data_pi['id_tipologia_inv'] = NULL;
                $u_data_pi['id_tipo_inversion'] = $value['desTipoFormato']==='2'?'2':'1';
                $u_data_pi['id_grupo_funcional'] = NULL;
                $u_data_pi['id_nivel_gob'] =NULL;
                $u_data_pi['estado_pi'] = $value['estado']==='ACTIVO'?1:0;
                $u_data_pi['num_beneficiarios'] =  $value['beneficiario'];
                $u_data_pi['fecha_viabilidad_pi'] =  date('Y-m-d', strtotime(str_replace('/', '-',$value['fechaViabilidad'])));
                $data_pi = $this->bancoproyectos_modal->editarProyectosdePIDE($u_data_pi,$id);
            }

            $verificar_pi_anio=count($this->bancoproyectos_modal->verificarCodigoUnicoProyectoAño($id,$anio));

            if($verificar_pi_anio===0)
            {
                $c_data_pi_anio['cod_proyecto'] = $id;
                $c_data_pi_anio['año'] = $anio;
                $c_data_pi_anio['estado'] = $value['estado']==='ACTIVO'?1:0;
                $data_pi_anio = $this->bancoproyectos_modal->insertarProyectoAñoPIDE($c_data_pi_anio);

            }
            else
            {
                $u_data_pi_anio['estado'] = $value['estado']==='ACTIVO'?1:0;
                $data_pi_anio = $this->bancoproyectos_modal->editarProyectoAñoPIDE($u_data_pi_anio,$id,$anio);
            }
            foreach ($value['localizaciones_'] as $key => $val) {
                $verificar_pi_loc=count($this->bancoproyectos_modal->verificarLocalizacionPIDE($id,$val['ubigeo']));

                if($verificar_pi_loc===0)
                {
                    $c_data_pi_loc['codigo'] = $id;
                    $c_data_pi_loc['departamento'] = $val['departamento'];
                    $c_data_pi_loc['provincia'] = $val['provincia'];
                    $c_data_pi_loc['distrito'] = $val['distrito'];
                    $c_data_pi_loc['centroPoblado'] = $val['centroPoblado'];
                    $c_data_pi_loc['ubigeo'] = $val['ubigeo'];
                    $c_data_pi_loc['latitud'] = $val['latitud'];
                    $c_data_pi_loc['longitud'] = $val['longitud'];
                    $data_pi_loc = $this->bancoproyectos_modal->insertarLocalizacionPIDE($c_data_pi_loc);

                }
                else
                {
                    $u_data_pi_loc['departamento'] = $val['departamento'];
                    $u_data_pi_loc['provincia'] = $val['provincia'];
                    $u_data_pi_loc['distrito'] = $val['distrito'];
                    $u_data_pi_loc['centroPoblado'] = $val['centroPoblado'];
                    $u_data_pi_loc['latitud'] = $val['latitud'];
                    $u_data_pi_loc['longitud'] = $val['longitud'];
                    $data_pi_loc = $this->bancoproyectos_modal->editarLocalizacionPIDE($u_data_pi_loc,$id,$val['ubigeo']);
                }
            }
    }

    function insertarEstudioCodigoPIDE()
    {
        $proyectosPIDE = $this->bancoproyectos_modal->obtenerProyectosPIDE();

        foreach ($proyectosPIDE as $key => $value)
        {
            $verificar=count($this->bancoproyectos_modal->verificarCodigoUnicoEstudio($value->id_pi));

            $p_data['id_grupo_funcional'] = $value->id_grup_funcional;
            $datap = $this->bancoproyectos_modal->editarProyectosdePIDE($p_data,$value->codigo_unico_est_inv);

            if($verificar===0)
            {
                $c_data['codigo_unico_est_inv'] = $value->codigo_unico_est_inv;
                $c_data['nombre_est_inv'] = $value->nombre_est_inv;
                $c_data['id_pi'] = $value->id_pi;
                $c_data['id_ue'] = $value->id_ue;
                $c_data['id_tipo_est'] = 1;
                $c_data['situacion'] = $value->situacion;
                $c_data['ultimoEstudio'] = $value->ultimoEstudio;
                $c_data['monto_inv'] = $value->montoAlternativa;
                $c_data['costo_estudio'] = $value->costoActualizado;
                $data = $this->bancoproyectos_modal->insertarEstudioCodigoPIDE($c_data);
                
            }
            else
            {
                $u_data['id_tipo_est'] = 1;
                $u_data['situacion'] = $value->situacion;
                $u_data['ultimoEstudio'] = $value->ultimoEstudio;
                $u_data['monto_inv'] = $value->montoAlternativa;
                $u_data['costo_estudio'] = $value->costoActualizado;
               $data = $this->bancoproyectos_modal->editarEstudioCodigoPIDE($u_data,$value->id_pi);
            }

        }
    }
    public function getProyectoPIDE()
    {
        if ($this->input->is_ajax_request())
        {
            $codigo = $this->input->post("codigo");
            $data = $this->bancoproyectos_modal->getProyectoPIDE($codigo);
            $localizacion = $this->bancoproyectos_modal->getProyectoLocalizacionPIDE($codigo);
            echo json_encode(array('data' => $data,'localizacion' => $localizacion));
        }
        else
        {
            show_404();
        }
    }
}
