<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
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
		$this->load->view('header');
		//$this->load->view('login',$this->body);
		$this->load->view('footer');

	}

}
