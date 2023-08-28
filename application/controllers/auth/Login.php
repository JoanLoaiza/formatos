<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('auth/Login_model');
    }

    public function index(){
        $this->load->view('layout/head');
        $this->load->view('auth/login');
        $this->load->view('layout/footer');
    }

    public function initSession(){
        $username = $this->input->post('login-username');
        $password = $this->input->post('login-password');
        $result = $this->Login_model->initSession($username, $password);
        if($result){
            $data = array(
                'id_grupo' => $result->id_grupo,
                'nombre_grupo' => $result->nombre_grupo,
                'logged_in' => true
            );
            $this->session->set_userdata($data);
            //Redireccionar a la vista registros
            die(json_encode(true));
        }else{
            echo json_encode(array('status' => false));
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('reportes');
    }
}