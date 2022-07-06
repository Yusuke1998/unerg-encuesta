<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Reporte extends CI_Controller {

  function __construct() {
    parent::__construct();
    $this->load->model('sede/sede_model');
    $this->load->model('materia/materia_model');
    $this->load->model('carrera/carrera_model');
    $this->load->model('encuesta/encuesta_model');
  }

  /**
   * This function is used to load page view
   * @return Void
   */
  public function index() {   
    $carreras = $this->carrera_model->getCarreras();
	  $this->load->view("include/header");
    $this->load->view("index", array('carreras' => $carreras));
    $this->load->view("include/footer");
  }

  public function make() {
    $carreras = $this->carrera_model->getCarreras(); $sedes = $this->sede_model->getSedes();
    $sede = $this->input->post('sede'); $tipo_reporte = $this->input->post('tipo_reporte');
    $cols = ""; $anio = $this->input->post('anio'); $carrera = $this->input->post('carrera');
    $table = null;
    $colsGeneral = array('periodo', 'cedula', 'nombres', 'apellidos', 'carrera', 'sede', 'materia', 'turno');
    $colsResumen = array('periodo', 'materia', 'turno', 'solicitantes', 'carrera', 'sede');
    $results = ""; $data = []; $headers = [];

    if ($tipo_reporte == 'general') {
      $data = $this->encuesta_model->getReporteGeneral($anio, $carrera, $sede); $headers = $colsGeneral;
      foreach ($colsGeneral as $col) {
        $cols .= '<th>'.strtoupper($col).'</th>';
      }
    }else {
      $data = $this->encuesta_model->getReporteResumen($anio, $carrera, $sede); $headers = $colsResumen;
      foreach ($colsResumen as $col) {
        $cols .= '<th>'.strtoupper($col).'</th>';
      }
    }

    foreach ($data as $d) {
      $d = (array)$d; $row = '<tr>';
      foreach ($headers as $header) {
        $row .= '<td>' . $d[strtolower($header)] . '</td>';
      }
      $row .= '</tr>';
      $results .= $row;
    }

    if ($cols != "" && $results != "") {
      $table = '<table id="example1" class="example1 table table-striped table1"><thead><tr>{cols}</tr></thead><tbody>{results}</tbody></table>';
      $table = str_replace(['{cols}', '{results}'], [$cols, $results], $table);
    }

    $data = array(
      'sede' => $sede, 
      'anio' => $anio,
      'table' => $table, 
      'carrera' => $carrera,
      'tipo_reporte' => $tipo_reporte
    );

    $this->load->view("include/header");
    $this->load->view("index", array(
      'data' => $data, 
      'sedes' => $sedes,
      'carreras' => $carreras
    ));
    $this->load->view("include/footer");
  }
}
?>