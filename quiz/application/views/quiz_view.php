<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- JQuery -->
        <script src="<?= base_url('assets/pkg/jquery/jquery-3.6.0.js'); ?>"></script>

        <!-- Bootstrap 3 -->
        <link href="<?= base_url('assets/pkg/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
        <script src="<?= base_url('/teste-senior/quiz/assets/pkg/bootstrap/js/bootstrap.min.js'); ?>"></script>
    </head>

    <body>
        <div class="container">
            <div class="col-sm-12">


                <?php
                    $id_pergunta = '';
                    $cont = 0;
                    foreach($perguntas as $row) {

                        if($id_pergunta != $row->id_pergunta) {
                            $cont = $cont + 1;
                            echo '<h4><b>' . $cont . '. ' . $row->pergunta . '</b></h4>';
                            $id_pergunta = $row->id_pergunta;
                        }

                        echo '<div class="form-check">';
                        echo '<input class="form-check-input" type="radio" name="' . $row->id_pergunta . '" id="' . $row->id_pergunta . '">';
                        echo '<label class="form-check-label" for="' . $id_pergunta . '">';
                        echo ' ' . $row->resposta;
                        echo '</label>';
                        echo '</div>';

                    }

                ?>
            </div>
        </div><!-- /container -->
    </body>
</html>