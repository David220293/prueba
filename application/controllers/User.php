<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
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
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('user', 'user', 'trim|required');
		$this->form_validation->set_rules('pass', 'pass', 'required|min_length[5]|char');
		$this->form_validation->set_rules('passm', 'passm', 'required|matches[pass]|min_length[5]');
		$this->form_validation->set_rules('email','email','valid_email|required');
		$this->form_validation->set_rules('idioma','idioma','required');
		
		if ($this->form_validation->run() == TRUE)
   		{		
    		//$usuario = $this->input->post('user');
			//$mail = $this->input->post('email');
			$user = $this->input->post('user');
			$mail = $this->input->post('email');
			$pass = $this->input->post('pass');
			$idioma ="";
			if ($_POST['idioma'] =="Ingles") {
				$idioma = "Ingles";
			}else{
				$idioma = "Español";
			}
			
			
        	$query = $this->blog_model->check_user_ex($user,$mail);	
        	if ($query==false) {
		         $this->session->set_flashdata('redu','usuario o email existente'); 
				redirect('user/new_user');
        	}else{
        		//valid_char($pass);
            	//echo "<script language='javascript'> parent.location.reload(); </script>";
            	//if(valid_char($pass) == true){
        		$users = array(
				        'user' => htmlspecialchars($this->input->post('user')),
				        'pass' => $this->bcrypt->hash_password($pass),
				        'name' => htmlspecialchars($this->input->post('name')),
				        'email' => htmlspecialchars($this->input->post('email')),
				        'type_user' => "user",
				        'bann' =>"no",
				        'lang'=> $idioma
        				);  
	        		$this->blog_model->insert_user('users', $users);
	         		$this->session->set_flashdata('reins','Registro exitoso'); 
	         		redirect('user/new_user');
					//echo "<script language='javascript'> parent.location.reload(); </script>";
					
	        		/*}else {
         				$this->session->set_flashdata('reca','Agrega caracteres especiales a tu contraseña'); 
    					redirect('user/new_user');
	        		}*/
        	}

        	
			
       
		//redirect(base_url());
        
		
	}else{
		$error = validation_errors();
         $this->session->set_flashdata('refor',$error); 
		redirect('user/new_user');
	}
}


	public function bann_users(){
		$datos = $this->blog_model->cont_user_ban();

		if ($datos==false) {
 			$this->session->set_flashdata('noresulus','No hay usuarios baneados'); 
		}
		$data= array(
				'users' => $this->blog_model->get_users()
			);
		$this->load->view('users_view',$data);
	}

	public function admin(){
		$datos = $this->blog_model->con_usera();
		if($datos==false){
 			$this->session->set_flashdata('nous','No hay usuarios'); 
		}
		$data = array(
			'users' => $this->blog_model->get_usersa());
		$this->load->view('usuario', $data);
	}
	public function admin_up(){
		$user = $this->input->post('user');
		$this->blog_model->user_admin($user);
		$this->session->set_flashdata('admup','Se a actualizado el permiso'); 
		redirect('user/admin');
	}

	public function bann_up(){
		$user = $this->input->post('user');
		if (isset($_POST['up'])) {
			$this->session->set_flashdata('ban','Se quito el banneo'); 
			$this->session->set_userdata('bann', "no");
			$this->blog_model->rm_ban($user);			
		}else{
			$this->session->set_flashdata('ban','Se ha explusado al usuario'); 
			$this->blog_model->rm_user($user);
		}
		redirect('user/bann_users');

	}


	

}