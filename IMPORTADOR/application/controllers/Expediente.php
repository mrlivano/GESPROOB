<?php
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Content-Type, *");

defined('BASEPATH') or exit('No direct script access allowed');

class Expediente extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Expediente");
        //$this->load->model(Model_Expediente::class);
    }

    public function estado_expediente($ano_eje, $expediente, $sec_ejec)
    {
        switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }

        $long_exp = strlen($expediente);
        $cadena_ceros = '';
        for ($i=0; $i < (10-$long_exp); $i++) { 
            $cadena_ceros.='0';
        }

        $expediente =$cadena_ceros.$expediente;

        $data['expediente'] = $expediente;

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $data['mensaje']   = '';
        $data['actualizo'] = false;
        $nombre_proyecto   = '';

        //si existe exp -> CONTINUAR
        if (count($this->Model_Expediente->expediente($ano_eje, $expediente, $sec_ejec)) > 0) {
            try {
                $this->db->trans_start();

                $expediente_DATA = $this->Model_Expediente->expediente($ano_eje, $expediente, $sec_ejec);
                $this->Model_Expediente->del_expediente($ano_eje, $expediente, $sec_ejec);
                foreach ($expediente_DATA as $row) {
                    $ano_eje                   = $row->ano_eje;
                    $sec_ejec                  = $row->sec_ejec;
                    $expediente                = $row->expediente;
                    $mes_eje                   = $row->mes_eje;
                    $cod_doc                   = $row->cod_doc;
                    $num_doc                   = $row->num_doc;
                    $fecha_doc                 = $row->fecha_doc;
                    $fecha_ing                 = $row->fecha_ing;
                    $usuario_ing               = $row->usuario_ing;
                    $fecha_mod                 = $row->fecha_mod;
                    $usuario_mod               = $row->usuario_mod;
                    $tipo_operacion            = $row->tipo_operacion;
                    $sec_ejec2                 = $row->sec_ejec2;
                    $modalidad_compra          = $row->modalidad_compra;
                    $clase_menor_cuantia       = $row->clase_menor_cuantia;
                    $sec_area                  = $row->sec_area;
                    $flag_encargo              = $row->flag_encargo;
                    $expediente_encargante     = $row->expediente_encargante;
                    $cod_mensa                 = $row->cod_mensa;
                    $estado                    = $row->estado;
                    $estado_envio              = $row->estado_envio;
                    $archivo                   = $row->archivo;
                    $tipo_proceso              = $row->tipo_proceso;
                    $id_proceso                = $row->id_proceso;
                    $id_contrato               = $row->id_contrato;
                    $sec_ejec_contrato         = $row->sec_ejec_contrato;
                    $fase_contractual          = $row->fase_contractual;
                    $procedencia               = $row->procedencia;
                    $expediente_financiamiento = $row->expediente_financiamiento;

                    $this->Model_Expediente->ins_expediente($ano_eje, $sec_ejec, $expediente, $mes_eje, $cod_doc, $num_doc, $fecha_doc, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $tipo_operacion, $sec_ejec2, $modalidad_compra, $clase_menor_cuantia, $sec_area, $flag_encargo, $expediente_encargante, $cod_mensa, $estado, $estado_envio, $archivo, $tipo_proceso, $id_proceso, $id_contrato, $sec_ejec_contrato, $fase_contractual, $procedencia, $expediente_financiamiento);
                }

                /*$expediente_nota_DATA = $this->Model_Expediente->expediente_nota($ano_eje, $expediente, $sec_ejec);
                $this->Model_Expediente->del_expediente_nota($ano_eje, $expediente, $sec_ejec);
                foreach ($expediente_nota_DATA as $row) {
                    $ano_eje        = $row->ano_eje;
                    $sec_ejec       = $row->sec_ejec;
                    $expediente     = $row->expediente;
                    $ciclo          = $row->ciclo;
                    $fase           = $row->fase;
                    $secuencia      = $row->secuencia;
                    $secuencia_nota = $row->secuencia_nota;
                    $notas          = $row->notas;
                    $estado         = $row->estado;
                    $estado_envio   = $row->estado_envio;
                    $archivo        = $row->archivo;

                    $this->Model_Expediente->ins_expediente_nota($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_nota, $notas, $estado, $estado_envio, $archivo);
                }

                $expediente_fase_DATA = $this->Model_Expediente->expediente_fase($ano_eje, $expediente, $sec_ejec);
                $this->Model_Expediente->del_expediente_fase($ano_eje, $expediente, $sec_ejec);
                foreach ($expediente_fase_DATA as $row) {
                    $ano_eje                     = $row->ano_eje;
                    $sec_ejec                    = $row->sec_ejec;
                    $expediente                  = $row->expediente;
                    $ciclo                       = $row->ciclo;
                    $fase                        = $row->fase;
                    $secuencia                   = $row->secuencia;
                    $secuencia_padre             = $row->secuencia_padre;
                    $secuencia_anterior          = $row->secuencia_anterior;
                    $mes_ctb                     = $row->mes_ctb;
                    $monto_nacional              = $row->monto_nacional;
                    $monto_saldo                 = $row->monto_saldo;
                    $origen                      = $row->origen;
                    $fuente_financ               = $row->fuente_financ;
                    $mejor_fecha                 = $row->mejor_fecha;
                    $tipo_id                     = $row->tipo_id;
                    $ruc                         = $row->ruc;
                    $tipo_pago                   = $row->tipo_pago;
                    $tipo_recurso                = $row->tipo_recurso;
                    $tipo_compromiso             = $row->tipo_compromiso;
                    $organismo                   = $row->organismo;
                    $proyecto                    = $row->proyecto;
                    $estado                      = $row->estado;
                    $estado_envio                = $row->estado_envio;
                    $archivo                     = $row->archivo;
                    $tipo_giro                   = $row->tipo_giro;
                    $tipo_financiamiento         = $row->tipo_financiamiento;
                    $cod_doc_ref                 = $row->cod_doc_ref;
                    $fecha_doc_ref               = $row->fecha_doc_ref;
                    $num_doc_ref                 = $row->num_doc_ref;
                    $certificado                 = $row->certificado;
                    $certificado_secuencia       = $row->certificado_secuencia;
                    $sec_ejec_ruc                = $row->sec_ejec_ruc;
                    $sec_ejec_reciproca          = $row->sec_ejec_reciproca;
                    $transferencia_financiera_id = $row->transferencia_financiera_id;

                    $this->Model_Expediente->ins_expediente_fase($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_padre, $secuencia_anterior, $mes_ctb, $monto_nacional, $monto_saldo, $origen, $fuente_financ, $mejor_fecha, $tipo_id, $ruc, $tipo_pago, $tipo_recurso, $tipo_compromiso, $organismo, $proyecto, $estado, $estado_envio, $archivo, $tipo_giro, $tipo_financiamiento, $cod_doc_ref, $fecha_doc_ref, $num_doc_ref, $certificado, $certificado_secuencia, $sec_ejec_ruc, $sec_ejec_reciproca, $transferencia_financiera_id);
                }

                */

                
                $this->Model_Expediente->del_expediente_secuencia($ano_eje, $expediente, $sec_ejec);
                $expediente_secuencia_DATA = $this->Model_Expediente->expediente_secuencia($ano_eje, $expediente, $sec_ejec);
                foreach ($expediente_secuencia_DATA as $row) {
                    $ano_eje                   = $row->ano_eje;
                    $sec_ejec                  = $row->sec_ejec;
                    $expediente                = $row->expediente;
                    $ciclo                     = $row->ciclo;
                    $fase                      = $row->fase;
                    $secuencia                 = $row->secuencia;
                    $correlativo               = $row->correlativo;
                    $cod_doc                   = $row->cod_doc;
                    $num_doc                   = $row->num_doc;
                    $fecha_doc                 = $row->fecha_doc;
                    $moneda                    = $row->moneda;
                    $tipo_cambio               = $row->tipo_cambio;
                    $monto                     = $row->monto;
                    $monto_saldo               = $row->monto_saldo;
                    $monto_nacional            = $row->monto_nacional;
                    $monto_extranjero          = $row->monto_extranjero;
                    $fecha_ing                 = $row->fecha_ing;
                    $usuario_ing               = $row->usuario_ing;
                    $fecha_mod                 = $row->fecha_mod;
                    $usuario_mod               = $row->usuario_mod;
                    $num_record                = $row->num_record;
                    $serie_doc                 = $row->serie_doc;
                    $ano_proceso               = $row->ano_proceso;
                    $mes_proceso               = $row->mes_proceso;
                    $dia_proceso               = $row->dia_proceso;
                    $grupo                     = $row->grupo;
                    $edicion                   = $row->edicion;
                    $ano_cta_cte               = $row->ano_cta_cte;
                    $banco                     = $row->banco;
                    $cta_cte                   = $row->cta_cte;
                    $fecha_autorizacion        = $row->fecha_autorizacion;
                    $cod_mensa                 = $row->cod_mensa;
                    $estado_ctb                = $row->estado_ctb;
                    $estado_ctb_anterior       = $row->estado_ctb_anterior;
                    $estado                    = $row->estado;
                    $estado_anterior           = $row->estado_anterior;
                    $estado_envio              = $row->estado_envio;
                    $archivo                   = $row->archivo;
                    $reg_multiple              = $row->reg_multiple;
                    $cta_bco_ejec              = $row->cta_bco_ejec;
                    $flg_interfase             = $row->flg_interfase;
                    $ind_contabiliza           = $row->ind_contabiliza;
                    $tipo_cambio_ps            = $row->tipo_cambio_ps;
                    $sec_proceso               = $row->sec_proceso;
                    $cod_doc_b                 = $row->cod_doc_b;
                    $fecha_doc_b               = $row->fecha_doc_b;
                    $num_doc_b                 = $row->num_doc_b;
                    $fecha_bd_oracle           = $row->fecha_bd_oracle;
                    $mes_afectacion_calendario = $row->mes_afectacion_calendario;
                    $secuencia_solicitud       = $row->secuencia_solicitud;
                    $fecha_creacion_clt        = $row->fecha_creacion_clt;
                    $fecha_modificacion_clt    = $row->fecha_modificacion_clt;
                    $usuario_creacion_clt      = $row->usuario_creacion_clt;
                    $usuario_modificacion_clt  = $row->usuario_modificacion_clt;
                    $fecha_autorizacion_giro   = $row->fecha_autorizacion_giro;
                    $verifica_1                = $row->verifica_1;
                    $secuencia_transferencia   = $row->secuencia_transferencia;
                    $transferencia             = $row->transferencia;

                    $this->Model_Expediente->ins_expediente_secuencia($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $cod_doc, $num_doc, $fecha_doc, $moneda, $tipo_cambio, $monto, $monto_saldo, $monto_nacional, $monto_extranjero, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $num_record, $serie_doc, $ano_proceso, $mes_proceso, $dia_proceso, $grupo, $edicion, $ano_cta_cte, $banco, $cta_cte, $fecha_autorizacion, $cod_mensa, $estado_ctb, $estado_ctb_anterior, $estado, $estado_anterior, $estado_envio, $archivo, $reg_multiple, $cta_bco_ejec, $flg_interfase, $ind_contabiliza, $tipo_cambio_ps, $sec_proceso, $cod_doc_b, $fecha_doc_b, $num_doc_b, $fecha_bd_oracle, $mes_afectacion_calendario, $secuencia_solicitud, $fecha_creacion_clt, $fecha_modificacion_clt, $usuario_creacion_clt, $usuario_modificacion_clt, $fecha_autorizacion_giro, $verifica_1, $secuencia_transferencia, $transferencia);
                }                

                $tipo_operacion_DATA = $this->Model_Expediente->tipo_operacion($ano_eje);
                $this->Model_Expediente->del_tipo_operacion($ano_eje);
                foreach ($tipo_operacion_DATA as $row) {
                    $ano_eje                 = $row->ano_eje;
                    $tipo_operacion          = $row->tipo_operacion;
                    $nombre                  = $row->nombre;
                    $ambito                  = $row->ambito;
                    $descripcion_abreviada   = $row->descripcion_abreviada;
                    $fecha_generacion        = $row->fecha_generacion;
                    $estado                  = $row->estado;
                    $ciclo                   = $row->ciclo;
                    $es_compromiso_anual     = $row->es_compromiso_anual;
                    $es_ft                   = $row->es_ft;
                    $es_sunat                = $row->es_sunat;
                    $es_reciproca            = $row->es_reciproca;
                    $es_reciproca_compromiso = $row->es_reciproca_compromiso;

                    $this->Model_Expediente->ins_tipo_operacion($ano_eje, $tipo_operacion, $nombre, $ambito, $descripcion_abreviada, $fecha_generacion, $estado, $ciclo, $es_compromiso_anual, $es_ft, $es_sunat, $es_reciproca, $es_reciproca_compromiso);
                }

                $this->db->trans_complete();
                $data['mensaje']   = 'Expediente ' . $expediente . ' del anio ' . $ano_eje . ' fue actualizado correctamente';
                $data['actualizo'] = true;

            } catch (Exception $e) {
                $this->db->trans_rollback();
                $data['mensaje'] = 'ERROR, Proyecto ' . $CodigoUnico . ' no pudo ser Actualizado, ocurrio un error durante la actualizacion';
            }

        } else {
            $data['mensaje'] = 'ERROR, Expediente no existe';
        }
        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    public function expediente_meta($ano_eje, $sec_ejec)
    {
        switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $data['mensaje']   = '';
        $data['actualizo'] = false;
        $nombre_proyecto   = '';

        try {
    
            $this->db->trans_start();                

            $this->Model_Expediente->del_expediente_meta($ano_eje);
            $expediente_meta_DATA = $this->Model_Expediente->expediente_meta($ano_eje);
            foreach ($expediente_meta_DATA as $row)
            {
                $ano_eje                   = $row->ano_eje;
                $sec_ejec                  = $row->sec_ejec;
                $expediente                = $row->expediente;
                $ciclo                     = $row->ciclo;
                $fase                      = $row->fase;
                $secuencia                 = $row->secuencia;
                $correlativo               = $row->correlativo;
                $categ_gasto               = $row->categ_gasto;
                $grupo_gasto               = $row->grupo_gasto;
                $modalidad_gasto           = $row->modalidad_gasto;  
                $elemento_gasto            = $row->elemento_gasto;
                $sec_func                  = $row->sec_func;                        
                $monto                     = $row->monto;
                $monto_saldo               = $row->monto_saldo;
                $monto_nacional            = $row->monto_nacional;
                $ind_proceso               = $row->ind_proceso;
                $edicion                   = $row->edicion;
                $estado                    = $row->estado;
                $estado_envio              = $row->estado_envio;
                $archivo                   = $row->archivo;
                $id_clasificador           = $row->id_clasificador;

                $this->Model_Expediente->ins_expediente_meta($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $sec_func, $monto, $monto_saldo, $monto_nacional, $ind_proceso, $edicion, $estado, $estado_envio, $archivo, $id_clasificador);
            }

            $this->db->trans_complete();
            $data['mensaje']   = 'Expediente Meta del anio ' . $ano_eje . ' fue actualizado correctamente';
            $data['actualizo'] = true;

        } 
        catch (Exception $e) 
        {
            $this->db->trans_rollback();
            $data['mensaje'] = 'Expediente Meta del anio ' . $ano_eje . ' no pudo ser Actualizado, ocurrio un error durante la actualizacion';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }

	public function expediente_meta22()
    {
		$ano_eje="2017";
		$sec_ejec ="300251";
        switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $data['mensaje']   = '';
        $data['actualizo'] = false;
        $nombre_proyecto   = '';

        try {
    
            $this->db->trans_start();                

            $this->Model_Expediente->del_expediente_meta($ano_eje);
            $expediente_meta_DATA = $this->Model_Expediente->expediente_meta($ano_eje);
            foreach ($expediente_meta_DATA as $row)
            {
                $ano_eje                   = $row->ano_eje;
                $sec_ejec                  = $row->sec_ejec;
                $expediente                = $row->expediente;
                $ciclo                     = $row->ciclo;
                $fase                      = $row->fase;
                $secuencia                 = $row->secuencia;
                $correlativo               = $row->correlativo;
                $categ_gasto               = $row->categ_gasto;
                $grupo_gasto               = $row->grupo_gasto;
                $modalidad_gasto           = $row->modalidad_gasto;  
                $elemento_gasto            = $row->elemento_gasto;
                $sec_func                  = $row->sec_func;                        
                $monto                     = $row->monto;
                $monto_saldo               = $row->monto_saldo;
                $monto_nacional            = $row->monto_nacional;
                $ind_proceso               = $row->ind_proceso;
                $edicion                   = $row->edicion;
                $estado                    = $row->estado;
                $estado_envio              = $row->estado_envio;
                $archivo                   = $row->archivo;
                $id_clasificador           = $row->id_clasificador;
				
				echo $ano_eje ." ".$sec_ejec." ".$expediente."<br/>";
                //$this->Model_Expediente->ins_expediente_meta($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $sec_func, $monto, $monto_saldo, $monto_nacional, $ind_proceso, $edicion, $estado, $estado_envio, $archivo, $id_clasificador);
            }

            $this->db->trans_complete();
            $data['mensaje']   = 'Expediente Meta del anio ' . $ano_eje . ' fue actualizado correctamente';
            $data['actualizo'] = true;

        } 
        catch (Exception $e) 
        {
            $this->db->trans_rollback();
            $data['mensaje'] = 'Expediente Meta del anio ' . $ano_eje . ' no pudo ser Actualizado, ocurrio un error durante la actualizacion';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
    }
	
    public function expedienteGeneral($ano_eje,$sec_ejec)
    {
        switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $data['mensaje']   = '';
        $data['actualizo'] = false;
        $nombre_proyecto   = '';

        $expediente_DATA = $this->Model_Expediente->expedienteGeneral($ano_eje, $sec_ejec);

        if (count($expediente_DATA) > 0) 
        {
            try 
            {
                $this->db->trans_start();
                $this->Model_Expediente->del_expediente($ano_eje, 'general', $sec_ejec);
                foreach ($expediente_DATA as $row) 
                {
                    $ano_eje                   = $row->ano_eje;
                    $sec_ejec                  = $row->sec_ejec;
                    $expediente                = $row->expediente;
                    $mes_eje                   = $row->mes_eje;
                    $cod_doc                   = $row->cod_doc;
                    $num_doc                   = $row->num_doc;
                    $fecha_doc                 = $row->fecha_doc;
                    $fecha_ing                 = $row->fecha_ing;
                    $usuario_ing               = $row->usuario_ing;
                    $fecha_mod                 = $row->fecha_mod;
                    $usuario_mod               = $row->usuario_mod;
                    $tipo_operacion            = $row->tipo_operacion;
                    $sec_ejec2                 = $row->sec_ejec2;
                    $modalidad_compra          = $row->modalidad_compra;
                    $clase_menor_cuantia       = $row->clase_menor_cuantia;
                    $sec_area                  = $row->sec_area;
                    $flag_encargo              = $row->flag_encargo;
                    $expediente_encargante     = $row->expediente_encargante;
                    $cod_mensa                 = $row->cod_mensa;
                    $estado                    = $row->estado;
                    $estado_envio              = $row->estado_envio;
                    $archivo                   = $row->archivo;
                    $tipo_proceso              = $row->tipo_proceso;
                    $id_proceso                = $row->id_proceso;
                    $id_contrato               = $row->id_contrato;
                    $sec_ejec_contrato         = $row->sec_ejec_contrato;
                    $fase_contractual          = $row->fase_contractual;
                    $procedencia               = $row->procedencia;
                    $expediente_financiamiento = $row->expediente_financiamiento;

                    $this->Model_Expediente->ins_expediente($ano_eje, $sec_ejec, $expediente, $mes_eje, $cod_doc, $num_doc, $fecha_doc, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $tipo_operacion, $sec_ejec2, $modalidad_compra, $clase_menor_cuantia, $sec_area, $flag_encargo, $expediente_encargante, $cod_mensa, $estado, $estado_envio, $archivo, $tipo_proceso, $id_proceso, $id_contrato, $sec_ejec_contrato, $fase_contractual, $procedencia, $expediente_financiamiento);
                }

                /*$expediente_nota_DATA = $this->Model_Expediente->expediente_nota($ano_eje, 'general', $sec_ejec);
                $this->Model_Expediente->del_expediente_nota($ano_eje, 'general', $sec_ejec);
                foreach ($expediente_nota_DATA as $row) 
                {
                    $ano_eje        = $row->ano_eje;
                    $sec_ejec       = $row->sec_ejec;
                    $expediente     = $row->expediente;
                    $ciclo          = $row->ciclo;
                    $fase           = $row->fase;
                    $secuencia      = $row->secuencia;
                    $secuencia_nota = $row->secuencia_nota;
                    $notas          = $row->notas;
                    $estado         = $row->estado;
                    $estado_envio   = $row->estado_envio;
                    $archivo        = $row->archivo;

                    $this->Model_Expediente->ins_expediente_nota($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_nota, $notas, $estado, $estado_envio, $archivo);
                }

                $expediente_fase_DATA = $this->Model_Expediente->expediente_fase($ano_eje, 'general', $sec_ejec);
                $this->Model_Expediente->del_expediente_fase($ano_eje, 'general', $sec_ejec);
                foreach ($expediente_fase_DATA as $row) 
                {
                    $ano_eje                     = $row->ano_eje;
                    $sec_ejec                    = $row->sec_ejec;
                    $expediente                  = $row->expediente;
                    $ciclo                       = $row->ciclo;
                    $fase                        = $row->fase;
                    $secuencia                   = $row->secuencia;
                    $secuencia_padre             = $row->secuencia_padre;
                    $secuencia_anterior          = $row->secuencia_anterior;
                    $mes_ctb                     = $row->mes_ctb;
                    $monto_nacional              = $row->monto_nacional;
                    $monto_saldo                 = $row->monto_saldo;
                    $origen                      = $row->origen;
                    $fuente_financ               = $row->fuente_financ;
                    $mejor_fecha                 = $row->mejor_fecha;
                    $tipo_id                     = $row->tipo_id;
                    $ruc                         = $row->ruc;
                    $tipo_pago                   = $row->tipo_pago;
                    $tipo_recurso                = $row->tipo_recurso;
                    $tipo_compromiso             = $row->tipo_compromiso;
                    $organismo                   = $row->organismo;
                    $proyecto                    = $row->proyecto;
                    $estado                      = $row->estado;
                    $estado_envio                = $row->estado_envio;
                    $archivo                     = $row->archivo;
                    $tipo_giro                   = $row->tipo_giro;
                    $tipo_financiamiento         = $row->tipo_financiamiento;
                    $cod_doc_ref                 = $row->cod_doc_ref;
                    $fecha_doc_ref               = $row->fecha_doc_ref;
                    $num_doc_ref                 = $row->num_doc_ref;
                    $certificado                 = $row->certificado;
                    $certificado_secuencia       = $row->certificado_secuencia;
                    $sec_ejec_ruc                = $row->sec_ejec_ruc;
                    $sec_ejec_reciproca          = $row->sec_ejec_reciproca;
                    $transferencia_financiera_id = $row->transferencia_financiera_id;

                    $this->Model_Expediente->ins_expediente_fase($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_padre, $secuencia_anterior, $mes_ctb, $monto_nacional, $monto_saldo, $origen, $fuente_financ, $mejor_fecha, $tipo_id, $ruc, $tipo_pago, $tipo_recurso, $tipo_compromiso, $organismo, $proyecto, $estado, $estado_envio, $archivo, $tipo_giro, $tipo_financiamiento, $cod_doc_ref, $fecha_doc_ref, $num_doc_ref, $certificado, $certificado_secuencia, $sec_ejec_ruc, $sec_ejec_reciproca, $transferencia_financiera_id);
                }
                */

                
                $this->Model_Expediente->del_expediente_secuencia($ano_eje, 'general', $sec_ejec);
                $expediente_secuencia_DATA = $this->Model_Expediente->expediente_secuencia($ano_eje, 'general', $sec_ejec);
                foreach ($expediente_secuencia_DATA as $row) 
                {
                    $ano_eje                   = $row->ano_eje;
                    $sec_ejec                  = $row->sec_ejec;
                    $expediente                = $row->expediente;
                    $ciclo                     = $row->ciclo;
                    $fase                      = $row->fase;
                    $secuencia                 = $row->secuencia;
                    $correlativo               = $row->correlativo;
                    $cod_doc                   = $row->cod_doc;
                    $num_doc                   = $row->num_doc;
                    $fecha_doc                 = $row->fecha_doc;
                    $moneda                    = $row->moneda;
                    $tipo_cambio               = $row->tipo_cambio;
                    $monto                     = $row->monto;
                    $monto_saldo               = $row->monto_saldo;
                    $monto_nacional            = $row->monto_nacional;
                    $monto_extranjero          = $row->monto_extranjero;
                    $fecha_ing                 = $row->fecha_ing;
                    $usuario_ing               = $row->usuario_ing;
                    $fecha_mod                 = $row->fecha_mod;
                    $usuario_mod               = $row->usuario_mod;
                    $num_record                = $row->num_record;
                    $serie_doc                 = $row->serie_doc;
                    $ano_proceso               = $row->ano_proceso;
                    $mes_proceso               = $row->mes_proceso;
                    $dia_proceso               = $row->dia_proceso;
                    $grupo                     = $row->grupo;
                    $edicion                   = $row->edicion;
                    $ano_cta_cte               = $row->ano_cta_cte;
                    $banco                     = $row->banco;
                    $cta_cte                   = $row->cta_cte;
                    $fecha_autorizacion        = $row->fecha_autorizacion;
                    $cod_mensa                 = $row->cod_mensa;
                    $estado_ctb                = $row->estado_ctb;
                    $estado_ctb_anterior       = $row->estado_ctb_anterior;
                    $estado                    = $row->estado;
                    $estado_anterior           = $row->estado_anterior;
                    $estado_envio              = $row->estado_envio;
                    $archivo                   = $row->archivo;
                    $reg_multiple              = $row->reg_multiple;
                    $cta_bco_ejec              = $row->cta_bco_ejec;
                    $flg_interfase             = $row->flg_interfase;
                    $ind_contabiliza           = $row->ind_contabiliza;
                    $tipo_cambio_ps            = $row->tipo_cambio_ps;
                    $sec_proceso               = $row->sec_proceso;
                    $cod_doc_b                 = $row->cod_doc_b;
                    $fecha_doc_b               = $row->fecha_doc_b;
                    $num_doc_b                 = $row->num_doc_b;
                    $fecha_bd_oracle           = $row->fecha_bd_oracle;
                    $mes_afectacion_calendario = $row->mes_afectacion_calendario;
                    $secuencia_solicitud       = $row->secuencia_solicitud;
                    $fecha_creacion_clt        = $row->fecha_creacion_clt;
                    $fecha_modificacion_clt    = $row->fecha_modificacion_clt;
                    $usuario_creacion_clt      = $row->usuario_creacion_clt;
                    $usuario_modificacion_clt  = $row->usuario_modificacion_clt;
                    $fecha_autorizacion_giro   = $row->fecha_autorizacion_giro;
                    $verifica_1                = $row->verifica_1;
                    $secuencia_transferencia   = $row->secuencia_transferencia;
                    $transferencia             = $row->transferencia;

                    $this->Model_Expediente->ins_expediente_secuencia($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $cod_doc, $num_doc, $fecha_doc, $moneda, $tipo_cambio, $monto, $monto_saldo, $monto_nacional, $monto_extranjero, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $num_record, $serie_doc, $ano_proceso, $mes_proceso, $dia_proceso, $grupo, $edicion, $ano_cta_cte, $banco, $cta_cte, $fecha_autorizacion, $cod_mensa, $estado_ctb, $estado_ctb_anterior, $estado, $estado_anterior, $estado_envio, $archivo, $reg_multiple, $cta_bco_ejec, $flg_interfase, $ind_contabiliza, $tipo_cambio_ps, $sec_proceso, $cod_doc_b, $fecha_doc_b, $num_doc_b, $fecha_bd_oracle, $mes_afectacion_calendario, $secuencia_solicitud, $fecha_creacion_clt, $fecha_modificacion_clt, $usuario_creacion_clt, $usuario_modificacion_clt, $fecha_autorizacion_giro, $verifica_1, $secuencia_transferencia, $transferencia);
                }                

                $tipo_operacion_DATA = $this->Model_Expediente->tipo_operacion($ano_eje);
                $this->Model_Expediente->del_tipo_operacion($ano_eje);
                foreach ($tipo_operacion_DATA as $row) 
                {
                    $ano_eje                 = $row->ano_eje;
                    $tipo_operacion          = $row->tipo_operacion;
                    $nombre                  = $row->nombre;
                    $ambito                  = $row->ambito;
                    $descripcion_abreviada   = $row->descripcion_abreviada;
                    $fecha_generacion        = $row->fecha_generacion;
                    $estado                  = $row->estado;
                    $ciclo                   = $row->ciclo;
                    $es_compromiso_anual     = $row->es_compromiso_anual;
                    $es_ft                   = $row->es_ft;
                    $es_sunat                = $row->es_sunat;
                    $es_reciproca            = $row->es_reciproca;
                    $es_reciproca_compromiso = $row->es_reciproca_compromiso;

                    $this->Model_Expediente->ins_tipo_operacion($ano_eje, $tipo_operacion, $nombre, $ambito, $descripcion_abreviada, $fecha_generacion, $estado, $ciclo, $es_compromiso_anual, $es_ft, $es_sunat, $es_reciproca, $es_reciproca_compromiso);
                }

                $this->db->trans_complete();
                $data['mensaje']   = 'Los Expedientes del anio ' . $ano_eje . ' fuerón actualizado correctamente';
                $data['actualizo'] = true;

            } 
            catch (Exception $e) 
            {
                $this->db->trans_rollback();
                $data['mensaje'] = 'ERROR, ocurrio un error durante la actualizacion';
            }
        } 
        else 
        {
            $data['mensaje'] = 'ERROR';
        }
        echo json_encode($data, JSON_FORCE_OBJECT);
    }

    /*public function andahuaylas($ano_eje,$sec_ejec)
    {
         switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }
        
        $data['meta'] = 0;
        $meta_DATA  = $this->Model_Expediente->meta($anio, $unidad_ejec);
        foreach ($meta_DATA as $itemp) {
            $ano_eje                        = $itemp->ano_eje;
            $sec_ejec                       = $itemp->sec_ejec;
            $sec_func                       = $itemp->sec_func;
            $funcion                        = $itemp->funcion;
            $programa                       = $itemp->programa;
            $sub_programa                   = $itemp->sub_programa;
            $act_proy                       = $itemp->act_proy;
            $componente                     = $itemp->componente;
            $meta                           = $itemp->meta;
            $finalidad                      = $itemp->finalidad;
            $nombre                         = $itemp->nombre;
            $monto                          = $itemp->monto;
            $cantidad                       = $itemp->cantidad;
            $unidad_med                     = $itemp->unidad_med;
            $departamento                   = $itemp->departamento;
            $provincia                      = $itemp->provincia;
            $fecha_ing                      = $itemp->fecha_ing;
            $usuario_ing                    = $itemp->usuario_ing;
            $fecha_mod                      = $itemp->fecha_mod;
            $usuario_mod                    = $itemp->usuario_mod;
            $estado                         = $itemp->estado;
            $distrito                       = $itemp->distrito;
            $unidad_medida                  = $itemp->unidad_medida;
            $cantidad_inicial               = $itemp->cantidad_inicial;
            $unidad_medida_inicial          = $itemp->unidad_medida_inicial;
            $es_pia                         = $itemp->es_pia;
            $cantidad_semestral             = $itemp->cantidad_semestral;
            $cantidad_semestral_inicial     = $itemp->cantidad_semestral_inicial;
            $estrategia_nacional            = $itemp->estrategia_nacional;
            $programa_ppto                  = $itemp->programa_ppto;
            $cantidad_trimestral_01         = $itemp->cantidad_trimestral_01;
            $cantidad_trimestral_01_inicial = $itemp->cantidad_trimestral_01_inicial;
            $cantidad_trimestral_03         = $itemp->cantidad_trimestral_03;
            $cantidad_trimestral_03_inicial = $itemp->cantidad_trimestral_03_inicial;
            $this->Model_Expediente->insert_Meta($ano_eje, $sec_ejec, $sec_func, $funcion, $programa, $sub_programa, $act_proy, $componente, $meta, $finalidad, $nombre, $monto, $cantidad, $unidad_med, $departamento,
                $provincia, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $estado, $distrito, $unidad_medida, $cantidad_inicial, $unidad_medida_inicial, $es_pia, $cantidad_semestral,
                $cantidad_semestral_inicial, $estrategia_nacional, $programa_ppto, $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
                $cantidad_trimestral_03_inicial);
            $data['meta'] ++;
        }

        $data['gasto_acumulado'] = 0;
        $gasto_acumulado_DATA      = $this->Model_Expediente->gasto_acumulado($anio);
        foreach ($gasto_acumulado_DATA as $itemp) {
            $ano_eje                   = $itemp->ano_eje;
            $sec_ejec                  = $itemp->sec_ejec;
            $origen                    = $itemp->origen;
            $fuente_financ             = $itemp->fuente_financ;
            $tipo_recurso              = $itemp->tipo_recurso;
            $sec_func                  = $itemp->sec_func;
            $categ_gasto               = $itemp->categ_gasto;
            $grupo_gasto               = $itemp->grupo_gasto;
            $modalidad_gasto           = $itemp->modalidad_gasto;
            $elemento_gasto            = $itemp->elemento_gasto;
            $mes                       = $itemp->mes;
            $trimestre                 = $itemp->trimestre;
            $programacion              = $itemp->programacion;
            $calendario                = $itemp->calendario;
            $ejecucion                 = $itemp->ejecucion;
            $monto_a_aprobado          = $itemp->monto_a_aprobado;
            $monto_a_solicitado        = $itemp->monto_a_solicitado;
            $monto_a_interno           = $itemp->monto_a_interno;
            $monto_de_aprobado         = $itemp->monto_de_aprobado;
            $monto_de_solicitado       = $itemp->monto_de_solicitado;
            $monto_de_interno          = $itemp->monto_de_interno;
            $archivo                   = $itemp->archivo;
            $calendario_ampliacion     = $itemp->calendario_ampliacion;
            $calendario_actualizacion  = $itemp->calendario_actualizacion;
            $calendario_ampliacion_dst = $itemp->calendario_ampliacion_dst;
            $calendario_flexible       = $itemp->calendario_flexible;
            $id_clasificador           = $itemp->id_clasificador;
            $pptm                      = $itemp->pptm;
            $compromiso                = $itemp->compromiso;
            $devengado                 = $itemp->devengado;
            $girado                    = $itemp->girado;
            $pagado                    = $itemp->pagado;

            $this->Model_Expediente->insert_Gasto_acumulado($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso,
                $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto,
                $mes, $trimestre, $programacion, $calendario, $ejecucion,
                $monto_a_aprobado, $monto_a_solicitado, $monto_a_interno, $monto_de_aprobado,
                $monto_de_solicitado, $monto_de_interno, $archivo, $calendario_ampliacion,
                $calendario_actualizacion, $calendario_ampliacion_dst, $calendario_flexible, $id_clasificador,
                $pptm, $compromiso, $devengado, $girado, $pagado);
            $data['gasto_acumulado']++;
        }

        $data['gasto'] = 0;
        $gasto = $this->Model_Expediente->gasto($anio);
        foreach ($gasto as $itemp) 
        {
            $ano_eje                  = $itemp->ano_eje;
            $sec_ejec                 = $itemp->sec_ejec;
            $origen                   = $itemp->origen;
            $fuente_financ            = $itemp->fuente_financ;
            $tipo_recurso             = $itemp->tipo_recurso;
            $sec_func                 = $itemp->sec_func;
            $categ_gasto              = $itemp->categ_gasto;
            $grupo_gasto              = $itemp->grupo_gasto;
            $modalidad_gasto          = $itemp->modalidad_gasto;
            $elemento_gasto           = $itemp->elemento_gasto;
            $presupuesto              = $itemp->presupuesto;
            $m01                      = $itemp->m01;
            $m02                      = $itemp->m02;
            $m03                      = $itemp->m03;
            $m04                      = $itemp->m04;
            $m05                      = $itemp->m05;
            $m06                      = $itemp->m06;
            $m07                      = $itemp->m07;
            $m08                      = $itemp->m08;
            $m09                      = $itemp->m09;
            $m10                      = $itemp->m10;
            $m11                      = $itemp->m11;
            $m12                      = $itemp->m12;
            $modificacion             = $itemp->modificacion;
            $ejecucion                = $itemp->ejecucion;
            $monto_a_solicitado       = $itemp->monto_a_solicitado;
            $monto_de_solicitado      = $itemp->monto_de_solicitado;
            $ampliacion               = $itemp->ampliacion;
            $credito                  = $itemp->credito;
            $id_clasificador          = $itemp->id_clasificador;
            $monto_financ1            = $itemp->monto_financ1;
            $monto_financ2            = $itemp->monto_financ2;
            $compromiso               = $itemp->compromiso;
            $devengado                = $itemp->devengado;
            $girado                   = $itemp->girado;
            $pagado                   = $itemp->pagado;
            $monto_certificado        = $itemp->monto_certificado;
            $monto_comprometido_anual = $itemp->monto_comprometido_anual;
            $monto_precertificado     = $itemp->monto_precertificado;

            $this->Model_Expediente->insert_Gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08, $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion, $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado, $monto_certificado, $monto_comprometido_anual, $monto_precertificado);
            $data['gasto'] ++;
        }
    }*/

    public function gastoGeneral($ano_eje, $sec_ejec)
    {
        switch ($sec_ejec) 
        {
            case '300251':
                $this->config->set_item('odbc_active_record', 'SIAF');
                $this->config->set_item('active_record', 'DBSIAF');
                break;
            case '000748':
                $this->config->set_item('odbc_active_record', 'SIAF_ANDAHUAYLAS');
                $this->config->set_item('active_record', 'DBSIAF_ANDA');
                break;
            case '001359':
                $this->config->set_item('odbc_active_record', 'SIAF_CHINCHEROS');
                $this->config->set_item('active_record', 'DBSIAF_CHINC');
                break;
            case '001546':
                $this->config->set_item('odbc_active_record', 'SIAF_COTABAMBAS');
                $this->config->set_item('active_record', 'DBSIAF_COTAB');
                break;
        }

        set_time_limit(0);
        ini_set('memory_limit', '-1');
        $data['mensaje']   = '';
        $data['actualizo'] = false;
        try 
        {    
            $this->db->trans_start();             
            $data['gasto'] = 0;
            $eliminado=$this->Model_Expediente->del_gasto($ano_eje);
            $gasto = $this->Model_Expediente->gasto($ano_eje);
            //echo "<pre>";
            //var_dump($gasto);
            //echo "</pre>";
            foreach ($gasto as $itemp) 
            {
                $ano_eje                  = $itemp->ano_eje;
                $sec_ejec                 = $itemp->sec_ejec;
                $origen                   = $itemp->origen;
                $fuente_financ            = $itemp->fuente_financ;
                $tipo_recurso             = $itemp->tipo_recurso;
                $sec_func                 = $itemp->sec_func;
                $categ_gasto              = $itemp->categ_gasto;
                $grupo_gasto              = $itemp->grupo_gasto;
                $modalidad_gasto          = $itemp->modalidad_gasto;
                $elemento_gasto           = $itemp->elemento_gasto;
                $presupuesto              = $itemp->presupuesto;
                $m01                      = $itemp->m01;
                $m02                      = $itemp->m02;
                $m03                      = $itemp->m03;
                $m04                      = $itemp->m04;
                $m05                      = $itemp->m05;
                $m06                      = $itemp->m06;
                $m07                      = $itemp->m07;
                $m08                      = $itemp->m08;
                $m09                      = $itemp->m09;
                $m10                      = $itemp->m10;
                $m11                      = $itemp->m11;
                $m12                      = $itemp->m12;
                $modificacion             = $itemp->modificacion;
                $ejecucion                = $itemp->ejecucion;
                $monto_a_solicitado       = $itemp->monto_a_solicitado;
                $monto_de_solicitado      = $itemp->monto_de_solicitado;
                $ampliacion               = $itemp->ampliacion;
                $credito                  = $itemp->credito;
                $id_clasificador          = $itemp->id_clasificador;
                $monto_financ1            = $itemp->monto_financ1;
                $monto_financ2            = $itemp->monto_financ2;
                $compromiso               = $itemp->compromiso;
                $devengado                = $itemp->devengado;
                $girado                   = $itemp->girado;
                $pagado                   = $itemp->pagado;
                $monto_certificado        = $itemp->monto_certificado;
                $monto_comprometido_anual = $itemp->monto_comprometido_anual;
                $monto_precertificado     = $itemp->monto_precertificado;

                $this->Model_Expediente->ins_gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, $m02, $m03, $m04, $m05, $m06, $m07, $m08, $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion, $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado, $monto_certificado, $monto_comprometido_anual, $monto_precertificado);
                $data['gasto'] ++;
            }

            $this->db->trans_complete();
            
            $data['mensaje']   = 'Gasto del anio ' . $ano_eje . ' de la Unidad Ejecutora '.$sec_ejec.' fue actualizado correctamente';
            $data['actualizo'] = true;
            $data['cantidad'] = $eliminado;

        } 
        catch (Exception $e) 
        {
            $this->db->trans_rollback();
            $data['mensaje'] = 'Ocurrio un error durante la actualizacion';
        }

        echo json_encode($data, JSON_FORCE_OBJECT);



        

    }
}
