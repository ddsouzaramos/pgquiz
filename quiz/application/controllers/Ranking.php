<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ranking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ranking_model');
    }

    public function index() {
        $data['ranking'] = $this->ranking_model->get_ranking();
        $this->load->view('ranking_view.php', $data);
    }

}
