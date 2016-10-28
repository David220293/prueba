<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class MY_lang extends CI_Lang{
      


        public function __construct()
        {
                parent::__construct();
               // $this->load->model('blog_model');
                //$this->blog_model('lenguage');
                //redirect('login/lenguage');

        }

        public function idioma(){
            $CI =& get_instance();


             if ($CI->session->userdata('idioma')=="Español") {
                    $CI->lang->load('form_validation','spanish');
                    $CI->config->set_item('language','spanish');
                }else{
                    $CI->lang->load('form_validation','english');
                    $CI->config->set_item('language','english');
                } 
        }




}
