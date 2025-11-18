<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet"
  />
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
    integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
  />
  <style>
    @import url(./estPadrao.css);

    #mainNav:not(.scrolled) {
      background-color: transparent !important;
      box-shadow: none !important;
      z-index: 1030; /* Garante que a barra fique por cima */
    }

    /* Estilo dos Links no Estado Transparente (Home) */
    #mainNav:not(.scrolled) .nav-link {
      color: var(--cor-branco) !important;
    }

    .navbar.scrolled {
      background-color: var(
        --cor-azul-escuro
      ) !important; /* Azul Escuro Sólido */
      box-shadow: 0 2px 6px var(--cor-preto);
    }

    /* Estilo dos Links e Logo no Estado Sólido (scrolled) */
    .navbar.scrolled .nav-link,
    .navbar.scrolled .navbar-brand {
      color: var(--cor-branco) !important; /* Mantém links brancos */
      background-color: var(
        --cor-azul-escuro
      ) !important; /* Azul Escuro Sólido */
    }

    /* Destaque do Link Ativo (Amarelo/Warning) */
    .nav-link.text-warning {
      color: var(--cor-laranja) !important;
    }

    .navbar {
      transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .navbar-nav .nav-link {
      color: var(--cor-branco) !important;
    }

    #sidebar {
      position: fixed;
      top: 0;
      left: -300px;
      width: 300px;
      height: 100%;
      background-color: var(--cor-branco);
      padding: 20px;
      box-shadow: 2px 0 12px var(--cor-azul-escuro);
      transition: left 0.4s ease, opacity 0.4s ease;
      opacity: 0;
      z-index: 1050;
    }

    #sidebar.active {
      left: 0;
      opacity: 1;
    }

    #overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: var(--cor-azul-escuro);
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.4s ease, visibility 0.4s ease;
      z-index: 1040;
    }

    #overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .btn {
      background: var(--cor-laranja);
    }
  </style>
</head>
<body>
  <nav
    id="mainNav"
    class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top"
  >
    <div
      class="container w-75 d-grid align-items-center"
      style="grid-template-columns: 1fr auto 1fr"
    >
      <div class="d-flex align-items-end gap-3 justify-content-center">
        <button class="btn bg-light d-lg-none" id="toggleBtn">☰</button>
        <ul class="navbar-nav d-none d-lg-flex align-items-center gap-3">
          <li class="nav-item">
            <a class="nav-link text-light fw-bold" href="sobre.php">Sobre</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light fw-bold" href="governanca.php"
              >Governança</a
            >
          </li>
          
        </ul>
      </div>

      <a class="navbar-brand fw-bold mx-auto text-light" href="index.php">
        <img
          src="arquivos/geral/menu/foup-menu.svg"
          width="100px"
          alt="Logo FOUP"
          class="img-fluid"
        />
      </a>

      <ul
        class="navbar-nav d-none d-lg-flex justify-content-center align-items-center gap-3"
      >
        <li class="nav-item">
            <a class="nav-link text-light fw-bold" href="instituicoes.php"
              >Instituições</a
            >
          </li>

        <li class="nav-item">
          <a class="nav-link text-light fw-bold" href="contato.php"
            >Contato</a
          >
        </li>

        <li class="nav-item">
          <a class="btn rounded-1 btn-sm px-3 fw-bold text-light" href="index.php#facaParte">Faça Parte</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- Sidebar Mobile -->

  <div id="sidebar" class="bg-light d-lg-none">
    <h5 class="fw-bold">Menu</h5>
    <ul class="navbar-nav mt-3">
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="sobre.php">Sobre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="governanca.php">Governança</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="instituicoes.php">Instituições</a>
      </li>
      <li class="nav-item">
            <a class="nav-link text-light fw-bold" href="instituicoes.php"
              >Instituições</a
            >
          </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="contato.php">Contato</a>
      </li>
      <li class="nav-item mt-3">
        <a class="btn btn-warning w-100" href="index.php#facaParte">Faça Parte</a>
      </li>
    </ul>
  </div>

  <div id="overlay"></div>

  <div id="sidebar" class="bg-light d-lg-none">
    <h5 class="fw-bold">Menu</h5>
    <ul class="navbar-nav mt-3">
      <li class="nav-item">
        <a class="nav-link text-dark" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="../sobre.php">Sobre</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="../governanca.php">Governança</a>
      </li>
      <li class="nav-item">
            <a class="nav-link text-light fw-bold" href="instituicoes.php"
              >Instituições</a
            >
          </li>
      <li class="nav-item">
        <a class="nav-link text-dark" href="../contato.php">Contato</a>
      </li>
      <li class="nav-item mt-3">
        <a class="btn btn-warning w-100" href="facaParte.php">Faça Parte</a>
      </li>
    </ul>
  </div>

  <div id="overlay"></div>
</body>
