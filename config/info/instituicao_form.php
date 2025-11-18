<?php
session_start();
ob_start();
include('valida_sessao.php');
include('inc_config.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/instituicao.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oPrograma = new Programa();
$oInstituicao = new Instituicao();

if (isset($_POST['bt_gravar']))
{
    if ($_POST['id'] == '')
        $_POST['id'] = 0;

    $oInstituicao->Update($_POST);
    header("Location: instituicoes.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=Registro " . ($_POST['cd_vaga'] > 0 ? 'atualizado' : 'cadastrado') . " com sucesso"));
    exit;
}
if (isset($_POST['bt_excluir']))
{
    $oInstituicao->Delete($_POST);
    header("Location: instituicoes.php?" . cript("m=" . $get['m'] . "&p=" . $get['p']."&msg=Registro excluído com sucesso!"));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oInstituicao->GetDados(array('id' => $get['i']));
else
    $oInstituicao->GetDados(array('id' => '0', true));

//echo"<pre>";
//print_r($oInstituicao);
//echo"</pre>";

flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Marcelo Mazon">
    <link rel="shortcut icon" href="../assets/img/globo_foup_fav_icon.png" type="image/x-icon">

    <title>Instituições Signatárias > <?= $oInstituicao->dados->id ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.css"/>
    <script src="ckeditor/ckeditor.js"></script>
    <style type="text/css">
        .cke_textarea_inline {
            border: 1px solid black;
        }
    </style>

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    include('inc_menu.php');
    ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            include('inc_topbar.php');
            ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">Instituições Signatárias</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST"
                              action="<?= $_SERVER['PHP_SELF'] . "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nome" class="required">Sigla</label>
                                        <input value="<?= $oInstituicao->dados->sigla ?>" type="text" minlength="1"
                                               maxlength="10" class="form-control"
                                               id="sigla" name="sigla">
                                        <input value="<?= $oInstituicao->dados->id ?>" type="hidden" id="id" name="id">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="nome" class="required">Nome *</label>
                                        <input value="<?= $oInstituicao->dados->nome ?>" type="text" minlength="3"
                                               maxlength="150" class="form-control" id="nome" name="nome" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="tipo" class="required">Tipo *</label>
                                        <select name="tipo" class="form-control">
                                            <?php foreach ($ar_tipo_instituicao as $k => $v) { ?>
                                                <option value="<?= $k ?>" <?= ($k == $oInstituicao->dados->tipo ? 'selected' : '') ?>><?= utf8_encode($v) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="representante" class="required">Representante</label>
                                        <input value="<?= $oInstituicao->dados->representante ?>" type="text" minlength="1"
                                               maxlength="150" class="form-control"
                                               id="representante" name="representante" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo" class="required">Logo</label>
                                        <input value="<?= $oInstituicao->dados->logo ?>" type="text" minlength="1"
                                               maxlength="250" class="form-control"
                                               id="logo" name="logo">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="cidade" class="required">Cidade</label>
                                        <input value="<?= $oInstituicao->dados->cidade ?>" type="text" minlength="1"
                                               maxlength="150" class="form-control"
                                               id="cidade" name="cidade">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="uf" class="required">Estado</label>
                                        <input value="<?= $oInstituicao->dados->uf ?>" type="text" minlength="1"
                                               maxlength="150" class="form-control"
                                               id="uf" name="uf">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pais" class="required">País</label>
                                        <input value="<?= $oInstituicao->dados->pais ?>" type="text" minlength="1"
                                               maxlength="150" class="form-control"
                                               id="pais" name="pais">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" name="bt_gravar" class="btn btn-primary">Salvar</button>
                                    <button type="submit"
                                            onclick="return confirm('ATENÇÃO: Deseja realmente excluir?');"
                                            name="bt_excluir" class="btn btn-danger">Excluir
                                    </button>
                                    <a href="instituicoes.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p']); ?>"
                                       type="button" class="btn btn-secondary ml-1">Cancelar</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php
        // include('inc_footer.php');
        ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<?php
include 'inc_modals.php'
?>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>