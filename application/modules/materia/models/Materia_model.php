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

	public function insertRow($table, $data){
	  	$this->db->insert($table, $data);
	  	return $this->db->insert_id();
	}

  	public function updateRow($table, $col, $colVal, $data) {
  		$this->db->where($col,$colVal);
		$this->db->update($table,$data);
		return true;
	}

	function delete($id = '') {
		$this->db->where('id', $id);  
		$this->db->delete('materias_encuesta'); 
	}
	
}?>