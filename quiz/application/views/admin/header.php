<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= 'PGQuiz - ' . $titulo_pagina ?></title>

        <!-- JQuery -->
        <script src="<?= base_url('assets/pkg/jquery/jquery-3.6.0.js'); ?>"></script>

        <!-- Bootstrap 3 -->
        <link href="<?= base_url('assets/pkg/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('assets/pkg/bootstrap/js/bootstrap.min.js'); ?>"></script>

        <!-- SB-ADMIN -->
        <link href="<?= base_url('assets/pkg/sb-admin/css/sb-admin.css'); ?>" rel="stylesheet">

        <!-- Font AweSome -->
        <link rel="stylesheet" href="<?= base_url('assets/fonts/font-awesome/css/font-awesome.min.css'); ?>">

        <!-- Data Tables -->
        <link href="<?= base_url('assets/pkg/datatables/datatables.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('assets/pkg/datatables/datatables.min.js'); ?>"></script>

        <!-- Ícone da página -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">

    </head>

    <body>

        <div id="wrapper">

            <!-- Sidebar -->
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="<?= base_url(); ?>">
                        <img style="margin-left: 60px; margin-top: 5px" src="<?= base_url('assets/img/pglogo.png'); ?>" width="85px" alt="UCBVEt Saúde Animal">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li><a href="<?= base_url('perguntas'); ?>"><i class="fa fa-question"></i> Perguntas</a></li>
                        <li><a href="<?= base_url('/login/encerrar_sessao'); ?>"><i class="fa fa-power-off"></i> Sair</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right navbar-user">
                        <li class="dropdown user-dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?= $this->session->userdata('nomecompleto'); ?> <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?= base_url('/login/encerrar_sessao')?>"><i class="fa fa-power-off"></i> Sair</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">