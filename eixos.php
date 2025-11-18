<?php
// CRÍTICO: Ajuste os caminhos de include conforme a localização deste arquivo.
// Assumindo que este arquivo está na raiz e os includes estão na subpasta.
include 'config/config_site.php';
include 'config/info/admin/classes/bdados.class.php';
include 'config/info/admin/classes/calendario.class.php';
include 'config/info/admin/classes/eixo.class.php';
include 'config/info/admin/funcoes.php'; // Para funções como GetSQLValueString

$oCalendar = new Calendario();
$oEixo = new Eixo();

// 1. Busca todos os eixos
$eixos = $oEixo->GetEixos();

?>
<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>FOUP - Eixos</title>

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="css/estEixos.css" />
    <style>
      h5 {
        color: var(--cor-azul-escuro) !important;
      }
      /* Estilos para a lista de atribuições e membros */
      .icon-list li {
        list-style: disc inside;
        margin-left: 10px;
        margin-bottom: 5px;
      }
    </style>
  </head>

  <body>
    <div id="nav-placeholder"></div>

    <section
      style="
        min-height: 85vh;
        background-image: url('arquivos/eixos/banner.png');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
      "
    ></section>

    <div class="foup-about-section">
      <div class="container w-75">
        <div class="row mb-5">
          <div class="col-12">
            <h2 class="display-5 fw-bold mb-4">
              Conheça os tópicos que compõem os Eixos Estruturantes do Fórum de
              Universidades pela Paz
            </h2>
          </div>
        </div>
      </div>

      <div
        class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4"
        style="padding: 0% 10%; background-color: #eceef0"
      >
        <div class="col">
          <div class="pillar-card h-100">
            <img
              src="arquivos/geral/icons/chat-2.svg"
              class="icon-svg icon-svg-md text-blue mb-3"
              alt="Ícone de chat"
            />
            <h5>Eixos Estruturantes e Diretrizes</h5>
            <p class="small">Temas e direcionamentos para debates do Fórum.</p>
            <a href="#acordeao-eixos">Saiba mais +</a>
          </div>
        </div>

        <div class="col">
          <div class="pillar-card h-100">
            <img
              src="arquivos/geral/icons/loyalty.svg"
              class="icon-svg icon-svg-md text-blue mb-3"
              alt="Ícone de lealdade"
            />
            <h5>Experiências Exitosas</h5>
            <p class="small">
              Compartilhamento de ações promotoras de paz bem-sucedidas.
            </p>
            <a href="#experiencias">Saiba mais +</a>
          </div>
        </div>

        <div class="col">
          <div class="pillar-card h-100">
            <img
              src="arquivos/geral/icons/files.svg"
              class="icon-svg icon-svg-md text-blue mb-3"
              alt="Ícone de arquivos"
            />
            <h5>Repositório</h5>
            <p class="small">
              Documentos construídos pelos grupos de trabalho do Fórum.
            </p>
            <a href="#repositorio">Saiba mais +</a>
          </div>
        </div>
      </div>
    </div>
    <section class="container my-5" id="acordeao-eixos" style="padding-top: 150px;">
      <h2 class="mb-4">Eixos Estruturantes e Diretrizes</h2>

      <div class="accordion" id="accordionEixos">
        <?php
        if ($eixos) {
            foreach ($eixos as $id => $item) {
                // Prepara IDs únicos para cada eixo
                $eixo_id = $item['id'];
                $collapse_id = "collapseEixo-" . $eixo_id;
                $heading_id = "headingEixo-" . $eixo_id;

                // Processa as diretrizes (quebra por linha)
                $diretrizes_list = preg_split("/\r\n|\n|\r/", $item['diretrizes']);
                
                // Processa as datas (quebra por linha)
                $datas_list = preg_split("/\r\n|\n|\r/", $item['datas']);
                
                // Busca os membros
                $coordenador_geral = $oEixo->GetMembros($eixo_id, 'G'); 
                $coordenador_tecnico = $oEixo->GetMembros($eixo_id, 'T');
                $membros_gt = $oEixo->GetMembros($eixo_id, 'M');
                
                // Texto de Atribuições (simplificado da lista HTML do código antigo)
                $atribuicoes_list = [
                    "Produzir conteúdos na linha tematica;",
                    "Mapear estudos e pesquisa dentro da linha temática e motivar a produção em conjunto;",
                    "Estudar e desenvolver políticas públicas;",
                    "Indicar produções científicas para vínculo ao repositório no site;",
                    "Produzir em conjunto de pesquisa, extensão e inovação entre as IES."
                ];
        ?>
        
        <div class="accordion-item">
          <h2 class="accordion-header" id="<?php echo $heading_id; ?>">
            <button
              class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#<?php echo $collapse_id; ?>"
              aria-expanded="false"
              aria-controls="<?php echo $collapse_id; ?>"
            >
              <?php echo $item['titulo']; ?>
            </button>
          </h2>
          <div
            id="<?php echo $collapse_id; ?>"
            class="accordion-collapse collapse"
            aria-labelledby="<?php echo $heading_id; ?>"
            data-bs-parent="#accordionEixos"
          >
            <div class="accordion-body">
              <p>ODS: <?php echo $item['ods']; ?></p>
              
              <h5 class="mt-4">Diretrizes:</h5>
              <ul class="list-unstyled icon-list">
                <?php
                foreach ($diretrizes_list as $linha) {
                    $diretriz = explode(':', $linha, 2); // Divide em 2 partes
                    if (count($diretriz) == 2) {
                        echo '<li><strong>' . trim($diretriz[0]) . ':</strong> ' . trim($diretriz[1]) . '</li>';
                    } else if (trim($linha) !== '') {
                         echo '<li>' . trim($linha) . '</li>';
                    }
                }
                ?>
              </ul>
              
              <h5 class="mt-4">Calendário de Reuniões (horários de Brasília)</h5>
              <ul class="list-unstyled">
                <?php 
                foreach ($datas_list as $linha) {
                    if (trim($linha) !== '') {
                        echo '<li>' . trim($linha) . '</li>';
                    }
                }
                ?>
              </ul>
              
              <h5 class="mt-4">Atribuições do Grupo de Trabalho</h5>
              <ul class="icon-list ps-3">
                <?php 
                foreach ($atribuicoes_list as $atribuicao) {
                    echo '<li>' . $atribuicao . '</li>';
                }
                ?>
              </ul>

              <h5 class="mt-4">Coordenador(a) do Eixo</h5>
              <ul class="list-unstyled">
                <?php 
                if ($coordenador_geral):
                    foreach ($coordenador_geral as $membro):
                ?>
                  <li>- <?php echo $membro['nm_membro']; ?> / <span style="font-style: italic"><?php echo $membro['instituicao']; ?></span></li>
                <?php 
                    endforeach;
                else:
                    echo '<li>(Aguardando indicação)</li>';
                endif;
                ?>
              </ul>

              <h5 class="mt-4">Coordenador(a) Técnico(a)</h5>
              <ul class="list-unstyled">
                <?php 
                if ($coordenador_tecnico):
                    foreach ($coordenador_tecnico as $membro):
                ?>
                  <li>- <?php echo $membro['nm_membro']; ?> / <span style="font-style: italic"><?php echo $membro['instituicao']; ?></span></li>
                <?php 
                    endforeach;
                else:
                    echo '<li>(Aguardando indicação)</li>';
                endif;
                ?>
              </ul>

              <h5 class="mt-4">Membros do Grupo de Trabalho</h5>
              <ul class="list-unstyled">
                <?php 
                if ($membros_gt):
                    foreach ($membros_gt as $membro):
                ?>
                  <li>- <?php echo $membro['nm_membro']; ?> / <span style="font-style: italic"><?php echo $membro['instituicao']; ?></span></li>
                <?php 
                    endforeach;
                else:
                    echo '<li>(Aguardando inscrições)</li>';
                endif;
                ?>
              </ul>

            </div>
          </div>
        </div>
        <?php 
            } // Fim do foreach ($eixos)
        } else {
            echo '<p class="alert alert-warning text-center">Nenhum Eixo Estruturante encontrado.</p>';
        }
        ?>
        
      </div>
    </section>
    <section class="container my-5" id="experiencias" style="padding-top: 150px;">
      <h2 class="mb-4">Experiências Exitosas (Cases)</h2>
      <p>Projetos, programas e ações desenvolvidos pelas instituições signatárias.</p>
      <p class="text-muted">(em breve)</p>
    </section>
    
    <section class="container my-5" id="calendario" style="padding-top: 150px;">
      <h2 class="mb-4">Calendário Geral</h2>
      <p>Agenda das reuniões e cronograma de atividades do Fórum.</p>
      <p class="text-muted">(em breve)</p>
    </section>

    <section class="container my-5" id="repositorio" style="padding-top: 150px;">
      <h2 class="mb-4">Repositório</h2>
      <p>Documentos construídos pelos grupos de trabalho do Fórum.</p>
      <p class="text-muted">(em breve)</p>
    </section>

    <div id="footer-placeholder"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/carrega2.js"></script>
  </body>
</html>