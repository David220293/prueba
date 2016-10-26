<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('add_car'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com
    function valid_char($pass)
    {
 
                $len = strlen($pass);
                $valid=false;
                for ($i=0; $i <$len ; $i++) { 
                    $char = substr($pass, $i);


                    if($char=="!" or $char =="#" or $char=="$" or $char=="%" or $char=="&" or $char=="/" or $char=="(" or $char==")" or $char=="=" or $char=="?" or $char=="¿" or $char=="¡" or $char=="|" or $char=="-" or $char=="_" or $char=="°" or $char=="+" or $char=="*" or $char=="{" or $char=="}" or $char=="." or $char==":" or $char==";" or $char=="," or $char=="@" or $char=="¬" or $char=="'" or $char=="¸" or $char=="~" or $char=="´" or $char=="¨" or $char=="^" or $char=="`" or $char=="·" or $char=="`" or $char=="\"" or $char=="\'" or $char=="·" or $char=="½" or $char=="[" or $char=="]" or $char=="̣" ){


                        $valid = true;
                        return $valid;

                    }else{
                        $valid = false;
                        return $valid;
                    }
                //echo "<script language='javascript'> parent.location.reload(); </script>";
            
 
                }
    }

}
