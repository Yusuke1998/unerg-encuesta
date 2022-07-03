<?php defined("BASEPATH") OR exit("No direct script access allowed");

class Reporte extends CI_Controller {

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

  public function general() {

  }

  public function resument() {

  }
}
?>