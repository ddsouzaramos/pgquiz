<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quiz extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('perguntas_model');
    }

    public function index() {
        $data['perguntas'] = $this->perguntas_model->get_perguntas_quiz();
        $this->load->view('quiz_view.php', $data);
    }
}
