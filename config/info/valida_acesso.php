<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include "admin/classes/bdados.class.php";
include "admin/classes/usuario.class.php";
include "admin/classes/empresa.class.php";
include "admin/classes/modulo.class.php";
include "admin/classes/programa.class.php";
include "admin/funcoes.php";

echo "<pre>";
if (isset($_POST['submit']))
{
    $oUsuario = new Usuario();
    if ($oUsuario->GetDados(array('email'=>$_POST['login'])))
    {
        if ($oUsuario->dados->senha == $_POST['senha'])
        {
            if ($oUsuario->dados->id_status == 'A')
            {
                //print_r($oUsuario);
                // TO-DO: VALIDAR STATUS DA EMPRESA ANTES DE ABRIR SESSAO DO USUARIO
                $oEmpresa = new Empresa();
                $oEmpresa->GetDados(array('cd_empresa'=>$oUsuario->dados->cd_empresa,true));

                //sessao do usuario
                $nome = explode(" ",$oUsuario->dados->nm_usuario);
                $sessao = array('email'=>$oUsuario->dados->email,
                    'nome'=>$nome[0],
                    'codigo'=>$oUsuario->dados->cd_usuario,
                    'fullname'=>$oUsuario->dados->nm_usuario,
                    'empresa'=>$oUsuario->dados->cd_empresa,
                    'setor'=>$oUsuario->dados->cd_setor,
                    'admin'=>$oUsuario->dados->is_admin,
                    'manager'=>$oUsuario->dados->is_manager,
                    'lider'=>$oUsuario->dados->is_lider);


                //menu
                //$oModulo = new Modulo();
                //$ar_modulos = $oModulo->CarregaModulos($oUsuario->dados->cd_empresa);

                // carrega os modulos e menus da empresa/usuario
                $oPrograma = new Programa();
                $programas = $oPrograma->MenuEmpresaUsuario($oUsuario->dados->cd_empresa, $oUsuario->dados->cd_usuario);

                //seta sessão
                $_SESSION['usuario'] = $sessao;
                $_SESSION['empresa'] = array('nome'=>$oEmpresa->dados->nm_empresa, 'logo'=>$oEmpresa->dados->nm_imagem);
                $_SESSION['menu']    = $programas;

                $oUsuario->Update(array('cd_usuario'=>$oUsuario->dados->cd_usuario,'dt_acesso'=>date('Y-m-d H:i:s')));
                //echo "logado!";
                header("Location: index.php?bT0xJmQ9NTY3NDY5MTcyMjU=");
            }
            else
            {
                echo"<h2>Usuário está Inativo!</h2>";
                echo"<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=login.php\">";
            }
        }
        else
        {
            echo"<h2>Login/Senha invalidos!</h2>";
            echo"<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=login.php\">";
        }
    }
    else
    {
        echo"<h2>Usuario nao cadastrado!</h2>";
        echo"<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=login.php\">";
    }
}
?>