<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'config/config_site.php'; // Incluir configurações globais (se necessário)
include 'config/info/phpmailer/PHPMailer.php'; // PHPMailer;
include 'config/info/phpmailer/SMTP.php'; // PHPMailer\PHPMailer\SMTP;
include 'config/info/phpmailer/Exception.php'; // PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_CLIENT;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'foup@foup.org';                     //SMTP username
    $mail->Password   = 'Foup@2023!';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('foup@foup.org', 'FOUP');
    $mail->addBCC('marcelomazon@gmail.com', 'Marcelo Mazon');     //Add a recipient
    $mail->addAddress(utf8_decode($_POST['email_represent']), utf8_decode($_POST['nome_represent']));     //Add a recipient
    $mail->addAddress('contato@foup.org', 'FOUP');     //Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    $file_name = $_POST['nome_termo'];
    $mail->addAttachment(dirname(__FILE__).'/termos/'.$file_name, $file_name);    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Novo Termo de Adesao - FOUP';

    $body  = '<p>Segue anexo novo termo de adesao.</p>';

    // post via ajax
    $body .= '<p><b>'.utf8_decode('Instituição').': </b>'.utf8_decode($_POST['nome_instituicao']).'<br>';
    $body .= '<b>Nome: </b>'.utf8_decode($_POST['nome_represent']).'<br>';
    $body .= '<b>E-mail: </b>'.utf8_decode($_POST['email_represent']).'<br>';
    $body .= '<b>Fone: </b>'.utf8_decode($_POST['fone']).'<br>';
    $body .= '<b>Whats: </b>'.utf8_decode($_POST['whatsapp']).'<br>';
    $body .= '<b>Endereco: </b>'.utf8_decode($_POST['endereco']).'<br>';
    $body .= '<b>Cidade: </b>'.utf8_decode($_POST['cidade']).'<br>';
    $body .= '<b>Estado: </b>'.utf8_decode($_POST['estado']).'<br>';
    $body .= '<b>Pais: </b>'.utf8_decode($_POST['pais']).'<br>';
    $body .= '<b>CEP: </b>'.$_POST['cep'].'<br></p>';
    $body .= '<p><b>Membro: </b><br>'.utf8_decode($_POST['nome_membro']).'<br>';
    $body .= '<b>E-mail: </b>'.utf8_decode($_POST['email_membro']).'<br>';
    $body .= '<b>Cargo: </b>'.utf8_decode($_POST['cargo_membro']).'<br>';
    $body .= '<b>Whatsapp: </b>'.utf8_decode($_POST['whatsapp_membro']).'<br></p>';
    $mail->Body = $body;
    $mail->AltBody = 'Novo termo de adesao enviado pelo site - foup.org';

    $mail->send();

    echo 'email enviado';
} catch (Exception $e) {
    echo "Falha ao enviar termo. Mailer Error: {$mail->ErrorInfo}";
}