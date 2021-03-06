<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');

class Comments extends CI_Controller{

	public function __construct(){
        parent::__construct();

       
        $this->load->model('blog_model');
        }

	

/*Se realiza la busqueda de los comentarios en el blog_model y se muestran en la vista comments_view*/

	public function comments(){

		$datos = $this->blog_model->num_comments($this->uri->segment(3));
		if ($datos==false) {
           $this->session->set_flashdata('noresult','No hay comentarios'); 
		}
		
		$config['base_url'] = base_url().'comments/comments/'.$this->uri->segment(3);
		$config['total_rows'] = $datos;
		$config['per_page'] = 4;
		$config['num_links'] = 5;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$data = $this->blog_model->entry_espec($this->uri->segment(3));

		if ($data!=false) {
		$this->pagination->initialize($config);
		$d = array(
			'comment' => $this->blog_model->get_comments($config['per_page']),
			'paginacion'=> $this->pagination->create_links(),
			'ident' => $data->id,
			'title' => $data->title,
			'body' => $data->body,
			'autor' => $data->autor,
			'fech' => $data->dat,
			'filename'=> $data->filename
			);

		/*$data['title'] = "Bienvenidos a mi blog";
		$data['heading'] = "Mi blog";
		$data['entries'] = $this->blog_model->get_entries();
		*/
		$this->load->view('blog_view');
		$this->load->view('comments_view',$d);		
		}else{
			echo "Pagina no encontrada<br>";
			echo anchor('/', 'Regresar');
		}

		
	}

	
	
/*se realiza la insercion de comentarios que son insertados en la vista comments_view y los manda al modelo blog_model al metodo insertComments*/

	

	function comment_insert(){
		
			$this->lang->idioma();

		$this->form_validation->set_rules('body', 'body', 'trim|required');
		if ($this->form_validation->run() == TRUE)
        {

        		


        	$cuerpo = $this->input->post['body'];
        	$comment = array(
	        'entry_id' => htmlspecialchars($this->input->post('entry_id')),
	        'body' => htmlspecialchars($this->input->post('body')),
	        'author' => $this->session->userdata('user'),
	        'report'=> "no"
	        );

            $this->session->set_flashdata('inscom','Comentario publicado'); 

	    	$this->blog_model->insert_comments('comments', $comment);
	    


		$this->mail->send('david@sandbox4f6e13b616174f8094191fd452882252.mailgun.org','david_valdez22@hotmail.com','Nuevo comentarios',$comment['body']);
		


		redirect('comments/comments/'.$_POST['entry_id']);


        }else{

	         $error = validation_errors();
         $this->session->set_flashdata('errcom',$error); 

			redirect('comments/comments/'.$_POST['entry_id']);

       }


	
	}
	public function bann_view(){
		

			# code...
		
		$datos = array(
			'comments'=> $this->blog_model->get_commentsb()
			);
		if ($datos['comments']== false) {
         $this->session->set_flashdata('noresulban',"No hay comentarios baneados"); 
		}
		$this->load->view('blog_view');
		$this->load->view('bann_view',$datos);
	}



	public function bann(){
		$cont = $this->input->post('cont');
		$user = $this->input->post('user');
		
		if (isset($_POST['del'])) {
 			$this->session->set_flashdata('banc','Comentario elminado'); 
			$this->blog_model->delbann($cont);
			# code...
		}elseif(isset($_POST['rest'])){
 			$this->session->set_flashdata('banc','Comentario restaurado'); 
			$this->blog_model->updbann($cont);
		}else{
 			$this->session->set_flashdata('banc','Usuario baneado'); 
			$this->session->set_userdata('bann', "si");
			$this->blog_model->bannuser($user);
		}

		redirect('comments/bann_view');
	}

	public function reportar(){

		$user = $this->input->post('user');
		$cont = $this->input->post('cont');
		$this->blog_model->reportar($user,$cont);
        $this->session->set_flashdata('comban','Comentario reportado'); 
		redirect('comments/comments/'.$_POST['url']);

	}

	public function regresar(){
    	//echo "<script language='javascript'> parent.location.reload(); </script>";
		redirect('/');
	}


}

