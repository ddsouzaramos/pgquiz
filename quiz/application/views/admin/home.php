<?php
    $data['titulo_pagina'] = 'Home';
    $this->load->view('admin/header', $data);
?>

<div class="row">
    <div class="col-lg-12">
        <h1>Publicis Groupe Quiz</h1>
        <div class="alert alert-info alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            Olá <?= $this->session->userdata('nomecompleto') ?> seja bem vindo.
        </div>
    </div>
</div><!-- /.row -->

<?php
    $this->load->view('admin/footer');
?>