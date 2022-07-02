<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Encuesta extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('encuesta/encuesta_model');
    $this->load->model('carrera/carrera_model');
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
        $table = 'encuesta';
        $primaryKey = 'id';
        $columns = array(
            array( 'db' => 'id', 'dt' => 0 ),
            array( 'db' => 'periodo', 'dt' => 1 ),
            array( 'db' => 'carrera', 'dt' => 2 ),
            array( 'db' => 'sede', 'dt' => 3 ),
            array( 'db' => 'desde', 'dt' => 4 ),
            array( 'db' => 'hasta', 'dt' => 5 )
        );
        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db'   => $this->db->database,
            'host' => $this->db->hostname
        );
        $output_arr = SSP::complex( $_GET, $sql_details, $table, $primaryKey, $columns, null, null );
        foreach ($output_arr['data'] as $key => $value) {
            $id = $output_arr['data'][$key][0];
            $output_arr['data'][$key][0] = '<div class="text-center"><input type="checkbox" name="id[]" value="'.$id.'"></div>';
            $output_arr['data'][$key][2] = $this->encuesta_model->getCarrera($output_arr['data'][$key][2]);
            $output_arr['data'][$key][3] = $this->encuesta_model->getSede($output_arr['data'][$key][3]);
            if (CheckPermission('user', "all_update")) {
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a id="btnEditRow" class="modalButtonEncuesta mClass"  href="javascript:;" type="button" data-src="'.$id.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
            }
            if (CheckPermission('user', "all_delete")) {
                $output_arr['data'][$key][count($output_arr['data'][$key])  - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$id.', \'encuesta\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
            }
        } 
        echo json_encode($output_arr);
    }

    public function get_modal() {
        is_login();
        if($this->input->post('id')){
            $data['encuestaData'] = getDataByid('encuesta', $this->input->post('id'), 'id'); 
            echo $this->load->view('add_encuesta', $data, true);
        } else {
            echo $this->load->view('add_encuesta', '', true);
        }
        exit;
    }

    public function delete($id){
        is_login(); 
        $ids = explode('-', $id);
        foreach ($ids as $id) {
            $this->Encuesta_model->delete($id); 
        }
       redirect(base_url().'encuesta', 'refresh');
    }
}
?>