<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Carrera extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('carrera/carrera_model');
    $this->load->model('encuesta/encuesta_model');
  }

  /**
     * This function is used to load page view
     * @return Void
     */
  public function index() {   
	$this->load->view("include/header");
    $this->load->view("index");
    $this->load->view("include/footer");
  }

  public function dataTable () {
        is_login();
        $table = 'carreras';
        $primaryKey = 'id';
        $columns = array(
            array( 'db' => 'codigo', 'dt' => 0 ),
            array( 'db' => 'codigo', 'dt' => 1 ),
            array( 'db' => 'carrera', 'dt' => 2 ),
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        $output_arr = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, null );
        foreach ($output_arr['data'] as $key => $value) {
            $codigo = $output_arr['data'][$key][0];
            $output_arr['data'][$key][0] = '<div class="text-center"><input type="checkbox" name="id[]" value="'.$codigo.'"></div>';
            if (CheckPermission('user', "all_update")) {
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonCarrera mClass"  href="javascript:;" type="button" data-src="'.$codigo.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
            }
            if (CheckPermission('user', "all_delete")) {
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$codigo.', \'carrera\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
            }
        } 
        echo json_encode($output_arr);
    }

    /**
     * This function is used to delete users
     * @return Void
     */
    public function delete($codigo){
        is_login(); 
        $codigos = explode('-', $codigo);
        foreach ($codigos as $codigo) {
            $this->Carrera_model->delete($codigo); 
        }
       redirect(base_url().'carrera', 'refresh');
    }
}
?>