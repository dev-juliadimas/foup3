<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
ob_start();
include('valida_sessao.php');
include('admin/classes/bdados.class.php');
include "admin/classes/programa.class.php";
include('admin/classes/vaga.class.php');
include('admin/funcoes.php');

if (isset($_GET))
    $get = decript(key($_GET));
else
    $get = array('m' => '0');

$oPrograma = new Programa();
$oVaga = new Vaga();

if (isset($_POST['bt_gravar']))
{
    //print_r($_POST);

    //$_POST['dt_publicacao'] = formata_data($_POST['dt_publicacao'],1);
    //$_POST['dt_inativacao'] = formata_data($_POST['dt_inativacao'],1);

    //if (!isset($_POST['dt_cadastro']))
    //    $_POST['dt_cadastro']   = date('Y-m-d H:i:s');
    //else
    //    $_POST['dt_cadastro'] = formata_data($_POST['dt_cadastro'],1);

    //$_POST['dt_retorno'] = formata_data($_POST['dt_retorno'],1).' '.$_POST['hr_retorno'];
    if ($_POST['cd_vaga'] == '')
        $_POST['cd_vaga'] = 0;

    $oVaga->Update($_POST);
    header("Location: vagas.php?".cript("m=".$get['m']."&p=".$get['p']."&msg=Vaga ".($_POST['cd_vaga']>0?'atualizada':'cadastrada')." com sucesso"));
    exit;
}
if (isset($_POST['bt_excluir']))
{
    $oVaga->Delete($_POST);
    header("Location: vagas.php?".cript("m=".$get['m']."&p=".$get['p']));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oVaga->GetDados(array('cd_vaga'=>$get['i']));
else
    $oVaga->GetDados(array('cd_vaga'=>'0',true));

//echo"<pre>";
//print_r($oVaga);
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
    <meta name="author" content="">

    <title>Vagas > <?=$oVaga->dados->cd_vaga?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="vendor/datatables/dataTables.bootstrap4.css"/>
    <script src="ckeditor/ckeditor.js" ></script>
    <style type="text/css">
        .cke_textarea_inline{
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
                <h1 class="h3 mb-2 text-gray-800">Vagas</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST" action="<?=$_SERVER['PHP_SELF']."?".cript("m=".$get['m']."&p=".$get['p']);?>">
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="nome" class="required">Código</label>
                                        <input value="<?=$oVaga->dados->cd_vaga?>" type="text" minlength="1" maxlength="10" class="form-control"
                                               id="cd_vaga" name="cd_vaga" readonly>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="nome" class="required">Nome *</label>
                                        <input value="<?=$oVaga->dados->nm_vaga?>" type="text" minlength="3" maxlength="200" class="form-control" id="nm_vaga" name="nm_vaga" required>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="nome" class="required">Quantidade *</label>
                                        <input value="<?=$oVaga->dados->qt_vaga?>" type="number" minlength="1" maxlength="99" class="form-control"
                                               id="qt_vaga" name="qt_vaga" step="1" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nome" class="required">Descrição *</label>
                                        <textarea id="ds_vaga" name="ds_vaga" required>
                                            <?=$oVaga->dados->ds_vaga?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="nome" class="required">Requisitos *</label>
                                        <textarea id="ds_requisitos" name="ds_requisitos" required>
                                            <?=$oVaga->dados->ds_requisitos?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="id_status" class="required">Status *</label>
                                        <select id="id_status" name="id_status" class="form-control" required>
                                            <option value="A" <?=($oVaga->dados->id_status == 'A')? 'selected':''?>>Ativo</option>
                                            <option value="I" <?=($oVaga->dados->id_status == 'I')? 'selected':''?>>Inativo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="faixa_salarial" class="faixa_salarial">Faixa Salarial</label>
                                        <input value="<?=$oVaga->dados->faixa_salarial?>" type="text" minlength="3" maxlength="100" class="form-control"
                                               id="faixa_salarial" name="faixa_salarial">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_publicacao" class="required">Divulgação - Início</label>
                                        <input value="<?=$oVaga->dados->dt_publicacao?>" type="date" class="form-control"
                                               id="dt_publicacao" name="dt_publicacao">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_inativacao" class="required">Fim</label>
                                        <input value="<?=$oVaga->dados->dt_inativacao?>" type="date" class="form-control"
                                               id="dt_inativacao" name="dt_inativacao">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_inativacao" class="required">Data Cadastro</label>
                                        <input value="<?=$oVaga->dados->dt_cadastro?>" type="date" class="form-control"
                                               id="dt_cadastro" name="dt_cadastro" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                    <button type="submit" name="bt_gravar" class="btn btn-primary">Salvar</button>
                                    <button type="submit" onclick="return confirm('ATENÇÃO: Deseja realmente excluir?');" name="bt_excluir" class="btn btn-danger">Excluir</button>
                                    <a href="vagas.php?<?=cript("m=".$get['m']."&p=".$get['p']);?>" type="button" class="btn btn-secondary ml-1">Cancelar</a>
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

    CKEDITOR.replace('ds_vaga',{
        width: "100%",
        height: "200px"
    });

    CKEDITOR.replace('ds_requisitos',{
        width: "100%",
        height: "200px"
    });

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