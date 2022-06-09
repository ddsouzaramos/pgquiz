<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('perguntas_model');
        $this->load->model('respostas_model');
        $this->load->model('ranking_model');
    }

    public function index() {
        $data['perguntas'] = $this->perguntas_model->get_perguntas_quiz();
        $this->load->view('quiz_view.php', $data);
    }

    public function ajax_concluir() {

        $nome = $this->input->post('nome');
        $pontuacao = 0;
        foreach ($_POST as $key => $value) {
            if($key != 'nome') {
                if($this->respostas_model->verifica_resposta_verdadeira($this->input->post($key))) {
                    $pontuacao = $pontuacao + 10;
                }
            }
        }
        $this->ranking_model->save($nome, $pontuacao);
        echo json_encode(array('status' => true, 'nome' => $nome, 'pontuacao' => $pontuacao), JSON_UNESCAPED_UNICODE);
    }

}
