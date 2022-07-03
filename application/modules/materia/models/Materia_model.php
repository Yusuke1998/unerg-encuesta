<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Materia_model Class extends CI_Model
 */
class Materia_model extends CI_Model {       
	function __construct(){            
	    parent::__construct();
	    $this->load->database();
	} 

	public function getMaterias($id = null) {
		$this->db->select('*');
		$this->db->from('materias_encuesta');
		if ($id) {
			$this->db->where('id', $id);
		}
		$this->db->order_by('materia', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function getPensum($sede, $carrera) {
		$this->db->select('pensum');
		$this->db->from('pensum');
		$this->db->where('sede', $sede);
		$this->db->where('carrera', $carrera);
		
		$query = $this->db->get();
		$result = $query->result();
		if (count($result) > 0) {
			return $result[0]->pensum;
		} else {
			return null;
		}
	}

	public function getPeriodo($id_encuesta) {
		$this->db->select('periodo');
		$this->db->from('encuesta');
		$this->db->where('id', $id_encuesta);
		$query = $this->db->get();
		$result = $query->result();
		if (count($result) > 0) {
			return $result[0]->periodo;
		} else {
			return null;
		}
	}

	public function insertRow($table, $data){
	  	$this->db->insert($table, $data);
	  	return $this->db->insert_id();
	}

  	public function updateRow($table, $col, $colVal, $data) {
  		$this->db->where($col,$colVal);
		$this->db->update($table,$data);
		return true;
	}

	function delete($id = null) {
		if ($id) {
			$this->db->where('id', $id);  
			$this->db->delete('materias_encuesta'); 
		}
	}
	
}?>