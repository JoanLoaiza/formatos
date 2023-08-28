<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Configuracion extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('confi/Confi_model');
        $this->load->model('auth/Login_model');
    }

    public function index() {
        if($this->Login_model->validateSession()){
            $this->load->view('layout/head');
            $this->load->view('layout/nav');
            $this->load->view('confi/configuracion');
            $this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }

    public function guardarMensaje(){
        $data = array(
            'mensaje' => $this->input->post('mensaje'),
            'asunto' => $this->input->post('asunto')
        );
        die(json_encode($this->Confi_model->guardarMensaje($data)));
    }

    public function getMensaje(){
        die(json_encode($this->Confi_model->getMensaje($this->input->post('id'))));
    }

    public function editarMensaje(){
        $data = array(
            'mensaje' => $this->input->post('mensaje'),
            'asunto' => $this->input->post('asunto')
        );
        die(json_encode($this->Confi_model->actualizarMensaje($data, $this->input->post('id'))));
    }

    public function eliminarMensaje(){
        die(json_encode($this->Confi_model->eliminarMensaje($this->input->post('id'))));
    }

    public function listarMensajesConfigurados(){
        die(json_encode($this->Confi_model->listarMensajesConfigurados()));
    }
}