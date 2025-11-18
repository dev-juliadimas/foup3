<?php
require_once 'config/config_site.php';
if (isset($_GET['tipo']) && $_GET['tipo'] == "instituicao") {
    $titulo = "INSTITUIÇÃO";
    $tipo = "instituicao";
    $img = "homem.png";
    $caminho = "form-instituicao.php";
    $form = "#form-instituicao";
    $dados = "dados_termo_instituicao.php";
    $conteudo = "#conteudo_termo";
    $modal = "#modal-termo-instituicao";
    $cor = "#2B3D52";
    $cor_destaque = "#7B96A7";
} else {
    $titulo = "VOLUNTÁRIO";
    $tipo = "voluntario";
    $img = "voluntario.png";
    $caminho = "form-voluntario.php";
    $form = "#form-voluntario";
    $dados = "dados_termo_voluntario.php";
    $conteudo = "#conteudo_termo";
    $modal = "#modal-termo-voluntario";
    $cor = "#F78803";
    $cor_destaque = $cor;
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        :root {
            /* Cor de destaque para o tema Instituição (Azul Escuro/Chumbo) */
            --foup-escuro: <?php echo $cor; ?>;
            /* Cor para o texto destacado "QUAIS" */
            --foup-destaque: <?php echo $cor_destaque; ?>;
        }

        .btn-transparente {
            /* Estado Normal: Texto e Borda na cor de destaque. Fundo transparente. */
            border-color: var(--foup-escuro) !important;
            color: #fff !important;
            background-color: transparent !important;
            transition: all 0.3s ease;
            font-family: var(--fonte-gobold);
        }

        /* Efeito Hover dos Botões Transparentes: Fundo Azul, Texto Branco */
        .btn-transparente:hover,
        .btn-transparente:focus {
            background-color: var(--foup-escuro) !important;
            border-color: var(--foup-escuro) !important;
            color: #FFFFFF !important;
        }

        .btn-transparente-aqui {
            /* Estado Normal: Texto e Borda na cor de destaque. Fundo transparente. */

            color: #fff !important;
            background-color: var(--foup-escuro) !important;
            transition: all 0.3s ease;
            font-family: var(--fonte-gobold);
        }

        /* Efeito Hover dos Botões Transparentes: Fundo Azul, Texto Branco */
        .btn-transparente-aqui:hover,
        .btn-transparente-aqui:focus {
            background-color: #fff !important;
            border-color: #fff !important;
            color: var(--foup-escuro) !important;
        }

        /* 3. Estilo para o Botão Invertido ("ENVIAR") */
        .btn-invertido {
            /* Estado Normal: Fundo Branco, Borda e Texto Azul */
            background-color: #FFFFFF !important;
            border-color: var(--foup-escuro) !important;
            color: var(--foup-escuro) !important;
            transition: all 0.3s ease;
        }

        /* Efeito Hover do Botão Invertido: Fundo Azul, Borda e Texto Branco */
        .btn-invertido:hover,
        .btn-invertido:focus {
            background-color: var(--foup-escuro) !important;
            border-color: var(--foup-escuro) !important;
            color: #FFFFFF !important;
        }

        .info-card-container .destaque-quais {
            color: var(--foup-destaque);
        }

        /* Garante que o texto principal seja um pouco mais claro */
        .info-block p {
            color: #E0E0E0;
        }

        /* Garante que o botão 'Perguntas Frequentes' tenha boa legibilidade */
        .info-card-container .btn-outline-dark {
            border-color: var(--foup-destaque) !important;
            /* Usa a cor #7B96A7 para a borda */
            color: var(--foup-destaque) !important;
            /* Usa a cor #7B96A7 para o texto */
        }

        /* CSS Customizado para o Layout da Imagem de Referência */

        /* Contexto principal para a sobreposição de conteúdo */
        .adesao-wrapper {
            position: relative !important;
            background-color: #3b3b3b !important;
            /* Fundo cinza escuro da seção do formulário */
            overflow: hidden !important;
            /* Importante para o posicionamento da imagem */
        }



        /* Imagem (para vazar a div) - usei uma largura fixa para alinhar com a imagem */
        .vazamento-imagem {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            height: 150% !important;
            object-fit: cover !important;
            /* Largura ajustada para vazar ligeiramente ou ser 100% do col-lg-6 */
            width: 100% !important;
        }

        /* Títulos Sobrepostos na Imagem (Ajuste a posição com base na imagem) */
        .titulo-adesao {
            position: absolute !important;
            bottom: 30px !important;
            left: 120px !important;
            z-index: 10 !important;
        }

        /* Mantém o estilo para o label flutuante */
        .fone_label_focus {
            opacity: 1 !important;
            transform: scale(0.8) translateY(-0.5rem) translateX(-1.5rem) !important;
        }
    </style>

    <script>
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
            var dados = $("<?php echo $form; ?>").serialize();
            $.ajax({
                type: "POST",
                url: "<?php echo $dados; ?>",
                data: dados,
                dataType: "html",
                beforeSend: function(xhr) {
                    $("#conteudo_termo").html('<div class="text-center">Aguarde...</div>');
                },
                success: function(data) {
                    $("#conteudo_termo").html(data);
                    $("<?php echo $modal; ?>").modal('show')
                },
                error: function() {
                    alert('Falha ao exibir o termo de adesão! Por favor tente novamente...');
                }
            });
        }

        function gera_termo_pdf() {
            var html_termo = $("#conteudo_termo").html();
            var time = <?= time() ?>;
            var dados = $("<?php echo $form; ?>").serialize();

            $.ajax({
                type: "POST",
                url: "gera_termo_adesao_pdf.php",
                // CORREÇÃO APLICADA AQUI E ABAIXO (concatenando $tipo com aspas)
                data: "nome_termo=termo_adesao_" + "<?php echo $tipo; ?>" + "_" + time + ".pdf&dados=" + html_termo,
                dataType: "text",
                beforeSend: function(xhr) {
                    $("#conteudo_termo_" + "<?php echo $tipo; ?>").html('<div class="text-center">Gerando termo de adesão... Por favor, aguarde!</div>');
                    $("#botao_" + "<?php echo $tipo; ?>").html('');
                },
                success: function(data) {
                    envia_email_termo("termo_adesao_" + "<?php echo $tipo; ?>" + "_" + time + ".pdf", dados);
                },
                error: function() {
                    alert('Falha ao gerar termo de adesão! Por favor tente novamente...');
                }
            });
        }

        function envia_email_termo(f, d) {
            $.ajax({
                type: "POST",
                // CORREÇÃO APLICADA AQUI E ABAIXO (concatenando $tipo com aspas)
                url: "envia_termo.php?tipo=" + "<?php echo $tipo; ?>",
                data: "nome_termo=" + f + '&' + d,
                dataType: "html",
                beforeSend: function(xhr) {
                    $("#conteudo_termo").html('<div class="text-center">Enviando Termo de Adesão para e-mail...</div>');
                },
                success: function(data) {
                    $("#conteudo_termo").html('<div class="text-center">Termo de adesão enviado com sucesso! Obrigado!</div>');
                    $("#botao_<?php echo $tipo; ?>").html('');
                    $("#botao_<?php echo $tipo; ?>").html('');
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

    <section class="vh-100 d-flex align-items-center justify-content-center" style="background-color: <?php echo $cor; ?>;">
        <div class="container text-start text-light d-flex align-items-center justify-content-center gap-5">
            <h1 class="display-1 fw-bold">ADESÃO.</h1>
            <img width="450px" src="arquivos/geral/logos/foup-branco.png" alt="">
        </div>
    </section>

    <section class="wrapper bg-gray">
        <div class="container-fluid pt-10 pb-15">
            <div class="gx-lg-8 gx-xl-12 gy-10 align-items-start d-flex">
                <div class="col-lg-6 p-0 d-flex align-items-stretch " style="position: relative;">
                    <div class="col-lg-6" style="background-color: <?php echo $cor; ?>; width: 70%; height: 100%; position: relative; overflow: visible;">
                        <img src="arquivos/adesao/<?php echo $img; ?>"
                            alt="Imagem Ilustrativa"
                            class="img-fluid"
                            style="height: 100%; object-fit: cover; width: 100%;">
                    </div>

                    <div class="titulo-adesao" style="position: absolute; bottom: 10px; left: 50px; z-index: 10;">

                        <h1 class="display-1 fw-bold mb-0 text-white" style="font-size: 3rem; line-height: 1; left: 50px;  line-height: 1; color: rgba(255, 255, 255, 0.2); position: relative; top: -50px; left: 350px; z-index: -1;">
                            <?php echo $titulo; ?>
                        </h1>

                        <h1 class="display-1 fw-bold mt-0" style="font-size: 3rem; line-height: 1; color: rgba(255, 255, 255, 0.2); position: relative; top: -50px; left: 350px; z-index: -1;">
                            <?php echo $titulo; ?>
                        </h1>
                    </div>
                </div>

                <div class="col-lg-6 pt-5">
                    <?php include $caminho; ?>
                </div>
            </div>
        </div>
    </section>
    <section class="wrapper" style="position: relative; padding-top: 0; padding-bottom: 0;">
                <div class="container-fluid py-5" style="background-color: #4b4b4b;">
            <div class="row justify-content-center">
                <div class="col-lg-10 col-xl-8 p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex align-items-center justify-content-center">
                                <h4 class="display-5 fw-bold text-end" style="line-height: 1.1em; color: white;">
                                    <span class="destaque-quais" style="color: <?php echo $cor_destaque; ?>;">
                                        <?php echo ($tipo == "instituicao" ? "QUAIS" : "QUEM"); ?>
                                    </span><br>
                                    <?php echo ($tipo == "instituicao" ? "INSTITUIÇÕES<br>PODEM<br>PARTICIPAR?" : "PODE SER<br>VOLUNTÁRIO<span style='color: " . $cor_destaque . "'>?</span>"); ?>
                                </h4>
                            </div>

                            <div class="col-md-8">
                                <div class="info-block">
                                    <?php if ($tipo == "instituicao") { ?>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; O Fórum das Universidades pela Paz (FOUP) é um movimento plural e aberto a todas as instituições que reconhecem na educação uma força transformadora para a construção da paz. **Não nos restringimos a universidades**.
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Nossa rede acolhe organizações que desejam atuar em conjunto por um mundo mais justo e pacífico. São bem-vindas instituições de ensino superior (públicas ou privadas), escolas, centros de pesquisa, organizações não-governamentais, coletivos sociais, institutos internacionais, entidades públicas e privadas, e até mesmo iniciativas informais que compartilhem desse propósito.
                                        </p>
                                    <?php } else { ?>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Qualquer pessoa comprometida com a causa da paz pode ser voluntária.
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Estudantes e pesquisadores (de qualquer área do conhecimento)
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Profissionais específicos em impacto social
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Ativistas e líderes comunitários
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Pessoas com vontade de aprender e contribuir
                                        </p>
                                        <p class="small" style="color: #E0E0E0;">
                                            &bull; Não exigimos experiência prévia, mas é fundamental ter empatia, proatividade e vontade de trabalhar em equipe.
                                        </p>
                                    <?php } ?>
                                </div>
                                <a href="#faq">
                                    <button class="btn rounded-3 btn-send btn-transparente-aqui me-2" style="color: white; border-color: white; background-color: <?php echo $cor_destaque; ?> !important;">
                                        Perguntas frequentes
                                    </button>
                                </a>
                            </div>
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