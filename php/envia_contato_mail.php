<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Incluir os arquivos da biblioteca PHPMailer (Caminho phpmailer/ está correto para sua estrutura)
include 'phpmailer/PHPMailer.php'; 
include 'phpmailer/SMTP.php';
include 'phpmailer/Exception.php';

// --- Função de Sanitização e Captura de Dados ---
function sanitize_input($data) {
    $data = trim($data);
    $data = strip_tags($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

$nome       = sanitize_input($_POST['nome'] ?? '');
$email_raw  = $_POST['email'] ?? '';
$email      = filter_var($email_raw, FILTER_SANITIZE_EMAIL) ?: ''; 
$telefone   = sanitize_input($_POST['telefone'] ?? '');
$tipo       = sanitize_input($_POST['tipo'] ?? '');
$mensagem   = strip_tags(trim($_POST['mensagem'] ?? '')); 

// --- Validação de Campos Obrigatórios (Servidor) ---
$campos_obrigatorios = ['Nome' => $nome, 'E-mail' => $email, 'Telefone' => $telefone, 'Tipo' => $tipo, 'Mensagem' => $mensagem];
$erros_validacao = [];

foreach ($campos_obrigatorios as $nome_campo => $valor_campo) {
    if (empty($valor_campo)) { $erros_validacao[] = "O campo **{$nome_campo}** é obrigatório."; } 
    elseif ($nome_campo === 'E-mail' && !filter_var($email_raw, FILTER_VALIDATE_EMAIL)) { $erros_validacao[] = "O campo **E-mail** não está em um formato válido."; }
}

if (!empty($erros_validacao)) {
    http_response_code(400); // Bad Request
    $mensagem_erro = "<h4>❌ Falha na Validação</h4><p>Preencha corretamente:</p><ul>";
    foreach ($erros_validacao as $erro) { $mensagem_erro .= "<li>{$erro}</li>"; }
    $mensagem_erro .= "</ul>";
    echo $mensagem_erro;
    exit;
}

// ----------------------------------------------------------------------
// Configuração do PHPMailer
// ----------------------------------------------------------------------
$mail = new PHPMailer(true);

try {
    // 🚨 Ação de correção: Evita o erro de instância
    $mail->SMTPDebug = 2; // Nível 2 para debug
    $mail->isSMTP(); 
    $mail->Host      = 'smtp.hostinger.com'; 
    $mail->SMTPAuth  = true; 
    $mail->Username  = 'foup@foup.org'; // ⚠️ SEU E-MAIL
    $mail->Password  = '***********'; // ⚠️ SUA SENHA
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port      = 587;
    $mail->CharSet   = 'UTF-8'; 

    // Destinatários e Conteúdo
    $mail->setFrom('foup@foup.org', 'Formulário de Contato FOUP'); 
    $mail->addReplyTo($email, $nome); 
    $mail->addAddress('dev.julia@icloud.com', 'Júlia (TESTE)'); // ⚠️ SEU DESTINATÁRIO
    
    $mail->isHTML(true); 
    $mail->Subject = 'Mensagem de Contato - ' . $nome;
    $body  = '<h2>Nova Mensagem de Contato do Site</h2><p>Segue abaixo dados da mensagem:</p>';
    $body .= '<p><b>Nome:</b> ' . $nome . '<br><b>E-mail:</b> ' . $email . '<br>';
    $body .= '<b>Telefone:</b> ' . $telefone . '<br><b>Tipo:</b> ' . $tipo . '</p>';
    $body .= '<p><b>Mensagem:</b><br>' . nl2br($mensagem) . '</p>'; 
    
    $mail->Body    = $body;
    $mail->AltBody = 'Novo contato de ' . $nome . ' recebido pelo site';

    $mail->send();

    http_response_code(200);
    echo 'email enviado';
    
} catch (Exception $e) {
    http_response_code(500); 
    $error_message = "FALHA CRÍTICA NO ENVIO: PHPMailer diz: " . $mail->ErrorInfo;
    $error_message .= "\nDetalhe da Exceção: " . $e->getMessage();
    echo $error_message;
}