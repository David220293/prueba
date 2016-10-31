<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
class Login extends CI_Controller{

	public function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('blog_model');
        }
    //Se carga la vista login_view
	function login_view(){
		$this->load->view('login_view');
	}

	// se hace el check del tipo de usuario que se esta logeando user, admin, suadmin
	function login_check(){
					//$this->lang->load('form_validation','spanish');
                	//$this->config->set_item('language','spanish');

		$this->form_validation->set_rules('user', 'user', 'trim|required');
		$this->form_validation->set_rules('pass', 'pass', 'required');


		if($this->form_validation->run()==True){
			$user = htmlspecialchars($this->input->post('user'));
			$pass = htmlspecialchars($this->input->post('pass'));



			$data = $this->blog_model->logeous($user);		

			if($data){
				
				if ($this->bcrypt->check_password($pass, $data->pass))
				{
				    $user_data = array(
					'user' => $data->user,
					'name'=>$data->name,
					'type_user' => $data->type_user,
					'login' => true,
					'bann'=> $data->bann,
					'idioma' => $data->lang
					);
            	$this->session->set_userdata($user_data);

            
               


            	echo "<script language='javascript'> parent.location.reload(); </script>";

				}else{
		         	$this->session->set_flashdata('passfail','Contraseña incorrecta'); 
 					redirect('login/login_view');


				}
					            	
            	//redirect('blog');
			}else{
		         $this->session->set_flashdata('usfail','Usuario incorrecto'); 
				redirect('login/login_view');
			
			}
		}else{
			$error = validation_errors();
         	$this->session->set_flashdata('err',$error); 
			redirect('login/login_view');

		}


		



		
		

	}
}