<?php
session_start();
include "inc_config.php";
include('valida_sessao.php');
include('admin/classes/bdados.class.php');
include('admin/classes/EixoMembro.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oEixoMembro = new EixoMembro();

$oEixoMembro->GetDados(array('id' => $get['id_membro']));

?>
<!-- Modal Membros-->
<form method="post" id="formEixoMembro" name="formEixoMembro" role="form"
      action="eixo_membros.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p'] . "&id_eixo=" . $get['id_eixo']) ?>">

    <div class="modal fade" id="modalEixoMembros" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-gray-200">
                    <h5 class="modal-title" id="exampleModalLabel">Dados do Membro</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">x</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="form-group">
                        <label for="nm_membro">Nome</label>
                        <input type="text" name="nm_membro" id="nm_membro" maxlength="200"
                               value="<?= $oEixoMembro->dados->nm_membro ?>" class="form-control">
                        <input type="hidden" name="id_eixo" id="id" value="<?= $get['id_eixo'] ?>">
                        <input type="hidden" name="id" id="id" value="<?= $get['id_membro'] ?>">
                    </div>

                    <div class="form-group">
                        <label for="email"><?= utf8_encode('E-mail') ?></label>
                        <input type="email" name="email" id="email" maxlength="200"
                               value="<?= $oEixoMembro->dados->email ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="instituicao"><?= utf8_encode('Instituição') ?></label>
                        <input type="text" name="instituicao" id="instituicao" maxlength="200"
                               value="<?= $oEixoMembro->dados->instituicao ?>" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="message">Tipo</label>
                        <select name="id_status" class="form-control">
                            <?php foreach ($ar_tipo_eixo_membro as $k => $v) { ?>
                                <option value="<?= $k ?>" <?= ($k == $oEixoMembro->dados->id_status ? 'selected' : '') ?>><?= utf8_encode($v) ?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Voltar</button>
                    <input type="submit" class="btn btn-primary" name="bt_salvar_membro" value="Salvar">
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