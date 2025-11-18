<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <title>FOUP - Home</title>
  <link rel="stylesheet" href="css/estIndex.css" />
  <style>
    /* Efeito de Hover para os Cards */
.custom-card-hover {
    /* Define uma transição suave para as mudanças de estilo */
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.custom-card-hover:hover {
    /* Eleva o card levemente */
    transform: translateY(-5px); 
    
    /* Aumenta a sombra para dar a sensação de flutuação */
    box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important; 
    
    /* Remove a decoração de texto ao passar o mouse (para o link) */
    text-decoration: none;
    
    /* Garante que o cursor mude para indicar que é clicável */
    cursor: pointer;
}
  </style>
</head>

<body>
  <div id="nav-placeholder"></div>

  <div id="overlay"></div>

  <!-- Hero -->
  <section class="vh-100 d-flex align-items-center justify-content-center"
    style="background:url('arquivos/index/banner.jpg') center/cover no-repeat;">
    <div class="container w-50 text-start text-light">
      <h1 class="display-1 fw-bold">FAÇA<br>PAZ<span class="text-warning">.</span></h1>
      <p>Uma união para transformar<br>conhecimento em paz</p>
      <div class="d-flex flex-wrap gap-2">
        <a href="#" class="btn border-white rounded-1 px-5 fw-bold text-light">FAÇA PARTE</a>
        <a href="#" class="btn rounded-1 btn-sm px-3 fw-bold text-light" style="background: orange;">Sobre</a>
      </div>
    </div>

    <div class="position-absolute text-light vertical-text">
      Fórum das Universidades Pela Paz
    </div>
  </section>

  <!-- Partners -->
  <section class="partners py-5 d-flex flex-column align-items-center justify-content-center gap-3" 
      style="background-color: #fff;">
    <h6 class="text-light fw-bold" style="color: #001829;">FOUP. Parceiros</h6>
    <ul class="d-flex flex-wrap justify-content-center align-items-center m-0 gap-4 list-unstyled">
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-1.jpg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-2.png" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-3.svg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-4.jpg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-5.jpeg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-6.png" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-7.jpeg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-8.png" class="img-fluid"></li>
      <!--<li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-9.jpg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-10.png" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-11.jpg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-12.svg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-13.png" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-14.svg" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-15.png" class="img-fluid"></li>
      <li><img width="130px" src="arquivos/index/logo-parceiros/patrocinador-16.png" class="img-fluid"></li>-->
      
    </ul>
          <a href="#" class="btn border-white rounded-0 py-1 px-3 fw-bold text-light mt-2">
              VER <span class="text-warning">TODAS</span>
            </a>
  </section>

  <section class="be-part vh-100 d-flex align-items-center" style="background-color: #005D83;">
    <div
      class="container w-75 d-flex flex-column flex-lg-row justify-content-center align-items-center gap-5 text-light">
      <div class="text-start">
        <h2 class="display-1 fw-bold">FAÇA<br>PARTE<span class="text-warning">.</span></h2>
        <p>Cadastre-se e venha fazer parte<br>desse movimento</p>
        <div class="d-flex flex-wrap gap-2">
          <a href="#" class="btn border-white rounded-0 px-5 fw-bold text-light">
            <i class="fa-solid fa-users"></i>
            VOLUNTÁRIO
          </a>
          <a href="#" class="btn border-white rounded-0 px-5 fw-bold text-light">
            <i class="fa-solid fa-building-columns"></i>
            INSTITUIÇÃO
          </a>
        </div>
      </div>

      <div class="border rounded-1 p-4" style="width: 450px;">
        <h3 class="fw-bold text-center mb-4">
          SEJA UM PATROCINADOR <span class="text-warning">OFICIAL</span>
        </h3>
        <div class="d-flex flex-column flex-lg-row align-items-center justify-content-center gap-4">
          <img width="80px" src="arquivos\geral\faca-paz\faca-paz-transparente.png" class="img-fluid">
          <div class="text-start">
            <p>Apoie nossos projetos e conheça<br>os benefícios de ser um patrocinador do FOUP.</p>
            <a href="#" class="btn border-white rounded-0 py-1 px-3 fw-bold text-light mt-2">
              CADASTRE-SE <span class="text-warning">GRATUITAMENTE</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Próximos eventos -->
  <section class="vh-100 d-flex align-items-center"
    style="background:url('arquivos/index/banner-eventos.png') center/cover no-repeat;">
    <div class="container">
      <div class="row">
        <div class="col-12 col-lg-6 offset-lg-6 text-start text-light">
          <h1 class="display-1 fw-bold">PRÓXIMOS<br>EVENTOS<span class="text-warning">.</span></h1>
          <p>Selecione as datas e descubra os<br>próximos eventos</p>

          <div class="d-flex flex-wrap gap-3 mb-4 justify-content-center justify-content-lg-start">

            <div class="d-flex flex-column align-items-center justify-content-center bg-warning text-dark rounded"
              style="width: 80px; padding: 12px 0; text-align: center;">
              <span class="fs-2 lh-1">05</span>
              <span class="fw-bold fs-6">OUT</span>
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center text-ligth rounded"
              style="width: 80px; padding: 12px 0; text-align: center; background-color: #001829;">
              <span class="fs-2 lh-1">07</span>
              <span class="fw-bold fs-6">NOV</span>
            </div>

            <div class="d-flex flex-column align-items-center justify-content-center text-ligth rounded"
              style="width: 80px; padding: 12px 0; text-align: center; background-color: #001829;">
              <span class="fs-2 lh-1">17</span>
              <span class="fw-bold fs-6">DEZ</span>
            </div>

          </div>


          <div class="d-flex justify-content-center justify-content-lg-start mt-4">
            <a href="#" class="btn border-white rounded-1 px-5 fw-bold text-light">FAÇA PARTE</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  <!-- EVENTOS ANTERIOREs -->
  <section class="d-flex align-items-center"
    style="min-height: 70vh; background:url('arquivos/index/banner-eventos-anteriores.png') center/cover no-repeat;">
    <div class="container">
      <div class="row align-items-center g-4">
        <div class="col-12 col-lg-6">
          <img src="arquivos/index/evento-pequeno.jpg" class="img-fluid rounded"
            style="object-fit: cover; width: 100%; height: 100%;">
        </div>

        <div class="col-12 col-lg-6 text-light ps-lg-5">
          <h1 class="display-3 fw-bold lh-sm mb-3">
            EVENTOS<br>
            <span class="text-warning">ANTERIORES.</span>
          </h1>
          <p class="lead mb-4">Encerramento do primeiro fórum de universidades pela paz</p>
          <a href="#" class="btn btn-lg px-5 fw-bold text-dark rounded-1" style="background: orange;">Ver</a>
        </div>
      </div>
    </div>
  </section>

  <section class="container py-5 bg-light position-relative mt-5">
    <div class="position-relative px-4 py-3 border border-black" style="z-index:2;">
      <img src="arquivos/index/evento-contorno.png" alt="Contorno" 
       class="position-absolute top-0 start-50 translate-middle img-fluid" 
       style="z-index:1; max-width:90%;">

      <!-- <div class="text-center mb-5">
        <h2 class="display-4 fw-bold">EVENTOS <span class="text-warning">ANTERIORES</span>.</h2>
      </div> -->

      <div class="p-4">
    <div class="row g-4">
        
        <a href="blog?aWQ9MTkmZD01Mjg1Mjk1MzY5" 
           class="col-12 col-md-4 text-start d-flex flex-column border rounded p-3 h-100 shadow-sm custom-card-hover" 
           style="text-decoration: none; color: inherit;">
            
            <img src="arquivos/index/eventos/evento-1.jpeg" alt="Evento 1" class="img-fluid rounded mb-3">
            <h6 class="text-primary">ENCERRAMENTO</h6>
            <p class="flex-grow-1">Fórum de Universidades pela Paz encerra com a assinatura da Carta de Florianópolis</p>
            <small class="text-muted mt-auto">27/11/2024 • By Foup</small>

        </a>
        
        <a href="blog?aWQ9MTgmZD01Mjg1Mjk1MzY5" 
           class="col-12 col-md-4 text-start d-flex flex-column border rounded p-3 h-100 shadow-sm custom-card-hover"
           style="text-decoration: none; color: inherit;">
            
            <img src="arquivos/index/eventos/evento-2.jpeg" alt="Evento 2" class="img-fluid rounded mb-3">
            <h6 class="text-primary">FOUP E ODS</h6>
            <p class="flex-grow-1">Segundo dia do Fórum de Universidades pela Paz destaca compromissos com os ODS</p>
            <small class="text-muted mt-auto">26/11/2024 • By Foup</small>

        </a>
        
        <a href="blog?aWQ9MTcmZD01Mjg1Mjk1MzY5" 
           class="col-12 col-md-4 text-start d-flex flex-column border rounded p-3 h-100 shadow-sm custom-card-hover"
           style="text-decoration: none; color: inherit;">
            
            <img src="arquivos/index/eventos/evento-3.jpg" alt="Evento 3" class="img-fluid rounded mb-3">
            <h6 class="text-primary">1º ENCONTRO FOUP</h6>
            <p class="flex-grow-1">1º encontro presencial do Fórum de Universidades pela Paz, marca início de debates globais sobre a paz</p>
            <small class="text-muted mt-auto">25/11/2024 • By Foup</small>

        </a>
    </div>
</div>
    </div>
  </section>
  <div id="footer-placeholder"></div>

  <script type="module" src="js/carrega2.js"></script>
</body>

</html>