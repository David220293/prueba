<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_Form_validation extends CI_Form_validation{
      


        public function __construct()
        {
                parent::__construct();
               // $this->load->model('blog_model');
                //$this->blog_model('lenguage');
                //redirect('login/lenguage');

        }
      function char($pass)
       {        $CI =& get_instance();

 
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