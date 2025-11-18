<?php
// _GET['o'] = clasee/objeto
// _GET['m'] = metodo
// _GET['p'] = parametros

ini_set('display_errors', 1);
error_reporting(E_ALL); // & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);

include 'bdados.class.php';
include '../funcoes.php';

$get = decript(key($_GET));

//print_r($get);
//exit;

include ''.$get['o'].'.class.php';

$obj = new $get['o'];
$metodo = $get['m'];
$param = (isset($_POST)) ? $_POST : false; // continuar

//$test = $obj::$metodo();
$dados = $obj->$metodo($param);

// resposta json
echo $dados;
