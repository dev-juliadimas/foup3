<?php
// Incluindo o config_site para evitar erros de Timezone/configurações globais
require_once 'config/config_site.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Limpeza de dados (Boa prática para evitar XSS)
$nome = htmlspecialchars($_POST['nome']);
$endereco = htmlspecialchars($_POST['endereco']).' CEP: '.htmlspecialchars($_POST['cep']);
$cidade = htmlspecialchars($_POST['cidade']);
$uf = htmlspecialchars($_POST['estado']);
$pais = htmlspecialchars($_POST['pais']);
$data = date('d/m/Y');

$ar_mes = array(1=>'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

// CORREÇÃO: Calcular o nome do mês ANTES de usá-lo na linha final
$num_mes_atual = date('n');
$nome_mes_atual = $ar_mes[$num_mes_atual];
// O PHP está no Brasil, então a data será GMT-3 (Brasília)
?>
<h3 style="text-align: center">TERMO DE ACEITE E ADESÃO PARA VOLUNTÁRIOS AO FÓRUM DE UNIVERSIDADES PELA PAZ
</h3>

<div style="text-align: justify">
    <p>Por este termo de aceite e adesão, <b><?= $nome ?></b>, residente na Rua <b><?= $endereco ?></b> da cidade
        de <b><?=$cidade?></b>, estado de <b><?=$uf?></b> manifesta seu aceite e formaliza sua adesão ao Fórum de Universidades pela Paz, na condição de
        voluntário.
    </p>

    <p>A partir da assinatura deste termo de adesão, o membro VOLUNTÁRIO firma compromisso de interagir e contribuir com as ações do Fórum de Universidades pela Paz.</p>

    <p>A adesão ao Fórum de Universidades pela Paz não gera compromissos jurídicos e financeiros, nem trabalhista por parte do membro VOLUNTÁRIO.</p>

    <p>O membro VOLUNTÁRIO manifesta estar ciente de que o Fórum de Universidades pela Paz está sendo concebido e constituindo como um movimento dedicado a geração de conhecimentos e de ações com a finalidade estrita de estabelecer e difundir a paz em seu conceito mais amplo, sem posicionamentos políticos partidários, ideológicos e religiosos, e que será liderado e coordenado pela equipe proponente, tendo as instituições de ensino, em parceria com os governos e outras instituições signatárias.</p>

    <p>A partir da adesão ao Fórum de Universidades pela Paz, o membro VOLUNTÁRIO envidará esforços para colaborar com as ações e os projetos relacionados ao tema Paz.</p>

    <p>O membro VOLUNTÁRIO está ciente que não poderá usar o Fórum para ações políticas partidárias, ideológicas e de interesses privados e pessoais, sob pena de exclusão como membro integrante do Fórum de Universidades pela Paz.</p>

    <p>A partir deste termo o membro VOLUNTÁRIO estará incluso Fórum de Universidades pela Paz e seu nome constará no site www.foup.org</p>

    <p>O prazo de vigência deste termo de adesão é de cinco anos, podendo haver a desistência ou seu encerramento a qualquer momento, desde que notificado por e-mail ou outra forma idônea de comunicação, com 30 dias de antecedência, sem gerar qualquer obrigação ou ônus para as partes.</p>

</div>

<div style="text-align: center;">

    <p>
        <?=$cidade?>, <?=$uf?> - <?=$pais?>, <?=date('d').' de '.$nome_mes_atual. ' de '.date('Y')?>.
    </p>

    <br>

    <p>_________________________________________________<br>
        <?=$nome?>
    </p>

</div>