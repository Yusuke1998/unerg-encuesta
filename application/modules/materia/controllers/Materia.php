<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Materia extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('materia/materia_model');
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
        $table = 'materias_encuesta';
        $primaryKey = 'id';
        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'id_encuesta', 'dt' => 1 ),
            array( 'db' => 'materia', 'dt' => 2 ),
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
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonMateria mClass"  href="javascript:;" type="button" data-src="'.$codigo.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
            }
            if (CheckPermission('user', "all_delete")) {
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$codigo.', \'materia\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
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
            $this->Materia_model->delete($codigo); 
        }
       redirect(base_url().'materia', 'refresh');
    }
}
?>