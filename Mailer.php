<?php
/*

Klasa pomocnicza dla phpmailer.

by Cieniu

*/
class Mailer{

/*
Wysyła email
*/
public static function sendMail($sendTo, $sendFrom, $subject, $message, $username, $password, $host='mail.ogloszeniaolesnickie.pl')
	{

				Yii::import('application.extensions.phpmailer.JPhpMailer');
				$mail = new JPhpMailer;
				$mail->IsSMTP();
				//$mail->SMTPDebug  = 1;
				$mail->Host = $host;
				$mail->SMTPAuth = true;
				$mail->Username = $username;
				$mail->Password = $password;
				$mail->SetFrom($sendFrom, $sendFrom);
				$mail->Subject = $subject;
				$mail->AltBody = 'Treść wiadomości: '.$message;
				$mail->CharSet = "UTF-8";
				$templatemail = Yii::app()->controller->renderPartial('application.components.views.email_template', array('message' => $message, 'subject'=>$subject), true);
				$mail->MsgHTML($templatemail);
				$mail->AddAddress($sendTo, 'Wiadomość z portalu Ogłoszeniaolesnickie.pl');
				
				
				if($mail->Send()){

				Yii::app()->user->setFlash('message-form','Wiadomość została wysłana!');
				//$this->refresh();
				}else throw new CHttpException(404,'Nie udało się wysłać wiadomości. Błąd skryptu. wyślij email do administratora marcin@laret.pl');



	}
	

}
