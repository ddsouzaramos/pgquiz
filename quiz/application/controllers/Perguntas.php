<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perguntas extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('perguntas_model');
    }

    public function index() {
        $data['titulo_pagina'] = "Perguntas";
        #$data['processos'] = $this->processos_model->get_all();
        $this->load->view('admin/perguntas_view', $data);
    }

    public function ajax_list() {
        $list = $this->perguntas_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pergunta) {
            $no++;
            $row = array();
            $row[] = $pergunta->descricao;

            $url_respostas = base_url('respostas/lista_respostas_pergunta/') . $pergunta->id_pergunta;

            $actions = '<a class="btn btn-sm btn-warning" title="Respostas" href="'.$url_respostas.'"><i class="glyphicon glyphicon-list"></i> </a>
                        <a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Editar" onclick="edit_pergunta('."'".$pergunta->id_pergunta."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Excluir" onclick="delete_pergunta('."'".$pergunta->id_pergunta."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

            //add html for action
            $row[] = $actions;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->perguntas_model->count_all(),
                        "recordsFiltered" => $this->perguntas_model->count_filtered(),
                        "data" => $data,
                       );
        // output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->perguntas_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_save() {

        $retorno = array('status' => false, 'messages' => array());

        ######### VALIDAÇÃO #########
        $this->load->library('form_validation');
        $this->form_validation->set_rules("descricao", "Descrição", "required");
        $this->form_validation->set_error_delimiters('', '');
        ##############################

        if ($this->form_validation->run()) {

            if (empty($this->input->post('id_pergunta'))) {

                $data = array(
                    'descricao' => $this->input->post('descricao')
                );

                $insert = $this->perguntas_model->save($data);
                $retorno['status'] = true;
            }
            else {

                $id_pergunta = $this->input->post('id_pergunta');

                $data = array(
                    'descricao' => $this->input->post('descricao')
                );

                $update = $this->perguntas_model->update(array('id_pergunta' => $this->input->post('id_pergunta')), $data);
                $retorno['status'] = true;
            }
        }
        else {
            foreach ($_POST as $key => $value) {
                if (!empty(form_error($key)))
                    $retorno['messages'][$key] = form_error($key);
            }
        }
        echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
    }

    public function ajax_delete($id) {
        $this->perguntas_model->delete_by_id($id);
        echo json_encode(array("status" => true), JSON_UNESCAPED_UNICODE);
    }

}