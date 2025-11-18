<?php
if (strpos($_SERVER['SERVER_NAME'], 'localhost') === false){
    $ambiente = 'prod';
}
else{
    $ambiente = 'dev';
    ini_set('display_errors', 1);
    // Alteração na linha abaixo para garantir que E_NOTICE, E_STRICT e E_DEPRECATED
    // sejam incluídos na depuração, o que é útil no desenvolvimento.
    error_reporting(E_ALL); 
}

date_default_timezone_set('America/Sao_Paulo');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/*if (strpos($_SERVER['PHP_SELF'],'/pt')){
    $_SESSION['lang'] = 'pt';
}
elseif (strpos($_SERVER['PHP_SELF'],'/en')){
    $_SESSION['lang'] = 'en';
}
elseif (strpos($_SERVER['PHP_SELF'],'/es')){
    $_SESSION['lang'] = 'es';
}
else{
    $_SESSION['lang'] = 'pt';
}
*/

if (isset($_SESSION['lang'])) {
    $lang_atual = $_SESSION['lang'];
} else {
    $_SESSION['lang'] = 'pt';
    $lang_atual = 'pt';
}


$lang = array(
    'pt' => array(
        'titulo' => 'FOUP - Fórum de Universidades pela Paz',
        'description' => 'forum de universidades pela paz',
        'keywords' => 'forum, universidades, paz'
    ),
    'en' => array(
        'titulo' => 'FOUP - Forum of Universities for Peace',
        'description' => 'forum university peace',
        'keywords' => 'forum, university, peace'
    ),
    'es' => array( // <<<<<< CORREÇÃO
        'titulo' => 'FOUP - Foro de Universidades por la Paz',
        'description' => 'foro de universidades paz',
        'keywords' => 'foro, universidades, paz'
    )
);

$urlbase['dev'] = 'http://localhost/foup2';

$urlbase['prod'] = 'https://foup.org';

$url_base = $urlbase[$ambiente]; // "https://foup.org";

$titulo = "FOUP - Fórum de Universidades pela Paz";

$email_contato = "contato@foup.org";
$numero_contato = '+55 (48) 9 9607 9627';

// LINHA 64 CORRIGIDA: Usa function_exists() para evitar o erro fatal de redeclaração.
if (!function_exists('url_base')) {
    function url_base ($txt) {
        global $urlbase, $ambiente;
        return $urlbase[$ambiente].'/'.$txt;
    }
}
