<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Registros extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('registros/Registros_model');
    }

    public function index(){
        $this->load->view('layout/head');
        $this->load->view('registros');
        $this->load->view('layout/footer');
    }

    public function estadisticas(){
        $data['total_registros'] = $this->Registros_model->totalRegistros();
        $data['registros_x_mes'] = $this->Registros_model->registrosXMes();
        $this->load->view('layout/head');
        $this->load->view('estadisticas', $data);
        $this->load->view('layout/footer');
    }

    public function configuracion() {
        $this->load->view('layout/head');
        $this->load->view('configuracion');
        $this->load->view('layout/footer');
    }

    public function guardarNuevoRegistro() {
        $data = array(
            'documento' => $this->input->post('documento'),
            'nombre' => $this->input->post('nombre_completo'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'hoja' => $this->input->post('hoja') == 1 ? true : false,
            'fecha_registro' => date('Y-m-d'),
        );
        if ($this->Registros_model->validarDocumento($data['documento']) == true) {
            die(json_encode(array('error' => 'El documento ya se encuentra registrado')));
        } else {
            die(json_encode($this->Registros_model->guardarNuevoRegistro($data)));
        }
    }

    public function listarRegistros() {
        $registros = $this->Registros_model->listarRegistros();
        $data['data'] = $registros; // Wrap the data in a 'data' key
        echo json_encode($data);
    }

    public function getRegistro(){
        die(json_encode($this->Registros_model->getRegistro($this->input->post('id'))));
    }

    public function editarRegistro(){
        $data = array(
            'documento' => $this->input->post('documento'),
            'nombre' => $this->input->post('nombre_completo'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'hoja' => $this->input->post('hoja') == 1 ? true : false,
            'fecha_registro' => date('Y-m-d'),
        );
        die(json_encode($this->Registros_model->editarRegistro($data, $this->input->post('id'))));
    }
}