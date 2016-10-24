<?php
class User extends CI_Controller{

	public function __construct(){
        parent::__construct();

        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('blog_model');
        }


        
// se carga la vista new_user

	function new_user(){
		$data['title'] = "Registro";
		$data['heading'] = "Inicia sesion";
		
		$this->load->view('sign_up_view',$data);

	}


	function user_insert(){


		$this->form_validation->set_rules('name', 'name', 'required');
		$this->form_validation->set_rules('user', 'user', 'required');
		$this->form_validation->set_rules('pass', 'pass', 'required|min_length[5]');
		$this->form_validation->set_rules('passm', 'passm', 'required|matches[pass]|min_length[5]');
		$this->form_validation->set_rules('email','email','valid_email|required');

		
		if ($this->form_validation->run() == TRUE)
   		{		

    		//$usuario = $this->input->post('user');
			//$mail = $this->input->post('email');
			$user = $this->input->post('user');
			$mail = $this->input->post('email');
			$pass = $this->input->post('pass');
			
        	$query = $this->blog_model->check_user_ex($user,$mail);	

        	if ($query==false) {
		         $this->session->set_flashdata('redu','usuario o email existente'); 
				redirect('user/new_user');
        	}else{

        		$len = strlen($pass);
        		$valid=false;
        		for ($i=0; $i <$len ; $i++) { 
        			$char = substr($pass, $i);
        			if($char=="!" or $char =="#" or $char=="$" or $char=="%" or $char=="&" or $char=="/" or $char=="(" or $char==")" or $char=="=" or $char=="?" or $char=="¿" or $char=="¡" or $char=="|" or $char=="-" or $char=="_" or $char=="°" or $char=="+" or $char=="*" or $char=="{" or $char=="}" or $char=="." or $char==":" or $char==";" or $char==","){


        				$valid = true;

        			}
       		
            	//echo "<script language='javascript'> parent.location.reload(); </script>";
        	}
        	if($valid == true){
        		$users = array(
				        'user' => htmlspecialchars($this->input->post('user')),
				        'pass' => $this->bcrypt->hash_password($pass),
				        'name' => htmlspecialchars($this->input->post('name')),
				        'email' => htmlspecialchars($this->input->post('email')),
				        'type_user' => "user",
				        'bann' =>"no"
        				);  
	        		$this->blog_model->insert_user('users', $users);
	         		$this->session->set_flashdata('reins','Registro exitoso'); 
					echo "<script language='javascript'> parent.location.reload(); </script>";
					
	        		}else {
         				$this->session->set_flashdata('reca','Agrega caracteres especiales a tu contraseña'); 
    					redirect('user/new_user');

	        		}

			
       
		//redirect(base_url());

        }
		

	}else{
         $this->session->set_flashdata('refor','Completa correctamente el formulario'); 
		redirect('user/new_user');

	}
}


	public function bann_users(){
		$data= array(
				'users' => $this->blog_model->get_users()
			);
		$this->load->view('users_view',$data);
	}

	public function bann_up(){
		$id = $this->input->post('id');
		if (isset($_POST['up'])) {
			$this->blog_model->rm_ban($id);			
		}else{
			$this->blog_model->rm_user($id);
		}
	}

}