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

  public function pensum($sede, $carrera) {
    $pensum = $this->materia_model->getPensum($sede, $carrera);
    $result = "";
    if ($pensum) {
        $url = "http://api.unerg.edu.ve/materias.php?p=$pensum";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }
    return $result;
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
            $encuesta = $output_arr['data'][$key][1];
            $output_arr['data'][$key][0] = '<div class="text-center"><input type="checkbox" name="id[]" value="'.$codigo.'"></div>';
            $output_arr['data'][$key][1] = $this->materia_model->getPeriodo($encuesta);
            // $output_arr['data'][$key][3] = '';
            // if (CheckPermission('user', "all_update")) {
            //     $output_arr['data'][$key][3] .= '<a id="btnEditRow" class="modalButtonMateria mClass"  href="javascript:;" type="button" data-src="'.$codigo.'" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
            // }
            // if (CheckPermission('user', "all_delete")) {
            //     $output_arr['data'][$key][3] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId('.$codigo.', \'materia\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
            // }
        } 
        echo json_encode($output_arr);
    }

    /**
     * This function is used to delete users
     * @return Void
     */
    public function delete($id){
        is_login(); 
        $ids = explode('-', $id);
        foreach ($ids as $id) {
            $this->materia_model->delete($id); 
        }
        redirect(base_url().'materia', 'refresh');
    }
}
?>