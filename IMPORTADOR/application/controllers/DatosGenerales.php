<?php
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, *");

defined('BASEPATH') or exit('No direct script access allowed');

class DatosGenerales extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("DatosGenerales_Model");
    }

	 public function eliminartodo($anio = null)
    {
		$this->DatosGenerales_Model->delete_DatosGenerales($anio); //gasto
		
		echo "eliminado";
		
		
	}
    public function importar($anio = null)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;

        try {

            $this->db->trans_start();
            $this->DatosGenerales_Model->delete_DatosGenerales($anio); //gasto
			//Funciona
            $generica = $this->DatosGenerales_Model->generica($anio);
            $data['generica'] = 0;
            foreach ($generica as $row) {
                $ano_eje               = $row->ano_eje;
                $tipo_transaccion      = $row->tipo_transaccion;
                $generica              = $row->generica;
                $descripcion           = $row->descripcion;
                $id_grupo_clasificador = $row->id_grupo_clasificador;
                $ambito                = $row->ambito;
                $estado                = $row->estado;

                $this->DatosGenerales_Model->insert_generica($ano_eje, $tipo_transaccion, $generica, $descripcion, $id_grupo_clasificador, $ambito, $estado);
                $data['generica']++;
            }
			//Funciona
            $subgenerica = $this->DatosGenerales_Model->subgenerica($anio);
            $data['subgenerica'] = 0;
            foreach ($subgenerica as $row) {
                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;

                $this->DatosGenerales_Model->insert_subgenerica($ano_eje, $tipo_transaccion, $generica, $subgenerica, $descripcion, $ambito, $estado);
                $data['subgenerica']++;
            }

			//if($anio!=2017){
				// no  funciona importar con el año 2017  - munchos datos
				$subgenerica_det = $this->DatosGenerales_Model->subgenerica_det($anio);
				$data['subgenerica_det'] = 0;
				foreach ($subgenerica_det as $row) {

					$ano_eje           = $row->ano_eje;
					$tipo_transaccion  = $row->tipo_transaccion;
					$generica          = $row->generica;
					$subgenerica       = $row->subgenerica;
					$subgenerica_det   = $row->subgenerica_det;
					$descripcion       = $row->descripcion;
					$categoria_gasto   = $row->categoria_gasto;
					$tipo_act_proy     = $row->tipo_act_proy;
					$tipo_gasto        = $row->tipo_gasto;
					$ambito            = $row->ambito;
					$estado            = $row->estado;
					$categoria_ingreso = $row->categoria_ingreso;

					$this->DatosGenerales_Model->insert_subgenerica_det($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $descripcion, $categoria_gasto, $tipo_act_proy, $tipo_gasto, $ambito, $estado, $categoria_ingreso);
					$data['subgenerica_det']++;
				}

				// no  funciona importar con el año 2017  - muchos datos
				$data['especifica'] = 0;
				$especifica = $this->DatosGenerales_Model->especifica($anio);
				foreach ($especifica as $row) {
					$ano_eje          = $row->ano_eje;
					$tipo_transaccion = $row->tipo_transaccion;
					$generica         = $row->generica;
					$subgenerica      = $row->subgenerica;
					$subgenerica_det  = $row->subgenerica_det;
					$especifica       = $row->especifica;
					$descripcion      = $row->descripcion;
					$ambito           = $row->ambito;
					$estado           = $row->estado;

					$this->DatosGenerales_Model->insert_especifica($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $especifica, $descripcion, $ambito, $estado);
					$data['especifica']++;
				}
			//}
			
			// Funciona 
            $especifica_det = $this->DatosGenerales_Model->especifica_det($anio);
            $data['especifica_det'] = 0;
            foreach ($especifica_det as $row) {

                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $subgenerica_det  = $row->subgenerica_det;
                $especifica       = $row->especifica;
                $especifica_det   = $row->especifica_det;
                $id_clasificador  = $row->id_clasificador;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;
                $exclusivo_tp     = $row->exclusivo_tp;

                $this->DatosGenerales_Model->insert_especifica_det($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $especifica, $especifica_det, $id_clasificador, $descripcion, $ambito, $estado, $exclusivo_tp);
                $data['especifica_det']++;
            }
			//Funciona
            $tipo_transaccion = $this->DatosGenerales_Model->tipo_transaccion($anio);
            $data['tipo_transaccion'] = 0;
            foreach ($tipo_transaccion as $row) {
                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $descripcion      = $row->descripcion;
                $estado           = $row->estado;

                $this->DatosGenerales_Model->insert_tipo_transaccion($ano_eje, $tipo_transaccion, $descripcion, $estado);
                $data['tipo_transaccion']++;
            }
			//Funciona
            $fuente_financ = $this->DatosGenerales_Model->fuente_financ($anio);
            $data['fuente_financ'] = 0;
            foreach ($fuente_financ as $row) {
                $ano_eje                = $row->ano_eje;
                $origen                 = $row->origen;
                $fuente_financ          = $row->fuente_financ;
                $nombre                 = $row->nombre;
                $estado                 = $row->estado;
                $ambito                 = $row->ambito;
                $es_presupuestal        = $row->es_presupuestal;
                $es_modificable         = $row->es_modificable;
                $fuente_financ_agregada = $row->fuente_financ_agregada;
                $es_pptm                = $row->es_pptm;

                $this->DatosGenerales_Model->insert_fuente_financ($ano_eje, $origen, $fuente_financ, $nombre, $estado, $ambito, $es_presupuestal, $es_modificable, $fuente_financ_agregada, $es_pptm);
                $data['fuente_financ']++;
            }

			//Funciona menos el del año 2016
            $finalidad          = $this->DatosGenerales_Model->finalidad($anio);
            $data['finalidad'] = 0;
            foreach ($finalidad as $row) {
                $ano_eje         = $row->ano_eje;
                $finalidad       = $row->finalidad;
                $nombre          = $row->nombre;
                $estado          = $row->estado;
                $ambito          = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $ambito_en       = $row->ambito_en;
                $ambito_programa = $row->ambito_programa;
                $es_generico     = $row->es_generico;
                //if($contador_finalidad==1)
                $this->DatosGenerales_Model->insert_finalidad($ano_eje, $finalidad, $nombre, $estado, $ambito, $es_presupuestal, $ambito_en, $ambito_programa, $es_generico);
                $data['finalidad']++;
            }
			
			//Funciona con un  promedio de 5 minutos demora en cargar
            $act_proy_nombre = $this->DatosGenerales_Model->act_proy_nombre($anio);
            $data['act_proy_nombre'] = 0;
            foreach ($act_proy_nombre as $row) {                
                $ano_eje = $row->ano_eje;
                $act_proy = $row->act_proy;
                $tipo_act_proy = $row->tipo_act_proy;
                $nombre = $row->nombre;
                $estado = $row->estado;
                $ambito = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $sector_snip = $row->sector_snip;
                $naturaleza_snip = $row->naturaleza_snip;
                $intervencion_snip = $row->intervencion_snip;
                $tipo_proyecto = $row->tipo_proyecto;
                $proyecto_snip = $row->proyecto_snip;
                $ambito_en = $row->ambito_en;
                $es_foniprel = $row->es_foniprel;
                $ambito_programa = $row->ambito_programa;
                $es_generico = $row->es_generico;
                $costo_actual = $row->costo_actual;
                $costo_expediente = $row->costo_expediente;
                $costo_viabilidad = $row->costo_viabilidad;
                $ejecucion_ano_anterior = $row->ejecucion_ano_anterior;
                $ind_viabilidad= $row->ind_viabilidad;

                $this->DatosGenerales_Model->insert_act_proy_nombre($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
                $data['act_proy_nombre']++;
            }

            $this->db->trans_complete();

            $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;

        } catch (Exception $e) {
            $this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }
	
	
	
	
	public function importar_subgenerica_det($anio = null)
    {
		
		set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;
		
		
		
/*
        try {*/
			
			
			
			
			$conta=0;
			
			
		
			

			
			
			
			$act_proy_nombre = $this->DatosGenerales_Model->act_proy_nombre($anio);
            $data['act_proy_nombre'] = 0;
            foreach ($act_proy_nombre as $row) {                
                $ano_eje = $row->ano_eje;
                $act_proy = $row->act_proy;
                $tipo_act_proy = $row->tipo_act_proy;
                $nombre = $row->nombre;
                $estado = $row->estado;
                $ambito = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $sector_snip = $row->sector_snip;
                $naturaleza_snip = $row->naturaleza_snip;
                $intervencion_snip = $row->intervencion_snip;
                $tipo_proyecto = $row->tipo_proyecto;
                $proyecto_snip = $row->proyecto_snip;
                $ambito_en = $row->ambito_en;
                $es_foniprel = $row->es_foniprel;
                $ambito_programa = $row->ambito_programa;
                $es_generico = $row->es_generico;
                $costo_actual = $row->costo_actual;
                $costo_expediente = $row->costo_expediente;
                $costo_viabilidad = $row->costo_viabilidad;
                $ejecucion_ano_anterior = $row->ejecucion_ano_anterior;
                $ind_viabilidad= $row->ind_viabilidad;
echo $conta." ->".$act_proy."<br/>";
                $this->DatosGenerales_Model->insert_act_proy_nombre($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
                $data['act_proy_nombre']++;
				$conta++;
            }
            

			 $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;
			
			/*
		 } catch (Exception $e) {
           // $this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }
		
		 echo json_encode($data, JSON_FORCE_OBJECT);
		 */
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function importar_insert_act_proy_nombre($anio = null)
    {
		
		set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;

        try {
			
			
			
			$act_proy_nombre = $this->DatosGenerales_Model->act_proy_nombre($anio);
            $data['act_proy_nombre'] = 0;
			$conta=0;
            foreach ($act_proy_nombre as $row) {                
                $ano_eje = $row->ano_eje;
                $act_proy = $row->act_proy;
                $tipo_act_proy = $row->tipo_act_proy;
                $nombre = $row->nombre;
                $estado = $row->estado;
                $ambito = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $sector_snip = $row->sector_snip;
                $naturaleza_snip = $row->naturaleza_snip;
                $intervencion_snip = $row->intervencion_snip;
                $tipo_proyecto = $row->tipo_proyecto;
                $proyecto_snip = $row->proyecto_snip;
                $ambito_en = $row->ambito_en;
                $es_foniprel = $row->es_foniprel;
                $ambito_programa = $row->ambito_programa;
                $es_generico = $row->es_generico;
                $costo_actual = $row->costo_actual;
                $costo_expediente = $row->costo_expediente;
                $costo_viabilidad = $row->costo_viabilidad;
                $ejecucion_ano_anterior = $row->ejecucion_ano_anterior;
                $ind_viabilidad= $row->ind_viabilidad;
				//echo $conta." ->".$act_proy."<br/>";
				$conta++;
                $this->DatosGenerales_Model->insert_act_proy_nombre($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
                $data['act_proy_nombre']++;
				
				
            }

			 $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;
			
			
		 } catch (Exception $e) {
           // $this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }
		
		 echo json_encode($data, JSON_FORCE_OBJECT);
		
	}
	
	public function importar_especifica_det($anio = null)
    {
		
		set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;

        try {
			
			
			$conta=0;
			 	
            
			
			  $especifica_det = $this->DatosGenerales_Model->especifica_det2($anio);
            $data['especifica_det'] = 0;
            foreach ($especifica_det as $row) {

                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $subgenerica_det  = $row->subgenerica_det;
                $especifica       = $row->especifica;
                $especifica_det   = $row->especifica_det;
                $id_clasificador  = $row->id_clasificador;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;
                $exclusivo_tp     = $row->exclusivo_tp;
				echo $conta."-".$tipo_transaccion.$generica.$descripcion."<br/>";
               // $this->DatosGenerales_Model->insert_especifica_det($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $especifica, $especifica_det, $id_clasificador, $descripcion, $ambito, $estado, $exclusivo_tp);
              $conta++;
			  $data['especifica_det']++;
            }
				
				
            

			 $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;
			
			
		 } catch (Exception $e) {
           // $this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }
		
		 //echo json_encode($data, JSON_FORCE_OBJECT);
		
	}
	
	

	
	
	
	
	public function importar_total($anio = null)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;

        try {

            //$this->db->trans_start();
            $this->DatosGenerales_Model->delete_DatosGenerales($anio); //gasto

            $generica = $this->DatosGenerales_Model->generica($anio);
            $data['generica'] = 0;
            foreach ($generica as $row) {
                $ano_eje               = $row->ano_eje;
                $tipo_transaccion      = $row->tipo_transaccion;
                $generica              = $row->generica;
                $descripcion           = $row->descripcion;
                $id_grupo_clasificador = $row->id_grupo_clasificador;
                $ambito                = $row->ambito;
                $estado                = $row->estado;

                $this->DatosGenerales_Model->insert_generica($ano_eje, $tipo_transaccion, $generica, $descripcion, $id_grupo_clasificador, $ambito, $estado);
                $data['generica']++;
            }

            $subgenerica = $this->DatosGenerales_Model->subgenerica($anio);
            $data['subgenerica'] = 0;
            foreach ($subgenerica as $row) {
                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;

                $this->DatosGenerales_Model->insert_subgenerica($ano_eje, $tipo_transaccion, $generica, $subgenerica, $descripcion, $ambito, $estado);
                $data['subgenerica']++;
            }

            $subgenerica_det = $this->DatosGenerales_Model->subgenerica_det($anio);
            $data['subgenerica_det'] = 0;
            foreach ($subgenerica_det as $row) {

                $ano_eje           = $row->ano_eje;
                $tipo_transaccion  = $row->tipo_transaccion;
                $generica          = $row->generica;
                $subgenerica       = $row->subgenerica;
                $subgenerica_det   = $row->subgenerica_det;
                $descripcion       = $row->descripcion;
                $categoria_gasto   = $row->categoria_gasto;
                $tipo_act_proy     = $row->tipo_act_proy;
                $tipo_gasto        = $row->tipo_gasto;
                $ambito            = $row->ambito;
                $estado            = $row->estado;
                $categoria_ingreso = $row->categoria_ingreso;

                $this->DatosGenerales_Model->insert_subgenerica_det($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $descripcion, $categoria_gasto, $tipo_act_proy, $tipo_gasto, $ambito, $estado, $categoria_ingreso);
                $data['subgenerica_det']++;
            }

            $data['especifica'] = 0;
            $especifica = $this->DatosGenerales_Model->especifica($anio);
            foreach ($especifica as $row) {
                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $subgenerica_det  = $row->subgenerica_det;
                $especifica       = $row->especifica;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;

                $this->DatosGenerales_Model->insert_especifica($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $especifica, $descripcion, $ambito, $estado);
                $data['especifica']++;
            }

            $especifica_det = $this->DatosGenerales_Model->especifica_det($anio);
            $data['especifica_det'] = 0;
            foreach ($especifica_det as $row) {

                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $generica         = $row->generica;
                $subgenerica      = $row->subgenerica;
                $subgenerica_det  = $row->subgenerica_det;
                $especifica       = $row->especifica;
                $especifica_det   = $row->especifica_det;
                $id_clasificador  = $row->id_clasificador;
                $descripcion      = $row->descripcion;
                $ambito           = $row->ambito;
                $estado           = $row->estado;
                $exclusivo_tp     = $row->exclusivo_tp;

                $this->DatosGenerales_Model->insert_especifica_det($ano_eje, $tipo_transaccion, $generica, $subgenerica, $subgenerica_det, $especifica, $especifica_det, $id_clasificador, $descripcion, $ambito, $estado, $exclusivo_tp);
                $data['especifica_det']++;
            }

            $tipo_transaccion = $this->DatosGenerales_Model->tipo_transaccion($anio);
            $data['tipo_transaccion'] = 0;
            foreach ($tipo_transaccion as $row) {
                $ano_eje          = $row->ano_eje;
                $tipo_transaccion = $row->tipo_transaccion;
                $descripcion      = $row->descripcion;
                $estado           = $row->estado;

                $this->DatosGenerales_Model->insert_tipo_transaccion($ano_eje, $tipo_transaccion, $descripcion, $estado);
                $data['tipo_transaccion']++;
            }

            $fuente_financ = $this->DatosGenerales_Model->fuente_financ($anio);
            $data['fuente_financ'] = 0;
            foreach ($fuente_financ as $row) {
                $ano_eje                = $row->ano_eje;
                $origen                 = $row->origen;
                $fuente_financ          = $row->fuente_financ;
                $nombre                 = $row->nombre;
                $estado                 = $row->estado;
                $ambito                 = $row->ambito;
                $es_presupuestal        = $row->es_presupuestal;
                $es_modificable         = $row->es_modificable;
                $fuente_financ_agregada = $row->fuente_financ_agregada;
                $es_pptm                = $row->es_pptm;

                $this->DatosGenerales_Model->insert_fuente_financ($ano_eje, $origen, $fuente_financ, $nombre, $estado, $ambito, $es_presupuestal, $es_modificable, $fuente_financ_agregada, $es_pptm);
                $data['fuente_financ']++;
            }

            $finalidad          = $this->DatosGenerales_Model->finalidad($anio);
            $data['finalidad'] = 0;
            foreach ($finalidad as $row) {
                $ano_eje         = $row->ano_eje;
                $finalidad       = $row->finalidad;
                $nombre          = $row->nombre;
                $estado          = $row->estado;
                $ambito          = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $ambito_en       = $row->ambito_en;
                $ambito_programa = $row->ambito_programa;
                $es_generico     = $row->es_generico;
                //if($contador_finalidad==1)
                $this->DatosGenerales_Model->insert_finalidad($ano_eje, $finalidad, $nombre, $estado, $ambito, $es_presupuestal, $ambito_en, $ambito_programa, $es_generico);
                $data['finalidad']++;
            }

            $act_proy_nombre = $this->DatosGenerales_Model->act_proy_nombre($anio);
            $data['act_proy_nombre'] = 0;
            foreach ($act_proy_nombre as $row) {                
                $ano_eje = $row->ano_eje;
                $act_proy = $row->act_proy;
                $tipo_act_proy = $row->tipo_act_proy;
                $nombre = $row->nombre;
                $estado = $row->estado;
                $ambito = $row->ambito;
                $es_presupuestal = $row->es_presupuestal;
                $sector_snip = $row->sector_snip;
                $naturaleza_snip = $row->naturaleza_snip;
                $intervencion_snip = $row->intervencion_snip;
                $tipo_proyecto = $row->tipo_proyecto;
                $proyecto_snip = $row->proyecto_snip;
                $ambito_en = $row->ambito_en;
                $es_foniprel = $row->es_foniprel;
                $ambito_programa = $row->ambito_programa;
                $es_generico = $row->es_generico;
                $costo_actual = $row->costo_actual;
                $costo_expediente = $row->costo_expediente;
                $costo_viabilidad = $row->costo_viabilidad;
                $ejecucion_ano_anterior = $row->ejecucion_ano_anterior;
                $ind_viabilidad= $row->ind_viabilidad;

                $this->DatosGenerales_Model->insert_act_proy_nombre($ano_eje, $act_proy, $tipo_act_proy, $nombre, $estado, $ambito, $es_presupuestal, $sector_snip, $naturaleza_snip, $intervencion_snip, $tipo_proyecto, $proyecto_snip, $ambito_en, $es_foniprel, $ambito_programa, $es_generico, $costo_actual, $costo_expediente, $costo_viabilidad, $ejecucion_ano_anterior, $ind_viabilidad);
                $data['act_proy_nombre']++;
            }

           // $this->db->trans_complete();

            $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;

        } catch (Exception $e) {
            //$this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }
	
	
	
	public function importar_expediente_fase($anio = null)
    {
		
		set_time_limit(0);
        ini_set('memory_limit', '-1');

        $data['mensaje']    = 'Hubo un problema en la base de datos error x0012595'+$anio;
        $data['actualizo']  = false;

        try {
			
			
			$conta=0;
			 	
            
			
			  $especifica_det = $this->DatosGenerales_Model->expediente_fase($anio);
            $data['especifica_det'] = 0;
            foreach ($especifica_det as $row) {

			
			$ano_eje          = $row->ano_eje;	
			$sec_ejec          = $row->sec_ejec;
			$expediente          = $row->expediente;	
			$ciclo          = $row->ciclo;
			$fase          = $row->fase;
			$secuencia          = $row->secuencia	;
			$secuencia_padre          = $row->secuencia_padre;
			$secuencia_anterior          = $row->secuencia_anterior;
			$mes_ctb          = $row->mes_ctb	;
			$monto_nacional          = $row->monto_nacional;
			$monto_saldo          = $row->monto_saldo;	
			$origen          = $row->origen;
			$fuente_financ          = $row->fuente_financ;
			$mejor_fecha          = $row->mejor_fecha;
			$tipo_id          = $row->tipo_id;
			$ruc          = $row->ruc;
			$tipo_pago          = $row->tipo_pago;
			$tipo_recurso          = $row->tipo_recurso;
			$tipo_compromiso          = $row->tipo_compromiso;	
			$organismo          = $row->organismo;
			$proyecto          = $row->proyecto;
			$estado          = $row->estado;	
			$estado_envio          = $row->estado_envio;
			$archivo          = $row->archivo;
			$tipo_giro          = $row->tipo_giro;
			$tipo_financiamiento          = $row->tipo_financiamiento;
			$cod_doc_ref          = $row->cod_doc_ref;
			$fecha_doc_ref          = $row->fecha_doc_ref;
			$num_doc_ref          = $row->num_doc_ref;
			$certificado          = $row->certificado;
			$certificado_secuencia          = $row->certificado_secuencia;
			$sec_ejec_ruc          = $row->sec_ejec_ruc;
			$sec_ejec_reciproca          = $row->sec_ejec_reciproca;
			$transferencia_financiera_id          = $row->transferencia_financiera_id;
			
			
				
				echo $conta."-".$expediente."-".$certificado."<br/>";
              $this->DatosGenerales_Model->insert_expediente_fase($ano_eje,	$sec_ejec,	$expediente,	$ciclo,	$fase,	$secuencia,	$secuencia_padre,	$secuencia_anterior,	$mes_ctb,	$monto_nacional,	$monto_saldo,	$origen,	$fuente_financ,	$mejor_fecha,	$tipo_id,	$ruc,	$tipo_pago,	$tipo_recurso,	$tipo_compromiso,	$organismo,	$proyecto,	$estado,	$estado_envio,	$archivo,	$tipo_giro,	$tipo_financiamiento,	$cod_doc_ref, $fecha_doc_ref,	$num_doc_ref,	$certificado,	$certificado_secuencia,	$sec_ejec_ruc,	$sec_ejec_reciproca,	$transferencia_financiera_id);
			 
			 
              
			  $conta++;
			  $data['especifica_det']++;
            }
				
		
			

			 $data['mensaje']            = 'Datos Generales del anio ' . $anio . ' fueron actualizados correctamente';
            $data['actualizo']          = true;
			
			
		 } catch (Exception $e) {
           // $this->db->trans_rollback();
            $data['mensaje'] = 'Proyectos no actualizados, ocurrio un error durante la actualizacion';
        }
		
		 //echo json_encode($data, JSON_FORCE_OBJECT);
		
	}
	
	
	

}
