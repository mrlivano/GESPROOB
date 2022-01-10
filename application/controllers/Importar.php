<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Importar extends CI_Controller
{
/* Mantenimiento de sector entidad Y servicio publico asociado*/

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Importar_Model');
    }

    public function index()
    {
        $this->_load_layout('Front/Pmi/frmMProyectoInversion');
    }

    public function addImportar()
    {
        //UPLOAD
        $config['upload_path']   = 'uploads/';
        $config['allowed_types'] = 'xls|xlsx|cvs';
        $config['max_size']      = 15000;
        $config['encrypt_name']  = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('archivo')) {
            $error = array('error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            //var_dump($data['upload_data']);
            echo "Se subio correctamente el archivo";
            //$this->load->view('upload_success', $data);
        }
        // IMPORTAR
        $this->load->library('Excelfile');
        $file = "uploads/" . $data['upload_data']['file_name'];

        echo $file;

        $obj      = PHPExcel_IOFactory::load($file);
        $cell     = $obj->getActiveSheet()->getCellCollection();
        $arr_data = array();
        // var_dump($cell);
        foreach ($cell as $cl) {
            $column     = $obj->getActiveSheet()->getCell($cl)->getColumn();
            $row        = $obj->getActiveSheet()->getCell($cl)->getRow();
            $data_value = $obj->getActiveSheet()->getCell($cl)->getValue();
            //print_r($data_value);
            if ($row == 2) {
                //echo 'ROW -> '.$row.'<br>';
                //echo 'ROW -> '.$data_value.'<br>';
                $header[$row][$column] = $data_value;

            }
            if ($row > 2) {
                # code...
                // int $i                   = 0;
                $arr_data[$row][$column] = $data_value;

                //$arr_data[3][1] = $nombre;

                // var_dump($arr_data[$row][$column]);
                // echo "---"+$nombre;
                // echo $i++;
                //var_dump($arr_data[$row][$column]);
                //echo "<br>";
            }
        }
        //obtener la fecha de la cartera para que este sea importado
        $data['header'] = $header;
        foreach ($header as $fe) {
            $aniotemp    = $fe['AF'];
            $anio_entero = $aniotemp - 1;
            $anio        = $anio_entero . "/01/01";
        }
        $data['values'] = $arr_data;
        foreach ($arr_data as $fila) {
            /*
            $distrito = $fila['L'];
            if ( strpos($distrito, '-' ) ) {
            $distrito1 = subtr
            $distrito2 = subtr
            }

            $data_tmp = $fila;
            //posner en L nuevvo string y desplazar el resto
            $this->Importar_Model->addImportar($data_tmp);
             */
            //echo $fechaAB;
            // echo "<BR>";
            $fechaAA = date('Y/m/d', PHPExcel_Shared_Date::ExcelToPHP($fila['AA']));
            $fechaAB = date('Y/m/d', PHPExcel_Shared_Date::ExcelToPHP($fila['AB']));
            //echo "<BR>";
            // utilizo la función y obtengo el timestamp

            //  $fecha = date("d/m/Y ", $fila['AA']);
            //   echo "string"+$fecha;
            //  var_dump($fila['AA']);
            $this->Importar_Model->addImportar($fila, $fechaAA, $fechaAB, $anio);

        }

    }
/*
function _load_layout($template)
{
$this->load->view('layout/PMI/header');
$this->load->view($template);
$this->load->view('layout/PMI/footer');
}
 */
}
