<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faça Parte | FOUP</title>
  <link rel="stylesheet" href="arquivos/fonts.css">

  <style>
    /* === ESTILOS GERAIS === */
    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #000;
      color: #fff;
      overflow-x: hidden;
    }

    main {
      margin-top: 0;
    }

    h1,
    h2,
    h3 {
      margin: 0;
      font-weight: 700;
    }

    button {
      cursor: pointer;
      border: none;
      font-family: inherit;
      font-weight: 600;
      letter-spacing: 1px;
      transition: all 0.3s ease;
    }

    /* === BANNER INICIAL === */
    .adesao-header {
      position: relative;
      height: 60vh;
      background: url('arquivos/adesao-banner.jpg') center/cover no-repeat;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      text-align: center;
    }

    .adesao-banner h1 {
      font-size: 4rem;
      letter-spacing: 3px;
      color: #fff;
    }

    .adesao-banner h2 {
      font-size: 2rem;
      color: #ff8c00;
      margin-top: 0.5rem;
    }

    /* === SEÇÃO VOLUNTÁRIO === */
    .voluntario-section {
      padding: 80px 10%;
      display: flex;
      justify-content: center;
    }

    .voluntario-container {
      display: flex;
      flex-wrap: wrap;
      gap: 60px;
      max-width: 1200px;
      width: 100%;
      align-items: flex-start;
    }

    .voluntario-img {
      flex: 1;
      min-width: 300px;
      text-align: center;
    }

    .voluntario-img img {
      width: 100%;
      max-width: 450px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(255, 140, 0, 0.3);
    }

    .voluntario-img h2 {
      margin-top: 20px;
      color: #ff8c00;
      font-size: 1.8rem;
      letter-spacing: 2px;
    }

    .voluntario-form {
      flex: 1;
      min-width: 320px;
      background-color: #111;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 25px rgba(255, 140, 0, 0.15);
    }

    .voluntario-form h2 {
      text-align: center;
      color: #ff8c00;
      font-size: 2rem;
      margin-bottom: 30px;
    }

    .voluntario-buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 40px;
      flex-wrap: wrap;
    }

    .btn-termo,
    .btn-modelo {
      background-color: transparent;
      color: #ff8c00;
      border: 2px solid #ff8c00;
      padding: 10px 20px;
      border-radius: 30px;
      font-size: 0.9rem;
    }

    .btn-termo:hover,
    .btn-modelo:hover {
      background-color: #ff8c00;
      color: #000;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    label {
      font-size: 0.9rem;
      color: #ccc;
    }

    input,
    select {
      padding: 12px;
      border-radius: 8px;
      border: none;
      background-color: #222;
      color: #fff;
      font-size: 0.95rem;
      outline: none;
      transition: 0.2s;
    }

    input:focus,
    select:focus {
      box-shadow: 0 0 0 2px #ff8c00;
    }

    .btn-enviar {
      background-color: #ff8c00;
      color: #000;
      padding: 14px;
      border-radius: 30px;
      font-size: 1rem;
      margin-top: 15px;
    }

    .btn-enviar:hover {
      background-color: #ffa733;
    }

    /* === SEÇÃO QUEM PODE === */
    .quem-pode {
      background-color: #111;
      padding: 80px 10%;
      text-align: center;
      border-top: 1px solid #222;
    }

    .quem-container h3 {
      font-size: 2rem;
      margin-bottom: 30px;
    }

    .quem-container h3 span {
      color: #ff8c00;
    }

    .quem-container ul {
      list-style: none;
      padding: 0;
      margin: 0 auto 40px;
      max-width: 700px;
      text-align: left;
      line-height: 1.8;
    }

    .quem-container ul li::before {
      content: "• ";
      color: #ff8c00;
    }

    .btn-perguntas {
      background-color: transparent;
      color: #ff8c00;
      border: 2px solid #ff8c00;
      padding: 12px 25px;
      border-radius: 25px;
      font-size: 1rem;
    }

    .btn-perguntas:hover {
      background-color: #ff8c00;
      color: #000;
    }

    /* === RESPONSIVIDADE === */
    @media (max-width: 900px) {
      .voluntario-container {
        flex-direction: column;
        align-items: center;
      }

      .voluntario-form {
        width: 100%;
      }

      .adesao-banner h1 {
        font-size: 3rem;
      }

      .adesao-banner h2 {
        font-size: 1.5rem;
      }
    }
  </style>
</head>

<body>
  <div id="nav-placeholder"></div>

  <main>
    <!-- BANNER -->
    <section class="adesao-header">
      <div class="adesao-banner">
        <h1>ADESÃO.</h1>
        <h2>FOUP</h2>
      </div>
    </section>

    <!-- VOLUNTÁRIO -->
    <section class="voluntario-section">
      <div class="voluntario-container">
        <div class="voluntario-img">
          <img src="arquivos/voluntario.jpg" alt="Voluntário sorrindo">
          <h2>VOLUNTÁRIO</h2>
        </div>

        <div class="voluntario-form">
          <h2>VOLUNTÁRIO</h2>

          <div class="voluntario-buttons">
            <button class="btn-termo">TERMO DE ADESÃO</button>
            <button class="btn-modelo">MODELO</button>
          </div>

          <form>
            <label>Tipo da instituição</label>
            <select required>
              <option value="">Selecione...</option>
              <option>ONG</option>
              <option>Universidade</option>
              <option>Pessoa Física</option>
            </select>

            <label>Nome da instituição*</label>
            <input type="text" required>

            <label>CNPJ*</label>
            <input type="text" required>

            <label>Nome do Reitor(a)/Presidente/Representante*</label>
            <input type="text" required>

            <label>E-mail do Reitor(a)/Presidente/Representante*</label>
            <input type="email" required>

            <label>WhatsApp</label>
            <input type="tel">

            <label>Endereço (Rua, N., Bairro)*</label>
            <input type="text" required>

            <label>CEP*</label>
            <input type="text" required>

            <label>Cidade*</label>
            <input type="text" required>

            <label>Estado*</label>
            <input type="text" required>

            <label>País*</label>
            <input type="text" required>

            <button type="submit" class="btn-enviar">ENVIAR</button>
          </form>
        </div>
      </div>
    </section>

    <!-- QUEM PODE SER VOLUNTÁRIO -->
    <section class="quem-pode">
      <div class="quem-container">
        <h3><span>QUEM</span> PODE SER VOLUNTÁRIO?</h3>
        <ul>
          <li>Qualquer pessoa comprometida com a causa da paz pode ser voluntária.</li>
          <li>Educadores e pesquisadores de qualquer área do conhecimento.</li>
          <li>Profissionais interessados em impacto social.</li>
          <li>Artistas e líderes comunitários.</li>
          <li>Pessoas com vontade de aprender e contribuir.</li>
        </ul>
        <button class="btn-perguntas">Perguntas frequentes</button>
      </div>
    </section>
  </main>

  <div id="footer-placeholder"></div>

  <script src="js/carrega2.js"></script>
</body>

</html>
