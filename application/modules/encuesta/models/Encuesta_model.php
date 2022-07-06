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

	public function getReporteGeneral($anio, $carrera, $sede) {
		$this->db->select('e.periodo, p.cedula, p.nombres, p.apellidos, c.carrera, s.sede, o.materia, o.turno');
		$this->db->from('participacion p');
		$this->db->join('encuesta e', 'e.id = p.encuesta');
		$this->db->join('carreras c', 'c.codigo = p.carrera');
		$this->db->join('sedes s', 's.codigo = p.sede');
		$this->db->join('opciones o', 'o.participacion_id = p.id');
		$this->db->like('e.periodo', $anio);
		$this->db->where('p.carrera', $carrera);
		$this->db->where('p.sede', $sede);
		$this->db->order_by('p.cedula');
		$query = $this->db->get();
		return $query->result();
	}

	public function getReporteResumen($anio, $carrera, $sede) {
		$this->db->select('e.periodo, count(distinct p.cedula) solicitantes, c.carrera, s.sede, o.materia, o.turno');
		$this->db->from('participacion p');
		$this->db->join('encuesta e', 'e.id = p.encuesta');
		$this->db->join('carreras c', 'c.codigo = p.carrera');
		$this->db->join('sedes s', 's.codigo = p.sede');
		$this->db->join('opciones o', 'o.participacion_id = p.id');
		$this->db->like('e.periodo', $anio);
		$this->db->where('p.carrera', $carrera);
		$this->db->where('p.sede', $sede);
		$this->db->order_by('p.cedula');
		$this->db->group_by('o.materia, o.turno');
		$query = $this->db->get();
		return $query->result();
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