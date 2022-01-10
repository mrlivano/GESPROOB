<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Repositorio_Preliquidacion extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		/* Standard Libraries */
		$this->load->database();
		$this->load->helper('url');

        $this->load->model('Model_Preliquidacion');

		/* ------------------ */
	}

	public function index()
	{
		echo("hola");
	}

	/* Standalone Elfinder */
	public function elfinder_files()
	{
		$mod = $_GET['doc'];
        $id_et = $_GET['id_pl'];



        //$folders2 = $this->Model_Preliquidacion->GetPreliquidacion();
        //foreach ($folders2 as $folder2) {
            if (!file_exists('uploads/Preliquidacion/'.$id_et)) {
                $path = FCPATH . 'uploads/Preliquidacion/'.$id_et;
                mkdir($path, 0777, true);
                //crear carpeta interna de doc

                $folders2 = $this->Model_Preliquidacion->GetPreliquidacion();
                $contador=1;
                foreach ($folders2 as $folder2) {
                    if (!file_exists('uploads/Preliquidacion/'.$id_et.'/'.$folder2->id_descripcion)) {
                        $pathsub = FCPATH . 'uploads/Preliquidacion/'.$id_et.'/'.$folder2->id_descripcion;
                        mkdir($pathsub, 0777, true);

                    }
                    $contador++;
                }

            }else
            {
                $folders2 = $this->Model_Preliquidacion->GetPreliquidacion();
                $contador=1;
                foreach ($folders2 as $folder2) {
                    if (!file_exists('uploads/Preliquidacion/'.$id_et.'/'.$folder2->id_descripcion)) {
                        $pathsub = FCPATH . 'uploads/Preliquidacion/'.$id_et.'/'.$folder2->id_descripcion;
                        mkdir($pathsub, 0777, true);
                    }
                    $contador++;
                }
             }

        //}



/*
        if (!file_exists('uploads/Preliquidacion/'.$id_et)) {
            $path = FCPATH . 'uploads/Preliquidacion/' . $id_et;
            mkdir($path, 0777, true);

            //crear carpeta internas del expediente
            $folders = $this->Model_Preliquidacion->GetPreliquidacion();
            foreach ($folders as $carpetas) {
                if (!file_exists('uploads/Preliquidacion/' . $id_et . '/' .  $carpetas->id_descripcion)) {
                    $pathsub = FCPATH . 'uploads/Preliquidacion/' . $id_et . '/' . $carpetas->id_descripcion;
                    mkdir($pathsub, 0777, true);

                }
            }


        }else{

            //crear carpeta internas del expediente
            $folders = $this->Model_Preliquidacion->GetPreliquidacion();
            foreach ($folders as $carpetas) {
                if (!file_exists('uploads/Preliquidacion/' . $id_et . '/' .  $carpetas->id_descripcion)) {
                    $pathsub = FCPATH . 'uploads/Preliquidacion/' . $id_et . '/' . $carpetas->id_descripcion;
                    mkdir($pathsub, 0777, true);

                }
            }

        }
*/

	    $this->load->helper('url');
	    $data['connector'] = site_url() . '/Repositorio_Preliquidacion/elfinder_init?id_et='.$id_et;
	    $this->load->view('repositorio_preliquidacion', $data);

	}

	/* Popup Elfinder in TinyMCE */

	public function elfinder_popup()
	{
		$this->load->view('repositorio_preliquidacion');
	}

	/* Elfinder initialization */
	public function elfinder_init()
	{

			$id_et= $_GET['id_pl'];
            $doc = $_GET['doc'];

            $folderArray = [];

            echo $doc;

            if($doc=="all"){

                //Muestra todos los documentos
                $folders = $this->Model_Preliquidacion->GetPreliquidacion();
                $contador=1;
                foreach ($folders as $folder) {
                    array_push($folderArray,
                        array(
                            'driver' => 'LocalFileSystem',
                            'path' =>  'uploads/Preliquidacion/'.$id_et."/".$folder->id_descripcion,
                            'URL' => base_url('uploads/Preliquidacion/'.$id_et."/".$folder->id_descripcion),
                            'alias' => $contador.'.'.$folder->descripcion,
                            'uploadMaxSize' => '2000M',
                            'uploadDeny'    => array('all'),                 // Recomend the same settings as the original volume that uses the trash
                            'uploadAllow'   => array('all'),                // Same as above
                            'uploadOrder'   => array('deny', 'allow'),      // Same as above
                            'accessControl' => array($this, 'elfinderAccess'),
                            'attributes' => array(
                                array(
                                    'pattern' => '/\.tmb$/',
                                    'read' => true,
                                    'write' => true,
                                    'locked' => true,
                                    'hidden' => true
                                )
                            )
                        )
                    );
                    $contador++;
                }
            }else{
                //Muestra solo una carpeta del documento

                $descripcion = $this->Model_Preliquidacion->GetPreliquidacionDescripcion($doc);



                array_push($folderArray,
                    array(
                        'driver' => 'LocalFileSystem',
                        'path' =>  'uploads/Preliquidacion/'.$id_et.'/'.$doc,
                        'URL' => base_url('uploads/Preliquidacion/'.$id_et.'/'.$doc),
                        'alias' => ''.$descripcion,
                        'uploadMaxSize' => '2000M',
                        'uploadDeny'    => array('all'),                 // Recomend the same settings as the original volume that uses the trash
                        'uploadAllow'   => array('all'),                // Same as above
                        'uploadOrder'   => array('deny', 'allow'),      // Same as above
                        'accessControl' => array($this, 'elfinderAccess'),
                        'attributes' => array(
                            array(
                                'pattern' => '/\.tmb$/',
                                'read' => true,
                                'write' => true,
                                'locked' => true,
                                'hidden' => true
                            )
                        )
                    )
                );


            }



			$opts = array(
				'debug' => false,
				'roots' => $folderArray
			);
			$this->load->library('elfinder_lib/Elfinder_lib', $opts);


	}


  public function elfinderAccess($attr, $path, $data, $volume, $isDir, $relpath)
  {
      $basename = basename($path);
      return $basename[0] === '.'                  // if file/folder begins with '.' (dot)
               && strlen($relpath) !== 1           // but with out volume root
          ? !($attr == 'read' || $attr == 'write') // set read+write to false, other (locked+hidden) set to true
          :  null;                                 // else elFinder decide it itself
  }


}
