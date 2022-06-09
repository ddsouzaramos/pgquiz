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
                <h2><b>Publicis Groupe - Quiz</b></h2>
                <br>
                <form action="#" id="form" data-toggle="validator" role="form">
                    <input type="hidden" name="nome" value=""/>
                    <?php
                        $id_pergunta = '';
                        $cont = 0;
                        foreach($perguntas as $row) {

                            if($id_pergunta != $row->id_pergunta) {
                                $cont = $cont + 1;
                                echo '<h4><b>' . $cont . '. ' . $row->pergunta . '</b></h4>' . PHP_EOL;
                                $id_pergunta = $row->id_pergunta;
                            }

                            echo '<div class="form-check">' . PHP_EOL;
                            echo '<input class="form-check-input" type="radio" name="' . $row->id_pergunta . '" value="' . $row->id_resposta . '">' . PHP_EOL;
                            echo '<label class="form-check-label" for="' . $id_pergunta . '">' . PHP_EOL;
                            echo ' ' . $row->resposta . PHP_EOL;
                            echo '</label>' . PHP_EOL;
                            echo '</div>' . PHP_EOL;
                        }
                    ?>
                </form>
                <div class="row">
                    <button type="button" class="btn pull-right btn-primary btn-lg" id="btnConcluir" onclick="concluir()">Concluir</button>
                </div>
            </div>
        </div><!-- /container -->
    </body>
    <script type="text/javascript">

        function concluir() {

            bootbox.prompt({
                title: "Digite seu nome",
                centerVertical: true,
                inputType: 'text',
                callback: function(nome) {
                    $('[name="nome"]').val(nome);
                    if(nome != '') {
                        $.ajax({
                            type:"POST",
                            url: "<?= base_url('quiz/ajax_concluir') ?>",
                            data: $('#form').serialize(),
                            success:function(result) {
                                var retorno = JSON.parse(result.trim());
                                bootbox.alert({
                                    message: retorno.nome + ' sua pontuação foi: ' + retorno.pontuacao + ' pontos!',
                                    callback: function () {
                                        window.location.replace("<?= base_url('ranking'); ?>");
                                    }
                                })
                            },
                            error:function(error) {
                                bootbox.alert(error.responseJSON.message);
                            }
                        });
                    }
                    else {
                        bootbox.alert('É necessário digitar o nome!');
                    }
                }
            });
        }

        function ranking() {

        }

    </script>
</html>