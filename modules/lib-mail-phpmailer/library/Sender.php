<?php
/**
 * Sender
 * @package lib-mail-phpmailer
 * @version 0.0.1
 */

namespace LibMailPhpmailer\Library;

use PHPMailer\PHPMailer\{
    PHPMailer
};

class Sender
    implements 
        \LibMail\Iface\Sender
{

	private static $last_error;

    static function send(array $options): bool {
        $config = \Mim::$app->config->libMailPhpMailer;
        $recipient = $options['to'];

        $direct_set_conf = [
            'Host',
            'SMTPAuth',
            'Username',
            'Password',
            'SMTPSecure',
            'Port'
        ];

        self::$last_error = null;

        try{
	        $mail = new PHPMailer(true);

	        if($config->SMTP)
	        	$mail->isSMTP();

	        foreach($direct_set_conf as $val){
	        	if(isset($config->$val))
	        		$mail->$val = $config->$val;
	        }

	        $mail->setFrom($config->FromEmail, $config->FromName);
	        $mail->addAddress($recipient['email'], $recipient['name']);

	        if(isset($recipient['cc'])){
	        	foreach($recipient['cc'] as $cc)
	        		$mail->addCC($cc['email'], $cc['name']);
	        }

	        if(isset($recipient['bcc'])){
	            foreach($recipient['bcc'] as $bcc)
	                $mail->addBCC($bcc['email'], $bcc['name']);
	        }

	        if(isset($options['attachment'])){
	            foreach($options['attachment'] as $att)
	                $mail->addAttachment($att['file'], $att['name']);
	        }

	        $mail->Subject = $options['subject'];

	        $mail->Body = $mail->AltBody = $options['text'];
	        if($options['html'])
	        	$mail->Body = $options['html'];

	        $mail->send();
	    }catch(\Exception $e){
	    	self::$last_error = $mail->ErrorInfo;
	    }

	    return !self::$last_error;
    }

    static function lastError(): ?string {
    	return self::$last_error;
    }
}