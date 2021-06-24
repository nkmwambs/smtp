<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
		//$this->load->library('utility_forms');
	 }
	public function index()
	{
		$buildform = new utility_forms();
		
		$fields[] = array(
		'element'=>'input',
		'label'=>'Username',
		'properties' => array('id'=>'username','name'=>'username','placeholder'=>'Enter Username')
		);
		
		$fields[] = array(
		'element'=>'input',
		'label'=>'Email',
		'properties' => array('id'=>'email','name'=>'email','placeholder'=>'Enter Email')
		);
		
		$fields[] = array(
		'element'=>'select',
		'label'=>'Gender',
		'properties' => array('id'=>'email','name'=>'email','placeholder'=>'Enter Email'),
		'options'=>array(
			'male'=>array('option'=>'Male'),
			'female'=>array('option'=>'Female','properties'=>array('selected')),
		)
		);
		
		
		$buildform->set_form_fields($fields);
		
		$buildform->set_debug_mode(true);
		
		$buildform->set_form_action(base_url().'codeigniter/index.php/Welcome/post');
		
		$array['form']= $buildform->form_render('multi_form');
			
		$this->load->view('welcome_message',$array);
		
	}

	function post(){
		print_r($_POST);
	}
}
