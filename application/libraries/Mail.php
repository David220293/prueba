<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

require 'mailgun-php/vendor/autoload.php';
use Mailgun\Mailgun;
class Mail {
   //funciones que queremos implementar en Miclase.
   function send($from,$to,$subject,$text){

      $mg = new Mailgun('key-87d264af96f4f7b9cbe3cf99c842dcdc');
    
      $domain = "sandbox4f6e13b616174f8094191fd452882252.mailgun.org";

# Make the call to the client.
    $result = $mg->sendMessage($domain,array(
        'from'    => $from,
        'to'      => $to,
        'subject' => $subject,
        'text'    => $text
    ));
   }

 }
   

?>