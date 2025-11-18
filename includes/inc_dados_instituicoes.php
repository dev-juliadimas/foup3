<?php

$x = 0; // Contador de colunas na linha atual

// Abre a primeira linha ANTES do loop
echo '<div class="row mb-3">';

foreach ($dados as $item) {
    if ($x > 0 && ($x % 2 == 0)) {
        // Fecha a linha anterior e abre uma nova linha
        echo '</div> <div class="row mb-3">';
    }

    // Lógica para a logo
    if ($item['logo'] != '') {
        if (strpos(strtolower($item['logo']), 'http') === false)
            $logo = './' . $item['logo'];
        else
            $logo = $item['logo'];
    } else {
        // CORRIGIDO: O caminho da logo padrão deve ser o caminho certo a partir do ROOT (/) ou relativo
        $logo = '../arquivos/geral/menu/foup-menu.svg'; 
    }
    ?>

    <div class="col-md-6">
        <div class="card shadow-lg lift h-100">
            <div class="card-body p-5 d-flex flex-row">
                
                <div class="blockquote-details">
                    <div class="info">
                        <h5 class="mb-1 fs-14"><?= $item['sigla'] . " - " . $item['nome']; ?></h5>
                        <p class="mb-0 fs-13"><?= $item['representante'] ?></p>
                        <p class="mb-0 fs-13"><?= $item['cidade'] ?> - <?= $item['uf'] ?> - <?= $item['pais'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    $x++; 
}
echo '</div>'; 

?>