<?php

namespace Microfw\Src\Main\Functions\phpMailer;

use Microfw\Src\Main\Common\Entity\Mailer;
use Microfw\Src\Main\Functions\phpMailer\SMTP;
use Microfw\Src\Main\Functions\phpMailer\PHPMailer;

trait Send
{
    public array $email;
    public array $name;
    public array $reply;
    public array $cc;
    public array $bcc;
    public array $attachment;
    public string $subject;
    public string $body;
    public string $altBody;

    public function send()
    {
        $mail = new PHPMailer(true);
        $mailer = new Mailer();
        $mailer = $mailer->getOne($mailer, 1);
        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = $mailer->getHost();                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = $mailer->getUsername();        // SMTP username
            $mail->Password   = $mailer->getPasswd();                               // SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = $mailer->getPort();                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //Recipients
            $mail->setFrom($mailer->getUsername(), $mailer->getName());
            //adicionar quem deverá receber o email, pessoa unica ou array
            if (is_array($this->email)) {
                $count = count($this->email);
                for ($i = 0; $i < $count; $i++) {
                    $mail->addAddress($this->email[$i]);
                }
            } else {
                $mail->addAddress($this->email, $this->name);
            }
            //reply
            //adicionar quem deverá receber a resposta, pessoa unica ou array
            if (isset($this->reply)) {
                if (is_array($this->reply)) {
                    $count = count($this->reply);
                    for ($i = 0; $i < $count; $i++) {
                        $mail->addReplyTo($this->reply[$i]);
                    }
                } else {
                    $mail->addReplyTo($this->reply);
                }
            }
            //cc
            //adicionar quem deverá receber copia, pessoa unica ou array
            if (isset($this->cc)) {
                if (is_array($this->cc)) {
                    $count = count($this->cc);
                    for ($i = 0; $i < $count; $i++) {
                        $mail->addCC($this->cc[$i]);
                    }
                } else {
                    $mail->addCC($this->cc);
                }
            }
            //bcc
            //adicionar quem deverá receber copia oculta, pessoa unica ou array
            if (isset($this->bcc)) {
                if (is_array($this->bcc)) {
                    $count = count($this->bcc);
                    for ($i = 0; $i < $count; $i++) {
                        $mail->addBCC($this->bcc[$i]);
                    }
                } else {
                    $mail->addBCC($this->bcc);
                }
            }
            //Attachments
            //adicionar arquivo, unico ou array
            //$msg->attachment = "files/user/1/perfil.png";
            if (isset($this->attachment)) {
                if (is_array($this->attachment)) {
                    $count = count($this->attachment);
                    for ($i = 0; $i < $count; $i++) {
                        $mail->addAttachment($this->attachment[$i]);
                    }
                } else {
                    $mail->addAttachment($this->attachment);
                }
            }
            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = $this->subject;
            $mail->Body    = $this->body;
            if (isset($this->altBody)) {
                $mail->AltBody = $this->altBody;
            }
            $mail->SMTPDebug = 0;
            $mail->send();
            return 1;
        } catch (Exception $e) {
            return 2;
        }
    }
}
