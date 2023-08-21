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

    const ESQUEMA = 'registros_y3tw';

    public function guardarNuevoRegistro($data){
        $this->db->insert(self::ESQUEMA . 'registros', $data);
        return $this->db->insert_id();
    }

    public function validarDocumento($documento){
        $this->db->where('documento', $documento);
        $query = $this->db->get(self::ESQUEMA . 'registros');
        return $query->num_rows() > 0;
    }

    public function listarRegistros(){
        $this->db->select('*');
        $this->db->from(self::ESQUEMA . 'registros');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result(); // Use result() instead of result_array()
    }

    //Estadisticas de los datos
    public function totalRegistros(){
        $this->db->select('*');
        $this->db->from(self::ESQUEMA . 'registros');
        return $this->db->get()->num_rows();
    }

    public function registrosXMes() {
        $this->db->select('EXTRACT(MONTH FROM fecha_registro) as mes, COUNT(*) as total');
        $this->db->from(self::ESQUEMA . 'registros');
        $this->db->group_by('mes');
        $this->db->order_by('mes', 'ASC');
        return $this->db->get()->result();
    }

    public function getRegistro($id){
        $this->db->select('*');
        $this->db->from(self::ESQUEMA . 'registros');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(); // Use result() instead of result_array()
    }

    public function editarRegistro($data, $id){
        $this->db->where('id', $id);
        $this->db->update(self::ESQUEMA . 'registros', $data);
        return $this->db->affected_rows() > 0;
    }
}