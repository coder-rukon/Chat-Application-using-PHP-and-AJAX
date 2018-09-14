<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Plant extends CI_Controller {
	private $header;
	private $footer;
	private $body;
	public function __construct(){
		parent::__construct();
		$this->header = array();
		$this->footer = array();
		$this->body = array();
	}
	public function index($id= null)
	{
		if(!is_null($id)){
			$this->single($id);
		}

	}
	public function single($id = null)
	{
		$this->load->model(array('Rs_Global'));
		$this->Rs_Global->set_table('plant');
		$this->body['plant'] = $this->Rs_Global->get(array('id'=>$id));
		if(empty($this->body['plant'])){
			$this->body['heading'] = "404!";
			$this->body['message'] = "News Not Found";
			$this->load->view('errors/html/error_404',$this->body);
		}else{
			$this->load->view('header');
			$this->load->view('template/single_plant',$this->body);
			$this->load->view('footer');
		}
	}

}
