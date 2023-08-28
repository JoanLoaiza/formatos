<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Registros extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('registros/Registros_model');
        $this->load->model('auth/Login_model');
    }

    public function index(){
        if($this->Login_model->validateSession()){
            $this->load->view('layout/head');
            $this->load->view('layout/nav');
            $this->load->view('registros/registros');
            $this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }

    public function estadisticas(){
        if($this->Login_model->validateSession()){
            $data['registros_reunion'] = $this->Registros_model->registrosReunion();
            $this->load->view('layout/head');
            $this->load->view('layout/nav');
            $this->load->view('estadisticas/estadisticas', $data);
            $this->load->view('layout/footer');
        }else{
            redirect('login');
        }
    }

    public function guardarNuevoRegistro() {
        $data = array(
            'documento' => $this->input->post('documento'),
            'nombre' => $this->input->post('nombre_completo'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'hoja' => $this->input->post('hoja') == 1 ? true : false,
            'fecha_registro' => !empty($this->input->post('fecha_modal')) ? $this->input->post('fecha_modal') : date('Y-m-d'),
            'id_reunion' => $this->input->post('id_reunion'),
        );
        if ($this->Registros_model->validarDocumento($data['documento'])) {
            die(json_encode(array('error' => 'El documento ya se encuentra registrado')));
        } else {
            die(json_encode($this->Registros_model->guardarNuevoRegistro($data)));
        }
    }

    public function guardarReunion(){
        die(json_encode($this->Registros_model->guardarReunion($this->input->post('nombre_reunion'))));
    }

    public function listarRegistros() {
        die(json_encode($this->Registros_model->listarRegistros($this->input->post('fecha'), $this->input->post('todos'))));
    }

    public function getRegistro(){
        die(json_encode($this->Registros_model->getRegistro($this->input->post('id'), $this->input->post('documento'))));
    }

    public function editarRegistro(){
        $data = array(
            'documento' => $this->input->post('documento'),
            'nombre' => $this->input->post('nombre_completo'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'hoja' => $this->input->post('hoja') == 1 ? true : false
        );
        die(json_encode($this->Registros_model->editarRegistro($data, $this->input->post('id'))));
    }
}