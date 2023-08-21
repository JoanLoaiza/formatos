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

    const ESQUEMA = 'registros_y3tw';

    public function guardarMensaje($data){
        $this->db->insert(self::ESQUEMA . 'mensajes', $data);
        return $this->db->insert_id() > 0;
    }

    public function getMensaje($id){
        $this->db->select('id, mensaje, asunto');
        $this->db->from(self::ESQUEMA . 'mensajes');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function actualizarMensaje($data, $id){
        $this->db->where('id', $id);
        $this->db->update(self::ESQUEMA . 'mensajes', $data);
        return $this->db->affected_rows() > 0;
    }

    public function eliminarMensaje($id){
        $this->db->where('id', $id);
        $this->db->delete(self::ESQUEMA . 'mensajes');
        return $this->db->affected_rows() > 0;
    }

    public function listarMensajesConfigurados(){
        $this->db->select('id, mensaje, asunto');
        $this->db->from(self::ESQUEMA . 'mensajes');
        $query = $this->db->get();
        return $query->result();
    }
}