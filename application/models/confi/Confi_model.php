<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *
 */
class Confi_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function guardarMensaje($data){
        $this->db->insert('mensajes', $data);
        return $this->db->insert_id() > 0;
    }

    public function getMensaje($id){
        $this->db->select('id, mensaje, asunto');
        $this->db->from('mensajes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function actualizarMensaje($data, $id){
        $this->db->where('id', $id);
        $this->db->update('mensajes', $data);
        return $this->db->affected_rows() > 0;
    }

    public function eliminarMensaje($id){
        $this->db->where('id', $id);
        $this->db->delete('mensajes');
        return $this->db->affected_rows() > 0;
    }

    public function listarMensajesConfigurados(){
        $this->db->select('id, mensaje, asunto');
        $this->db->from('mensajes');
        $query = $this->db->get();
        return $query->result();
    }
}