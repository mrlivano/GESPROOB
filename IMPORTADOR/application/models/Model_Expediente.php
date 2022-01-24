<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Model_Expediente extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function expediente($ano_eje, $expediente, $sec_ejec)

    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select *
                  from expediente where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
        return $data->result();
    }

    public function expedienteGeneral($ano_eje,$sec_ejec)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select * from expediente where ano_eje='".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
        return $data->result();
    }

    public function expediente_nota($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data = $db_prueba->query("select * from expediente_nota where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data      = $db_prueba->query("select *
                  from expediente_nota where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        }                   
    }

    public function expediente_fase($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data      = $db_prueba->query("select * from expediente_fase where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data      = $db_prueba->query("select *
                      from expediente_fase where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        }        
    }

    public function expediente_secuencia($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data      = $db_prueba->query("select * from expediente_secuencia where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
            $data      = $db_prueba->query("select *
                      from expediente_secuencia where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return $data->result();
        } 
    }

    public function tipo_operacion($ano_eje)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select *
                  from tipo_operacion where ano_eje = '" . $ano_eje . "'");
        return $data->result();
    }

    public function expediente_meta($ano_eje)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select * from expediente_meta where ano_eje = '" . $ano_eje. "'");
        return $data->result();
		
    }

    public function meta($ano_eje, $sec_ejec)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select * from meta where ano_eje = '" . $ano_eje. "'");
        return $data->result();        
    }

    public function gasto_acumulado($ano_eje, $sec_ejec)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select * from gasto_acumulado where ano_eje = '" . $ano_eje. "'");
        return $data->result();        
    }

    /*-----------------------GASTO---------------------*/

    public function gasto($ano_eje)
    {
        $db_prueba = $this->load->database($this->config->item('odbc_active_record'), true);
        $data      = $db_prueba->query("select * from gasto where ano_eje = '" . $ano_eje. "'");
        return $data->result();        
    }

    public function ins_gasto($ano_eje, $sec_ejec, $origen, $fuente_financ, $tipo_recurso, $sec_func, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $presupuesto, $m01, 
        $m02, $m03, $m04, $m05, $m06, $m07, $m08, $m09, $m10, $m11, $m12, $modificacion, $ejecucion, $monto_a_solicitado, $monto_de_solicitado, $ampliacion, $credito, $id_clasificador, $monto_financ1, $monto_financ2, $compromiso, $devengado, $girado, $pagado, $monto_certificado, $monto_comprometido_anual, $monto_precertificado)

    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[gasto]
           ([ano_eje], [sec_ejec], [origen], [fuente_financ], [tipo_recurso], [sec_func], [categ_gasto], [grupo_gasto], [modalidad_gasto], [elemento_gasto], [presupuesto], [m01], [m02], [m03], [m04], [m05], [m06], [m07], [m08], [m09], [m10], [m11], [m12], [modificacion], [ejecucion], [monto_a_solicitado], [monto_de_solicitado], [ampliacion], [credito], [id_clasificador], [monto_financ1], [monto_financ2], [compromiso], [devengado], [girado], [pagado], [monto_certificado], [monto_comprometido_anual], [monto_precertificado])
        VALUES(
                '$ano_eje', '$sec_ejec', '$origen', '$fuente_financ', '$tipo_recurso', '$sec_func', '$categ_gasto', '$grupo_gasto', '$modalidad_gasto', '$elemento_gasto', '$presupuesto', '$m01', 
        '$m02', '$m03', '$m04', '$m05', '$m06', '$m07', '$m08', '$m09', '$m10', '$m11', '$m12', '$modificacion', '$ejecucion', '$monto_a_solicitado', '$monto_de_solicitado', '$ampliacion', '$credito', '$id_clasificador', '$monto_financ1', '$monto_financ2', '$compromiso', '$devengado', '$girado', '$pagado', '$monto_certificado', '$monto_comprometido_anual', '$monto_precertificado')");
        return true;
    }

    public function del_gasto($ano_eje)
    {
       // $db_prueba=$this->load->database($this->config->item('active_record'), true);
        $db_prueba=$this->load->database($this->config->item('active_record'), true);
        $data=$db_prueba->query("delete from gasto where ano_eje='".$ano_eje."'");
        return $db_prueba->affected_rows();
    }

    /*-----------------------FIN GASTO---------------------*/

    //--------------------------------------------------------------------------------------------------------//

    public function del_expediente($ano_eje, $expediente, $sec_ejec) //bien
    {
        if($expediente=='general')
        {
            $db_prueba=$this->load->database($this->config->item('active_record'), true);
            $data=$db_prueba->query("delete from expediente where ano_eje='".$ano_eje."' and sec_ejec LIKE '".$sec_ejec."'");
            return true;           
            
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
    }

    public function ins_expediente($ano_eje, $sec_ejec, $expediente, $mes_eje, $cod_doc, $num_doc, $fecha_doc, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $tipo_operacion, $sec_ejec2, $modalidad_compra, $clase_menor_cuantia, $sec_area, $flag_encargo, $expediente_encargante, $cod_mensa, $estado, $estado_envio, $archivo, $tipo_proceso, $id_proceso, $id_contrato, $sec_ejec_contrato, $fase_contractual, $procedencia, $expediente_financiamiento) //bien

    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente]
           ([ano_eje], [sec_ejec], [expediente], [mes_eje], [cod_doc], [num_doc], [fecha_doc], [fecha_ing], [usuario_ing], [fecha_mod], [usuario_mod], [tipo_operacion], [sec_ejec2], [modalidad_compra], [clase_menor_cuantia], [sec_area], [flag_encargo], [expediente_encargante], [cod_mensa], [estado], [estado_envio], [archivo], [tipo_proceso], [id_proceso], [id_contrato], [sec_ejec_contrato], [fase_contractual], [procedencia], [expediente_financiamiento])
        VALUES(
                '$ano_eje','$sec_ejec','$expediente','$mes_eje','$cod_doc','$num_doc','$fecha_doc','$fecha_ing','$usuario_ing','$fecha_mod','$usuario_mod','$tipo_operacion','$sec_ejec2','$modalidad_compra','$clase_menor_cuantia','$sec_area','$flag_encargo','$expediente_encargante','$cod_mensa','$estado','$estado_envio','$archivo','$tipo_proceso','$id_proceso','$id_contrato','$sec_ejec_contrato','$fase_contractual','$procedencia','$expediente_financiamiento')");
        //return $data->result();
        return true;
    }

    public function del_expediente_nota($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_nota where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_nota where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
    }

    public function ins_expediente_nota($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_nota, $notas, $estado, $estado_envio, $archivo)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_nota]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [secuencia_nota], [notas], [estado], [estado_envio], [archivo])
         VALUES
               ('$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$secuencia_nota', '$notas', '$estado', '$estado_envio', '$archivo' )");
        //return $data->result();
        return true;
    }

    public function del_expediente_fase($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_fase where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_fase where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }        
    }

    public function ins_expediente_fase($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_padre, $secuencia_anterior, $mes_ctb, $monto_nacional, $monto_saldo, $origen, $fuente_financ, $mejor_fecha, $tipo_id, $ruc, $tipo_pago, $tipo_recurso, $tipo_compromiso, $organismo, $proyecto, $estado, $estado_envio, $archivo, $tipo_giro, $tipo_financiamiento, $cod_doc_ref, $fecha_doc_ref, $num_doc_ref, $certificado, $certificado_secuencia, $sec_ejec_ruc, $sec_ejec_reciproca, $transferencia_financiera_id)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_fase]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [secuencia_padre], [secuencia_anterior], [mes_ctb], [monto_nacional], [monto_saldo], [origen], [fuente_financ], [mejor_fecha], [tipo_id], [ruc], [tipo_pago], [tipo_recurso], [tipo_compromiso], [organismo], [proyecto], [estado], [estado_envio], [archivo], [tipo_giro], [tipo_financiamiento], [cod_doc_ref], [fecha_doc_ref], [num_doc_ref], [certificado], [certificado_secuencia], [sec_ejec_ruc], [sec_ejec_reciproca], [transferencia_financiera_id])
        VALUES
           ( '$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$secuencia_padre', '$secuencia_anterior', '$mes_ctb', '$monto_nacional', '$monto_saldo', '$origen', '$fuente_financ', '$mejor_fecha', '$tipo_id', '$ruc', '$tipo_pago', '$tipo_recurso', '$tipo_compromiso', '$organismo', '$proyecto', '$estado', '$estado_envio', '$archivo', '$tipo_giro', '$tipo_financiamiento', '$cod_doc_ref', '$fecha_doc_ref', '$num_doc_ref', '$certificado', '$certificado_secuencia', '$sec_ejec_ruc', '$sec_ejec_reciproca', '$transferencia_financiera_id')");
        //return $data->result();
        return true;
    }

    public function ins_meta($ano_eje, $sec_ejec, $sec_func, $funcion, $programa, $sub_programa, $act_proy, $componente, $meta, $finalidad, $nombre, $monto, $cantidad, $unidad_med, $departamento,
        $provincia, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $estado, $distrito, $unidad_medida, $cantidad_inicial, $unidad_medida_inicial, $es_pia, $cantidad_semestral,
        $cantidad_semestral_inicial, $estrategia_nacional, $programa_ppto, $cantidad_trimestral_01, $cantidad_trimestral_01_inicial, $cantidad_trimestral_03,
        $cantidad_trimestral_03_inicial) {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("insert into meta (ano_eje, sec_ejec, sec_func, funcion, programa, sub_programa, act_proy, componente, meta, finalidad, nombre, monto, cantidad, unidad_med, departamento,
     provincia, fecha_ing, usuario_ing, fecha_mod, usuario_mod, estado, distrito, unidad_medida, cantidad_inicial, unidad_medida_inicial, es_pia, cantidad_semestral,
     cantidad_semestral_inicial, estrategia_nacional, programa_ppto, cantidad_trimestral_01, cantidad_trimestral_01_inicial, cantidad_trimestral_03,
     cantidad_trimestral_03_inicial) values ('$ano_eje', '$sec_ejec', '$sec_func', '$funcion', '$programa', '$sub_programa', '$act_proy', '$componente', '$meta', '$finalidad', '$nombre', $monto, $cantidad, '$unidad_med', '$departamento',
                                            '$provincia', '$fecha_ing', '$usuario_ing', '$fecha_mod', '$usuario_mod', '$estado', '$distrito', '$unidad_medida', $cantidad_inicial, '$unidad_medida_inicial', '$es_pia', '$cantidad_semestral',
                                            '$cantidad_semestral_inicial', '$estrategia_nacional', '$programa_ppto', '$cantidad_trimestral_01', '$cantidad_trimestral_01_inicial', '$cantidad_trimestral_03',
                                            '$cantidad_trimestral_03_inicial')");
        return $data;
    }

   /* public function ins_expediente_fase($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_padre, $secuencia_anterior, $mes_ctb, $monto_nacional, $monto_saldo, $origen, $fuente_financ, $mejor_fecha, $tipo_id, $ruc, $tipo_pago, $tipo_recurso, $tipo_compromiso, $organismo, $proyecto, $estado, $estado_envio, $archivo, $tipo_giro, $tipo_financiamiento, $cod_doc_ref, $fecha_doc_ref, $num_doc_ref, $certificado, $certificado_secuencia, $sec_ejec_ruc, $sec_ejec_reciproca, $transferencia_financiera_id)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_fase]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [secuencia_padre], [secuencia_anterior], [mes_ctb], [monto_nacional], [monto_saldo], [origen], [fuente_financ], [mejor_fecha], [tipo_id], [ruc], [tipo_pago], [tipo_recurso], [tipo_compromiso], [organismo], [proyecto], [estado], [estado_envio], [archivo], [tipo_giro], [tipo_financiamiento], [cod_doc_ref], [fecha_doc_ref], [num_doc_ref], [certificado], [certificado_secuencia], [sec_ejec_ruc], [sec_ejec_reciproca], [transferencia_financiera_id])
        VALUES
           ( '$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$secuencia_padre', '$secuencia_anterior', '$mes_ctb', '$monto_nacional', '$monto_saldo', '$origen', '$fuente_financ', '$mejor_fecha', '$tipo_id', '$ruc', '$tipo_pago', '$tipo_recurso', '$tipo_compromiso', '$organismo', '$proyecto', '$estado', '$estado_envio', '$archivo', '$tipo_giro', '$tipo_financiamiento', '$cod_doc_ref', '$fecha_doc_ref', '$num_doc_ref', '$certificado', '$certificado_secuencia', '$sec_ejec_ruc', '$sec_ejec_reciproca', '$transferencia_financiera_id')");
        //return $data->result();
        return true;
    }

    public function ins_expediente_fase($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $secuencia_padre, $secuencia_anterior, $mes_ctb, $monto_nacional, $monto_saldo, $origen, $fuente_financ, $mejor_fecha, $tipo_id, $ruc, $tipo_pago, $tipo_recurso, $tipo_compromiso, $organismo, $proyecto, $estado, $estado_envio, $archivo, $tipo_giro, $tipo_financiamiento, $cod_doc_ref, $fecha_doc_ref, $num_doc_ref, $certificado, $certificado_secuencia, $sec_ejec_ruc, $sec_ejec_reciproca, $transferencia_financiera_id)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_fase]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [secuencia_padre], [secuencia_anterior], [mes_ctb], [monto_nacional], [monto_saldo], [origen], [fuente_financ], [mejor_fecha], [tipo_id], [ruc], [tipo_pago], [tipo_recurso], [tipo_compromiso], [organismo], [proyecto], [estado], [estado_envio], [archivo], [tipo_giro], [tipo_financiamiento], [cod_doc_ref], [fecha_doc_ref], [num_doc_ref], [certificado], [certificado_secuencia], [sec_ejec_ruc], [sec_ejec_reciproca], [transferencia_financiera_id])
        VALUES
           ( '$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$secuencia_padre', '$secuencia_anterior', '$mes_ctb', '$monto_nacional', '$monto_saldo', '$origen', '$fuente_financ', '$mejor_fecha', '$tipo_id', '$ruc', '$tipo_pago', '$tipo_recurso', '$tipo_compromiso', '$organismo', '$proyecto', '$estado', '$estado_envio', '$archivo', '$tipo_giro', '$tipo_financiamiento', '$cod_doc_ref', '$fecha_doc_ref', '$num_doc_ref', '$certificado', '$certificado_secuencia', '$sec_ejec_ruc', '$sec_ejec_reciproca', '$transferencia_financiera_id')");
        //return $data->result();
        return true;
    }*/

    public function del_expediente_secuencia($ano_eje, $expediente, $sec_ejec)
    {
        if($expediente=='general')
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_secuencia where ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
        else
        {
            $db_prueba = $this->load->database($this->config->item('active_record'), true);
            $data      = $db_prueba->query("delete from expediente_secuencia where expediente like '" . $expediente . "' and ano_eje = '" . $ano_eje . "' and sec_ejec LIKE '" . $sec_ejec . "'");
            return true;
        }
    }

    public function ins_expediente_secuencia($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $cod_doc, $num_doc, $fecha_doc, $moneda, $tipo_cambio, $monto, $monto_saldo, $monto_nacional, $monto_extranjero, $fecha_ing, $usuario_ing, $fecha_mod, $usuario_mod, $num_record, $serie_doc, $ano_proceso, $mes_proceso, $dia_proceso, $grupo, $edicion, $ano_cta_cte, $banco, $cta_cte, $fecha_autorizacion, $cod_mensa, $estado_ctb, $estado_ctb_anterior, $estado, $estado_anterior, $estado_envio, $archivo, $reg_multiple, $cta_bco_ejec, $flg_interfase, $ind_contabiliza, $tipo_cambio_ps, $sec_proceso, $cod_doc_b, $fecha_doc_b, $num_doc_b, $fecha_bd_oracle, $mes_afectacion_calendario, $secuencia_solicitud, $fecha_creacion_clt, $fecha_modificacion_clt, $usuario_creacion_clt, $usuario_modificacion_clt, $fecha_autorizacion_giro, $verifica_1, $secuencia_transferencia, $transferencia)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_secuencia]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [correlativo], [cod_doc], [num_doc], [fecha_doc], [moneda], [tipo_cambio], [monto], [monto_saldo], [monto_nacional], [monto_extranjero], [fecha_ing], [usuario_ing], [fecha_mod], [usuario_mod], [num_record], [serie_doc], [ano_proceso], [mes_proceso], [dia_proceso], [grupo], [edicion], [ano_cta_cte], [banco], [cta_cte], [fecha_autorizacion], [cod_mensa], [estado_ctb], [estado_ctb_anterior], [estado], [estado_anterior], [estado_envio], [archivo], [reg_multiple], [cta_bco_ejec], [flg_interfase], [ind_contabiliza], [tipo_cambio_ps], [sec_proceso], [cod_doc_b], [fecha_doc_b], [num_doc_b], [fecha_bd_oracle], [mes_afectacion_calendario], [secuencia_solicitud], [fecha_creacion_clt], [fecha_modificacion_clt], [usuario_creacion_clt], [usuario_modificacion_clt], [fecha_autorizacion_giro], [verifica_1], [secuencia_transferencia], [transferencia])
     VALUES
           (   '$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$correlativo', '$cod_doc', '$num_doc', '$fecha_doc', '$moneda', '$tipo_cambio', '$monto', '$monto_saldo', '$monto_nacional', '$monto_extranjero', '$fecha_ing', '$usuario_ing', '$fecha_mod', '$usuario_mod', '$num_record', '$serie_doc', '$ano_proceso', '$mes_proceso', '$dia_proceso', '$grupo', '$edicion', '$ano_cta_cte', '$banco', '$cta_cte', '$fecha_autorizacion', '$cod_mensa', '$estado_ctb', '$estado_ctb_anterior', '$estado', '$estado_anterior', '$estado_envio', '$archivo', '$reg_multiple', '$cta_bco_ejec', '$flg_interfase', '$ind_contabiliza', '$tipo_cambio_ps', '$sec_proceso', '$cod_doc_b', '$fecha_doc_b', '$num_doc_b', '$fecha_bd_oracle', '$mes_afectacion_calendario', '$secuencia_solicitud', '$fecha_creacion_clt', '$fecha_modificacion_clt', '$usuario_creacion_clt', '$usuario_modificacion_clt', '$fecha_autorizacion_giro', '$verifica_1', '$secuencia_transferencia', '$transferencia' )");
        //return $data->result();
        return true;
    }

    public function del_tipo_operacion($ano_eje)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("delete from tipo_operacion where ano_eje = '" . $ano_eje . "'");
        //return $data->result();
        return true;
    }


    public function ins_tipo_operacion($ano_eje, $tipo_operacion, $nombre, $ambito, $descripcion_abreviada, $fecha_generacion, $estado, $ciclo, $es_compromiso_anual, $es_ft, $es_sunat, $es_reciproca, $es_reciproca_compromiso)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[tipo_operacion]
           ([ano_eje], [tipo_operacion], [nombre], [ambito], [descripcion_abreviada], [fecha_generacion], [estado], [ciclo], [es_compromiso_anual], [es_ft], [es_sunat], [es_reciproca], [es_reciproca_compromiso])
     VALUES
           ( '$ano_eje', '$tipo_operacion', '$nombre', '$ambito', '$descripcion_abreviada', '$fecha_generacion', '$estado', '$ciclo', '$es_compromiso_anual', '$es_ft', '$es_sunat', '$es_reciproca', '$es_reciproca_compromiso' )");
        //return $data->result();
        return true;
    }

    public function del_expediente_meta($ano_eje)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("delete from expediente_meta where ano_eje = '" . $ano_eje . "'");
        return true;
    }
    

    public function ins_expediente_meta($ano_eje, $sec_ejec, $expediente, $ciclo, $fase, $secuencia, $correlativo, $categ_gasto, $grupo_gasto, $modalidad_gasto, $elemento_gasto, $sec_func, $monto, $monto_saldo, $monto_nacional, $ind_proceso, $edicion, $estado, $estado_envio, $archivo, $id_clasificador)
    {
        $db_prueba = $this->load->database($this->config->item('active_record'), true);
        $data      = $db_prueba->query("INSERT INTO [dbo].[expediente_meta]
           ([ano_eje], [sec_ejec], [expediente], [ciclo], [fase], [secuencia], [correlativo], [categ_gasto], [grupo_gasto], [modalidad_gasto], [elemento_gasto], [sec_func], [monto], [monto_saldo], [monto_nacional], [ind_proceso], [edicion], [estado], [estado_envio], [archivo], [id_clasificador])
     VALUES
           ( '$ano_eje', '$sec_ejec', '$expediente', '$ciclo', '$fase', '$secuencia', '$correlativo', '$categ_gasto', '$grupo_gasto', '$modalidad_gasto', '$elemento_gasto', '$sec_func', '$monto', '$monto_saldo', '$monto_nacional', '$ind_proceso', '$edicion', '$estado', '$estado_envio', '$archivo', '$id_clasificador')");

        return true;
    }
}
