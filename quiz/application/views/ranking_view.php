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

        <!-- Bootbox -->
        <script src="<?= base_url('assets/pkg/bootbox/bootbox.min.js'); ?>"></script>

    </head>

    <body>
        <div class="container">
            <div class="col-sm-12">
                <h2><b>Publicis Groupe - Ranking Quiz</b></h2>
                <br>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Pontos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ranking as $row) { ?>
                        <tr>
                            <td><?= $row->rkg; ?></td>
                            <td><?= $row->nome; ?></td>
                            <td><?= $row->pontos; ?></td>
                        </t>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div><!-- /container -->
    </body>
</html>