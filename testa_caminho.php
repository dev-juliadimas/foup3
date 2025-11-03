<?php
$arquivos_para_analisar = [
    // Arquivos CSS
    'css/estContato.css',
    'css/estEixos.css',
    'css/estIndex.css',
    'css/estMenu.css',
    'css/estPadrao.css', 
    'css/est_sobre.css',
    
    // Arquivos HTML da Raiz
    'contato.html',
    'contato2.html',
    'eixos.html',
    'facaParte.html',
    'index.html',
    'sobre.html',

    // Arquivos HTML/JS/PHP de Subpastas
    'includes/head-menu-rodape.html',
    'js/carrega.js',
    'php/envia_contato_mail.php', 
    // Arquivos da biblioteca PHPMailer
    'php/phpmailer/Exception.php',
    'php/phpmailer/OAuth.php',
    'php/phpmailer/OAuthTokenProvider.php',
    'php/phpmailer/PHPMailer.php',
    'php/phpmailer/POP3.php',
    'php/phpmailer/SMTP.php',
];

// ARQUIVOS EXCLUÍDOS DA VERIFICAÇÃO DE CORES/FONTES SEM var()
$arquivos_excluidos_var_check = [
    'css/estPadrao.css',
    'php/envia_contato_mail.php',
    'php/phpmailer/Exception.php',
    'php/phpmailer/OAuth.php',
    'php/phpmailer/OAuthTokenProvider.php',
    'php/phpmailer/PHPMailer.php',
    'php/phpmailer/POP3.php',
    'php/phpmailer/SMTP.php',
];


// --- EXPRESSÕES REGULARES (ROBUSTAS) ---

// 1. Para encontrar caminhos em CSS (url(...) e @import url(...))
$regex_caminhos_css = '/(?:url\s*\()[\'"]?(.*?[\.](?:css|png|jpg|jpeg|gif|svg|ico|otf|ttf|woff))[\'"]?\)|@import\s+url\([\'"]?(.*?[\.](?:css|otf|woff))[\'"]?\)/i';

// 2. Para encontrar caminhos em HTML/JS/PHP (src, href, fetch, include, require, etc.)
$regex_caminhos_outros = '/(?:src|href|fetch\s*\()\s*[\'"](.*?[\.](?:css|js|png|jpg|jpeg|gif|svg|ico|otf|ttf|woff|html|json)|[\.|\/][\w\-\/]*?(?:png|jpg|jpeg|gif|svg|ico|otf|ttf|woff))[\'"]|(?:include|require(?:_once)?)\s+[\'"](.*?[\.](?:php|inc|tpl))[\'"]/i'; 

// 3. Para encontrar cores (apenas mantida para a função final, mas não usada neste foco)
$regex_nao_var = '/\#(?:[0-9a-fA-F]{3}){1,2}/i'; 

// Lista de cores/fontes permitidas
$excecoes_var = [
    'transparent', 'inherit', 'initial', 'unset', 'none',
    'sans-serif', 'serif', 'monospace', 'cursive', 'fantasy', 'url',
    '#ddd', '#eee', '#000', '#fff', '#111', '#222', '#2b3d52', '#062146', '#005d83', '#001829', 
    'bg-transparent', 'bg-light', 'text-light', 'text-dark', 'bg-primary', 'btn-warning', 'text-warning',
    'white', 'black', 'red', 'blue', 'green', 'yellow', 'orange', 'gray', 'grey', 'silver', 'gold', 'navy', 'maroon', 'purple', 'teal', 'lime', 'aqua', 'primary', 'light', 'dark', 'warning'
];


// --- FUNÇÕES DE AJUDA ---

/**
 * Normaliza o caminho para ser testado a partir da raiz do projeto, corrigindo substituições conhecidas.
 */
function normalizar_caminho($caminho, $caminho_arquivo) {
    $caminho = trim($caminho, '"\'');
    if (empty($caminho) || strpos($caminho, 'http') === 0 || strpos($caminho, '://') !== false) {
        return $caminho;
    }

    // Tenta corrigir a mudança de 'fotos' para 'arquivos'
    $caminho = str_replace(['../fotos/', 'fotos/'], ['../arquivos/', 'arquivos/'], $caminho);
    
    // Tenta corrigir nomes de pastas com números/espaços para os nomes limpos
    $caminho = str_replace('arquivos/006 - Contato/', 'arquivos/contato/', $caminho);
    $caminho = str_replace('arquivos/007 - Sobre/', 'arquivos/sobre/', $caminho);

    $partes_arquivo = explode('/', $caminho_arquivo);
    array_pop($partes_arquivo); 
    $diretorio_base = implode('/', $partes_arquivo);
    $caminho_limpo = preg_replace('/^\.\//', '', $caminho);

    if ($diretorio_base) {
        $caminho_completo = $diretorio_base . '/' . $caminho_limpo;
    } else {
        $caminho_completo = $caminho_limpo;
    }

    while (strpos($caminho_completo, '../') !== false) {
        $caminho_completo = preg_replace('#[^/]+/\.\./#', '', $caminho_completo, 1);
    }
    
    // Trata caminhos específicos de font-face
    if (strpos($caminho_arquivo, 'css/estPadrao.css') !== false && strpos($caminho, 'gobold/') === 0) {
        return "css/" . $caminho;
    }
    
    // Finalização e limpeza de barras
    $caminho_completo = str_replace('//', '/', $caminho_completo);
    if (substr($caminho_completo, 0, 1) === '/') {
        $caminho_completo = substr($caminho_completo, 1);
    }
    
    return $caminho_completo;
}

// Funções de var() omitidas para focar no path, mas mantidas no código para compatibilidade.
function eh_excecao_var($valor, $excecoes) { return true; }


// --- PROCESSAMENTO ---
$relatorio_caminhos = [];
$total_caminhos_encontrados = 0;
$total_caminhos_validos = 0;

echo "<h1>✅ Relatório de Verificação de Caminhos (Foco Total)</h1>";
echo "<h2>🔍 Detecção e Verificação de Caminhos Locais (Imagens, CSS, JS, Includes PHP)</h2>";

foreach ($arquivos_para_analisar as $caminho_arquivo) {

    if (!file_exists($caminho_arquivo)) {
        echo "<p>❌ **ERRO GRAVE:** Arquivo `{$caminho_arquivo}` não encontrado!</p>";
        continue;
    }

    $conteudo = file_get_contents($caminho_arquivo);
    $caminhos_encontrados = [];
    
    // Define a regex de caminhos com base no tipo de arquivo
    if (strpos($caminho_arquivo, '.css') !== false) {
        $regex_caminhos = $regex_caminhos_css;
    } else {
        $regex_caminhos = $regex_caminhos_outros;
    }

    // 1. Extração e Verificação de Caminhos
    if (preg_match_all($regex_caminhos, $conteudo, $matches, PREG_SET_ORDER)) {
        foreach ($matches as $match) {
            // Grupo 1: Captura HTML/CSS/JS (src, href, url). Grupo 2: Captura includes PHP
            $caminho_bruto = !empty($match[1]) ? $match[1] : (isset($match[2]) ? $match[2] : '');
            $caminho_bruto = trim($caminho_bruto);

            if (empty($caminho_bruto) || strpos($caminho_bruto, 'http') === 0) {
                continue; // Ignora caminhos vazios ou URLs externas
            }
            
            $caminho_completo = normalizar_caminho($caminho_bruto, $caminho_arquivo);
            $total_caminhos_encontrados++;

            // Correção específica para links CSS/JS da raiz (styles/ para css/ ou js/)
            if (strpos($caminho_arquivo, '.html') !== false) {
                if (strpos($caminho_bruto, 'styles/') !== false) {
                     $caminho_completo = str_replace('styles/', 'css/', $caminho_completo);
                } elseif (strpos($caminho_bruto, 'js/') === 0 && !file_exists($caminho_completo)) {
                    // Isso pode ser uma correção para o caso 'js/carrega.js' se ele for pego como 'js/js/carrega.js'
                    if (strpos($caminho_completo, 'js/js/') !== false) {
                        $caminho_completo = str_replace('js/js/', 'js/', $caminho_completo);
                    }
                }
            }


            $existe = file_exists($caminho_completo);
            if ($existe) {
                $status = '✅ OK';
                $total_caminhos_validos++;
            } else {
                $status = '❌ NÃO ENCONTRADO';
            }
            
            // Adicionar ao relatório todos os caminhos válidos/inválidos importantes
            $caminhos_encontrados[] = [
                'bruto' => $caminho_bruto,
                'completo' => $caminho_completo,
                'status' => $status
            ];
        }
    }
    $relatorio_caminhos[$caminho_arquivo] = $caminhos_encontrados;
}

// --- GERAÇÃO DE RELATÓRIO DE CAMINHOS ---
echo "<p>Total de caminhos locais detectados e testados: **{$total_caminhos_encontrados}** | Caminhos válidos: **{$total_caminhos_validos}**</p>";

foreach ($relatorio_caminhos as $arquivo => $caminhos) {
    echo "<h3>Arquivo: `{$arquivo}`</h3>";
    
    if (empty($caminhos)) {
        echo "<p class='text-muted'>— Nenhum caminho de arquivo local relevante detectado neste arquivo.</p>";
    } else {
        echo "<ul>";
        $teve_erro = false;
        foreach ($caminhos as $c) {
            $status_cor = ($c['status'] === '❌ NÃO ENCONTRADO') ? 'red' : 'green';
            echo "<li><span style='color: {$status_cor};'>{$c['status']}</span> - Caminho no arquivo: `{$c['bruto']}` -> Testado: `{$c['completo']}`</li>";
            if ($c['status'] === '❌ NÃO ENCONTRADO') {
                 $teve_erro = true;
            }
        }
        echo "</ul>";
        if ($teve_erro) {
            echo "<p>⚠️ **Ajuste manual necessário neste arquivo.**</p>";
        }
    }
}

// A seção de var() não é mais necessária, mas mantida a título de documentação.
echo "<hr>";
echo "<h2>🎨 Verificação de Cores e Fontes sem `var()` (Desativada para Foco)</h2>";
echo "<p>— Verificação de `var()` omitida para acelerar a localização dos caminhos. Retome o código completo para esta análise.</p>";


?>