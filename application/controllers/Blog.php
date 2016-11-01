<?php if ( ! defined('BASEPATH')) exit('No se permite el acceso directo al script');
class Blog extends CI_Controller{

	public function __construct(){
        parent::__construct();

       
        $this->load->model('blog_model');
        }

	/*Se inicia la vista blog_view con los datos de la tabla entries llamados desde el modulo blog_view*/

	function index(){

			$datos = $this->blog_model->num_entries();
			$config['base_url'] = base_url().'entries/entri/';
		$config['total_rows'] = $datos;
		$config['per_page'] = 4;
		$config['num_links'] = 5;
		$config['first_link'] = '<<';
		$config['last_link'] = '>>';
		$config['next_link'] = '>';
		$config['prev_link'] = '<';

		$this->pagination->initialize($config);
		if ($datos!=false) {
			
		$data = array(
			'entries' => $this->blog_model->get_entries($config['per_page']),
			'paginacion'=> $this->pagination->create_links()
			);
		$this->load->view('blog_view');
		$this->load->view('entries_view',$data);
		}else{
			$data = array(
			'entries' => $this->blog_model->get_entries($config['per_page']),
			'paginacion'=> $this->pagination->create_links()
			);
		$this->load->view('blog_view');
		$this->load->view('entries_view',$data);
		}


	}

	function idiomas()
	{

		$CI =& get_instance();

		$lang = $CI->session->userdata('idioma');

		if(emptyempty($lang))

		{

		$lang = "spanish";

		$CI->session->set_userdata(array('idioma'=>'spanish'));               

		}


	}	
	function close(){
		$this->session->sess_destroy();
		redirect('blog');

	}


	
}