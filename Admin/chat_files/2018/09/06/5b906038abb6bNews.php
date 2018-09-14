<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	private $header;
	private $footer;
	private $body;
	public function __construct(){
		parent::__construct();
		$this->header = array(
				'menu' => 'page',
				'submenu' => 'all'
			);
		$this->footer = array();
		$this->body = array();
	}
	public function index($slug= null)
	{
		if(!is_null($slug)){
			$this->single($slug);
		}

	}
	public function single($slug = null)
	{
		$this->load->model(array('Rs_Global'));
		$this->Rs_Global->set_table('news');
		$this->body['news'] = $this->Rs_Global->get(array('slug'=>$slug));
		if(empty($this->body['news'])){
			$this->body['heading'] = "404!";
			$this->body['message'] = "News Not Found";
			$this->load->view('errors/html/error_404',$this->body);
		}else{
			$this->load->view('header');
			$this->load->view('template/single_news',$this->body);
			$this->load->view('footer');
		}
	}

}
