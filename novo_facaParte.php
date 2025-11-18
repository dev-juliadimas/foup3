<?php
require_once 'config/config_site.php';
if ($_GET['tipo'] == "instituicao") {
    $titulo = "INSTITUIÇÃO";
    $tipo = "instituicao";
    $img = "homem.png";
    $caminho = "form-instituicao.php";
    $form = "#form-instituicao";
    $dados = "dados_termo_instituicao.php";
    $conteudo = "#conteudo_termo_instituicao";
    $modal = "#modal-termo-instituicao";
} else {
    $titulo = "VOLUNTÁRIO";
    $tipo = "voluntario";
    $img = "voluntario.png";
    $caminho = "form-voluntario.php";
    $form = "#form-voluntario";
    $dados = "dados_termo_voluntario.php";
    $conteudo = "#conteudo_termo_voluntario";
    $modal = "#modal-termo-voluntario";
}

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Termo de Adesão para Voluntários do Fórum de Universidades pela Paz.">
    <title>Adesão Voluntário: <?= $titulo ?></title>
    <link rel="stylesheet" href="css/est_form.css">

    <style>
        /* Estilos baseados na imagem de referência */
        
        /* 1. Contexto principal para a sobreposição de conteúdo */
        .adesao-wrapper {
            position: relative;
            background-color: #3b3b3b; /* Fundo cinza escuro da seção do formulário */
            overflow: hidden; 
            padding-bottom: 50px; /* Garante espaço para o footer */
        }

        /* 2. Coluna da imagem com o background azul */
        .bg-imagem-col {
            background-color: #2B3D52;
            min-height: 850px; 
            position: relative;
        }

        /* 3. Imagem (Vaza e preenche a altura) */
        .vazamento-imagem {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            object-fit: cover;
            width: 100%; 
        }

        /* 4. Bloco do Formulário (o card flutuante cinza) */
        .card-formulario {
            background-color: #4b4b4b; 
            border-radius: 5px;
            padding: 3rem;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            color: white;
            position: absolute; 
            top: 150px; /* Move para baixo para começar após o cabeçalho */
            left: 20px; /* Afasta da borda esquerda */
            z-index: 20;
            width: 90%; 
        }
        
        /* 5. Títulos Sobrepostos na Imagem */
        .titulo-sobreposto {
            position: absolute;
            bottom: 30px;
            left: 50px;
            z-index: 10;
        }

        /* 6. Card da seção QUEM PODE PARTICIPAR */
        .card-participar {
             background-color: #4b4b4b;
             border-radius: 5px;
             color: white;
             padding: 3rem;
             box-shadow: 0 4px 10px rgba(0,0,0,0.5);
        }

        /* Mantém o estilo para o label flutuante */
        .fone_label_focus {
            opacity: 1;
            transform: scale(0.8) translateY(-0.5rem) translateX(-1.5rem);
        }
    </style>

    <script>
        // ... (Sua lógica JavaScript/JQuery, funções exibe_termo, gera_termo_pdf, envia_email_termo permanecem aqui) ...
        $(function() {
            // Lógica para o label flutuante (apenas para whatsapp_membro, se existir)
            $("#whatsapp_membro").focus(function() {
                $("#whatsapp_membro_label").addClass('fone_label_focus');
            });
            $('#whatsapp_membro').blur(function() {
                if (!$(this).val()) {
                    $("#whatsapp_membro_label").removeClass('fone_label_focus');
                }
            });
        });

        function exibe_termo() {
            var dados = $(<?php echo $form; ?>).serialize();
            $.ajax({
                type: "POST",
                url: '<?php echo $dados; ?>',
                data: dados,
                dataType: "html",
                beforeSend: function(xhr) {
                    $(<?php echo $conteudo; ?>).html('<div class="text-center">Aguarde...</div>');
                },
                success: function(data) {
                    $(<?php echo $conteudo; ?>).html(data);
                    $(<?php echo $modal; ?>).modal('show')
                },
                error: function() {
                    alert('Falha ao exibir o termo de adesão! Por favor tente novamente...');
                }
            });
        }

        function gera_termo_pdf() {
            var html_termo = $(<?php echo $conteudo; ?>).html();
            var time = <?= time() ?>;
            var dados = $(<?php echo $form; ?>).serialize();

            $.ajax({
                type: "POST",
                url: "gera_termo_adesao_pdf.php",
                data: "nome_termo=termo_adesao_" + '<?php echo $tipo; ?>' + "_" + time + ".pdf&dados=" + html_termo,
                dataType: "text",
                beforeSend: function(xhr) {
                    $("#conteudo_termo_" + '<?php echo $tipo; ?>').html('<div class="text-center">Gerando termo de adesão... Por favor, aguarde!</div>');
                    $("#botao_" + '<?php echo $tipo; ?>').html('');
                },
                success: function(data) {
                    envia_email_termo("termo_adesao_" + '<?php echo $tipo; ?>' + "_" + time + ".pdf", dados);
                },
                error: function() {
                    alert('Falha ao gerar termo de adesão! Por favor tente novamente...');
                }
            });
        }

        function envia_email_termo(f, d) {
            $.ajax({
                type: "POST",
                url: "envia_termo.php?tipo=" + '<?php echo $tipo; ?>',
                data: "nome_termo=" + f + '&' + d,
                dataType: "html",
                beforeSend: function(xhr) {
                    $(<?php echo $conteudo; ?>).html('<div class="text-center">Enviando Termo de Adesão para e-mail...</div>');
                },
                success: function(data) {
                    $(<?php echo $conteudo; ?>).html('<div class="text-center">Termo de adesão enviado com sucesso! Obrigado!</div>');
                    $("#botao_" + '<?php echo $tipo; ?>').html('');
                    $("#botao_" + '<?php echo $tipo; ?>').html('');
                },
                error: function() {
                    alert('Falha ao enviar termo de adesão! Por favor tente novamente...');
                }
            });
        }
    </script>


</head>

<body>
    <div id="nav-placeholder"></div>

    <section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: #2b3d52;">
        <div class="container text-start text-light d-flex align-items-center justify-content-center gap-5">
            <h1 class="display-1 fw-bold">ADESÃO.</h1>
            <img width="450px" src="arquivos/geral/logos/foup-branco.png" alt="FOUP logo">
        </div>
    </section>

    <section class="wrapper adesao-wrapper">
        <div class="container-fluid"> 
            <div class="row">
                
                <div class="col-lg-6 p-0 bg-imagem-col"> 
                    
                    <img src="arquivos/adesao/<?php echo $img; ?>"
                        alt="Imagem Ilustrativa"
                        class="img-fluid vazamento-imagem">

                    <div class="titulo-sobreposto text-white">
                        <h1 class="display-1 fw-bold mb-0" style="font-size: 5rem; line-height: 1;">
                            <?php echo $titulo; ?>
                        </h1>

                        <h1 class="display-1 fw-bold mt-0" style="font-size: 6rem; line-height: 1; color: rgba(255, 255, 255, 0.2); position: relative; top: -50px; left: 10px; z-index: -1;">
                            <?php echo $titulo; ?>
                        </h1>
                    </div>
                </div>

                <div class="col-lg-6" style="background-color: #3b3b3b; min-height: 850px;">
                    </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 offset-lg-6"> 
                    <div class="card-formulario p-5">
                         <h2 class="h4 fw-bold text-white mb-2">INSTITUIÇÃO</h2>
                        <p class="small text-white">TERMO DE ADESÃO | MODELO</p>
                        
                        <?php include $caminho; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container pb-15" style="margin-top: 5rem;"> 
            <div class="card-participar">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 d-flex align-items-center justify-content-center">
                            <h4 class="display-5 fw-bold text-end" style="line-height: 1.1em;">
                                <span class="destaque-quais">QUAIS</span><br>INSTITUIÇÕES<br>PODEM<br>PARTICIPAR?
                            </h4>
                        </div>
    
                        <div class="col-md-8">
                            <div class="info-block">
                                <p class="small">
                                    &bull; O Fórum das Universidades pela Paz (FOUP) é um movimento plural e aberto a todas as instituições que reconhecem na educação uma força transformadora para a construção da paz. **Não nos restringimos a universidades**.
                                </p>
                                <p class="small">
                                    &bull; Nossa rede acolhe organizações que desejam atuar em conjunto por um mundo mais justo e pacífico. São bem-vindas instituições de ensino superior (públicas ou privadas), escolas, centros de pesquisa, organizações não-governamentais, coletivos sociais, institutos internacionais, entidades públicas e privadas, e até mesmo iniciativas informais que compartilhem desse propósito.
                                </p>
                            </div>
                            <a href="#faq">
                                <button class="btn rounded-3 btn-send btn-transparente-aqui me-2" style="color: white; border-color: white;">
                                    Perguntas frequentes
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <div id="footer-placeholder"></div>
    <script src="js/carrega2.js"></script>
</body>
</html>