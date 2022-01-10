<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Importar_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }
//------------------METODOS DE LA BRECHA-------------------
    //AGREGAR UNA BRECHA
    public function addImportar($param, $fecha, $fechas, $anio)
    {
        $this->db->query("execute sp_InsercionExcel '" .
            $param['A'] .
            "', '" . $param['B'] .
            "', '" . $param['C'] .
            "', '" . $param['D'] .
            "', '" . $param['E'] .
            "', '" . $param['F'] .
            "', '" . $param['G'] .
            "', '" . $param['H'] .
            "', '" . $param['I'] .
            "', '" . $param['J'] .
            "', '" . $param['K'] .
            "', '" . $param['L'] .
            "', '" . $param['M'] .
            "', '" . $param['N'] .
            "', '" . $param['O'] .
            "', '" . $param['P'] .
            "', '" . $param['Q'] .
            "', '" . $param['R'] .
            "', '" . $param['S'] .
            "', '" . $param['T'] .
            "', '" . $param['U'] .
            "', '" . $param['V'] .
            "', '" . $param['W'] .
            "', '" . $param['X'] .
            "', '" . $param['Y'] .
            "', '" . $param['Z'] .
            "', '" . $fecha .
            "', '" . $fechas .
            "', '" . $param['AC'] .
            "', '" . $param['AD'] .
            "', '" . $param['AE'] .
            "', '" . $param['AF'] .
            "', '" . $param['AG'] .
            "', '" . $param['AH'] .
            "', '" . $param['AI'] .
            "', '" . $param['AJ'] .
            "', '" . $param['AK'] .
            "', '" . $anio . "' ");
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
