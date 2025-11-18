<?php
include 'config/config_site.php';
include 'config/info/admin/classes/bdados.class.php';
include 'config/info/admin/classes/eixo.class.php';
include 'config/info/admin/funcoes.php';

$oEixo = new Eixo();
$eixos = $oEixo->GetEixos();

?>

<body>
    <div class="row">
        <div class="mb-4">
            <h1 style="color:#fff">VOLUNTÁRIO</h1>
            <a href="#" onclick="exibe_termo(); return false;" class="btn rounded-3 btn-send btn-transparente-aqui me-2">
                Termo de Adesão
            </a>
            <a href="assets/media/termo_aceite_modelo_voluntario.pdf" target="_blank" class="btn rounded-3 btn-send btn-transparente me-2">
                Modelo
            </a>
        </div>

        <form id="form-voluntario" action="javascript:exibe_termo();" class="contact-form needs-validation" method="post" novalidate>
            <input type="hidden" name="tipo_adesao" value="V">
            
            <div class="messages"></div>
            
            <div class="row gx-1">
                <div class="col-md-12">
                    <div class="form-floating mb-1">
                        <input id="nome" type="text" name="nome" class="form-control" placeholder="Nome do Voluntário(a)" required>
                        <label for="nome">Nome do Voluntário(a) *</label>
                        <div class="invalid-feedback">Informe seu nome completo.</div>
                    </div>
                </div>
            </div>

            <div class="row gx-1">
                <div class="col-md-12">
                    <div class="form-floating mb-1">
                        <input id="email" type="email" name="email" class="form-control" placeholder="E-mail" required>
                        <label for="email">E-mail *</label>
                        <div class="invalid-feedback">Informe um e-mail válido.</div>
                    </div>
                </div>
            </div>

            <div class="row gx-1">
                <div class="col-md-6">
                    <div class="form-floating mb-1">
                        <input id="fone" type="tel" name="fone" class="form-control" placeholder="Telefone" required>
                        <label for="fone">Telefone *</label>
                        <div class="invalid-feedback">Informe seu telefone.</div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-floating mb-1">
                        <input id="whatsapp" type="tel" name="whatsapp" class="form-control" placeholder="WhatsApp">
                        <label for="whatsapp">Whatsapp</label>
                        <div class="invalid-feedback">Informe seu Whatsapp.</div>
                    </div>
                </div>
            </div>

            <div class="row gx-1">
                <div class="col-md-12">
                    <div class="form-floating mb-1">
                        <input id="endereco" type="text" name="endereco" class="form-control" placeholder="Endereço (Rua, Nº, Bairro)" required>
                        <label for="endereco">Endereço (Rua, Nº, Bairro) *</label>
                        <div class="invalid-feedback">Informe seu endereço completo.</div>
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
                    <div class="form-floating mb-4"> 
                        <input id="estado" type="text" name="estado" class="form-control" placeholder="Estado (UF)" required>
                        <label for="estado">Estado (UF) *</label>
                        <div class="invalid-feedback">Informe o estado (UF).</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-4"> 
                        <input id="pais" type="text" name="pais" class="form-control" value="Brasil" placeholder="País" required>
                        <label for="pais">País *</label>
                        <div class="invalid-feedback">Informe o país.</div>
                    </div>
                </div>
            </div>

            <div class="form-select-wrapper mb-4">
                <select class="form-select" id="eixo" name="eixo" required>
                    <option selected disabled value="">Eixo Estruturante *</option>
                    <?php foreach ($eixos as $id => $item) { ?>
                        <option value="<?=$item['id']."-".$item['titulo']?>"><?=$item['titulo']?></option>
                    <?php } ?>
                </select>
                <div class="invalid-feedback">Selecione o Eixo.</div>
            </div>


            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="aceite_voluntario" name="aceite_voluntario" required>
                <label class="form-check-label" for="aceite_voluntario" style="color: #fff">
                    Declaro ter lido e concordar com o **Termo de Adesão e Aceite**.
                </label>
                <div class="invalid-feedback">É necessário aceitar o termo para continuar.</div>
            </div>
            
            <p class="text-muted text-center" style="color: #fff !important">* Campos obrigatórios</p>

            <button type="submit" class="btn rounded-0 btn-send btn-invertido mb-0">
                <span class="d-md-block">CONTINUAR</span>
            </button>
        </form>
    </div>

    <script>
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
    </script>
</body>