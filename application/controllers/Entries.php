<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');


class Entries extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->model('blog_model');
        }

    /*Se muestra la vista new_view que es para poder ingresar las nuevavs entradas*/

	function new_entry(){
		


		$data['title'] = "Entradas nueva";
		$data['heading'] = "Ingresa nueva entrada";
		$this->load->view('new_view',$data);



	}
	function entri(){
		$datos = $this->blog_model->num_entries();
		if ($datos!=false) {
			$config['base_url'] = base_url().'entries/entri/';
		$config['total_rows'] = 
		$config['per_page'] = 4;
		$config['num_links'] = 5;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		$data = array(
			'entries' => $this->blog_model->get_entries($config['per_page']),
			'paginacion'=> $this->pagination->create_links()
			);

		$this->load->view('entries_view',$data);
		}else{
			echo "No hay entradas";
		}
		
	}

	
	public function del(){
		$fecha = $this->input->post('date');

		if (isset($_POST['delete'])){
			$this->blog_model->del_entri($fecha);
 			$this->session->set_flashdata('delpo','Entrada eliminada'); 
 			redirect('entries/entri');
		}else{
			$datos = $this->blog_model->call_entrie($fecha);
			$da['id'] = $datos->id;
			$da['title'] = $datos->title;
			$da['body'] = $datos->body;
			$this->load->view('edit_entries_view',$da);


		}
		
	}
	public function update(){
		$this->form_validation->set_rules('title', 'title', 'trim|required');
	 	$this->form_validation->set_rules('body', 'body', 'trim|required');
			$this->lang->idioma();

			 	if ($this->form_validation->run()==true) {


					$config['upload_path'] = './assets/images/uploads/';
					$config['allowed_types'] = 'gif|jpg|png';
					//$config['max_size']     = '100';
					$config['max_width'] = '700';
					$config['max_height'] = '600';

					$this->load->library('upload', $config);
					if (!$this->upload->do_upload('userfile')) {
				# code...
	            		 $this->session->set_flashdata('noup','No se subio correctamente el archivo'.$this->upload->display_errors()); 
					}else{
						$this->session->set_flashdata('siup','Si se subio el archivo'); 
					}




				 	$id = htmlspecialchars($this->input->post('id'));
	        		$title = htmlspecialchars($this->input->post('title'));
	        		$body = $this->input->post('body');
	        		$filename = $this->upload->data('file_name');    

	        		$upd = $this->blog_model->update_entries($id,$title,$body,$filename);
	        		//echo "Actualizacion realizada";
         			$this->session->set_flashdata('entupd','Entrada actualizada'); 

			 		redirect('entries/entri');

			 	}else{
					$error = validation_errors();
        			$this->session->set_flashdata('errupd',$error); 
			 		redirect('entries/entri');
			 	}
	}

	/*Se realiza la incersion de los datos que fueron ingresados en la vista de new_view enviados al model blog_model*/
	function entries_insert(){
		
        $this->form_validation->set_rules('title', 'title', 'trim|required');
		$this->form_validation->set_rules('body', 'body', 'trim|required');
					$this->lang->idioma();


		if ($this->form_validation->run() == TRUE)
        {	
		$config['upload_path'] = './assets/images/uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		//$config['max_size']     = '100';
		$config['max_width'] = '700';
		$config['max_height'] = '600';

		$this->load->library('upload', $config);
		

			//$this->upload->initialize($config);
			if (!$this->upload->do_upload('userfile')) {
				# code...
	             $this->session->set_flashdata('noup','No se subio correctamente el archivo'.$this->upload->display_errors()); 
			}else{
				$this->session->set_flashdata('siup','Si se subio el archivo'); 
			}
			
			$entry = array(
                    'title' => htmlspecialchars($this->input->post('title')),
                    'body' => $this->input->post('body'),
                    'autor' => $this->session->userdata('name'),
                    'filename' =>$this->upload->data('file_name')    
                    );  
             $this->session->set_flashdata('ins','Publicado correctamente'); 
           
            $this->blog_model->insert_entries('entries', $entry);
            //redirect('entries/new_entry');
            	echo "<script language='javascript'> parent.location.reload(); </script>";

		}else{
			$error = validation_errors();
        	$this->session->set_flashdata('erren',$error); 
            redirect('entries/new_entry');

		}

	}

	


}
