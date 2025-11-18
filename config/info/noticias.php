<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

session_start();
include "inc_config.php";
include('valida_sessao.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/noticia.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oPrograma = new Programa();
$oNoticia = new Noticia();

//print_r($get);

if (isset($get['bt_excluir']))
{
    if ($oNoticia->GetDados(array('id' => $get['bt_excluir'])))
    {
        if ($oNoticia->dados->foto != '')
            unlink('../'.$oNoticia->dados->foto);
        $oNoticia->Delete();
        $get['msg'] = 'Notícia excluida com sucesso';
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Marcelo Mazon">
    <link rel="shortcut icon" href="../assets/img/globo_foup_fav_icon.png" type="image/x-icon">

    <title>Notícias Foup</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.css"/>
    <link rel="stylesheet" type="text/css" href="css/toastr.css"/>


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
                <h1 class="h3 mb-2 text-gray-800">Notícias Foup</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <a href="noticia_form.php?<?=cript("m=".$get['m']."&p=".$get['p'])?>" title="Cadastrar novo usuário" type="button" class="mt-1 mb-4 btn btn-success">+ Noticia</a>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Título</th>
                                    <th>Data</th>
                                    <th>Foto</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $oNoticia->GetLista();

                                $class = '';

                                while ($oNoticia->FetchDados()) {
                                    $class = ($class == '') ? 'even' : '';
                                    ?>

                                    <tr>
                                        <td><?= $oNoticia->dados->id ?></td>
                                        <td><?= $oNoticia->dados->titulo ?></td>
                                        <td><?= formata_data($oNoticia->dados->dt_noticia,2) ?></td>
                                        <td>
                                        <?php if ($oNoticia->dados->foto != '') { ?>
                                            <img style="max-width: 80px;" src="../<?=$oNoticia->dados->foto?>" />
                                        <?php } ?>
                                        </td>
                                        <td><?= utf8_encode($ar_status_geral[$oNoticia->dados->id_status]) ?></td>
                                        <td style="text-align: center" nowrap="true">
                                            <a href="noticia_form.php?<?=cript("m=".$get['m'].'&p='.$get['p'].'&i='.$oNoticia->dados->id)?>">
                                                <i class="fas fa-edit text-info mr-1"></i></a>
                                            <a href="noticias.php?<?=cript("m=".$get['m'].'&p='.$get['p'].'&bt_excluir='.$oNoticia->dados->id)?>" onclick="return confirm('ATENÇÃO: Deseja realmente excluir?');"><i class="fas fa-trash text-danger mr-1"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
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

<!-- Page level plugins -->
<script type="text/javascript" src="vendor/datatables/jquery.dataTables.js"></script>
<script type="text/javascript" src="vendor/datatables/dataTables.bootstrap4.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {
        $('#dataTable').dataTable({
            "ordering": true
        })
    });

    <?php  if (isset($get['msg'])) { ?>
       toastr.success('<?=$get['msg']?>');
    <?php } ?>

</script>

</body>

</html>