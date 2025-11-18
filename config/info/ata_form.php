<?php
//ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

session_start();
ob_start();
include('valida_sessao.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/ata.class.php');
include('admin/classes/eixo.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

//$oPrograma = new Programa();
$oAta = new Ata();
$oEixo = new Eixo();

if (isset($_POST['bt_gravar']))
{
    if (isset($_FILES['arquivo'])) {
        if ($nm_arquivo = upload_ata($_FILES['arquivo'], 'atas', uniqid()))
            $_POST['nm_arquivo'] = $nm_arquivo;
    }

    $oAta->Update($_POST);

    header("Location: atas.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=Ata " . ($_POST['id'] > 0 ? 'atualizada' : 'cadastrada') . " com sucesso"));
    exit;
}

if (isset($_POST['bt_excluir'])) {
    if (is_file('../atas/' . $_POST['nm_arquivo'])) {
        unlink('../atas/' . $_POST['nm_arquivo']);
    }

    $oAta->Delete($_POST);
    $msg = 'Ata excluida com sucesso';

    header("Location: atas.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=" . $msg));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oAta->GetDados(array('id' => $get['i']));
else
    $oAta->GetDados(array('id' => '0', true));

if (isset($get['excluir_anexo'])) {
    unlink('../atas/' . $oAta->dados->nm_arquivo);
    $_POST['nm_arquivo'] = '';
    $oAta->Update(array('id'=>$get['i'],'nm_arquivo'=>''));
    $oAta->GetDados(array('id' => $get['i']));
}

//echo"<pre>";
//print_r($oAta);
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

    <title>Atas de Reuniões > <?= $oAta->dados->id ?></title>

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
                <h1 class="h3 mb-2 text-gray-800">Atas de Reuniões Foup</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST" enctype="multipart/form-data"
                              action="<?= $_SERVER['PHP_SELF'] . "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_ata" class="required">Data *</label>
                                        <input value="<?= $oAta->dados->dt_ata ?>" type="date" minlength="3"
                                               class="form-control" id="dt_ata" name="dt_ata">
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="titulo" class="required">Título *</label>
                                        <input value="<?= $oAta->dados->titulo ?>" type="text" minlength="3"
                                               maxlength="150" class="form-control" id="titulo" name="titulo" required>
                                        <input type="hidden" name="id" id="id" value="<?= $oAta->dados->id ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="id_eixo" class="required">Eixo Estruturante *</label>
                                        <select name="id_eixo" id="id_eixo" class="form-control">
                                            <?php
                                            $oEixo->GetLista();
                                            while ($oEixo->FetchDados()) { ?>
                                                <option value="<?= $oEixo->dados->id ?>"
                                                    <?= ($oEixo->dados->id == $oAta->dados->id_eixo ? 'selected' : '') ?>><?= $oEixo->dados->titulo ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="arquivo" class="required">Anexar Arquivo PDF</label>
                                        <input type="file" id="arquivo" name="arquivo" class="form-control"
                                               accept="application/pdf">
                                        <input type="hidden" name="nm_arquivo" id="nm_arquivo"
                                               value="<?= $oAta->dados->nm_arquivo ?>">
                                    </div>
                                    <?php if ($oAta->dados->nm_arquivo != '') { ?>
                                        <img style="width: 32px;"
                                             src="admin/images/pdf.png"/>
                                        <a href="../atas/<?= $oAta->dados->nm_arquivo ?>"
                                           target="_blank" title="Ver Anexo">Ata_<?= $oAta->dados->nm_arquivo ?></a>
                                        <a href="ata_form.php?<?= cript("m=" . $get['m'] . '&p=' . $get['p'] . '&excluir_anexo=' . $oAta->dados->id . '&i=' . $oAta->dados->id) ?>"
                                           title="Excluir"
                                           onclick="return confirm('ATENÇÃO: Deseja realmente excluir o anexo?');"><i
                                                    class="fas fa-trash text-danger mr-1"></i></a>
                                    <?php } ?>
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
                                    <a href="atas.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p']); ?>"
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

<script type="text/javascript">

    // Initialize CKEditor
    //CKEDITOR.inline( 'short_desc' );
/*
    CKEDITOR.replace('descricao', {
        width: "100%",
        height: "200px",
        toolbarGroups: [
            {name: 'basicstyles', groups: ['basicstyles', 'cleanup']},
            {name: 'paragraph', groups: ['list', 'align', 'paragraph']},
            {name: 'document', groups: ['document', 'doctools']},
            {name: 'clipboard', groups: ['clipboard', 'undo']},
            // { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
            // '/',
            //{name: 'links', groups: ['links']},
            //{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
            { name: 'insert', groups: [ 'insert' ] },
            // '/',
            {name: 'styles', groups: ['styles']},
            {name: 'colors', groups: ['colors']},
            {name: 'tools', groups: ['tools']}
        ]
    });
*/
</script>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

</body>

</html>