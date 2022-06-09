<?php
    $data['titulo_pagina'] = 'Respostas';
    $this->load->view('admin/header', $data);
?>

    <div class="container-fluid">
        <br>
        <div class="alert alert-info alert-dismissable">
            <b>Pergunta: </b><?= $pergunta ?>
        </div>
        <h3>Respostas</h3>
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Ordem</th>
                    <th>Descrição</th>
                    <th>Resp. Correta</th>
                    <th style="width:120px;">Ação</th>
                </tr>
            </thead>
        </table>

        <!-- Bootstrap modal -->
        <div class="modal fade" id="modal_form" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form" data-toggle="validator" role="form">
                            <input type="hidden" name="id_pergunta" value=""/>
                            <input type="hidden" name="id_resposta" value=""/>
                            <div class="row">
                                <div id="descricao_block" class="form-group col-md-12">
                                    <label for="descricao" class="control-label">Descrição</label>
                                    <textarea class="form-control" name="descricao" id="descricao" rows="5" placeholder="Descrição da Resposta"></textarea>
                                    <div id="descricao_error" class="help-block"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="correta_block" class="form-group col-md-12">
                                    <div class="checkbox">
                                        <label><input type="checkbox" name="correta" id="correta" unchecked>Resposta Correta?</label>
                                    </div>
                                    <div id="correta_error" class="help-block"></div>
                                </div>
                            </div>
                        </form>
                        <div class="modal-footer">
                            <button type="button" id="btnSave" onclick="save_resposta()" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        <!-- End Bootstrap modal -->
    </div>

    <script type="text/javascript">

        var table;

        $( document ).ready(function() {
            load_data();
        });

        function load_data() {

            var url = "<?= base_url('respostas/ajax_list/') . $id_pergunta ?>";

            table = $('#table').DataTable({
                "processing": true,
                "serverSide": true,
                "responsive": true,
                "filter": false,
                "paging": false,
                "order": [],
                "ajax": {
                    "url": url,
                    "type": "POST"
                },
                "columnDefs": [
                {
                    "targets": [ -2, -1 ],
                    "orderable": false,
                },
                ],
                "language": {
                    "url": "<?= base_url('assets/pkg/datatables/portugues.json'); ?>"
                },
                dom: 'Bfrtlip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o" aria-hidden="true"></i>' + '',
                        titleAttr: 'Exportar para Excel'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf-o"></i>' + '',
                        titleAttr: 'Exportar para PDF'
                    },
                    {
                        text: '<i class="fa fa-plus" aria-hidden="true"></i>' + '',
                        titleAttr: 'Novo Registro',
                        action: function () {
                                    add_resposta();
                        },
                    },
                    {
                        text: '<i class="fa fa-refresh" aria-hidden="true"></i>' + '',
                        titleAttr: 'Atualizar Dados',
                        action: function () {
                                    table.ajax.reload(null, false);
                        }
                    },
                ],
            });
        }

        function add_resposta() {
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#modal_form').modal('show');
            $('.modal-title').text('Nova Resposta');

            $('[name="id_resposta"]').val('');
            $('[name="id_pergunta"]').val("<?= $id_pergunta ?>");
        }

        function edit_resposta(id) {
            $('#form')[0].reset();
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();

            $.ajax({
            url : "<?= base_url('respostas/ajax_edit/') ?>" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_pergunta"]').val(data.id_pergunta);
                $('[name="id_resposta"]').val(data.id_resposta);
                $('[name="descricao"]').val(data.descricao);

                if(data.correta == 't')
                    $('[name="correta"]').prop('checked', true);
                else
                    $('[name="correta"]').prop('checked', false);

                $('#modal_form').modal('show');
                $('.modal-title').text('Editar Resposta');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert('Erro ao recuperar os dados o servidor!');
            }
            });
        }

        function save_resposta() {
            $('.form-group').removeClass('has-error');
            $('.help-block').empty();
            $('#btnSave').text('Salvando...');
            $('#btnSave').attr('disabled', true);
            var url;

            $.ajax({
                url : "<?= base_url('respostas/ajax_save') ?>",
                type: "POST",
                data: $('#form').serialize(),
                success: function(data) {
                    var retorno = JSON.parse(data.trim());

                    // SE RETORNOU COM SUCESSO
                    if(retorno.status == true) {
                        $('#modal_form').modal('hide');
                        table.ajax.reload(null, false);
                        $('#btnSave').text('Salvar');
                        $('#btnSave').attr('disabled', false);
                    }
                    else {
                        // ADICIONA A DESCRIÇÃO DO ERRO RETORNADO DA VALIDAÇÃO NO CAMPO
                        $.each(retorno.messages,  function(key, value) {
                            $('#' + key + '_error').html(value);
                        });

                        // ADICIONA A CLASSE DE ERRO NO CAMPO
                        $.each(retorno.messages,  function(key, value) {
                            $('#' + key + '_block').addClass('has-error');
                        });
                    }

                    $('#btnSave').text('Salvar');
                    $('#btnSave').attr('disabled', false);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert('Erro ao inserir/atualizar os dados no servidor! Tente novamente mais tarde.');
                    $('#btnSave').text('Salvar');
                    $('#btnSave').attr('disabled', false);
                }
            });
        }

        function delete_resposta(id) {
            if(confirm('Você deseja excluir esta resposta?')) {
                $.ajax({
                    url : "<?= base_url('respostas/ajax_delete') ?>" + "/" + id,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data) {
                        $('#modal_form').modal('hide');
                        table.ajax.reload(null, false);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert('Erro ao excluir a resposta!');
                    }
                });
            }
        }
    </script>
