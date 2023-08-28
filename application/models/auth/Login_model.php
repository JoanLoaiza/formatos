<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function initSession($username, $password)
    {
        $this->db->select('*');
        $this->db->from('grupo');
        $this->db->where(array('nombre_grupo' => $username, 'contrasenia' => $password));
        return $this->db->get()->row();
    }

    public function validateSession(){
        return $this->session->userdata('logged_in');
    }
}