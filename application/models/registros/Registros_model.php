<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Registros_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function guardarNuevoRegistro($data){
        $this->db->insert('registros', $data);
        return $this->db->insert_id();
    }

    public function validarDocumento($documento){
        $this->db->where('documento', $documento);
        $this->db->where('fecha_registro', date('Y-m-d'));
        $query = $this->db->get('registros');
        return $query->num_rows() > 0;
    }

    public function listarRegistros($fecha = null, $todos = false){
        $this->db->select('*');
        $this->db->from('registros');
        if ($fecha != null) {
            $this->db->where('fecha_registro', $fecha);
        }
        
        if ($todos) {
            $this->db->where('fecha_registro >=', date('Y-m-d', strtotime('-1 month')));
        } else {
            $this->db->where('fecha_registro', date('Y-m-d'));
        }
        $this->db->where('id_grupo', $this->session->userdata('id_grupo'));
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result(); // Use result() instead of result_array()
    }

    //Estadisticas de los datos
    public function totalRegistros(){
        $this->db->select('*');
        $this->db->from('registros');
        return $this->db->get()->num_rows();
    }

    public function registrosReunion() {
        $this->db->select('re.nombre_reunion,re.id_reunion, reg.fecha_registro, COUNT(reg.*) as cantidad_registros');
        $this->db->from('registros as reg');
        $this->db->join('reunion as re', 're.id_reunion = reg.id_reunion');
        $this->db->group_by('re.nombre_reunion, re.id_reunion, reg.fecha_registro');
        return $this->db->get()->result();
    }

    public function getRegistro($id = null, $documento = null){
        $this->db->select('*');
        $this->db->from('registros');
        if ($id != null) $this->db->where('id', $id);
        if ($documento != null) $this->db->where('documento', $documento);
        $query = $this->db->get();
        return $query->row(); // Use result() instead of result_array()
    }

    public function editarRegistro($data, $id){
        $this->db->where('id', $id);
        $this->db->update('registros', $data);
        return $this->db->affected_rows() > 0;
    }

    public function guardarReunion($nombre_reunion){
        $temp = 'REUNIÓN' . strtoupper($nombre_reunion);
        $this->db->insert('reunion', array('nombre_reunion' => $temp));
        return $this->db->insert_id();
    }

    public function updateReunion($id_reunion, $nombre_reunion){
        $temp = 'REUNIÓN' . strtoupper($nombre_reunion);
        $this->db->where('id_reunion', $id_reunion);
        $this->db->update('reunion', array('nombre_reunion' => $temp));
        return $this->db->affected_rows() > 0;
    }

    public function getReunion($idReunion){
        $this->db->select('*');
        $this->db->from('reunion');
        $this->db->where('id_reunion', $idReunion);
        $query = $this->db->get();
        return $query->row(); // Use result() instead of result_array()
    }
}