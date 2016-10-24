<?php
require 'vendor/autoload.php';
use Mailgun\Mailgun;

class Comments extends CI_Controller{

	public function __construct(){
        parent::__construct();

       
        $this->load->model('blog_model');
        }

	

/*Se realiza la busqueda de los comentarios en el blog_model y se muestran en la vista comments_view*/

	public function comments(){



		$config['base_url'] = base_url().'comments/comments/'.$this->uri->segment(3);
		$config['total_rows'] = $this->blog_model->num_comments($this->uri->segment(3));
		$config['per_page'] = 4;
		$config['num_links'] = 5;
		$config['next_link'] = '>';
		$config['prev_link'] = '<';
		$data = $this->blog_model->entry_espec($this->uri->segment(3));
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
		$this->load->view('comments_view',$d);
	}

	/*function del_comments(){
		$config['base_url'] = base_url().'comments/del_comments';
		$config['total_rows'] = $this->blog_model->num_comments();
		$config['per_page'] = 5;
		$config['num_links'] = 5;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$dat = array(
			'comments' => $this->blog_model->get_comment($config['per_page']),
			'paginacion'=> $this->pagination->create_links()
			);		$this->load->view('delete_comments',$dat);

	}*/

/*	function delete_comment(){
		$id = htmlspecialchars($this->input->post('id'));
		$this->blog_model->delete_comments($id);
		redirect('comments/del_comments');

	}*/


	
/*se realiza la insercion de comentarios que son insertados en la vista comments_view y los manda al modelo blog_model al metodo insertComments*/

	

	function comment_insert(){

		$this->form_validation->set_rules('body', 'body', 'required');
		
		if ($this->form_validation->run() == TRUE)
        {
        	$comment = array(
	        'entry_id' => htmlspecialchars($this->input->post('entry_id')),
	        'body' => htmlspecialchars($this->input->post('body')),
	        'author' => $this->session->userdata('user'),
	        'report'=> "no"
	        );

            $this->session->set_flashdata('inscom','Comentario publicado'); 

	    	$this->blog_model->insert_comments('comments', $comment);
	    


   		# First, instantiate the SDK with your API credentials and define your domain. 
		$mg = new Mailgun("key-87d264af96f4f7b9cbe3cf99c842dcdc");
		$domain = "blog.com";

				# Now, compose and send your message.
		$mg->sendMessage($domain, array('from'    => 'davidvaldez2202@gmail.com', 
                                'to'      => 'davidvaldez2202@gmail.com', 
                                'subject' => 'The PHP SDK is awesome!', 
                                'text'    => 'It is so simple to send a message.'));
		redirect('comments/comments/'.$_POST['entry_id']);


        }else
	         $this->session->set_flashdata('comfo','Completa el formulario'); 

			redirect('comments/comments/'.$_POST['entry_id']);

       


	
	}
	public function bann_view(){
		$datos = array(
			'comments'=> $this->blog_model->get_commentsb()
			);
		
		$this->load->view('bann_view',$datos);
	}
	public function bann(){
		$idcom = $this->input->post('id');
		$user = $this->input->post('user');
		if (isset($_POST['del'])) {
			$this->blog_model->delbann($idcom);
			# code...
		}elseif(isset($_POST['rest'])){
			$this->blog_model->updbann($idcom);
		}else{
			$this->blog_model->bannuser($user);
		}

		redirect('comments/bann_view');
	}

	public function reportar(){
		$id = $this->input->post('id');
		$this->blog_model->reportar($id);
        $this->session->set_flashdata('comban','Comentario reportado'); 
		redirect('comments/comments/'.$_POST['url']);

	}

	public function regresar(){
    	echo "<script language='javascript'> parent.location.reload(); </script>";

	}


}

