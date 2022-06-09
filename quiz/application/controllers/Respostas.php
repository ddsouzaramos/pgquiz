<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Respostas extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('perguntas_model');
        $this->load->model('respostas_model');
    }

    public function index() {
        $data['titulo_pagina'] = "Perguntas";
        $this->load->view('admin/perguntas_view', $data);
    }

    public function lista_respostas_pergunta($id) {
        $pergunta = $this->perguntas_model->get_by_id($id);

        $data['id_pergunta'] = $id;
        $data['pergunta'] = $pergunta->descricao;
        $this->load->view('admin/respostas_view', $data);
    }

    public function ajax_list($id) {

        $list = $this->respostas_model->get_by_id_pergunta($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $resposta) {
            $no++;
            $row = array();
            $row[] = $resposta->ordem;
            $row[] = $resposta->descricao;
            $row[] = $resposta->correta === 't' ? 'Sim' : 'Não';

            $actions = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Editar" onclick="edit_resposta('."'".$resposta->id_resposta."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
                        <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Excluir" onclick="delete_resposta('."'".$resposta->id_resposta."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

            //add html for action
            $row[] = $actions;

            $data[] = $row;
        }

        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->respostas_model->count_all(),
                        "recordsFiltered" => $this->respostas_model->count_filtered(),
                        "data" => $data,
                       );
        // output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->respostas_model->get_by_id($id);
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

            if (empty($this->input->post('id_resposta'))) {

                $ordem = $this->respostas_model->get_last_ordem($this->input->post('id_pergunta'));

                $data = array(
                    'id_pergunta' => $this->input->post('id_pergunta'),
                    'descricao' => $this->input->post('descricao'),
                    'correta' => $this->input->post('correta') == 'on' ? true : false,
                    'ordem' => $ordem
                );

                $insert = $this->respostas_model->save($data);
                $retorno['status'] = true;
            }
            else {

                $id_resposta = $this->input->post('id_resposta');

                $data = array(
                    'descricao' => $this->input->post('descricao'),
                    'correta' => $this->input->post('correta') == 'on' ? true : false
                );

                $update = $this->respostas_model->update(array('id_resposta' => $this->input->post('id_resposta')), $data);
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
        $this->respostas_model->delete_by_id($id);
        echo json_encode(array("status" => true), JSON_UNESCAPED_UNICODE);
    }

}