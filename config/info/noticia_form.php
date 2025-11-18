<?php
//ini_set('display_errors', 1);
//error_reporting(E_ALL ^ E_NOTICE);
session_start();
ob_start();
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

if (isset($_POST['bt_gravar']))
{
    //$_POST['dt_noticia'] = formata_data($_POST['dt_noticia'],1);

    if (!isset($_POST['dt_cadastro']))
        $_POST['dt_cadastro']   = date('Y-m-d H:i:s');
    else
        $_POST['dt_cadastro'] = formata_data($_POST['dt_cadastro'],1);

    if ($_POST['id'] == '')
        $_POST['id'] = 0;

    $id = $oNoticia->Update($_POST); // inser ou update

    $id_noticia = ($_POST['id'] == 0) ? $id : $_POST['id'];

    if (isset($_FILES['foto'])){

        $arquivo = $_FILES['foto'];

        if (is_uploaded_file($arquivo['tmp_name'])) {
            $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
            $filename = '../fotos/f_' . time() . '.' . $ext;
            if (move_uploaded_file($arquivo["tmp_name"], $filename)) {
                $_POST['foto'] = substr($filename, 3); // pra remover ../
            } else {
                $msg = "Falha ao mover anexo";
                $status = 'error';
            }
        }
    }

    $_POST['id'] = $id_noticia;
    $oNoticia->Update($_POST);

    header("Location: noticias.php?" . cript("m=" . $get['m'] . "&p=" . $get['p'] . "&msg=Notícia " . ($_POST['id'] > 0 ? 'atualizada' : 'cadastrada') . " com sucesso"));
    exit;
}

if (isset($_POST['bt_excluir']))
{
    if (is_file('../fotos/'.$_POST['foto'])) {
        unlink('../fotos/' . $_POST['foto']);
    }

    $oNoticia->Delete($_POST);
    $msg = 'Notícia excluida com sucesso';

    header("Location: noticias.php?" . cript("m=" . $get['m'] . "&p=" . $get['p']."&msg=".$msg));
    exit;
}

//pega os dados para edição
if (isset($get['i']))
    $oNoticia->GetDados(array('id' => $get['i']));
else
    $oNoticia->GetDados(array('id' => '0', true));

if (isset($get['excluir_foto']))
{
    unlink('../fotos/' . $oNoticia->dados->foto);
    $_POST['foto'] = '';
    $oNoticia->Update(array('id'=>$get['i'],'foto'=>''));
    $oNoticia->GetDados(array('id' => $get['i']));
}

//echo"<pre>";
//print_r($oNoticia);
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

    <title>Notícias > <?= $oNoticia->dados->id ?></title>

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
                <h1 class="h3 mb-2 text-gray-800">Notícias Foup</h1>

                <div class="card shadow mb-4">
                    <div class="card-body">

                        <form class="needs-validation" method="POST" enctype="multipart/form-data"
                              action="<?= $_SERVER['PHP_SELF'] . "?" . cript("m=" . $get['m'] . "&p=" . $get['p']); ?>">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="titulo" class="required">Título *</label>
                                        <input value="<?= $oNoticia->dados->titulo ?>" type="text" minlength="3"
                                               maxlength="200" class="form-control" id="titulo" name="titulo" required>
                                        <input type="hidden" name="id" id="id" value="<?= $oNoticia->dados->id ?>">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="id_status" class="required">Status *</label>
                                        <select id="id_status" name="id_status" class="form-control" required>
                                            <option value="A" <?= ($oNoticia->dados->id_status == 'A') ? 'selected' : '' ?>>
                                                Ativo
                                            </option>
                                            <option value="I" <?= ($oNoticia->dados->id_status == 'I') ? 'selected' : '' ?>>
                                                Inativo
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="resumo" class="required">Resumo *</label>
                                        <textarea id="resumo" name="resumo" class="form-control" required><?= $oNoticia->dados->resumo ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="dt_noticia" class="required">Data *</label>
                                        <input value="<?= $oNoticia->dados->dt_noticia ?>" type="date" minlength="3"
                                               class="form-control" id="dt_noticia" name="dt_noticia" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="descricao" class="required">Descrição *</label>
                                        <textarea id="descricao" name="descricao" required>
                                            <?= $oNoticia->dados->descricao ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="foto" class="required">Foto Destaque</label>
                                        <input type="file" id="foto" name="foto" class="form-control" accept="image/jpeg, image/png">
                                        <input type="hidden" name="foto" id="foto" value="<?=$oNoticia->dados->foto?>">
                                    </div>
                                    <?php if ($oNoticia->dados->foto != '') { ?>
                                        <img style="max-width: 200px;" src="../fotos/<?=$oNoticia->dados->foto?>" />
                                        <a href="noticia_form.php?<?=cript("m=".$get['m'].'&p='.$get['p'].'&excluir_foto='.$oNoticia->dados->id.'&i='.$oNoticia->dados->id)?>" title="Excluir foto" onclick="return confirm('ATENÇÃO: Deseja realmente excluir a foto?');"><i class="fas fa-trash text-danger mr-1"></i></a>
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
                                    <a href="noticias.php?<?= cript("m=" . $get['m'] . "&p=" . $get['p']); ?>"
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

    CKEDITOR.replace('descricao', {
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