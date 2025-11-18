<?php
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

session_start();
include('valida_sessao.php');
include('inc_config.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/eixo.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oPrograma = new Programa();
$oEixo = new Eixo();

if (isset($_POST['bt_gravar']))
{
    if ($_POST['id'] == '')
        $_POST['id'] = 0;

    $oEixo->Update($_POST);
    header("Location: eixos.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=Registro " . ($_POST['cd_vaga'] > 0 ? 'atualizado' : 'cadastrado') . " com sucesso"));
    exit;
}
if (isset($_POST['bt_excluir']))
{
    $oEixo->Delete($_POST);
    header("Location: eixos.php?" . cript("m=" . $get['m'] . "&p=" . $get['p']));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oEixo->GetDados(array('id' => $get['i']));
else
    $oEixo->GetDados(array('id' => '0', true));

//echo"<pre>";
//print_r($oEixo);
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

    <title>Eixos Estruturantes > <?= $oEixo->dados->id ?></title>

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
                <h1 class="h3 mb-2 text-gray-800">Eixo Estruturante</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST"
                              action="<?= $_SERVER['PHP_SELF'] . "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nome" class="required">Código</label>
                                        <input value="<?= $oEixo->dados->id ?>" type="text" minlength="1"
                                               maxlength="10" class="form-control"
                                               id="id" name="id" readonly>
                                    </div>
                                </div>
                                <div class="col-md-11">
                                    <div class="form-group">
                                        <label for="titulo" class="required">Titulo *</label>
                                        <input value="<?= $oEixo->dados->titulo ?>" type="text" minlength="3"
                                               maxlength="200" class="form-control" id="titulo" name="titulo" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="diretrizes" class="required">Diretrizes (um registro por linha) *</label>
                                        <textarea id="diretrizes" name="diretrizes" rows="6" class="form-control"
                                                  required><?= $oEixo->dados->diretrizes ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="ods" class="required">ODSs (um registro por linha) *</label>
                                        <textarea id="ods" name="ods" rows="5" class="form-control"
                                                  required><?= $oEixo->dados->ods ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="datas" class="required">Calendário (um registro por linha) *</label>
                                        <textarea id="datas" name="datas" rows="5" class="form-control"
                                                  required><?= $oEixo->dados->datas ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" name="bt_gravar" class="btn btn-primary">Salvar</button>
                                    <a href="eixos.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p']); ?>"
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