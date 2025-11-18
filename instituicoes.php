<?php

include 'config/config_site.php';
include 'config/info/admin/classes/bdados.class.php';
include 'config/info/admin/classes/instituicao.class.php';
include 'config/info/admin/funcoes.php';

$oInstituicao = new Instituicao();

$limit_inicial = 10; 

// Define os tipos de instituições e seus títulos
$secoes = [
    'U' => 'Instituições de Ensino',
    'O' => 'Organizações da Sociedade Civil',
    'G' => 'Órgãos Governamentais'
];
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>FOUP - Instituições</title>
    <link rel="stylesheet" href="css/est_instituicoes.css" />
</head>

<body>
    <div id="nav-placeholder"></div>

    <main>
        <section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #F78803;">
            <div class="container text-start text-light d-flex align-items-center justify-content-center gap-5">
                <h1 class="display-1 fw-bold">INSTITUIÇÕES.</h1>
                <img width="450px" src="arquivos/geral/logos/foup-branco.png" alt="">
            </div>
        </section>

    </main>
    <br><br>
    <section>
        <div class="foup-about-section">
            <div class="container w-75">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="display-5 fw-bold mb-4">Instituições Signatárias</h2>
                        <p class="lead">
                            Conheça as Instituições que já aderiram ao
                            Fórum Universidades pela Paz
                        </p>
                    </div>
                </div>
            </div>

            <hr class="my-5" />

            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col">
                    <div class="pillar-card h-100">
                        <img src="arquivos/instituicoes/instituicoes-ensino.svg" class="icon-svg icon-svg-md text-blue mb-3" alt="">
                        <h5>Instituições de Ensino</h5>
                        <p class="small">
                            Universides e Faculdades em Geral
                        </p>
                        <a href="#u" class="text-primary text-decoration-none fw-bold">Saiba mais +</a>
                    </div>
                </div>

                <div class="col">
                    <div class="pillar-card h-100">
                        <img src="arquivos/instituicoes/outras-instituicoes.svg" class="icon-svg icon-svg-md text-blue mb-3" alt="">
                        <h5>Outras Instituições</h5>
                        <p class="small">
                            Instituições diversas da sociedade civil organizada
                        </p>
                        <a href="#o" class="text-primary text-decoration-none fw-bold">Saiba mais +</a>
                    </div>
                </div>

                <div class="col">
                    <div class="pillar-card h-100">
                        <img src="arquivos/instituicoes/governos.svg" class="icon-svg icon-svg-md text-blue mb-3" alt="">
                        <h5>Governos</h5>
                        <p class="small">
                            Instituições Governamentais
                        </p>
                        <a href="#g" class="text-primary text-decoration-none fw-bold">Saiba mais +</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section>
      <section class="wrapper bg-gray">
        <div class="container pt-15 pb-10">
            <div class="row gx-lg-8 gx-xl-12 gy-10 align-items-start">
            
            <?php foreach ($secoes as $tipo_code => $titulo): ?>
                
                <?php
                $tipo_code_lower = strtolower($tipo_code);
                $param_name = 'show_all_' . $tipo_code_lower;
                
                // Variáveis de controle padrão
                $show_button = true;
                $limit_atual = $limit_inicial; // Padrão: 10
                $is_showing_all = isset($_GET[$param_name]) && $_GET[$param_name] == 'true';
                $button_text = 'Ver Todas';
                $button_link = '?' . $param_name . '=true' . '#' . $tipo_code_lower;

                // Lógica Específica para cada tipo
                if ($tipo_code === 'U') {
                    // Tipo 'U': Aplica a lógica de Ver Todas / Ver Menos
                    if ($is_showing_all) {
                        $limit_atual = 0; // Mostrar todos (se o GetInstituicoes funcionar com 0)
                        $button_text = 'Ver Menos';
                        $button_link = '?' . '#' . $tipo_code_lower; // Link para voltar ao limite
                    } else {
                        $limit_atual = $limit_inicial; // Mostrar 10
                    }
                } else {
                    // Tipos 'O' e 'G': Mostrar TUDO por padrão e Ocultar o botão
                    // Uso de limite alto (100) para garantir que todos sejam puxados (CORREÇÃO)
                    $limit_atual = 100; 
                    $show_button = false;
                }

                // 2. Busca os dados
                $dados = $oInstituicao->GetInstituicoes($tipo_code, $limit_atual);
                
                // 3. Ajuste final do botão (Se for o tipo 'U')
                if ($tipo_code === 'U') {
                    // Oculta o botão se não houver dados
                    if (empty($dados)) {
                        $show_button = false;
                    }
                    // Oculta o botão 'Ver Todas' se já estiver mostrando todos, OU se a lista atual for menor que o limite inicial (não há mais o que ver)
                    else if (!$is_showing_all && count($dados) < $limit_inicial) {
                         $show_button = false;
                    }
                }
                
                ?>

                <div class="container py-1 py-md-2">
                    <h3 id="<?php echo $tipo_code_lower; ?>" class="display-3 mb-8" style="font-size: 40px; text-align: center;"><?php echo $titulo; ?></h3>
                </div>

                <div id="conteudo_<?php echo $tipo_code_lower; ?>" class="col-12">
                    <?php
                    if (!empty($dados)) {
                        include 'includes/inc_dados_instituicoes.php'; 
                    } else {
                        echo "<p class='text-center'>(Em breve)</p>";
                    }
                    ?>
                </div>
                
                <?php if ($show_button): ?>
                    <div class="text-center mt-4 mb-5">
                        <a href="<?php echo $button_link; ?>" class="btn border-white rounded-1">
                            <?php echo $button_text; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <hr class="my-5"/>
                
            <?php endforeach; ?>
            
            </div>
        </div>
    </section>

    <div id="footer-placeholder"></div>

    <script src="js/carrega.js"></script>
</body>

</html>