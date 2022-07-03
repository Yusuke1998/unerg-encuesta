<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Encuesta_model Class extends CI_Model
 */
class Encuesta_model extends CI_Model {       
	function __construct(){            
	    parent::__construct();
	    $this->load->database();
	} 

	public function getEncuesta($id) {
		$this->db->select('carrera, sede');
		$this->db->from('encuesta');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->row();
	}
	
	public function getCarrera($code) {
		$this->db->where('codigo', $code);
		$query = $this->db->get('carreras');
		return $query->row()->carrera;
    }

	public function getSede($code) {
		$this->db->where('codigo', $code);
		$query = $this->db->get('sedes');
		return $query->row()->sede;
    }

	public function getMaterias($id) {
		$this->db->select('materia');
		$this->db->where('id_encuesta', $id);
		$this->db->from('materias_encuesta');
		$query = $this->db->get();
		return $query->result();
	}

	public function insertRow($table, $data){
	  	$this->db->insert($table, $data);
	  	return  $this->db->insert_id();
	}

  	public function updateRow($table, $col, $colVal, $data) {
  		$this->db->where($col,$colVal);
		$this->db->update($table,$data);
		return true;
	}

	function delete($id = null) {
		if ($id) {
			$this->db->where('id', $id);  
			$this->db->delete('encuesta'); 
		}
	}

	function deleteMaterias($id = null) {
		if ($id) {
			$this->db->where('id_encuesta', $id);  
			$this->db->delete('materias_encuesta'); 
		}
	}
	
}?>