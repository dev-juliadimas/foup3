<?php
include_once 'config/config_site.php';
include_once 'config/info/admin/classes/bdados.class.php';
include_once 'config/info/admin/classes/eixo.class.php';
include_once 'config/info/admin/funcoes.php';
?>

<head>
    <link rel="stylesheet" href="css/est_form.css">
</head>

<body>
    <div class="row">
        <div class="mb-4">
            <h1>INSTITUIÇÃO</h1>
            <a href="#"  class="btn rounded-3 btn-send btn-transparente-aqui me-2">
                Termo de Adesão
            </a>
            <a href="assets/media/termo_aceite_modelo.pdf" target="_blank" class="btn rounded-3 btn-send btn-transparente me-2">
                Modelo
            </a>
        </div>

            <form id="form-instituicao" action="javascript:exibe_termo();" class="contact-form needs-validation" method="post" novalidate>
                <input type="hidden" name="tipo_adesao" value="I">

                <div class="form-select-wrapper mb-1">
                    <select class="form-select" id="tipo_instituicao" name="tipo_instituicao" required>
                        <option value="" selected disabled>Tipo da Instituição *</option>
                        <option value="Universidade">Universidade (IES)</option>
                        <option value="ONG">Organização Não-Governamental (ONG/OSC)</option>
                        <option value="Governo">Órgão Governamental</option>
                        <option value="Outro">Outra Instituição</option>
                    </select>
                    <div class="invalid-feedback">Selecione o tipo da instituição.</div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-12">
                        <div class="form-floating mb-1">
                            <input id="nome_instituicao" type="text" name="nome_instituicao" class="form-control" placeholder="Nome da Instituição" required>
                            <label for="nome_instituicao">Nome da Instituição *</label>
                            <div class="invalid-feedback">Informe o nome completo da instituição.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-12">
                        <div class="form-floating mb-1">
                            <input id="cnpj" type="text" name="cnpj" class="form-control" placeholder="CNPJ" required>
                            <label for="cnpj">CNPJ *</label>
                            <div class="invalid-feedback">Informe o CNPJ ou código de registro.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-12">
                        <div class="form-floating mb-1">
                            <input id="nome_representante" type="text" name="nome_representante" class="form-control" placeholder="Nome do Reitor(a)/Presidente/Representante" required>
                            <label for="nome_representante">Nome do Reitor(a)/Presidente/Representante *</label>
                            <div class="invalid-feedback">Informe o nome do representante legal.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-12">
                        <div class="form-floating mb-1">
                            <input id="email_representante" type="email" name="email_representante" class="form-control" placeholder="E-mail do Reitor(a)/Presidente/Representante" required>
                            <label for="email_representante">E-mail do Reitor(a)/Presidente/Representante *</label>
                            <div class="invalid-feedback">Informe um e-mail válido do representante.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="form-floating mb-1">
                            <input id="telefone" type="tel" name="telefone" class="form-control" placeholder="Telefone *" required>
                            <label for="telefone">Telefone *</label>
                            <div class="invalid-feedback">Informe o telefone da instituição.</div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating mb-1">
                            <input id="whatsapp" type="tel" name="whatsapp" class="form-control" placeholder="WhatsApp">
                            <label for="whatsapp">WhatsApp</label>
                            <div class="invalid-feedback">Informe o Whatsapp da instituição.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-12">
                        <div class="form-floating mb-1">
                            <input id="endereco" type="text" name="endereco" class="form-control" placeholder="Endereço (Rua, Nº, Bairro)" required>
                            <label for="endereco">Endereço (Rua, Nº, Bairro) *</label>
                            <div class="invalid-feedback">Informe o endereço completo da instituição.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="form-floating mb-1">
                            <input id="cep" type="text" name="cep" class="form-control" placeholder="CEP" required>
                            <label for="cep">CEP *</label>
                            <div class="invalid-feedback">Informe o CEP.</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-1">
                            <input id="cidade" type="text" name="cidade" class="form-control" placeholder="Cidade" required>
                            <label for="cidade">Cidade *</label>
                            <div class="invalid-feedback">Informe a cidade.</div>
                        </div>
                    </div>
                </div>

                <div class="row gx-1">
                    <div class="col-md-6">
                        <div class="form-floating mb-4"> <input id="estado" type="text" name="estado" class="form-control" placeholder="Estado (UF)" required>
                            <label for="estado">Estado (UF) *</label>
                            <div class="invalid-feedback">Informe o estado (UF).</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-4"> <input id="pais" type="text" name="pais" class="form-control" value="Brasil" placeholder="País" required>
                            <label for="pais">País *</label>
                            <div class="invalid-feedback">Informe o país.</div>
                        </div>
                    </div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="aceite_instituicao" name="aceite_instituicao" required>
                    <label class="form-check-label" for="aceite_instituicao" style="color: #fff">
                        A instituição declara ter lido e concordar com o **Termo de Adesão e Aceite**.
                    </label>
                    <div class="invalid-feedback">É necessário aceitar o termo para continuar.</div>
                </div>
                <p class="text-muted text-center" style="color: #fff !important">* Campos obrigatórios</p>

                <button type="submit" class="btn rounded-0 btn-send btn-invertido mb-0">
                    <span class="d-md-block">ENVIAR</span>
                </button>
            </form>
        </div>
    </div>

    
    <script>
        // Lógica para validação e inicialização do intlTelInput, se necessário.

        (function() {
            'use strict'

            // Aplica a validação do Bootstrap
            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        // O intlTelInput para #telefone e #whatsapp será inicializado no facaParte-instituicao.php
        // Certifique-se de que a lógica de "floating label" para esses campos
        // (que usa a classe fone_label_focus) também esteja ativa.
    </script>
</body>