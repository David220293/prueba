<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('add_valid_char'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function valid_char($pass)
    {
 
              $CI =& get_instance();

 
                $len = strlen($pass);
                $valid;
                
                for ($i=0; $i <$len ; $i++) { 
                   
                    $char = substr($pass, $i);


                    if($char=="!" or $char =="#" or $char=="$" or $char=="%" or $char=="&" or $char=="/" or $char=="(" or $char==")" or $char=="=" or $char=="?" or $char=="¿" or $char=="¡" or $char=="|" or $char=="-" or $char=="_" or $char=="°" or $char=="+" or $char=="*" or $char=="{" or $char=="}" or $char=="." or $char==":" or $char==";" or $char=="," or $char=="@" or $char=="¬" or $char=="'" or $char=="¸" or $char=="~" or $char=="´" or $char=="¨" or $char=="^" or $char=="`" or $char=="·" or $char=="`" or $char=="\"" or $char=="\'" or $char=="·" or $char=="½" or $char=="[" or $char=="]" or $char=="̣" ){

                        $valid= true;

                    }else{

                      $CI->form_validation->set_message('char', 'The {field} field must contain a character especial.');
                      if ($valid == true) {
                        # code...
                      }else{
                        $valid = false;

                      }
                    }
                //echo "<script language='javascript'> parent.location.reload(); </script>";
            
 
                }
                return $valid;
                
                
    }

}
