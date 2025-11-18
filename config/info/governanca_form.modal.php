<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
ob_start();
include('valida_sessao.php');
include('inc_config.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/governanca.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oGovernanca = new Governanca();

//pega os dados para edição
if (isset($get['i']))
    $oGovernanca->GetDados(array('id' => $get['i']));
else
    $oGovernanca->GetDados(array('id' => '0', true));

?>

<form class="needs-validation" method="POST" id="formGovernanca"
      action="governancas.php<?= "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">

    <div class="modal fade" id="modalGovernanca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gray-200">
                    <h5 class="modal-title" id="exampleModalLabel"><?=utf8_encode('Governança')?></h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>

                <div class="modal-body">


                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nome" class="required">Nome *</label>
                                <input value="<?= $oGovernanca->dados->nome ?>" type="text" minlength="3"
                                       maxlength="150" class="form-control" id="nome" name="nome" required>
                                <input value="<?= $oGovernanca->dados->id ?>" type="hidden" minlength="1"
                                       maxlength="10" class="form-control"
                                       id="id" name="id" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="funcao" class="required"><?=utf8_encode('Função');?> *</label>
                                <input value="<?= $oGovernanca->dados->funcao ?>" type="text" minlength="1"
                                       maxlength="200" class="form-control"
                                       id="funcao" name="funcao" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo" class="required">Tipo *</label>
                                <select name="tipo" class="form-control">
                                    <?php foreach ($ar_tipo_governanca as $k => $v) { ?>
                                        <option value="<?= $k ?>" <?= ($k == $oGovernanca->dados->tipo ? 'selected' : '') ?>><?= utf8_encode($v) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                    <input type="submit" class="btn btn-primary" name="bt_gravar" value="Salvar">
                </div>

            </div>
        </div>
    </div>
</form>

<script>
    /*
    $('#formEixoMembro').on('submit', function (e) {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            dataType: 'json',
            contentType: false,
            beforeSend: function () {
                $(form).find('span.error-text').text('');
            },
            success: function (data) {
                if (data.code == 0) {
                    if (data.msg)
                        toastr.error(data.msg);
                    else {
                        $.each(data.error, function (prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                            toastr.error(val[0]);
                        });
                    }
                } else {
                    //$(form)[0].reset();
                    //alert(JSON.stringify(data));
                    toastr.success(data.msg);
                    $('#createModalConexao').modal('hide');
                    $('#dataTableConexao').DataTable().ajax.reload();
                }
            }
        });
    });*/

</script>