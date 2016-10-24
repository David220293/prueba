<?php
class Blog extends CI_Controller{

	public function __construct(){
        parent::__construct();

       
        $this->load->model('blog_model');
        }

	/*Se inicia la vista blog_view con los datos de la tabla entries llamados desde el modulo blog_view*/

	function index(){

		/*$config['base_url'] = base_url().'blog/index/';
		$config['total_rows'] = $this->blog_model->num_entries();
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
*/
		/*$data['title'] = "Bienvenidos a mi blog";
		$data['heading'] = "Mi blog";
		$data['entries'] = $this->blog_model->get_entries();
		*/
		$this->load->view('blog_view');


	}
	function close(){
		$this->session->sess_destroy();
		redirect('blog');

	}


	
}