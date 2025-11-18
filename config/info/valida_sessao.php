<?php
if (!isset($_SESSION['usuario']))
{
    echo utf8_encode("<h1>Sem permissão de acesso!</h1><h2>Faça o login para acessar o sistema.</h2>");
    echo"<META HTTP-EQUIV=\"Refresh\" CONTENT=\"3;URL=login.php\">";
    exit;
}
?>