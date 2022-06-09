<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Publicis Groupe - PgQuiz</title>

        <!-- JQuery -->
        <script src="<?= base_url('assets/pkg/jquery/jquery-3.6.0.js'); ?>"></script>

        <!-- Bootstrap 3 -->
        <link href="<?= base_url('assets/pkg/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('assets/pkg/bootstrap/js/bootstrap.min.js'); ?>"></script>

        <!-- Custom CSS Login -->
        <link rel="stylesheet" href="<?= base_url('assets/pkg/custom/login/login.css');?>" />

        <!-- Custom JS Login -->
        <script src="<?= base_url('assets/pkg/custom/login/login.js'); ?>"></script>

    </head>

    <body>
        <div class="container">
            <div class="col-sm-12">
                <div class="card card-container">
                    <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
                    <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
                    <p id="profile-name" class="profile-name-card"></p>
                    <form class="form-signin" action="<?php base_url('login/autenticar'); ?>" method="POST">
                        <span id="reauth-email" class="reauth-email"></span>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Endereço de e-mail" value="<?php echo (isset($email)) ? $email : '' ?>" required autofocus>
                        <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" value="<?php echo (isset($senha)) ? $senha : '' ?>" required>
                        <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Entrar</button>
                    </form><!-- /form -->
                    <small id="error" class="text-danger">
                        <?= $this->session->flashdata('error'); ?>
                    </small>
                </div><!-- /card-container -->
            </div>
        </div><!-- /container -->
    </body>
</html>