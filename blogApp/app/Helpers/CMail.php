<?php 

    namespace App\Helpers;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    class CMail{

        public static function send($config){
            //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try{
        //Server settings
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            
            $mail->Host       = config('services.mail.host');                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = config('services.mail.username');                  
            $mail->Password   = config('services.mail.password');                              
            $mail->SMTPSecure = config('services.mail.encryption');         
            $mail->Port       = config('services.mail.port');                                  

            //Recipients
            $mail->setFrom(
                isset($config['from_address']) ? $config['from_address'] : config('services.mail.from_address'),
                isset($config['from_name']) ? $config['from_name']: config('services.mail.from_name'),
            );
            $mail->addAddress($config['recipient_address'], isset($config['recipient_name']) ? $config['recipient_name'] : null);     //Add a recipient
  

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = $config['subject'];
            $mail->Body    = $config['body'];

            if(!$mail->send()){
                return false;
            }else{
                return true;
            }
        } catch (Exception $e) {
            return false;
        }
    } 
}

?>