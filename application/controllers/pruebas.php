<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pruebas extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
   public function __construct()
   {
     parent::__construct();

     $this->load->database();
     $this->load->helper('url');
   }
	 public function new_crud(){
			 $db_driver = $this->db->platform();
			 $model_name = 'grocery_crud_model_'.$db_driver;
			 $model_alias = 'm'.substr(md5(rand()), 0, rand(4,15) );

			 unset($this->{$model_name});
			 $this->load->library('Grocery_CRUD');
			 $crud = new Grocery_CRUD();
			 if (file_exists(APPPATH.'/models/'.$model_name.'.php')){
				 $this->load->model('grocery_crud_model');
				 $this->load->model('grocery_crud_generic_model');
					$this->load->model($model_name,$model_alias);
					 $crud->basic_model = $this->{$model_alias};
			 }
			 return $crud;
	 }
	 public function index()
 	{
 		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
 	}
  public function _example_output($output = null)
	{
		$this->load->view('commerce.php',$output);
	}
  public function articulos()
	{
			$crud = $this->new_crud();

			$crud->set_table('nuevatabla4');
      $crud->fields('name');
      $crud->set_subject('Nueva Tabla');
			$output = $crud->render();

			$this->_example_output($output);
	}
  public function Ciudad()
	{
			$crud = $this->new_crud();

			$crud->set_table('nuevatabla2');

			$output = $crud->render();

			$this->_example_output($output);
	}
}
