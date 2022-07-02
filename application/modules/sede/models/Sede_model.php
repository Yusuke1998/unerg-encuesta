<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Sede_model Class extends CI_Model
 */
class Sede_model extends CI_Model {       
	function __construct(){            
	    parent::__construct();
	    $this->load->database();
	} 

	public function getSedes($codigo = null) {
		$query = "select DISTINCT s.sede, s.codigo from sedes s
		join pensum p on p.sede = s.codigo";
		if ($codigo) {
			$query .= " where p.carrera = '$codigo'";
		}
		$result = $this->db->query($query);
		return $result->result();
	}
	
	public function get_encuestas() {	
		return $this->db->get('encuestas')->result();
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

	function delete($codigo='') {
		$this->db->where('codigo', $codigo);  
		$this->db->delete('sedes'); 
	}
	
}?>