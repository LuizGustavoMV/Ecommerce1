<?php 


ini_set('display_errors', 1); 
error_reporting(E_ALL);

require_once __DIR__.'/PHPMailer/src/PHPMailer.php';
require_once __DIR__.'/PHPMailer/src/SMTP.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 
function EnviaEmail( $pEmailDestino, $pAssunto, $pHtml, 
                      $pUsuario = "ecommerce@efesonet.com", 
                      $pSenha = "u!G8mDRr6PBXkH6", 
                      $pSMTP = "smtp.efesonet.com" ) {    
    try {
        $mail = new PHPMailer(true);
        $mail->IsSMTP();
        $mail->Host = $pSMTP;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        
        $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));
        
        $mail->Username = $pUsuario;
        $mail->Password = $pSenha;
        $mail->setFrom($pUsuario, "Recuperacao de senhas");
        $mail->addAddress($pEmailDestino);
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Subject = $pAssunto;
        $mail->Body = $pHtml;
        
        return $mail->send();
        
    } catch (Exception $e) {
        error_log("Erro no PHPMailer: " . $e->getMessage());
        return false;
    }      
}
?>