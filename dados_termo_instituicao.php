<?php
// Incluindo o config_site para evitar erros de Timezone/configurações globais
require_once 'config/config_site.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$tipo_instituicao = $_POST['tipo_instituicao'];
$nome_instituicao = $_POST['nome_instituicao'];
$cnpj = $_POST['cnpj'];
$endereco = $_POST['endereco'].' CEP: '.$_POST['cep'];
$cidade = $_POST['cidade'];
$uf = $_POST['estado'];
$pais = $_POST['pais'];
$data = date('d/m/Y');
$nome_represent = $_POST['nome_represent'];
$eixo = $_POST['eixo'];

$ar_mes = array(1=>'Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');

?>
<h3 style="text-align: center">TERMO DE ACEITE E ADESÃO</h3>

<div style="text-align: justify">
    <p>Por este termo de aceite e adesão,
        a(o) <b><?= $nome_instituicao ?></b>, inscrita no CNPJ sob o nº <b><?= $cnpj ?></b>, com sede na <b><?= $endereco ?></b> da cidade
        de <b><?=$cidade?></b>, estado de <b><?=$uf?></b> neste ato representada pelo Reitor(a) <b><?=$nome_represent?></b>, doravante denominada ADERENTE,
        manifesta seu aceite e formaliza sua adesão ao <b>Fórum de Universidades pela Paz.</b>
    </p>

    <p>A partir da assinatura deste termo de adesão, a parte ADERENTE firma compromisso de interagir e contribuir com os coordenadores do Fórum nas agendas de
        estruturação do planejamento das ações do Fórum e de indicar representantes para as reuniões técnicas dedicadas para esta finalidade. Outros
        compromissos poderão ser estabelecidos em comum acordo durante a execução das ações do Fórum de Universidades pela Paz, inclusive proposição de
        mapeamentos, eventos, estudos, pesquisas e outras pertinentes.</p>

    <p>A ADERENTE autoriza, ainda, a utilização do logotipo, sem slogan, de sua instituição, para compor grupo de integrantes e de apoiadores no website e nos
        materiais relacionados ao Fórum de Universidades pela Paz e, desde já, recebe autorização para informar em seus materiais e site sua adesão, podendo
        utilizar o logotipo a ser criado para representar o movimento.</p>

    <p>A adesão ao Fórum de Universidades pela Paz não gera compromissos jurídicos e financeira por parte da ADERENTE, nem trabalhistas com os seus
        representantes indicados para compor as equipes de planejamento e operacionalização do Fórum de Universidades pela Paz.</p>

    <p>A ADERENTE manifesta estar ciente de que o Fórum está sendo concebido e constituindo como um movimento dedicado a geração de conhecimentos e de ações com
        a finalidade estrita de estabelecer e difundir a paz em seu conceito mais amplo, sem posicionamentos políticos partidários, e que será liderado e
        coordenado pela equipe proponente, tendo as Instituições de Ensino Superior como base técnica do movimento e das suas ações.</p>

    <p>A partir da adesão ao Fórum a ADERENTE envidará esforços para mapear suas ações e projetos relacionados ao tema Paz e para inserir o tema da Paz como
        norteador estratégico de suas ações.</p>

    <p>A ADERENTE está ciente que não poderá usar o Fórum para ações políticas partidárias, ideológicas e de interesses privados e pessoais, sob pena de exclusão
        como membro integrante do Fórum de Universidades pela Praz.</p>

    <p>A partir deste termo a ADERENTE estará inclusa no grupo de Instituições de Ensino Superior que fará parte da composição técnica do Fórum. A ADERENTE será
        envolvida, com os seus representantes legais e indicados em grupos de planejamentos e de ações, que serão organizados a partir desta fase de Adesão.</p>

    <p>O prazo de vigência deste termo de adesão é de cinco anos, podendo haver a desistência ou seu encerramento a qualquer momento, desde que notificado por
        e-mail ou outra forma idônea de comunicação, com 30 dias de antecedência, sem gerar qualquer obrigação ou ônus para as partes.</p>
</div>

<div style="text-align: center;">

    <p>
        <?=$cidade?>, <?=$uf?> - <?=$pais?>, <?=date('d').' de '.$ar_mes[date('n')]. ' de '.date('Y')?>.
    </p>

    <br>

    <p>_________________________________________________<br>
        <?=$nome_represent?> <br> <?=$nome_instituicao?>
    </p>

</div>


