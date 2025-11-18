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

$oPrograma = new Programa();
$oGovernanca = new Governanca();

if (isset($_POST['bt_gravar']))
{
    if ($_POST['id'] == '')
        $_POST['id'] = 0;

    $oGovernanca->Update($_POST);
    header("Location: governancas.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=Registro " . ($_POST['cd_vaga'] > 0 ? 'atualizado' : 'cadastrado') . " com sucesso"));
    exit;
}
if (isset($_POST['bt_excluir']))
{
    $oGovernanca->Delete($_POST);
    header("Location: governancas.php?" . cript("m=" . $get['m'] . "&p=" . $get['p']."&msg=Registro excluído com sucesso"));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oGovernanca->GetDados(array('id' => $get['i']));
else
    $oGovernanca->GetDados(array('id' => '0', true));

//echo"<pre>";
//print_r($oGovernanca);
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

    <title>Equipe de Governança > <?= $oGovernanca->dados->id ?></title>

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
                <h1 class="h3 mb-2 text-gray-800">Equipe Governança</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST"
                              action="<?= $_SERVER['PHP_SELF'] . "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nome" class="required">Código</label>
                                        <input value="<?= $oGovernanca->dados->id ?>" type="text" minlength="1"
                                               maxlength="10" class="form-control"
                                               id="id" name="id" readonly>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label for="nome" class="required">Nome *</label>
                                        <input value="<?= $oGovernanca->dados->nome ?>" type="text" minlength="3"
                                               maxlength="150" class="form-control" id="nome" name="nome" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="funcao" class="required">Função *</label>
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

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_cadastro" class="required">Data Cadastro</label>
                                        <input value="<?= $oGovernanca->dados->dt_cadastro ?>" type="date"
                                               class="form-control"
                                               id="dt_cadastro" name="dt_cadastro" readonly>
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
                                    <a href="governancas.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p']); ?>"
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