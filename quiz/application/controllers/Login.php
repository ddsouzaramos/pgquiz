<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function autenticar() {
        $this->load->model("usuarios_model");
        $data = array();

        if($_SERVER['REQUEST_METHOD'] == 'POST') {

            $email = $this->input->post("email");
            $senha = md5($this->input->post("senha"));
            $usuario = $this->usuarios_model->logar($email, $senha);

            $data = array(
                'email' => $email,
                'senha' => $senha
            );

            if($usuario) {

                $this->session->set_userdata("usuario_logado", true);
                $this->session->set_userdata("id_usuario", $usuario['id_usuario']);
                $this->session->set_userdata("email", $usuario['email']);
                $this->session->set_userdata("nomecompleto", $usuario['nomecompleto']);
                redirect('home', 'refresh');
            }
            else {
                $this->session->set_flashdata("error", "Usuário ou senha inválidos!");
            }
        }
        $this->load->view('admin/login', $data);
    }

    public function encerrar_sessao() {
        $this->session->sess_destroy();
        redirect('home');
    }
}