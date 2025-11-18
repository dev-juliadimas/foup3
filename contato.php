<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>FOUP - Contato</title>
  <link rel="stylesheet" href="css/est_contato.css" />
</head>

<body>
  <div id="nav-placeholder"></div>

  <main>
        <section class="contato-banner" style="background-color: var(--cor-azul-escuro);">
            <img src="arquivos/contato/Telefone-Separado.png" alt="Telefone Contato Foup">
            <img src="arquivos/contato/Contato-Texto-Separado.png" alt="Telefone Contato Foup">
        </section>

        <section class="contato-main">
            <div class="container">
                <p>Entre em contato conosco pelos meios abaixo. Retornaremos o mais breve possível.</p>

                <div class="form-container">
                    <div class="row">
            <div class="col-lg-7">
              <form class="text-left"id="form_contato" onsubmit="envia_email_contato(event); return false;">
                <div id="msg_contato" class="my-3"></div>

                <div class="row">
                  <div class="col-md-6">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome*" autocomplete="name" required>
                  </div>
                  <div class="col-md-6">
                    <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Telefone*" autocomplete="tel" required>
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-6">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email*" autocomplete="email" required>
                  </div>
                  <div class="col-md-6">
                    <select class="form-select" id="tipo" aria-label="Selecione o tipo" name="tipo" required>
                      <option value="" selected disabled>Selecione o tipo*</option>
                      <option value="duvidas">Dúvidas</option>
                      <option value="elogios">Elogios</option>
                      <option value="sugestões">Sugestões</option>
                    </select>
                  </div>
                </div>
                <br>
                <textarea class="form-control" rows="5" id="mensagem" name="mensagem" placeholder="Mensagem*" autocomplete="off" required></textarea>

                <small class="text-muted d-block mt-3">*Campos obrigatórios.</small>

                <button type="submit" class="btn btn-enviar">ENVIAR</button>
              </form>
            </div>

                        
                        
                        <div class="col-lg-5 form-info">
                            <div>
                                <div class="icon"> <i class="fa-solid fa-phone-volume"></i> </div> 
                                <div>
                                    <strong>Phone</strong>
                                    <span>+55 (48) 9 9607 9627</span>
                                </div>
                            </div>
                            <div>
                                <div class="icon"> <i class="fa-solid fa-envelope"></i> </div> <div>
                                    <strong>E-mail</strong>
                                    <a href="mailto:contato@foup.org" target="_blank" class="link-sem-estilo">
                                        <span>contato@foup.org</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
    </main>

  <div id="footer-placeholder"></div>

    <script src="js/carrega2.js"></script>
</body>

</html>