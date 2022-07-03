<?php defined("BASEPATH") or exit("No direct script access allowed");

class Encuesta extends CI_Controller
{

  function __construct()
  {
    parent::__construct();
    $this->load->model('encuesta/encuesta_model');
    $this->load->model('carrera/carrera_model');
    $this->load->model('sede/sede_model');
  }

  /**
   * This function is used to load page view
   * @return Void
   */
  public function index()
  {
    $this->load->view("include/header");
    $this->load->view("index");
    $this->load->view("include/footer");
  }

  public function get_encuesta($id)
  {
    $encuesta = $this->encuesta_model->getEncuesta($id);
    echo json_encode($encuesta);
  }

  public function get_materias($id)
  {
    $materias = $this->encuesta_model->getMaterias($id);
    echo json_encode($materias);
  }

  public function dataTable()
  {
    is_login();
    $table = 'encuesta';
    $primaryKey = 'id';
    $columns = array(
      array('db' => 'id', 'dt' => 0),
      array('db' => 'periodo', 'dt' => 1),
      array('db' => 'carrera', 'dt' => 2),
      array('db' => 'sede', 'dt' => 3),
      array('db' => 'desde', 'dt' => 4),
      array('db' => 'hasta', 'dt' => 5),
    );
    $sql_details = array(
      'user' => $this->db->username,
      'pass' => $this->db->password,
      'db'   => $this->db->database,
      'host' => $this->db->hostname
    );
    $output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, null, null);
    foreach ($output_arr['data'] as $key => $value) {
      $id = $output_arr['data'][$key][0];
      $output_arr['data'][$key][count($output_arr['data'][$key])] = '';
      $output_arr['data'][$key][0] = '<td class="sorting_1"><input type="checkbox" name="id[]" value="' . $id . '"></td>';
      $output_arr['data'][$key][2] = $this->encuesta_model->getCarrera($output_arr['data'][$key][2]);
      $output_arr['data'][$key][3] = $this->encuesta_model->getSede($output_arr['data'][$key][3]);
      if (CheckPermission('user', "all_update")) {
        $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a id="btnEditRow" class="modalButtonEncuesta mClass"  href="javascript:;" type="button" data-src="' . $id . '" title="Edit"><i class="fa fa-pencil" data-id=""></i></a>';
      }
      if (CheckPermission('user', "all_delete")) {
        $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" data-toggle="modal" class="mClass" onclick="setId(' . $id . ', \'encuesta\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash-o" ></i></a>';
      }
    }
    echo json_encode($output_arr);
  }

  public function get_modal()
  {
    is_login();
    $data['carreras'] = $this->carrera_model->getCarreras();
    $data['sedes'] = $this->sede_model->getSedes();
    if ($this->input->post('id')) {
      $data['encuestaData'] = getDataByid('encuesta', $this->input->post('id'), 'id');
      echo $this->load->view('add_encuesta', $data, true);
    } else {
      echo $this->load->view('add_encuesta', $data, true);
    }
    exit;
  }

  public function add_edit($id = '')
  {
    $data = $this->input->post();
    unset($data['submit']);
    unset($data['edit']);
    if ($this->input->post('id')) {
      $id = $this->input->post('id');
    }
    if ($id != '') {
      $materias = $this->input->post('materias');
      if ($materias) {
        unset($data['materias']);
      }
      $this->encuesta_model->updateRow('encuesta', 'id', $id, $data);
      if ($materias) {
        $this->encuesta_model->deleteMaterias($id);
        unset($data['materias']);
        foreach ($materias as $key => $value) {
          $data = array(
            'id_encuesta' => $id,
            'materia' => $value
          );
          $this->encuesta_model->insertRow('materias_encuesta', $data);
        }
      }
      $this->session->set_flashdata('messagePr', 'Los datos fueron actualizados Exitosamente…');
      redirect(base_url() . 'encuesta', 'refresh');
    } else {
      $materias = $this->input->post('materias');
      if ($materias) {
        unset($data['materias']);
      }
      $id_encuesta = $this->encuesta_model->insertRow('encuesta', $data);
      if ($id_encuesta && $materias) {
        $this->encuesta_model->deleteMaterias($id_encuesta);
        foreach ($materias as $key => $value) {
          $data = array(
            'id_encuesta' => $id_encuesta,
            'materia' => $value
          );
          $this->encuesta_model->insertRow('materias_encuesta', $data);
        }
      }
      $this->session->set_flashdata('messagePr', 'Los datos fueron insertados con éxito...');
      redirect(base_url() . 'encuesta', 'refresh');
    }
  }

  public function delete($id)
  {
    is_login();
    $ids = explode('-', $id);
    foreach ($ids as $id) {
      $this->encuesta_model->deleteMaterias($id);
      $this->encuesta_model->delete($id);
    }
    redirect(base_url() . 'encuesta', 'refresh');
  }
}
