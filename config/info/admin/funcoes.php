<?php

function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
    $magic_quotes = strtolower(ini_get('magic_quotes_sybase')) == "on";
    $theValue = (!$magic_quotes) ? addslashes($theValue) : $theValue;

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "number":
            if (is_numeric($theValue))
                $theValue = ($theValue != "") ? $theValue : "NULL";
            else
                die('<table width="100%"><tr><td align="center" bgcolor="#F0F0F0"><b>Numero Invalido (' . $theType . " / " . $theValue . ')!</b><br><A HREF="javascript:history.back()">Voltar</A></td></tr></table>');
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "funcao":  // colunas com formulas... nao adiciona nada!
            $theValue = ($theValue != "") ? $theValue : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;

    }
    return $theValue;
}


function botoes($bGravar, $bAlterar, $bConsultar, $bNovo, $bExcluir, $bPrev, $bNext, $bAjuda)
{    // 0 = desabilitado   1 = habilitado    senao = nao exibe

    if ($bGravar == 1)
        $botoes = "<input name=\"bt_gravar\" type=\"submit\" class=\"btSalvar\" value=\"   \" onClick=\"return verifica();\" title=\"Salvar\">\n";
    elseif ($bGravar == 0)
        $botoes = "<input name=\"bt_gravar\" type=\"submit\" class=\"btSalvarOff\" value=\"   \" onClick=\"return verifica();\" disabled>\n";

    if ($bAlterar == 1)
        $botoes = "<input name=\"bt_alterar\" type=\"submit\" class=\"btSalvar\" value=\"   \" onClick=\"return verifica();\" title=\"Salvar\">\n";
    elseif ($bGravar == 0)
        $botoes = "<input name=\"bt_alterar\" type=\"submit\" class=\"btSalvarOff\" value=\"   \" onClick=\"return verifica();\" disabled>\n";

    if ($bConsultar == 1)
        $botoes .= "<input name=\"bt_consultar\" type=\"submit\" class=\"btConsulta\" value=\"   \" title=\"Consultar\">\n";
    elseif ($bConsultar == 0)
        $botoes .= "<input name=\"bt_consultar\" type=\"submit\" class=\"btConsulta\" value=\"   \" disabled>\n";

    if ($bNovo == 1)
        $botoes .= "<input name=\"bt_novo\" type=\"submit\"  class=\"btNovo\" value=\"   \" title=\"Novo Registro\">\n";
    elseif ($bNovo == 0)
        $botoes .= "<input name=\"bt_novo\" type=\"submit\" class=\"btNovo\" value=\"   \" disabled>\n";

    if ($bExcluir == 1)
        $botoes .= "<INPUT name=\"bt_excluir\" TYPE=\"submit\" class=\"btExcluir\" value=\"   \" onClick=\"return confirma('Exlcuir Registro?');\" title=\"Excluir\">\n";
    elseif ($bExcluir == 0)
        $botoes .= "<INPUT name=\"bt_excluir\" TYPE=\"submit\" class=\"btExcluirOff\" value=\"   \" onClick=\"return confirma('Exlcuir Registro?');\" disabled>\n";

    $botoes .= "<img src=\"images2/sep.jpg\" width=\"2\" height=\"22\" align=\"absbottom\">\n";

    if ($bPrev == 1)
        $botoes .= "<input name=\"bt_anterior\" type=\"submit\" class=\"btPrev\" value=\"   \" title=\"Anterior\">\n";
    elseif ($bPrev == 0)
        $botoes .= "<input name=\"bt_anterior\" type=\"submit\" class=\"btPrevOff\" value=\"   \" disabled>\n";

    if ($bNext == 1)
        $botoes .= "<input name=\"bt_proximo\" type=\"submit\" class=\"btNext\" value=\"   \" title=\"Próximo\">\n";
    elseif ($bNext == 0)
        $botoes .= "<input name=\"bt_proximo\" type=\"submit\" class=\"btNextOff\" value=\"   \" disabled>\n";

    $botoes .= "<img src=\"images2/sep.jpg\" width=\"2\" height=\"22\" align=\"absbottom\">\n";

    if ($bAjuda == 1)
        $botoes .= "<input name=\"bt_ajuda\" type=\"button\" class=\"btAjuda\" value=\"   \" title=\"Ajuda\">\n";
    elseif ($bAjuda == 0)
        $botoes .= "<input name=\"bt_ajuda\" type=\"button\" class=\"btAjuda\" value=\"   \" disabled>\n";

    return $botoes;
}


/* variaveis do script:
    $tipo      : vai determinar o icone: 'info', 'question', 'erro'
    $titulo  : texto da barra de titulo
    $msg     : texto da mensagem
    $fm_action  : script de destino, partindo do diretorio raiz
    $bt_name   : nome do botao
    $bt_value  : descricao do botao
*/


function msg($tipo, $titulo, $msg, $url, $bt_name, $bt_value)
{
    $texto = "<table width=\"400\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" align=\"center\">
    <tr bgcolor=\"#0066CC\"> 
      <td colspan=\"2\" bgcolor=\"#0066CC\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\" color=\"#FFFFFF\"><b>&nbsp;$titulo</b></font></td>
      <td width=\"15\" align=\"center\" bgcolor=\"#CCCCCC\" height=\"19\"><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><b><a href=\"javascript:history.back()\"><img src=\"images/anteriord.gif\" width=\"20\" height=\"18\" border=\"0\" alt=\"Voltar\"></a></b></font></td>
    </tr>
    <tr bgcolor=\"#f0f0f0\"> 
      <td width=\"45\" valign=\"top\"> 
        <p>&nbsp;<br>&nbsp;";

    if ($tipo == 'info')
        $texto .= "<img src=\"images/information.gif\" width=\"25\" height=\"33\">";

    elseif ($tipo == 'question')
        $texto .= "<img src=\"images/questiom.gif\" width=\"32\" height=\"32\">";

    elseif ($tipo == 'erro')
        $texto .= "<img src=\"images/error.gif\" width=\"32\" height=\"32\">";

    else
        $texto .= "<img src=\"images/information.gif\" width=\"25\" height=\"33\">";

    $texto .= "</p>
      </td>
      <td width=\"290\" align=\"center\"> 
        <p><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><br>
          $msg</font><font face=\"Verdana, Arial, Helvetica, sans-serif\" size=\"2\"><br>
          </font></p>
      </td>
      <td>&nbsp;</td>
    </tr>
    <tr bgcolor=\"#f0f0f0\"> 
      <td width=\"45\" valign=\"top\">&nbsp;</td>
      <td width=\"290\" align=\"center\"><br>";

    if ($bt_name != "")
        $texto .= "<input type=\"button\" name=\"$bt_name\" value=\"$bt_value\" class=\"text_button\" 
                     onClick=\"javascript:window.location='$url';\">";
    else
        $texto .= "<input type=\"button\" name=\"voltar\" value=\"Voltar\" class=\"text_button\" 
                     onClick=\"javascript:history.back();\">";

    $texto .= "</td>
      <td>&nbsp;</td>
    </tr>
  </table>";

    return ($texto);
}

function envia_mail($de, $para, $assunto, $texto)
{
    $header = "From: $de\nContent-Type: text/plain; charset=iso-8859-1";
    $v_data = date("d/m/Y");
    $v_hora = date("H:i:s");
    $texto .= "\n\nHelpdesk-Web $v_data $v_hora";

    mail($para, $assunto, $texto, $header) or die("<b>Falha ao enviar e-mail de Notificação! Contate suporte!</b>");

    return;
}

function formata_data($data = '', $tipo = 1)
{
    if ($data == '')
        return '';

    if ($tipo == 1) {        // '31/12/2001' --> '2001-12-31'
        $ad = explode('/', $data);
        $d = $ad[2] . "-" . $ad[1] . "-" . $ad[0];
        //$d = preg_replace('([0-9]*)/([0-9]*)/([0-9]*)','\3-\2-\1', $data);
    } elseif ($tipo == 2) {    // '2001-12-31' --> '31/12/2001'
        $ad = explode('-', $data);
        $d = $ad[2] . "/" . $ad[1] . "/" . $ad[0];
        //$d = preg_replace('([0-9]*)-([0-9]*)-([0-9]*)','\3/\2/\1', $data);
    }
    return ($d);
}

function read_file($strfile)
{
    $result = "";
    if ($strfile == "" || !file_exists($strfile)) return;
    $thisfile = file($strfile);
    while (list($line, $value) = each($thisfile)) {
        $value = ereg_replace("(\r|\n)", "", $value);
        $result .= "$value\r\n";
    }
    return $result;
}

function unhtmlentities($string)
{
    $trans_tbl = get_html_translation_table(HTML_ENTITIES);
    $trans_tbl = array_flip($trans_tbl);
    return strtr($string, $trans_tbl);
}

function texto_email($texto)
{

    $v_data = date("d/m/Y");
    $v_hora = date("H:i");

    $v_texto = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0 Transitional//EN\">
   <html>
   <head>
   <title>Mensagem</title>
   <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
   <link href=\"http://www.mademil.com.br/style.css\" rel=\"stylesheet\" type=\"text/css\">
   </head>

   <body>
   <table width=\"500\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
      <tr> 
         <td colspan=\"3\" bgcolor=\"#f0f0f0\"><img src=\"http://www.mademil.com.br/images/logo_01.jpg\"></td>
      </tr>
      <tr> 
         <td colspan=\"3\"> <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#f0f0f0\">
               <tr> 
                  <td width=\"5\"><img src=\"http://www.mademil.com.br/images/spacer.gif\" width=\"1\" height=\"1\"></td>
                  <td width=\"549\"><hr width=\"100%\" size=\"1\">
                     <font size=\"2\" face=\"Verdana, Arial, Helvetica, sans-serif\"> 
                     $texto</font></td>
                  <td width=\"5\" align=\"right\" valign=\"bottom\"><img src=\"http://www.mademil.com.br/images/spacer.gif\" width=\"1\" height=\"1\"></td>
               </tr>
               <tr> 
                  <td width=\"5\" align=\"left\" valign=\"bottom\"><img src=\"http://www.mademil.com.br/images/cantos/ie.gif\" width=\"5\" height=\"5\"></td>
                  <td><img src=\"http://www.mademil.com.br/images/spacer.gif\" width=\"1\" height=\"1\"></td>
                  <td width=\"5\" align=\"right\" valign=\"bottom\"><img src=\"http://www.mademil.com.br/images/cantos/id.gif\" width=\"5\" height=\"5\"></td>
               </tr>
            </table></td>
      </tr>
      <tr> 
         <td width=\"166\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\"><a href=\"http://www.mademil.com.br\" title=\"Fundição Mademil: Solução em Polias\">www.mademil.com.br</a></font></td>
         <td width=\"166\" align=\"center\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">Mademil, Solução em Polias</font></td>
         <td width=\"166\" align=\"right\"><font size=\"1\" face=\"Verdana, Arial, Helvetica, sans-serif\">$v_data 
            $v_hora</font></td>
      </tr>
   </table>
   </body>
   </html>";

    return ($v_texto);
}


function cript($txt)
{
    $var = base64_encode($txt . "&d=" . (date("s") * time()));
    return $var;
}

function decript($v)
{
    $ar = explode("&", base64_decode($v));
    foreach ($ar as $key => $val) {
        $var = explode("=", $val);
        $vars[$var[0]] = $var[1];
    }
    return $vars;
}

function sendMailAnexo($fileAttachment, $mailMessage, $subject, $toAddress, $fromMail)
{
    //$fileAttachment = trim($fileAttachment);
    $from = $fromMail;
    $pathInfo = pathinfo($fileAttachment['name']);
    $attchmentName = $fileAttachment['name'] . "." . $pathInfo['extension'];

    $attachment = chunk_split(base64_encode(file_get_contents($fileAttachment['tmp_name'])));
    $boundary = "PHP-mixed-" . md5(time());
    $boundWithPre = "\n--" . $boundary;

    $headers = "From: $from";
    $headers .= "\nReply-To: $from";
    $headers .= "\nContent-Type: multipart/mixed; boundary=\"" . $boundary . "\"";

    $message = $boundWithPre;
    $message .= "\n Content-Type: text/html; charset=iso-8859-1\n";
    $message .= "\n $mailMessage";

    $message .= $boundWithPre;
    $message .= "\nContent-Type: application/octet-stream; name=\"" . $attchmentName . "\"";
    $message .= "\nContent-Transfer-Encoding: base64\n";
    $message .= "\nContent-Disposition: attachment\n";
    $message .= $attachment;
    $message .= $boundWithPre . "--";

    return mail($toAddress, $subject, $message, $headers);

}


function upload_foto($arquivo, $pasta, $nome)
{
    //verfica se tem arquivo pra enviar
    if ($arquivo['name'] == '') {
        return false; // "Arquivo nao informado";
    }

    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    if (($ext != "jpg") and ($ext != "png")) {
        return false;
    }

    if ($arquivo["size"] > 5000000) {
        //echo "Foto muito grande, excede 5MB.";
        return false;
    }
    $nm_arquivo = $nome . "." . $ext;
    $arquivo_destino = "../$pasta/$nm_arquivo";

    if (move_uploaded_file($arquivo["tmp_name"], $arquivo_destino)) {
        //echo "Foto enviada com sucesso: $arquivo_destino";
        return $nm_arquivo;
    } else {
        //echo "Falha ao enviar: $arquivo_destino : ".$_FILES["foto"]["error"];
        return false;
    }
}

//drwxr-xr-x
//drwxrwxr-x
function upload_ata($arquivo, $pasta, $nome)
{
    //verfica se tem arquivo pra enviar
    if ($arquivo['name'] == '') {
        return false; // "Arquivo nao informado";
    }

    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    if ($ext != "pdf") {
        die('Arquivo precisa ser PDF.');
        return false;
    }

    if ($arquivo["size"] > 5000000) {
        //echo "Foto muito grande, excede 5MB.";
        return false;
    }
    $nm_arquivo = $nome . "." . $ext;
    $arquivo_destino = "../$pasta/$nm_arquivo";

    if (is_uploaded_file($arquivo['tmp_name'])) {
        move_uploaded_file($arquivo["tmp_name"], $arquivo_destino);
        //echo "arquivo enviado com sucesso: $arquivo_destino";
        return $nm_arquivo;
    }
    else
    {
        //echo "Falha ao enviar $arquivo_destino : " . $arquivo["error"];
        return false;
    }

}

function upload_publicacao($arquivo, $pasta, $nome)
{
    //verfica se tem arquivo pra enviar
    if ($arquivo['name'] == '') {
        return false; // "Arquivo nao informado";
    }

    $ext = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));

    if ($ext != "pdf") {
        die('Arquivo precisa ser PDF.');
        return false;
    }

    if ($arquivo["size"] > 5000000) {
        //echo "Foto muito grande, excede 5MB.";
        return false;
    }
    $nm_arquivo = $nome . "." . $ext;
    $arquivo_destino = "$pasta/$nm_arquivo";

    if (is_uploaded_file($arquivo['tmp_name'])) {
        move_uploaded_file($arquivo["tmp_name"], $arquivo_destino);
        //echo "arquivo enviado com sucesso: $arquivo_destino";
        return $nm_arquivo;
    }
    else
    {
        //echo "Falha ao enviar $arquivo_destino : " . $arquivo["error"];
        return false;
    }

}

?>
