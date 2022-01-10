<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Elfinder_lib extends CI_Controller {
        public function __construct()
      	{
      		parent::__construct();

      		$this->load->model('Model_ET_Expediente_Tecnico');
        }

        public function manager()
        {
            $id_et = $_GET['id_et'];
            $folders = $this->Model_ET_Expediente_Tecnico->ListarExpedienteTecnico();
            foreach ($folders as $folder) {
              if (!file_exists('application/vendor/studio-42/elfinder/files/'.$folder->id_et)) {
                $path = FCPATH . 'application/vendor/studio-42/elfinder/files/'.$folder->id_et;
                  mkdir($path, 0777, true);
              }
            }
            $this->load->helper('url');
            $data['connector'] = site_url() . '/Elfinder_lib/connector?id_et='.$id_et;
            $this->load->view('elfinder', $data);
        }

        public function connector()
        {
            $this->load->helper('url');
            /*
            $opts = array(
                'roots' => array(
                    array(
                        'driver'        => 'LocalFileSystem',
                        'path'          => FCPATH . 'application/vendor/studio-42/elfinder/files',
                        'URL'           => base_url('application/vendor/studio-42/elfinder/files'),
                        'uploadDeny'    => array('all'),                  // All Mimetypes not allowed to upload
                        'uploadAllow'   => array('image', 'text/plain', 'application/pdf'),// Mimetype `image` and `text/plain` allowed to upload
                        'uploadOrder'   => array('deny', 'allow'),        // allowed Mimetype `image` and `text/plain` only
                        'accessControl' => array($this, 'elfinderAccess'),// disable and hide dot starting files (OPTIONAL)
                        // more elFinder options here
                    )
                ),
            );
            */
            $id_et = $_GET['id_et'];
            $id_persona = $this->session->userdata('idPersona');

            $idTipoUsuario = $this->session->userdata('tipoUsuario');

            $folders = $this->Model_ET_Expediente_Tecnico->belongsETtoUser($id_persona, $id_et, $idTipoUsuario);
            $folderArray = [];
            foreach ($folders as $folder) {
              array_push($folderArray,
                      array(
                          'driver'        => 'LocalFileSystem',           // driver for accessing file system (REQUIRED)
                          'path'          => FCPATH . 'application/vendor/studio-42/elfinder/files/'.$folder->id_et,  // path to files (REQUIRED)
                          'URL'           => base_url('application/vendor/studio-42/elfinder/files/'.$folder->id_et),   // URL to files (REQUIRED)
                          'alias'         => 'Expediente '.$folder->id_et,// The name to replace your actual path name. (OPTIONAL)
                          'accessControl' => array($this, 'elfinderAccess'),// disable and hide dot starting files (OPTIONAL)
                          'trashHash'     => 't1_Lw',                     // elFinder's hash of trash folder
                          'winHashFix'    => DIRECTORY_SEPARATOR !== '/', // to make hash same to Linux one on windows too
                          'uploadDeny'    => array('all'),                 // Recomend the same settings as the original volume that uses the trash
                    			'uploadAllow'   => array('all'),                // Same as above
                    			'uploadOrder'   => array('deny', 'allow'),      // Same as above
                          'uploadMaxSize' => '3G'
                      )
              );
            }

            $opts = array(
                'roots' => $folderArray
            );

            $connector = new elFinderConnector(new elFinder($opts));
            $connector->run();
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
